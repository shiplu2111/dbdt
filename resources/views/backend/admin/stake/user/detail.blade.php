@extends('backend.admin.layouts.master')

@section('title')
    DBDT-Stake Details
@endsection

@section('content')
    <div class="content-wrapper">
       
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
                    <h3 >Stack Details</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="modal-body" style="padding: 20px">
                        <h6 class="justify-content-center">User Details:</h6>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                Name :
                            </div>
                            
                            <div class="col-sm-8">
                                
                                {{ $stake_detail->name }} 
                                <a class="btn btn-sm btn-outline-primary" href="/admin/user/details/{{ $stake_detail->user_id }}"> View Profile <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">


                                Email:
                            </div>
                            
                            <div class="col-sm-8">

                                {{ $stake_detail->email }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">

                                Phone:
                            </div>
                            <div class="col-sm-8">

                                {{ $stake_detail->phone }}
                            </div>
                        </div>
                        <br>
                        <br>

                        {{-- <h6 class="justify-content-center">Wallet Address:</h6>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">

                                DBDT:
                            </div>
                            <div class="col-sm-8">

                                {{ $stake_detail->dbdt_wallet_address }}
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">

                                USDT:
                            </div>
                            <div class="col-sm-8">

                                {{ $stake_detail->usdt_wallet_address }}
                            </div>
                        </div> --}}
                        <h6 class="justify-content-center">Method Details:</h6>

                                               @php
                                                    $method_data= DB::table('stake_methods')->where('id', $stake_detail->stake_method)->first();
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
                        <br>
                        <br>
                        

                        <h6 class="justify-content-center">Staking Details:</h6>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">

                                Stack Amount:
                            </div>
                            <div class="col-sm-8">

                                {{ $stake_detail->dbdt_amount }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">

                                Staring Date:
                            </div>
                            <div class="col-sm-8">

                                {{ Carbon\Carbon::parse($stake_detail->created_at)->format('d-M-Y') }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">

                                Ending Date:
                            </div>
                            <div class="col-sm-8">

                                {{ Carbon\Carbon::parse($stake_detail->end_date)->format('d-M-Y') }}
                            </div>
                        </div>
                        @if ($stake_detail->benifit!=null)
                        <div class="form-group row">
                            <div class="col-sm-4">

                               Benefit:
                            </div>
                            <div class="col-sm-8">

                                {{$stake_detail->benifit}}
                            </div>
                        </div>
                        @endif
                        <br>
                        <br>
                        <h6 class="justify-content-center">Comments:</h6>
                        
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">

                                Instruction:
                            </div>
                            <div class="col-sm-8">
                                {{$stake_detail->instruction}}
                            </div>
                        </div>
@if($stake_detail->status==0)
                        <br>
                        <br>
                                            <h6 class="justify-content-center">Actions:</h6>
                        <hr>

                        <div >
                            <a href="/admin/stake/accept/{{ $stake_detail->id }}" class="btn btn-primary">Accept Stack</a>
                            <a href="/admin/stake/reject/{{ $stake_detail->id }}"  class="btn btn-danger">Reject & Refund</a>
                        </div>
                        @endif
                        
                            
                        

                    </div>
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
