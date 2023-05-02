<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\User;
use App\Models\Account;
use App\Models\FridgeDbdtDist;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;
use App\Models\CompanyAccount;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
         $package = DB::table('packages')->where('id', $id)->first();

         session()->put('user_id', Auth::user()->id);
         session()->put('package_id', $package->id);

         $show = view('backend.user.package.confirmpackage');
         return view('backend.user.layouts.master')->with('content', $show);
    }
    public function upgrade($id)
    {
         $package = DB::table('packages')->where('id', $id)->first();

         session()->put('upgrade_user_id', Auth::user()->id);
         session()->put('upgrade_package_id', $package->id);

         $show = view('backend.user.package.confirm_package_upgrade');
         return view('backend.user.layouts.master')->with('content', $show);
    }


    public function payment(Request $request)
    {

        $validated = $request->validate([
            'pay_code' => 'required|unique:pack_invoices|max:255',
        ],
        [ 'pay_code.unique' => 'You Can Use Each Transection Hash Single Time.']);

        $package_id = session()->get('package_id');
        $package = DB::table('packages')->where('id', $package_id)->first();

        $order= New Order();
        $order->user_id = Auth::user()->id;
        $order->package_id = $package_id;
        $order->price = $package->usdtprice;
        $order->tax = $package->usdtprice/100*3;
        $order->subtotal = $package->usdtprice+$package->usdtprice/100*3;
        $order->discount = 0;
        $order->pay_code = $request->pay_code;
        $order->status = 0;
        $order->type = 1;
        $order->save();
        // $company=new CompanyAccount();
        // $company->reason = 'New Account Activation Of '.$user->name.' Email: '.$user->email;
        // $company->dbdt_amount = ($package->dbdtprice*3)/100;
        // $company->save();

        $admin_data = array(
            "result" => "New Package Active Request",
            "user_id" =>Auth::user()->id,
            'url'=>'/admin/package/deposit/pending/',
            );
        $admins= DB::table('users')->where('role','admin' )->get();
        foreach($admins as $item){
         $admin = User::find($item->id);

    $admin->notify(new AdminNotification($admin_data));
    }
        return redirect('/user/my-packages')->with('message', 'We Have Received Your Transection Code. Be Patent And Please Wait For Review ');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        $orders = DB::table('pack_invoices')->where('status', 1)->get();
        foreach($orders as $item){
            $order= New Order();
            $order->id = $item->id;
            $order->user_id = $item->user_id;
            $order->package_id = $item->package_id;
            $order->price = $item->subtotal-$item->tax;
            $order->subtotal = $item->subtotal;
            $order->pay_code = $item->pay_code;
            $order->discount = 0;
            $order->status = 1;
            $order->save();

        }
        return  redirect('/');
    }



    public function upgradePayment(Request $request)
    {

        $validated = $request->validate([
            'pay_code' => 'required|unique:pack_invoices|max:255',
        ],
        [ 'pay_code.unique' => 'You Can Use Each Transection Hash Single Time.']);

        $package_id = session()->get('upgrade_package_id');
        $package = DB::table('packages')->where('id', $package_id)->first();

        $order= New Order();
        $order->user_id = Auth::user()->id;
        $order->package_id = $package_id;
        $order->price = $package->usdtprice;
        $order->tax = $package->usdtprice/100*3;
        $order->subtotal = $package->usdtprice+$package->usdtprice/100*3;
        $order->discount = 0;
        $order->pay_code = $request->pay_code;
        $order->status = 0;
        $order->type = 2;
        $order->save();

        $admin_data = array(
            "result" => "New Package Upgrade Request",
            "user_id" =>Auth::user()->id,
            'url'=>'/admin/package-upgrade/deposit/pending/',
            );
        $admins= DB::table('users')->where('role','admin' )->get();
        foreach($admins as $item){
         $admin = User::find($item->id);

    $admin->notify(new AdminNotification($admin_data));
    }
        return redirect('/user/my-packages')->with('message', 'We Have Received Your Transection Code. Be Patent And Please Wait For Review ');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function upgrade_accept($id){

        $order = DB::table('orders')->where('id',$id)->first();
        $user = DB::table('users')->where('id',$order->user_id)->first();
        $package = DB::table('packages')->where('id',$order->package_id)->first();
        $account = DB::table('accounts')->where('user_id',$order->user_id)->first();

        $user_data_update =Account::find($account->id);
        $user_data_update->dbdt_balance = $user_data_update->dbdt_balance+$package->dbdtprice;
        $user_data_update->withdraw_balance =$user_data_update->withdraw_balance+ $package->withdraw_dbdt;
        $user_data_update->repurchase_balance =$user_data_update->repurchase_balance + $package->staking_dbdt;
        $user_data_update->frozen_balance =$user_data_update->frozen_balance+ ($package->frozen_dbdt*2);
        $user_data_update->withdraw_base =$user_data_update->withdraw_base+ $package->withdraw_dbdt;
        $user_data_update->repurchase_base = $package->staking_dbdt;
        $user_data_update->save();



            // $fridge_dbdt_dist = new FridgeDbdtDist();
            // $fridge_dbdt_dist->user_id = $user->id;
            // $fridge_dbdt_dist->package_id = $order->package_id;
            // $fridge_dbdt_dist->order_id = $order->id;
            // $fridge_dbdt_dist->dbdt_amount = $package->frozen_dbdt;
            // $fridge_dbdt_dist->period = $package->bonus_period;
            // $fridge_dbdt_dist->dbdt_amount_per_period = ($package->frozen_dbdt)/($package->bonus_period);
            // $fridge_dbdt_dist->distribute_dbdt_amount = 0;
            // $fridge_dbdt_dist->status = 0;
            // $fridge_dbdt_dist->status->save();



        if($user->override_level<$package->overridelevel){
            $user_data=User::find($user->id);
            $user_data->override_level= $package->overridelevel;
            $user_data->status= 1;
            $user_data->save();
        }


        $company=new CompanyAccount();
        $company->reason = 'Account Upgrade Activation Of '.$user->name.' Email: '.$user->email;
        $company->dbdt_amount = $package->usdtprice/100*3;
        $company->save();

        $order_data=Order::find($id);
            $order_data->status= 1;
            $order_data->save();

            if(0<$package->frozen_dbdt){
                $fridge_dbdt_dist = new FridgeDbdtDist();
            $fridge_dbdt_dist->user_id = $user->id;
            $fridge_dbdt_dist->package_id = $order->package_id;
            $fridge_dbdt_dist->order_id = $order->id;
            $fridge_dbdt_dist->dbdt_amount = $package->frozen_dbdt*2;
            $fridge_dbdt_dist->period = $package->bonus_period;
            $fridge_dbdt_dist->dbdt_amount_per_period = ($package->frozen_dbdt*2)/($package->bonus_period);
            $fridge_dbdt_dist->distribute_dbdt_amount = 0;
            $fridge_dbdt_dist->status = 0;
            $fridge_dbdt_dist->save();
            }
        return response()->json();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function upgradePaymentDBDT()
    {
        $package_id = session()->get('upgrade_package_id');

        $package = DB::table('packages')->where('id', $package_id)->first();

        $subtotel=$package->dbdtprice+$package->dbdtprice/100*3+$package->dbdtprice/100*5;

        $randomString = Str::random(10).'_(Payment_Through_DBDT)_'.Str::random(10);
        //  return $subtotel;

        $order= New Order();
        $order->user_id = Auth::user()->id;
        $order->package_id = $package_id;
        $order->price = $package->usdtprice;
        $order->tax = $package->usdtprice/100*3;
        $order->subtotal = $package->usdtprice+$package->usdtprice/100*3+$package->usdtprice/100*5;
        $order->discount = 0;
        $order->pay_code = $randomString;
        $order->status = 1;
        $order->type = 3;
        $order->save();

        $user = DB::table('users')->where('id',Auth::user()->id)->first();
        $package = DB::table('packages')->where('id',$package_id)->first();
        $account = DB::table('accounts')->where('user_id',Auth::user()->id)->first();

        $user_data_update =Account::find($account->id);
        $user_data_update->dbdt_balance = $user_data_update->dbdt_balance+$package->dbdtprice- $subtotel;
        $user_data_update->withdraw_balance =$user_data_update->withdraw_balance+ $package->withdraw_dbdt-$subtotel;
        $user_data_update->repurchase_balance =$user_data_update->repurchase_balance + $package->staking_dbdt;
        $user_data_update->frozen_balance =$user_data_update->frozen_balance+ $package->frozen_dbdt;
        $user_data_update->withdraw_base =$user_data_update->withdraw_base+ $package->withdraw_dbdt;
        $user_data_update->repurchase_base = $package->staking_dbdt;
        $user_data_update->save();

        $company=new CompanyAccount();
        $company->reason = 'Account Upgrade By DBDT Of '.$user->name.' Email: '.$user->email;
        $company->dbdt_amount = $package->usdtprice/100*3+$package->usdtprice/100*5;
        $company->save();


        if(0<$package->frozen_dbdt){
            $fridge_dbdt_dist = new FridgeDbdtDist();
        $fridge_dbdt_dist->user_id = $user->id;
        $fridge_dbdt_dist->package_id = $package_id;
        $fridge_dbdt_dist->order_id = $order->id;
        $fridge_dbdt_dist->dbdt_amount = $package->frozen_dbdt;
        $fridge_dbdt_dist->period = $package->bonus_period;
        $fridge_dbdt_dist->dbdt_amount_per_period = ($package->frozen_dbdt)/($package->bonus_period);
        $fridge_dbdt_dist->distribute_dbdt_amount = 0;
        $fridge_dbdt_dist->status = 0;
        $fridge_dbdt_dist->save();
        }

        return redirect('/user/my-packages')->with('upgrade_success', 'upgrade_success ');;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}