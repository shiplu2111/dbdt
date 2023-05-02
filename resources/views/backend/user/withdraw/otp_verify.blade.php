@extends('backend.user.layouts.master')
@section('title')
    DBDT-Withdraw DBDT
@endsection
@section('content')
    
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                      
                    </div>
                    <div class="col-sm-6">
                        
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid" >
                
                <div class="login-box" style="margin: auto;
                max-width: 500px;">
                    <!-- /.login-logo -->
                    <div class="card card-outline card-primary">
                      {{-- <div class="card-header text-center">
                         <a href="#" class="h1"><b>Digital</b>BDT</a> 
                          
                      </div> --}}
                      <div class="card-body">
                        <h5 class="login-box-msg">Please enter the one time password (OTP) to complete your withdraw.</h5>
                        <h6 class="login-box-msg">A code has been sent to {{Auth::user()->email}}</h6>
                  
                        {{-- <form id="withdrawForm"> --}}
                            <form method="POST" class="form-horizontal" action="{{ route('withdraw.otpVerify') }}">
@csrf
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="otp" id="otp" required minlength="7" maxlength="7" pattern="[0-9]{7}" title="OTP Must be 7 numbers" placeholder="Enter Your OTP Here...">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span>OTP</span>
                              </div>
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-8">
                              
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                              <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                            <!-- /.col -->
                          </div>
                        </form>
                  
                        
                        <!-- /.social-auth-links -->
                  
                        
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
            </div>
        </section>

    </div>
    <script>
        function myFunction() {
            let userInput = document.getElementById('withdraw_ammount').value;
            let userTax = document.getElementById('withdraw_tax').value;
            let userCommision = document.getElementById('withdraw_commision').value;
            let userCharge = document.getElementById('withdraw_charge').value;
            // var b= userInput*3;
            document.getElementById("withdraw_ammount1").innerHTML = userInput;
            document.getElementById("withdraw_ammount2").innerHTML = userInput / 100 * userTax;
            document.getElementById("withdraw_ammount3").innerHTML = userInput / 100 * userCommision;
            document.getElementById("todal_withdraw").innerHTML = userInput - userInput / 100 * userTax - userInput / 100 *
                userCommision - userCharge;

        }
    </script>
    <script>
        $("#withdrawForm").submit(function(e) {
            e.preventDefault();
            let withdraw_amount = $("#withdraw_ammount").val();
            let account_id = $("#account_id").val();
            let _token = $("import [name=_token]").val();

            $.ajax({

                url: "{{ route('withdraw.dbdt') }}",
                type: "POST",
                data: {
                    withdraw_amount: withdraw_amount,
                    account_id: account_id,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    if (response) {
                        document.getElementById("withdraw_ammount1").innerHTML = '0';
                        document.getElementById("withdraw_ammount2").innerHTML = '0';
                        document.getElementById("withdraw_ammount3").innerHTML = '0';
                        document.getElementById("todal_withdraw").innerHTML = '0';
                        var withdraw_balance_old = document.getElementById('total_withdraw_balance')
                            .value;
                        var can_withdraw_balance_old = document.getElementById('can_withdraw_balance')
                            .value;
                        var withdraw_balance_new = $("#withdraw_ammount").val();
                        var a = withdraw_balance_old - withdraw_balance_new;
                        var b = can_withdraw_balance_old - withdraw_balance_new;
                        document.getElementById("withdraw_bal").innerHTML = a.toFixed(2);
                        document.getElementById("can_withdraw_bal").innerHTML = b.toFixed(2);

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
                            title: 'Withdraw Request Send Successfully'
                        })

                    }
                }
            });
        });
    </script>
    <script>
        $('.notEnoughBalance').click(function() {
            toastr.error('Sorry you do not have enough balance for withdraw!')
        });
    </script>
@endsection
