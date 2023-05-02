@extends('backend.user.layouts.master')

@section('title')
    DBDT-Swap DBDT
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Swap DBDT</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Swap DBDT</li>
                        </ol>
                    </div>
                </div>
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
          title: 'Successfully Swaped '
        })
         </script>
        @endif
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                {{-- <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ URL::to('/') }}/{{ Auth::user()->profile_photo_path }}"
                                        alt="User profile picture"> 
                                    <img id="preview-image-before-upload" class="profile-user-img img-fluid img-circle"
                                        src="{{ URL::to('/') }}/{{ Auth::user()->profile_photo_path }}"
                                        style="height: 80px; width: 80px;">
                                </div>  <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                                <p class="text-muted text-center">{{ Auth::user()->email }}</p> --}}

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Withdrawl Balance</b> <span class="float-right">{{ number_format($account_data->withdraw_balance, 2, '.', ',') }} DBDT</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Staking Balance</b> <span class="float-right">{{ number_format($account_data->repurchase_balance, 2, '.', ',') }} DBDT</span>
                                    </li>

                                </ul>

                                <h5 style="text-align: center">Swap History</h5>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Date</b> <b class="float-right">Amount</b>
                                    </li>
                                    @forelse ($swap_data as $item)
                                    <li class="list-group-item">
                                        <span>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span> <a class="float-right">{{ number_format($item->amount, 2, '.', ',') }} DBDT</a>
                                    </li>
                                    @empty
                                        <li  class="list-group-item " style="text-align: center">No Data Recorded</li>
                                    @endforelse
                                   
                                
                                </ul>
                                
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">

                                    <li class="nav-item"><a class="nav-link" href="#settings"
                                            data-toggle="tab">Swap DBDT</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">



                                    <div class="active tab-pane" id="settings">
                                        <form class="form-horizontal" action="{{ route('swap.new') }}" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Swap Type</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="name"
                                                        value="Withdrawl To Staking" placeholder="Name" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Amount</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="{{$account_data->withdraw_balance}}" max="{{$account_data->withdraw_balance}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="float-right btn btn-outline-primary">Swap Now</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row justify-content-center"  style=" width: 95%; margin: auto">
                    {{ $swap_data->links('vendor.pagination.custom') }}
                </div>
                <br>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
