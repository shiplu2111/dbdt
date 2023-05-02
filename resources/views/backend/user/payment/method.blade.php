@extends('backend.user.layouts.master')
@section('title')
    DBDT- My Payment Method List
@endsection

@section('content')
@php

            $all_methods = DB::table('methods')->where('status', 'Active')->get();

@endphp
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Payment Methods</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item "><a href="{{ url('/dashboard') }}">Dashboard</a></li>

                            <li class="breadcrumb-item active">Payment Methods</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
@foreach ($all_methods as $item)

@php
$mymethod = DB::table('payment_methods')->where('user_id', Auth::user()->id)->where('method_id',$item->id)->first();

@endphp

                    <div class="col-md-4">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $item->method_name }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="/user/payment-address-add">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="btc_address">{{ $item->method_name }} Wallet ID *</label>
                                        <input type="text" class="form-control" id="method_number" name="method_number"
                                        required
                                         @if ($mymethod)
                                        value="{{ $mymethod->method_number }}"

                                        @endif

                                        placeholder="Enter your {{ $item->method_name }} Wallet Address">
                                        <input type="hidden"  name="method_id" value="{{ $item->id }}">

                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    @endforeach

                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
    </div>

@endsection
