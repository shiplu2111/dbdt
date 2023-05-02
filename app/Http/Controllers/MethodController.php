<?php

namespace App\Http\Controllers;

use App\Models\Method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = DB::table('methods')->orderBy('id', 'DESC')->get();

        $show = view('backend.admin.method.show')->with('packages',$packages);
        return view('backend.admin.layouts.master')->with('content',$show);
    }

    public function addMethod(Request $request)
    {
        $package= New Method();
        $package->method_name = $request->method_name;
        $package->status = $request->status;
        $package->save();
        return response()->json($package);
    }




    public function getMethodById($id)
    {
       $package = Method::find($id);

       return response()->json($package);
    }


    public function updateMethod(Request $request)
    {
        $package = Method::find($request->packageid);
        $package->method_name = $request->method_name;
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
    public function destroyMethod($id)
    {
        $package = Method::find($id);
 $package->delete();
       return response()->json(['success'=>'Method has been deleted']);
    }
}
