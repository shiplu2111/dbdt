<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Account;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = view('backend.user.transfer.create');
        return view('backend.user.layouts.master')->with('content', $show);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function transfer(Request $request)
    {

        // return $request->all();

        $reciver= DB::table('users')->where('email', $request->user_name)->first();
        
        if($reciver){
        $reciver_account = DB::table('accounts')->where('user_id', $reciver->id)->first();
        if($reciver_account){
         $b = Account::find($reciver_account->id);
         $b->dbdt_balance = $reciver_account->dbdt_balance+$request->transfer_amount-10;
         $b->withdraw_balance = $reciver_account->withdraw_balance+$request->transfer_amount-10;
         $b->save();

        $transfer_request= New Transfer();
        $transfer_request->sender_id = Auth::user()->id;
        $transfer_request->receiver_id = $reciver->id;
        $transfer_request->transfer_charge = '10';
        $transfer_request->transfer_total_amount = $request->transfer_amount;
        $transfer_request->receive_dbdt = $request->transfer_amount-10;
        $transfer_request->save();

        $account_details =DB::table('accounts')->where('user_id', Auth::user()->id)->first();
        $account_update = Account::find($account_details->id);
        $account_update->dbdt_balance = $account_details->dbdt_balance-$request->transfer_amount;
        $account_update->withdraw_balance = $account_details->withdraw_balance-$request->transfer_amount;

        $account_update->save();
        return redirect()->back()->with('status_success', 'Denied ');
    }
    else{
        return redirect()->back()->with('status_denyed', 'Denied ');
    }

}
    else {
        return redirect()->back()->with('status_deny', 'Denied ');
    }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $deposits = DB::table('transfers')->where('sender_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
       
        $show = view('backend.user.transfer.show')->with('deposits', $deposits);
        return view('backend.user.layouts.master')->with('content', $show);
    }
    public function show_received()
    {
        $deposits = DB::table('transfers')->where('receiver_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
       
        $show = view('backend.user.transfer.show_received')->with('deposits', $deposits);
        return view('backend.user.layouts.master')->with('content', $show);
    }

    
    public function adminShow()
    {
        $deposits = DB::table('transfers')->orderBy('id', 'DESC')->get();
       
        $show = view('backend.admin.transfer.show')->with('deposits', $deposits);
        return view('backend.admin.layouts.master')->with('content', $show);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
}
