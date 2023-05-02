<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Account;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCredit(){
        $credits = DB::table('credits')->get();
        $show = view('backend.admin.cradit.add')->with('credits',$credits);
        return view('backend.admin.layouts.master')->with('content',$show);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $user=DB::table('users')
        ->where('email', $request->email)
        ->first();
        $account_id=DB::table('accounts')
        ->where('user_id', $user->id)
        ->first();


        $add_credit= new Credit();
        $add_credit->user_id= $user->id;
        $add_credit->email= $request->email;
        $add_credit->dbdt_amount= $request->dbdt_amount;
        $add_credit->credit_type= $request->credit_type;
        $add_credit->status="Success";
        $add_credit->reason= $request->reason;
        $add_credit->save();

        $add_credit_account= Account::find($account_id->id);
        $add_credit_account->dbdt_balance =$account_id->dbdt_balance+ $request->dbdt_amount;
        if($request->credit_type==='Withdraw Balance'){
            $add_credit_account->withdraw_balance =$account_id->withdraw_balance + $request->dbdt_amount;
        }
        elseif($request->credit_type==='Stake Balance'){
            $add_credit_account->repurchase_balance =$account_id->repurchase_balance + $request->dbdt_amount;

        }
        $add_credit_account->save();

       return response()->json($add_credit, 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function show(Credit $credit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function edit(Credit $credit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Credit $credit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Credit $credit)
    {
        //
    }
}
