@extends('backend.user.layouts.master')
@section('title')
    DBDT- My Income History 
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1>Available Packages</h1> --}}
                        {!! Session::has('msg') ? Session::get("msg") : '' !!}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item "><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">My Income History</li>

                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  
      
      
                  <!-- Main content -->
                  <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    
                    <!-- info row -->
                    
                    <!-- /.row -->
      
                    <!-- Table row -->
                    <div class="row">
                      <div class="col-12 table-responsive">
                        <table class="table table-bordered" style="text-align: center">
                          <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>More</th>
                          </tr>
                          </thead>
                          <tbody>
                              @php
                                  $i=1;
                              @endphp
                              @foreach ($incomes as $item)
                                  
                              
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }} ({{ Carbon\Carbon::parse($item->created_at)->format('h:i A') }})</td>
                            <td>{{ number_format($item->income_amount, 2, '.', ',') }} DBDT</td>
                           
                            <td><button data-toggle="modal" data-target="#stake_details{{ $item->id }}"
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
                                    
                                        <div class="modal-body" style="padding: 20px">
                                         <h5> Notes: </h5>
                                          <hr> <h6>{{$item->notes}}</h6>
                                          <br>
                                          <br>
                                         <h5>
                                            Income Type:  
                                        </h5>
                                            <hr>  
                                            <h6>{{$item->income_type}}</h6>
                               
                                         
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
                          <tr>
                            <td style="border: none"></td>
                           
                            <td>Total Income:</td>

                            <td>{{ number_format($total_income, 2, '.', ',') }} DBDT</td>
                            <td style="border: none"></td>

                          </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
      
                  
                    <!-- /.row -->
      
                    <!-- this row will not appear when printing -->
                    
                  </div>
                  <!-- /.invoice -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
    
    </div>
    <script>
        $('.toastrDefaultError').click(function() {
          toastr.error('Sorry you already purchased a package.You are not able to buy another from this id')
        });
    </script>
@endsection
