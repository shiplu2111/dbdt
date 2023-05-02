<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin/dashboard') }}" class="brand-link">
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
                        <img style="height: 40px; width: 40px;" src="{{ Auth::user()->profile_photo_url }}"
                            class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                    @else
                        <img src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="{{ Auth::user()->name }}">

                    @endif
                </a>
            </div>
            <div class="info">

                <a href="{{ url('/user/profile') }}" class="d-block">{{ Auth::user()->name }}</a>

                </ul>


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
                    <a href="{{ url('/admin/dashboard') }}" class="nav-link">
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
                            Finance
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Deposit List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/package/deposit/pending') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Package Pending Deposit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Withdraw List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Credit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Credit List</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>

                        <p>
                            Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Website Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Fees Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Commision Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Email & SMS Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Email Getway</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">

                                <i class="far fa-circle nav-icon"></i>
                                <p>SMS Getway</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Email Getway</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/methods') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Payment Methods</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>

                        <p>
                            Admin
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/admin/admin-add') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/admin-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admin List</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/user-list') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/packages') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Packages
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ url('/admin/mail-box') }}" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>

                        <p>
                            Mailbox
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
    $('.toastrDefaultError1').click(function() {
        toastr.error('This module in under construction')
    });
</script>
