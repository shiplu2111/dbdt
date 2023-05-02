@extends('backend.user.layouts.master')

@section('title')
    DBDT-Transfer DBDT
@endsection

@section('content')
    <div class="content-wrapper">
        @if (session('status_ok'))
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
                    title: 'Staking Request on review.'
                })
            </script>
        @endif

        @if (session('status_denyed'))
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
                    icon: 'error',
                    title: 'Sorry account not active.'
                })
            </script>
        @endif
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Stacks</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ url('stake-dbdt') }}" style="float: right;" class="btn btn-outline-primary">
                                Stack DBDT Now
                            </a>
                        </ol>
                    </div </div>
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
                    <h3 class="card-title">My Stack history</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped " id="packageTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Stack Date</th>
                                <th>Stack Amount</th>
                                <th>Ending Date</th>
                                <th>Action</th>
                                <th>Status</th>
                                <th>More</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($my_stacks as $item)
                                <tr id="sid{{ $item->id }}">
                                    <td>{{ $i }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}</td>
                                    <td>{{ $item->dbdt_amount }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->end_date)->format('d-M-Y') }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                        <a href="javascript:void(0)" onclick="CancelStake({{ $item->id }})"
                                            class="btn btn-sm btn-danger"> Cancel Stake</a>
                                            @else
                                        <button class="btn btn-sm btn-danger" disabled> Cancel Stake</button>
                                            @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                            <i class="fas fa-sync-alt fa-spin" style="font-size:20px;color:rgb(22, 19, 202)"
                                                data-toggle="tooltip" data-placement="left" title="Staking..."> </i>
                                        @elseif($item->status == 2)
                                            <i class="fas fa-check-double "style="font-size:25px;color:sky"
                                                data-toggle="tooltip" data-placement="left" title="Finished."></i>
                                        @elseif($item->status == 0)
                                            <i class="fas fa-search-dollar" style="font-size:25px;color:rgb(150, 150, 218)"
                                                data-toggle="tooltip" data-placement="left" title="On Review..."></i>
                                        @elseif($item->status == 3)
                                            <i class="fas fa-skull-crossbones"style="font-size:20px; color:red"
                                                data-toggle="tooltip" data-placement="left" title="Rejected"> </i>
                                       
                                        @elseif($item->status == 4)
                                            <i class="fas fa-skull-crossbones"style="font-size:20px; color:red"
                                                data-toggle="tooltip" data-placement="left" title="Cancelled"> </i>
                                                @endif

                                    </td>
                                    <td>
                                        <button data-toggle="modal" data-target="#stake_details{{ $item->id }}"
                                            class="btn btn-sm"><i class="fas fa-eye"
                                                style="font-size:20px;color:rgb(22, 19, 202)"></i></button>

                                    </td>

                                </tr>
                                @php
                                    $i++;
                                @endphp

                                <div class="modal fade" id="stake_details{{ $item->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Stake Details</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="padding: 20px">
                                                <div class="form-group row">
                                                    <div class="col-sm-5">
                                                        Name :
                                                    </div>

                                                    <div class="col-sm-7">
                                                        {{ $item->name }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-5">


                                                        Email:
                                                    </div>

                                                    <div class="col-sm-7">

                                                        {{ $item->email }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-5">

                                                        Phone:
                                                    </div>
                                                    <div class="col-sm-7">

                                                        {{ $item->phone }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <h6 class="justify-content-center">Method Details:</h6>

                                                @php
                                                    $method_data = DB::table('stake_methods')
                                                        ->where('id', $item->stake_method)
                                                        ->first();
                                                @endphp
                                                <div class="form-group row">
                                                    <div class="col-sm-5">
                                                        Name:
                                                    </div>
                                                    <div class="col-sm-7">
                                                        {{ $method_data->name }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-5">
                                                        Minimum benifit:
                                                    </div>
                                                    <div class="col-sm-7">
                                                        {{ $method_data->min_benifit }}% / Year
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-5">
                                                        Minimum benifit:
                                                    </div>
                                                    <div class="col-sm-7">
                                                        {{ $method_data->max_benifit }}% / Year
                                                    </div>
                                                </div>
                                                <hr>

                                                {{-- <h6 class="justify-content-center">Wallet Address:</h6>

                                                <div class="form-group row">
                                                    <div class="col-sm-5">

                                                        DBDT:
                                                    </div>
                                                    <div class="col-sm-7">

                                                        {{ $item->dbdt_wallet_address }}
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="form-group row">
                                                    <div class="col-sm-5">

                                                        USDT:
                                                    </div>
                                                    <div class="col-sm-7">

                                                        {{ $item->usdt_wallet_address }}
                                                    </div>
                                                </div> --}}
                                                {{-- <hr> --}}
                                                <div class="form-group row">
                                                    <div class="col-sm-5">

                                                        Stack Amount:
                                                    </div>
                                                    <div class="col-sm-7">

                                                        {{ $item->dbdt_amount }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-5">

                                                        Staring Date:
                                                    </div>
                                                    <div class="col-sm-7">

                                                        {{ Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-5">

                                                        Ending Date:
                                                    </div>
                                                    <div class="col-sm-7">

                                                        {{ Carbon\Carbon::parse($item->end_date)->format('d-M-Y') }}
                                                    </div>
                                                </div>
                                                @if ($item->benifit != null)
                                                    <div class="form-group row">
                                                        <div class="col-sm-5">

                                                            Benefit:
                                                        </div>
                                                        <div class="col-sm-7">

                                                            {{ $item->benifit }}
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="float-right btn btn-outline-danger"
                                                    data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Stack Date</th>
                                <th>Stack Amount</th>
                                <th>Ending Date</th>
                                <th>Action</th>

                                <th>Status</th>
                                <th>More</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>


    <script>
        function CancelStake(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to cancel this stake without any benefit !!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let timerInterval
Swal.fire({
  timer: 2000,
  width: 150,
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading()
    const b = Swal.getHtmlContainer().querySelector('b')
    timerInterval = setInterval(() => {
      b.textContent = Swal.getTimerLeft()
    }, 100)
  },
  willClose: () => {
    clearInterval(timerInterval)
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log('I was closed by the timer')
  }
})
                    // Swal.fire(
                    //   'Deleted!',
                    //   'Your file has been deleted.',
                    //   'success'
                    // )
                    // alert(id);


                    $.ajax({
                        url: '/user/stake/cancel/' + id,
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
                                timer: 5000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                            icon: 'success',
                            title: 'Your Stake has been Cancelled'
                        })
                        }
                    })
                }
            })
        }
    </script>
 <script>
    $(function () {
      $("#packageTable").DataTable({
        "responsive": false, "lengthChange": false, "autoWidth": true, "scrollX": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#packageTable_wrapper .col-md-6:eq(0)');
     
    });
  </script>
@endsection
