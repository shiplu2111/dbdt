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
                            <th>Withdraw DBDT</th>
                            <th>Staking DBDT</th>
                            <th>Frozen DBDT</th>
                            <th>Bonus</th>
                            <th>Override Level</th>
                            <th>Mastercard</th>
                            <th>Bonus Period</th>
                            <th>Description</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>USDT Price</th>
                            <th>DBDT Price</th>
                            <th>Withdraw DBDT</th>
                            <th>Staking DBDT</th>
                            <th>Frozen DBDT</th>
                            <th>Bonus</th>
                            <th>Override Level</th>
                            <th>Mastercard</th>
                            <th>Bonus Period</th>
                            <th>Description</th>
                            <th>Order</th>
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
                                <td>{{ $item->withdraw_dbdt }}</td>
                                <td>{{ $item->staking_dbdt }}</td>
                                <td>{{ $item->frozen_dbdt }}</td>
                                <td>{{ $item->bonus }} %</td>
                                <td>{{ $item->overridelevel }}</td>
                                <td>{{ $item->mastercard_type }}</td>
                                <td>{{ $item->bonus_period }} Months</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->package_order }}</td>
                                <td>{{ $item->status }}</td>


                                <td>
                                    <a href="{{ URL('/admin/package/'.$item->id )}}"
                                        class="btn btn-info"> Edit</a>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
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
                                <div class="form-group col-md-4">
                                    <label for="withdraw_dbdt">Withdraw DBDT</label>
                                    <input type="number" class="form-control" id="withdraw_dbdt">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="staking_dbdt">Staking DBDT</label>
                                    <input type="number" class="form-control" id="staking_dbdt">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="frozen_dbdt">Frozen DBDT</label>
                                    <input type="number" class="form-control" id="frozen_dbdt">
                                </div>


                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="dbdtprice">Mastercard</label>
                                    <select class="form-control" id="mastercard_type" name="mastercard_type">
                                        <option value="Free">Free</option>
                                        <option value="Paid">Paid</option>

                                      </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="overridelevel">Override Level</label>
                                    <input type="number" class="form-control" id="overridelevel">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="bonus_period">Bonus Period(Months)</label>
                                    <input type="number" class="form-control" id="bonus_period">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="bonus_period1">Order</label>
                                    <input type="number" class="form-control" id="package_order">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="bonus_period">Package Description</label>
                                    <textarea class="form-control" name="" id="description" cols="30" rows="5"></textarea>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="bonus">Commission</label>
                                    <input type="number" class="form-control" id="bonus">
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
                                <div class="form-group col-md-4">
                                    <label for="withdraw_dbdt1">Withdraw DBDT</label>
                                    <input type="number" class="form-control" id="withdraw_dbdt1">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="staking_dbdt1">Staking DBDT</label>
                                    <input type="number" class="form-control" id="staking_dbdt1">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="frozen_dbdt1">Frozen DBDT</label>
                                    <input type="number" class="form-control" id="frozen_dbdt1">
                                </div>


                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="mastercard_type1">Mastercard</label>
                                    <select class="form-control" id="mastercard_type1" name="mastercard_type1">
                                        <option value="Free">Free</option>
                                        <option value="Paid">Paid</option>

                                      </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="overridelevel1">Override Level</label>
                                    <input type="number" class="form-control" id="overridelevel1" />
                                </div>
                            </div>
                            <div class="form-row">

                            <div class="form-group col-md-8">
                                <label for="bonus_period1">Bonus Period(Months)</label>
                                <input type="number" class="form-control" id="bonus_period1">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bonus_period1">Order</label>
                                <input type="number" class="form-control" id="package_order1">
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="bonus_period1">Package Description</label>
                                <textarea class="form-control"  name="" id="description1" cols="30" rows="5"></textarea>
                            </div>
                        </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="bonus1">Commission</label>
                                    <input type="number" class="form-control" id="bonus1">
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
    </div>


    {{-- add package model --}}


    <script>
        $("#packageForm").submit(function(e) {
            e.preventDefault();
            let packagename = $("#packagename").val();
            let usdtprice = $("#usdtprice").val();
            let dbdtprice = $("#dbdtprice").val();
            let withdraw_dbdt = $("#withdraw_dbdt").val();
            let staking_dbdt = $("#staking_dbdt").val();
            let frozen_dbdt = $("#frozen_dbdt").val();
            let bonus = $("#bonus").val();
            let overridelevel = $("#overridelevel").val();
            let mastercard_type = $("#mastercard_type").val();
            let bonus_period = $("#bonus_period").val();
            let description = $("#description").val();
            let package_order = $("#package_order").val();
            let status = $("#status").val();
            let _token = $("import [name=_token]").val();


            $.ajax({

                url: "{{ route('package.add') }}",
                type: "POST",
                data: {
                    packagename: packagename,
                    usdtprice: usdtprice,
                    dbdtprice: dbdtprice,
                    withdraw_dbdt: withdraw_dbdt,
                    staking_dbdt: staking_dbdt,
                    frozen_dbdt: frozen_dbdt,
                    bonus: bonus,
                    overridelevel: overridelevel,
                    mastercard_type: mastercard_type,
                    bonus_period: bonus_period,
                    description: description,
                    package_order: package_order,
                    status: status,
                    _token: '{{ csrf_token() }}'


                },
                success: function(response) {
                    if (response) {

                        $("#packageTable tbody").prepend('<tr><td>' + response.packagename + '</td><td>' + response.withdraw_dbdt + '</td><td>' + response.staking_dbdt + '</td><td>' + response.frozen_dbdt + '</td><td>' + response.bonus +
                            '</td><td>' + response.overridelevel + '</td><td>' + response.mastercard_type + '</td><td>' +response.bonus_period  + 'Months </td><td>' + response.description + '</td><td>'+ response.package_order + '</td><td>' + response.status +
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

                        $(".modal-backdrop").remove();
                         $("#packageForm")[0].reset();
                        $("#packageModal").hide();
                        // $("#packageModal").modal('hide');



                    }
                }
            });
        });
    </script>



    <script>
        function editPackage(id) {

            // $.get('/admin/package/' + id, function(package) {
            //     $("#packageid").val(package.id);
            //     $("#packagename1").val(package.packagename);
            //     $("#usdtprice1").val(package.usdtprice);
            //     $("#dbdtprice1").val(package.dbdtprice);
            //     $("#withdraw_dbdt1").val(package.withdraw_dbdt);
            //     $("#staking_dbdt1").val(package.staking_dbdt);
            //     $("#frozen_dbdt1").val(package.frozen_dbdt);
            //     $("#bonus1").val(package.bonus);
            //     $("#overridelevel1").val(package.overridelevel);
            //     $("#mastercard_type1").val(package.mastercard_type);
            //     $("#bonus_period1").val(package.bonus_period);
            //     $("#description1").val(package.description);
            //     $("#package_order1").val(package.package_order);
            //     $("#status1").val(package.status);
            //     $("#packageEditModal").modal('toggle');
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


            });
        };


        $("#packageEditForm").submit(function(e) {
            e.preventDefault();
            let packageid = $("#packageid").val();
            let packagename = $("#packagename1").val();
            let usdtprice = $("#usdtprice1").val();
            let withdraw_dbdt = $("#withdraw_dbdt1").val();
            let staking_dbdt = $("#staking_dbdt1").val();
            let usdtprice = $("#usdtprice1").val();
            let frozen_dbdt = $("#frozen_dbdt1").val();
            let bonus = $("#bonus1").val();
            let overridelevel = $("#overridelevel1").val();
            let bonus_period = $("#bonus_period1").val();
            let mastercard_type = $("#mastercard_type1").val();
            let description = $("#description1").val();
            let package_order = $("#package_order1").val();

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
                    withdraw_dbdt: withdraw_dbdt,
                    staking_dbdt: staking_dbdt,
                    frozen_dbdt: frozen_dbdt,
                    bonus: bonus,
                    overridelevel: overridelevel,
                    mastercard_type: mastercard_type,
                    bonus_period: bonus_period,
                    description: description,
                    package_order: package_order,
                    status: status,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {
                        $('#sid'+response.id + ' td:nth-child(1)').text(response.packagename);
                        $('#sid'+response.id + ' td:nth-child(2)').text(response.usdtprice);
                        $('#sid'+response.id + ' td:nth-child(3)').text(response.dbdtprice);
                        $('#sid'+response.id + ' td:nth-child(4)').text(response.withdraw_dbdt);
                        $('#sid'+response.id + ' td:nth-child(5)').text(response.staking_dbdt);
                        $('#sid'+response.id + ' td:nth-child(6)').text(response.frozen_dbdt);
                        $('#sid'+response.id + ' td:nth-child(7)').text(response.bonus);
                        $('#sid'+response.id + ' td:nth-child(8)').text(response.overridelevel);
                        $('#sid'+response.id + ' td:nth-child(9)').text(response.mastercard_type);
                        $('#sid'+response.id + ' td:nth-child(10)').text(response.bonus_period);
                        $('#sid'+response.id + ' td:nth-child(11)').text(response.description);
                        $('#sid'+response.id + ' td:nth-child(12)').text(response.package_order);
                        $('#sid'+response.id + ' td:nth-child(13)').text(response.status);

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
                url:'/admin/2xpackage/'+id,
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
   <script>
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>
@endsection


