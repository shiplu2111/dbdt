@extends('backend.user.layouts.master')
@section('title')
    DBDT-Withdraw DBDT
@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Withdraw List</h1>
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
        @if (session('otp_success'))
        <script>
         const Toast = Swal.mixin({
          toast: true,
          position: 'center',
          showConfirmButton: false,
          timer: 6000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        
        Toast.fire({
          icon: 'success',
          title: 'Withdrow request successfully send.'
        })
         </script>
        @endif
        <!-- Main content -->
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
                                <th>Withdraw Date</th>
                                <th>Withdraw Amount</th>
                                <th>Withdraw Method</th>
                                <th>Account Address</th>
                                <th>Status</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($withdraw_lists)
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($withdraw_lists as $item)


                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                        <td>{{ $item->withdraw_amount }}</td>
                                        <td>{{ $item->withdraw_method }}</td>
                                        <td>{{ $item->withdraw_method_address }}</td>
                                        <td>
                                            @if ($item->withdraw_status == 1)
                                                <span class="btn btn-sm btn-primary"><i class="fas fa-thumbs-up"  data-toggle="tooltip" data-placement="top" title="Accepted"></i></span>
                                            @elseif($item->withdraw_status == 2)
                                                <span class="btn btn-sm btn-danger"><i
                                                        class="fas fa-thumbs-down"  data-toggle="tooltip" data-placement="top"  title="Rejected"></i></span>

                                                        @elseif($item->withdraw_status == 0)
                                            <span class="btn btn-sm btn-info"  data-toggle="tooltip" data-placement="top"   title="On Progress"><i class="fas  fa-sync-alt fa-spin"></i>
                                            </span>

                                            @endif
                                        </td>
                                       
                                        <td><a href="{{ url('/user/withdraw/details/' . $item->id) }}" class="btn btn-sm btn-outline-info ">Details</a></td>

                                    </tr>
                                    
                                    @php
                                        $i++;
                                    @endphp
                                    <div class="modal fade" id="modal-info{{ $item->id }}">
                                        <div class="modal-dialog">
                                          <div class="modal-content bg-info">
                                            <div class="modal-header">
                                              <h4 class="modal-title">Accepted Hash {{ $item->id }}</h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card card-primary">
                                                    
                                                    <!-- /.card-header -->
                                                    <div class="card-body" style="color: black">
                                                        {{ $item->transaction_hash }}
                                                    </div>
                                                    <!-- /.card-body -->
                                                  </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                              {{-- <button type="button" class="btn btn-outline-light">Save changes</button> --}}
                                            </div>
                                          </div>
                                          <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                      </div>
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
                                <th>Status </th>
                                <th>Details</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </section>

    </div>
<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@endsection
