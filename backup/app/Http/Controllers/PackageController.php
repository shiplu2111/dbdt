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
        $packages = DB::table('packages')->orderBy('id', 'DESC')->get();

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
        $package->overridelevel = $request->overridelevel;
        $package->status = $request->status;
        $package->save();
        return response()->json($package);
    }




    public function getPackageById($id)
    {
       $package = Package::find($id);

       return response()->json($package);
    }


    public function updatePackage(Request $request)
    {
        $package = Package::find($request->packageid);
        $package->packagename = $request->packagename;
        $package->usdtprice = $request->usdtprice;
        $package->dbdtprice = $request->dbdtprice;
        $package->overridelevel = $request->overridelevel;
        $package->status = $request->status;
        $package->save();
        return response()->json($package);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroyPackage($id)
    {
        $package = Package::find($id);
 $package->delete();
       return response()->json(['success'=>'Package has been deleted']);
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
