@extends('backend.user.layouts.master')
@section('content')
@php
$user_detail = DB::table('users')->find($withdraw_details->user_id);
@endphp
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5>Withdraw Details</h5>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Withdraw Details</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          
          @if (session()->has('success'))
          <div class="alert alert-success">
              {{ session()->get('success') }}
          </div>
      @endif

          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> Digitalbdt
                  <small class="float-right">Date: {{ Carbon\Carbon::parse($withdraw_details->created_at)->format('d M Y') }}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                To
                <address>
                  <strong>{{$user_detail->name}}</strong><br>
                  Phone: {{$user_detail->phone}}<br>
                  Email: {{$user_detail->email}}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-6 invoice-col">
                <b>Transection Hash : </b>
                @if ($withdraw_details->withdraw_status == 0)
                Not Paid Yet By Admin
                 @elseif ($withdraw_details->withdraw_status == 2)
                  Rejected By Admin
                 @elseif ($withdraw_details->withdraw_status == 1)
                  #{{$withdraw_details->transaction_hash}}
                 @endif
                
                <br>
                <b>Withdraw ID : </b>{{$withdraw_details->id}} <br>
                <b>Amount : </b> {{$withdraw_details->withdraw_amount}} <br>
                <b>Method : </b> {{$withdraw_details->withdraw_method}} <br>
                <b>Account : </b> {{$withdraw_details->withdraw_method_address}} 
                <br>
                <br>
              </div>
              <!-- /.col -->
              <div class="col-sm-2 invoice-col">
                From
                <address>
                  <strong>Accounts</strong><br>
                  Digital BDT<br>
                  {{ Carbon\Carbon::parse($withdraw_details->updated_at)->format('d M Y') }}
                  
                </address>
                
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Withdraw Amount</th>
                    <th>Tax</th>
                    <th>Charge</th>
                    <th>Commission</th>
                    <th>User Will Receive</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <tr>
                    <td>1</td>
                    <td>{{$withdraw_details->withdraw_amount}} DBDT</td>
                    <td>{{$withdraw_details->withdraw_tax}} DBDT</td>
                    <td>{{$withdraw_details->withdraw_charge}} DBDT</td>
                    <td>{{$withdraw_details->withdraw_commission}} DBDT</td>
                    <td>{{$withdraw_details->withdraw_amount-$withdraw_details->withdraw_commission-$withdraw_details->withdraw_charge-$withdraw_details->withdraw_tax}} DBDT</td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

           
            <!-- /.row -->

            <!-- this row will not appear when printing -->

          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


    @endsection
