<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = DB::table('settings')->latest()->first();


        $show = view('backend.admin.setting.show')->with('setting', $setting);
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


    public function logo_add(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $setting = DB::table('settings')->latest()->first();
            if($setting){
            $website_logo_path = $setting->website_logo_path;
            if(file_exists($website_logo_path)) {
                File::delete(public_path('/').$website_logo_path);
            }
            $name = time().'.'.$request->logo->extension();
        $request->logo->move(public_path('website_setting'), $name);
        $update_path = Setting::find($setting->id);
        $update_path->website_logo_path ='website_setting/'.$name;
        $update_path->save();
        return redirect()->back()->with('success', 'Logo updated Successfully');
        }
        else{
            $name = time().'.'.$request->logo->extension();
        $request->logo->move(public_path('website_setting'), $name);
        $update_path = new Setting();
        $update_path->website_logo_path ='website_setting/'.$name;
        $update_path->save();
        return redirect()->back()->with('success', 'Logo updated Successfully');
        }


    }
    public function fev_icon_add(Request $request)
    {
        $request->validate([
            'fevIcon' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $setting = DB::table('settings')->latest()->first();
            if($setting){
            $website_fevIcon_path = $setting->website_fevIcon_path;
            if(file_exists($website_fevIcon_path)) {
                File::delete(public_path('/').$website_fevIcon_path);
            }
            $name = time().'.'.$request->fevIcon->extension();
        $request->fevIcon->move(public_path('website_setting'), $name);
        $update_path = Setting::find($setting->id);
        $update_path->website_fevIcon_path ='website_setting/'.$name;
        $update_path->save();
        return redirect()->back()->with('success', 'Fevicon updated Successfully');
        }
        else{
            $name = time().'.'.$request->fevIcon->extension();
        $request->fevIcon->move(public_path('website_setting'), $name);
        $update_path = new Setting();
        $update_path->website_fevIcon_path ='website_setting/'.$name;
        $update_path->save();
        return redirect()->back()->with('success', 'Fevicon updated Successfully');
        }

    }

    public function show(Setting $setting)
    {
        //
    }


    public function edit(Setting $setting)
    {

    }


    public function update(Request $request)
    {
        $setting = DB::table('settings')->latest()->first();
        //     if($setting){
        //     $website_logo_path = $setting->website_logo_path;
        //     if(file_exists($website_logo_path)) {
        //         File::delete(public_path('/').$website_logo_path);
        //     }
        //     $website_fevIcon_path = $setting->website_fevIcon_path;
        //     if(file_exists($website_fevIcon_path)) {
        //         File::delete(public_path('/').$website_fevIcon_path);
        //     }
        // }
        $request->validate([
            'website_name' => ['nullable ', 'string'],
            'website_slogan' => ['nullable ', 'string', 'max:2048'],
            'footerText' => ['nullable ', 'string', 'max:2048'],
            'copyWriteText' => ['nullable ', 'string', 'max:2048'],
            'tax' => ['nullable ', 'max:2048'],
        ]);

        if ($setting) {
            $update = Setting::find($setting->id);
            $update->website_name = $request->website_name;
            $update->website_slogan = $request->website_slogan;
            $update->website_footer_text = $request->footerText;
            $update->website_copy_write = $request->copyWriteText;
            $update->tax = $request->tax;
            $update->save();
        return response()->json($update);
        }
        else {
            $update = new Setting();
            $update->website_name = $request->website_name;
            $update->website_slogan = $request->website_slogan;
            $update->website_footer_text = $request->footerText;
            $update->website_copy_write = $request->copyWriteText;
            $update->tax = $request->tax;
            $update->save();
            return response()->json($update);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
