@extends('backend.user.layouts.master')
@section('title')
    DBDT-Withdraw DBDT
@endsection


        
@section('content')
    @php
    $user_account_details = DB::table('accounts')
        ->where('user_id', Auth::user()->id)
        ->first();
    $user_pack = DB::table('pack_invoices')
        ->where('user_id', Auth::user()->id)
        ->first();
    if ($user_pack) {
        $user_pack_details = DB::table('packages')
            ->where('id', $user_pack->package_id)
            ->first();
    }
    $withdraw_settings = DB::table('withdraw_settings')
        ->latest()
        ->first();
    if ($withdraw_settings->pack_value_withdraw_status == 0 && $withdraw_settings->commission_withdraw_status == 1) {
        $can_withdraw = $user_account_details->withdraw_balance - $user_pack_details->dbdtprice / 2;
    } elseif ($withdraw_settings->pack_value_withdraw_status == 1 && $withdraw_settings->commission_withdraw_status == 0) {
        $a = $user_account_details->withdraw_balance - $user_pack_details->dbdtprice / 2;
        if ($a < 0) {
            $can_withdraw = 0;
        } else {
            $can_withdraw = $a;
        }
    } elseif ($withdraw_settings->pack_value_withdraw_status == 1 && $withdraw_settings->commission_withdraw_status == 1) {
        $can_withdraw = $user_account_details->withdraw_balance;
    } else {
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
    <style>
        .submit-area {
            padding: 30px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 5px 5px gray;
            color: white;
            background-color: royalblue;
        }

        #account-area {
            margin-top: 5%;
        }

        .deposit {
            background-color: slateblue;
        }

        .withdraw {
            background-color: lightsalmon;
        }

        /* .balance {
                background-color: tomato;
            } */

        .status {
            margin: 0 20px;
            color: white;
            padding: 20px;
            border-radius: 10px;
        }

    </style>
    @php
    $my_account_details = DB::table('accounts')
        ->where('user_id', Auth::user()->id)
        ->first();
    @endphp



@if (session('status_success'))
        <script>
         const Toast = Swal.mixin({
          toast: true,
          position: 'center',
          showConfirmButton: false,
          timer: 6000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        
        Toast.fire({
          icon: 'success',
          title: 'Transfer DBDT successfully done'
        })
         </script>
        @endif
        @if (session('status_deny'))
        <script>
         const Toast = Swal.mixin({
          toast: true,
          position: 'center',
          showConfirmButton: false,
          timer: 6000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        
        Toast.fire({
          icon: 'error',
          title: 'Sorry Invalid Receiver Email.'
        })
         </script>
        @endif
        @if (session('status_denyed'))
        <script>
         const Toast = Swal.mixin({
          toast: true,
          position: 'center',
          showConfirmButton: false,
          timer: 6000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        
        Toast.fire({
          icon: 'error',
          title: 'Sorry account not active.'
        })
         </script>
        @endif


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Transfer DBDT</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Transfer DBDT</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row ">

                    <!-- /.col -->


                    <div class="col-md-12">
                        <div class="card  bg-warning">

                            <div class="card-body">
                                <section class="content">
                                    <div class="container-fluid">
                                        <h5 class="mb-2">Transfer Information</h5>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6 col-12 ">
                                                <div class="info-box bg-primary">
                                                    <div class="info-box-content ">
                                                        <span class="info-box-text">Total Balance</span>
                                                        <span class="info-box-number">
                                                            @if ($user_account_details)
                                                                <span id="withdraw_bal">
                                                                    {{ number_format($user_account_details->dbdt_balance, 2, '.', ',') }}
                                                                </span>
                                                                <input type="hidden" id="total_withdraw_balance"
                                                                    value="{{ $user_account_details->withdraw_balance }}">
                                                            @endif DBDT
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-4 col-sm-6 col-12">
                                                <div class="info-box bg-primary">
                                                    {{-- <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span> --}}

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">You Can Transfer Now</span>
                                                        <span class="info-box-number">
                                                            @if ($user_account_details)
                                                                <span id="can_withdraw_bal">
                                                                    {{ number_format($can_withdraw, 2, '.', ',') }}
                                                                </span>
                                                                <input type="hidden" id="can_withdraw_balance"
                                                                    value="{{ $can_withdraw }}">
                                                            @endif DBDT
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->

                                            <!-- /.col -->

                                            <div class="col-md-3 col-sm-6 col-12">
                                                <div class="info-box bg-danger">

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Charge</span>
                                                        <span class="info-box-number">
                                                            @if ($withdraw_settings)
                                                                {{ number_format($withdraw_settings->withdraw_charge, 2, '.', ',') }}

                                                            @else
                                                                0
                                                            @endif DBDT
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                    </div><!-- /.container-fluid -->
                                </section>
                            </div>
                        </div>
                    </div>




                </div>
                <div class="row ">

                    <!-- /.col -->


                    <div class="col-md-12">
                        <div class="card  bg-primary">

                            <div class="card-body">
                                <section class="content">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12 ">
                                            <div class="info-box bg-warning">
                                                <div class="info-box-content ">
                                                    <p class="lead">Transfer Date (@php
                                                        echo date('d M Y');
                                                    @endphp)</p>

                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tr>
                                                                <th style="width:50%">Transfer Ammount:</th>
                                                                <td> <span id="withdraw_ammount1">0.00</span> DBDT</td>
                                                            </tr>


                                                            <tr>
                                                                <th>Charge:</th>
                                                                <td>
                                                                    @if ($withdraw_settings)
                                                                        {{ number_format($withdraw_settings->withdraw_charge, 2, '.', ',') }}

                                                                    @else
                                                                        0
                                                                    @endif DBDT
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Receiver will get:</th>
                                                                <td><span id="todal_withdraw">0.00</span> DBDT</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="info-box bg-warning">
                                                {{-- <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span> --}}
                                                @php
                                                    $my_payment_methods = DB::table('payment_methods')
                                                        ->where('user_id', Auth::user()->id)
                                                        ->get();
                                                @endphp
                                                <div class="info-box-content">
                                                    <section class="content">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card card-primary">
                                                                    <div class="card-header">
                                                                        <h5 class="card-title">Transfer DBDT</h5>

                                                                        <div class="card-tools">
                                                                            <button type="button" class="btn btn-tool"
                                                                                data-card-widget="collapse"
                                                                                title="Collapse">
                                                                                <i class="fas fa-minus"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <form method="POST" action="/user/new-transfer-create">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label for="withdraw_ammount">Transfer
                                                                                    Ammount</label>
                                                                                <input required type="number"
                                                                                    onkeyup="myFunction()"
                                                                                    id="withdraw_ammount" name="transfer_amount" min="50"
                                                                                    max="{{ $can_withdraw }}" step="0.01"
                                                                                    title="Currency"
                                                                                    pattern="^\d+(?:\.\d{1,2})?$"
                                                                                    class="form-control">
                                                                                <input type="hidden" id="withdraw_tax"
                                                                                    value=" @if ($withdraw_settings)
                                                                                {{ $withdraw_settings->withdraw_tax }}
                                                                            @else
                                                                                0
                                                                                @endif">
                                                                                <input type="hidden" id="withdraw_commision"
                                                                                    value=" @if ($withdraw_settings)
                                                                                {{ $withdraw_settings->withdraw_commission }}
                                                                            @else
                                                                                0
                                                                                @endif">
                                                                                <input type="hidden" id="withdraw_charge"
                                                                                    value=" @if ($withdraw_settings)
                                                                                {{ $withdraw_settings->withdraw_charge }}
                                                                            @else
                                                                                0
                                                                                @endif">


                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="account_id">Receiver
                                                                                    Email</label>

                                                                                <br>
                                                                                <input type="email" name="user_name"
                                                                                    class="form-control" placeholder="Receiver Email">
                                                                                    
                                                                            </div>



                                                                            <div class="form-group">
                                                                                @if ($can_withdraw < 50)
                                                                                    <a disabled 
                                                                                        class="btn btn-success float-right notEnoughBalance">Transfer
                                                                                        DBDT</a>
                                                                                @else
                                                                                    <input type="submit"
                                                                                        value="Transfer DBDT"
                                                                                        class="btn btn-success float-right">
                                                                                @endif

                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <!-- /.card-body -->
                                                                </div>
                                                                <!-- /.card -->
                                                            </div>

                                                    </section>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>



                                        <!-- /.col -->
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </section>

    </div>
    <script>
        function myFunction() {
            let userInput = document.getElementById('withdraw_ammount').value;
            let userCharge = document.getElementById('withdraw_charge').value;
            // var b= userInput*3;
            document.getElementById("withdraw_ammount1").innerHTML = userInput;

            document.getElementById("todal_withdraw").innerHTML = userInput - userCharge;

        }
    </script>
    
    <script>
        $('.notEnoughBalance').click(function() {
            toastr.error('Sorry you do not have enough balance for withdraw!')
        });
    </script>
@endsection
