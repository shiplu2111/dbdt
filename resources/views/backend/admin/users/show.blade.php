@extends('backend.admin.layouts.master')
@section('content')


@if (session('delete_success'))
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
          icon: 'warning',
          title: 'Deleted Succeddfully'
        })
         </script>
        @endif
        @if (session('status_deny'))
        <script>
         const Toast = Swal.mixin({
          toast: true,
          position: 'center',
          showConfirmButton: false,
          timer: 1500,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        
        Toast.fire({
          icon: 'error',
          title: 'Deposite Denied'
        })
         </script>
        @endif

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
              <th>Email</th>
              <th>Username</th>

              <th>Joining Date</th>
              <th>Status</th>
              <th>Action</th>
              <th>Details</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>S/N</th>
                <th>Email</th>
                <th>Username</th>
                <th>Joining Date</th>
                <th>Status</th>

                <th>Action</th>
              <th>Details</th>

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
              <td>{{ $item->email }}</td>
              <td>{{ $item->username }}</td>
              <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
              @if ($item->status==1)
              <td>Active</td>
              <td><a class="btn btn-sm btn-success" href="{{ url('/admin/user/ban/'.$item->id) }}">Ban</a> <span></span> <a class="btn btn-sm btn-warning" href="{{ url('/admin/user/inactive/'.$item->id) }}">Inactive</a></td>
              @endif
              @if ($item->status==0)
              <td>Inctive</td>
              <td><a class="btn btn-sm btn-success" href="{{ url('/admin/user/ban/'.$item->id) }}">Ban </a> <span></span> <a class="btn btn-sm btn-primary" href="{{ url('/admin/user/active/'.$item->id) }}">Aactive</a></td>
              @endif
              @if ($item->status==2)
              <td>Banned</td>
              <td> <a class="btn btn-sm btn-warning" href="{{ url('/admin/user/inactive/'.$item->id) }}">Unban</a> <span></span> <a class="btn btn-sm btn-primary" href="{{ url('/admin/user/active/'.$item->id) }}">Aactive</a></td>
              @endif
<td>
  <a class="btn btn-sm btn-primary" href="{{ url('/admin/user/details/'.$item->id) }}"><i class="fas fa-info-circle"></i></a> 
  @if ($item->status==2 || $item->status==0)
  <a class="btn btn-sm btn-danger" href="{{ url('/admin/user/delete/'.$item->id) }}"><i class="fas fa-trash-alt"></i></a> 
  @endif
</td>
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
