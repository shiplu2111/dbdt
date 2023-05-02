<?php

namespace App\Http\Controllers;

use App\Models\Swap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Account;


class SwapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_data = DB::table('accounts')->where('user_id', Auth::user()->id)->first();
        $swap_data = DB::table('swaps')->where('user_id', Auth::user()->id)->orderByDesc('id')->paginate(5);
        // return $account_data;
        $show = view('backend.user.swap.show')->with('account_data',$account_data)->with('swap_data',$swap_data);
        return view('backend.user.layouts.master')->with('content',$show);
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
        $account=DB::table('accounts')->where('user_id', Auth::user()->id)->first();

        $swap=new Swap();
        $swap->user_id =  Auth::user()->id;
        $swap->prev_withdraw = $account->withdraw_balance;
        $swap->prev_staking = $account->repurchase_balance;
        $swap->amount = $request->amount;
        $swap->save();

        $account_data = Account::find($account->id);
        $account_data->withdraw_balance =$account_data->withdraw_balance-$request->amount;
        $account_data->repurchase_balance =$account_data->repurchase_balance+$request->amount;
        $account_data->save();

         return redirect()->back()->with('status', 'Profile updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Swap  $swap
     * @return \Illuminate\Http\Response
     */
    public function show(Swap $swap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Swap  $swap
     * @return \Illuminate\Http\Response
     */
    public function edit(Swap $swap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Swap  $swap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Swap $swap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Swap  $swap
     * @return \Illuminate\Http\Response
     */
    public function destroy(Swap $swap)
    {
        //
    }
}
