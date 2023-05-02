@extends('backend.user.layouts.master')
@section('title')
    DBDT-Transfer DBDT
@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Transfer List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ url('/user/new-transfer') }}" style="float: right;" class="btn btn-outline-primary" >
                                Transfer DBDT now
                            </a>
                        </ol>
                    </div
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
                <h3 class="card-title">My Transfer List</h3>
                
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped " style="text-align: center">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Transfer Date</th>
                            <th>Receiver Username</th>
                            <th>Receiver Email</th>
                            <th>Transfer Amount</th>
                            <th>Transfer Charge</th>
                            
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($deposits)
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($deposits as $item)

@php
$reciver_details= DB::table('users')->where('id', $item->receiver_id)->first();
@endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }} ({{ Carbon\Carbon::parse($item->created_at)->format('h:i A') }})</td>
                                    <td>{{$reciver_details->username}}</td>
                                    <td>{{$reciver_details->email}}</td>
                                   
                                    <td>{{ $item->transfer_total_amount }}</td>
                                    <td>
                                        {{ $item->transfer_charge }}
                                    </td>
                                    <td>
                                      
                                        <button type="button" class="btn btn-sm btn-info" ><i class="fas fa-check"></i> </button>
                                        
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
                            <th>Transfer Date</th>

                            <th>Receiver Username</th>
                            <th>Receiver Email</th>
                            <th>Transfer Amount</th>
                            <th>Transfer Charge</th>
                            
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>
@endsection
