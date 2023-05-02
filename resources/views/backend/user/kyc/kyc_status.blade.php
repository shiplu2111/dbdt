@extends('backend.user.layouts.master')
@section('title')
    DBDT-KYC Status
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12" style="text-align: center">
                        
                            @if (session('status'))
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Identity Verification',
                                        text: 'To comply with regulation you will have to go through identity verification...',

                                        timer: 6000,
                                        showClass: {
                                            popup: 'animate__animated animate__fadeInDown'
                                        },
                                        hideClass: {
                                            popup: 'animate__animated animate__fadeOutUp'
                                        }
                                    })
                                </script>
                            @endif
                            @if (session('status_no'))
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Identity Verification',
                                        text: 'Sorry! Your Identity document number already exist in our database',
                                        timer: 6000,
                                        showClass: {
                                            popup: 'animate__animated animate__fadeInDown'
                                        },
                                        hideClass: {
                                            popup: 'animate__animated animate__fadeOutUp'
                                        }
                                    })
                                </script>
                            @endif

                        
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-sm-6 offset-sm-3" style="text-align: center">
                    <h3 >You have successfully completed!</h3>
                    <hr>
                    <p style="text-align: center; font-size: 18px">Congrats, you have successfully submitted all the documents for verification. One of our team member will review your documents and you will be notified via email for its progress.</p>
               <br>
               <p  style="text-align: center; font-size: 14px; font-family: Arial, Helvetica, sans-serif;">
                Our verification process may take 3-5 business days.
               </p>
               <br>
               <a href="{{ url('/user/dashboard') }}" class="btn btn-outline-primary">Go to Dashboard</a>
               <span> </span>
              
               <br><br><br>
               <p>
                Please feel free to contact if you need any further information.
               </p>
                </div>

            </div>
            <br>
            <br>

        </section>
    </div>
@endsection
