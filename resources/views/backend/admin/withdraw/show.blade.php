@extends('backend.admin.layouts.master')
@section('title')
    DBDT-Withdraw list
@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All Withdraw List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Withdraw DBDT List</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped " style="text-align: center">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th> Date</th>
                                <th> User Details</th>
                                <th>Withdraw Amount</th>
                                <th>Send Amount</th>
                                <th>Method</th>
                                <th>Account Address</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($withdraw_lists)
                                @php
                                    $i = 1;
                                    $setting = DB::table('withdraw_settings')
                                        ->latest()
                                        ->first();
                                    
                                @endphp
                                @foreach ($withdraw_lists as $item)
                                    @php
                                        $withdraw_commission = $setting->withdraw_commission;
                                        $withdraw_tax = $setting->withdraw_tax;
                                        $charge = $setting->withdraw_charge;
                                        
                                        $commision = ($item->withdraw_amount / 100) * $withdraw_commission;
                                        $tax = ($item->withdraw_amount / 100) * $withdraw_tax;
                                        $send_amount = $item->withdraw_amount - $commision - $tax - $charge;
                                        
                                        $user_detail = DB::table('users')->find($item->user_id);
                                        
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>


                                        <td><a class="btn btn-sm btn-outline-info"
                                                href="{{ url('/admin/user/details/' . $item->user_id) }}">{{ $user_detail->name }}</a>
                                        </td>
                                        <td>{{ $item->withdraw_amount }}</td>
                                        <td>{{ $send_amount }}</td>
                                        <td>{{ $item->withdraw_method }}</td>
                                        <td><button data-toggle="modal" data-target="#exampleModalssa{{ $item->id }}"
                                                class="btn btn-sm"><i class="fas fa-eye"
                                                    style="font-size:20px;color:rgb(22, 19, 202)"></i></button></td>















                                        <td>
                                            @if ($item->withdraw_status == 1)
                                                <span class="btn btn-sm btn-primary"><i class="fas fa-thumbs-up"></i></span>
                                            @elseif($item->withdraw_status == 2)
                                                <span class="btn btn-sm btn-danger"><i
                                                        class="fas fa-thumbs-down"></i></span>
                                            @elseif($item->withdraw_status == 0)
                                                <span class="btn btn-sm btn-info"><i class="fas  fa-sync-alt fa-spin"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->withdraw_status == 0)
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#modal-info{{ $item->id }}"><i
                                                        class="fas fa-thumbs-up"></i> Accept</button>
                                                <a href="/admin/withdraw/deny/{{ $item->id }}"
                                                    class="btn btn-sm btn-danger"><i class="fas fa-thumbs-down"></i>
                                                    Deny</a>
                                            @elseif($item->withdraw_status == 1)
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#modal1{{ $item->id }}"> Accepted</button>
                                            @elseif($item->withdraw_status == 2)
                                                <button type="button" class="btn btn-sm btn-info"> Denied</button>
                                            @endif
                                        </td>
                                        <td><a class="btn btn-sm btn-outline-primary"
                                            href="{{ url('/admin/withdraw/details/' . $item->id) }}">Details</td>


                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    <div class="modal fade" id="modal-info{{ $item->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-info">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Enter transaction hash# for accept
                                                        {{ $item->id }}</h4>
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
                                                                        value="{{ $item->id }}">

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

                                    <div class="modal fade" id="modal1{{ $item->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-info">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Transaction hash#</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card ">

                                                        <!-- /.card-header -->
                                                        <div class="card-body bg-info" style="color: black">

                                                            <h4> #{{ $item->transaction_hash }}</h4>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                </div>
                                                {{-- <div class="modal-footer justify-content-between">
                                              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                               <button type="submit" class="btn btn-outline-light">Accept Withdraw</button>  
                                           
                                            </div> --}}
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <div class="modal fade" id="exampleModalssa{{ $item->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                                <div class="modal-body">
                                                    {{ $item->withdraw_method_address }}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th> Date</th>
                                <th> User Details</th>
                                <th>Withdraw Amount</th>
                                <th>Send Amount</th>
                                <th>Method</th>
                                <th>Account Address</th>
                                <th>Status</th>
                                <th>Action</th>
                                <td>Details</td>


                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </section>

    </div>

@endsection
