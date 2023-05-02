@extends('backend.admin.layouts.master')
@section('title')
    DBDT-Deposit DBDT List
@endsection
@section('content')
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
                <h3 class="card-title">My Withdraw List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped " style="text-align: center">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>User Details</th>
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

@php
                      $user_data = DB::table('users')->where('id', $item->user_id)->first();   

@endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td style="width: 150px"><a href="{{ url('/admin/user/details/'.$item->user_id) }}">{{$user_data->name}}</a></td>
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }} ({{ Carbon\Carbon::parse($item->created_at)->format('h:i A') }})</td>
                                    <td>{{ $item->amount }}</td>
                                    @if($item->type==1)
                                    <td>Withdraw </td>
                                    @elseif($item->type==2)
                                    <td>Repurchase </td>
                                    @endif
                                   
                                    <td>
                                        {{ $item->paid_by }}</td>
                                    <td>
                                        <button data-toggle="modal" data-target="#exampleModalssa{{ $item->id }}"class="btn btn-sm"><i class="fas fa-eye"style="font-size:20px;color:rgb(22, 19, 202)"></i></button>

                                        
                                    </td>
                                    <td style="width: 150px">
                                        @if ($item->status == 1)
                                        <button type="button" class="btn btn-sm btn-info"><i class="fas fa-check"></i>Accepted</button>
                                        @elseif($item->status == 2)
                                        <button type="button" class="btn btn-sm btn-info" >Denied</button>
                                        @elseif($item->status == 0)
                                        <a type="button" class="btn btn-sm btn-outline-primary mb-1" href="/admin/deposit/accept/{{ $item->id }}">Accept</a>
                                        <a type="button" href="/admin/deposit/deny/{{ $item->id }}" class="btn btn-sm btn-outline-warning" >Deny</a>
                                      
                                        @endif
                                    </td>

                                    <td style="min-width: 120px">
                                       <a href="{{ url('/admin/deposit/details/'.$item->id) }}" class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i> </a>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                                <div class="modal fade"
                                id="exampleModalssa{{ $item->id }}"
                                tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <div class="modal-body">
                                            {{ $item->hash }}
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
                            <th>User Details</th>
                            <th>Deposit Date</th>
                            <th>Deposit Amount</th>
                            <th>Deposit Type</th>
                            <th>Paid By</th>
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
