<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\eid;
use Carbon\Carbon;
class DbdtuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //     $data = array(
    //         "result" => "Withdraw Request Rejected"
    //       );

    //      $admin = User::find(Auth::user()->id);

    // $admin->notify(new Testnotification($data));

           $leader_boards= DB::table('leaderboards')->where( 'created_at', '>', Carbon::now()->subDays(60))
       ->selectRaw("SUM(dbdt_amount) as total_debit")
       ->selectRaw("(user_id) as user_id")
       ->orderBy('total_debit','DESC')
        ->groupBy('user_id')->skip(0)->take(10)
        ->get();
    $ref_start= Carbon::now()->subDays(60)->format('d-M');
    $ref_today= Carbon::now()->format('d-M');
    $ref_count = DB::table('leaderboards')->where('user_id',Auth::user()->id) ->where( 'created_at', '>', Carbon::now()->subDays(60))->count();
    $ref_amount = DB::table('leaderboards')->where('user_id',Auth::user()->id) ->where( 'created_at', '>', Carbon::now()->subDays(60))->sum('dbdt_amount');

        $show = view('backend.user.index')->with('ref_count',$ref_count)->with('ref_start',$ref_start)->with('ref_today',$ref_today)->with('ref_amount',$ref_amount)->with('leader_boards',$leader_boards);
        return view('backend.user.layouts.master')->with('content',$show);
    }
    public function base(){
        $active_users= DB::table('users')->where('status',1 )->where('role','user' )->get();
        foreach($active_users as $item){
        $account= DB::table('accounts')->where('user_id',$item->id )->first();
        $pack_invoice= DB::table('pack_invoices')->where('user_id',$item->id )->first();
        $pack= DB::table('packages')->where('id',$pack_invoice->package_id )->first();
        $acc = Account::find($account->id);
        $acc->withdraw_base = $pack->dbdtprice/2;
        $acc->repurchase_base = $pack->dbdtprice/2;
        $acc->save();
        }

    }
    public function profile()
    {
        return redirect('user/profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function packageshow()
    {
        $packages = DB::table('packages')->where('status', 'Active')->orderBy('package_order')->get();

        $show = view('backend.user.package.show')->with('packages',$packages);
        return view('backend.user.layouts.master')->with('content',$show);
    }

    public function package_upgrade()
    {

        $active_pack =  DB::table('orders')->where('user_id',Auth::user()->id)->latest()->first();
        $active_packages =  DB::table('packages')->where('id',$active_pack->package_id)->first();

        $packages = DB::table('packages')->where('package_order', '>', $active_packages->package_order)->where('status','Active')->orderBy('package_order')->get();

        $show = view('backend.user.package.show')->with('packages',$packages);
        return view('backend.user.layouts.master')->with('content',$show);
    }

     public function profile_show()
    {
        $show = view('backend.user.profile.profile_show');

        if(Auth::user()->role=='admin'){
            return view('backend.admin.layouts.master')->with('content',$show);
        }
        else{
            return view('backend.user.layouts.master')->with('content',$show);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $del = User::find(Auth::user()->id);
        $image_path = $del->profile_photo_path;
        if(file_exists($image_path)) {
            File::delete(public_path('/').$image_path);
        }

        $validatedData = $request->validate([
         'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        $name = time().'.'.$request->image->extension();
         $request->image->move(public_path('profile_photos'), $name);
        $update_path = User::find(Auth::user()->id);
        $update_path->profile_photo_path ='profile_photos/'.$name;
        $update_path->save();
        return response()->json($name);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUserData(Request $request)
    {
        $validated = $request->validate([
            'name' => ['string', 'max:255'],
            'phone' => ['max:255', 'regex:/(0)[0-9]/', 'not_regex:/[a-z]/'],
        ]);
        $package = User::find(Auth::user()->id);
        $package->name = $request->name;
        $package->phone = $request->phone;
        $package->save();
        return response()->json($package);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyProfilePhoto($id)
    {
        $del = User::find($id);
        $image_path = $del->profile_photo_path;

        $del->profile_photo_path =null;
        $del->save();
        if(file_exists($image_path)) {
            File::delete(public_path('/').$image_path);
        }

        return response()->json($del);
    }
	  public function tree(){
        $show = view('backend.user.downLine.tree');
        return view('backend.user.layouts.master')->with('content',$show);
    }

    public function identity_submit(Request $request){
        $validation = Validator::make($request->all(),[
            'document_number' => ['Required', 'unique:users']
            ]);

             if($validation->passes()){


                $request->session()->put('document_number', $request->document_number);

        $user_identity_submit = User::find(Auth::user()->id);
        $user_identity_submit->document_type = $request->document_type;
        $user_identity_submit->issued_by_country = $request->issued_by_country;
        // $user_identity_submit->document_number = $request->document_number;
        $user_identity_submit->save();

         if($request->document_type === 'NID'){
        return redirect('user/nid-kyc-submit')->with('status', 'Profile updated!');

         }
else{
    return redirect('user/passport-kyc-submit')->with('status', 'Profile updated!');

}

             }
             else{
                return redirect()->back()->with('status_no', 'Profile updated!')->withInput();;
             }



    }





    public function kyc_verification(){
        $del = User::find(Auth::user()->id);
        if($del->id_verify_status==2){
            return redirect('/user/kyc-status');
        }
        elseif($del->id_verify_status==0){

        $show = view('backend.user.kyc.show');
        return view('backend.user.layouts.master')->with('content',$show);
    }
    else{
        return redirect('/user/dashboard');
    }

    }

    public function nid_kyc_submit_show(){
        $show = view('backend.user.kyc.nid_submit');
        return view('backend.user.layouts.master')->with('content',$show);
    }

    public function nid_back_show(){
        $show = view('backend.user.kyc.nid_submit_back');
        return view('backend.user.layouts.master')->with('content',$show);
    }

    public function nid_selfie_show(){
        $show = view('backend.user.kyc.nid_selfie');
        return view('backend.user.layouts.master')->with('content',$show);
    }

    public function nid_submit_front(Request $request){


        $del = User::find(Auth::user()->id);
        $front_path = $del->nid_photo_front;

        if(file_exists($front_path)) {
            File::delete(public_path('/').$front_path);
        }

        $validatedData = $request->validate([
            'nid_front' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:20048',

           ]);


           $name = 'front'.time().'.'.$request->nid_front->extension();
           $request->nid_front->move(public_path('kyc/nid'), $name);
          $update_path = User::find(Auth::user()->id);
          $update_path->nid_photo_front ='kyc/nid/'.$name;
          $update_path->save();
          return redirect('user/nid-back-submit')->with('status', 'Profile updated!');

    }

    public function nid_submit_back(Request $request){
        $del = User::find(Auth::user()->id);
        $back_path = $del->nid_photo_back;

        if(file_exists($back_path)) {
            File::delete(public_path('/').$back_path);
        }

        $validatedData = $request->validate([
            'nid_back' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:20048',

           ]);


           $name_back = 'back'.time().'.'.$request->nid_back->extension();
           $request->nid_back->move(public_path('kyc/nid'), $name_back);
          $update_path = User::find(Auth::user()->id);
          $update_path->nid_photo_back ='kyc/nid/'.$name_back;

          $update_path->save();
          return redirect('user/nid-selfie')->with('status', 'Profile updated!');

    }


    public function nid_submit_selfie(Request $request){
        $del = User::find(Auth::user()->id);
        $nid_selfie = $del->selfie;

        if(file_exists($nid_selfie)) {
            File::delete(public_path('/').$nid_selfie);
        }

        $validatedData = $request->validate([
            'nid_selfie' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:20048',

           ]);


            $nid_selfie = 'nid_selfie'.time().'.'.$request->nid_selfie->extension();
          $request->nid_selfie->move(public_path('kyc/selfie'), $nid_selfie);
          $update_path = User::find(Auth::user()->id);
         $update_path->selfie ='kyc/selfie/'.$nid_selfie;

          $update_path->save();
          return redirect('user/address-kyc-submit')->with('status', 'Profile updated!');

    }

    public function passport_kyc_submit_show(){
        $show = view('backend.user.kyc.passport_submit');
        return view('backend.user.layouts.master')->with('content',$show);
    }
    //

    public function passport_submit(Request $request){
        $del = User::find(Auth::user()->id);
        $passport_photo = $del->passport_photo;

        if(file_exists($passport_photo)) {
            File::delete(public_path('/').$passport_photo);
        }

        $validatedData = $request->validate([
            'passport_copy' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:20148',
           ]);


           $name = 'passport_copy'.time().'.'.$request->passport_copy->extension();
           $request->passport_copy->move(public_path('kyc/passport'), $name);
          $update_path = User::find(Auth::user()->id);
          $update_path->passport_photo ='kyc/passport/'.$name;
          $update_path->save();
          return redirect('user/selfie')->with('status', 'Profile updated!');

    }

    public function selfie_submit_show(){

        $show = view('backend.user.kyc.selfie');
        return view('backend.user.layouts.master')->with('content',$show);
    }

    public function selfie_submit(Request $request){
        $del = User::find(Auth::user()->id);
        $passport_selfie = $del->selfie;

        if(file_exists($passport_selfie)) {
            File::delete(public_path('/').$passport_selfie);
        }

        $validatedData = $request->validate([
            'passport_selfie' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:20148',
           ]);


           $passport_selfie = 'passport_selfie'.time().'.'.$request->passport_selfie->extension();
           $request->passport_selfie->move(public_path('kyc/selfie'), $passport_selfie);
          $update_path = User::find(Auth::user()->id);
          $update_path->selfie ='kyc/selfie/'.$passport_selfie;

          $update_path->save();
          return redirect('user/address-kyc-submit')->with('status', 'Profile updated!');

    }


    public function address_kyc_submit(){
        $show = view('backend.user.kyc.address_submit');
        return view('backend.user.layouts.master')->with('content',$show);
    }
    public function address_submit(Request $request){
        $del = User::find(Auth::user()->id);
        $address_proof = $del->address_proof;

        if(file_exists($address_proof)) {
            File::delete(public_path('/').$address_proof);
        }

        $validatedData = $request->validate([
            'address_proof' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:20148',
           ]);


           $name = 'address_proof'.time().'.'.$request->address_proof->extension();

           $request->address_proof->move(public_path('kyc/address_proof'), $name);
          $update_path = User::find(Auth::user()->id);
          $update_path->address_proof ='kyc/address_proof/'.$name;
          $update_path->id_verify_status =2;
          $update_path->document_number = $request->session()->get('document_number');
          $update_path->save();

          return redirect('user/kyc-status')->with('status_kyc_duccess', 'Profile updated!');
    }
public function kyc_status(){
    $kyc_status = User::find(Auth::user()->id);
    if($kyc_status->id_verify_status==2){
        $show = view('backend.user.kyc.kyc_status');
        return view('backend.user.layouts.master')->with('content',$show);
    }
    elseif($kyc_status->id_verify_status==1){
        return redirect('user/identity-document');
    }
    elseif($kyc_status->id_verify_status==0){
        return redirect('user/identity-document');
    }


}

}
