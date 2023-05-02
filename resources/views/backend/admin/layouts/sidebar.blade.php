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


                    @if(Auth::user()->profile_photo_path)
                        <img  id="preview-image-before-upload1" style="height: 50px; width: 50px" src="{{ URL::to('/') }}/{{ Auth::user()->profile_photo_path}}"
                            class="img-circle elevation-2" alt="DBDT">
                    @else
                        <img style="height: 50px; width: 50px" src="https://media.istockphoto.com/vectors/vector-businessman-black-silhouette-isolated-vector-id610003972?k=20&m=610003972&s=612x612&w=0&h=-Nftbu4sDVavoJTq5REPpPpV-kXH9hXXE3xg_D3ViKE=" class="img-circle elevation-2"
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
                            Wallet
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/admin/all-deposit') }}" class="nav-link">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Deposit History</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/package/deposit/pending') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending Approval</p>
                            </a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/admin/package-upgrade/deposit/pending') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending Upgrades</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/withdraw/list') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Withdraw History</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/add-credit') }}" class="nav-link ">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Credit History</p>
                            </a>
                        </li>

                    </ul>
                </li>
				 <li class="nav-item">
                    <a href="{{ url('/admin/user-incomes') }}" class="nav-link">

                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>Income History</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>

                        <p>
                            KYC 
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/admin/all/kyc/request') }}" class="nav-link ">

                                <i class="far fa-circle nav-icon"></i>
                                <p>All KYC Requests</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="{{ url('/admin/pending/kyc/request') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending KYC Requests</p>
                            </a>
                        </li> 


                    </ul>
                </li>

				<li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>

                        <p>
                            Mastercard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/admin/mastercard/applications') }}" class="nav-link ">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Applications</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ url('/admin/package/deposit/pending') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Package Pending Deposit</p>
                            </a>
                        </li> --}}


                    </ul>
                </li>
				
				<li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>

                        <p>
                            Staking
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                         <li class="nav-item">
                            <a href="{{ url('/admin/stakes') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stakes</p>
                            </a>
                        </li> 


                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>

                        <p>
                            Report
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                         <li class="nav-item">
                            <a href="{{ url('/admin/package-sales-report') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sales Report</p>
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
                            <a href="{{ url('/admin/website/setting') }}" class="nav-link ">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Website Setting</p>
                            </a>
                        </li>
						
                        <li class="nav-item">
                            <a href="{{ url('/admin/withdraw/setting') }}" class="nav-link ">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Withdraw Setting</p>
                            </a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/admin/deposit/method/setting') }}" class="nav-link ">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Deposit Setting</p>
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Fees Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/stake/method/setting') }}" class="nav-link ">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Stake Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/commision/setting') }}" class="nav-link ">

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
                                <p>Email Gateway</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">

                                <i class="far fa-circle nav-icon"></i>
                                <p>SMS Gateway</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link toastrDefaultError1">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Email Gateway</p>
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

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>

                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/admin/active-user-list') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/inactive-user-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/banned-user-list') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banned Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/user-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Users</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>

                        <p>
                            Packages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/admin/packages') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Packages Lists</p>
                            </a>
                        </li>
                       
                        


                    </ul>
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
                                <p>Security</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/user/profile/update') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile Update</p>
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
