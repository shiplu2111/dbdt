@extends('frontend.layouts.master')
@section('content')

<div>

    <section class="page-banner-sec-wrp">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="page-banner-des">
              <h1 class="page-banner-title">STAKE DBDT</h1>
            </div>
          </div>
        </div>
      </div>
    </section><!-- end of page-banner -->

    <section class="stk-bd-form-sec-wrp">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="stk-bd-form-wrp">
              <div class="stk-bd-form-head">
                <h2 class="stk-bd-form-head-title">You can Stake DBDT and earn profit.?</h2>
              </div>
              <div class="staking-period-select-wrp">
                <div class="staking-period-select">
                  <label>Staking Period</label>
                  <select id="select1" name="select1">
                    <option value="First Choice">3 months (5-6% per annum)</option>
                    <option value="Second Choice">6 months (6-8% per annum)</option>
                    <option value="Third Choice">1 Year ( 8-12% per annum)</option>
                    <option value="Third Choice">2 Years (12-18% per annum)</option>
                    <option value="Third Choice">3 Years (18-24% per annum)</option>
                    <option value="Third Choice">5 years (24-36% per annum)</option>
                  </select>
                </div>
                <div class="staking-period-btn">
                  <button type="submit" name="submit">Stake Now</button>
                </div>
              </div>
              <div class="stk-pr-form-wrp">
                <form>
                  <div class="stk-pr-form-field">
                    <label>Name:</label>
                    <input type="text" name="name" placeholder="name">
                  </div>
                  <div class="stk-pr-form-field">
                    <label>Email:</label>
                    <input type="email" name="email" placeholder="Email">
                  </div>
                  <div class="stk-pr-form-field">
                    <label>Contact No:</label>
                    <input type="text" name="name" placeholder="Contact No">
                  </div>
                  <div class="stk-pr-form-field">
                    <label>DBDT Wallet address:</label>
                    <input type="text" name="name" placeholder="DBDT Wallet Address">
                  </div>
                  <div class="stk-pr-form-field">
                    <label>USDT Wallet address:</label>
                    <input type="text" name="name" placeholder="USDT Wallet Address">
                  </div>
                  <div class="stk-pr-form-field">
                    <div class="stk-pr-form-select">
                      <label>DBDT Quantity</label>
                      <select id="select1" name="select1">
                        <option value="First Choice">DBDT Quantity</option>
                        <option value="First Choice">1</option>
                        <option value="Second Choice">2</option>
                        <option value="Third Choice">3</option>
                        <option value="Third Choice">4</option>
                        <option value="Third Choice">5</option>
                        <option value="Third Choice">6</option>
                      </select>
                    </div>
                  </div>
                  <div class="stk-pr-form-field">
                    <label>Staking Period:</label>
                    <input type="text" name="name" placeholder="Staking Period">
                  </div>
                  <div class="stk-pr-form-field">
                    <label>Special Instruction (if any):</label>
                    <input type="text" name="name" placeholder="DBDT Special Instruction">
                  </div>
                  <div class="stk-pr-submit-btn">
                    <button type="submit" value="submit">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

      </div>

@endsection
