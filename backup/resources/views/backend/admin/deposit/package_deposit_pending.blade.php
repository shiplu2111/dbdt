@extends('backend.admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="m-0">Packages Pending Deposits</h2>
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
                            <th>Username</th>

                            <th>Package Name</th>
                            <th>Package Value</th>
                            <th>DBDT Amount</th>
                            <th>Subtotal</th>
                            <th>Date</th>
                            <th>Transection Hash</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Username</th>
                            <th>Package Name</th>
                            <th>Package Value</th>
                            <th>DBDT Amount</th>
                            <th>Subtotal</th>
                            <th>Date</th>
                            <th>Transection Hash</th>
                            <th>Action</th>

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
                                <td>{{ $user_data->username }}</td>
                                <td>{{ $package_data->packagename }}</td>
                                <td>{{ $package_data->usdtprice }} USD</td>
                                <td>{{ $package_data->dbdtprice }}</td>
                                <td>{{ $package_data->usdtprice }} USD</td>
                                <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                <td> #{{ $item->pay_code }}</td>
                                <td>
                                    {{-- <a href="{{ url('/admin/pending/deposit/accept/'.$item->id) }}"
                                        class="btn btn-info"> Accept</a> --}}
                                    <a href="javascript:void(0)" onclick="acceptOrder({{ $item->id }})"
                                        class="btn btn-info"> Accept</a>
                                    {{-- <a href="javascript:void(0)" onclick="destroyPackage({{ $item->id }})"
                                        class="btn btn-danger"> Delete</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>






    <script>
        function acceptOrder(id){
            if(confirm("Do you want to Accept this deposit"))
            {
                $.ajax({
                    url:'/admin/pending/deposit/accept/'+id,
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

    {{-- <script>
        $("#packageForm").submit(function(e) {
            e.preventDefault();
            let packagename = $("#packagename").val();
            let usdtprice = $("#usdtprice").val();
            let dbdtprice = $("#dbdtprice").val();
            let overridelevel = $("#overridelevel").val();
            let status = $("#status").val();
            let _token = $("import [name=_token]").val();

            $.ajax({

                url: "{{ route('package.add') }}",
                type: "POST",
                data: {
                    packagename: packagename,
                    usdtprice: usdtprice,
                    dbdtprice: dbdtprice,
                    overridelevel: overridelevel,
                    status: status,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {

                        $("#packageTable tbody").prepend('<tr><td>' + response.packagename +
                            '</td><td>' + response.usdtprice + '</td><td>' + response.dbdtprice +
                            '</td><td>' + response.overridelevel + '</td><td>' + response.status +
                            '</td></tr>');
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
                            title: 'Package Save Successfully'
                        })
                        $("#packageForm")[0].reset();
                        $("#packageModal").modal('hide');
                        $('.modal-backdrop').remove();
                    }
                }
            });
        });
    </script>


    <script>
        function editPackage(id) {

            $.get('/admin/package/' + id, function(package) {
                $("#packageid").val(package.id);
                $("#packagename1").val(package.packagename);
                $("#usdtprice1").val(package.usdtprice);
                $("#dbdtprice1").val(package.dbdtprice);
                $("#overridelevel1").val(package.overridelevel);
                $("#status1").val(package.status);
                $("#packageEditModal").modal('toggle');
            });
        };


        $("#packageEditForm").submit(function(e) {
            e.preventDefault();
            let packageid = $("#packageid").val();
            let packagename = $("#packagename1").val();
            let usdtprice = $("#usdtprice1").val();
            let dbdtprice = $("#dbdtprice1").val();
            let overridelevel = $("#overridelevel1").val();
            let status = $("#status1").val();
            let _token = $("import [name=_token]").val();

            $.ajax({

                url: "{{ route('package.update') }}",
                type: "POST",
                data: {

                    packageid: packageid,
                    packagename: packagename,
                    usdtprice: usdtprice,
                    dbdtprice: dbdtprice,
                    overridelevel: overridelevel,
                    status: status,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {
                        $('#sid'+response.id + ' td:nth-child(1)').text(response.packagename);
                        $('#sid'+response.id + ' td:nth-child(2)').text(response.usdtprice);
                        $('#sid'+response.id + ' td:nth-child(3)').text(response.dbdtprice);
                        $('#sid'+response.id + ' td:nth-child(4)').text(response.overridelevel);
                        $('#sid'+response.id + ' td:nth-child(5)').text(response.status);

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
                            title: 'Package Update Successfully'
                        })
                        $("#packageEditForm")[0].reset();
                        $("#packageEditModal").modal('hide');
                        $('.modal-backdrop').remove();
                    }
                }
            });
        });
    </script>
<script>
    function destroyPackage(id){
        if(confirm("Do you want to delete this package"))
        {
            $.ajax({
                url:'/admin/package/'+id,
                type:'DELETE',
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
                            title: 'Package Deleted Successfully'
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
  </script> --}}

@endsection
