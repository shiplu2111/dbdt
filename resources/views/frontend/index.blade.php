@extends('frontend.layouts.master')
@section('content')
  {{-- @if (session())
  <script>
Swal.fire({
  // title: 'Important Notice!',
  text: 'Your cooperation and understanding are highly appreciated. Thank you.',
  imageUrl: 'https://digitalbdt.org/Service.png',
  imageWidth: 400,
  imageHeight: 200,
  imageAlt: 'Custom image',
})
   </script>
   
  @endif --}}

@if(session()->has('jsAlert'))
    <script>
       Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Your registration has been sucessfully done. Wait for our review. Thank You',
  showConfirmButton: false,
  timer: 3000
})
    </script>
@endif
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6253246ab0d10b6f3e6cb416/1g0acvbgv';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section class="hm-banner-sec-wrp">
    <div class="hm-banner-bg-cntlr">
      <div class="hm-angle-bg" style="background: url(front/assets//images/hm-banner-agnle-bg.png);">
      </div>
      <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="hm-banner-wrp clearfix">
                <div class="hm-banner-img order-2">
                  <img src="front/assets//images/hm-banner-img-new.png">
                </div>
                <div class="hm-banner-dsc order-1">
                  <h6 class="welcome-dsc-title">Digital Blockchain Dominance Token</h6>
                  <p>Digital BDT or DBDT (Digital Blockchain Dominance Token) designed for crypto lovers and remittance service users. This token is backed by a professional’s teams and financial advisors. In future it will integrate with Mastercard & Visa Card for other online and offline services globally where visa and master accepted.</p>
                  <p>You can send remittance peer to peer (P2P) and wallet to wallet with very low transaction fees. The remittance service will execute in a second and the receiver will receive it instantly. We are not using any middleman or other third party to handle these transactions. The sender and receiver can perform by themselves.</p>The official Pre ICO launching date 15 January 2022 and ICO will start on 15 April 2022 until 14 July 2022. We have already listed DBDT in 10 global exchanges including PancakeSwap, LaunchZone, 1inch, Mdex, BitsCash, ApeSwap, BSCswap, BSCstationSwap, CheeseSwap, BiSwap. DBDT already open for public trade from 15 July 2022.</p>DBDT Total Supply: 10 Trillion and Circulating Maximum Supply 100 Billion which is 1% of total token. The balance 99% token will hold by DBDT Foundation. It will be a stable token like USDT, BUSD, USDC & DAI. Our goal to make 1.00 DBDT= 1.00 USD</p>
                </div>
              </div>
              
              <div class="nomics-ticker-widget" data-name="Digital BDT" data-base="DBDT" data-quote="USD"></div>
              
            
            
            </div>

          </div>
      </div>
    </div>
  </section>


  <section class="hm-dfp-module-sec-wrp">
    <div class="hm-dfp-module-bg inline-bg" style="background: url(front/assets//images/hm-dfp-module-bg.svg);">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="hm-dfp-module-wrp clearfix">
            <div class="hm-dfp-module-lft-img">
              <img src="front/assets//images/hm-dfp-module-img-1.png">
            </div>
            <div class="hm-dfp-module-rgt-dsc">
              <h5 class="hm-dfp-module-dsc-title-1">DBDT Open Source Blockchain , No Central Authority</h5>
              <h2 class="hm-dfp-module-dsc-title-2">DBDT Open Source Blockchain, <br> No Central Authority</h2>
              <p>DBDT’s open-source project does not depend on any central authority and all transactions are conducted entirely in the blockchain.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="hm-dfp-module-sec-wrp hm-dfp-module-lft-dsc-sec">
    <div class="hm-dfp-module-bg inline-bg" style="background: url(front/assets//images/hm-dfp-module-bg-2.svg);">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="hm-dfp-module-wrp clearfix">
            <div class="hm-dfp-module-lft-img order-2">
              <img src="front/assets//images/hm-dfp-module-img-2.jpg">
            </div>
            <div class="hm-dfp-module-rgt-dsc order-1">
              <h6 class="hm-dfp-module-dsc-title-1">Crypto Wallet</h6>
              <h2 class="hm-dfp-module-dsc-title-2">World ClassMulti Security</h2>
				<p>When it comes to ensuring that your crypto front assets are secure, we think about everydetail, so you don’t have to worry about your digital front assets. DBDT support all BSC wallet like Bitscash Exchange Wallet, Trust Wallet, Metamask, Binance Chain Wallet etc.<p style="word-wrap:break-word">DBDT Smart Contract: 0x02210ccf0ed27a26977e85528312e5bd53ce9960</p>
               
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

 {{-- <div  style=" position:fixed; top:40%; right: 0%; z-index: 100;">
  <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg"><img class="responsive" width="150" height="80"" src="{{ URL::to('c.png') }}"></a>

</div> --}}


  <section class="low-fees-module-sec-wrp">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="low-fees-module-wrp clearfix">
            <div class="low-fees-module-img">
              <img src="front/assets//images/payment0125.png">
            </div>
            <div class="low-fees-module-dsc">
              <ul class="clearfix reset-list">
                <li>
                  <div class="low-fees-module-dsc-item">
                    <h4 class="low-fees-module-dsc-title"><i><img src="front/assets//images/low-fees-module-dsc-icon-1.png"></i> Low-fees</h4>
                    <p>DBDT promises a secure transaction within a low cost transaction fee. Thinking for transaction cost is not a job anymore</p>
                  </div>
                </li>
                <li>
                  <div class="low-fees-module-dsc-item">
                    <h4 class="low-fees-module-dsc-title"><i><img src="front/assets//images/low-fees-module-dsc-icon-2.png"></i> Fast transaction</h4>
                    <p>When it comes to DBDT, we always care for your time. We never keep you await, DBDT transactions are super fast!</p>
                  </div>
                </li>
                <li>
                  <div class="low-fees-module-dsc-item">
                    <h4 class="low-fees-module-dsc-title"><i><img src="front/assets//images/low-fees-module-dsc-icon-3.png"></i>Secure wallet</h4>
                    <p>It is a user-friendly system yet too powerful to be hacked. Just as any regular wallet or software that you use as a daily driver for your transactions.</p>
                  </div>
                </li>
                <li>
                  <div class="low-fees-module-dsc-item">
                    <h4 class="low-fees-module-dsc-title"><i><img src="front/assets//images/low-fees-module-dsc-icon-4.png"></i> Latest blockchain</h4>
                    <p>Advanced user data protection, community governance, PoS consensus algorithm, and multi-purpose Masternodes under BSC network.</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="welcome-dsc-sec-wrp">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="welcome-dsc-wrp">
            <h2 class="welcome-dsc-title">WELCOME TO OUR DBDT FAMILY</h2>
            <span>This is our future, join DBDT Global Community & become global citizen.</span>
            <a href="https://www.facebook.com/groups/582523892834887/">Know More</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="our-project-sec-wrp">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="our-project-wrp">
            <div class="our-project-head text-center">
              <h2 class="our-project-head-title">OUR CORE PROJECTS</h2>
              <span>DBDT Token , Remittance Services & MasterCard</span>
            </div>
            <div class="our-project-grid-innr">
              <ul class="reset-list clearfix">
                <li>
                  <div class="our-project-grid mHc">
                    <span><img src="front/assets//images/hm-service-icon-4.png"></span>
                    <h5>DBDT TOKEN</h5>
                    <p>Digital BDT or DBDT (Digital Blockchain Dominance Token) currently on BSC Network BEP20 and TRC20 , ERC20 under development which will be available by the year 2022.</p>
                  </div>
                </li>
                <li>
                  <div class="our-project-grid mHc">
                    <span><img src="front/assets//images/logo.svg"></span>
                    <h5>Remittance Services</h5>
                    <p>DBDT Remittance Services will launch in the first quarter of 2022.This service is for all the peopple who want to send or receive money from friends , family members or buniness partners globally.</p>
                  </div>
                </li>
                <li>
                  <div class="our-project-grid mHc">
                    <span><img src="front/assets//images/mastercard.png"></span>
                    <h5>DBDT Mastercard</h5>
                    <p>DBDT Mpay Mastercard initially operate under MasterCard network and in future DBDT will build own network to perform all the transaction globally. Join today & be part of our family.</p>
                  </div>
                </li>
              </ul>
            </div>
            <div class="our-project-grid-btn">
              <a href="https://www.digitalbdt.org/register">Buy DBDT Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <section class="get-started-sec-wrp">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="get-started-wrp clearfix">
            <div class="get-started-img">
              <h2 class="get-started-title">Get started</h2>
              <img src="front/assets//images/get-started-img.svg">
            </div>
            <div class="get-started-dsc">
              <ul class="clearfix reset-list">
                  <li><i><img src="front/assets//images/get-icon-1.png"></i>Create a DBDT wallet</li>
                <li><i><img src="front/assets//images/get-icon-2.png"></i>Add DBDT to wallet</li>
                <li><i><img src="front/assets//images/get-icon-3.png"></i>Mining/Stacking/Trading</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="hm-service-sec-wrp">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="hm-service-wrp clearfix">
            <div class="hm-service-head">
              <h2 class="hm-service-head-title">How to Get/Buy DBDT</h2>
            </div>
            <div class="hm-service-item-innr clearfix">
              <ul class="clearfix reset-list">
                <li>
                  <div class="hm-service-item">
                    <i class="mHc"><img src="front/assets//images/hm-service-icon-1.png"></i>
                    <h3 class="hm-service-item-title">Exchange</h3>
                    <p>Buying DBDT is getting easier, You can buy DBDT through cryptocurrency exchanges.</p>
                  </div>
                </li>
                <li>
                  <div class="hm-service-item">
                    <i class="mHc"><img src="front/assets//images/hm-service-icon-2.png"></i>
                    <h3 class="hm-service-item-title">DBDT Community</h3>
                    <p>You can buy, send or receive DBDT to friends and family worldwide in a second & our transcation fees are very low less than 50 cents .</p>
                  </div>
                </li>
                <li>
                  <div class="hm-service-item">
                    <i class="mHc"><img src="front/assets//images/hm-service-icon-4.png"></i>
                    <h3 class="hm-service-item-title">DBDT Website</h3>
                    <p>You can buy DBDT @ 0.01 USD from our official website and refer to your friends & earn 100 $ to 500 $ weekly. Package available USD 50, 100, 300, 500, 1000 & 5000.</p>
                  </div>
                </li>
              </ul>
            </div>
            <div class="hm-service-item-button">
              <a href="https://www.digitalbdt.org/register">Buy Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        {{-- <div class="modal-header">
          <h4 class="modal-title">Large Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div> --}}
        <div class="modal-body">
          Free 100000 DBDT coin 🪙😍😍😍 oh my god, you also can be winner 🏆 try it fast and share this news to your friends!!
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a href="https://www.coinscope.co/coin/dbdt/airdrop" target="_blank" class="btn btn-sm btn-outline-primary">Try It Now</a>
        </div>
      </div>
      <!-- /.modal-content -->
    
    <!-- /.modal-dialog -->
  </div>
</div>
@endsection
