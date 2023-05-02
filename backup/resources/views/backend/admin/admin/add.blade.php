@extends('backend.admin.layouts.master')
@section('content')
<div class="content-wrapper hold-transition register-page">
    <div >
    <!-- Content Header (Page header) -->
    <div class="register-box ">
        <div class="card card-outline card-primary">
          <div class="card-header text-center ">
            <a href="{{ url('/dashboard') }}"><img style="max-height: 80px; max-width: 80px;" src="{{ URL::to('front/assets/images/logo.svg') }}"></a><span>DBDT-
                Future digital asset</span>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Register a new Admin</p>
<p>@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif</p>
            <form method="POST" action="{{ route('registeradmin') }}">
                @csrf
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="name" :value="old('name')" required
                autofocus autocomplete="name" placeholder="Name">
                <input type="hidden" name="role" value="admin">

                <div class="input-group-append">
                  <div class="input-group-text">
                    Name
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="email" class="form-control"  name="email" :value="old('email')" required
                autofocus autocomplete="email" pattern="^\S+$" placeholder="Email">
                <div class="input-group-append">
                  <div class="input-group-text">
                   Email
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="username" :value="old('username')"
                required autofocus placeholder="Username">
                <div class="input-group-append">
                  <div class="input-group-text">
                    Username
                  </div>
                </div>
              </div>

              <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" required
                autocomplete="new-password" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control"
                name="password_confirmation" required autocomplete="new-password"  placeholder="Retype password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
              @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())

                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" id="terms">
                    <label for="agreeTerms">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
                            'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
                        ]) !!}
                    </label>
                  </div>
                </div>
                @endif
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
              </div>
            </form>




          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      </div>

    </div>    </div>
@endsection
