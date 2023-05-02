@extends('backend.user.layouts.master')
@section('title')
    DBDT- Available Package List
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Available Packages</h1>
                        {!! Session::has('msg') ? Session::get("msg") : '' !!}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item "><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Available Packages</li>

                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($packages as $item)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">



                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0"
                                        style="background-color: rgb(43, 25, 59)">
                                        <h5>Digital BDT- Package {{ $i }} </h5>
                                    </div>

                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2><b>{{ $item->packagename }}</b></h2>
                                                <p class="text-muted "><b>USDT : ${{ $item->usdtprice }}</b> </p>
                                                <p class="text-muted "><b>DBDT Quantity :{{ $item->dbdtprice }} DBDT</b>
                                                </p>
                                                <p class="text-muted "><b>Override Level: {{ $item->overridelevel }}
                                                        Level</b> </p>
                                                {{-- <p class="text-muted "><b>DBDT Price: $1000</b> </p> --}}

                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer" style="background-color: rgb(43, 25, 59)">
                                        <div class="text-right">
                                            {{-- <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a> --}}
 @php
    $check = DB::table('pack_invoices')
    ->where('user_id',Auth::user()->id)
    ->first();
        if($check){
            @endphp
            <button type="button" class="btn btn-sm btn-primary  toastrDefaultError">
                        <i class="fas fa-user"></i> Buy Now
                      </button>
      @php
      }
        else{
            @endphp
            <a href="{{URL::to('/user/confirm-package/'.$item->id)}}" class="btn btn-sm btn-primary ">
                                                <i class="fas fa-user"></i> Buy Now
                                            </a>
                                            @php
                                        }
                                            @endphp
 {{-- <a href="{{URL::to('/user/confirm-package/'.$item->id)}}" class="btn btn-sm btn-primary ">
    <i class="fas fa-user"></i> Buy Now
</a> --}}



                                        </div>
                                    </div>
                                </div>

                            </div>
                            @php
                                $i++;
                            @endphp
                        @endforeach

                    </div>
                </div>

            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <script>
        $('.toastrDefaultError').click(function() {
          toastr.error('Sorry you already purchased a package.You are not able to buy another from this id')
        });
    </script>
@endsection
