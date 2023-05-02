@extends('backend.admin.layouts.master')
@section('content')
    @php
    $user_detail = DB::table('users')->find($deposit_details->user_id);
    @endphp
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Deposit Request Details</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Deposit Request Details</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @if (session('status_success'))
        <script>
         const Toast = Swal.mixin({
          toast: true,
          position: 'top',
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
          title: 'Deposite Accepted'
        })
         </script>
        @endif
        @if (session('status_deny'))
        <script>
         const Toast = Swal.mixin({
          toast: true,
          position: 'top',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        
        Toast.fire({
          icon: 'error',
          title: 'Deposite Denied'
        })
         </script>
        @endif
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
                                        <small class="float-right">Date:
                                            {{ Carbon\Carbon::parse($deposit_details->created_at)->format('d M Y') }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>{{ $user_detail->name }}</strong><br>
                                        Phone: {{ $user_detail->phone }}<br>
                                        Email: {{ $user_detail->email }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 invoice-col">
                                    <b>Transaction Hash : </b>

                                    #{{ $deposit_details->hash }}


                                    <br>
                                    <b>Deposit ID : </b>{{ $deposit_details->id }} <br>
                                    <b>Amount : </b> {{ $deposit_details->amount }} <br>
                                    <b>Paid By : </b> {{ $deposit_details->paid_by }} <br>
                                    <b>Type : </b>
                                    @if ($deposit_details->type == 1)
                                        Funding Balance
                                    @else
                                        Staking Balance
                                    @endif
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
                                                <th>Deposit Amount</th>
                                                <th>Deposit Type</th>
                                                <th>Paid By</th>
                                                <th>Hash</th>
                                                <th>
                                                    @if ($deposit_details->status == 0)
                                                        Action
                                                    @else
                                                        Status
                                                    @endif
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>{{ $deposit_details->amount }} DBDT</td>
                                                <td>
                                                    @if ($deposit_details->type == 1)
                                                        Funding Balance
                                                    @else
                                                        Staking Balance
                                                    @endif
                                                </td>
                                                <td>{{ $deposit_details->paid_by }} </td>
                                                <td>#{{ $deposit_details->hash }} </td>
                                                <td>
                                                    @if ($deposit_details->status == 0)
                                                        <a type="button" class="btn btn-sm btn-outline-primary mb-1"
                                                            href="/admin/deposit/accept/{{ $deposit_details->id }}">Accept</a>
                                                        <a type="button"
                                                            href="/admin/deposit/deny/{{ $deposit_details->id }}"
                                                            class="btn btn-sm btn-outline-warning">Deny</a>
                                                    @elseif($deposit_details->status == 1)
                                                        <button class="btn btn-sm btn-outline-success">Accepted</button>
                                                    @elseif($deposit_details->status == 2)
                                                        <button class="btn btn-sm btn-outline-danger">Rejected</button>
                                                    @endif
                                                </td>
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

    <div class="modal fade" id="modal-info{{ $deposit_details->id }}">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">Enter transaction hash# for accept
                        {{ $deposit_details->id }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                    <input type="text" placeholder="Please enter transaction hash#" class="form-control"
                                        id="hash" name="hash">
                                    <input type="hidden" name="hash_id" value="{{ $deposit_details->id }}">

                                </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
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
