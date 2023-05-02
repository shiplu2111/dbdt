<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <link rel="stylesheet" href="{{ URL::to('front/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('front/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('front/assets/fonts/font-awesome/font-awesome.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::to('front/assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('front/assets/slick.slider/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('front/assets/slick.slider/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('front/assets/fonts/custom-fonts.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('front/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('front/assets/css/responsive.css') }}">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div id="app">
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header-inr clearfix">
                            <div class="hdr-lft clearfix">
                                <div class="logo">
                                    <a href="{{ url('/') }}"><img src="{{ URL::to('front/assets/images/logo.svg') }}"></a>
                                </div>
                                <h1>DBDT<span>Future digital asset</span></h1>
                            </div>
                            <div class="hdr-rgt">
                                <div class="xs-hambergar show-md">
                                    <div class="hambergar-icon">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                                <nav class="main-nav">
                                    <ul class="clearfix reset-list">
                                        <li class="current-menu-item">
                                            <a href="{{ url('/') }}">Home</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/buy-dbdt') }}">
                                                BUY DBDT
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/stake-dbdt') }}">
                                                STAKE DBDT
                                            </a>
                                        </li>
                                        {{-- <li class="menu-item-has-children">
                                            <a href="#">STAKE DBDT</a>
                                            <ul class="sub-menu reset-list">
                                                <li>
                                                    <a href="{{ url('/stake-dbdt') }}">3 months (5-6% per annum)
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/stake-dbdt') }}">6 months (6-8% per annum)
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/stake-dbdt') }}">1 Year ( 8-12% per annum)
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/stake-dbdt') }}">2 Years (12-18% per annum)
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/stake-dbdt') }}">3 Years (18-24% per annum)
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/stake-dbdt') }}">5 years (24-36% per annum)
                                                    </a>
                                                </li>
                                            </ul>
                                        </li> --}}


                                        <li><a href="https://bscscan.com/address/0x02210ccf0ed27a26977e85528312e5bd53ce9960"
                                                target="_blank">EXPLORER</a></li>
                                        <li>
                                            <a href="{{ url('/mastercard') }}">MASTERCARD</a>
                                        </li>

                                        <li class="menu-item-has-children">
                                            <a href="#"><i class="far fa-user"></i></a>
                                            <ul class="sub-menu reset-list">
                                                @guest
                                                @if (Route::has('register'))
                                                <li>
                                                    <a href="{{ url('/login') }}">Login</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/register') }}">Register</a>
                                                </li>
                                                @endif
                                                @else
                                                <li>
                                                    <a href="{{ url('/login') }}">
                                                        Dashboard
                                                    </a>
                                                </li>
                                                @endguest

                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
