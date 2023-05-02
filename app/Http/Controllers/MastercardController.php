<?php

namespace App\Http\Controllers;

use App\Models\Mastercard;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\MastercardPaymentMail;

class MastercardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stepOne(Request $request)
    {

        $request->validate([
            'first_name' => ['required', 'string',  'max:255'],
            'last_name' => ['required', 'string',  'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\Mastercard'],
            'birth_day' => ['required', 'date'],
        ]);

        $a=$request->email;
        $b=$request->confirm_email;
        if($a!=$b){
            return back()->with('email_err', 'Email dose not matched ');
        }
         $request->session()->put('first_name', $request->first_name);
         $request->session()->put('last_name', $request->last_name);
         $request->session()->put('email', $request->email);
         $request->session()->put('birth_day', $request->birth_day);
         $show = view('frontend.mastercard.step2');
         return view('frontend.layouts.master')->with('content',$show);

        // $value1 = $request->session()->get('first_name');
        // $val2 = $request->session()->get('last_name');
        // $val3 = $request->session()->get('email');
        // echo $value1.'+'.$val2.$val3;
        // exit();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stepTwo(Request $request)
    {
        $request->validate([
            'country' => ['required', 'string',  'max:255'],
            'address' => ['required', 'string',  'max:255'],
            'city' => ['required', 'string',  'max:255'],
            'zip_code' => ['required', 'string',  'max:255'],
            'phone' => ['required', 'unique:App\Models\Mastercard'],
        ]);

        $request->session()->put('country', $request->country);
         $request->session()->put('address', $request->address);
         $request->session()->put('city', $request->city);
         $request->session()->put('zip_code', $request->zip_code);
         $request->session()->put('phone', $request->phone);
         $m_email = $request->session()->get('email');
         $show = view('frontend.mastercard.step3')->with('m_email',$m_email);
         return view('frontend.layouts.master')->with('content',$show);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function stepThree(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'unique:App\Models\Mastercard',  'max:255'],
            'password' => ['required', 'string',  'max:255'],
            'id_country' => ['required', 'string',  'max:255'],
            'id_type' => ['required', 'string',  'max:255'],
            'id_number' => ['required', 'string', 'unique:App\Models\Mastercard',  'max:255'],
        ]);

        $request->session()->put('username', $request->username);
         $request->session()->put('password', $request->password);
         $request->session()->put('id_country', $request->id_country);
         $request->session()->put('id_type', $request->id_type);
         $request->session()->put('id_number', $request->id_number);
         $val1 = $request->session()->get('first_name');
          $val2 = $request->session()->get('last_name');
          $full_name=$val1.' '.$val2;
        $show = view('frontend.mastercard.step4')->with('full_name',$full_name);
        return view('frontend.layouts.master')->with('content',$show);
        // $value1 = $request->session()->get('first_name');
        // $val2 = $request->session()->get('last_name');
        // $val3 = $request->session()->get('email');
        // echo $value1.'+'.$val2.$val3;
        // exit();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mastercard  $mastercard
     * @return \Illuminate\Http\Response
     */
    public function finalStep(Request $request)
    {
        $request->validate([
            'bank_country' => ['required', 'string',   'max:255'],
            'currency' => ['required', 'string',  'max:255'],
            'bank_name' => ['required', 'string',  'max:255'],
            'brunch_name' => ['required', 'string',  'max:255'],
            'account_holder_name' => ['required', 'string',  'max:255'],
            'account_number' => ['required', 'string','unique:App\Models\Mastercard',  'max:255'],
        ]);
        $request->session()->put('bank_country', $request->bank_country);
         $request->session()->put('currency', $request->currency);
         $request->session()->put('bank_name', $request->bank_name);
         $request->session()->put('brunch_name', $request->brunch_name);
         $request->session()->put('account_holder_name', $request->account_holder_name);
         $request->session()->put('account_number', $request->account_number);
        //  $value1 = $request->session()->get('first_name');
        // $val2 = $request->session()->get('username');
        // $val3 = $request->session()->get('password');

        // echo $value1.'+'.$val2.$val3;
        // exit();
        $mastercard= New Mastercard();
        $mastercard->user_id = Auth::user()->id;
        $mastercard->first_name = $request->session()->get('first_name');
        $mastercard->last_name = $request->session()->get('last_name');
        $mastercard->email = $request->session()->get('email');
        $mastercard->birth_day = $request->session()->get('birth_day');
        $mastercard->country = $request->session()->get('country');
        $mastercard->address = $request->session()->get('address');
        $mastercard->city = $request->session()->get('city');
        $mastercard->zip_code = $request->session()->get('zip_code');
        $mastercard->phone = $request->session()->get('phone');
        $mastercard->username = $request->session()->get('username');
        $mastercard->password = Hash::make($request->session()->get('password'));
        $mastercard->id_country = $request->session()->get('id_country');
        $mastercard->id_type = $request->session()->get('id_type');
        $mastercard->id_number = $request->session()->get('id_number');
        $mastercard->bank_country = $request->session()->get('bank_country');
        $mastercard->currency = $request->session()->get('currency');
        $mastercard->bank_name = $request->session()->get('bank_name');
        $mastercard->brunch_name = $request->session()->get('brunch_name');
        $mastercard->account_holder_name = $request->session()->get('account_holder_name');
        $mastercard->account_number = $request->session()->get('account_number');
        $mastercard->status = '0';
        $mastercard->save();
        $message='hi';

        $admin_data = array(
            "result" => "New Mastercard Application",
            "user_id" =>Auth::user()->id,
            'url'=>'/admin/mastercard/application/details/'.$mastercard->id,
            );
        $admins= DB::table('users')->where('role','admin' )->get();
        foreach($admins as $item){
         $admin = User::find($item->id);
         $admin->notify(new AdminNotification($admin_data));
        }
        return redirect('/')->with('jsAlert', $message);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mastercard  $mastercard
     * @return \Illuminate\Http\Response
     */
    public function mastercard()
    {
        $master_card = DB::table('mastercards')->where('user_id', Auth::user()->id)->first();

        $show = view('backend.user.mastercard.show')->with('master_card', $master_card);
        return view('backend.user.layouts.master')->with('content', $show);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mastercard  $mastercard
     * @return \Illuminate\Http\Response
     */
    public function mastercard_payment(Request $request)
    {
        $master_card = DB::table('mastercards')->where('user_id', Auth::user()->id)->first();
        $master_card_data_update= Mastercard::find($master_card->id);
        $master_card_data_update->pay_code = $request->pay_code;
        $master_card_data_update->payment_method = $request->payment_method;
        $master_card_data_update->save();

        $details = [
            'title' => 'New Mastercard Activation Request from '.Auth::user()->name,
            'email' => Auth::user()->email,
            'user_id' => Auth::user()->id,
            'user_name' => Auth::user()->name,
            'user_img' => Auth::user()->profile_photo_path,
            'mastercard_id' => $master_card->id,
            'pay_code' => $request->pay_code,
            'payment_method' => $request->payment_method,
        ];
        $admin_data = array(
            "result" => "New Mastercard Payment",
            "user_id" =>Auth::user()->id,
            'url'=>'/admin/mastercard/application/details/'.$master_card_data_update->id,
            );
        $admins= DB::table('users')->where('role','admin' )->get();
        foreach($admins as $item){
         $admin = User::find($item->id);
         $admin->notify(new AdminNotification($admin_data));
        }
        Mail::to('dbdtofficial@gmail.com')->send(new \App\Mail\MastercardPaymentMail($details));
        return redirect()->back()->with('status_ok', 'Denied ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mastercard  $mastercard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mastercard $mastercard)
    {
        //
    }
}
