<?php

namespace App\Http\Controllers;

use App\Models\Stake;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\MyTestMail;
use App\Mail\stakeDone;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;

class StakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_index()
    {
        $my_stacks=DB::table('stakes')->orderBy('created_at', 'DESC')->get();
       
        $show = view('backend.admin.stake.user.show')->with('my_stacks', $my_stacks);
        return view('backend.admin.layouts.master')->with('content', $show);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $stake_detail=Stake::find($id);
        $show = view('backend.admin.stake.user.detail')->with('stake_detail', $stake_detail);
        return view('backend.admin.layouts.master')->with('content', $show);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stake_method= DB::table('stake_methods')->where('id', $request->stake_method)->first();
       if($stake_method->benifit_type === 'Yearly'){
        $benefit_type=2;
       }
       else{
        $benefit_type=1;
       }
        
        $account_data= DB::table('accounts')->where('user_id', Auth::user()->id)->first();
        if($account_data){
            if($account_data->repurchase_balance >= $request->dbdt_amount){

            
        $method = new Stake();
        $method->user_id = Auth::user()->id;
        $method->name = $request->name;
        $method->email = $request->email;
        $method->phone = $request->phone;
        $method->dbdt_wallet_address = $request->dbdt_wallet_address;
        $method->usdt_wallet_address = $request->usdt_wallet_address;
        $method->dbdt_amount = $request->dbdt_amount;
        $method->stake_method = $request->stake_method;
        $method->instruction = $request->instruction;
        $method->end_date = Carbon::now()->addMonths($stake_method->period);
        $method->start_date = Carbon::now();
        $method->benefit_type = $benefit_type;
        $method->status = 0;
        $method->save();
    }
    else{
         return redirect()->back()->with('status_denyed', 'Denied ');
    }

        $account_update = Account::find($account_data->id);
        $account_update->dbdt_balance = $account_data->dbdt_balance-$request->dbdt_amount;
        $account_update->repurchase_balance = $account_data->repurchase_balance-$request->dbdt_amount;

        $account_update->save();


        $admin_data = array(
            "result" => "New Staking Request",
            "user_id" =>Auth::user()->id,
            'url'=>'/admin/stake/details/'.$method->id,
            );
        $admins= DB::table('users')->where('role','admin' )->get();
        foreach($admins as $item){
         $admin = User::find($item->id);
         $admin->notify(new AdminNotification($admin_data));
        }


        $details = [
            'title' => 'New Staking request from '.$request->name,
            'email' => $request->email,
            'staking_amount' => $request->dbdt_amount,
            'id' => Auth::user()->id,

        ];


       
        Mail::to('dbdtofficial@gmail.com')->send(new \App\Mail\MyTestMail($details));
    }
    else{
        return redirect()->back()->with('status_denyed', 'Denied ');
    }

    return redirect('/user/my-stack/list')->with('status_ok', 'ok ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stake  $stake
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $my_stacks=DB::table('stakes')->where('user_id', Auth::user()->id)->get();
        $show = view('backend.user.stack.show')->with('my_stacks', $my_stacks);
        return view('backend.user.layouts.master')->with('content', $show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stake  $stake
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $stake_detail=Stake::find($id);
        $stake_detail->status = 1;
        $stake_detail->save();
        $data = array(
            "result" => "Staking Request Accepted",
            'url'=>'/user/my-stack/list/',
            );
            
            $user= User::find($stake_detail->user_id);
            $user->notify(new UserNotification($data));
        return redirect('/admin/stakes')->with('stake_yes', 'ok ');

       

    }
    public function reject($id)
    {
        $stake=Stake::find($id);

        $account_data= DB::table('accounts')->where('user_id',$stake->user_id)->first();

        $account_update = Account::find($account_data->id);
        $account_update->dbdt_balance = $account_data->dbdt_balance+$stake->dbdt_amount;
        $account_update->repurchase_balance = $account_data->repurchase_balance+$stake->dbdt_amount;

        $account_update->save();

        $stake_detail=Stake::find($id);
        $stake_detail->status = 3;
        $stake_detail->save();
        $data = array(
            "result" => "Staking Request Rejected",
            'url'=>'/user/my-stack/list/',
            );
            
            $user= User::find($stake->user_id);
            $user->notify(new UserNotification($data));
        return redirect('/admin/stakes')->with('stake_no', 'ok ');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stake  $stake
     * @return \Illuminate\Http\Response
     */
    public function cancelStake($id)
    {
        $stake_detail=Stake::find($id);
        $user= User::find($stake_detail->user_id);
        $account_data= DB::table('accounts')->where('user_id',$stake_detail->user_id)->first();


        if($stake_detail->status==1){
            
        $stake_update=Stake::find($id);
        $stake_update->status = 4;
        $stake_update->save();

        $account= Account::find($account_data->id);
        $account->dbdt_balance = $account_data->dbdt_balance+$stake_detail->dbdt_amount;
        $account->withdraw_balance = $account_data->withdraw_balance+$stake_detail->dbdt_amount;
        $account->save();

        $admin_data = array(
            "result" => "Stake cancelled by ".Auth::user()->name,
            "user_id" =>Auth::user()->id,
            'url'=>'/admin/stake/details/'.$id,
            );
        $admins= DB::table('users')->where('role','admin' )->get();
        foreach($admins as $item){
         $admin = User::find($item->id);
         $admin->notify(new AdminNotification($admin_data));
        }
        return response()->json();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stake  $stake
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stake $stake)
    {
        //
    }
}



