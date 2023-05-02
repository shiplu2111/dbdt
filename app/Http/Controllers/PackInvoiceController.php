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
use App\Models\User;
use App\Models\Account;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;

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
 public function confirm_package_upgrade($id)
    {
        $new_package = DB::table('packages')->where('id', $id)->first();
        // $invoice = new PackInvoice();
        // $invoice->package_id = $package->id;
        // $invoice->user_id = Auth::user()->id;
        // $invoice->order_id = Str::random(7);
        // $invoice->tax = $package->usdtprice * .003;
        // $invoice->subtotal = $package->usdtprice + $package->usdtprice * .003;
        // $invoice->status = '0';
        // $invoice->save();

        $show = view('backend.user.package.confirm_package_upgrade')->with('new_package', $new_package);
        return view('backend.user.layouts.master')->with('content', $show);
    }

    public function package_upgrade_store($id)
    {
        $new_package = DB::table('packages')->where('id', $id)->first();
        $package= DB::table('pack_invoices')->where('user_id',Auth::user()->id )->first();
        $active_pack = DB::table('packages')->where('id', $package->package_id)->first();
        $account = DB::table('accounts')->where('user_id', Auth::user()->id)->first();

        $package = PackInvoice::find($package->id);
        $package->package_id = $new_package->id;
        $package->tax = $new_package->dbdtprice/100*30;
        $package->subtotal = $new_package->dbdtprice/100*30+$new_package->dbdtprice;
       $package->save();


       $package_user = User::find(Auth::user()->id);
       $package_user->status = '1';
       $package_user->override_level = $active_pack->overridelevel;
       $package_user->save();

       $account_user = Account::find($account->id);
       $account_user->repurchase_balance = $account->repurchase_balance-($new_package->dbdtprice/100*30+$new_package->dbdtprice);
       $account_user->save();

        $admin_data = array(
            "result" => "New Package Upgrade Request",
            "user_id" =>Auth::user()->id,
            'url'=>'/admin/package-upgrade/deposit/pending/',
            );
        $admins= DB::table('users')->where('role','admin' )->get();
        foreach($admins as $item){
         $admin = User::find($item->id);

    $admin->notify(new AdminNotification($admin_data));
    }


       return redirect('/user/dashboard')->with('success','Upgrade Successfully ');
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
        $admin_data = array(
            "result" => "New Package Active Request",
            "user_id" =>Auth::user()->id,
            'url'=>'/admin/package/deposit/pending/',
            );
        $admins= DB::table('users')->where('role','admin' )->get();
        foreach($admins as $item){
         $admin = User::find($item->id);

    $admin->notify(new AdminNotification($admin_data));
    }
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
        $packages = DB::table('orders')->where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->get();

        $show = view('backend.user.package.my_packages')->with('packages',$packages);
        return view('backend.user.layouts.master')->with('content',$show);
    }


    // public function pu()
    // {
    //     $packages = DB::table('pack_invoices')->get();
    //     foreach($packages as $item){
    //         $update =  PackInvoice::find($item->id);
    //         $update->first_packege = $item->package_id;
    //     $update->save();
    //     }

    //     return 'done';
        
    // }
    
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
