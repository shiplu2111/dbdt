<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;
use App\Models\User;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = view('backend.user.deposit.create');
        return view('backend.user.layouts.master')->with('content', $show);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $deposit_store= New Deposit();
        $deposit_store->user_id =  Auth::user()->id;
        $deposit_store->amount = $request->amount;
        $deposit_store->type = $request->type;
        $deposit_store->paid_by = $request->paid_by;
        $deposit_store->hash = $request->hash;
        $deposit_store->status = '0';
        $deposit_store->save();

        $admin_data = array(
            "result" => "New Deposit Request",
            "user_id" =>Auth::user()->id,
            'url'=>'/admin/deposit/details/'.$deposit_store->id,
            );

            $admins= DB::table('users')->where('role','admin' )->get();
                foreach($admins as $item){
                $admin = User::find($item->id);
                $admin->notify(new AdminNotification($admin_data));
        }

        return redirect('/user/all-deposit')->with('status', 'Profile updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $deposits = DB::table('deposits')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
       
        $show = view('backend.user.deposit.show')->with('deposits', $deposits);
        return view('backend.user.layouts.master')->with('content', $show);
    }

public function depositShow(){
    $deposits = DB::table('deposits')->orderBy('id', 'DESC')->get();
       
        $show = view('backend.admin.deposit.show')->with('deposits', $deposits);
        return view('backend.admin.layouts.master')->with('content', $show);
}
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function deny($id)
    {
        $deposit = Deposit::find($id);
        $deposit->status = 2;
        $deposit->save();
        $data = array(
            "result" => "Deposit Request Rejected",
            'url'=>'/user/deposit/details/'.$deposit->id,

        );
        $user = User::find($deposit->user_id);
        $user->notify(new UserNotification($data));



        return redirect()->back()->with('status_deny', 'Denied ');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $deposit = Deposit::find($id);
        $deposit->status = 1;
        $deposit->save();

        $a= Deposit::find($id);
        $account_id= DB::table('accounts')->where('user_id', $a->user_id)->first();

        $account_update = Account::find($account_id->id);
        if($a->type=='1'){
            $account_update->withdraw_balance = $a->amount + $account_id->withdraw_balance;
        }
        else{
            $account_update->repurchase_balance = $a->amount + $account_id->repurchase_balance;
        }
        $account_update->dbdt_balance = $a->amount + $account_id->dbdt_balance;
        $account_update->save();

        $data = array(
            "result" => "Deposit Request Accepted",
            'url'=>'/user/deposit/details/'.$deposit->id,
        );
        $user = User::find($deposit->user_id);
        $user->notify(new UserNotification($data));
       
        return redirect()->back()->with('status_success', 'Denied ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function admindetails($id)
    {
        $deposit_details= Deposit::find($id);
        $show = view('backend.admin.deposit.details')->with('deposit_details',$deposit_details);
        return view('backend.admin.layouts.master')->with('content',$show);
    }

    public function userdetails($id)
    {
        $deposit_details= Deposit::find($id);
        $show = view('backend.user.deposit.details')->with('deposit_details',$deposit_details);
        return view('backend.user.layouts.master')->with('content',$show);
    }
}
