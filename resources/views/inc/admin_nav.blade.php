<div class="aiz-topbar px-15px px-lg-25px d-flex align-items-stretch justify-content-between">
    <div class="d-flex">
        <div class="aiz-topbar-nav-toggler d-flex align-items-center justify-content-start mr-2 mr-md-3 ml-0" data-toggle="aiz-mobile-nav">
            <button class="aiz-mobile-toggler">
                <span></span>
            </button>
        </div>
        <div class="aiz-topbar-logo-wrap d-xl-none d-flex align-items-center justify-content-start">
            <a href="{{ route('home') }}" class="d-block">
            <img src="{{ static_asset('assets/img/smart-payroll.png') }}" class="brand-icon" alt="SmartPay">
            </a>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-stretch flex-grow-xl-1">
        <div class="d-none d-md-flex justify-content-around align-items-center align-items-stretch">
            <div class="d-none d-md-flex justify-content-around align-items-center align-items-stretch">
                <div class="aiz-topbar-item ml-2">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-soft-danger btn-sm d-flex align-items-center" href="{{ route('clear-cache') }}">
                            <i class="las la-hdd fs-20"></i>
                            <span class="fw-500 ml-1 mr-0 d-none d-md-block">Clear Cache</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-around align-items-center align-items-stretch">

            <div class="aiz-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="btn btn-icon p-0 d-flex justify-content-center align-items-center">
                            <span class="d-flex align-items-center position-relative">
                                <i class="las la-bell fs-24"></i>
                                    <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right"></span>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg py-0">
                        <div class="p-3 bg-light border-bottom">
                            <h6 class="mb-0">Notifications</h6>
                        </div>
                        <div class="px-3 c-scrollbar-light overflow-auto " style="max-height:300px;">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="py-4 text-center fs-16">
                                        No notification found
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center border-top">
                            <a href="{{ route('home') }}" class="text-reset d-block py-2">
                                View All Notifications
                            </a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="aiz-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow text-dark" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <span class="avatar avatar-sm mr-md-2">
                                <img
                                    src="{{ static_asset('assets/img/avatar-place.png') }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';"
                                >
                            </span>
                            <span class="d-none d-md-block">
                                <span class="d-block fw-500">{{Auth::user()->name}}</span>
                                <span class="d-block small opacity-60">{{Auth::user()->user_type}}</span>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-md">
                        <a href="{{ route('user.profile', Auth::user()->id) }}" class="dropdown-item">
                            <i class="las la-user-circle"></i>
                            <span>Profile</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="dropdown-item">
                            <i class="las la-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                        </form>
                    </div>
                </div>
            </div><!-- .aiz-topbar-item -->
        </div>
    </div>
</div><!-- .aiz-topbar -->
