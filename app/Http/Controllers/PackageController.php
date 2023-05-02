<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = DB::table('packages')->orderBy('package_order')->get();

        $show = view('backend.admin.package.show')->with('packages',$packages);
        return view('backend.admin.layouts.master')->with('content',$show);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addPackage(Request $request)
    {



        $package= New Package();
        $package->packagename = $request->packagename;
        $package->usdtprice = $request->usdtprice;
        $package->dbdtprice = $request->dbdtprice;
        $package->withdraw_dbdt = $request->withdraw_dbdt;
        $package->staking_dbdt = $request->staking_dbdt;
        $package->frozen_dbdt = $request->frozen_dbdt;
        $package->bonus = $request->bonus;
        $package->overridelevel = $request->overridelevel;
        $package->mastercard_type = $request->mastercard_type;
        $package->bonus_period = $request->bonus_period;
        $package->description = $request->description;
        $package->package_order = $request->package_order;

        $package->status = $request->status;
        $package->save();
        return response()->json($package);
    }




    public function getPackageById($id)
    {
       $package = Package::find($id);


        $show = view('backend.admin.package.edit')->with('package',$package);
        return view('backend.admin.layouts.master')->with('content',$show);
    }


    public function updatePackage(Request $request)
    {
        // return $request->all();
        $package = Package::find($request->packageid);
        $package->packagename = $request->packagename;
        $package->usdtprice = $request->usdtprice;
        $package->dbdtprice = $request->dbdtprice;
        $package->withdraw_dbdt = $request->withdraw_dbdt;
        $package->staking_dbdt = $request->staking_dbdt;
        $package->frozen_dbdt = $request->frozen_dbdt;
        $package->bonus = $request->bonus;
        $package->overridelevel = $request->overridelevel;
        $package->mastercard_type = $request->mastercard_type;
        $package->bonus_period = $request->bonus_period;
        $package->description = $request->description;
        $package->package_order = $request->package_order;

        $package->status = $request->status;
        $package->save();
         return redirect('/admin/packages/');
    }


    public function pack_sales_details($id)
    {
       $sales_details = DB::table('orders')
       ->where('package_id', $id)
       ->get();

       $show = view('backend.admin.package.sales_details')->with('sales_details',$sales_details);
        return view('backend.admin.layouts.master')->with('content',$show);
    }
}
