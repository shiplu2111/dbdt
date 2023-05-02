<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>


    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "9ced2c79-c968-43ec-aaf1-40d24f431a9d",
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <link rel="icon" type="image/x-icon" href="{{ URL::to('front/assets/images/logo.svg') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallbackuser">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::to('backuser/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- datatavles --}}
    <link rel="stylesheet" href="{{ URL::to('backuser/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ URL::to('backuser/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('backuser/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ URL::to('backuser/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::to('backuser/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ URL::to('backuser/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::to('backuser/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('backuser/plugins/toastr/toastr.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL::to('backuser/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ URL::to('backuser/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ URL::to('backuser/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Your adsance code -->
    <script data-ad-client="ca-pub-9804158421402971" async
        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9804158421402971"
        crossorigin="anonymous"></script>
    <!-- Your adsance code end -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!--Start of Tawk.to Script-->
   {{-- <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6253246ab0d10b6f3e6cb416/1g0acvbgv';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
	--}}
    <!--End of Tawk.to Script-->
    <style>
        .fingerprint-spinner,
        .fingerprint-spinner * {
            box-sizing: border-box;
        }

        .fingerprint-spinner {
            height: 64px;
            width: 64px;
            padding: 2px;
            overflow: hidden;
            position: relative;
        }

        .fingerprint-spinner .spinner-ring {
            position: absolute;
            border-radius: 50%;
            border: 2px solid transparent;
            border-top-color: #ff1d5e;
            animation: fingerprint-spinner-animation 1500ms cubic-bezier(0.680, -0.750, 0.265, 1.750) infinite forwards;
            margin: auto;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
        }

        .fingerprint-spinner .spinner-ring:nth-child(1) {
            height: calc(60px / 9 + 0 * 60px / 9);
            width: calc(60px / 9 + 0 * 60px / 9);
            animation-delay: calc(50ms * 1);
        }

        .fingerprint-spinner .spinner-ring:nth-child(2) {
            height: calc(60px / 9 + 1 * 60px / 9);
            width: calc(60px / 9 + 1 * 60px / 9);
            animation-delay: calc(50ms * 2);
        }

        .fingerprint-spinner .spinner-ring:nth-child(3) {
            height: calc(60px / 9 + 2 * 60px / 9);
            width: calc(60px / 9 + 2 * 60px / 9);
            animation-delay: calc(50ms * 3);
        }

        .fingerprint-spinner .spinner-ring:nth-child(4) {
            height: calc(60px / 9 + 3 * 60px / 9);
            width: calc(60px / 9 + 3 * 60px / 9);
            animation-delay: calc(50ms * 4);
        }

        .fingerprint-spinner .spinner-ring:nth-child(5) {
            height: calc(60px / 9 + 4 * 60px / 9);
            width: calc(60px / 9 + 4 * 60px / 9);
            animation-delay: calc(50ms * 5);
        }

        .fingerprint-spinner .spinner-ring:nth-child(6) {
            height: calc(60px / 9 + 5 * 60px / 9);
            width: calc(60px / 9 + 5 * 60px / 9);
            animation-delay: calc(50ms * 6);
        }

        .fingerprint-spinner .spinner-ring:nth-child(7) {
            height: calc(60px / 9 + 6 * 60px / 9);
            width: calc(60px / 9 + 6 * 60px / 9);
            animation-delay: calc(50ms * 7);
        }

        .fingerprint-spinner .spinner-ring:nth-child(8) {
            height: calc(60px / 9 + 7 * 60px / 9);
            width: calc(60px / 9 + 7 * 60px / 9);
            animation-delay: calc(50ms * 8);
        }

        .fingerprint-spinner .spinner-ring:nth-child(9) {
            height: calc(60px / 9 + 8 * 60px / 9);
            width: calc(60px / 9 + 8 * 60px / 9);
            animation-delay: calc(50ms * 9);
        }

        @keyframes fingerprint-spinner-animation {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="wrapper" id="app">

        <!-- Preloader
  <div class="preloader flex-column justify-content-center align-items-center">
            <div class="fingerprint-spinner">
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
            </div>
        </div>

   Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>


            </ul>
            <div id="content" class="navbar-nav ml-auto">

                <a href="#" class="nav-link " data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell"></i>

                    @if (count(auth()->user()->unreadNotifications))
                        <span
                            class="badge badge-danger navbar-badge">{{ count(auth()->user()->unreadNotifications) }}

                        </span>
                    @endif
                </a>



                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="max-height: 412px; overflow-x: hidden; overflow-y: scroll">

                    @forelse (auth()->user()->unreadNotifications as $item)
                        {{-- <li onclick="markNotiificationAsRead()"> --}}
                        <li style="background-color: #EFF4C3" onclick="add('{{ $item->id }}');">
                            <a href="{{ $item->data['user_data']['url'] }}" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">


                                    <div class="media-body">

                                        <p style="white-space: nowrap;  width: 200px;overflow: hidden;text-overflow: ellipsis; "
                                            class="text-sm"> {{ $item->data['user_data']['result'] }}

                                        </p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                            {{ $item->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                        </li>
                    @empty
                        <a href="#" class="dropdown-item">No Unread Notifications </a>
                    @endforelse

                    @foreach (auth()->user()->readNotifications as $items)
                        <li>
                            <a href="{{ $items->data['user_data']['url'] }}" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">


                                    <div class="media-body">

                                        <p style="white-space: nowrap;  width: 200px;overflow: hidden;text-overflow: ellipsis; "
                                            class="text-sm"> {{ $items->data['user_data']['result'] }}

                                        </p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                            {{ $items->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                        </li>
                    @endforeach

                </ul>


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </div>
        </nav>
        <!-- /.navbar -->
        <script>
            function add(id) {
                $.ajax({
                    url: '/markAsRead/' + id,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                })
            }
        </script>

        <script>
            setInterval(function() {
                $("#content").load(" #content")
            }, 30000);
        </script>
