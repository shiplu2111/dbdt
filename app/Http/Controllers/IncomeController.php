<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\Stake;
use App\Models\Account;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\MyTestMail;
use App\Mail\stakeDone;
class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes=DB::table('incomes')->where('user_id', Auth::user()->id)->get();
        $total_income=DB::table('incomes')->where('user_id', Auth::user()->id)->sum('income_amount');

        
        $show = view('backend.user.income.show')->with('incomes', $incomes)->with('total_income', $total_income);
        return view('backend.user.layouts.master')->with('content', $show);
    }

    public function user_incomes()
    {
        $incomes=DB::table('incomes')
        ->orderByRaw('created_at DESC')
        ->get();
        $total_income=DB::table('incomes')->sum('income_amount');

        
        $show = view('backend.admin.income.show')->with('incomes', $incomes)->with('total_income', $total_income);
        return view('backend.admin.layouts.master')->with('content', $show);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
    }
}
