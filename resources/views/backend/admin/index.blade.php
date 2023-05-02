@extends('backend.admin.layouts.master')
@section('content')
    @php
    $web_details = DB::table('settings')
        ->latest()
        ->first();
    @endphp

    @php
    $account_dbdt = DB::table('accounts')->sum('dbdt_balance');
    $withdraw_balance = DB::table('accounts')->sum('withdraw_balance');
    $staking_balance = DB::table('accounts')->sum('repurchase_balance');

    @endphp
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Dashboard</h1>
                    </div><!-- /.col -->
                    {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div><!-- /.col --> --}}
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->

        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <h6 class="m-0">Account Details</h6>
                <br>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1">
                                @if ($web_details)
                                    <img src="{{ URL::to('/') }}/{{ $web_details->website_logo_path }}">
                                @endif
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">DBDT Balance</span>
                                <span class="info-box-number">

                                    @if ($account_dbdt)
                                        {{ number_format($account_dbdt, 2, '.', ',') }}
                                        <small>DBDT</small>

                                        <br>
                                        {{ number_format($account_dbdt * $web_details->usd_dbdt, 2, '.', ',') }}
                                        $
                                    @else
                                        <small>DBDT</small>
                                        0
                                    @endif
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1">
                                @if ($web_details)
                                    <img src="{{ URL::to('/') }}/{{ $web_details->website_logo_path }}">
                                @endif
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Withdraw Balance</span>
                                <span class="info-box-number">
                                    @if ($withdraw_balance)
                                        {{ number_format($withdraw_balance, 2, '.', ',') }}
                                        <small>DBDT</small>
                                        <br>
                                        {{ number_format($withdraw_balance * $web_details->usd_dbdt, 2, '.', ',') }}
                                        $
                                    @else
                                        0 <small>DBDT</small>
                                    @endif

                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1">
                                @if ($web_details)
                                    <img src="{{ URL::to('/') }}/{{ $web_details->website_logo_path }}">
                                @endif
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Staking Balance</span>
                                <span class="info-box-number">
                                    @if ($staking_balance)
                                        {{ number_format($staking_balance, 2, '.', ',') }}
                                        <small>DBDT</small>
                                        <br>
                                        {{ number_format($staking_balance * $web_details->usd_dbdt, 2, '.', ',') }}
                                        $
                                    @else
                                        0 <small>DBDT</small>
                                    @endif
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                @php
                                    $all_sales = DB::table('pack_invoices')
                                        ->where('status', '1')
                                        ->sum('subtotal');
                                @endphp
                                <h3>
                                    @if ($all_sales)
                                        {{ $all_sales }}
                                        <sup style="font-size: 20px">$</sup>
                                    @else
                                        0 <sup style="font-size: 20px">$</sup>
                                    @endif
                                </h3>

                                <p>Total Package Sale</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-social-usd-outline"></i>
                            </div>
                            <a href="#" class="small-box-footer swalDefaultInfo">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                @php
                                    $all_sales_up = DB::table('pack_upgrades')
                                        ->where('status', '1')
                                        ->sum('subtotal');
                                @endphp
                                <h3>
                                    @if ($all_sales_up)
                                        {{ $all_sales_up }}
                                        <sup style="font-size: 20px">$</sup>
                                    @else
                                        0 <sup style="font-size: 20px">$</sup>
                                    @endif
                                </h3>

                                <p>Total Package Upgrade</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer swalDefaultInfo">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                @php
                                    $active_members = DB::table('users')
                                        ->where('role', 'user')
                                        ->where('status', '1')
                                        ->count();
                                @endphp
                                <h3>
                                    @if ($active_members)
                                        {{ $active_members }}
                                    @else
                                        0
                                    @endif
                                </h3>

                                <p>Active Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ url('/admin/user-list') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                @php
                                    $all_members = DB::table('users')
                                        ->where('role', 'user')
                                        ->count();
                                @endphp
                                <h3>
                                    @if ($all_members)
                                        {{ $all_members }}
                                    @else
                                        0
                                    @endif
                                </h3>

                                <p>Total Registration</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-android-contacts"></i>
                            </div>
                            <a href="{{ url('/admin/user-list') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <div class="row">

                    <!-- /.col -->

                    <div class="col-md-5">
                        <!-- USERS LIST -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Latest Active Users</h3>

                                <div class="card-tools">
                                    <span class="badge badge-danger">
                                        @if ($active_members)
                                            {{ $active_members }}
                                        @else
                                            0
                                        @endif Users
                                    </span>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button> --}}
                                </div>
                            </div>
                            @php
                                $active_members_details = DB::table('users')
                                    ->where('role', 'user')
                                    ->where('status', '1')
                                    ->orderByRaw('created_at DESC')
                                    ->limit(4)
                                    ->get();
                            @endphp
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <ul class="users-list clearfix">
                                    @if ($active_members_details)
                                        @foreach ($active_members_details as $item)
                                            <li class="mb-3">
                                                @if ($item->profile_photo_path)
                                                    <img src="{{ URL::to('/') }}/{{ Auth::user()->profile_photo_path }}"
                                                        class="img-circle elevation-2" alt="DBDT">
                                                @else
                                                    <img src="https://media.istockphoto.com/vectors/vector-businessman-black-silhouette-isolated-vector-id610003972?k=20&m=610003972&s=612x612&w=0&h=-Nftbu4sDVavoJTq5REPpPpV-kXH9hXXE3xg_D3ViKE="
                                                        alt="User Image">
                                                @endif
                                                <a class="users-list-name"
                                                    href="{{ url('/admin/user/details/' . $item->id) }}">{{ $item->name }}</a>
                                                <span class="users-list-date">{{ $item->email }}</span>
                                            </li>
                                        @endforeach
                                    @endif


                                </ul>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <a href="{{ url('/admin/user-list') }}">View All Users</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!--/.card -->
                    </div>

                    <div class="col-md-7">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Package Sales Report</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @php
                                $package_total=DB::table('packages')
                                        ->where('status', 'Active')
                                        ->get();
                                @endphp

                                @if($package_total)
                               @foreach($package_total as $item)

                               @php
                                $sale_count = DB::table('orders')
                                        ->where('status', 1)
                                        ->where('package_id', $item->id)
                                        ->count();
                               @endphp
                                <div class="info-box mb-3 bg-success">
                                    <span class="info-box-icon"><i class="far fa-heart"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Package Name</span>
                                        <span style="float: right;" class="info-box-number">{{$item->packagename}}</span>
                                    </div>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Count Sales</span>
                                        <span style="float: right;" class="info-box-number">
                                        @if($sale_count)
                                        {{$sale_count}}
                                        @else
                                        0
                                        @endif
                                        </span>
                                    </div>
                                    <a href="{{ url('/admin/package/sales/details/'.$item->id)}}" style="margin: auto">
                                        <button class="btn btn-sm btn-outline-dark"><i class="fas fa-info-circle"></i></button>
                                    </a>
                                    <!-- /.info-box-content -->
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>


                    <!-- /.col -->
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>

            <!-- /.row -->
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'center',
                showConfirmButton: false,
                timer: 1500
            });


            $('.swalDefaultInfo').click(function() {
                Toast.fire({
                    icon: 'question',
                    title: 'Sorry!! Module Under Construction.'
                })
            });



        });
    </script>
    <script>
        $('.toastcon').click(function() {
            toastr.error('This module is in under construction')
        });
    </script>
@endsection
