@extends('backend.admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="m-0"> Pending Upgrades</h2>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <button type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#packageModal">
                                Add New Package
                            </button> --}}
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped" id="packageTable" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th style="width: 100px">Date</th>

                            <th>Username</th>
                            <th>Package Name</th>
                            <th>Package Value</th>
                            <th>Tax</th>
                            <th>Subtotal</th>
                            <th>Action</th>

                            <th>Total DBDT</th>
                            <th>Staking DBDT</th>
                            <th>Withdraw DBDT</th>
                            <th>Frozen DBDT</th>
                            <th>Bonus Duration</th>
                            <th>Transaction Hash</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="width: 100px">Date</th>

                            <th>Username</th>
                            <th>Package Name</th>
                            <th>Package Value</th>
                            <th>Tax</th>
                            <th>Subtotal</th>
                            <th>Action</th>

                            <th>Total DBDT</th>
                            <th>Staking DBDT</th>
                            <th>Withdraw DBDT</th>
                            <th>Frozen DBDT</th>
                            <th>Bonus Duration</th>
                            <th>Transaction Hash</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($lists as $item)
                            @php
                                $package_data = DB::table('packages')
                                    ->where('id', $item->package_id)
                                    ->first();

                                    $user_data = DB::table('users')
                                    ->where('id', $item->user_id)
                                    ->first();
                            @endphp
<tr id="sid{{ $item->id }}">
    <td style="width: 100px">{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>

                                <td>{{ $user_data->username }}</td>
                                <td>{{ $package_data->packagename }}</td>
                                <td>{{ $item->price }} $</td>

                                <td>{{ $item->tax }}</td>
                                <td>{{ $item->subtotal }} $</td>

                                <td>
                                    {{-- <a href="{{ url('/admin/upgrade/deposit/accept/'.$item->id) }}"
                                        class="btn btn-info"> Accept</a> --}}
                                    <a href="javascript:void(0)" onclick="acceptUpgrade({{ $item->id }})"
                                        class="btn btn-info"> Accept</a>
                                    {{-- <a href="javascript:void(0)" onclick="destroyPackage({{ $item->id }})"
                                        class="btn btn-danger"> Delete</a> --}}
                                </td>

                                <td>{{ $package_data->dbdtprice }}</td>
                                <td>{{ $package_data->withdraw_dbdt }}</td>
                                <td>{{ $package_data->staking_dbdt }}</td>
                                <td>{{ $package_data->frozen_dbdt }}</td>
                                <td>{{ $package_data->bonus_period }} Months</td>
                                
                                <td> #{{ $item->pay_code }}</td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>






    <script>
        function acceptUpgrade(id){
            if(confirm("Do you want to Accept this Package Upgrade"))
            {
                $.ajax({
                    url:'/admin/pending/upgrade/accept/'+id,
                    type:'GET',
                    data:{
                        _token: '{{ csrf_token() }}'
                    },
                    success:function(response){
                        $("#sid"+id).remove();

                        const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
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
                                title: 'Accepted Sucessfully'
                            })
                    }
                })
            }
        }
    </script>

    


    




<script>
    $(function () {
      $("#packageTable").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#packageTable_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script> 

@endsection
