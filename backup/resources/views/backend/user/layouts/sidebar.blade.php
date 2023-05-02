@php
$user_account_details = DB::table('accounts')
    ->where('user_id', Auth::user()->id)
    ->first();
$myrefferedusers = DB::table('users')
    ->where('sponcerid', Auth::user()->myrefferalcode)
    ->where('status', '1')
    ->count();
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/dashboard') }}" class="brand-link">
        <img src="{{ URL::to('front/assets/images/logo.svg') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Digital BDT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a href="{{ url('/user/profile') }}">


                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img style="height: 50px; width: 50px" src="{{ Auth::user()->profile_photo_url }}"
                            class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                    @else
                        <img src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="{{ Auth::user()->name }}">

                    @endif
                </a>

            </div>
            <div class="info">

                <a href="{{ url('/user/profile') }}" class="d-block">{{ Auth::user()->name }}<span>
                        @if (Auth::user()->status == 0)
                            <i class="fas fa-frown"></i>
                    </span>
                @elseif (Auth::user()->status==1)
                    <i class="fas fa-grin-hearts"></i></span>
                @elseif (Auth::user()->status==2)
                    <i class="fas fa-sad-cry"></i></span>
                    @endif
                </a>
                @if ($user_account_details)


                <span> <a href="#"> {{ $user_account_details->dbdt_balance }}.00 <small>DBDT</small></a></span>
                @else
                <span> <a href="#"> 0.00 <small>DBDT</small></a></span>

                @endif
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                {{-- <li class="nav-item menu-open"> --}}


                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>


                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>

                        <p>
                            Account
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Payout</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Commission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Team Bonus</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>My Generation</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>My Payment Method</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>My Level Info</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Transactions</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>

                        <p>
                            Finance
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Deposit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Deposit List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Withdraw Money</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Withdraw List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Transfer Amount</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Transfer List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>

                        <p>
                            Package
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/user/available-packages') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Available Packages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/user/my-packages') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Package List</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>

                        <p>
                            Exchange
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Currency List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Buy</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError2">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Sell</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/user/payment/setting') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Payment Setting
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Profile
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/user/profile') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </li>






            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<script>
    $('.toastrDefaultError2').click(function() {
        toastr.error('This module in under construction')
    });
</script>
