<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;
use App\Models\Account;
use App\Models\Stake;
use App\Models\Stake_benefit;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;


class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $show = view('frontend.index');
        return view('frontend.layouts.master')->with('content',$show);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buydbdt()
    {
        $show = view('frontend.buydbdt');
        return view('frontend.layouts.master')->with('content',$show);
    }

    public function not_found(){
        return view('frontend.not_found');
        // return view('frontend.layouts.master')->with('content',$show);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function stakedbdt()
    {
        $show = view('frontend.stakedbdt');
        return view('frontend.layouts.master')->with('content',$show);
    }
public function about_us()
    {
       
        return view('about_us');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mastercard()
    {
        $mastercard = DB::table('mastercards')
                        ->where('user_id', Auth::user()->id)
                        ->first();
                        if($mastercard){
                            
                           return redirect('/user/mastercard/details');
                        }
                            else{
        $show = view('frontend.mastercard');
        return view('frontend.layouts.master')->with('content',$show);
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loginregister()
    {
        $show = view('frontend.loginregister');
        return view('frontend.layouts.master')->with('content',$show);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        $show = view('frontend.contact');
        return view('frontend.layouts.master')->with('content',$show);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function abc(){
        $stakes = DB::table('stakes')
        ->whereDay('start_date', Carbon::now('Asia/Dhaka')->day)
        ->whereDate('start_date','<', Carbon::now())
        ->where('benefit_type', 1)
        ->where('status', 1)
        ->get();
    }
    
    public function stack_bonus_daily_cron_job()
    {
    
       
    }

    public function stack_bonus_cron_job()
    {

 $stake_benefit = DB::table('stakes')
        ->where('status', 1)
        ->get();
        foreach($stake_benefit as $item){
            $stack_method= DB::table('stake_methods')->where('id', $item->stake_method)->first();
            $user= DB::table('users')->where('id', $item->user_id)->first();
                          
            
            
            $stake_benefit_update =New Stake_benefit();
                            $stake_benefit_update->stake_id = $item->id;
                            $stake_benefit_update->user_id = $user->id;
                            $stake_benefit_update->stake_benefit = (($item->dbdt_amount*$stack_method->benifit)/36500);
                           if($item->benefit_type==1){
                            $stake_benefit_update->status =1;
                           }
                           else{
                            $stake_benefit_update->status =2;
                           }
                            $stake_benefit_update->save();
                                      }
        // if($stake_method->benifit_type === 'Yearly'){
        //     $benefit_type=2;

        $stakes = DB::table('stakes')
        ->whereDate('end_date', Carbon::now('Asia/Dhaka'))
        ->where('status', 1)
        ->where('benefit_type', 2)
        ->get();
        
        foreach($stakes as $item){

        $stack_method= DB::table('stake_methods')->where('id', $item->stake_method)->first();
            
                $account_data= DB::table('accounts')->where('user_id', $item->user_id)->first();
                $account_update = Account::find($account_data->id);
                $account_update->dbdt_balance = $account_data->dbdt_balance+(($item->dbdt_amount*$stack_method->benifit*$stack_method->period)/1200);
                $account_update->withdraw_balance = $account_data->withdraw_balance+(($item->dbdt_amount*$stack_method->benifit*$stack_method->period)/1200);
                $account_update->save();

                $a= Stake::find($item->id);
                $a->benifit=(($item->dbdt_amount*$stack_method->benifit*$stack_method->period)/1200);
                $a->save();

                $user_data= User::find($item->user_id);
                $data = array(
                    "result" => "You got stake bonus". (($item->dbdt_amount*$stack_method->benifit*$stack_method->period)/1200)." DBDT",
                    'url'=>'/user/my-stack/list/',
                    );
                    
                    $user= User::find($user_data->id);
                    $user->notify(new UserNotification($data));
                $details = [
                    'title' => 'Congrets!! You have got stake bonus',
                    'bonus' => (($item->dbdt_amount*$stack_method->benifit*$stack_method->period)/1200),
                ];
               
                Mail::to($user_data->email)->send(new \App\Mail\stakeDone($details));
       
        }


        $monthly_stakes = DB::table('stakes')
        ->whereDay('start_date', Carbon::now('Asia/Dhaka')->day)
        ->whereDate('start_date','<', Carbon::now())
        ->where('benefit_type', 1)
        ->where('status', 1)
        ->get();

        foreach($monthly_stakes as $item){

            $stack_method= DB::table('stake_methods')->where('id', $item->stake_method)->first();
                
                    $account_data= DB::table('accounts')->where('user_id', $item->user_id)->first();
                  
                   


                    $account_update = Account::find($account_data->id);
                    $account_update->dbdt_balance = $account_data->dbdt_balance+(($item->dbdt_amount*$stack_method->benifit)/1200);
                    $account_update->withdraw_balance = $account_data->withdraw_balance+(($item->dbdt_amount*$stack_method->benifit)/1200);
                    $account_update->save();
    
                    $a= Stake::find($item->id);
                    $a->benifit=($a->benifit+($item->dbdt_amount*$stack_method->benifit)/1200);
                    $a->save();
    
                    $user_data= User::find($item->user_id);
                    $data = array(
                        "result" => "You got stake bonus". (($item->dbdt_amount*$stack_method->benifit)/1200)." DBDT",
                        'url'=>'/user/my-stack/list/',
                        );
                        
                        $user= User::find($user_data->id);
                        $user->notify(new UserNotification($data));
                    $details = [
                        'title' => 'Congrets!! You have got stake bonus',
                        'bonus' => (($item->dbdt_amount*$stack_method->benifit)/1200),
                    ];
                   
                    
                  
                    Mail::to($user_data->email)->send(new \App\Mail\stakeDone($details));
           
        }


        

                            $stake_end = DB::table('stakes')
                            ->whereDate('end_date', Carbon::now('Asia/Dhaka'))
                            ->where('status', 1)
                            ->get();
                                    foreach($stake_end as $item){
                                        $account= DB::table('accounts')->where('user_id', $item->user_id)->first();
                                                $account_update = Account::find($account->id);
                                                $account_update->dbdt_balance = $account->dbdt_balance+$item->dbdt_amount;
                                                $account_update->withdraw_balance = $account->withdraw_balance+$item->dbdt_amount;
                                                $account_update->save();
                                                $aa= Stake::find($item->id);
                                                $aa->status=2;
                                                $aa->save();
                                                $data = array(
                                                    "result" => "Stake End",
                                                    'url'=>'/user/my-stack/list/',
                                                    );
                                                    
                                                    $user= User::find($item->user_id);
                                                    $user->notify(new UserNotification($data));
                                    }

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
