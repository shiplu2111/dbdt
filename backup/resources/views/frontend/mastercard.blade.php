@extends('frontend.layouts.master')
@section('content')

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
    </section>
    <!-- end of page-banner -->

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
                <h6>Getting Started</h6>
                <span></span>
              </div>
              <div class="fl-shipping-col">
                <h6>Getting Started</h6>
                <span></span>
              </div>
              <div class="fl-shipping-col">
                <h6>Getting Started</h6>
                <span></span>
              </div>
            </div>
            <div class="register-form-wrp clearfix">
              <div class="select-type-wrp">
                <div class="input-type-radio-inr clearfix">
                  <span>Select your type of business</span>
                  <div class="input-type-radio">
                    <input
                      type="radio"
                      id="individual"
                      name="radios"
                      value="true"
                      checked
                    />
                    <label href="#tabs" for="individual">
                      Individual
                      <span class="checkmark"></span>
                      <p>My business isn't registered</p>
                    </label>
                  </div>
                  <div class="input-type-radio">
                    <input type="radio" id="company" name="radios" value="true" />
                    <label href="#tabs" for="company">
                      Company
                      <span class="checkmark"></span>
                      <p>Includes sole proprietorship, corporation, LLC</p>
                    </label>
                  </div>

                  <div class="register-form-inr">
                    <form>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Email</label>
                          <input
                            type="email"
                            class="form-control"
                            id="inputEmail4"
                            placeholder="Email"
                          />
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPassword4">Password</label>
                          <input
                            type="password"
                            class="form-control"
                            id="inputPassword4"
                            placeholder="Password"
                          />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input
                          type="text"
                          class="form-control"
                          id="inputAddress"
                          placeholder="1234 Main St"
                        />
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2">Address 2</label>
                        <input
                          type="text"
                          class="form-control"
                          id="inputAddress2"
                          placeholder="Apartment, studio, or floor"
                        />
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputCity">City</label>
                          <input type="text" class="form-control" id="inputCity" />
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputState">State</label>
                          <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                          </select>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputZip">Zip</label>
                          <input type="text" class="form-control" id="inputZip" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="gridCheck"
                          />
                          <label class="form-check-label" for="gridCheck">
                            Check me out
                          </label>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Sign in</button>
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
