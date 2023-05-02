@extends('backend.admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="m-0">Stack Setting</h2>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#packageModal">
                                Add New Stack Package
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
                            <th>Period</th>
                            <th>Benefit Type</th>
                             <th>Min Amount</th>
                            <th>Benefit</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Period</th>
                            <th>Benefit Type</th>
                            <th>Min Amount</th>

                            <th>Benefit</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($stake_methods as $item)


                            <tr id="sid{{ $item->id }}">
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->period }} Months</td>
                                <td>{{ $item->benifit_type }}</td>
                                 <td>{{ $item->min_amount }}</td>
                                <td>{{ $item->benifit }} % per year</td>
                                <td>{{ $item->status }}</td>

                                <td>
                                    <a href="javascript:void(0)" onclick="editPackage({{ $item->id }})"
                                        class="btn btn-sm btn-info"> Edit</a>
                                        <a href="javascript:void(0)" onclick="destroyPackage({{ $item->id }})"
                                            class="btn btn-sm btn-danger"> Delete</a>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Stack Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="packageForm">

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="name">Stake Method Name</label>
                                <input type="text" class="form-control" id="name" required placeholder="Please enter stake method name..">
                            </div>
                        </div>

                        <div class="form-row">
                            
                            <div class="form-group col-md-6">
                                <label for="min_benifit">Minimum Benefit/year (%)</label>
                                <input type="number" class="form-control" id="min_benifit" placeholder="e.g 10" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="max_benifit">Maximum Benefit/year (%)</label>
                                <input type="number" class="form-control" id="max_benifit" placeholder="e.g 50" required>
                            </div>
                           
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="period">Benefit/year (%)</label>
                                <input type="number" class="form-control" id="benifit" required placeholder="e.g 25">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="period">Period(month)</label>
                                <input type="number" class="form-control" id="period" required placeholder="e.g 3">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status">Status</label>
                                {{-- <input type="number" class="form-control" id="status"> --}}
                                <select class="form-control" id="status" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>

                                  </select>
                            </div>
                        </div>
                        <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="status">Benifit  Type</label>
                           <br>
                            <select class="form-control" id="type" name="type">
                                <option value="Monthly">Monthly</option>
                                <option value="Yearly">Yearly</option>

                              </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="max_benifit">Minimum Stack Amount</label>
                            <input type="number" class="form-control" id="min_amount" placeholder="e.g 50000" required>
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
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Stack Package</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="packageEditForm">

                        <input type="hidden" id="stackpackageid"/>
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="name1">Stake Method Name</label>
                                <input type="text" class="form-control" id="name1" />
                            </div>
                        </div>

                        <div class="form-row">
                            
                            <div class="form-group col-md-6">
                                <label for="min_benifit1">Minimum Benefit/year (%)</label>
                                <input type="number" class="form-control" id="min_benifit1" />
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="max_benifit1">Maximum Benefit/year (%)</label>
                                <input type="number" class="form-control" id="max_benifit1" />
                            </div>
                           
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="period">Benefit/year (%)</label>
                                <input type="number" class="form-control" id="benifit1" required placeholder="e.g 25">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="period1">Period(month)</label>
                                <input type="number" class="form-control" id="period1" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status1">Status</label>
                                {{-- <input type="number" class="form-control" id="status1" /> --}}
                                <select class="form-control" id="status1" name="status1">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>

                                  </select>
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="status">Benifit Type</label>
                           
                            <select class="form-control" id="type1" name="type1">
                                <option value="Monthly">Monthly</option>
                                <option value="Yearly">Yearly</option>

                              </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="max_benifit">Minimum Stack Amount</label>
                            <input type="number" class="form-control" id="min_amount1" placeholder="e.g 50000" required>
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
        $("#packageForm").submit(function(e) {
            e.preventDefault();
            let name = $("#name").val();
            let period = $("#period").val();
            let min_benifit = $("#min_benifit").val();
            let max_benifit = $("#max_benifit").val();
            let type = $("#type").val();
            let min_amount = $("#min_amount").val();
            let status = $("#status").val();
            let benifit = $("#benifit").val();
            let _token = $("import [name=_token]").val();

            $.ajax({

                url: "{{ route('stake.method_add') }}",
                type: "POST",
                data: {
                    name: name,
                    period: period,
                    min_benifit: min_benifit,
                    max_benifit: max_benifit,
                    benifit_type: type,
                    min_amount: min_amount,
                    benifit: benifit,
                    status: status,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {

                        $("#packageTable tbody").prepend('<tr><td>' + response.name +
                            '</td><td>' + response.period +' months'+ '</td><td>' + response.benifit_type +'</td><td>' + response.min_amount +
                            '</td><td>' + response.benifit +'  % per year'+ '</td><td>' + response.status +
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
                            title: 'Stake Method  Save Successfully'
                        })
                        $("#packageForm")[0].reset();
                        $('body').removeClass('modal-open'); 
                        $('#packageModal').hide();
                        $('.modal-backdrop').remove();
                    }
                }
            });
        });
    </script>


    <script>
        function editPackage(id) {

            $.get('/admin/stake/' + id, function(stake_method) {
                $("#stackpackageid").val(stake_method.id);
                $("#name1").val(stake_method.name);
                $("#period1").val(stake_method.period);
                $("#min_benifit1").val(stake_method.min_benifit);
                $("#max_benifit1").val(stake_method.max_benifit);
                $("#type1").val(stake_method.benifit_type);
                $("#min_amount1").val(stake_method.min_amount);
                $("#benifit1").val(stake_method.benifit);
                $("#status1").val(stake_method.status);
                $("#packageEditModal").modal('toggle');
            });
        };


        $("#packageEditForm").submit(function(e) {
            e.preventDefault();
            let stack_id = $("#stackpackageid").val();
            let name = $("#name1").val();
            let period = $("#period1").val();
            let min_benifit = $("#min_benifit1").val();
            let max_benifit = $("#max_benifit1").val();
            let benifit_type = $("#type1").val();
            let min_amount = $("#min_amount1").val();
            let benifit = $("#benifit1").val();
            let status = $("#status1").val();
            let _token = $("import [name=_token]").val();

            $.ajax({

                url: "{{ route('stake.pack_update') }}",
                type: "POST",
                data: {

                    stack_id: stack_id,
                    name: name,
                    period: period,
                    min_benifit: min_benifit,
                    max_benifit: max_benifit,
                    benifit_type: benifit_type,
                    min_amount: min_amount,
                    benifit: benifit,
                    status: status,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {
                        $('#sid'+response.id + ' td:nth-child(1)').text(response.name);
                        $('#sid'+response.id + ' td:nth-child(2)').text(response.period +' Months');
                        $('#sid'+response.id + ' td:nth-child(3)').text(response.benifit_type);
                        $('#sid'+response.id + ' td:nth-child(4)').text(response.min_amount);
                        $('#sid'+response.id + ' td:nth-child(5)').text(response.benifit +' %p er year ');
                        $('#sid'+response.id + ' td:nth-child(6)').text(response.status);
                        // $('#sid'+response.id + ' td:nth-child(6)').text(response.status);

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
                            title: 'Stake Method Update Successfully'
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
        if(confirm("Do you want to delete this Stake Method"))
        {
            $.ajax({
                url:'/admin/stake/method/delete/'+id,
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
                            title: 'Stake Method Deleted Successfully'
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
        "buttons": ["excel", "pdf", "print"]
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



