@extends('backend.admin.layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2 class="m-0">Users</h2>
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
              <th>Username</th>
              {{-- <th>Email</th> --}}
              <th>Refferal Code</th>
              <th>Sponcor id</th>

              <th>Joining Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Username</th>
                {{-- <th>Email</th> --}}
                <th>Refferal Code</th>
                <th>Sponcor id</th>
                <th>Joining Date</th>
                <th>Status</th>

                <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
              @php
                  $i=1;
              @endphp
              @foreach ($users as $item)

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
              <td>{{ $item->name }}</td>
              <td>{{ $item->username }}</td>
              {{-- <td>{{ $item->email }}</td> --}}
              <td>{{ $item->myrefferalcode }}</td>
              <td>{{ $item->sponcerid }}</td>
              <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
              @if ($item->status==1)
              <td>Active</td>
              <td><a class="btn btn-success" href="{{ url('/admin/user/ban/'.$item->id) }}">Ban</a> <span></span> <a class="btn btn-warning" href="{{ url('/admin/user/inactive/'.$item->id) }}">Inactive</a></td>
              @endif
              @if ($item->status==0)
              <td>Inctive</td>
              <td><a class="btn btn-success" href="{{ url('/admin/user/ban/'.$item->id) }}">Ban </a> <span></span> <a class="btn btn-primary" href="{{ url('/admin/user/active/'.$item->id) }}">Aactive</a></td>
              @endif
              @if ($item->status==2)
              <td>Banned</td>
              <td> <a class="btn btn-warning" href="{{ url('/admin/user/inactive/'.$item->id) }}">Unban</a> <span></span> <a class="btn btn-primary" href="{{ url('/admin/user/active/'.$item->id) }}">Aactive</a></td>
              @endif

            </tr>
            @php
                $i++;
            @endphp
            @endforeach
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    </div>
  </div>

@endsection
