<header class="main-header header-shaddow">
    <div class="container-fluid">
        <!-- Main box -->
        <div class="main-box">
            <!--Nav Outer -->
            <div class="nav-outer">
                <div class="logo-box">
                    <div class="logo"><a href=""><img src="{{ asset('images/logo_ubwork.png') }}"
                                alt="" title=""></a></div>
                </div>

                <nav class="nav main-menu">
                    <ul class="navigation" id="navbar">

                        <!-- Only for Mobile View -->
                        <li class="mm-add-listing">

                        </li>
                    </ul>
                </nav>
                <!-- Main Menu End-->
            </div>
            <div class="outer-box">
                <div class="menu-btn rounded-pill p-2" style="font-size: 18px" >
                     <i class="icon la la-coins" ></i> 
                     {{-- {{auth('company')->user()->coin}} --}}
                </div>
                <!-- Dashboard Option -->
                <div class="dropdown dashboard-option">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                        @if(auth('company')->user()->logo == null || empty(auth('company')->user()->logo))
                            <img style="object-fit: cover;" src="{{  asset('assets/admin-bower/dist/img/avatar.png') }}" alt="avatar"
                                    class="thumb">
                        @else
                            @php
                                $pattern = "/(http(s?):)/";
                                $m = preg_match($pattern,auth('company')->user()->logo);
                            @endphp
                            @if($m)
                                <img style="object-fit: cover;" src="{{  auth('company')->user()->logo }}" alt="logo"
                                    class="thumb">
                            @elseif(Storage::exists(auth('company')->user()->logo) )
                                <img style="object-fit: cover;" src="{{ asset('storage/images/'. auth('company')->user()->logo) }}" alt="logo"
                                    class="thumb">
                            @else
                                <img style="object-fit: cover;" src="{{  asset('assets/admin-bower/dist/img/avatar.png') }}" alt="avatar"
                                        class="thumb">
                            @endif
                        @endif
                        <span class="name">{{ auth('company')->user()->company_name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href=""><i class="fa fa-cube"></i>Gói dịch vụ</a></li>
                        <li><a href="{{route('company.logout')}}"><i class="la la-sign-out"></i>Đăng xuất</a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="logo"><a href=""><img src="{{ asset('images/logo_ubwork.png') }}"
                    alt="" title=""></a></div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">

            <div class="outer-box">
                <!-- Login/Register -->
                <div class="login-box">
                    <a href="login-popup.html" class="call-modal"><span class="icon-user"></span></a>
                </div>

                <button id="toggle-user-sidebar">
                 
                </button>
                <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span
                        class="flaticon-menu-1"></span></a>
            </div>
        </div>

    </div>

    <!-- Mobile Nav -->
    <div id="nav-mobile"></div>
</header>
