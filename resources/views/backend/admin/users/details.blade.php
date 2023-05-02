@extends('backend.admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (session('success_status'))
                        <script>
                         const Toast = Swal.mixin({
                          toast: true,
                          position: 'center',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                          }
                        })
                        
                        Toast.fire({
                          icon: 'success',
                          title: 'Swap DBDT successfully'
                        })
                         </script>
                        @endif

                        @if (session('error1'))
                        <script>
                         const Toast = Swal.mixin({
                          toast: true,
                          position: 'center',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                          }
                        })
                        
                        Toast.fire({
                          icon: 'error',
                          title: 'Sorry not enough staking DBDT'
                        })
                         </script>
                        @endif
                        @if (session('error2'))
                        <script>
                         const Toast = Swal.mixin({
                          toast: true,
                          position: 'center',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                          }
                        })
                        
                        Toast.fire({
                          icon: 'error',
                          title: 'Sorry not enough withdrawable DBDT'
                        })
                         </script>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @php
        $user_account_details = DB::table('accounts')
            ->where('user_id', $user_data->id)
            ->first();
        $user_pack = DB::table('pack_invoices')
            ->where('user_id', $user_data->id)
            ->first();
        if ($user_pack) {
            $user_pack_details = DB::table('packages')
                ->where('id', $user_pack->first_packege)
                ->first();
        }
        $withdraw_settings = DB::table('withdraw_settings')
            ->latest()
            ->first();




		if($user_account_details){

        if ($withdraw_settings->pack_value_withdraw_status == 0 && $withdraw_settings->commission_withdraw_status == 1) 
        {
            $can_withdraw = $user_account_details->withdraw_balance - $user_account_details->withdraw_base;
            if ($can_withdraw<0)
            {
                $can_withdraw =0;
            }
            else
        {
           $can_withdraw =$can_withdraw;
        }
		}				  
       
        
        elseif ($withdraw_settings->pack_value_withdraw_status == 1 && $withdraw_settings->commission_withdraw_status == 0) {
           $a=$user_account_details->withdraw_balance-$user_account_details->withdraw_base;
        if ($a<0){
           $can_withdraw =0;
        }
           else{
           $can_withdraw =$a;
        }
    
        } elseif ($withdraw_settings->pack_value_withdraw_status == 1 && $withdraw_settings->commission_withdraw_status == 1) {
            $can_withdraw = $user_account_details->withdraw_balance;
            if ($can_withdraw<0){
           $can_withdraw =0;
        }
           else{
           $can_withdraw =$can_withdraw;
        }
        }
     }
      else {
            $can_withdraw = 0;
        }
        $myrefferedusers = DB::table('users')
            ->where('sponcerid', Auth::user()->myrefferalcode)
            ->where('status', '1')
            ->count();
        $my_reffered_users_list = DB::table('users')
            ->where('sponcerid', Auth::user()->myrefferalcode)
            ->where('status', '1')
            ->limit(12)
            ->get();
        @endphp
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">

                                    @if ($user_data->profile_photo_path)
                                        <img id="preview-image-before-upload1" style="height: 100px;"
                                            src="{{ URL::to('/') }}/{{ $user_data->profile_photo_path }}"
                                            class="profile-user-img img-fluid img-circle" alt="DBDT">
                                    @else
                                        <img id="preview-image-before-upload1" style="height: 100px;"
                                            src="https://media.istockphoto.com/vectors/vector-businessman-black-silhouette-isolated-vector-id610003972?k=20&m=610003972&s=612x612&w=0&h=-Nftbu4sDVavoJTq5REPpPpV-kXH9hXXE3xg_D3ViKE="
                                            class="profile-user-img img-fluid img-circle" alt="DBDT">
                                    @endif
                                </div>

                                <h3 class="profile-username text-center">{{ $user_data->name }}</h3>

                                <p class="text-muted text-center">{{ $user_data->myrefferalcode }}</p>
                                <button type="disabled" class="btn btn-primary btn-block"><b>Account Details
                                        (DBDT)</b></button>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Total DBDT</b> <a class="float-right">
                                            @if ($user_account)
                                                {{ $user_account->dbdt_balance }}
                                            @else
                                                Null
                                            @endif
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Staking DBDT</b> <a class="float-right">
                                            @if ($user_account)
                                                {{ $user_account->repurchase_balance  }}
                                            @else
                                                Null
                                            @endif
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Withdraw DBDT</b> <a class="float-right">
                                            @if ($user_account)
                                                {{ $user_account->withdraw_balance }}
                                            @else
                                                Null
                                            @endif
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Can Withdraw Now</b> <a class="float-right">
                                            
                                          {{$can_withdraw}}  
                                           
                                        </a>
                                    </li>
                                   
                                </ul>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#settings"
                                            data-toggle="tab">User Data</a></li>
                                    @if ($user_account)
                                        <li class="nav-item"><a class="nav-link " href="#activity"
                                                data-toggle="tab">Account</a></li>
                                    @endif

                                    <li class="nav-item"><a class="nav-link" href="#deposit"
                                            data-toggle="tab">Deposit</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#withdraw"
                                            data-toggle="tab">Withdraw</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#transfer"
                                            data-toggle="tab">Transfer</a></li>

                                    <li class="nav-item"><a class="nav-link" href="#received"
                                            data-toggle="tab">Received</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#swap"
                                                data-toggle="tab">Swap DBDT</a></li>

                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class=" tab-pane" id="activity">
                                        <!-- Post -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">User Account Details</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body" style="overflow-x:auto;">
                                                @if ($user_account)
                                                    <table class="table table-bordered" id="example11">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>Balance Type</th>
                                                                <th>DBDT Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1.</td>
                                                                <td>Total Balance</td>
                                                                <td>
                                                                    {{ number_format($user_account->dbdt_balance, 2, '.', ',') }}
                                                                    DBDT
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>2.</td>
                                                                <td>Withdraw Balance</td>
                                                                <td>
                                                                    {{ number_format($user_account->withdraw_balance, 2, '.', ',') }}
                                                                    DBDT
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>3.</td>
                                                                <td>Staking Balance</td>
                                                                <td>
                                                                    {{ number_format($user_account->repurchase_balance, 2, '.', ',') }}
                                                                    DBDT
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                            <!-- /.card-body -->

                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="timeline">
                                        <!-- The timeline -->
                                        <div class="timeline timeline-inverse">
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-danger">
                                                    10 Feb. 2014
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-envelope bg-primary"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i>
                                                        12:05</span>

                                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an
                                                        email</h3>

                                                    <div class="timeline-body">
                                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                        quora plaxo ideeli hulu weebly balihoo...
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-user bg-info"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 5 mins
                                                        ago</span>

                                                    <h3 class="timeline-header border-0"><a href="#">Sarah Young</a>
                                                        accepted your friend request
                                                    </h3>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-comments bg-warning"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 27 mins
                                                        ago</span>

                                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your
                                                        post</h3>

                                                    <div class="timeline-body">
                                                        Take me to your leader!
                                                        Switzerland is small and neutral!
                                                        We are more like Germany, ambitious and misunderstood!
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a href="#" class="btn btn-warning btn-flat btn-sm">View
                                                            comment</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-success">
                                                    3 Jan. 2014
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-camera bg-purple"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 2 days
                                                        ago</span>

                                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new
                                                        photos</h3>

                                                    <div class="timeline-body">
                                                        <img src="https://placehold.it/150x100" alt="...">
                                                        <img src="https://placehold.it/150x100" alt="...">
                                                        <img src="https://placehold.it/150x100" alt="...">
                                                        <img src="https://placehold.it/150x100" alt="...">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <div>
                                                <i class="far fa-clock bg-gray"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane active" id="settings">
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="name"
                                                        value="{{ $user_data->name }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="username"
                                                        value="{{ $user_data->username }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="inputEmail" readonly
                                                        value="{{ $user_data->email }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="phone"
                                                        value="{{ $user_data->phone }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputExperience" class="col-sm-3 col-form-label">Status</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="phone"
                                                        @if ($user_data->status == 1) value="Active" 
                                                    @else
                                                    value="Inctive" @endif
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputSkills" class="col-sm-3 col-form-label">Override
                                                    Level</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputSkills"
                                                        value="{{ $user_data->override_level }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputSkills" class="col-sm-3 col-form-label">Sponcerd
                                                    By</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputSkills"
                                                        value="{{ $user_data->sponcerid }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-sm-3 col-sm-9">
                                                    {{-- <button type="submit" class="btn btn-danger">Submit</button> --}}
                                                    {{-- <button type="button" class="btn btn-danger">Submit</button> --}}
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane " id="deposit">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">User Deposit History</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body" style="overflow-x:auto;">
                                                @if ($user_deposits)
                                                    <table class="table table-bordered" id="example12"
                                                        style="text-align: center;">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>Amount</th>
                                                                <th>Paid By</th>
                                                                <th>Hash</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach ($user_deposits as $item)
                                                                <tr style="text-align: center;">
                                                                    <td>{{ $i }}</td>
                                                                    <td>
                                                                        {{ number_format($item->amount, 2, '.', ',') }}
                                                                        DBDT
                                                                    </td>
                                                                    <td>{{ $item->paid_by }}</td>
                                                                    <td style="max-width: 100px; max-height: 70px;">
                                                                        <button data-toggle="modal"
                                                                            data-target="#exampleModalssa{{ $item->id }}"
                                                                            class="btn btn-sm"><i
                                                                                class="fas fa-eye"
                                                                                style="font-size:20px;color:rgb(22, 19, 202)"></i></button>
                                                                        <div class="modal fade"
                                                                            id="exampleModalssa{{ $item->id }}"
                                                                            tabindex="-1" role="dialog"
                                                                            aria-labelledby="exampleModalLabel"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">

                                                                                    <div class="modal-body">
                                                                                        {{ $item->hash }}
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        @if ($item->status == 1)
                                                                            <i class="fas fa-check-square"
                                                                                style="font-size:30px;color:rgb(22, 19, 202)"></i>
                                                                        @else
                                                                            <i class="far fa-times-circle"
                                                                                style="font-size:30px;color:red"></i>
                                                                        @endif
                                                                    </td>

                                                                </tr>
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                            <!-- /.card-body -->

                                        </div>
                                    </div>
                                    <div class="tab-pane " style="overflow-x:auto;" id="withdraw">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">User Withdraw History</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                @if ($user_withdraws)
                                                    <table class="table table-bordered " id="example13" width="100%"
                                                        cellspacing="0">

                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>Amount</th>
                                                                <th>Charge</th>
                                                                <th>Method</th>
                                                                <th>Status</th>
                                                                <th>More</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach ($user_withdraws as $item)
                                                                <tr style="text-align: center;">
                                                                    <td>{{ $i }}</td>
                                                                    <td>
                                                                        {{ number_format($item->withdraw_amount, 2, '.', ',') }}
                                                                        DBDT
                                                                    </td>
                                                                    <td>{{ $item->withdraw_charge }}</td>
                                                                    <td>{{ $item->withdraw_method }}</td>

                                                                    <td>
                                                                        @if ($item->withdraw_status == 1)
                                                                            <i class="fas fa-check-square"
                                                                                style="font-size:30px;color:rgb(99, 96, 228)"></i>
                                                                        @else
                                                                            <i class="far fa-times-circle"
                                                                                style="font-size:30px;color:red"></i>
                                                                        @endif
                                                                    </td>
                                                                    <td style="max-width: 100px; max-height: 70px;">
                                                                        <button data-toggle="modal"
                                                                            data-target="#withdraw_details{{ $item->id }}"
                                                                            class="btn btn-sm"><i
                                                                                class="fas fa-eye"
                                                                                style="font-size:20px;color:rgb(22, 19, 202)"></i></button>

                                                                    </td>

                                                                </tr>
                                                                <div class="modal fade"
                                                                    id="withdraw_details{{ $item->id }}" tabindex="-1"
                                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">

                                                                            <div class="modal-body"
                                                                                style="padding: 20px">
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-5">

                                                                                        Date
                                                                                    </div>
                                                                                    <div class="col-sm-7">

                                                                                        {{ Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-5">

                                                                                        Commission
                                                                                    </div>
                                                                                    <div class="col-sm-7">

                                                                                        {{ $item->withdraw_commission }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-5">

                                                                                        Tax
                                                                                    </div>
                                                                                    <div class="col-sm-7">

                                                                                        {{ $item->withdraw_tax }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-5">

                                                                                        Account Address
                                                                                    </div>
                                                                                    <div class="col-sm-7">

                                                                                        {{ $item->withdraw_method_address }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-5">

                                                                                        Hash
                                                                                    </div>
                                                                                    <div class="col-sm-7">

                                                                                        {{ $item->transaction_hash }}
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                            <!-- /.card-body -->

                                        </div>
                                    </div>









                                    <div class="tab-pane " id="transfer">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">User Transfer History</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body" style="overflow-x:auto;">
                                                @if ($user_transfers)
                                                    <table class="table table-bordered " id="example14" width="100%"
                                                        cellspacing="0">

                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>Amount</th>
                                                                <th>Charge</th>
                                                                <th>Receiver</th>

                                                                <th>Received</th>
                                                                <th>Date</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach ($user_transfers as $item)
                                                                <tr style="text-align: center;">
                                                                    <td>{{ $i }}</td>
                                                                    
                                                                    <td>
                                                                        {{ number_format($item->transfer_total_amount, 2, '.', ',') }}
                                                                        DBDT
                                                                    </td>
                                                                    <td>{{ $item->transfer_charge }}</td>
                                                                    <td>
                                                                        @php

                                                                        $receiver = DB::table('users')->where('id',$item->receiver_id)->first();
                                                                       
                                                                       @endphp
                                                                        <a  href="{{ url('/admin/user/details/'.$receiver->id) }}">{{$receiver->name }} </a> 
                                                                        
                                                                    </td>
                                                                    <td>{{ $item->receive_dbdt }}</td>

                                                                    <td>
                                                                        {{ Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}
                                                                    </td>
                                                                    

                                                                </tr>
                                                                
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                            <!-- /.card-body -->

                                        </div>
                                    </div>




                                    

                                    <div class="tab-pane " id="received">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">User Received History</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body" style="overflow-x:auto;">
                                                @if ($user_receives)
                                                    <table class="table table-bordered " id="example15" width="100%"
                                                        cellspacing="0">

                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>Received</th>
                                                                <th>Charge</th>
                                                                <th>Sender</th>

                                                                <th>Send</th>
                                                                <th>Date</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach ($user_receives as $item)
                                                                <tr style="text-align: center;">
                                                                    <td>{{ $i }}</td>
                                                                    
                                                                    <td>
                                                                        {{ $item->receive_dbdt }}
                                                                    </td>
                                                                    <td>{{ $item->transfer_charge }}</td>
                                                                    <td>
                                                                        @php

                                                                        $sender = DB::table('users')->where('id',$item->sender_id)->first();
                                                                       
                                                                       @endphp
                                                                        <a  href="{{ url('/admin/user/details/'.$sender->id) }}">{{$sender->name }} </a> 
                                                                        
                                                                    </td>
                                                                    <td>
                                                                        {{ number_format($item->transfer_total_amount, 2, '.', ',') }}
                                                                        DBDT
                                                                    </td>

                                                                    <td>
                                                                        {{ Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}
                                                                    </td>
                                                                    

                                                                </tr>
                                                                
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                            <!-- /.card-body -->

                                        </div>
                                    </div>


                                    <div class="tab-pane " id="swap">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Swap DBDT</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body" style="overflow-x:auto;">
                                                @if ($user_account)
                                                <form class="form-horizontal" action="{{url('admin/swap-dbdt')}}" method="POST">
                                                  @csrf
                                                    <div class="form-group row">
                                                        <label for="swap_type" class="col-sm-3 col-form-label">Swap Type</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control" name="swap_type" id="swap_type">
                                                                <option value="1">Staking to Withdraw</option>
                                                                <option value="2">Withdraw to Staking </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="swap_amount" class="col-sm-3 col-form-label">Swap Amount</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control" id="swap_amount"
                                                                name="swap_amount">
                                                                <input type="hidden" name="user_id" value="{{$user_data->id}}">
                                                                <input type="hidden" name="account_id" value="{{$user_account->id}}">
                                                        </div>
                                                    </div>
                                                
        
                                                    <div class="form-group row">
                                                        <div class="offset-sm-3 col-sm-9">
                                                            {{-- <button type="submit" class="btn btn-danger">Submit</button> --}}
                                                            <button type="submit" class="btn btn-danger float-right">Swap</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                @endif
                                            </div>
                                            <!-- /.card-body -->

                                        </div>
                                    </div>



                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    

    <script>
        $(function() {
            $("#example11").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example11_wrapper .col-md-6:eq(0)');
            $("#example12").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example12_wrapper .col-md-6:eq(0)');
            $("#example13").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example13_wrapper .col-md-6:eq(0)');

            $("#example14").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example14_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
        });
    </script>

@endsection
