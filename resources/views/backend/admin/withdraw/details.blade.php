@extends('backend.admin.layouts.master')
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
                From
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
                Not Paid To Customer
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
                To
                <address>
                  <strong>Accounts</strong><br>
                  Digital BDT<br>
                  
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
            @if ($withdraw_details->withdraw_status == 0)
            <div class="row no-print">
              <div class="col-12">
                {{-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> --}}
                <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal"
                data-target="#modal-info{{ $withdraw_details->id }}"><i class="fas fa-thumbs-up"></i> Accept Withdraw
                </button>
                <a href="/admin/withdraw/deny/{{ $withdraw_details->id }}"  class="btn btn-danger float-right" style="margin-right: 5px;"> <i class="fas fa-thumbs-down"></i> Reject Withdraw</a>
               
                 
               
              </div>
            </div>
            @endif
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<div class="modal fade" id="modal-info{{ $withdraw_details->id }}">
  <div class="modal-dialog">
      <div class="modal-content bg-info">
          <div class="modal-header">
              <h4 class="modal-title">Enter transaction hash# for accept
                  {{ $withdraw_details->id }}</h4>
              <button type="button" class="close" data-dismiss="modal"
                  aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="card ">

                  <!-- /.card-header -->
                  <div class="card-body" style="color: black">
                      <form method="POST" action="/admin/withdraw/accept">
                          @csrf
                          <div class="from-group">
                              <label for="hash">Transaction hash#</label>
                              <input type="text"
                                  placeholder="Please enter transaction hash#"
                                  class="form-control" id="hash" name="hash">
                              <input type="hidden" name="hash_id"
                                  value="{{ $withdraw_details->id }}">

                          </div>

                  </div>
                  <!-- /.card-body -->
              </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light"
                  data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-outline-light">Accept
                  Withdraw</button>
              </form>
          </div>
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
    @endsection
