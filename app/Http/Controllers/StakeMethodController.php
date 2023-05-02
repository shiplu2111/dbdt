<?php

namespace App\Http\Controllers;

use App\Models\StakeMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StakeMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stake_methods = DB::table('stake_methods')->orderByDesc('period')->get();

        $show = view('backend.admin.stake.show')->with('stake_methods', $stake_methods);
        return view('backend.admin.layouts.master')->with('content', $show);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStakeById($id)
    {
        $stake_method = StakeMethod::find($id);

       return response()->json($stake_method);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stake_method= New StakeMethod();
        $stake_method->name = $request->name;
        $stake_method->period = $request->period;
        $stake_method->min_benifit = $request->min_benifit;
        $stake_method->max_benifit = $request->max_benifit;
        $stake_method->benifit_type = $request->benifit_type;
        $stake_method->min_amount = $request->min_amount;

        $stake_method->status = $request->status;
        $stake_method->benifit = $request->benifit;
        $stake_method->save();
        return response()->json($stake_method);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StakeMethod  $stakeMethod
     * @return \Illuminate\Http\Response
     */
    public function show(StakeMethod $stakeMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StakeMethod  $stakeMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(StakeMethod $stakeMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StakeMethod  $stakeMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $stake_method = StakeMethod::find($request->stack_id);
        $stake_method->name = $request->name;
        $stake_method->period = $request->period;
        $stake_method->min_benifit = $request->min_benifit;
        $stake_method->max_benifit = $request->max_benifit;
        $stake_method->benifit_type = $request->benifit_type;
        $stake_method->min_amount = $request->min_amount;
        $stake_method->status = $request->status;
        $stake_method->benifit = $request->benifit;
        $stake_method->save();
        return response()->json($stake_method);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StakeMethod  $stakeMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $stake_method = StakeMethod::find($id);
        $stake_method->delete();
      return response()->json(['success'=>'Stake Method has been deleted']);
    }


    public function getstackmethoddatabyid(Request $request){
        $data= StakeMethod::find($request->methodId);
        return response()->json($data);
    }
}
