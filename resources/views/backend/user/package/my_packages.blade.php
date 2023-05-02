@extends('backend.user.layouts.master')
@section('title')
    DBDT- Available Package List
@endsection
@section('content')
    <div class="content-wrapper">

        @if (session('upgrade_success'))
        <script>
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
          title: 'Package Updated Successfully'
        })
         </script>
        @endif
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h2 class="m-0">My Packages</h2>
                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            {{-- To activate your account please pay the equal amount of the package and then submit the transaction hash# <br> --}}

                         <br>
                            {{-- <table  style="table-layout: fixed; width: 100%">
								@php
                                $deposit_methods = DB::table('deposit_methods')->get();
                            @endphp
								
								@if($deposit_methods)
								                                @foreach ($deposit_methods as $deposit_method)

                                <tr>
                                  <td style="word-wrap: break-word; width:30%"><h6>{{$deposit_method->name}}:</h6></td>
                                  <td style="word-wrap: break-word; width:50%"><p  id="{{$deposit_method->id}}">{{$deposit_method->address}}</p></td>
									<td style="word-wrap: break-word; width:20%"><button class="btn btn-block btn-outline-success btn-sm"  onclick="CopyToClipboard('{{$deposit_method->id}}');return false;">Copy</button></td>
                                </tr>
								@endforeach
								@endif
                               
                              </table> --}}
                          </p>
                        <p>
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped" id="example1" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Package Name</th>
                            <th>USDT Amount</th>
                            <th>DBDT Amount</th>
                            <th>Order Date</th>
                            {{-- <th>Status</th> --}}
                            <th>Override</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Package Name</th>
                            <th>USDT Amount</th>
                            <th>DBDT Amount</th>
                            <th>Order Date</th>
                            {{-- <th>Status</th> --}}
                            <th>Override</th>
                        </tr>
                    </tfoot>

                    <tbody>
						@if($packages)
                        @php
                            $i = 1;
                        @endphp
                       
                           @foreach ($packages as $item)
                               
                            @if($i==1)
                                <tr class="table-primary">
                                
                                    
                                @else
                                <tr class="table-success" >
                                    
                                @endif
                            <td>{{ $i }}</td>
									@if($item)
                            @php
                                $package_data = DB::table('packages')
                                    ->where('id', $item->package_id)
                                    ->first();
                            @endphp
									@endif
                            <td>
								@if($item)
								{{ $package_data->packagename }}
								@endif
							</td>
                            <td>
								@if($item)
								{{ $package_data->usdtprice }}
								@endif
							</td>
                            <td>
								@if($item)
								{{ $package_data->dbdtprice }}
								@endif
							</td>
                            <td>
								@if($item)
								{{ Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}
									@endif
									</td>
									@if($item)
                            @if ($item->status == 0)
                                <td>Inctive</td>
                                <td><button type="button" data-toggle="modal"
                                        data-target="#modal-success1{{ $item->id }}" class="btn btn-success">
                                        Pay Now
                                    </button>
                                    <span></span> <a onclick="return confirm('Are you sure to delete this order? ')"
                                        class="btn btn-danger"
                                        href="{{ url('/user/delete-packages/' . $item->id) }}">Delete</a>
                                </td>
                            @endif
									@endif
									@if($item)
                            @if ($item->status == 1)
                                {{-- <td>Active</td> --}}
                                <td>{{ $package_data->overridelevel }} Level</td>
									
                               
                            @endif
									@endif
									@if($item)
                            @if ($item->status == 2)
                                <td>In Review</td>
                                <td><a class="btn btn-success"
                                        href="{{ url('/user/package-details/' . $item->id) }}">Package Details </a> </td>
                            @endif
									@endif

                                    @if($item)
                            <div class="modal fade" id="modal-success1{{ $item->id }}">
								
                                <div class="modal-dialog">
                                    <div class="modal-content bg-success">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Payment Confirmation </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="/user/invoice-payment">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Transection Id</label>
                                                        <input type="text" class="form-control" id="pay_code"
                                                            name="pay_code" placeholder="Enter your transection id here">
														@if($item)
                                                        <input type="hidden" name="p_id" value="{{ $item->id }}">
														@endif
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->



                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-outline-light"
                                                data-dismiss="modal">Close</button>

                                            <button type="submit" class="btn btn-outline-light">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
						@endif
                            </tr>
                            @php
                                $i++;
                            @endphp
                           @endforeach

						

                            <!-- /.modal -->

                            <!-- /.modal -->
                            
                      
                        </tr>
				@endif
                    </tbody>
			

                </table>
            </div>
        </div>
    </div>
    </div>
<script>
    function CopyToClipboard(id)
    {
    var r = document.createRange();
    r.selectNode(document.getElementById(id));
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(r);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();
		const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 1500,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Copy successfully'
})
    }
	
	
    </script>
@endsection
