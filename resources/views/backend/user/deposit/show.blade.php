@extends('backend.user.layouts.master')
@section('title')
    DBDT-Deposit DBDT
@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Deposit List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Deposit List</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @if (session('status'))
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
          title: 'Request send successfully'
        })
         </script>
        @endif
    

    
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">My Deposit List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped " style="text-align: center">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Deposit Date</th>
                            <th>Deposit Amount</th>
                            <th>Deposit Type</th>
                            <th>Paid By</th>
                            <th>Transaction Hash#</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($deposits)
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($deposits as $item)


                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }} ({{ Carbon\Carbon::parse($item->created_at)->format('h:i A') }})</td>
                                    <td>{{ $item->amount }}</td>
                                    @if($item->type==1)
                                    <td>Withdraw Balance</td>
                                    @elseif($item->type==2)
                                    <td>Repurchase Balance</td>
                                    @endif
                                   
                                    <td>{{ $item->paid_by }}</td>
                                    <td>
                                        {{ $item->hash }}
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                        <button type="button" class="btn btn-sm btn-info" ><i class="fas fa-check"></i> Accepted</button>
                                        @elseif($item->status == 2)
                                        <button type="button" class="btn btn-sm btn-warning" ><i class="fas fa-times-circle"></i> Denied</button>
                                        @elseif($item->status == 0)
                                        <button type="button" class="btn btn-sm btn-info" ><i class="fas  fa-sync-alt fa-spin"></i> On-process</button>

                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/user/deposit/details/'.$item->id) }}" class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i> </a>

                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                                
                            @endforeach
                        @endif

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Withdraw Date</th>
                            <th>Withdraw Amount</th>
                            <th>Withdraw Method</th>
                            <th>Account Address</th>
                            <th>Transaction Hash#</th>
                            <th>Status</th>
                            <th>Details</th>

                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>
@endsection
