@extends('backend.user.layouts.master')
@section('title')
    DBDT- Confirm Package
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Confirm Package</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item "><a href="{{ url('/dashboard') }}">Dashboard</a></li>

              <li class="breadcrumb-item active">Confirm Package</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">



            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <img style="height: 50px" src="{{ URL::to('front/assets/images/logo.svg') }}"> Digital BDT
                    <small class="float-right">Date: <?php echo date("d-M-Y");?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>{{ Auth::user()->name }}</strong><br>

                    Phone: {{ Auth::user()->phone }}<br>
                    Email: {{ Auth::user()->email }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>Digital BDT</strong><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #000</b><br>

                  
                  <b>Payment Due: </b><?php echo date("d-M-Y");?><br>
                  {{-- <b>Account:</b> 968-34567 --}}
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
@php
        $package_id = session()->get('package_id');

    $package = DB::table('packages')->where('id', $package_id)->first();
@endphp
              <!-- Table row -->
              
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  {{-- <p class="lead " style="text-align: center" >Payment Notes:</p> --}}
                  {{-- <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}

                 

                         <br>
                            <table  style="table-layout: fixed; width: 100%">
								@php
                                $deposit_methods = DB::table('deposit_methods')->get();
                            @endphp
								
								@if($deposit_methods)
								                                @foreach ($deposit_methods as $deposit_method)

                                <tr>
                                  <td style="word-wrap: break-word; width:30%"><h6>{{$deposit_method->name}}:</h6></td>
                                  <td style="word-wrap: break-word; width:50%"><h6 id="{{$deposit_method->id}}">{{$deposit_method->address}}</h6></td>
									<td style="word-wrap: break-word; width:20%"><button class="btn btn-block btn-outline-success btn-sm"  onclick="CopyToClipboard('{{$deposit_method->id}}');return false;">Copy</button></td>
                                </tr>
								@endforeach
								@endif
                               
                              </table>
                          </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due <?php echo date("d-M-Y");?></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Package Price:</th>
                        <td>$ {{ $package->usdtprice }}</td>
                      </tr>
                      <tr>
                        <th>Tax (3%)</th>
                        @php
                            $vat=$package->usdtprice*3/100;
                            $subtotal=$vat+$package->usdtprice;
                        @endphp
                        <td>$ {{ $vat }} </td>
                      </tr>

                      <tr>
                        <th>Subtotal:</th>
                        <td><b>$ {{ $subtotal }}</b> </td>
                      </tr>
                    </table>
                  </div>

                  <p class="lead">Description</p>
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Total DBDT:</th>
                        <td> {{ $package->dbdtprice }} DBDT</td>
                      </tr>
                      <tr>
                        <th style="width:50%">Withdraw DBDT:</th>
                        <td> {{ $package->withdraw_dbdt }} DBDT</td>
                      </tr>
                      <tr>
                        <th style="width:50%">Staking DBDT:</th>
                        <td> {{ $package->staking_dbdt }} DBDT</td>
                      </tr>
                      <tr>
                        <th style="width:50%">Fridge DBDT:</th>
                        <td> {{ $package->frozen_dbdt }} DBDT</td>
                      </tr>

                      <tr>
                        <th style="width:50%">Override Level:</th>
                        <td> {{ $package->overridelevel }} Genaretion</td>
                      </tr>

                      <tr>
                        <th style="width:50%">Mastercard:</th>
                        <td> {{ $package->mastercard_type }} Mastercard</td>
                      </tr>
                      <tr>
                        <th style="width:50%"> Bonus Duration: </th>
                        <td> {{ $package->bonus_period }} Months</td>
                      </tr>
                      
                    </table>
                  </div>

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Payment Notes:</h5>
                To activate your account please pay the equal amount of the package and then submit the transaction hash# 
              </div>
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button type="button" data-toggle="modal" data-target="#modal-success" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Make
                    Payment
                  </button>
                  <button type="button" onclick="window.print()" class="btn btn-default" style="margin-right: 5px;">
                    <i class="fas fa-print"></i> Print
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
         <!-- /.modal -->

         <div class="modal fade" id="modal-success">
            <div class="modal-dialog">
              <div class="modal-content bg-success">
                <div class="modal-header">
                  <h4 class="modal-title">Payment Confirmation </h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/user/invoice-payment">
                      @csrf
                        <div class="card-body">
                          <div class="form-group">
                            <label for="pay_code">Transaction Hash#</label>
                            <input type="text" class="form-control" id="pay_code" name="pay_code" placeholder="Enter your transaction hash# here">
                          </div>
                        </div>
                        <!-- /.card-body -->



                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>

                  <button type="submit" class="btn btn-outline-light">Submit</button>
                </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
<script>
    function CopyToClipboard(id)
    {
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
@endsection
