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
                        {{-- <h1>Available Packages</h1> --}}
                        {!! Session::has('msg') ? Session::get('msg') : '' !!}
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
        {{-- <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="card">
                        <div class="card-header">
                            <h4>Make Money from Home or Office with a minimum capital
                                Earn USD 500 to 5,000 Monthly</h4>
                                <h5>
                                    DIGITAL BDT or DBDT (Digital Blockchain Dominance Token) Future digital assets 1 DBDT = 0.005 USD

                                </h5>
                            <h3 class="card-title">
                                
                                (Package available 50, 100, 300, 500, 1000, 5000 USDT)</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body"  style="overflow-x:auto;">
                            <table  class="table " style="text-align: center">
                                <thead>
                                    <tr>
                                        
                                        <th>Level info</th>
                                        <th>Bonus</th>
                                        <th>   </th>
                                        <th>Level info</th>
                                        <th>Bonus</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                   
        
                                            <tr>
                                                <td>Level 1</td>
                                                <td>20%</td>
                                                <td></td>
                                                <td>Level 7</td>
                                                <td>5%</td>
                                            </tr>
                                            <tr>
                                                <td>Level 2</td>
                                                <td>10%</td>
                                                <td></td>
                                                <td>Level 8</td>
                                                <td>5%</td>
                                            </tr>
                                            <tr>
                                                <td>Level 3</td>
                                                <td>5%</td>
                                                <td></td>
                                                <td>Level 9</td>
                                                <td>5%</td>
                                            </tr>
                                            <tr>
                                                <td>Level 4</td>
                                                <td>5%</td>
                                                <td></td>
                                                <td>Level 10</td>
                                                <td>5%</td>
                                            </tr>
                                            <tr>
                                                <td>Level 5</td>
                                                <td>5%</td>
                                                <td></td>
                                                <td>Level 11</td>
                                                <td>5%</td>
                                            </tr>
                                            <tr>
                                                <td>Level 6</td>
                                                <td>5%</td>
                                                <td></td>
                                                <td>Level 12</td>
                                                <td>5%</td>
                                            </tr>
                                                
                                </tbody>
                                
                            </table>
                            <br>
                            <h5>
                                Token Development Fund - 20%
                            </h5>
                            <h6>
                                Total: 100% Distribution
                            </h6>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section> --}}

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
                                                        Level {{ $item->bonus }}%</b> </p>


                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer" style="background-color: rgb(43, 25, 59)">
                                        <div class="text-right">
                                            @php
                                                $active_pack = DB::table('orders')
                                                    ->where('user_id', Auth::user()->id)
                                                    ->latest()
                                                    ->first();
                                            @endphp
                                            @if ($active_pack)
                                                 <a href="{{URL::to('/user/add-to-cart-package-upgrade/'.$item->id)}}" class="btn btn-sm btn-primary ">
                                                    <i class="fas fa-user"></i> Upgrade
                                                  </a>
                                                
                                            @else
                                                <a href="{{ URL::to('/user/add-to-cart-package/' . $item->id) }}"
                                                    class="btn btn-sm btn-primary ">
                                                    <i class="fas fa-user"></i> Buy Now
                                                </a>
                                            @endif

                                            <button class="btn btn-sm btn-primary" style="float: left" data-toggle="modal"
                                                data-target="#detailsModal{{ $item->id }}">Details</button>



                                        </div>
                                    </div>
                                </div>

                            </div>
                            @php
                                $i++;
                            @endphp
                            <div class="modal fade" id="detailsModal{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @php
                                                echo $item->description;
                                            @endphp  
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
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
