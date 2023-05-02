@extends('frontend.layouts.master')
@section('content')
<script>
    function validateForm() {

      var pw = document.getElementById("password").value;
      var cpw = document.getElementById("confirm_password").value;


      if(pw == "") {
         document.getElementById("message").innerHTML = "**Fill the password please!";
         return false;
      }
      if(pw != cpw) {
         document.getElementById("message").innerHTML = "**Password didn't match";
         return false;
      }

      if(pw.length < 8) {
         document.getElementById("message").innerHTML = "**Password length must be atleast 8 characters";
         return false;
      }


    }


</script>
<div>
    <section class="page-banner-sec-wrp">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-banner-des">
                <h1 class="page-banner-title">DBDT MASTERCARD APPLICATION</h1>
              </div>
            </div>
          </div>
        </div>
      </section><!-- end of page-banner -->

      <section class="register-form-sec-wrp">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="register-form-head">
                <h2 class="register-form-head-title">DBDT Mastercard Sign UP</h2>
              </div>
              <div class="fl-shipping clearfix text-center">
                <div class="fl-shipping-col fl-ship-1">
                  <h6>Getting Started</h6>
                  <span></span>
                </div>
                <div class="fl-shipping-col two_sec">
                  <h6>Step 2</h6>
                  <span></span>
                </div>
                <div class="fl-shipping-col">
                  <h6>Step 3</h6>
                  <span></span>
                </div>
                <div class="fl-shipping-col">
                  <h6>Finish</h6>
                  <span></span>
                </div>
              </div>
              <div class="register-form-wrp clearfix">
                <div class="select-type-wrp">
                  <div class="input-type-radio-inr clearfix">
                    {{-- <span>Select your type of business</span> --}}
                    {{-- <div class="input-type-radio">
                      <input type="radio" id="individual" name="radios" value="true" checked>
                      <label href="#tabs" for="individual">
                        Individual
                        <span class="checkmark"></span>
                        <p>My business isn't registered</p>
                      </label>
                    </div> --}}
                    {{-- <div class="input-type-radio">
                      <input type="radio" id="company" name="radios" value="true">
                      <label href="#tabs" for="company">
                        Company
                        <span class="checkmark"></span>
                        <p>Includes sole proprietorship, corporation, LLC</p>
                      </label>
                    </div> --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="register-form-inr box true">
                      <form method="GET" class="needs-validation" onsubmit ="return validateForm()" action="{{ route('mastercard.stepOne') }}">
                          @csrf
                        <p>Please fill in the fields in English characters only</p>
                        <div class="tabs">
                            <div class="register-field">
                            <input type="text" name="first_name" placeholder="First Name" required>
                            <span><i class="fas fa-question-circle"></i></span>
                          </div>
                          <div class="register-field">
                            <input type="text" name="last_name" placeholder="Last Name" required>
                            <span><i class="fas fa-question-circle"></i></span>
                          </div>
                          <div class="register-field">
                            <input type="email" name="email" placeholder="Email Address" required>
                            <span><i class="fas fa-question-circle"></i></span>
                          </div>
                          <div class="register-field">
                            <input type="email" name="confirm_email" placeholder="Re-Enter Email Address" required>
                            @if (\Session::has('email_err'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('email_err') !!}</li>
                                </ul>
                            </div>
                        @endif
                        </div>
                          <div class="register-field">
							                            <label for="">Date of birth</label>

                            <input type="date" name="birth_day" placeholder="date of Birth" required>
                            <span><i class="fas fa-question-circle"></i></span>
                          </div>
                          <div class="register-field-text">
                            <p>long established fact that a reader will be distracted by the<br><a href="#"> Privacy & Cookie Policy</a> readable content </p>
                          </div>
                        </div>
                        {{-- <div class="tabs box true">
                            <b>Company details:</b>
                            <div class="register-field">
                              <input type="text" name="text" placeholder="Legal company name">
                              <span><i class="fas fa-question-circle"></i></span>
                            </div>
                            <div class="register-field-select">
                              <select id="select1" name="select1">
                                <option value="First Choice">Registered legal entity</option>
                                <option value="Second Choice">Registered legal entity</option>
                                <option value="Third Choice">Registered legal entity</option>
                              </select>
                            </div>
                            <div class="register-field">
                              <input type="text" name="text" placeholder="Company website URL (optional)">
                              <span><i class="fas fa-question-circle"></i></span>
                            </div>
                            <div class="register-field-bdr"></div>
                            <b>Authorized representative’s details:</b>
                            <div class="register-field">
                              <input type="text" name="text" placeholder="First name of authorized representative">
                              <span><i class="fas fa-question-circle"></i></span>
                            </div>
                            <div class="register-field">
                              <input type="text" name="text" placeholder="Last name of authorized representative">
                            </div>
                            <div class="register-field">
                              <input type="email" name="email" placeholder="Email address">
                              <span><i class="fas fa-question-circle"></i></span>
                            </div>
                            <div class="register-field">
                              <input type="email" name="email" placeholder="Re-enter email address">
                            </div>
                            <div class="register-field">
                              <input type="date" name="text" placeholder="Authorized representative's date of birth">
                              <span><i class="fas fa-question-circle"></i></span>
                            </div>
                            <div class="register-field-text">
                              <p>long established fact that a reader will be distracted by the<br><a href="#"> Privacy & Cookie Policy</a> readable content </p>
                            </div>
                        </div> --}}
                        <div class="register-submit-btn">
                          <button type="submit" >Next</button>
                        </div>
                   </form>
                  </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>
  </div>

@endsection
