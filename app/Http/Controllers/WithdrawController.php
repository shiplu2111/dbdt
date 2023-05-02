<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentMethod;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\WithdrawOtp;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = view('backend.user.withdraw.new');
        return view('backend.user.layouts.master')->with('content',$show);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdraw(Request $request)
    {
        // return $request->all();
        $request->session()->put('account_id', $request->account_id);
        $request->session()->put('withdraw_ammount', $request->withdraw_ammount);
        $request->session()->put('otp_code', rand(1000000, 9999999));


        $code= $request->session()->get('otp_code');
        $details = [
            'title' => 'Your One Time Code',
            'code' =>$code,
        ];

    
        Mail::to(Auth::user()->email)->send(new \App\Mail\WithdrawOtp($details));
        $show = view('backend.user.withdraw.otp_verify')->with('code',$code);
        return view('backend.user.layouts.master')->with('content',$show);

       
        return response()->json($withdraw_request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function otpVerify(Request $request)
    {

       
        if($request->otp==$request->session()->get('otp_code')){
            $withdraw_settings = DB::table('withdraw_settings')
        ->latest()
        ->first();

        $payment_method = DB::table('payment_methods')
        ->where('id',$request->session()->get('account_id'))
        ->first();
        $method_name = DB::table('methods')
        ->where('id',$payment_method->method_id)
        ->first();

         $b = PaymentMethod::find($request->session()->get('account_id'));
        $withdraw_request= New Withdraw();
        $withdraw_request->user_id = Auth::user()->id;
        $withdraw_request->withdraw_amount = $request->session()->get('withdraw_ammount');
        $withdraw_request->withdraw_commission = $request->session()->get('withdraw_ammount')/100*$withdraw_settings->withdraw_commission;
        $withdraw_request->withdraw_tax = $request->session()->get('withdraw_ammount')/100*$withdraw_settings->withdraw_tax;
        $withdraw_request->withdraw_charge = $withdraw_settings->withdraw_charge;
         $withdraw_request->withdraw_method = $method_name->method_name;
         $withdraw_request->withdraw_method_address = $payment_method->method_number;
        $withdraw_request->withdraw_status = '0';
        $withdraw_request->save();
        $account_details =DB::table('accounts')->where('user_id', Auth::user()->id)->first();

        $account_update = Account::find($account_details->id);
        $account_update->dbdt_balance = $account_details->dbdt_balance-$request->session()->get('withdraw_ammount');
        $account_update->withdraw_balance = $account_details->withdraw_balance-$request->session()->get('withdraw_ammount');

        $account_update->save();

        $admin_data = array(
            "result" => "New Withdraw Request",
            "user_id" =>Auth::user()->id,
            'url'=>'/admin/withdraw/details/'.$withdraw_request->id,
            );
        $admins= DB::table('users')->where('role','admin' )->get();
        foreach($admins as $item){
         $admin = User::find($item->id);

    $admin->notify(new AdminNotification($admin_data));
    }
        return redirect('user/all-withdraws')->with('otp_success', 'Denied ');

        }
        else{
            return redirect('user/new-withdraw')->with('otp_deny', 'Denied ');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $withdraw_lists= DB::table('withdraws')->where('user_id', Auth::user()->id)->get();
        $show = view('backend.user.withdraw.show')->with('withdraw_lists',$withdraw_lists);
        return view('backend.user.layouts.master')->with('content',$show);
    }
    public function withdraw_list()
    {
        $withdraw_lists= DB::table('withdraws')->orderBy('withdraw_status')->get();
        $show = view('backend.admin.withdraw.show')->with('withdraw_lists',$withdraw_lists);
        return view('backend.admin.layouts.master')->with('content',$show);
    }
    public function withdraw_details($id)
    {
        $withdraw_details= Withdraw::find($id);
        $show = view('backend.admin.withdraw.details')->with('withdraw_details',$withdraw_details);
        return view('backend.admin.layouts.master')->with('content',$show);
    }

    public function user_withdraw_details($id)
    {
        $withdraw_details= Withdraw::find($id);
        $show = view('backend.user.withdraw.details')->with('withdraw_details',$withdraw_details);
        return view('backend.user.layouts.master')->with('content',$show);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request)
    {
        
        $withdraw = Withdraw::find($request->hash_id);
        $withdraw->transaction_hash = $request->hash;
        $withdraw->withdraw_status = 1;
        $withdraw->save();

        $data = array(
            "result" => "Withdraw Request Accepted",
            'url'=>'/user/withdraw/details/'.$withdraw->id,
            );
            
            $user= User::find($withdraw->user_id);
            $user->notify(new UserNotification($data));
        
        return redirect()->back()->with('success', 'Accepted ');
        
    }
    public function deny($id)
    {
        $a= Withdraw::find($id);
        $account_id= DB::table('accounts')->where('user_id', $a->user_id)->first();
        // $b=Account::find($a->user_id);
        // $total= $a->withdraw_amount + $b->withdraw_balance;
        // return $account_id;
        // exit();
        $account_update = Account::find($account_id->id);
        $account_update->withdraw_balance = $a->withdraw_amount + $account_id->withdraw_balance;
        $account_update->dbdt_balance = $a->withdraw_amount + $account_id->dbdt_balance;
        $account_update->save();

        
        $package = Withdraw::find($id);
        $package->withdraw_status = 2;
        $package->save();

                $data = array(
                "result" => "Withdraw Request Rejected",
                'url'=>'/user/withdraw/details/'.$package->id,
                );
                
                $user= User::find($a->user_id);
                $user->notify(new UserNotification($data));

    
        return redirect()->back()->with('success', 'Denied');
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdraw $withdraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdraw $withdraw)
    {
        //
    }
}
