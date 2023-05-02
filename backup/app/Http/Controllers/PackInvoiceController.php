<?php

namespace App\Http\Controllers;

use App\Models\PackInvoice;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Session\Session;

class PackInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm_package($id)
    {
        $package = DB::table('packages')->where('id', $id)->first();
        $invoice = new PackInvoice();
        $invoice->package_id = $package->id;
        $invoice->user_id = Auth::user()->id;
        $invoice->order_id = Str::random(7);
        $invoice->tax = $package->usdtprice * .003;
        $invoice->subtotal = $package->usdtprice + $package->usdtprice * .003;
        $invoice->status = '0';
        $invoice->save();

        $show = view('backend.user.package.confirmpackage')->with('invoice', $invoice);
        return view('backend.user.layouts.master')->with('content', $show);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {

        $validated = $request->validate([
            'pay_code' => 'required|unique:pack_invoices|max:255',

        ],
        [ 'pay_code.unique' => 'You Can Use Each Transection Hash Single Time.']);

        $package = PackInvoice::find($request->p_id);

        // echo "<pre>";
        // print_r($package);
        // exit();
        $package->pay_code = $request->pay_code;
        $package->status = '2';
        $package->save();
        return redirect('/user/my-packages')->with('message', 'We Have Received Your Transection Code. Be Patent And Please Wait For Review ');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function my_packages()
    {
        $packages = DB::table('pack_invoices')->where('user_id',Auth::user()->id)->get();

        $show = view('backend.user.package.my_packages')->with('packages',$packages);
        return view('backend.user.layouts.master')->with('content',$show);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackInvoice  $packInvoice
     * @return \Illuminate\Http\Response
     */
    public function details_packages($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackInvoice  $packInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(PackInvoice $packInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PackInvoice  $packInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackInvoice $packInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackInvoice  $packInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = PackInvoice::find($id);
        $package->delete();
        return redirect('/user/my-packages')->with('message', 'Your Order (#'.$package->order_id.') Has been Deleted!');
    }
}
