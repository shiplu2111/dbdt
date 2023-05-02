<style>
  <b:if cond='data:blog.pageType == &quot;item&quot;'>
<style type='text/css'>
/*<![CDATA[*/
@font-face{font-family:"fontfutura";src:url("https://fonts.googleapis.com/css?family=Open+Sans") format("ttf");font-weight:normal;font-style:normal;}
a.btn-google{color:#fff}
.btn{padding:10px 16px;margin:5px;font-size:18px;line-height:1.3333333;border-radius:6px;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;border:1px solid transparent;font-weight:500;text-decoration:none;display:inline-block}
.btn:active:focus,.btn:focus{outline:0}
.btn:focus,.btn:hover{color:#333;text-decoration:none;outline:0}
.btn:active{outline:0;-webkit-box-shadow:inset 0 3px 5px rgba(0,0,0,.125);box-shadow:inset 0 3px 5px rgba(0,0,0,.125)}
.btn-google{color:#fff;background-color:#111;border-color:#000;padding:15px 16px 5px 40px;position:relative;font-family:fontfutura;font-weight:600}
.btn-google:focus{color:#fff;background-color:#555;border-color:#000}
.btn-google:active,.btn-google:hover{color:#fff;background-color:#555;border-color:#000;}
.btn-google:before{content:"";background-image:url(https://4.bp.blogspot.com/-52U3eP2JDM4/WSkIT1vbUxI/AAAAAAAArQA/iF1BeARv2To-2FGQU7V6UbNPivuv_lccACLcB/s30/nexus2cee_ic_launcher_play_store_new-1.png);background-size:cover;background-repeat:no-repeat;width:30px;height:30px;position:absolute;left:6px;top:50%;margin-top:-15px}
.btn-google:after{content:"GET IT ON";position:absolute;top:5px;left:40px;font-size:10px;font-weight:400;}
/*]]>*/
</style>
</b:if>
</style>

<style>
  <b:if cond='data:blog.pageType == &quot;item&quot;'>
<style type='text/css'>
/*<![CDATA[*/
@font-face{font-family:"fontfutura";src:url("https://fonts.googleapis.com/css?family=Open+Sans") format("ttf");font-weight:normal;font-style:normal;}
a.btn-apple{color:#fff}
.btn{padding:10px 16px;margin:5px;font-size:18px;line-height:1.3333333;border-radius:6px;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;border:1px solid transparent;font-weight:500;text-decoration:none;display:inline-block}
.btn:active:focus,.btn:focus{outline:0}
.btn:focus,.btn:hover{color:#333;text-decoration:none;outline:0}
.btn:active{outline:0;-webkit-box-shadow:inset 0 3px 5px rgba(0,0,0,.125);box-shadow:inset 0 3px 5px rgba(0,0,0,.125)}
.btn-apple{color:#fff;background-color:#111;border-color:#000;padding:15px 16px 5px 40px;position:relative;font-family:fontfutura;font-weight:600}
.btn-apple:focus{color:#fff;background-color:#555;border-color:#000}
.btn-apple:active,.btn-apple:hover{color:#fff;background-color:#555;border-color:#000;}
.btn-apple:before{content:"";background-image:url(https://th.bing.com/th/id/R.42e914ec69f14c033950263c15a37aa0?rik=53PSIWfLLSETbQ&riu=http%3a%2f%2fwww.clipartbest.com%2fcliparts%2fxcg%2fKK4%2fxcgKK4qki.jpeg&ehk=jgRGPCurLOSdaNkNNGlaZayszreRtz1MZi1%2bn9lySAE%3d&risl=&pid=ImgRaw&r=0);background-size:cover;background-repeat:no-repeat;width:30px;height:30px;position:absolute;left:6px;top:50%;margin-top:-15px}
.btn-apple:after{content:"Download On The";position:absolute;top:5px;left:40px;font-size:10px;font-weight:400;}
/*]]>*/
</style>
</b:if>
</style>

@php
    $footer_details = DB::table('settings')->latest()->first();
@endphp
<footer class="footer-wrp">
    <div class="footer-top">
      <div class="container-lg">
        <div class="row">
          <div class="col-sm-12">
              <div class="ftr-col-main clearfix">
                <div class="ftr-col ftr-col-1">
                  <div class="ftr-col-1-cntlr">
                  <div class="ftr-logo clearfix">
                    @if($footer_details)
                      <a href="{{ url('/') }}"><img src="{{ URL::to('/') }}/{{$footer_details->website_logo_path }}"></a>
                    @endif
                      <h1>@if($footer_details)
					  {{$footer_details->website_name}}
					  @endif<span>@if($footer_details)
					  {{$footer_details->website_slogan}}
					  @endif</span></h1>
                   </div>
                  <p>
					  @if($footer_details)
					  {{$footer_details->website_footer_text}}
					  @endif
					  </p>

                  </div>
                </div>
                <div class="ftr-col ftr-col-2">
                  <h6 class="ftr-col-title">Services</h6>
                  <ul class="clearfix reset-list">
                    <li><a href="https://www.bitscash.io/register?inviter=pintarman">Wallet and transactions</a></li>
                    <li><a href="https://digitalbdt.org/register?ref=dbdtazmi">Remitances Services</a></li>
                    <li><a href="https://www.digitalbdt.org/stake-dbdt">Stacking opportunities</a></li>
                    <li><a href="https://www.digitalbdt.org/mastercard">DBDT Mastercard</a></li>
                  </ul>
                </div>
                <div class="ftr-col ftr-col-3">
                  <h6 class="ftr-col-title">Resources</h6>
                  <ul class="clearfix reset-list">
                    <li><a href="https://bscscan.com/address/0x02210ccf0ed27a26977e85528312e5bd53ce9960#code">Source Code</a></li>
                  <li><a href="https://bscscan.com/token/0x02210ccf0ed27a26977e85528312e5bd53ce9960">Explorer</a></li>
                    <li><a href="https://blog.digitalbdt.org/marketing-plan/">Marketing Plan</a></li>
					  <li><a href="{{ URL::to('/dbdt_whitepaper.pdf') }}">Whitepaper</a></li>
                  </ul>
                
                </div>
                <div class="ftr-col ftr-col-4">
                  <h6 class="ftr-col-title">Contact</h6>
                  <ul class="clearfix reset-list">
                    <li> <a href="{{ url('/contact') }}">Contact Us</a></li>
                    <li><a href="https://nomics.com/assets/dbdt-digital-bdt">Nomics</a></li>            
					  <li><a href="https://coinsgem.com/token/0x02210ccf0ed27a26977e85528312e5bd53ce9960">CoinsGem</a></li>

                  <li><a href="https://coinranking.com/coin/RMh4poNLN+digitalbdt-dbdt">CoinRanking</a></li>
               {{--    <li><a href="https://thebittimes.com/token-DBDT-BSC-0x02210CcF0Ed27a26977E85528312E5BD53cE9960.html">TheBitTimes</a></li>--}}
                  </ul>
                  <div class="ftr-col-socail-icon">
                    <ul class="clearfix reset-list">
                        <li><a href="https://www.facebook.com/groups/582523892834887/"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com/dbdtofficial"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UCmKxzM_AgO0CGMEXpQANIcg"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="https://t.me/digitalbdtofficial"><i class="fa fa-paper-plane" aria-hidden="true"></i></a></li>
                      </ul>
                     
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-btm">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="footer-btm-wrp clearfix">
              <div class="footer-btm-lft"> 
                <p> @if($footer_details)
					  {{$footer_details->website_copy_write}}
					  @endif</p>
              </div>
              <div > 
            <div  style="float: right;"> <a class="btn btn-apple" href="https://apps.apple.com/app/id1618267559" title="Google Play">App Store</a>
				<span><a style="width:160px" class="btn btn-google" href="https://play.google.com/store/apps/details?id=com.digitalbdt.org" title="Google Play">Google Play</a></span></div>

                
              </div>
         

            </div>
            
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>
  </footer>
</div>
<script src="{{ mix('js/app.js') }}" defer></script>

  <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
  <script src="https://code.jquery.com/jquery-migrate-3.0.0.js"></script>
  <script src="{{ URL::to('front/assets/js/popper.min.js') }}"></script>
  <script src="{{ URL::to('front/assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::to('front/assets/js/bootstrap-select.min.js') }}"></script>
  <script src="{{ URL::to('front/assets/js/ie10-viewport-bug-workaround.js') }}"></script>
  <script src="{{ URL::to('front/assets/slick.slider/slick.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBo2-QJ7RdCkLw3NFZEu71mEKJ_8LczG-c"></script>
  <script src="{{ URL::to('front/assets/js/jquery.matchHeight-min.js') }}"></script>
  <script src="{{ URL::to('front/assets/js/app.js') }}"></script>
  <script src="{{ URL::to('front/assets/js/wow.min.js') }}"></script>
  <script src="{{ URL::to('front/assets/js/main.js') }}"></script>
  <script src="https://widget.nomics.com/embed.js"></script>
  </body>
  </html>
