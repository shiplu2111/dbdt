@extends('backend.admin.layouts.master')
@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 28px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgb(219, 12, 12);
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>
    @php
    $a = DB::table('withdraw_settings')
        ->latest()
        ->first();
    @endphp
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Withdraw Setting</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Withdraw Setting</li>
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
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Withdraw Setting</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('withdraw.setting.add') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="commission_withdraw_status">Pacakage base amount withdraw status</label>

                                        <label class="switch">
                                            @if ($a)
                                                <input type="checkbox" id="pack_value_withdraw_status"
                                                    name="pack_value_withdraw_status"
                                                    {{ $a->pack_value_withdraw_status == 1 ? 'checked' : '' }}>
                                            @else
                                                <input type="checkbox" id="pack_value_withdraw_status"
                                                    name="pack_value_withdraw_status">
                                            @endif
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label for="commission_withdraw_status">Earning commission withdraw status</label>

                                        <label class="switch">
                                            @if ($a)
                                                <input type="checkbox" id="commission_withdraw_status"
                                                    name="commission_withdraw_status"
                                                    {{ $a->commission_withdraw_status == 1 ? 'checked' : '' }}>
                                            @else
                                                <input type="checkbox" id="commission_withdraw_status"
                                                    name="commission_withdraw_status">
                                            @endif
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label for="withdraw_commission">Withdraw Commision: <i> (0 to 100 )</i></label>
                                        @if ($a)
                                            <input type="number" min="0" max="100" class="form-control"
                                                name="withdraw_commission" placeholder="Enter Withdraw Commision Rate %"
                                                value="{{ $a->withdraw_commission }}">
                                        @else
                                            <input type="number" min="0" max="100" class="form-control"
                                                name="withdraw_commission" placeholder="Enter Withdraw Commision Rate %"
                                                >
                                        @endif



                                    </div>
                                    <div class="form-group">
                                        <label for="withdraw_tax">Withdraw Tax <i> (0 to 100 )</i>

                                        </label>
                                        @if ($a)
                                            <input type="number" min="0" max="100" class="form-control"
                                                name="withdraw_tax" placeholder="Withdraw Tax Rate %"
                                                value="{{ $a->withdraw_tax }}">
                                        @else
                                            <input type="number" min="0" max="100" class="form-control"
                                                name="withdraw_tax" placeholder="Withdraw Tax Rate %">
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="tax">Withdraw Charge</label>
                                        @if ($a)
                                            <input type="number" class="form-control" name="withdraw_charge"
                                                placeholder="Withdraw Charge Per Transection"
                                                value="{{ $a->withdraw_charge }}">
                                        @else

                                            <input type="number" class="form-control" name="withdraw_charge"
                                                placeholder="Withdraw Charge Per Transection" value="">
                                        @endif
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-sm-right">Save Setting</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
    </div>






    <script>
        $("#website_setting").submit(function(e) {
            e.preventDefault();
            let website_name = $("#website_name").val();
            let website_slogan = $("#website_slogan").val();
            let footerText = $("#footerText").val();
            let copyWriteText = $("#copyWriteText").val();
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
