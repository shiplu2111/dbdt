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

                <a href="{{ url('/user/profile') }}" class="d-block">{{ Auth::user()->name }}<span>
                        @if (Auth::user()->status == 0)
                            <i class="fas fa-frown"></i>
                    </span>
                @elseif (Auth::user()->status == 1)
                    <i class="fas fa-grin-hearts"></i></span>
                @elseif (Auth::user()->status == 2)
                    <i class="fas fa-sad-cry"></i></span>
                    @endif
                </a>
                @if ($user_account_details)
                    <span> <a href="#">{{ number_format($user_account_details->dbdt_balance, 2, '.', ',') }}
                            <small>DBDT</small></a></span>
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
                            Staking 
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a  class="nav-link" href="{{ url('/user/my-stack/list') }}" >
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Stacks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/stake-dbdt') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stake Now</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
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
                        </li> --}}
                    </ul>
                </li>


                <li class="nav-item ">
                    <a href="#" class="nav-link ">
						<i class="nav-icon fas fa-wallet"></i>
                       

                        <p>
                            Wallet
							
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/user/new-deposit') }}" class="nav-link ">

                                <i class="fas fa-plus-square nav-icon"></i>
                                <p>Add Deposit</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/user/new-swap') }}" class="nav-link ">

                                <i class="fas fa-retweet nav-icon"></i>
                                <p>Swap DBDT</p>
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a href="{{ url('/user/new-withdraw') }}" class="nav-link">

                                <i class="far fa-money-bill-alt nav-icon"></i>
                                <p>Withdraw Money</p>
                            </a>
                        </li>
                        

                        <li class="nav-item">
                            <a href="{{ url('/user/new-transfer') }}" class="nav-link ">

                                <i class="fas fa-exchange-alt nav-icon"></i>
                                <p>Transfer Money</p>
                            </a>
                        </li>

                        
                    </ul>
                </li>
				<li class="nav-item">
                    <a href="{{ url('/user/my-incomes') }}" class="nav-link">

                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>Income History</p>
                    </a>
                </li>
				<li class="nav-item ">
                    <a href="#" class="nav-link ">
						
                       <i class="nav-icon fas fa-history"></i>

                        <p>
                            Transaction History
							
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                       
                        <li class="nav-item">
                            <a href="{{ url('/user/all-deposit') }}" class="nav-link ">

                                <i class="fas fa-history nav-icon"></i>
                                <p>Deposit History</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ url('/user/all-withdraws') }}" class="nav-link">

                                <i class="fas fa-history nav-icon"></i>
                                <p>Withdraw History</p>
                            </a>
                        </li>

                        

                        <li class="nav-item">
                            <a href="{{ url('/user/all-transfers') }}" class="nav-link ">

                                <i class="fas fa-history nav-icon"></i>
                                <p>Transfer History</p>
                            </a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/user/received/transfers') }}" class="nav-link ">

                                <i class="fas fa-history nav-icon"></i>
                                <p>Received History</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                       
<i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Buy DBDT
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->status === '1')
                            <li class="nav-item">
                                <a href="{{ url('/user/upgrade-package') }}" class="nav-link ">
                                    <i class="fas fa-sort-amount-up nav-icon"></i>
                                    <p>Upgrade Packages</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/user/my-packages') }}" class="nav-link">
                             
									<i class="fas fa-suitcase-rolling nav-icon"></i>
                                    <p>My Package</p>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ url('/user/available-packages') }}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Available Packages</p>
                                </a>
                            </li>
						<li class="nav-item">
                                <a href="{{ url('/user/my-packages') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>My Package</p>
                                </a>
                            </li>
                        @endif





                    </ul>
                </li>
				
				       @php
                    $mastercard = DB::table('mastercards')
                        ->where('user_id', Auth::user()->id)
                        ->first();
                @endphp


<li class="nav-item ">
    <a href="#" class="nav-link ">
        <i class="nav-icon fa fa-credit-card"></i>

        <p>
            Mastercard
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">


        <li class="nav-item">
            @if ($mastercard)
                <a href="{{ url('/user/mastercard/details') }}" class="nav-link">
                @else
                    <a href="{{ url('/mastercard') }}" class="nav-link">
            @endif

            <i class="nav-icon fa fa-book"></i>
            <p>
                Mastercard Details
            </p>
            </a>
        </li>


    </ul>
</li>
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-users"></i>

                        <p>
                            My Team
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/user/downline/tree') }}" class="nav-link ">
                                <i class="fas fa-tree nav-icon"></i>
                                <p>Tree View</p>
                            </a>
                        </li>


                    </ul>
                </li>
               
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        
<i class="nav-icon fas fa-exchange-alt"></i>
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
                            <a  target="_blank" href="https://lz.finance/swap/token/0x02210CcF0Ed27a26977E85528312E5BD53cE9960/0x55d398326f99059fF775485246999027B3197955" class="nav-link ">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Buy</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a target="_blank" href="https://lz.finance/swap/token/0x02210CcF0Ed27a26977E85528312E5BD53cE9960/0x55d398326f99059fF775485246999027B3197955" class="nav-link ">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Sell</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/user/payment/setting') }}" class="nav-link">
                        
						<i class="nav-icon fas fa-money-bill"></i>
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
                                <p>Security</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/user/profile/update') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            @if(Auth::user()->id_verify_status==1)
                            <a  class="nav-link toastrDefaultError3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>KYC Verification</p>
                            </a>
                            @else
                            <a href="{{ url('/user/identity-document/') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>KYC Verification</p>
                            </a>
                            @endif
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

    $('.toastrDefaultError3').click(function() {
    


Swal.fire({
    
  title: 'Great Job!',
  icon: 'warning',
  text: 'You are already identity verified!',
//   text: "You won't be able to revert this!",
  showClass: {
    popup: 'animate__animated animate__fadeInDown'
  },
  hideClass: {
    popup: 'animate__animated animate__fadeOutUp'
  },
//   showConfirmButton: false,
  timer: 3000
})

});
</script>
