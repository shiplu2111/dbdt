<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PackInvoice;
use App\Models\Package;
use App\Models\Teambonus;
use App\Models\UserData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Rules\Password;
use PhpParser\Node\Expr\New_;

class DbdtadminController extends Controller
{

    public function index()
    {
        $show = view('backend.admin.index');
        return view('backend.admin.layouts.master')->with('content', $show);
    }


    public function userlist()
    {
        $users = DB::table('users')->where('role', 'user')->get();

        $show = view('backend.admin.users.show')->with('users', $users);
        return view('backend.admin.layouts.master')->with('content', $show);
    }


    public function activeuser($id)
    {
        DB::table('users')->where('id', $id)->update(['status' => '1']);
        return back();
    }

    public function inactiveuser($id)
    {
        DB::table('users')->where('id', $id)->update(['status' => '0']);
        return back();
    }

    public function banuser($id)
    {
        DB::table('users')->where('id', $id)->update(['status' => '2']);
        return back();
    }





    public function adminlist()
    {
        $admins = DB::table('users')->where('role', 'admin')->get();

        $show = view('backend.admin.admin.show')->with('admins', $admins);
        return view('backend.admin.layouts.master')->with('content', $show);
    }

    public function adminadd()
    {

        $show = view('backend.admin.admin.add');
        return view('backend.admin.layouts.master')->with('content', $show);
    }


    public function activeadmin($id)
    {
        DB::table('users')->where('id', $id)->update(['status' => '1']);
        return back();
    }

    public function inactiveadmin($id)
    {
        DB::table('users')->where('id', $id)->update(['status' => '0']);
        return back();
    }

    public function banadmin($id)
    {
        DB::table('users')->where('id', $id)->update(['status' => '2']);
        return back();
    }

    public function registeradmin(Request $request)
    {
        $validated = $request->validate([


            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'regex:/^\S*$/u', 'max:25', 'unique:users'],
            'role' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'max:255', 'regex:/(0)[0-9]/', 'not_regex:/[a-z]/', 'min:12'],
            'password' => ['required', 'string', 'confirmed'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ]);

        $admin = new User();
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->myrefferalcode = 'dbdt' . $request->username;
        $admin->status = '1';
        $admin->role = $request->role;
        $admin->sponcerid = 'dbdtcenter12';
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();


        return back()->with('success', 'New Admin Created Successfully');;
    }

    public function package_deposit_pending()
    {
        $lists =  DB::table('pack_invoices')->where('status', '2')->get();

        $show = view('backend.admin.deposit.package_deposit_pending')->with('lists', $lists);
        return view('backend.admin.layouts.master')->with('content', $show);
    }

    public function deposit_accept($id)
    {
        $pack_invoice = PackInvoice::find($id);
        $pack_invoice->status = '1';
        $pack_invoice->save();
        $package = Package::where('id', $pack_invoice->package_id)->first();

        $user_update = User::where('id', $pack_invoice->user_id)->first();
        $user_update->status = '1';
        $user_update->override_level = $package->overridelevel;
        $user_update->save();

        $user_data_u = Account::where('user_id', $pack_invoice->user_id)->first();
        if ($user_data_u) {
            $user_data_update = Account::find($user_data_u->id);
            $user_data_update->user_id = $pack_invoice->user_id;
            $user_data_update->dbdt_balance = $package->dbdtprice;
            $user_data_update->withdraw_balance = $package->dbdtprice;

            $user_data_update->save();
        } else {
            $user_data_update = new Account();
            $user_data_update->user_id = $pack_invoice->user_id;
            $user_data_update->dbdt_balance = $package->dbdtprice;
            $user_data_update->withdraw_balance = $package->dbdtprice;
            $user_data_update->repurchase_balance = '0';
            $user_data_update->save();
        }

        $main_user = User::where('id', $pack_invoice->user_id)->first();

            $u_bonus = new Teambonus();
            $u_bonus->user_id = $pack_invoice->user_id;

            $level_one_user = User::where('myrefferalcode', $main_user->sponcerid)->first();
            if ($level_one_user) {
                if ($level_one_user->override_level >= 1) {
                    $u_bonus->level1 = $package->dbdtprice * .2;
                    $u_bonus->level1_id = $level_one_user->id;
                    $user_data_u2 = Account::where('user_id', $level_one_user->id)->first();
                    if ($user_data_u2) {
                        $user_data_update2 = Account::find($user_data_u2->id);
                        $user_data_update2->user_id = $user_data_u2->user_id;
                        $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .2);
                        $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .1);
                        $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .1);
                        $user_data_update2->save();

                    } else {
                        $user_data_update2 = new Account();
                        $user_data_update2->user_id = $level_one_user->id;
                        $user_data_update2->dbdt_balance = $package->dbdtprice * .2;
                        $user_data_update2->withdraw_balance = $package->dbdtprice * .1;
                        $user_data_update2->repurchase_balance = $package->dbdtprice * .1;
                        $user_data_update2->save();
                    }
                }
                if ($level_one_user->sponcerid != 'dbdtcenter12') {

                    $level_two_user = User::where('myrefferalcode', $level_one_user->sponcerid)->first();
                    if ($level_two_user) {
                        if ($level_two_user->override_level >= 2) {
                            $u_bonus->level2 = $package->dbdtprice * .1;
                            $u_bonus->level2_id = $level_two_user->id;
                            $user_data_u2 = Account::where('user_id', $level_two_user->id)->first();
                    if ($user_data_u2) {
                        $user_data_update2 = Account::find($user_data_u2->id);
                        $user_data_update2->user_id = $user_data_u2->user_id;
                        $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * 0.1);
                        $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice *  0.1);
                        $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice  * 0.1);
                        $user_data_update2->save();

                    } else {
                        $user_data_update2 = new Account();
                        $user_data_update2->user_id = $level_two_user->id;
                        $user_data_update2->dbdt_balance = $package->dbdtprice * .1;
                        $user_data_update2->withdraw_balance = $package->dbdtprice * .05;
                        $user_data_update2->repurchase_balance = $package->dbdtprice * .05;
                        $user_data_update2->save();
                    }
                        }
                        if ($level_two_user->sponcerid != 'dbdtcenter12') {

                            $level_three_user = User::where('myrefferalcode', $level_two_user->sponcerid)->first();
                            if ($level_three_user) {
                                if ($level_three_user->override_level >= 3) {
                                    $u_bonus->level3 = $package->dbdtprice * .05;
                                    $u_bonus->level3_id = $level_three_user->id;
                                    $user_data_u2 = Account::where('user_id', $level_three_user->id)->first();
                                    if ($user_data_u2) {
                                        $user_data_update2 = Account::find($user_data_u2->id);
                                        $user_data_update2->user_id = $user_data_u2->user_id;
                                        $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .2);
                                        $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .2 / 2);
                                        $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .2 / 2);
                                        $user_data_update2->save();

                                    } else {
                                        $user_data_update2 = new Account();
                                        $user_data_update2->user_id = $level_three_user->id;
                                        $user_data_update2->dbdt_balance = $package->dbdtprice * .1;
                                        $user_data_update2->withdraw_balance = $package->dbdtprice * .05;
                                        $user_data_update2->repurchase_balance = $package->dbdtprice * .05;
                                        $user_data_update2->save();
                                    }
                                }
                                if ($level_three_user->sponcerid != 'dbdtcenter12') {

                                    $level_four_user = User::where('myrefferalcode', $level_three_user->sponcerid)->first();
                                    if ($level_four_user) {
                                        if ($level_four_user->override_level >= 5) {
                                            $u_bonus->level4 = $package->dbdtprice * .05;
                                            $u_bonus->level4_id = $level_four_user->id;
                                            $user_data_u2 = Account::where('user_id', $level_four_user->id)->first();
                                            if ($user_data_u2) {
                                                $user_data_update2 = Account::find($user_data_u2->id);
                                                $user_data_update2->user_id = $user_data_u2->user_id;
                                                $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .2);
                                                $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .2 / 2);
                                                $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .2 / 2);
                                                $user_data_update2->save();

                                            } else {
                                                $user_data_update2 = new Account();
                                                $user_data_update2->user_id = $level_four_user->id;
                                                $user_data_update2->dbdt_balance = $package->dbdtprice * .1;
                                                $user_data_update2->withdraw_balance = $package->dbdtprice * .05;
                                                $user_data_update2->repurchase_balance = $package->dbdtprice * .05;
                                                $user_data_update2->save();
                                            }
                                        }
                                        if ($level_four_user->sponcerid != 'dbdtcenter12') {

                                            $level_five_user = User::where('myrefferalcode', $level_four_user->sponcerid)->first();
                                            if ($level_five_user) {
                                                if ($level_five_user->override_level >= 5) {
                                                    $u_bonus->level4 = $package->dbdtprice * .05;
                                                    $u_bonus->level4_id = $level_five_user->id;
                                                    $user_data_u2 = Account::where('user_id', $level_five_user->id)->first();
                                            if ($user_data_u2) {
                                                $user_data_update2 = Account::find($user_data_u2->id);
                                                $user_data_update2->user_id = $user_data_u2->user_id;
                                                $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .2);
                                                $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .2 / 2);
                                                $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .2 / 2);
                                                $user_data_update2->save();

                                            } else {
                                                $user_data_update2 = new Account();
                                                $user_data_update2->user_id = $level_five_user->id;
                                                $user_data_update2->dbdt_balance = $package->dbdtprice * .1;
                                                $user_data_update2->withdraw_balance = $package->dbdtprice * .05;
                                                $user_data_update2->repurchase_balance = $package->dbdtprice * .05;
                                                $user_data_update2->save();
                                            }
                                                }
                                                if ($level_five_user->sponcerid != 'dbdtcenter12') {

                                                    $level_six_user = User::where('myrefferalcode', $level_five_user->sponcerid)->first();

                                                    if ($level_six_user) {
                                                        if ($level_six_user->override_level >= 10) {
                                                            $u_bonus->level4 = $package->dbdtprice * .05;
                                                            $u_bonus->level4_id = $level_six_user->id;
                                                            $user_data_u2 = Account::where('user_id', $level_six_user->id)->first();
                                            if ($user_data_u2) {
                                                $user_data_update2 = Account::find($user_data_u2->id);
                                                $user_data_update2->user_id = $user_data_u2->user_id;
                                                $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .2);
                                                $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .2 / 2);
                                                $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .2 / 2);
                                                $user_data_update2->save();

                                            } else {
                                                $user_data_update2 = new Account();
                                                $user_data_update2->user_id = $level_six_user->id;
                                                $user_data_update2->dbdt_balance = $package->dbdtprice * .1;
                                                $user_data_update2->withdraw_balance = $package->dbdtprice * .05;
                                                $user_data_update2->repurchase_balance = $package->dbdtprice * .05;
                                                $user_data_update2->save();
                                            }
                                                        }
                                                        if ($level_six_user->sponcerid != 'dbdtcenter12') {
                                                            $level_seven_user = User::where('myrefferalcode', $level_six_user->sponcerid)->first();
                                                            if ($level_seven_user) {
                                                                if ($level_seven_user->override_level >= 10) {
                                                                    $u_bonus->level4 = $package->dbdtprice * .05;
                                                                    $u_bonus->level4_id = $level_seven_user->id;
                                                                    $user_data_u2 = Account::where('user_id', $level_seven_user->id)->first();
                                                                    if ($user_data_u2) {
                                                                        $user_data_update2 = Account::find($user_data_u2->id);
                                                                        $user_data_update2->user_id = $user_data_u2->user_id;
                                                                        $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .2);
                                                                        $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .2 / 2);
                                                                        $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .2 / 2);
                                                                        $user_data_update2->save();

                                                                    } else {
                                                                        $user_data_update2 = new Account();
                                                                        $user_data_update2->user_id = $level_seven_user->id;
                                                                        $user_data_update2->dbdt_balance = $package->dbdtprice * .1;
                                                                        $user_data_update2->withdraw_balance = $package->dbdtprice * .05;
                                                                        $user_data_update2->repurchase_balance = $package->dbdtprice * .05;
                                                                        $user_data_update2->save();
                                                                    }
                                                                }
                                                                if ($level_seven_user->sponcerid != 'dbdtcenter12') {

                                                                    $level_eight_user = User::where('myrefferalcode', $level_seven_user->sponcerid)->first();

                                                                    if ($level_eight_user) {
                                                                        if ($level_eight_user->override_level >= 10) {
                                                                            $u_bonus->level4 = $package->dbdtprice * .05;
                                                                            $u_bonus->level4_id = $level_eight_user->id;
                                                                            $user_data_u2 = Account::where('user_id', $level_eight_user->id)->first();
                                                                            if ($user_data_u2) {
                                                                                $user_data_update2 = Account::find($user_data_u2->id);
                                                                                $user_data_update2->user_id = $user_data_u2->user_id;
                                                                                $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .2);
                                                                                $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .2 / 2);
                                                                                $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .2 / 2);
                                                                                $user_data_update2->save();

                                                                            } else {
                                                                                $user_data_update2 = new Account();
                                                                                $user_data_update2->user_id = $level_eight_user->id;
                                                                                $user_data_update2->dbdt_balance = $package->dbdtprice * .1;
                                                                                $user_data_update2->withdraw_balance = $package->dbdtprice * .05;
                                                                                $user_data_update2->repurchase_balance = $package->dbdtprice * .05;
                                                                                $user_data_update2->save();
                                                                            }
                                                                        }
                                                                        if ($level_eight_user->sponcerid != 'dbdtcenter12') {

                                                                            $level_nine_user = User::where('myrefferalcode', $level_eight_user->sponcerid)->first();
                                                                            if ($level_nine_user) {
                                                                                if ($level_nine_user->override_level >= 10) {
                                                                                    $u_bonus->level4 = $package->dbdtprice * .05;
                                                                                    $u_bonus->level4_id = $level_nine_user->id;
                                                                                    $user_data_u2 = Account::where('user_id', $level_nine_user->id)->first();
                                                                            if ($user_data_u2) {
                                                                                $user_data_update2 = Account::find($user_data_u2->id);
                                                                                $user_data_update2->user_id = $user_data_u2->user_id;
                                                                                $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .2);
                                                                                $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .2 / 2);
                                                                                $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .2 / 2);
                                                                                $user_data_update2->save();

                                                                            } else {
                                                                                $user_data_update2 = new Account();
                                                                                $user_data_update2->user_id = $level_nine_user->id;
                                                                                $user_data_update2->dbdt_balance = $package->dbdtprice * .1;
                                                                                $user_data_update2->withdraw_balance = $package->dbdtprice * .05;
                                                                                $user_data_update2->repurchase_balance = $package->dbdtprice * .05;
                                                                                $user_data_update2->save();
                                                                            }
                                                                                }
                                                                                if ($level_nine_user->sponcerid != 'dbdtcenter12') {
                                                                                    $level_ten_user = User::where('myrefferalcode', $level_nine_user->sponcerid)->first();
                                                                                    if ($level_ten_user) {
                                                                                        if ($level_ten_user->override_level >= 10) {
                                                                                            $u_bonus->level4 = $package->dbdtprice * .05;
                                                                                            $u_bonus->level4_id = $level_ten_user->id;
                                                                                            $user_data_u2 = Account::where('user_id', $level_ten_user->id)->first();
                                                                                            if ($user_data_u2) {
                                                                                                $user_data_update2 = Account::find($user_data_u2->id);
                                                                                                $user_data_update2->user_id = $user_data_u2->user_id;
                                                                                                $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .2);
                                                                                                $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .2 / 2);
                                                                                                $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .2 / 2);
                                                                                                $user_data_update2->save();

                                                                                            } else {
                                                                                                $user_data_update2 = new Account();
                                                                                                $user_data_update2->user_id = $level_ten_user->id;
                                                                                                $user_data_update2->dbdt_balance = $package->dbdtprice * .1;
                                                                                                $user_data_update2->withdraw_balance = $package->dbdtprice * .05;
                                                                                                $user_data_update2->repurchase_balance = $package->dbdtprice * .05;
                                                                                                $user_data_update2->save();
                                                                                            }
                                                                                        }
                                                                                        if ($level_ten_user->sponcerid != 'dbdtcenter12') {
                                                                                            $level_eleven_user = User::where('myrefferalcode', $level_ten_user->sponcerid)->first();
                                                                                            if ($level_eleven_user) {
                                                                                                if ($level_eleven_user->override_level >= 12) {
                                                                                                    $u_bonus->level4 = $package->dbdtprice * .05;
                                                                                                    $u_bonus->level4_id = $level_eleven_user->id;
                                                                                                    $user_data_u2 = Account::where('user_id', $level_eleven_user->id)->first();
                                                                                            if ($user_data_u2) {
                                                                                                $user_data_update2 = Account::find($user_data_u2->id);
                                                                                                $user_data_update2->user_id = $user_data_u2->user_id;
                                                                                                $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .2);
                                                                                                $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .2 / 2);
                                                                                                $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .2 / 2);
                                                                                                $user_data_update2->save();

                                                                                            } else {
                                                                                                $user_data_update2 = new Account();
                                                                                                $user_data_update2->user_id = $level_eleven_user->id;
                                                                                                $user_data_update2->dbdt_balance = $package->dbdtprice * .1;
                                                                                                $user_data_update2->withdraw_balance = $package->dbdtprice * .05;
                                                                                                $user_data_update2->repurchase_balance = $package->dbdtprice * .05;
                                                                                                $user_data_update2->save();
                                                                                            }
                                                                                                }

                                                                                                if ($level_eleven_user->sponcerid != 'dbdtcenter12') {
                                                                                                    $level_twelve_user = User::where('myrefferalcode', $level_eleven_user->sponcerid)->first();
                                                                                                    if ($level_twelve_user) {
                                                                                                        if ($level_twelve_user->override_level >= 12) {
                                                                                                            $u_bonus->level4 = $package->dbdtprice * .05;
                                                                                                            $u_bonus->level4_id = $level_twelve_user->id;
                                                                                                            $user_data_u2 = Account::where('user_id', $level_twelve_user->id)->first();
                                                                                                            if ($user_data_u2) {
                                                                                                                $user_data_update2 = Account::find($user_data_u2->id);
                                                                                                                $user_data_update2->user_id = $user_data_u2->user_id;
                                                                                                                $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .2);
                                                                                                                $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .2 / 2);
                                                                                                                $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .2 / 2);
                                                                                                                $user_data_update2->save();

                                                                                                            } else {
                                                                                                                $user_data_update2 = new Account();
                                                                                                                $user_data_update2->user_id = $level_twelve_user->id;
                                                                                                                $user_data_update2->dbdt_balance = $package->dbdtprice * .1;
                                                                                                                $user_data_update2->withdraw_balance = $package->dbdtprice * .05;
                                                                                                                $user_data_update2->repurchase_balance = $package->dbdtprice * .05;
                                                                                                                $user_data_update2->save();
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }




            $u_bonus->dev_fund = $package->dbdtprice * .2;
            $u_bonus->save();






        return response()->json($pack_invoice);
    }
}
