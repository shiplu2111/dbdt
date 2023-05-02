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
use App\Models\Mastercard;
use App\Models\Income;
use App\Models\PackUpgrade;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\RejectKyc;
use App\Mail\AcceptKyc;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;


class DbdtadminController extends Controller
{

    public function index()
    {
        $show = view('backend.admin.index');
        return view('backend.admin.layouts.master')->with('content', $show);
    }

    function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('users')
        ->where('email', 'LIKE', "%{$query}%")
        ->limit(5)
        ->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li class="list-group-item"><a href="#">'.$row->email.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }

    
    public function swap_dbdt(Request $request )
    {

       $a= Account::find($request->account_id);
       
       if($request->swap_type==='1'){
        if($request->swap_amount>$a->repurchase_balance){
            return redirect()->back()->with('error1', 'Sorry not enough staking DBDT');
        }
        else{
        $swap= Account::find($request->account_id);
       $swap->repurchase_balance = $a->repurchase_balance - $request->swap_amount;
       $swap->withdraw_balance = $a->withdraw_balance + $request->swap_amount;
       $swap->save();
    }
       }
       else{
        if($request->swap_amount>$a->withdraw_balance){
            return redirect()->back()->with('error2', 'Sorry not enough withdrawable DBDT');
        }
        else{
        $swap= Account::find($request->account_id);
        $swap->withdraw_balance = $a->withdraw_balance-$request->swap_amount;
        $swap->repurchase_balance = $a->repurchase_balance+$request->swap_amount;
        $swap->save(); 
       }
    }
       
       return redirect()->back()->with('success_status', 'Swap successfull ');
    }
    public function userlist()
    {
        $users = DB::table('users')->where('role', 'user')->orderBy('created_at', 'desc')->get();

        $show = view('backend.admin.users.show')->with('users', $users);
        return view('backend.admin.layouts.master')->with('content', $show);
    }


    public function active_user_list()
    {
        $users = DB::table('users')->where('role', 'user')->where('status', '1')->orderBy('created_at', 'desc')->get();

        $show = view('backend.admin.users.show')->with('users', $users);
        return view('backend.admin.layouts.master')->with('content', $show);
    }

    public function inactive_user_list()
    {
        $users = DB::table('users')->where('role', 'user')->where('status', '0')->get();

        $show = view('backend.admin.users.show')->with('users', $users);
        return view('backend.admin.layouts.master')->with('content', $show);
    }
    public function banned_user_list()
    {
        $users = DB::table('users')->where('role', 'user')->where('status', '2')->get();

        $show = view('backend.admin.users.show')->with('users', $users);
        return view('backend.admin.layouts.master')->with('content', $show);
    }

    public function user_details($id)
    {
        $user_data = User::find($id);
        $user_account = DB::table('accounts')->where('user_id',$id)->first();
        $user_deposits = DB::table('deposits')->where('user_id',$id)->get();
        $user_withdraws = DB::table('withdraws')->where('user_id',$id)->get();
        $user_transfers = DB::table('transfers')->where('sender_id',$id)->get();
        $user_receives = DB::table('transfers')->where('receiver_id',$id)->get();
        
        $show = view('backend.admin.users.details')->with('user_data', $user_data)
        ->with('user_account', $user_account)
        ->with('user_deposits', $user_deposits)
        ->with('user_transfers', $user_transfers)
        ->with('user_receives', $user_receives)
        ->with('user_withdraws', $user_withdraws);
        return view('backend.admin.layouts.master')->with('content', $show);
        
    }

    
    public function user_delete($id)
    {
        $user_data = DB::table('users')->where('id',$id)->delete();
        $user_pack_invoices = DB::table('pack_invoices')->where('user_id',$id)->delete();
        $user_accounts = DB::table('accounts')->where('user_id',$id)->delete();
        $user_incomes = DB::table('incomes')->where('user_id',$id)->delete();
        $user_deposits = DB::table('deposits')->where('user_id',$id)->delete();
        $user_credits = DB::table('credits')->where('user_id',$id)->delete();
        return redirect()->back()->with('delete_success', 'Denied ');
        
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



    public function mastercard_application_detail($id)
    {
        $master_card =Mastercard::find($id);

        $show = view('backend.admin.mastercard.details')->with('master_card', $master_card);
        return view('backend.admin.layouts.master')->with('content', $show);
    }
    
    public function mastercard_application_edit($id)
    {
        $master_card =Mastercard::find($id);

        $show = view('backend.admin.mastercard.edit')->with('master_card', $master_card);
        return view('backend.admin.layouts.master')->with('content', $show);
    }
    public function mastercard_application_update(Request $request)
    {
        $master_card =Mastercard::find($request->masterCardId);
        $master_card->username = $request->username;
        $master_card->first_name = $request->first_name;
        $master_card->last_name = $request->last_name;
        $master_card->email = $request->email;
        $master_card->phone = $request->phone;
        $master_card->birth_day = $request->birth_day;
        $master_card->country = $request->country;
        $master_card->address = $request->address;
        $master_card->city = $request->city;
        $master_card->zip_code = $request->zip_code;
        $master_card->id_type = $request->id_type;
        $master_card->id_country = $request->id_country;
        $master_card->id_number = $request->id_number;
        $master_card->bank_country = $request->bank_country;
        $master_card->bank_name = $request->bank_name;
        $master_card->brunch_name = $request->brunch_name;
        $master_card->account_holder_name = $request->account_holder_name;
        $master_card->account_number = $request->account_number;
        $master_card->currency = $request->currency;
        $master_card->expire_date = $request->expire_date;
        $master_card->card_no = $request->card_no;
        $master_card->save();

        return redirect()->back()->with('update_success', 'Denied ');
    }
    

    public function mastercard()
    {
        $master_cards = DB::table('mastercards')->get();

        $show = view('backend.admin.mastercard.show')->with('master_cards', $master_cards);
        return view('backend.admin.layouts.master')->with('content', $show);
    }

       public function active_master_cards(Request $request )
    {
        $id=$request->hidden_id;
        // return $id;
       $a= Mastercard::find($id);
       $a->card_no = $request->card_no;
       $a->expire_date = $request->expire_date;
       $a->status = 1;
       $a->save();
       return redirect()->back()->with('success', 'Accepted');
    }

    public function inactive_master_cards($id)
    {
        DB::table('mastercards')->where('id', $id)->update(['status' => '2']);
        return redirect()->back()->with('success', 'Accepted');
    }

    public function ban_master_cards($id)
    {
        DB::table('mastercards')->where('id', $id)->update(['status' => '2']);
        return redirect()->back()->with('success', 'Accepted');
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
            'phone' => ['required', 'max:255', 'regex:/(0)[0-9]/', 'not_regex:/[a-z]/'],
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
        $lists =  DB::table('orders')->where('status', '0')->get();

        $show = view('backend.admin.deposit.package_deposit_pending')->with('lists', $lists);
        return view('backend.admin.layouts.master')->with('content', $show);
    }
    public function package_upgrade_deposit_pending()
    {
        $lists =  DB::table('orders')->where('type',2)->where('status',0)->get();

        $show = view('backend.admin.deposit.package_upgrade_deposit_pending')->with('lists', $lists);
        return view('backend.admin.layouts.master')->with('content', $show);
    }
    
    public function upgrade_accept($id){
        $pack_invoice = PackUpgrade::find($id);
        $pack_invoice->status = '1';
        $pack_invoice->save();

        $first_package= PackInvoice::where('user_id', $pack_invoice->user_id)->first();
        $first_package_details= Package::where('id', $first_package->first_packege)->first();
        $user_data_u = Account::where('user_id', $pack_invoice->user_id)->first();
        $account_update = Account::find($user_data_u->id);
        $account_update->dbdt_balance = $user_data_u->dbdt_balance+$pack_invoice->dbdt_value-$first_package_details->dbdtprice;
        $account_update->withdraw_balance = $user_data_u->withdraw_balance+($pack_invoice->dbdt_value-$first_package_details->dbdtprice)/2;
        $account_update->repurchase_balance = $user_data_u->repurchase_balance+($pack_invoice->dbdt_value-$first_package_details->dbdtprice)/2;
        $account_update->save();


        $user_data = User::where('id', $pack_invoice->user_id)->first();
        $package = Package::where('id', $pack_invoice->package_id)->first();

        $user_update= User::find($user_data->id);
        $user_update->override_level = $package->overridelevel;
        $user_update->save();
        $pack = PackInvoice::where('user_id', $pack_invoice->user_id)->first();

        $pack_invoice_update= PackInvoice::find($pack->id);
        $pack_invoice_update->package_id = $pack_invoice->package_id;
        $pack_invoice_update->first_packege = $pack_invoice->package_id;
        $pack_invoice_update->subtotal = $pack_invoice->subtotal+$pack->subtotal;
        $pack_invoice_update->save();


        

        return response()->json($user_data);

    }
	    public function deposit_reject($id)
    {
         $a=PackInvoice::find($id)->delete();
        return response()->json($a);
        
    }
	
    public function deposit_accept($id)
    {
        $a = PackInvoice::find($id);
        $package = Package::where('id', $a->package_id)->first();

        $pack_invoice = PackInvoice::find($id);
        $pack_invoice->status = '1';
        $pack_invoice->first_packege = $package->id;
        $pack_invoice->save();
        $package = Package::where('id', $pack_invoice->package_id)->first();

        $user_update = User::where('id', $pack_invoice->user_id)->first();
        $user_update->status = '1';
        $user_update->override_level = $package->overridelevel;
        $user_update->save();

        $data = array(
            "result" => "Package Activated Successfully",
            'url'=>'/user/my-packages/',
            );
            
            $user= User::find($user_update->id);
            $user->notify(new UserNotification($data));

        $user_data_u = Account::where('user_id', $pack_invoice->user_id)->first();
        if ($user_data_u) {
            $user_data_update = Account::find($user_data_u->id);
            $user_data_update->user_id = $pack_invoice->user_id;
            $user_data_update->dbdt_balance =$user_data_u->dbdtprice+ $package->dbdtprice;
            $user_data_update->withdraw_balance =$user_data_u->dbdtprice+ $package->dbdtprice/2;
            $user_data_update->repurchase_balance = $user_data_u->dbdtprice+$package->dbdtprice/2;

            $user_data_update->save();
        } else {
            $user_data_update = new Account();
            $user_data_update->user_id = $pack_invoice->user_id;
            $user_data_update->dbdt_balance = $package->dbdtprice;
            $user_data_update->withdraw_balance = $package->dbdtprice/2;
            $user_data_update->repurchase_balance = $package->dbdtprice/2;
            $user_data_update->withdraw_base = $package->dbdtprice/2;
            $user_data_update->repurchase_base = $package->dbdtprice/2;
            $user_data_update->save();
        }

        $main_user = User::where('id', $pack_invoice->user_id)->first();

            $u_bonus = new Teambonus();
            $u_bonus->user_id = $pack_invoice->user_id;

            $level_one_user = User::where('myrefferalcode', $main_user->sponcerid)->first();
            if ($level_one_user) {
                if ($level_one_user->override_level >= 1) {
                    $u_bonus->level1 = $package->dbdtprice * .1;
                    $u_bonus->level1_id = $level_one_user->id;
                    $user_data_u2 = Account::where('user_id', $level_one_user->id)->first();
                    if ($user_data_u2) {
                        $user_data_update2 = Account::find($user_data_u2->id);
                        $user_data_update2->user_id = $user_data_u2->user_id;
                        $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .1);
                        $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .05);
                        $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .05);
                        $user_data_update2->save();

                        $user_income = new Income();
                        $user_income->user_id = $user_data_u2->user_id;
                        $user_income->income_type = 'Reffered Income Level 1';
                        $user_income->income_amount = $package->dbdtprice * .1;
                       $user_income->notes = 'Income genareted from Level 1 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                        $user_income->save();

                    } else {
                        $user_data_update2 = new Account();
                        $user_data_update2->user_id = $level_one_user->id;
                        $user_data_update2->dbdt_balance = $package->dbdtprice * .1;
                        $user_data_update2->withdraw_balance = $package->dbdtprice * .05;
                        $user_data_update2->repurchase_balance = $package->dbdtprice * .05;
                        $user_data_update2->save();
                        
                        $user_income = new Income();
                        $user_income->user_id = $level_one_user->id;
                        $user_income->income_type = 'Reffered Income Level 1';
                        $user_income->income_amount = $package->dbdtprice * .1;
                        $user_income->notes = 'Income genareted from Level 1 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                        $user_income->save();
                    }
                }
                if ($level_one_user->sponcerid != 'sponcerid') {

                    $level_two_user = User::where('myrefferalcode', $level_one_user->sponcerid)->first();
                    if ($level_two_user) {
                        if ($level_two_user->override_level >= 2) {
                            $u_bonus->level2 = $package->dbdtprice * .05;
                            $u_bonus->level2_id = $level_two_user->id;
                            $user_data_u2 = Account::where('user_id', $level_two_user->id)->first();
                    if ($user_data_u2) {
                        $user_data_update2 = Account::find($user_data_u2->id);
                        $user_data_update2->user_id = $user_data_u2->user_id;
                        $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * 0.05);
                        $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice *  0.025);
                        $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice  * 0.025);
                        $user_data_update2->save();

                        $user_income = new Income();
                        $user_income->user_id = $user_data_u2->user_id;
                        $user_income->income_type = 'Reffered Income Level 2';
                        $user_income->income_amount = $package->dbdtprice * .05;
                       $user_income->notes = 'Income genareted from Level 2 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                        $user_income->save();

                    } else {
                        $user_data_update2 = new Account();
                        $user_data_update2->user_id = $level_two_user->id;
                        $user_data_update2->dbdt_balance = $package->dbdtprice * .05;
                        $user_data_update2->withdraw_balance = $package->dbdtprice * .025;
                        $user_data_update2->repurchase_balance = $package->dbdtprice * .025;
                        $user_data_update2->save();


                        $user_income = new Income();
                        $user_income->user_id = $level_two_user->id;
                        $user_income->income_type = 'Reffered Income Level 2';
                        $user_income->income_amount = $package->dbdtprice * .05;
                        $user_income->notes = 'Income genareted from Level 2 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                        $user_income->save();
                    }
                        }
                        if ($level_two_user->sponcerid != 'sponcerid') {

                            $level_three_user = User::where('myrefferalcode', $level_two_user->sponcerid)->first();
                            if ($level_three_user) {
                                if ($level_three_user->override_level >= 3) {
                                    $u_bonus->level3 = $package->dbdtprice * .01;
                                    $u_bonus->level3_id = $level_three_user->id;
                                    $user_data_u2 = Account::where('user_id', $level_three_user->id)->first();
                                    if ($user_data_u2) {
                                        $user_data_update2 = Account::find($user_data_u2->id);
                                        $user_data_update2->user_id = $user_data_u2->user_id;
                                        $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .01);
                                        $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .005);
                                        $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .005);
                                        $user_data_update2->save();

                                        $user_income = new Income();
                        $user_income->user_id = $user_data_u2->user_id;
                        $user_income->income_type = 'Reffered Income Level 3';
                        $user_income->income_amount = $package->dbdtprice * .01;
                       $user_income->notes = 'Income genareted from Level 3 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                        $user_income->save();

                                    } else {
                                        $user_data_update2 = new Account();
                                        $user_data_update2->user_id = $level_three_user->id;
                                        $user_data_update2->dbdt_balance = $package->dbdtprice * .01;
                                        $user_data_update2->withdraw_balance = $package->dbdtprice * .005;
                                        $user_data_update2->repurchase_balance = $package->dbdtprice * .025;
                                        $user_data_update2->save();


                                        $user_income = new Income();
                        $user_income->user_id = $level_three_user->id;
                        $user_income->income_type = 'Reffered Income Level 3';
                        $user_income->income_amount = $package->dbdtprice * .01;
                        $user_income->notes = 'Income genareted from Level 3 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                        $user_income->save();
                                    }
                                }
                                if ($level_three_user->sponcerid != 'sponcerid') {

                                    $level_four_user = User::where('myrefferalcode', $level_three_user->sponcerid)->first();
                                    if ($level_four_user) {
                                        if ($level_four_user->override_level >= 5) {
                                            $u_bonus->level4 = $package->dbdtprice * .01;
                                            $u_bonus->level4_id = $level_four_user->id;
                                            $user_data_u2 = Account::where('user_id', $level_four_user->id)->first();
                                            if ($user_data_u2) {
                                                $user_data_update2 = Account::find($user_data_u2->id);
                                                $user_data_update2->user_id = $user_data_u2->user_id;
                                                $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .01);
                                                $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .005);
                                                $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .005);
                                                $user_data_update2->save();

                                                $user_income = new Income();
                        $user_income->user_id = $user_data_u2->user_id;
                        $user_income->income_type = 'Reffered Income Level 4';
                        $user_income->income_amount = $package->dbdtprice * .01;
                       $user_income->notes = 'Income genareted from Level 4 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                        $user_income->save();

                                            } else {
                                                $user_data_update2 = new Account();
                                                $user_data_update2->user_id = $level_four_user->id;
                                                $user_data_update2->dbdt_balance = $package->dbdtprice * .01;
                                                $user_data_update2->withdraw_balance = $package->dbdtprice * .005;
                                                $user_data_update2->repurchase_balance = $package->dbdtprice * .005;
                                                $user_data_update2->save();

                                                $user_income = new Income();
                                                $user_income->user_id = $level_four_user->id;
                                                $user_income->income_type = 'Reffered Income Level 4';
                                                $user_income->income_amount = $package->dbdtprice * .01;
                                                $user_income->notes = 'Income genareted from Level 4 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                $user_income->save();
                                            }
                                        }
                                        if ($level_four_user->sponcerid != 'sponcerid') {

                                            $level_five_user = User::where('myrefferalcode', $level_four_user->sponcerid)->first();
                                            if ($level_five_user) {
                                                if ($level_five_user->override_level >= 5) {
                                                    $u_bonus->level4 = $package->dbdtprice * .01;
                                                    $u_bonus->level4_id = $level_five_user->id;
                                                    $user_data_u2 = Account::where('user_id', $level_five_user->id)->first();
                                            if ($user_data_u2) {
                                                $user_data_update2 = Account::find($user_data_u2->id);
                                                $user_data_update2->user_id = $user_data_u2->user_id;
                                                $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .01);
                                                $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .005);
                                                $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .005);
                                                $user_data_update2->save();

                                                $user_income = new Income();
                                                $user_income->user_id = $user_data_u2->user_id;
                                                $user_income->income_type = 'Reffered Income Level 5';
                                                $user_income->income_amount = $package->dbdtprice * .01;
                                               $user_income->notes = 'Income genareted from Level 5 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                $user_income->save();

                                            } else {
                                                $user_data_update2 = new Account();
                                                $user_data_update2->user_id = $level_five_user->id;
                                                $user_data_update2->dbdt_balance = $package->dbdtprice * .01;
                                                $user_data_update2->withdraw_balance = $package->dbdtprice * .005;
                                                $user_data_update2->repurchase_balance = $package->dbdtprice * .005;
                                                $user_data_update2->save();

                                                $user_income = new Income();
                                                $user_income->user_id = $level_five_user->id;
                                                $user_income->income_type = 'Reffered Income Level 5';
                                                $user_income->income_amount = $package->dbdtprice * .01;
                                                $user_income->notes = 'Income genareted from Level 5 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                $user_income->save();
                                            }
                                                }
                                                if ($level_five_user->sponcerid != 'sponcerid') {

                                                    $level_six_user = User::where('myrefferalcode', $level_five_user->sponcerid)->first();

                                                    if ($level_six_user) {
                                                        if ($level_six_user->override_level >= 6) {
                                                            $u_bonus->level4 = $package->dbdtprice * .01;
                                                            $u_bonus->level4_id = $level_six_user->id;
                                                            $user_data_u2 = Account::where('user_id', $level_six_user->id)->first();
                                            if ($user_data_u2) {
                                                $user_data_update2 = Account::find($user_data_u2->id);
                                                $user_data_update2->user_id = $user_data_u2->user_id;
                                                $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .01);
                                                $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .005);
                                                $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .005);
                                                $user_data_update2->save();

                                                $user_income = new Income();
                                                $user_income->user_id = $user_data_u2->user_id;
                                                $user_income->income_type = 'Reffered Income Level 6';
                                                $user_income->income_amount = $package->dbdtprice * .01;
                                               $user_income->notes = 'Income genareted from Level 6 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                $user_income->save();

                                            } else {
                                                $user_data_update2 = new Account();
                                                $user_data_update2->user_id = $level_six_user->id;
                                                $user_data_update2->dbdt_balance = $package->dbdtprice * .01;
                                                $user_data_update2->withdraw_balance = $package->dbdtprice * .005;
                                                $user_data_update2->repurchase_balance = $package->dbdtprice * .005;
                                                $user_data_update2->save();

                                                $user_income = new Income();
                                                $user_income->user_id = $level_six_user->id;
                                                $user_income->income_type = 'Reffered Income Level 6';
                                                $user_income->income_amount = $package->dbdtprice * .01;
                                                $user_income->notes = 'Income genareted from Level 6 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                $user_income->save();
                                            }
                                                        }
                                                        if ($level_six_user->sponcerid != 'sponcerid') {
                                                            $level_seven_user = User::where('myrefferalcode', $level_six_user->sponcerid)->first();
                                                            if ($level_seven_user) {
                                                                if ($level_seven_user->override_level >= 7) {
                                                                    $u_bonus->level4 = $package->dbdtprice * .01;
                                                                    $u_bonus->level4_id = $level_seven_user->id;
                                                                    $user_data_u2 = Account::where('user_id', $level_seven_user->id)->first();
                                                                    if ($user_data_u2) {
                                                                        $user_data_update2 = Account::find($user_data_u2->id);
                                                                        $user_data_update2->user_id = $user_data_u2->user_id;
                                                                        $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .01);
                                                                        $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .005);
                                                                        $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .005);
                                                                        $user_data_update2->save();

                                                                        $user_income = new Income();
                                                                        $user_income->user_id = $user_data_u2->user_id;
                                                                        $user_income->income_type = 'Reffered Income Level 7';
                                                                        $user_income->income_amount = $package->dbdtprice * .01;
                                                                       $user_income->notes = 'Income genareted from Level 7 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                                        $user_income->save();

                                                                    } else {
                                                                        $user_data_update2 = new Account();
                                                                        $user_data_update2->user_id = $level_seven_user->id;
                                                                        $user_data_update2->dbdt_balance = $package->dbdtprice * .01;
                                                                        $user_data_update2->withdraw_balance = $package->dbdtprice * .005;
                                                                        $user_data_update2->repurchase_balance = $package->dbdtprice * .005;
                                                                        $user_data_update2->save();
                                                                   
                                                                        $user_income = new Income();
                                                                        $user_income->user_id = $level_seven_user->id;
                                                                        $user_income->income_type = 'Reffered Income Level 7';
                                                                        $user_income->income_amount = $package->dbdtprice * .01;
                                                                        $user_income->notes = 'Income genareted from Level 7 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                                        $user_income->save();
                                                                    }
                                                                }
                                                                // if ($level_seven_user->sponcerid != 'sponcerid') {

                                                                //     $level_eight_user = User::where('myrefferalcode', $level_seven_user->sponcerid)->first();

                                                                //     if ($level_eight_user) {
                                                                //         if ($level_eight_user->override_level >= 10) {
                                                                //             $u_bonus->level4 = $package->dbdtprice * .05;
                                                                //             $u_bonus->level4_id = $level_eight_user->id;
                                                                //             $user_data_u2 = Account::where('user_id', $level_eight_user->id)->first();
                                                                //             if ($user_data_u2) {
                                                                //                 $user_data_update2 = Account::find($user_data_u2->id);
                                                                //                 $user_data_update2->user_id = $user_data_u2->user_id;
                                                                //                 $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .05);
                                                                //                 $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .025);
                                                                //                 $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .025);
                                                                //                 $user_data_update2->save();

                                                                //                 $user_income = new Income();
                                                                //                 $user_income->user_id = $user_data_u2->user_id;
                                                                //                 $user_income->income_type = 'Reffered Income Level 8';
                                                                //                 $user_income->income_amount = $package->dbdtprice *.05;
                                                                //                $user_income->notes = 'Income genareted from Level 8 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                                //                 $user_income->save();
                                                                //             } else {
                                                                //                 $user_data_update2 = new Account();
                                                                //                 $user_data_update2->user_id = $level_eight_user->id;
                                                                //                 $user_data_update2->dbdt_balance = $package->dbdtprice * .05;
                                                                //                 $user_data_update2->withdraw_balance = $package->dbdtprice * .025;
                                                                //                 $user_data_update2->repurchase_balance = $package->dbdtprice * .025;
                                                                //                 $user_data_update2->save();

                                                                //                 $user_income = new Income();
                                                                //         $user_income->user_id = $level_eight_user->id;
                                                                //         $user_income->income_type = 'Reffered Income Level 8';
                                                                //         $user_income->income_amount = $package->dbdtprice * .05;
                                                                //         $user_income->notes = 'Income genareted from Level 8 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                                //         $user_income->save();
                                                                //             }
                                                                //         }
                                                                //         if ($level_eight_user->sponcerid != 'sponcerid') {

                                                                //             $level_nine_user = User::where('myrefferalcode', $level_eight_user->sponcerid)->first();
                                                                //             if ($level_nine_user) {
                                                                //                 if ($level_nine_user->override_level >= 10) {
                                                                //                     $u_bonus->level4 = $package->dbdtprice * .05;
                                                                //                     $u_bonus->level4_id = $level_nine_user->id;
                                                                //                     $user_data_u2 = Account::where('user_id', $level_nine_user->id)->first();
                                                                //             if ($user_data_u2) {
                                                                //                 $user_data_update2 = Account::find($user_data_u2->id);
                                                                //                 $user_data_update2->user_id = $user_data_u2->user_id;
                                                                //                 $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .05);
                                                                //                 $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .025);
                                                                //                 $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .025);
                                                                //                 $user_data_update2->save();

                                                                //                 $user_income = new Income();
                                                                //                 $user_income->user_id = $user_data_u2->user_id;
                                                                //                 $user_income->income_type = 'Reffered Income Level 9';
                                                                //                 $user_income->income_amount = $package->dbdtprice * .05;
                                                                //                $user_income->notes = 'Income genareted from Level 9 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                                //                 $user_income->save();

                                                                //             } else {
                                                                //                 $user_data_update2 = new Account();
                                                                //                 $user_data_update2->user_id = $level_nine_user->id;
                                                                //                 $user_data_update2->dbdt_balance = $package->dbdtprice * .05;
                                                                //                 $user_data_update2->withdraw_balance = $package->dbdtprice * .025;
                                                                //                 $user_data_update2->repurchase_balance = $package->dbdtprice * .025;
                                                                //                 $user_data_update2->save();

                                                                //                 $user_income = new Income();
                                                                //                 $user_income->user_id = $level_nine_user->id;
                                                                //                 $user_income->income_type = 'Reffered Income Level 9';
                                                                //                 $user_income->income_amount = $package->dbdtprice * .05;
                                                                //                 $user_income->notes = 'Income genareted from Level 9 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                                //                 $user_income->save();
                                                                //             }
                                                                //                 }
                                                                //                 if ($level_nine_user->sponcerid != 'sponcerid') {
                                                                //                     $level_ten_user = User::where('myrefferalcode', $level_nine_user->sponcerid)->first();
                                                                //                     if ($level_ten_user) {
                                                                //                         if ($level_ten_user->override_level >= 10) {
                                                                //                             $u_bonus->level4 = $package->dbdtprice * .05;
                                                                //                             $u_bonus->level4_id = $level_ten_user->id;
                                                                //                             $user_data_u2 = Account::where('user_id', $level_ten_user->id)->first();
                                                                //                             if ($user_data_u2) {
                                                                //                                 $user_data_update2 = Account::find($user_data_u2->id);
                                                                //                                 $user_data_update2->user_id = $user_data_u2->user_id;
                                                                //                                 $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .05);
                                                                //                                 $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .025);
                                                                //                                 $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .025);
                                                                //                                 $user_data_update2->save();

                                                                //                                 $user_income = new Income();
                                                                //                                 $user_income->user_id = $user_data_u2->user_id;
                                                                //                                 $user_income->income_type = 'Reffered Income Level 10';
                                                                //                                 $user_income->income_amount = $package->dbdtprice * .05;
                                                                //                                $user_income->notes = 'Income genareted from Level 10 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                                //                                 $user_income->save();

                                                                //                             } else {
                                                                //                                 $user_data_update2 = new Account();
                                                                //                                 $user_data_update2->user_id = $level_ten_user->id;
                                                                //                                 $user_data_update2->dbdt_balance = $package->dbdtprice * .05;
                                                                //                                 $user_data_update2->withdraw_balance = $package->dbdtprice * .025;
                                                                //                                 $user_data_update2->repurchase_balance = $package->dbdtprice * .025;
                                                                //                                 $user_data_update2->save();

                                                                //                                 $user_income = new Income();
                                                                //                 $user_income->user_id = $level_ten_user->id;
                                                                //                 $user_income->income_type = 'Reffered Income Level 10';
                                                                //                 $user_income->income_amount = $package->dbdtprice * .05;
                                                                //                 $user_income->notes = 'Income genareted from Level 10 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                                //                 $user_income->save();
                                                                //                             }
                                                                //                         }
                                                                //                         if ($level_ten_user->sponcerid != 'sponcerid') {
                                                                //                             $level_eleven_user = User::where('myrefferalcode', $level_ten_user->sponcerid)->first();
                                                                //                             if ($level_eleven_user) {
                                                                //                                 if ($level_eleven_user->override_level >= 12) {
                                                                //                                     $u_bonus->level4 = $package->dbdtprice * .05;
                                                                //                                     $u_bonus->level4_id = $level_eleven_user->id;
                                                                //                                     $user_data_u2 = Account::where('user_id', $level_eleven_user->id)->first();
                                                                //                             if ($user_data_u2) {
                                                                //                                 $user_data_update2 = Account::find($user_data_u2->id);
                                                                //                                 $user_data_update2->user_id = $user_data_u2->user_id;
                                                                //                                 $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .05);
                                                                //                                 $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .025);
                                                                //                                 $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .025);
                                                                //                                 $user_data_update2->save();

                                                                //                                 $user_income = new Income();
                                                                //                                 $user_income->user_id = $user_data_u2->user_id;
                                                                //                                 $user_income->income_type = 'Reffered Income Level 11';
                                                                //                                 $user_income->income_amount = $package->dbdtprice * .05;
                                                                //                                $user_income->notes = 'Income genareted from Level 11 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                                //                                 $user_income->save();

                                                                //                             } else {
                                                                //                                 $user_data_update2 = new Account();
                                                                //                                 $user_data_update2->user_id = $level_eleven_user->id;
                                                                //                                 $user_data_update2->dbdt_balance = $package->dbdtprice * .05;
                                                                //                                 $user_data_update2->withdraw_balance = $package->dbdtprice * .025;
                                                                //                                 $user_data_update2->repurchase_balance = $package->dbdtprice * .025;
                                                                //                                 $user_data_update2->save();

                                                                //                                 $user_income = new Income();
                                                                //                 $user_income->user_id = $level_eleven_user->id;
                                                                //                 $user_income->income_type = 'Reffered Income Level 11';
                                                                //                 $user_income->income_amount = $package->dbdtprice * .05;
                                                                //                 $user_income->notes = 'Income genareted from Level 11 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                                //                 $user_income->save();
                                                                //                             }
                                                                //                                 }

                                                                //                                 if ($level_eleven_user->sponcerid != 'sponcerid') {
                                                                //                                     $level_twelve_user = User::where('myrefferalcode', $level_eleven_user->sponcerid)->first();
                                                                //                                     if ($level_twelve_user) {
                                                                //                                         if ($level_twelve_user->override_level >= 12) {
                                                                //                                             $u_bonus->level4 = $package->dbdtprice * .05;
                                                                //                                             $u_bonus->level4_id = $level_twelve_user->id;
                                                                //                                             $user_data_u2 = Account::where('user_id', $level_twelve_user->id)->first();
                                                                //                                             if ($user_data_u2) {
                                                                //                                                 $user_data_update2 = Account::find($user_data_u2->id);
                                                                //                                                 $user_data_update2->user_id = $user_data_u2->user_id;
                                                                //                                                 $user_data_update2->dbdt_balance = ($user_data_u2->dbdt_balance) + ($package->dbdtprice * .05);
                                                                //                                                 $user_data_update2->withdraw_balance = ($user_data_u2->withdraw_balance) +  ($package->dbdtprice * .025);
                                                                //                                                 $user_data_update2->repurchase_balance = ($user_data_u2->repurchase_balance) +  ($package->dbdtprice * .025);
                                                                //                                                 $user_data_update2->save();

                                                                //                                                 $user_income = new Income();
                                                                //                                 $user_income->user_id = $user_data_u2->user_id;
                                                                //                                 $user_income->income_type = 'Reffered Income Level 12';
                                                                //                                 $user_income->income_amount = $package->dbdtprice * .05;
                                                                //                                $user_income->notes = 'Income genareted from Level 12 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                                //                                 $user_income->save();

                                                                //                                             } else {
                                                                //                                                 $user_data_update2 = new Account();
                                                                //                                                 $user_data_update2->user_id = $level_twelve_user->id;
                                                                //                                                 $user_data_update2->dbdt_balance = $package->dbdtprice * .05;
                                                                //                                                 $user_data_update2->withdraw_balance = $package->dbdtprice *  .025;
                                                                //                                                 $user_data_update2->repurchase_balance = $package->dbdtprice * .025;
                                                                //                                                 $user_data_update2->save();

                                                                //                                                 $user_income = new Income();
                                                                //                 $user_income->user_id = $level_twelve_user->id;
                                                                //                 $user_income->income_type = 'Reffered Income Level 12';
                                                                //                 $user_income->income_amount = $package->dbdtprice * .05;
                                                                //                 $user_income->notes = 'Income genareted from Level 12 reffer which Name: '. $main_user->name.'  Email: '. $main_user->email;
                                                                //                 $user_income->save();
                                                                //                                             }
                                                                //                                         }
                                                                //                                     }
                                                                //                                 }
                                                                //                             }
                                                                //                         }
                                                                //                     }
                                                                //                 }
                                                                //             }
                                                                //         }
                                                                //     }
                                                                // }
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

    public function kyc_requests(){
        $kyc_requests = DB::table('users')->where('id_verify_status',2)->orderBy('updated_at', 'desc')->get();

        $show = view('backend.admin.kyc.show')->with('kyc_requests', $kyc_requests);
        return view('backend.admin.layouts.master')->with('content', $show);
    }
    public function all_kyc_requests(){
        $kyc_requests = DB::table('users')->where('id_verify_status',1)->orwhere('id_verify_status',2)->orderBy('updated_at', 'desc')->get();

        $show = view('backend.admin.kyc.all_show')->with('kyc_requests', $kyc_requests);
        return view('backend.admin.layouts.master')->with('content', $show);
    }
    

    public function kyc_details($id){
        $kyc_request = DB::table('users')->where('id',$id)->first();

        $show = view('backend.admin.kyc.details')->with('kyc_request', $kyc_request);
        return view('backend.admin.layouts.master')->with('content', $show);
    }

    public function kyc_accept($id){
        $user_details=User::find($id);

        $user=User::find($id);
        $user->id_verify_status = 1;
        $user->save();

        $name=$user_details->name;
        $email=$user_details->email;
        $details = [
            'title' => 'KYC Verification Successfully Done!!',
            'name' =>$name,
            'email' =>$email,
        ];
       
        Mail::to($user_details->email)->send(new \App\Mail\AcceptKyc($details));


        return redirect('/admin/pending/kyc/request')->with('status_ok', 'Denied ');
    }

    public function kyc_reject(Request $request){
        $user_details=User::find($request->user_id);
        
        $user=User::find($request->user_id);
        $user->document_type = NULL;
        $user->issued_by_country = NULL;
        $user->document_number = NULL;
        $user->selfie = NULL;
        $user->address_proof = NULL;
        $user->nid_photo_front = NULL;
        $user->	nid_photo_back = NULL;
        $user->	passport_photo = NULL;
        $user->id_verify_status = 0;
        $user->save();


        $reason= $request->reject_reason;
        $name=$user_details->name;
        $email=$user_details->email;
        $details = [
            'title' => 'KYC Verification Failed!!',
            'reason' =>$reason,
            'name' =>$name,
            'email' =>$email,
        ];
       
        Mail::to($user_details->email)->send(new \App\Mail\RejectKyc($details));



         return redirect('/admin/pending/kyc/request')->with('status_not', 'Denied ');
    }
}
