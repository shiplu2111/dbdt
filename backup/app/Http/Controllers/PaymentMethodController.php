<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = DB::table('pack_invoices')->where('user_id', Auth::user()->id)->get();

        $show = view('backend.user.payment.method')->with('packages', $packages);
        return view('backend.user.layouts.master')->with('content', $show);
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
    public function my_payment_method_add(Request $request)
    {
        $a = PaymentMethod::where('user_id', Auth::user()->id)
            ->where('method_id', $request->method_id)->first();
        // return $a;
        // method_name
        // method_id
        if ($a) {
            $method = PaymentMethod::where('user_id', Auth::user()->id)->where('method_id', $request->method_id)->first();
            $method->user_id = Auth::user()->id;
            $method->method_id = $request->method_id;
            $method->method_number = $request->method_number;
            $method->save();
            return back();

        } else {
            $method = new PaymentMethod();
            $method->user_id = Auth::user()->id;
            $method->method_id = $request->method_id;
            $method->method_number = $request->method_number;
            $method->save();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        //
    }
}
