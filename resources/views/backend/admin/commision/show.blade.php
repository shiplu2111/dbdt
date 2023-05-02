@extends('backend.admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">


                    <div class="col-sm-12" style="text-align: center">
                        <h5 class="m-0">Package Commisions</h5>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Example single danger button -->
        <div class="container justify-content-center">

            <div class="card" style="background-color: rgb(226, 231, 241)">
                <div class="card-body">
                    <form id="packCommisionForm">
                        <div class="row justify-content-center">

                            <div class="col-md-4">

                                <input type="text" class="form-control" name="level" required id="level"
                                    placeholder="Level">
                            </div>

                            <div class="col-md-3">


                                <input type="text" class="form-control" required name="commision" id="commision"
                                    placeholder="Commision %">
                            </div>
                            <div class="col-md-3">


                                <select name="status" id="status" class="form-control">

                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-2">

                                <button type="submit" class="btn  btn-outline-primary">Save Commision </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">


                        <div class="col-sm-12" style="text-align: center">
                            <h6 class="m-0">Active Commision Level = <span id="totalLevel"> <b> {{$total_level}} </b></span></h6>
                        </div><!-- /.col -->
                        <!-- /.col -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="card" style="background-color: rgb(255, 255, 255)">
                <div class="card-header">
                    <div style="text-align: center">
                        <h4> Commisions Table </h4>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="packageTable" class="table table-bordered table-striped">
                        <thead>
                            <tr style="text-align: center">
                                <th>Level</th>
                                <th>Commision</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commisions as $item)
                                <tr id="sid{{ $item->id }}" style="text-align: center">
                                    <td style="width: 25%">{{ $item->level }}</td>
                                    <td style="width: 25%">{{ $item->commision }}</td>
                                    <td style="width: 25%">{{ $item->status }}</td>
                                    <td style="width: 25%">
                                        <a href="javascript:void(0)" onclick="editCommision({{ $item->id }})"
                                            class="btn btn-info"> Edit</a>
                                         <a href="javascript:void(0)" onclick="destroyCommision({{ $item->id }})"
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
    </div>
    <div class="modal" id="commisionEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Commision</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="commisionEditForm">

                        <input type="hidden" id="commisionid" />
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="level1">Level</label>
                                <input type="text" class="form-control" id="level1" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="commision1">Commision</label>
                                <input type="number" class="form-control" id="commision1" />
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="overridelevel1">Status</label>
                                <select name="status1" id="status1" class="form-control">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update changes</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        $("#packCommisionForm").submit(function(e) {
            e.preventDefault();
            let level = $("#level").val();
            let commision = $("#commision").val();
            let status = $("#status").val();

            let _token = $("import [name=_token]").val();


            $.ajax({

                url: "{{ route('commision.add') }}",
                type: "POST",
                data: {
                    level: level,
                    commision: commision,
                    status: status,
                    _token: '{{ csrf_token() }}'


                },
                success: function(response) {
                    if (response) {

                        $("#packageTable tbody").prepend('<tr style="text-align: center"><td>' +
                            response.level +
                            '</td><td>' + response.commision + '</td><td>' + response
                            .status + '<td style="width: 25%"><a href="/admin/commision/setting/" class="btn btn-sm btn-outline-info" >Relode</a> </td></tr>'
                            );

                        $("#packCommisionForm")[0].reset();
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
                            title: 'Commision Save Successfully'
                        })
                        
                       
                    }
                },
                error: function(reject) {
                    if (reject.status === 422) {
                        var c = document.querySelector('#level').value;
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'center',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'info',
                            title: 'Sorry Level ' + c + ' Alredy Exist'
                        })
                    }
                }
            });
        });
    </script>

    <script>
        function editCommision(id) {

            $.get('/admin/commision/edit/' + id, function(commision) {
                $("#commisionid").val(commision.id);
                $("#level1").val(commision.level);
                $("#commision1").val(commision.commision);
                $("#status1").val(commision.status);
                $("#commisionEditModal").modal('toggle');
            });
        };
        $("#commisionEditForm").submit(function(e) {
            e.preventDefault();
            let commisionid = $("#commisionid").val();
            let level = $("#level1").val();
            let commision = $("#commision1").val();
            let status = $("#status1").val();
            let _token = $("import [name=_token]").val();

            $.ajax({

                url: "{{ route('commision.update') }}",
                type: "POST",
                data: {

                    commisionid: commisionid,
                    level: level,
                    commision: commision,
                    status: status,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {
                        $('#sid'+response.id + ' td:nth-child(1)').text(response.level);
                        $('#sid'+response.id + ' td:nth-child(2)').text(response.commision);
                        $('#sid'+response.id + ' td:nth-child(3)').text(response.status);

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'center',
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
                            title: 'Updated Successfully'
                        })
                       
                        $("#commisionEditForm")[0].reset();
                        $("#commisionEditModal").modal('hide');
                        $('.modal-backdrop').remove();
                    }
                },
                error: function(reject) {
                    if (reject.status === 422) {
                        
                        var c = $("#level1").val();
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'center',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'info',
                            title: 'Sorry Level ' + c + ' Alredy Exist'
                        })
                        $("#commisionEditForm")[0].reset();
                        $("#commisionEditModal").modal('hide');
                        $('.modal-backdrop').remove();
                    }
                }
            });
                
            
        });
    </script>

    <script>
        function destroyCommision(id) {
            if (confirm("Do you want to delete this Commision")) {
                $.ajax({
                    url: '/admin/commision/delete/' + id,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#sid" + id).remove();

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'center',
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
                            title: 'Commision Deleted Successfully'
                        })
                    }
                })
            }
        }
    </script>s
@endsection
