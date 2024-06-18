<header class="main-header">

    <!-- Main box -->
    <div class="main-box">
        <!--Nav Outer -->
        <div class="nav-outer">
            <div class="logo-box">
                {{-- <div class="logo"><a href="/"><img src="{{ asset('images/logo_ubwork.png') }}" alt="" --}}
                    <div class="logo" style="margin: 0 50px;"><a href="{{route('index')}}">
                        <img src="{{ asset('images/logo_bakhoi.png') }}" alt=""
                            title="" ></a></div>
            </div>

            <nav class="nav main-menu">
                <ul class="navigation" id="navbar" style="margin-bottom: 0">
                    <li class="current dropdown">
                        {{-- <span>Home</span> --}}
                        <a href="{{route('index')}}">Trang chủ</a>
                    </li>

                    <li class="dropdown">
                        <a href="{{route('job-list')}}">Việc làm</a>
                        {{-- <ul>
                            <li class="dropdown">
                                <span>Chuyên ngành</span>
                                <ul>
                                    <!-- @foreach ($maJor as $item)
                                        <li><a
                                                href="{{ route('job-cat', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                        </li>
                                    @endforeach -->
                                </ul>
                            </li>
                        </ul> --}}
                    </li>
                    {{-- <li class="dropdown">
                        @if (auth('candidate')->check())
                            @if (count(auth('candidate')->user()->seekerProfile()->where('is_clone', 0)->get())>0)
                                <a href="{{route('profile')}}" >Quản lý CV</a>
                            @else
                                <a href="#" id="quanlycv">Quản lý CV</a>
                            @endif
                        @else
                            <a href="{{route('login')}}">Quản lý CV</a>
                        @endif
                        
                    </li> --}}
                    <li class="dropdown">
                        <a href="{{route('company-list')}}">Công ty</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{route('contact')}}">Liên hệ</a>
                    </li>
                    {{-- <li class="dropdown">
                        <a href="{{route('logout')}}">Đăng xuất</a>
                    </li> --}}
                    <!-- Only for Mobile View -->
                    <li class="mm-add-listing">
                        <a href="add-listing.html" class="theme-btn btn-style-one">Job Post</a>
                        <span>
                            <span class="contact-info">
                                <span class="phone-num"><span>Call us</span><a
                                        href="tel:1234567890">0395167635</a></span>
                                <span class="address">Trịnh Văn Bô <br>3051,
                                    Australia.</span>
                                <a href="" class="email">datmv202@gmail.com</a>
                            </span>
                            <span class="social-links">
                                <a href="#"><span class="fab fa-facebook-f"></span></a>
                                <a href="#"><span class="fab fa-twitter"></span></a>
                                <a href="#"><span class="fab fa-instagram"></span></a>
                                <a href="#"><span class="fab fa-linkedin-in"></span></a>
                            </span>
                        </span>
                    </li>
                </ul>
            </nav>
            <!-- Main Menu End-->
        </div>

        @if (auth('candidate')->check())
            <div class="outer-box">
                <div class="dropdown dashboard-option">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                        @if(auth('candidate')->user()->user_image)
                            <img style="object-fit: cover;" src="{{ asset('uploads/images/candidate/'. auth('candidate')->user()->user_image) }}" alt="avatar"
                                class="thumb">
                        @else
                            @if(auth('candidate')->user()->seekerProfileMain)
                                @if(auth('candidate')->user()->seekerProfileMain->image)
                                    <img style="object-fit: cover;" src="{{ asset('uploads/images/candidate/'. auth('candidate')->user()->seekerProfileMain->image) }}" alt="avatar"
                                    class="thumb">
                                @else
                                    <img style="object-fit: cover;" src="{{  asset('uploads/images/candidate/logo_default_candidate.jpg') }}" alt="avatar"
                                    class="thumb">
                                @endif
                            @else
                                <img style="object-fit: cover;" src="{{  asset('uploads/images/candidate/logo_default_candidate.jpg') }}" alt="avatar"
                                class="thumb">
                            @endif
                        @endif
                        <span class="name">{{auth('candidate')->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu" style="min-width: 330px;">
                        {{-- <li class="active"><a href=""> <i class="la la-home"></i> Dashboard</a></li> --}}
                        <li><a href="{{route('detail')}}"><i class="la la-user-tie"></i>Thông tin</a></li>
                        <li>
                            @if (auth('candidate')->check())
                                @if (auth('candidate')->user()->status == 1)
                                    @if (count(auth('candidate')->user()->seekerProfile()->where('is_clone', 0)->get())>0)
                                        <a href="{{route('profile')}}" ><i class="fa-solid fa-newspaper"></i>Quản lý CV</a>
                                    @else
                                        <a href="#" class="quanlycv"><i class="fa-solid fa-newspaper"></i>Quản lý CV</a>
                                    @endif
                                @else
                                    <a href="{{route('client.block')}}" ><i class="fa-solid fa-newspaper"></i>Quản lý CV</a>
                                @endif
                            @else
                                <a href="{{route('login')}}"><i class="fa-solid fa-newspaper"></i>Quản lý CV</a>
                            @endif
                        </li>
                        <li><a href="{{route('jobApplied')}}"><i class="la la-briefcase"></i> Công việc đã ứng tuyển</a></li>
                        <li><a href="{{route('jobSaved')}}"><i class="la la-bookmark-o"></i>Công việc đã lưu</a></li>
                        {{-- <li><a href=""><i class="la la-briefcase"></i> Công việc đã tìm kiếm nhanh</a></li> --}}
                        <li><a href="{{route('companySaved')}}"><i class="icon fas fa-building"></i>Công ty đã lưu</a></li>
                        {{-- <li><a href=""><i class="la la-file-invoice"></i> Tạo CV</a></li> --}}
                        {{-- <li><a href=""><i class="la la-file-invoice"></i> Quản lí CV</a></li> --}}
                        {{-- <li><a href=""><i class="fa fa-cube"></i>Gói cước</a></li> --}}
                        {{-- <li><a href=""><i class="la la-history"></i>Lịch sử giao dịch</a></li> --}}
                        <li><a href="{{route('changePassword')}}"><i class="la la-lock"></i>Đổi mật khẩu</a></li>
                        <li><a href="{{route('logout')}}"><i class="la la-sign-out"></i>Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        @else
            <div class="outer-box">
                
                
                
                <div class="btn-box">
                    <a href="{{ route('choose') }}" class="theme-btn btn-style-three">Đăng nhập</a>
                </div>
            </div>
    </div>
    @endif 

    
    <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="logo"><a href=""><img src="{{ asset('images/logo_bakhoi.png') }}" alt=""
                    title=""></a>
        </div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">
            <div class="outer-box">
                <a href="#nav-mobile" class="mobile-nav-toggler"><span class="flaticon-menu-1"></span></a>
            </div>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div id="nav-mobile"></div>
</header>