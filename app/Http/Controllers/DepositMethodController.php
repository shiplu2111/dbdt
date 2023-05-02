<?php

namespace App\Http\Controllers;

use App\Models\DepositMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $deposit_methods = DB::table('deposit_methods')->get();
        $show = view('backend.admin.deposit.method.show')->with('deposit_methods',$deposit_methods);
        return view('backend.admin.layouts.master')->with('content',$show);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $method= New DepositMethod();
        $method->name = $request->name;
        $method->address = $request->address;
        $method->save();
        return response()->json($method);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DepositMethod  $depositMethod
     * @return \Illuminate\Http\Response
     */
    public function getMethodById($id)
    {
       $depositMethod = DepositMethod::find($id);

       return response()->json($depositMethod);
    }
    public function updateDepositMethod(Request $request)
    {
        $method = DepositMethod::find($request->depositmethodid);
        $method->name = $request->name;
        $method->address = $request->address;
        $method->save();
        return response()->json($method);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DepositMethod  $depositMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(DepositMethod $depositMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DepositMethod  $depositMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepositMethod $depositMethod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DepositMethod  $depositMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $depositMethod = DepositMethod::find($id);
        $depositMethod->delete();
              return response()->json(['success'=>'Method has been deleted']);
           }

}
