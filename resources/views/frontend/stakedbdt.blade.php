@extends('frontend.layouts.master')
@section('content')
    <div>
      @if (session('status_ok'))
      <script>
       const Toast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      
      Toast.fire({
        icon: 'success',
        title: 'Staking activated.'
      })
       </script>
      @endif

      @if (session('status_denyed'))
      <script>
       const Toast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      
      Toast.fire({
        icon: 'error',
        title: 'Sorry you do not have sufficient balance.'
      })
       </script>
      @endif
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

                            <div class="stk-pr-form-wrp">
                                <form method="POST"  action="{{url('user/stack-dbdt-now')}}">
                                    @csrf
                                    <div class="stk-pr-form-field">
                                        <label>Name:</label>
                                        <input type="text" name="name" readonly value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="stk-pr-form-field">
                                        <label>Email:</label>
                                        <input type="email" name="email" readonly value="{{ Auth::user()->email }}">
                                    </div>
                                    <div class="stk-pr-form-field">
                                        <label>Contact No:</label>
                                        <input type="text" name="phone" placeholder="E.G +601X-XXXXXXX" required>
                                    </div>
                                    <div class="stk-pr-form-field">
                                        {{-- <label>DBDT Wallet address:</label> --}}
                                        <input type="hidden" name="dbdt_wallet_address" placeholder="DBDT Wallet Address" required>
                                    </div>
                                    <div class="stk-pr-form-field">
                                        {{-- <label>USDT Wallet address:</label> --}}
                                        <input type="hidden"  name="usdt_wallet_address" placeholder="USDT Wallet Address" required>
                                    </div>
                                    
                                    @php
                                        $stake_methods = DB::table('stake_methods')->where('status', 'Active')->orderBy('stake_order')->get();
                                    @endphp
                                    <div class="stk-pr-form-field">
                                        <div class="stk-pr-form-select">
                                            <label>Staking Period: </label>
                                            <select id="stake_method" name="stake_method" class="form-control">
                                                @foreach ($stake_methods as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="stk-pr-form-field">
                                        @php
                                        $quantity=DB::table('accounts')->where('user_id',Auth::user()->id )->first();
                                        @endphp
                                        <label>DBDT Quantity:</label>
                                         <input type="number" name="dbdt_amount" id="dbdt_amount" max="{{$quantity->repurchase_balance}}" placeholder="Your Maximum Staking DBDT Quantity ( {{$quantity->repurchase_balance}} )DBDT" required> 
                                    </div>

                                    <div class="stk-pr-form-field">
                                        <label>Special Instruction (if any):</label>
                                        <textarea name="instruction" id="instruction"
                                          style="width: 100%; border:1px solid#ddd; font-size: 16px; line-height: 1;"
                                            rows="10"></textarea>
                                    </div>
                                    <div class="stk-pr-submit-btn">
                                        <button class="float-right" type="submit" value="submit">Stack Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
   
    <script>
        $(document).ready(function () {
            $('#stake_method').on('change', function () {
                var methodId = this.value;
                $.ajax({
                    url: "{{url('getstackmethoddatabyid')}}",
                    type: "POST",
                    data: {
                        methodId: methodId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {

                             document.getElementById('dbdt_amount').min=result.min_amount;
                             document.getElementById('dbdt_amount').placeholder='Minimum Staking QUANTITY '+ result.min_amount + ' DBDT';
                            //   document.getElementById('dbdt_amount').value=result.id;
                        
                    }
                });
            });
            
        });
    </script>
@endsection
