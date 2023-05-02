<?php

namespace App\Http\Controllers;

use App\Models\PackUpgrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use App\Models\PackInvoice;

class PackUpgradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {
        // return $request->all();

        $validated = $request->validate([
            'pay_code' => 'required|unique:pack_upgrades|max:255',

        ],
        [ 'pay_code.unique' => 'You Can Use Each Transection Hash Single Time.']);

        $package = new PackUpgrade();
        $package->user_id = Auth::user()->id;
        $package->package_id = $request->package_id;
        $package->tax = $request->tax;
        $package->subtotal = $request->subtotal;
        $package->dbdt_value = $request->dbdt_value;
        $package->pay_code = $request->pay_code;
        $package->status = '0';
        $package->save();
        return redirect('/user/my-packages')->with('message', 'We have received your transaction hash and now under review. It will take 15 minutes to 24 hours to complete your transaction and its depends on network congestion');
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
    public function upgrade_by_balance(Request $request)
    {
        // return $request->all();
        $user_data = User::find(Auth::user()->id);
        $user_data->override_level = $request->override_level;
        $user_data->save();
        $account = DB::table('accounts')->where('user_id', Auth::user()->id)->first();
        $account_user = Account::find($account->id);
        $account_user->dbdt_balance = $account->dbdt_balance-$request->subtotal;
        $account_user->withdraw_balance = $account->withdraw_balance-$request->subtotal;
        $account_user->save();
        $pack = PackInvoice::where('user_id', Auth::user()->id)->first();
         $pack_invoice_update= PackInvoice::find($pack->id);
         $pack_invoice_update->package_id = $request->package_id;
         $pack_invoice_update->save();

        return redirect('/user/my-packages')->with('message', 'Congrats!! You have successfully upgrated your package');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackUpgrade  $packUpgrade
     * @return \Illuminate\Http\Response
     */
    public function show(PackUpgrade $packUpgrade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackUpgrade  $packUpgrade
     * @return \Illuminate\Http\Response
     */
    public function edit(PackUpgrade $packUpgrade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PackUpgrade  $packUpgrade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackUpgrade $packUpgrade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackUpgrade  $packUpgrade
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackUpgrade $packUpgrade)
    {
        //
    }
}
