@extends('backend.admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0">Package Sales</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="container">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('sales_report_search') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Select Package</label>
                                        <select class="custom-select" name="package_id" id="package_id">
                                            @foreach ($packages as $item)
                                                <option value="{{ $item->id }}">{{ $item->packagename }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Start Date</label>
                                        <input type="date" required name="start_date" class="form-control"
                                            max="<?php echo date('Y-m-d', strtotime('yesterday')); ?>" id="start_date" onchange="getDays()">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">End Date</label>
                                        <input type="date" required name="end_date" max="<?php echo date('Y-m-d'); ?>" class="form-control"
                                            id="end_date" onchange="getDays2()">
                                    </div>
                                </div>

                            </div>
                            <button type="submit" style="float: right;" class="btn btn-outline-primary">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">DataTable with default features</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="example1" width="100%" cellspacing="0">
                    <thead>
                        
                            
                    <tr>
                      <th>Date</th>
                      <th>Package</th>
                      <th>First Package</th>
                      <th>User</th>
                      <th>Order#</th>
                      <th>Tax</th>
                      <th>Payment #</th>
                      {{-- <th>Status</th> --}}
                      <th>Total Amount</th>
                      
                    </tr>
                

                    </thead>
                    <tbody>
                        @foreach ($sales as $item)

                        @php
                             $package_details = DB::table('packages')->where('id', $item->package_id)->first();
                             $first_package_details = DB::table('packages')->where('id', $item->first_packege)->first();
                        $a= DB::table('users')->where('id', $item->user_id)->first();
                     @endphp
                    <tr style="max-height: 20px !important;">
                        <td>{{$item->created_at}}</td>
                        <td>{{$package_details->packagename}}</td>
                        <td>{{$first_package_details->packagename}}</td>
                        <td><a href="{{ url('/admin/user/details/'.$item->user_id) }}"> <i class="fas fa-user"></i></a></td>
                        <td>{{$item->order_id}}</td>
                        <td>{{$item->tax}}</td>
                        <td style="max-width: 30px;">{{$item->pay_code}}</td>
                        {{-- <th>{{$item->status}}</th> --}}
                        <td>{{$item->subtotal}}</td>

                    </tr>
                    @endforeach
                <tfoot>
                    <tr style="max-height: 20px !important;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total Tax :</td>
                        <td>{{$total_tax}} USD</td>
                        <td >Total Sales :</td>
                        
                        <td>{{$total_sales}} USD</td>

                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            
        </div>
    </div>
    <script>
        function getDays() {
            document.getElementById("end_date").min = document.getElementById('start_date').value;
        }

        function getDays2() {
            document.getElementById("start_date").max = document.getElementById('end_date').value;
        }
    </script>

  
@endsection
