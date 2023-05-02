@extends('frontend.layouts.master')
@section('content')

<div>

    <section class="page-banner-sec-wrp">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="page-banner-des">
              <h1 class="page-banner-title">How To Login Or Register?</h1>
            </div>
          </div>
        </div>
      </div>
    </section><!-- end of page-banner -->

    <section class="dbdt-login-register-sec-wrp">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="dbdt-login-register-wrp clearfix">
              <div class="dbdt-login-register-lft">
                <div class="dbdt-login-wrp">
                  <h2 class="dbdt-login-register-title">Account Login</h2>
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="dbdt-form-field">
                      <label>Email <span>*</span></label>
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Enter Your Email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="dbdt-form-field">
                      <label>Password <span>*</span></label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Enter Your Password">

                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="dbdt-form-field">
                        <div class="form-check">

                            <label>

                                <span>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                </span>
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                      </div>

                    <div class="dbdt-form-submit">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                  </form>
                </div>
              </div>
              <div class="dbdt-login-register-rgt">
                <h2 class="dbdt-login-register-title">New here Signup</h2>
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                  <div class="dbdt-form-field">
                    <label>Name <span>*</span></label>
                    <input type="text" id="name"  type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name"  placeholder="Enter Your Name as per ID or Passport...">
                <input type="hidden" name="role" value="user">


                  </div>

                  <div class="dbdt-form-field">
                    <label>Username <span>*</span></label>
                    <input type="text"  id="username" class="block mt-1 w-full"  type="text" name="username" :value="old('username')" required
                    autofocus autocomplete="username" pattern="^\S+$" placeholder="Choice an username without blank space">

                  </div>





                  <div class="dbdt-form-field">
                    <label>Email <span>*</span></label>
                    <input type="email"  name="email" :value="old('email')"
                    required  placeholder="Enter Your Email...">
                  </div>

                  <div class="dbdt-form-field">
                    <label>Phone Number With Country Code<span>*</span></label>

                    <input type="text"  id="phone" type="text" name="phone"
                    :value=" old('phone')  " autofocus autocomplete="phone"  placeholder="Enter Your Phone Number including country code....">
                </div>


                  <div class="dbdt-form-field">
                    <label>Sponsor ID If Any<span>*</span></label>
                    <input type="text"  id="sponcerid"  type="text" name="sponcerid"
                    :value=" old('sponcerid')  " autofocus autocomplete="sponcerid"  placeholder="Enter Your Sponsor Id If Any...">
                  </div>
                  <div class="dbdt-form-field">
                    <label>Password <span>*</span></label>
                    <input type="password" name="password" required
                    autocomplete="new-password"  placeholder="Enter Your Password...">
                  </div>

                  <div class="dbdt-form-field">
                    <label>Confirm Password <span>*</span></label>
                    <input type="password"  name="password_confirmation" required autocomplete="new-password"  placeholder="Enter Same Password Again...">
                  </div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="dbdt-form-field">

                <input type="checkbox" name="terms" id="terms" >
                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
                    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
                ]) !!}
             </div>
@endif


                  <div class="dbdt-form-submit">
                    <button type="submit" value="submit">Register</button>
                  </div>
                </form>
                 <div class="dbdt-singup-form-or">
                   <span>Or</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

      </div>

@endsection
