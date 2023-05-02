@extends('backend.admin.layouts.master')
@section('content')





    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>KYC Requests</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">KYC Requests</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @if (session('status_ok'))
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
                title: 'KYC Request Accepted Successfully'
            })
        </script>
        @endif
        
        @if (session('status_not'))
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
                title: 'KYC Request Rejected Successfully'
            })
        </script>
        @endif
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row">
                      
                            @foreach ($kyc_requests as $item)
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-0">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}

                                        </div>
                                        <div class="card-body pt-3">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h2 class="lead"><b
                                                            style="text-transform: uppercase;">{{ $item->name }}</b></h2>
                                                    <p style="text-transform: uppercase;" class="text-muted text-sm">
                                                        <b>Username: </b>{{ $item->username }} ({{ $item->id }})</p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small" style="margin-bottom: 3px"><span
                                                                class="fa-li"><i
                                                                    class="fas fa-lg fa-envelope"></i></span>
                                                            {{ $item->email }}</li>
                                                        <li class="small" style="margin-bottom: 3px"><span
                                                                class="fa-li"><i
                                                                    class="fas fa-lg fa-phone"></i></span>
                                                            {{ $item->phone }}</li>
                                                        <li class="small" style="margin-bottom: 3px"><span
                                                                class="fa-li"><i
                                                                    class="far fa-lg fa-file-pdf"></i></span>
                                                            {{ $item->document_type }} -> {{ $item->document_number }}</li>
                                                        <li style="text-transform: uppercase;" class="small"
                                                            style="margin-bottom: 3px"><span class="fa-li"><i
                                                                    class="far  fa-lg fa-flag"></i></span>
                                                            {{ $item->issued_by_country }} </li>
                                                    </ul>
                                                </div>
                                                <div class="col-4 text-center">
                                                    @if ($item->profile_photo_path)
                                                        <img src="{{ URL::to('/') }}/{{ $item->profile_photo_path }}"
                                                            style="height: 70px; width: 70px" alt="user-avatar"
                                                            class="img-circle img-fluid">
                                                    @else
                                                        <img style="height: 50px; width: 50px"
                                                            src="https://media.istockphoto.com/vectors/vector-businessman-black-silhouette-isolated-vector-id610003972?k=20&m=610003972&s=612x612&w=0&h=-Nftbu4sDVavoJTq5REPpPpV-kXH9hXXE3xg_D3ViKE="
                                                            class="img-circle elevation-2" alt="{{ $item->name }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-center">
                                                <a href="{{ url('/admin/kyc/details/' . $item->id) }}"
                                                    class="btn btn-sm bg-teal">
                                                    <i class="far fa-file-pdf"></i> View Documents
                                                </a>
                                                <a href="{{ url('/admin/user/details/' . $item->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-user"></i> View Profile
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                       
                       




                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer ">
                  <nav aria-label="Contacts Page Navigation">
                    <ul class="pagination justify-content-center m-0">
                      <li class="page-item active"> No More Record Found</li>
                      
                  </ul>
                 
                </nav>
                    {{-- <nav aria-label="Contacts Page Navigation">
                        <ul class="pagination justify-content-center m-0">
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item"><a class="page-link" href="#">7</a></li>
                            <li class="page-item"><a class="page-link" href="#">8</a></li>
                        </ul>
                    </nav> --}}
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>




    <script>
        $(function() {
            $("#packageTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#packageTable_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

@endsection
