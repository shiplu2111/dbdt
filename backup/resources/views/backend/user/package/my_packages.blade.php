@extends('backend.user.layouts.master')
@section('title')
    DBDT- Available Package List
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="m-0">My Packages</h2>
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
                        <p>
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped" id="example1" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Package Name</th>
                            <th>USDT Amount</th>
                            <th>DBDT Amount</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Package Name</th>
                            <th>USDT Amount</th>
                            <th>DBDT Amount</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($packages as $item)

                            @if ($item->status === '0')
                                <tr class="table-warning">
                            @endif
                            @if ($item->status === '1')
                                <tr>
                            @endif
                            @if ($item->status === '2')
                                <tr class="table-primary">
                            @endif
                            <td>{{ $i }}</td>
                            @php
                                $package_data = DB::table('packages')
                                    ->where('id', $item->package_id)
                                    ->first();
                            @endphp
                            <td>{{ $package_data->packagename }}</td>
                            <td>{{ $package_data->usdtprice }}</td>
                            <td>{{ $package_data->dbdtprice }}</td>
                            <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}</td>
                            @if ($item->status == 0)
                                <td>Inctive</td>
                                <td><button type="button" data-toggle="modal"
                                        data-target="#modal-success1{{ $item->id }}" class="btn btn-success">
                                        Pay Order
                                    </button>
                                    <span></span> <a onclick="return confirm('Are you sure to delete this order? ')"
                                        class="btn btn-danger"
                                        href="{{ url('/user/delete-packages/' . $item->id) }}">Delete</a>
                                </td>
                            @endif
                            @if ($item->status == 1)
                                <td>Active</td>
                                <td><a class="btn btn-success"
                                        href="{{ url('/user/package/details/' . $item->id) }}">Package Details </a> </td>
                            @endif
                            @if ($item->status == 2)
                                <td>In Review</td>
                                <td><a class="btn btn-success"
                                        href="{{ url('/user/package-details/' . $item->id) }}">Package Details </a> </td>
                            @endif
                            </tr>

                            <!-- /.modal -->

                            <div class="modal fade" id="modal-success1{{ $item->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-success">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Payment Confirmation </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="/user/invoice-payment">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Transection Id</label>
                                                        <input type="text" class="form-control" id="pay_code"
                                                            name="pay_code" placeholder="Enter your transection id here">
                                                        <input type="hidden" name="p_id" value="{{ $item->id }}">
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->



                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-outline-light"
                                                data-dismiss="modal">Close</button>

                                            <button type="submit" class="btn btn-outline-light">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

@endsection
