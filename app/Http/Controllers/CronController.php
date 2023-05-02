<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FridgeDbdtDist;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Account;
use App\Models\User;

use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;


class CronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $leader=  DB::table('fridge_dbdt_dists')
        ->where( 'status', 0)
        ->whereDay('created_at', date('d'))->get();
        // return  $leader;
        foreach ($leader as $item ) {
        $account=DB::table('accounts')->where('user_id',$item->user_id)->first();
                $account_update= Account::find($account->id);
                $account_update->withdraw_balance = $account->withdraw_balance + $item->dbdt_amount_per_period;
                $account_update->frozen_balance = $account->frozen_balance - $item->dbdt_amount_per_period;
                $account_update->save();

                $freez_account=  DB::table('fridge_dbdt_dists')
                ->where( 'id', $item->id)->first();

                $freez_account_update= FridgeDbdtDist::find($item->id);
                $freez_account_update->distribute_dbdt_amount = $freez_account->distribute_dbdt_amount + $item->dbdt_amount_per_period;
                $freez_account_update->period = $freez_account->period - 1;
                if($freez_account->period - 1==0){
                    $freez_account_update->status =1;
                }
                $freez_account_update->dbdt_amount = $freez_account->dbdt_amount - $item->dbdt_amount_per_period;
                $freez_account_update->save();

                $data = array(
                    "result" => "Monthly 10% bonus Added",
                    'url'=>'#',
                    );

                    $user= User::find($item->user_id);
                    $user->notify(new UserNotification($data));

        }

        $admin_data = array(
            "result" => "Freez DBDT Cron Run Success",
            "user_id" => 'null',
            'url'=>'#',
            );
        $admins= DB::table('users')->where('role','admin' )->get();
        foreach($admins as $item){
         $admin = User::find($item->id);

    $admin->notify(new AdminNotification($admin_data));
    }


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