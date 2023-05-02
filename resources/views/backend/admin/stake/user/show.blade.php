@extends('backend.admin.layouts.master')

@section('title')
    DBDT-Stake List
@endsection

@section('content')
    <div class="content-wrapper">
        @if (session('stake_yes'))
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
          title: 'Stack Request  Accepted.'
        })
         </script>
        @endif
  
        @if (session('stake_no'))
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
          title: 'Stack Request Rejected & Refund Successful'
        })
         </script>
        @endif
        <!-- Content Header (Page header) -->
       
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
                    <h3 >Stack List</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped " style="text-align: center">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Stack Date</th>
                                <th>Stack Amount</th>
                                <th>Ending Date</th>
                                <th>Status</th>
                                <th>More</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($my_stacks as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}</td>
                                    <td>{{ $item->dbdt_amount }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->end_date)->format('d-M-Y') }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <i class="fas fa-sync-alt fa-spin" style="font-size:20px;color:rgb(22, 19, 202)" data-toggle="tooltip" data-placement="left" title="Staking..."> </i> 
                                            
                                            @elseif($item->status == 2)
                                            <i class="fas fa-check-double "style="font-size:25px;color:sky" data-toggle="tooltip" data-placement="left" title="Finished." ></i>
                                            @elseif($item->status == 0)
                                            <i class="fas fa-search-dollar" style="font-size:25px;color:rgb(150, 150, 218)" data-toggle="tooltip" data-placement="left" title="On Review..." ></i>
                                            @elseif($item->status == 3)
                                            <i class="fas fa-skull-crossbones"style="font-size:20px; color:red" data-toggle="tooltip" data-placement="left"  title="Rejected" > </i>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="/admin/stake/details/{{ $item->id }}"
                                            class="btn btn-sm"><i class="fas fa-eye"
                                                style="font-size:20px;color:rgb(22, 19, 202)"></i></a>

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

                                                <h6 class="justify-content-center">Wallet Address:</h6>
                                                <hr/>
                                                <div class="form-group row">
                                                    <div class="col-sm-5">

                                                        DBDT:
                                                    </div>
                                                    <div class="col-sm-7">

                                                        {{ $item->dbdt_wallet_address }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-5">

                                                        USDT:
                                                    </div>
                                                    <div class="col-sm-7">

                                                        {{ $item->usdt_wallet_address }}
                                                    </div>
                                                </div>
                                                <hr>
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
                                                @if ($item->benifit!=null)
                                                <div class="form-group row">
                                                    <div class="col-sm-5">

                                                       Benefit:
                                                    </div>
                                                    <div class="col-sm-7">

                                                        {{$item->benifit}}
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
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
        });
        </script>
@endsection
