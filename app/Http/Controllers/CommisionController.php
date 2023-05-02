<?php

namespace App\Http\Controllers;

use App\Models\Commision;
use App\Models\Account;
use App\Models\Income;
use App\Models\User;
use App\Models\Order;
use App\Models\FridgeDbdtDist;
use App\Models\CompanyAccount;
use App\Models\Leaderboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;

class CommisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $commisions = DB::table('commisions')->orderBy('level')->get();
        $total_level = DB::table('commisions')->count();


        // $show = view('backend.user.package.my_packages')->with('commisions',$commisions);
        $show = view('backend.admin.commision.show')->with('commisions',$commisions)->with('total_level',$total_level);
        return view('backend.admin.layouts.master')->with('content',$show);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check()
    {
        $package = DB::table('commisions')->where('level',$id)->first();
        return response()->json($package);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'level' =>  ['required',  'unique:commisions'],
            'commision' => ['required'],
            'status' => ['required'],
        ]);


        $package= New Commision();
        $package->level = $request->level;
        $package->commision = $request->commision;
        $package->status = $request->status;
        $package->save();
        return response()->json($package);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commision  $commision
     * @return \Illuminate\Http\Response
     */
    public function getValue($id)
    {
        $commision = Commision::find($id);

        return response()->json($commision);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commision  $commision
     * @return \Illuminate\Http\Response
     */
    public function deposit_accept($id)
    {

        $order = DB::table('orders')->where('id',$id)->first();
        $user = DB::table('users')->where('id',$order->user_id)->first();
        $package = DB::table('packages')->where('id',$order->package_id)->first();
        $ref_by = DB::table('users')->where('myrefferalcode',$user->sponcerid)->first();

        $user_data_update = new Account();
        $user_data_update->user_id = $user->id;
        $user_data_update->dbdt_balance = $package->dbdtprice;
        $user_data_update->withdraw_balance = $package->withdraw_dbdt;
        $user_data_update->repurchase_balance = $package->staking_dbdt;
        $user_data_update->frozen_balance = $package->frozen_dbdt*2;
        $user_data_update->withdraw_base = $package->withdraw_dbdt;
        $user_data_update->repurchase_base = $package->staking_dbdt;
        $user_data_update->save();


        $company=new CompanyAccount();
        $company->reason = 'New Account Activation Of '.$user->name.' Email: '.$user->email;
        $company->dbdt_amount = ($package->dbdtprice*3)/100;
        $company->save();



        if($package->frozen_dbdt>=1){
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

        $commisions = DB::table('commisions')->orderBy('level')->where('status','Active')->get();
        $reffred_by = DB::table('users')->where('myrefferalcode',$user->sponcerid)->first();
        $i=1;
        foreach ($commisions as $item) {


            $user_account=  DB::table('accounts')->where('user_id',$reffred_by->id)->first();
            $user_account_update = Account::find($user_account->id);
            $user_account_update->dbdt_balance = ($user_account_update->dbdt_balance) + $package->dbdtprice*$item->commision/100;
            $user_account_update->withdraw_balance = ($user_account_update->withdraw_balance) +   $package->dbdtprice*$item->commision/200;
            $user_account_update->repurchase_balance = ($user_account_update->repurchase_balance) +   $package->dbdtprice*$item->commision/200;
            $user_account_update->save();


            $user_income = new Income();
            $user_income->user_id = $reffred_by->id;
            $user_income->income_type = 'Reffered Income Level '.$i;
            $user_income->income_amount = $user_account_update->withdraw_balance + $package->dbdtprice*$item->commision/100;
            $user_income->notes = 'Income genareted from Level '.$i. 'reffer which Name: '. $user->name. '  Email: '. $user->email;
            $user_income->save();
            $income = $user_account_update->withdraw_balance + $package->dbdtprice*$item->commision/200;

            $data = array(
                "result" => 'Reffered Income Received '.$income.' DBDT',
                'url'=>'/',
                );

                $notify_user= User::find($reffred_by->id);
                $notify_user->notify(new UserNotification($data));


        $i++;
            $reffred_by = DB::table('users')->where('myrefferalcode',$reffred_by->sponcerid)->first();
        }

        $status= Order::find($order->id);
        $status->status =1;
        $status->save();

        $status= User::find($order->user_id);
        $status->status =1;
        $status->save();
        // Leaderboard

        $leaderboard = new Leaderboard();
            $leaderboard->user_id = $ref_by->id;
            $leaderboard->reffered_id = $user->id;
            $leaderboard->package_id = $order->package_id;
            $leaderboard->order_id = $order->id;
            $leaderboard->dbdt_amount = $package->dbdtprice;
            $leaderboard->bonus_amount = $package->dbdtprice*3/100;
            $leaderboard->status = 1;
           $leaderboard->save();
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commision  $commision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([

            'level' =>  ['required',  'unique:commisions'],
            'commision' => ['required'],
            'status' => ['required'],
        ]);

        $commision = Commision::find($request->commisionid);
        $commision->level = $request->level;
        $commision->commision = $request->commision;
        $commision->status = $request->status;
        $commision->save();
        return response()->json($commision);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commision  $commision
     * @return \Illuminate\Http\Response
     */
  public function distroy($id)
    {
        $package = Commision::find($id);
 		$package->delete();
       return response()->json(['success'=>'Commision has been deleted']);
    }
}