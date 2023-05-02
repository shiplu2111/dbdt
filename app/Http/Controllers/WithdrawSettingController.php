<?php

namespace App\Http\Controllers;

use App\Models\WithdrawSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = DB::table('packages')->orderBy('id', 'DESC')->get();

        $show = view('backend.admin.withdraw.setting.show')->with('packages',$packages);
        return view('backend.admin.layouts.master')->with('content',$show);
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
    //    $a= $request->pack_value_withdraw_status ? 1 : 0 ?? 0;
       $setting = DB::table('withdraw_settings')->latest()->first();

       $request->validate([

           'withdraw_commission' => ['nullable ',  'max:3'],
           'withdraw_tax' => ['nullable ','max:3'],
           'tax' => ['withdraw_charge ', 'max:10'],
       ]);

       if ($setting) {
           $update = WithdrawSetting::find($setting->id);
           $update->pack_value_withdraw_status = $request->pack_value_withdraw_status ? 1 : 0 ?? 0;
           $update->commission_withdraw_status = $request->commission_withdraw_status ? 1 : 0 ?? 0;
           $update->withdraw_commission = $request->withdraw_commission;
           $update->withdraw_tax = $request->withdraw_tax;
           $update->withdraw_charge = $request->withdraw_charge;
           $update->save();
           return back()->with('success', 'Updated Successfully');

       }
       else {
           $update = new WithdrawSetting();
           $update->pack_value_withdraw_status = $request->pack_value_withdraw_status ? 1 : 0 ?? 0;
           $update->commission_withdraw_status = $request->commission_withdraw_status ? 1 : 0 ?? 0;
           $update->withdraw_commission = $request->withdraw_commission;
           $update->withdraw_tax = $request->withdraw_tax;
           $update->withdraw_charge = $request->withdraw_charge;
           $update->save();
           return back()->with('success', 'Added Successfully');

       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WithdrawSetting  $withdrawSetting
     * @return \Illuminate\Http\Response
     */
    public function show(WithdrawSetting $withdrawSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WithdrawSetting  $withdrawSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(WithdrawSetting $withdrawSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WithdrawSetting  $withdrawSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WithdrawSetting $withdrawSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WithdrawSetting  $withdrawSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(WithdrawSetting $withdrawSetting)
    {
        //
    }
}
