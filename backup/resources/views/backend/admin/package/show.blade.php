@extends('backend.admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="m-0">Packages</h2>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#packageModal">
                                Add New Package
                            </button>
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
                            <th>Name</th>
                            <th>USDT Price</th>
                            <th>DBDT Price</th>
                            <th>Override Level</th>
                            {{-- <th>Start date</th> --}}
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>USDT Price</th>
                            <th>DBDT Price</th>
                            <th>Override Level</th>
                            {{-- <th>Start date</th> --}}
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($packages as $item)


                            <tr id="sid{{ $item->id }}">
                                <td>{{ $item->packagename }}</td>
                                <td>{{ $item->usdtprice }}</td>
                                <td>{{ $item->dbdtprice }}</td>
                                <td>{{ $item->overridelevel }}</td>
                                {{-- <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td> --}}
                                <td>{{ $item->status }}</td>


                                <td>
                                    <a href="javascript:void(0)" onclick="editPackage({{ $item->id }})"
                                        class="btn btn-info"> Edit</a>
                                        <a href="javascript:void(0)" onclick="destroyPackage({{ $item->id }})"
                                            class="btn btn-danger"> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>


    {{-- add package model --}}

    <div class="modal" id="packageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="packageForm">

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="packagename">Package Name</label>
                                <input type="text" class="form-control" id="packagename">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="usdtprice">USDT Price</label>
                                <input type="number" class="form-control" id="usdtprice">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dbdtprice">DBDT Price</label>
                                <input type="number" class="form-control" id="dbdtprice">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="overridelevel">Override Level</label>
                                <input type="number" class="form-control" id="overridelevel">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                {{-- <input type="number" class="form-control" id="status"> --}}
                                <select class="form-control" id="status" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>

                                  </select>
                            </div>
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>



    {{-- edit package model --}}

    <div class="modal" id="packageEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="packageEditForm">

                        <input type="hidden" id="packageid"/>
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="packagename1">Package Name</label>
                                <input type="text" class="form-control" id="packagename1" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="usdtprice1">USDT Price</label>
                                <input type="number" class="form-control" id="usdtprice1" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dbdtprice1">DBDT Price</label>
                                <input type="number" class="form-control" id="dbdtprice1" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="overridelevel1">Override Level</label>
                                <input type="number" class="form-control" id="overridelevel1" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status1">Status</label>
                                {{-- <input type="number" class="form-control" id="status1" /> --}}
                                <select class="form-control" id="status1" name="status1">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>

                                  </select>
                            </div>
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update changes</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
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
  </script>

@endsection



