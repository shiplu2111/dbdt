@extends('backend.admin.layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2 class="m-0">@if (session()->has('success'))
                      <div class="alert alert-success">
                          {{ session()->get('success') }}
                      </div>
                  @endif</h2>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <button type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                data-target="#packageModal">
                Add New Package
            </button> --}}
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped" id="example1" width="100%" cellspacing="0">

           <thead>
            <tr>
              <th>S/N</th>
              <th>Name</th>
              <th>Email</th>
              <th>Country</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>S/N</th>
              <th>Name</th>
              <th>Email</th>
              <th>Country</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
              @php
                  $i=1;
              @endphp
              @foreach ($master_cards as $item)

              @if ($item->status==='0')
            <tr class="table-warning">
                @endif
                @if ($item->status==='1')
                <tr class="table-primary">
                    @endif
                    @if ($item->status==='2')
                    <tr class="table-dark">
                        @endif
              <td>{{ $i }}</td>
              <td>{{ $item->first_name }} {{ $item->last_name }}</td>
              {{-- <td>{{ $item->email }}</td> --}}
              <td>{{ $item->email }}</td>
              <td>{{ $item->country }}</td>
              <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
              @if ($item->status==1)
              <td>Active</td>
         
              {{-- <td> <a class="btn btn-sm btn-warning" href="{{ url('/admin/mastercard/inactive/'.$item->id) }}">Deny</a><span ></span> <a style="margin-top: 5px" class="btn btn-sm btn-info" href="{{ url('/admin/mastercard/application/details/'.$item->id) }}">Details</a></td> --}}
              @endif
              @if ($item->status==0)
              <td>Inctive</td>
              {{-- <td> <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                data-target="#modal-info{{ $item->id }}"> Approve</button> --}}
                     @endif

              <td>
                <a style="margin-top: 5px" class="btn btn-sm btn-info" href="{{ url('/admin/mastercard/application/details/'.$item->id) }}"><i class="fas fa-info-circle"></i></a>
                <a style="margin-top: 5px" class="btn btn-sm btn-info" href="{{ url('/admin/mastercard/application/edit/'.$item->id) }}"><i class="fas fa-edit"></i></a>
            </td>
            </td>   
            </tr>
            @php
                $i++;
            @endphp
            <div class="modal fade" id="modal-info{{ $item->id }}">
              <div class="modal-dialog">
                  <div class="modal-content bg-info">
                      <div class="modal-header">
                          <h4 class="modal-title">Mastercard application approve
                              {{ $item->id }}</h4>
                          <button type="button" class="close" data-dismiss="modal"
                              aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="card ">

                              <!-- /.card-header -->
                              <div class="card-body" style="color: black">
                                  <form method="POST" action="/admin/mastercard/active">
                                      @csrf
                                      <div class="from-group">
                                          <label for="hash">Card Number#</label>
                                          <input type="text"
                                              placeholder="Please enter Card Number"
                                              class="form-control" id="card_no" name="card_no" required>
                                          <input type="hidden" name="hidden_id"
                                              value="{{ $item->id }}">

                                      </div>

                                      <div class="from-group">
                                        <label for="hash">Expire Date:</label>
                                        <input type="date"
                                            required
                                            class="form-control" id="expire_date" name="expire_date">
                                       

                                    </div>

                              </div>
                              <!-- /.card-body -->
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-outline-light"
                              data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-outline-light">Active Mastercard</button>
                          </form>
                      </div>
                  </div>
                  <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
          </div>
            @endforeach
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    </div>
  </div>

@endsection
