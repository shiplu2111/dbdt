@extends('backend.user.layouts.master')
@section('title')
DBDT- KYC PASSPORT SUBMIT
@endsection
@section('content')
    <div class="content-wrapper">
        <style>
            /* Code By Webdevtrick ( https://webdevtrick.com ) */
            .container {
                padding: 50px 10%;
            }

            .box {
                position: relative;
                background: #ffffff;
                width: 100%;
            }

            .box-header {
                color: #444;
                display: block;
                padding: 10px;
                position: relative;
                border-bottom: 1px solid #f4f4f4;
                margin-bottom: 10px;
            }

            .box-tools {
                position: absolute;
                right: 10px;
                top: 5px;
            }

            .dropzone-wrapper {
                border: 2px dashed #91b0b3;
                color: #92b0b3;
                position: relative;
                height: 210px;
            }

            .dropzone-desc {
                position: absolute;
                margin: 0 auto;
                left: 0;
                right: 0;
                text-align: center;
                width: 40%;
                top: 50px;
                font-size: 16px;
            }

            .dropzone,
            .dropzone:focus {
                position: absolute;
                outline: none !important;
                width: 100%;
                height: 150px;
                cursor: pointer;
                opacity: 0;
            }

            .dropzone-wrapper:hover,
            .dropzone-wrapper.dragover {
                background: #ecf0f5;
            }

            .preview-zone {
                text-align: center;
            }

            .preview-zone .box {
                box-shadow: none;
                border-radius: 0;
                margin-bottom: 0;
            }

            .btn-primary {
                background-color: crimson;
                border: 1px solid #212121;
            }

        </style>
        <section>
            <form action="{{ route('passport.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="offset-md-3 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Upload Passport Copy</label>
                                <div class="preview-zone hidden">
                                    <div class="box box-solid">
                                        <div class="box-header with-border">
                                            <div><b>Preview</b></div>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-danger btn-xs remove-preview">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="box-body"></div>
                                    </div>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="dropzone-wrapper" id="demo">
                                    <div class="dropzone-desc">

                                        <i class="glyphicon glyphicon-download-alt"></i>
                                        <p>Choose a Passport Copy or drag it here.</p>
                                        <div class="preview-zone hidden">


                                            {{-- <div class="box-body"></div> --}}

                                        </div>
                                    </div>
                                    <input required type="file" accept="image/*" id="passport_copy" name="passport_copy"
                                        class="dropzone">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="control-label">Selfie with Passport</label>
                                <div class="preview-zone hidden">
                                    <div class="box box-solid">
                                        <div class="box-header with-border">
                                            <div><b>Preview</b></div>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-danger btn-xs remove-preview">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="box-body"></div>
                                    </div>
                                </div>
                                <div class="dropzone-wrapper">
                                    <div class="dropzone-desc">

                                        <i class="glyphicon glyphicon-download-alt"></i>
                                        <p>Choose Selfie with Passport or drag it here.</p>
                                        <div class="preview-zone hidden">


                                            <div class="box-body "></div>

                                        </div>
                                    </div>
                                    <input type="file" accept="image/*" capture="camera" name="passport_selfie"
                                        class="dropzone">

                                </div>
                            </div>
                        </div> --}}
                        
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-right">Next Step</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>

    <script>
        // Code By Webdevtrick ( https://webdevtrick.com )
        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var htmlPreview =
                        '<img width="90%" max-height="200" src="' + e.target.result + '" />' +
                        '<p>' + input.files[0].name + '</p>';
                    var wrapperZone = $(input).parent();
                    var previewZone = $(input).parent().parent().find('.preview-zone');
                    var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

                 

                    wrapperZone.removeClass('dragover');
                    previewZone.removeClass('hidden');
                    // dropZone.addClass('hidden');
                    const myElement = document.getElementById("demo");
myElement.style.display = "none";

                    boxZone.empty();
                    boxZone.append(htmlPreview);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function reset(e) {
            e.wrap('<form>').closest('form').get(0).reset();
            e.unwrap();
        }

        $(".dropzone").change(function() {
            readFile(this);
        });

        $('.dropzone-wrapper').on('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('dragover');
        });

        $('.dropzone-wrapper').on('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragover');
        });
        

        $('.remove-preview').on('click', function() {
            var boxZone = $(this).parents('.preview-zone').find('.box-body');
            var previewZone = $(this).parents('.preview-zone');
            var dropzone = $(this).parents('.form-group').find('.dropzone');
            boxZone.empty();
            reset(dropzone);

            const myElement = document.getElementById("demo");
myElement.style.display = "block";
        });
    </script>

<script>
        

    const input = document.getElementById('passport_copy')

input.addEventListener('change', (event) => {
const target = event.target
  if (target.files && target.files[0]) {

  /*Maximum allowed size in bytes
    5MB Example
    Change first operand(multiplier) for your needs*/
  const maxAllowedSize = 5*1024 * 1024;
  if (target.files[0].size > maxAllowedSize) {
       target.value = ''
       Swal.fire({
title: 'Please Select An Image Size Less Then 5MB For Uploading',
showClass: {
popup: 'animate__animated animate__fadeInDown'
},
hideClass: {
popup: 'animate__animated animate__fadeOutUp'
}
})
  }
}
})
</script>
@endsection
