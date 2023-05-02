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
            ->where('id', $user_pack->first_packege)
            ->first();
    }
    $withdraw_settings = DB::table('withdraw_settings')
        ->latest()
        ->first();
    if ($withdraw_settings->pack_value_withdraw_status == 0 && $withdraw_settings->commission_withdraw_status == 1) {
        $can_withdraw = $user_account_details->withdraw_balance - $user_account_details->withdraw_base;
        if ($can_withdraw < 0) {
            $can_withdraw = 0;
        } else {
            $can_withdraw = $can_withdraw;
        }
    } elseif ($withdraw_settings->pack_value_withdraw_status == 1 && $withdraw_settings->commission_withdraw_status == 0) {
        $a = $user_account_details->withdraw_balance - $user_account_details->withdraw_base;
        if ($a < 0) {
            $can_withdraw = 0;
        } else {
            $can_withdraw = $a;
        }
    } elseif ($withdraw_settings->pack_value_withdraw_status == 1 && $withdraw_settings->commission_withdraw_status == 1) {
        $can_withdraw = $user_account_details->withdraw_balance;
        if ($can_withdraw < 0) {
            $can_withdraw = 0;
        } else {
            $can_withdraw = $can_withdraw;
        }
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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Withdraw DBDT</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Withdraw DBDT</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @if (session('otp_deny'))
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
          title: 'Sorry OTP Not Mached.'
        })
         </script>
        @endif
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
                                        <h5 class="mb-2">Withdraw Information</h5>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6 col-12 ">
                                                <div class="info-box bg-primary">
                                                    <div class="info-box-content ">
                                                        <span class="info-box-text">Withdraw Balance</span>
                                                        <span class="info-box-number">
                                                            @if ($user_account_details)
                                                                <span id="withdraw_bal">
                                                                    {{ number_format($user_account_details->withdraw_balance, 2, '.', ',') }}
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
                                            <div class="col-md-3 col-sm-6 col-12">
                                                <div class="info-box bg-primary">
                                                    {{-- <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span> --}}

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">You Can Withdraw Now</span>
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
                                            <div class="col-md-2 col-sm-6 col-12">
                                                <div class="info-box bg-danger">

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Tax</span>
                                                        <span class="info-box-number">
                                                            @if ($withdraw_settings)
                                                                {{ $withdraw_settings->withdraw_tax }}
                                                            @else
                                                                0
                                                            @endif %
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-2 col-sm-6 col-12">
                                                <div class="info-box bg-danger">

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Commision</span>
                                                        <span class="info-box-number">
                                                            @if ($withdraw_settings)
                                                                {{ $withdraw_settings->withdraw_commission }}
                                                            @else
                                                                0
                                                            @endif
                                                            %
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-12">
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
                                                    <p class="lead">Withdraw Date (@php
                                                        echo date('d M Y');
                                                    @endphp)</p>

                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tr>
                                                                <th style="width:50%">Withdraw Ammount:</th>
                                                                <td> <span id="withdraw_ammount1">0.00</span> DBDT</td>
                                                            </tr>
                                                            <tr>
                                                                <th> Withdraw Tax: @if ($withdraw_settings)
                                                                        (
                                                                        {{ $withdraw_settings->withdraw_tax }}
                                                                    @else
                                                                        0
                                                                    @endif
                                                                    %)</th>
                                                                <td><span id="withdraw_ammount2">0.00</span> DBDT</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Commision:( @if ($withdraw_settings)
                                                                        {{ $withdraw_settings->withdraw_commission }}
                                                                    @else
                                                                        0
                                                                    @endif
                                                                    %)</th>
                                                                <td><span id="withdraw_ammount3">0.00</span> DBDT</td>
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
                                                                <th>You will get:</th>
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
                                                                        <h5 class="card-title">Withdraw DBDT</h5>

                                                                        <div class="card-tools">
                                                                            <button type="button" class="btn btn-tool"
                                                                                data-card-widget="collapse"
                                                                                title="Collapse">
                                                                                <i class="fas fa-minus"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <form method="POST" class="form-horizontal" action="{{ route('withdraw.dbdt') }}">
                                                                            @csrf
                                                                            {{-- <form id="withdrawForm"> --}}
                                                                            <div class="form-group">
                                                                                <label for="withdraw_ammount">Withdraw
                                                                                    Ammount</label>
                                                                                <input required type="number"
                                                                                    onkeyup="myFunction()"
                                                                                    id="withdraw_ammount" name="withdraw_ammount" min="50"
                                                                                    max="{{ $can_withdraw }}" step="0.01"
                                                                                    title="Currency"
                                                                                    pattern="^\d+(?:\.\d{1,2})?$"
                                                                                    class="form-control">
                                                                                <input type="hidden" id="withdraw_tax" name="withdraw_tax"
                                                                                    value="@if ($withdraw_settings) {{ $withdraw_settings->withdraw_tax }}
                                                                                    @else
                                                                                        0 @endif">
                                                                                <input type="hidden" id="withdraw_commision" name="withdraw_commision"
                                                                                    value="@if ($withdraw_settings) {{ $withdraw_settings->withdraw_commission }}
                                                                                    @else
                                                                                        0 @endif">
                                                                                <input type="hidden" id="withdraw_charge" name="withdraw_charge"
                                                                                    value="@if ($withdraw_settings) {{ $withdraw_settings->withdraw_charge }}
                                                                                @else
                                                                                    0 @endif">


                                                                            </div>
                                                                            @if ($my_payment_methods)
                                                                                <div class="form-group">
                                                                                    <label for="account_id">Select Your
                                                                                        Account</label>
                                                                                    <span><a href="{{ url('/user/payment/setting') }}"
                                                                                            class="btn btn-sm btn-primary float-right">Add
                                                                                            Account</a></span>
                                                                                    <br>
                                                                                    <select id="account_id" name="account_id" required
                                                                                        class="form-control custom-select">
                                                                                        <option selected disabled>Select one
                                                                                            Account
                                                                                        </option>
                                                                                        @foreach ($my_payment_methods as $item)
                                                                                            @php
                                                                                                $method_name = DB::table('methods')
                                                                                                    ->where('id', $item->method_id)
                                                                                                    ->first();
                                                                                            @endphp
                                                                                            <option
                                                                                                value="{{ $item->id }}">
                                                                                                {{ $method_name->method_name }}
                                                                                            </option>
                                                                                        @endforeach

                                                                                    </select>
                                                                                </div>
                                                                            @else
                                                                                <div class="form-group">
                                                                                    <a href="{{ url('/user/payment/setting') }}"
                                                                                        class="btn btn-primary float-right">Add
                                                                                        Payment Address</a>
                                                                                </div>
                                                                            @endif


                                                                            <div class="form-group">
                                                                                @if ($can_withdraw < 50)
                                                                                    <a disabled type="submit"
                                                                                        class="btn btn-success float-right notEnoughBalance">Withdraw</a>
                                                                                @else
                                                                                    <input type="submit" value="Withdraw"
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
            let userTax = document.getElementById('withdraw_tax').value;
            let userCommision = document.getElementById('withdraw_commision').value;
            let userCharge = document.getElementById('withdraw_charge').value;
            // var b= userInput*3;
            document.getElementById("withdraw_ammount1").innerHTML = userInput;
            document.getElementById("withdraw_ammount2").innerHTML = userInput / 100 * userTax;
            document.getElementById("withdraw_ammount3").innerHTML = userInput / 100 * userCommision;
            document.getElementById("todal_withdraw").innerHTML = userInput - userInput / 100 * userTax - userInput / 100 *
                userCommision - userCharge;

        }
    </script>
    <script>
        $("#withdrawForm").submit(function(e) {
            e.preventDefault();
            let withdraw_amount = $("#withdraw_ammount").val();
            let account_id = $("#account_id").val();
            let _token = $("import [name=_token]").val();

            $.ajax({

                url: "{{ route('withdraw.dbdt') }}",
                type: "POST",
                data: {
                    withdraw_amount: withdraw_amount,
                    account_id: account_id,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {
                        document.getElementById("withdraw_ammount1").innerHTML = '0';
                        document.getElementById("withdraw_ammount2").innerHTML = '0';
                        document.getElementById("withdraw_ammount3").innerHTML = '0';
                        document.getElementById("todal_withdraw").innerHTML = '0';
                        var withdraw_balance_old = document.getElementById('total_withdraw_balance')
                            .value;
                        var can_withdraw_balance_old = document.getElementById('can_withdraw_balance')
                            .value;
                        var withdraw_balance_new = $("#withdraw_ammount").val();
                        var a = withdraw_balance_old - withdraw_balance_new;
                        var b = can_withdraw_balance_old - withdraw_balance_new;
                        document.getElementById("withdraw_bal").innerHTML = a.toFixed(2);
                        document.getElementById("can_withdraw_bal").innerHTML = b.toFixed(2);

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
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
                            title: 'Withdraw Request Send Successfully'
                        })

                    }
                }
            });
        });
    </script>
    <script>
        $('.notEnoughBalance').click(function() {
            toastr.error('Sorry you do not have enough balance for withdraw!')
        });
    </script>
@endsection
