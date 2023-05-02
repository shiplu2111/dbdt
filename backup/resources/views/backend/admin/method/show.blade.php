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
                                Add New Method
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

                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>

                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($packages as $item)


                            <tr id="sid{{ $item->id }}">
                                <td>{{ $item->method_name }}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="packageForm">

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="method_name">Method Name</label>
                                <input type="text" class="form-control" id="method_name">
                            </div>
                        </div>


                        <div class="form-row">

                            <div class="form-group col-md-12">
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
                                <label for="method_name1">Package Name</label>
                                <input type="text" class="form-control" id="method_name1" />
                            </div>
                        </div>


                        <div class="form-row">

                            <div class="form-group col-md-12">
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
            let method_name = $("#method_name").val();
            let status = $("#status").val();
            let _token = $("import [name=_token]").val();

            $.ajax({

                url: "{{ route('method.add') }}",
                type: "POST",
                data: {
                    method_name: method_name,
                    status: status,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {

                        $("#packageTable tbody").prepend('<tr><td>' + response.method_name +'</td><td>' +
                             response.status +
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
                            title: 'Method Save Successfully'
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

            $.get('/admin/method/' + id, function(package) {
                $("#packageid").val(package.id);
                $("#method_name1").val(package.method_name);
                $("#status1").val(package.status);
                $("#packageEditModal").modal('toggle');
            });
        };


        $("#packageEditForm").submit(function(e) {
            e.preventDefault();
            let packageid = $("#packageid").val();
            let method_name = $("#method_name1").val();
            let status = $("#status1").val();
            let _token = $("import [name=_token]").val();

            $.ajax({

                url: "{{ route('method.update') }}",
                type: "POST",
                data: {

                    packageid: packageid,
                    method_name: method_name,
                    status: status,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {
                        $('#sid'+response.id + ' td:nth-child(1)').text(response.method_name);
                        $('#sid'+response.id + ' td:nth-child(2)').text(response.status);

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
                            title: 'Method Update Successfully'
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
                url:'/admin/method/'+id,
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
                            title: 'Method Deleted Successfully'
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



