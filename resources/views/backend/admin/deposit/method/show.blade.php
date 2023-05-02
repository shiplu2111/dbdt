@extends('backend.admin.layouts.master')
@section('title')
    DBDT- Deposit Methods
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="m-0">Deposit Methods</h2>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#packageModal">
                                Add New Deposit Method
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
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Method Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Method Address</th>
                            <th>Action</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        @if($deposit_methods)
                        @foreach ($deposit_methods as $item)

                            <tr id="sid{{ $item->id }}">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->address }}</td>
                                <td>
                                    <a href="javascript:void(0)" onclick="editPackage({{ $item->id }})"
                                        class="btn btn-info"> Edit</a>
                                        <a href="javascript:void(0)" onclick="destroyPackage({{ $item->id }})"
                                            class="btn btn-danger"> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Deposit Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="depositMethodForm">

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="name">Method Name</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="address"> Method Address</label>
                                <input type="text" class="form-control" id="address">
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Deposit Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="packageEditForm">

                        <input type="hidden" id="depositmethodid"/>
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="name1">Method Name</label>
                                <input type="text" class="form-control" id="name1" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="address1">Method Address</label>
                                <input type="text" class="form-control" id="address1" />
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
        $("#depositMethodForm").submit(function(e) {
            e.preventDefault();
            let name = $("#name").val();
            let address = $("#address").val();

            let _token = $("import [name=_token]").val();

            $.ajax({

                url: "{{ route('deposit.method.add') }}",
                type: "POST",
                data: {
                    name: name,
                    address: address,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {

                        $("#packageTable tbody").prepend('<tr><td>' + response.id +
                            '</td><td>' + response.name + '</td><td>' + response.address +
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
                        $("#depositMethodForm")[0].reset();
                        $("#packageModal").modal('hide');
                        $('.modal-backdrop').remove();
                    }
                }
            });
        });
    </script>


    <script>
        function editPackage(id) {

            $.get('/admin/deposit/method/' + id, function(depositMethod) {
                $("#depositmethodid").val(depositMethod.id);
                $("#name1").val(depositMethod.name);
                $("#address1").val(depositMethod.address);
                $("#packageEditModal").modal('toggle');
            });
        };


        $("#packageEditForm").submit(function(e) {
            e.preventDefault();
            let depositmethodid = $("#depositmethodid").val();
            let name = $("#name1").val();
            let address = $("#address1").val();
            let _token = $("import [name=_token]").val();

            $.ajax({

                url: "{{ route('method_deposit.update') }}",
                type: "POST",
                data: {

                    depositmethodid: depositmethodid,
                    name: name,
                    address: address,
                      _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {
                        $('#sid'+response.id + ' td:nth-child(1)').text(response.id);
                        $('#sid'+response.id + ' td:nth-child(2)').text(response.name);
                        $('#sid'+response.id + ' td:nth-child(3)').text(response.address);


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
                url:'/admin/delete-deposit-method/'+id,
                type:'POST',
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
                            title: ' Deleted Successfully'
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



