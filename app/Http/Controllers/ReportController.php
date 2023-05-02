<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
        
        $packages = DB::table('packages')->orderBy('usdtprice', 'DESC')->get();
        $sales = DB::table('pack_invoices')->where('status','1')->orderByDesc('created_at')->get();
        $total_tax = DB::table('pack_invoices')->where('status','1')->sum('tax');
        $total_sales = DB::table('pack_invoices')->where('status','1')->sum('subtotal');

        $show = view('backend.admin.report.sales')->with('sales',$sales)
        ->with('packages',$packages)
        ->with('total_tax',$total_tax)
        ->with('total_sales',$total_sales)
        ;
        return view('backend.admin.layouts.master')->with('content',$show);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $packages = DB::table('packages')->orderBy('usdtprice', 'DESC')->get();
        $sales = DB::table('pack_invoices')
        ->where('status','1')
        ->where('package_id','<=',$request->package_id)
        ->where('created_at','<=',$request->end_date)
        ->where('created_at','>=',$request->start_date)
        ->get();
$total_tax =  DB::table('pack_invoices')
->where('status','1')
->where('created_at','<=',$request->end_date)
->where('created_at','>=',$request->start_date)
->sum('tax');

$total_sales =  DB::table('pack_invoices')
->where('status','1')
->where('created_at','<=',$request->end_date)
->where('created_at','>=',$request->start_date)
->sum('subtotal');

        $show = view('backend.admin.report.sales')
        ->with('sales',$sales)
        ->with('packages',$packages)
        ->with('total_tax',$total_tax)
        ->with('total_sales',$total_sales);
        return view('backend.admin.layouts.master')->with('content',$show);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
