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
                  <b>Invoice #000{{ $invoice->id }}</b><br>

                  <b>Order ID:</b> {{ $invoice->order_id }}<br>
                  <b>Payment Due: </b><?php echo date("d-M-Y");?><br>
                  {{-- <b>Account:</b> 968-34567 --}}
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
@php
    $package = DB::table('packages')->where('id', $invoice->package_id)->first();
@endphp
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Package Name</th>
                      <th>USDT Price</th>
                      <th>DBDT Balance</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>{{ $package->packagename }}</td>
                      <td>{{ $package->usdtprice }}</td>
                      <td>{{ $package->dbdtprice }}</td>
                      <td>{{ $package->usdtprice }}</td>
                    </tr>

                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead " style="text-align: center" >Payment Notes:</p>
                  {{-- <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    For activate your account please pay the total ammount of the package and then submit the transection hash# <br>

                <h6>
                    PayPal: info@pintarman.com

                </h6>
                <h6>
BTC:
1QD5uMDYW1CJNNuRANRgouGp2k1GMip4mG

</h6>
<h6>
ETH:
0xc84eaabc50c500b9ad4dcd9414b79c61e0b932b7
</h6>
<h6>
    USDT: 0xc84eaabc50c500b9ad4dcd9414b79c61e0b932b7
</h6>

<h6>
USDT(TRC20):
TPmyKrMFWRnY6EC7qxzNL7GprGyC51YtT1
</h6>
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
                        <td>$ {{ $subtotal }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Payment Notes:</h5>
                This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
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
                            <label for="exampleInputEmail1">Transection Id</label>
                            <input type="text" class="form-control" id="pay_code" name="pay_code" placeholder="Enter your transection id here">
                            <input type="hidden" name="p_id" value="{{ $invoice->id }}">
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
@endsection
