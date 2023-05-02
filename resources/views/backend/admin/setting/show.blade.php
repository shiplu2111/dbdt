@extends('backend.admin.layouts.master')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Website Setting</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Website Setting</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
<div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
</div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <!-- left column -->
                    <div class="col-md-7">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Website Setting</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" enctype="multipart/form-data" id="website_setting" action="javascript:void(0)">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="website_name">Website Name</label>
                                        @if ($setting)
                                        <input type="text" class="form-control" id="website_name"
                                        placeholder="Enter Website Name" value="{{ $setting->website_name }}">
                                        @else
                                        <input type="text" class="form-control" id="website_name"
                                        placeholder="Enter Website Name" >
                                        @endif


                                    </div>
                                    <div class="form-group">
                                        <label for="website_slogan">Slogan</label>
                                        @if ($setting)
                                        <input type="text" class="form-control" id="website_slogan"
                                            placeholder="Website Slogan" value="{{ $setting->website_slogan }}">
                                        @else
                                        <input type="text" class="form-control" id="website_slogan"
                                            placeholder="Website Slogan" >
                                            @endif
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="exampleInputFile">Logo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="logo">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>



                                        </div>
                                        <div class="justify-content-md-center">
                                            <span class="input-group-text"> <img id="logo-upload" class="profile-user-img img-fluid img-circle"
                                                src="#" style="height: 50px; width: 50px;"></span>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <label for="exampleInputFile">Fevicon</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="fevIcon">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>

                                        </div>
                                        <div>
                                            <span class="input-group-text"> <img id="fevicon-upload" class="profile-user-img img-fluid img-circle"
                                                src="#" style="height: 50px; width: 50px;"></span>
                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="footerText">Footer Text</label>
                                        @if ($setting)
                                        <textarea id="footerText" name="footerText" class="form-control" >{{ $setting->website_footer_text }}</textarea>
                                        @else
                                        <textarea id="footerText" name="footerText" class="form-control" placeholder="Enter footer text here..."></textarea>

                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="copyWriteText">Copwrite Text</label>
                                        @if ($setting)
                                        <textarea id="copyWriteText" name="copyWriteText" class="form-control" >{{ $setting->website_copy_write }}</textarea>
                                        @else
                                        <textarea id="copyWriteText" name="copyWriteText" class="form-control" placeholder="Enter copy write text here..."></textarea>

                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="tax">Tax</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                        @if ($setting)
                                        <input type="number" class="form-control" id="tax"
                                            placeholder="Tax" value="{{ $setting->tax }}">
                                            @else
                                            <input type="number" class="form-control" id="tax"
                                            placeholder="Tax">
                                            @endif
                                        </div>
                                        <div class="input-group-append">
                                          <span class="input-group-text">%</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="usd_dbdt">$1 USD Equal</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                @if ($setting)
                                                <input type="number" step="any" class="form-control" id="usd_dbdt" value="{{ $setting->usd_dbdt }}">

                                            @else

                                              <input type="number" step="any" class="form-control" id="usd_dbdt">
                                              @endif
                                            </div>
                                            <div class="input-group-append">
                                              <span class="input-group-text">DBDT</span>
                                            </div>
                                          </div>
                                    </div>

                                   
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Logo </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" enctype="multipart/form-data" action="{{ route('logo.add') }}">
@csrf
                                    <div class="card-body">

                                         <div class="form-group">

                                            <div class="input-group ">

                                                <div class="custom-file col-md-8">

                                                    <input type="file" class="custom-file-input" name="logo" id="logo" required>
                                                    <label class="custom-file-label" for="logo">Choose Only Image</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <span class="input-group-text">
                                                        @if($setting)
                                                        <img id="logo-upload" class="profile-user-img img-fluid img-circle"
                                                        src="{{ URL::to('/') }}/{{ $setting->website_logo_path}}" style="height: 50px; width: 50px;">
                                                        @else
                                                        <img id="logo-upload" class=" img-circle"
                                                        src="#" style="height: 50px; width: 50px;">
                                                        @endif
                                                    </span>


                                                </div>

                                            </div>



                                        </div>


                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Save Logo</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Fevicon </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" enctype="multipart/form-data" action="{{ route('fev.icon.add') }}">
                                    @csrf
                                    <div class="card-body">


                                         <div class="form-group">
                                            <div class="input-group">
                                                <div class="custom-file col-md-8">

                                                    <input type="file" class="custom-file-input" id="fevIcon" name="fevIcon">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose Only Image</label>
                                                </div>
                                                <div class="col-md-4">

                                                    <span class="input-group-text">
                                                        @if($setting)
                                                        <img id="fevIcon-upload" class="profile-user-img img-fluid img-circle"
                                                        src="{{ URL::to('/') }}/{{ $setting->website_fevIcon_path}}" style="height: 50px; width: 50px;">
                                                        @else
                                                        <img id="fevIcon-upload" class=" img-circle"
                                                        src="#" style="height: 50px; width: 50px;">
                                                        @endif
                                                    </span>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Save Fevicon</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>






<script>
$('#logo').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#logo-upload').attr('src', e.target.result);
                    // $('#preview-image-before-upload1').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#fevIcon').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#fevIcon-upload').attr('src', e.target.result);
                    // $('#preview-image-before-upload1').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
    $("#website_setting").submit(function(e) {
        e.preventDefault();
        let website_name = $("#website_name").val();
        let website_slogan = $("#website_slogan").val();
        let footerText = $("#footerText").val();
        let copyWriteText = $("#copyWriteText").val();
        let usd_dbdt = $("#usd_dbdt").val();
        let tax = $("#tax").val();

        let _token = $("import [name=_token]").val();

        $.ajax({

            url: "{{ route('website.setting') }}",
            type: "POST",
            data: {
                website_name: website_name,
                website_slogan: website_slogan,
                footerText: footerText,
                copyWriteText: copyWriteText,
                usd_dbdt: usd_dbdt,
                tax: tax,

                
                _token: '{{ csrf_token() }}'

            },
            success: function(response) {
                if (response) {


                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
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
                        title: 'Updated Successfully'
                    })
                    // $("#packageForm")[0].reset();
                    // $("#packageModal").modal('hide');
                    // $('.modal-backdrop').remove();
                }
            }
        });
    });
</script>



@endsection
