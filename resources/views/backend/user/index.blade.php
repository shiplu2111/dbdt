@extends('backend.user.layouts.master')
@section('title')
    DBDT- User Dashboard
@endsection
@section('content')
    @php
        $user_account_details = DB::table('accounts')
            ->where('user_id', Auth::user()->id)
            ->first();
        $myrefferedusers = DB::table('users')
            ->where('sponcerid', Auth::user()->myrefferalcode)
            ->where('status', '1')
            ->count();

        $my_staking = DB::table('stakes')
            ->where('user_id', Auth::user()->id)
            ->where('status', '1')
            ->sum('dbdt_amount');

        $my_reffered_users_list = DB::table('users')
            ->where('sponcerid', Auth::user()->myrefferalcode)
            ->where('status', '1')
            ->limit(12)
            ->get();

        $web_details = DB::table('settings')
            ->latest()
            ->first();

    @endphp


<style>
    .max-lines {
        display: block;/* or inline-block */
                                    text-overflow: ellipsis;
                                    word-wrap: break-word;
                                    overflow: hidden;
                                    max-height: 100px;
                                    line-height: 1.8em;
    }
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        @if (session())
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-start',
                    color: 'blue',
                    background: '#fff url(https://image.shutterstock.com/image-vector/money-dollars-banknotes-cash-bagflat-260nw-1908067867.jpg)',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({

                    title: "Welcome Back {{ Auth::user()->name }}"
                })
            </script>
        @endif
        <!-- Content Header (Page header) -->
        @if (Auth::user()->id_verify_status != 1)
            <div class="card text-center card-danger collapsed-card">
                <div class="card-header text-center">
                    <h6 class="card-title">Identity Verification Warning <i class="fas fa-exclamation-circle"></i></h6>

                    <div class="card-tools">


                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>

                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-info"></i> <u> Importent Notice for Identity Verification</u>:</h5>
                        <h6>DBDT Accounts, are intended for only one account for one person. If you have multiple account in
                            DBDT, Your account will be disabled within 10'th May 2022.
                        </h6>
                        <h6>
                            Form 10th May 2022 DBDT will be start Identity Verification
                        </h6>
                        To avoid disable your account please update your name as per National ID or Passport,


                        Avoid spaming on DBDT account.

                        <br>

                        <span> <a style="text-decoration: none" href="{{ url('/user/profile/update') }}"
                                class="btn btn-sm btn-info">Update Now</a>
                            <a style="text-decoration: none" href="{{ url('/user/identity-document') }}"
                                class="btn btn-sm btn-primary ">Verify Now</a></span>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        @endif
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                        <p>
                            @if (\Session::has('success'))
                                <div class="alert alert-success">
                                    <ul>
                                        <li>{!! \Session::get('success') !!}</li>
                                    </ul>
                                </div>
                            @endif
                        </p>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item active">My Reffaral Code : {{ Auth::user()->myrefferalcode;}}</li> --}}
                            {{-- <li class="breadcrumb-item  active"> <a href="{{ url('/dashboard') }}"> Dashboard v1</a></li> --}}
                            <li class="breadcrumb-item active">
                                <p id="copy">{{ route('register', ['ref' => Auth::user()->myrefferalcode]) }}</p>
                            </li>
                            @if (Auth::user()->status == 1)
                                <li> <button class="btn btn-sm btn-success" id="button1"
                                        onclick="CopyToClipboard('copy');return false;">Copy
                                    </button></li>
                            @else
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">Copy
                                    Reffaral Code</button></li>

                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-body">
                                                Buy DBDT for active your account and you will got your Reffaral Code
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <a href="{{ url('/user/available-packages') }}"
                                                    class="btn btn-sm btn-primary">Buy DBDT now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </ol>
                        <script>
                            function CopyToClipboard(id) {
                                var r = document.createRange();
                                r.selectNode(document.getElementById(id));
                                window.getSelection().removeAllRanges();
                                window.getSelection().addRange(r);
                                document.execCommand('copy');
                                window.getSelection().removeAllRanges();
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: 'Copy successfully'
                                })
                            }
                        </script>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container">
                @php

                    $target = ($ref_amount * 100) / 1000000;
                    if ($target > 100) {
                        $target = 100;
                    }
                @endphp



                <div class="card" style="width: 100%">
                    <div class="card-body" >
                        <div class="row">
                            <div class="col-10 col-sm-10 col-md-11">

                                <span class="irs-from" style="visibility: visible; left: -0.740607%;">0 DBDT</span>

                                <span class="irs-max" style="visibility: visible; float: right;"> 1000000
                                    DBDT</span>

                                <div class="progress">

                                    <div class="progress-bar progress-bar-striped active" role="progressbar"
                                        aria-valuenow="100000" aria-valuemin="0" aria-valuemax="10000000"
                                        style="width:{{ number_format($target, 2) }}%">
                                        {{ number_format($target, 0) }}% & {{ $ref_count }} Referal {{ $ref_amount }}
                                        DBDT

                                    </div>

                                </div>

                                <span class="irs-from"
                                    style="visibility: visible; left: -0.740607%;">{{ $ref_start }}</span>
                                    <i  class="fas fa-info-circle toastrDefaultInfo2" style="margin-left: 40%; "></i>

                                <span class="irs-max" style="visibility: visible; float: right;">{{ $ref_today }}
                                </span>



                            </div>
                            <div class="col-2 col-sm-2 col-md-1">
                                @if ($ref_amount >= 1000000)
                                    <a class="btn bg-warning" style="margin-top:15px; ">
                                        <i class="fas fa-gift"></i>
                                    </a>
                                @else
                                    <button class="btn bg-danger toastrDefaultInfo"  style="margin-top: 15px; ">
                                        <i class="fas fa-gift"></i>
                                    </button>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="container-fluid">

                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Balance</span>
                                <span class="info-box-number">
                                    @if ($user_account_details)
                                        {{ number_format($user_account_details->dbdt_balance, 2, '.', ',') }}
                                    @endif
                                    <small>DBDT</small>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-bill-wave"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Withdrawable Balance</span>
                                <span class="info-box-number">
                                    @if ($user_account_details)
                                        {{ number_format($user_account_details->withdraw_balance, 2, '.', ',') }}
                                    @endif
                                    <small>DBDT</small>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Stakeable Balance</span>
                                @if ($user_account_details)
                                    <span class="info-box-number">

                                        {{ number_format($user_account_details->repurchase_balance, 2, '.', ',') }}
                                        <small>DBDT</small></span>
                                @else
                                    <span class="info-box-number">0.00 <small>DBDT</small></span>
                                @endif
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fa-solid fa-icicles"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Freez Balance</span>
                                <span class="info-box-number">
                                    @if ($user_account_details)
                                        {{ number_format($user_account_details->frozen_balance, 2, '.', ',') }}
                                    @else
                                        0
                                    @endif
                                    <small>DBDT</small>
                                </span>
                            </div>
                            {{-- <div class="info-box-content">
                                <span class="info-box-text">On Stake Balance</span>
                                <span class="info-box-number">
                                    @if ($my_staking)
                                    {{ number_format($my_staking, 2, '.', ',') }}
                                    @else
                                    0
                                    @endif
                                    <small>DBDT</small>
                                </span>
                            </div> --}}
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner" style="text-align:center">
                                <h4>
                                    @if ($user_account_details)
                                        $
                                        {{ number_format($user_account_details->frozen_balance * $web_details->usd_dbdt, 2, '.', ',') }}
                                    @else
                                        $ 0
                                    @endif
                                </h4>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <span class="small-box-footer">Total Balance</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner" style="text-align:center">
                                <h4>
                                    @if ($user_account_details)
                                        $
                                        {{ number_format($user_account_details->dbdt_balance * $web_details->usd_dbdt, 2, '.', ',') }}
                                    @else
                                        $ 0
                                    @endif
                                </h4>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <span class="small-box-footer">Total Balance</span>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner" style="text-align:center">
                                <h4>
                                    @if ($user_account_details)
                                        $
                                        {{ number_format($user_account_details->withdraw_balance * $web_details->usd_dbdt, 2, '.', ',') }}
                                    @else
                                        $ 0
                                    @endif
                                </h4>

                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>

                            </div>
                            <span class="small-box-footer">Withdrawable Balance</span>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- small box -->
                        <div class="small-box bg-warning" style="text-align:center">
                            <div class="inner">
                                <h4>
                                    @if ($user_account_details)
                                        $
                                        {{ number_format($user_account_details->repurchase_balance * $web_details->usd_dbdt, 2, '.', ',') }}
                                    @else
                                        $ 0
                                    @endif
                                </h4>

                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <span class="small-box-footer">Stakeable Balance </span>
                        </div>
                    </div>
                    <!-- ./col -->
                    {{-- <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> --}}
                    <!-- ./col -->
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner" style="text-align:center">
                                <h4>
                                    @if ($my_staking)
                                        {{ number_format($my_staking, 2, '.', ',') }}
                                    @else
                                        0
                                    @endif
                                    <small>DBDT</small>
                                </h4>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <span class="small-box-footer">On Stake Balance</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner" style="text-align:center">
                                <h4>
                                    @if ($my_staking)
                                        $ {{ number_format($my_staking * $web_details->usd_dbdt, 2, '.', ',') }}
                                    @else
                                        $ 0
                                    @endif
                                </h4>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <span class="small-box-footer">On Stake Balance</span>
                        </div>
                    </div>
                    <!-- ./col -->

                    <!-- ./col -->
                    {{-- <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> --}}
                    <!-- ./col -->
                </div>
                <!-- Small boxes (Stat box) -->
                <div class="row justify-content-md-center">

                    <!-- /.col -->
                    <div class="col-md-4">

                        <div class="card">
                            <div class="card-body p-0">
                                <div style="width: 100%; height: 300px;" class="nomics-ticker-widget"
                                    data-name="Digital BDT" data-base="DBDT" data-quote="USD"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="card">
                            <div class="card-body p-0">
                                <div style="width: 100%; height: 300px; overflow: scroll"><a class="twitter-timeline"
                                        data-theme="dark"
                                        href="https://twitter.com/dbdtofficial?ref_src=twsrc%5Etfw">Tweets
                                        by dbdtofficial</a>
                                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">

                        <div class="card">
                            <div class="card-body p-0">
                                <iframe width="100%" height="300 px" src="https://www.youtube.com/embed/OOX4_MGdeDg"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9804158421402971"
                        crossorigin="anonymous"></script>
                    <ins class="adsbygoogle" style="display:block" data-ad-format="fluid"
                        data-ad-layout-key="-gp-1l+4j-7z+as" data-ad-client="ca-pub-9804158421402971"
                        data-ad-slot="3346319659"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>

                    <!-- /.col -->
                    <!-- /.col -->
                </div>

                <!-- /.row -->


                <div class="row">

                    <!-- /.col -->

                    <div class="col-md-5">

                        <!-- USERS LIST -->

                        <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Leaderboard</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 50px">Name</th>
                                    <th>Progress</th>
                                    <th style="width: 40px">Label</th>
                                    <th style="width: 20px">Info</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($leader_boards as $item )
@php
$persent_progress=  ($item->total_debit * 100) / 1000000;
$leader_user_detail= DB::table('users')->where('id',$item->user_id )->first();
@endphp

                                  <tr>
                                    <td>{{$i}}.</td>
                                    <td class="max-lines">{{$leader_user_detail->name}}</td>
                                    <td>
                                      <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: {{$persent_progress}}%"></div>
                                      </div>
                                    </td>
                                    <td><span class="badge bg-danger">{{$persent_progress}}%</span></td>
                                    <td><i class="fas fa-info-circle"  data-toggle="tooltip"
                                        data-placement="left"
                                        title="{{$item->total_debit}} DBDT "></i></td>
                                  </tr>
                                  @php
                                        $i++;
                                    @endphp
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <span class="float-left">{{ $ref_start }}</span>
                                <span class="float-right">{{ $ref_today }}</span>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">My active reffered members</h3>

                                <div class="card-tools">
                                    <span class="badge badge-danger">{{ $myrefferedusers }} Members</span>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <ul class="users-list clearfix">
                                    @foreach ($my_reffered_users_list as $item)
                                        <li>
                                            @if ($item->profile_photo_path)
                                                <img style="height:68px; width: 68px;"
                                                    src="{{ URL::to('/') }}/{{ $item->profile_photo_path }}"
                                                    alt="User Image">
                                            @else
                                                <img style="height: 80%; width: 68px"
                                                    src="{{ URL::to('front/assets//images/hm-service-icon-4.png') }}"
                                                    alt="User Image">
                                            @endif
                                            <a class="users-list-name" href="#">{{ $item->name }}</a>
                                            <span class="users-list-date">{{ $item->email }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <a href="{{ url('/user/downline/tree') }}">View All Downline Users</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>

                        <!--/.card -->
                    </div>

                    <div class="col-md-7">
                        <!-- Info Boxes Style 2 -->
                        <div class="card" style="max-height: 970px; overflow-y:scroll; overflow-x:hidden">
                            <div class="card-header">
                                <h3 class="card-title">My Staking Income History</h3>
                            </div>
                            @php
                                $staking_income = DB::table('stake_benefits')
                                    ->where('user_id', Auth::user()->id)
                                    ->orderBy('id', 'DESC')
                                    ->get();

                                $staking_income_total = DB::table('stake_benefits')
                                    ->where('user_id', Auth::user()->id)
                                    ->sum('stake_benefit');
                                $i = 1;
                            @endphp
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Date</th>
                                            <th>Staking Amount</th>
                                            <th>Benefit Amount</th>
                                            <th style="width: 40px">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($staking_income as $item)
                                            @php
                                                $stakes_ammount = DB::table('stakes')
                                                    ->where('id', $item->stake_id)
                                                    ->first();
                                            @endphp
                                            <tr style="text-align: center">
                                                <td>{{ $i }}.</td>
                                                <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}</td>
                                                <td>{{ number_format($stakes_ammount->dbdt_amount, 2, '.', ',') }} DBDT
                                                </td>
                                                <td>{{ number_format($item->stake_benefit, 6, '.', ',') }} DBDT</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <button class="btn btn-sm btn-info" data-toggle="tooltip"
                                                            data-placement="left"
                                                            title="Bonus Will Add To Main Account After End Of Month"><i
                                                                class="far fa-calendar-alt"></i></button>
                                                    @else
                                                        <button class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                            data-placement="left"
                                                            title="Bonus Will Add To Main Account After End Of Staking Period"><i
                                                                class="far fa-calendar-alt"></i></button>
                                                    @endif
                                                </td>
                                            </tr>




                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        <tr style="text-align: center;">
                                            <td style="border-right:hidden"></td>
                                            <td style="border-right:hidden"></td>
                                            <td>Total Benefit</td>
                                            <td style="border-right:hidden">
                                                {{ number_format($staking_income_total, 6, '.', ',') }} DBDT</td>
                                            <td>

                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9804158421402971"
                            crossorigin="anonymous"></script>
                        <!-- unit 1 -->
                        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-9804158421402971"
                            data-ad-slot="6467345007" data-ad-format="auto" data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>

                    <!-- /.col -->
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            {{-- <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Bookmarks</span>
                            <span class="info-box-number">41,410</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                                70% Increase in 30 Days
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Likes</span>
                            <span class="info-box-number">41,410</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                                70% Increase in 30 Days
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Events</span>
                            <span class="info-box-number">41,410</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                                70% Increase in 30 Days
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-danger">
                        <span class="info-box-icon"><i class="fas fa-comments"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Comments</span>
                            <span class="info-box-number">41,410</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                                70% Increase in 30 Days
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div> --}}
            <!-- /.row -->
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <script>
        $('.toastrDefaultInfo').click(function() {
            toastr.info('Complete Task 100% for open the box and become a leader. And Get 20000 to 50000 DBDT Bonus')
        });
        $('.toastrDefaultInfo2').click(function() {
            toastr.info('For Complete The Task Direct Reffer Users and Make Sure Thay Invest $10000 (all user total invest) in Last 60 Days.' )
        });


    </script>
    <!-- /.content-wrapper -->
@endsection
