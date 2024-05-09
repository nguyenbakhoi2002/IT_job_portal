<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from creativelayers.net/themes/superio/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 31 Aug 2022 09:27:55 GMT -->
<head>
  <meta charset="utf-8">
  <title>Đăng ký tài khoản công ty</title>

  <!-- Stylesheets -->
  <link href="{{ asset('assets/client-bower/css/bootstrap.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/client-bower/css/style.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/client-bower/css/responsive.css')}}" rel="stylesheet">

  <link rel="shortcut icon" href="{{ asset('assets/client-bower/images/favicon.png')}}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/client-bower/images/favicon.png')}}" type="image/x-icon">

  <!-- Responsive -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  
</head>
<style>
    .employer{
        display: none;

    }
</style>
<body>

  <div class="page-wrapper">

    <!-- Preloader -->


    <!-- Main Header-->
    <header class="main-header">
      <div class="container-fluid">
        <!-- Main box -->
        <div class="main-box">
          <!--Nav Outer -->
          <div class="nav-outer">
            <div class="logo-box">
                <div class="logo"><a href="{{route('company.register')}}"><img src="" alt="" title=""></a></div></div>
          </div>

        </div>
      </div>

      <!-- Mobile Header -->
      <div class="mobile-header">
        <div class="logo"><a href="index.html"><img src="{{ asset('assets/client-bower/images/logo.svg')}}" alt="" title=""></a></div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">
          <div class="outer-box">
            <!-- Login/Register -->
            <div class="login-box">
              <a href="login-popup.html" class="call-modal"><span class="icon-user"></span></a>
            </div>
            <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span class="flaticon-menu-1"></span></a>
          </div>
        </div>
      </div>

      <!-- Mobile Nav -->
      <div id="nav-mobile"></div>
    </header>
    <!--End Main Header -->

    <!-- Info Section -->
    <div class="login-section" style="padding: 60px">
        <div class="image-layer" style=" width: 32%;background-image: url({{ asset('assets/client-bower/images/background/12.jpg')}});"></div>
      <div class="outer-box" style=" width: 68%; margin-left:32%;  ">
        <!-- Login Form -->
        <div class="login-form default-form" style=" max-width: 100%;">
          <div class="form-inner">
            <h3 style="color: #C46F01; font-size: 40px">Tạo tài khoản công ty</h3>

            <!--Login Form-->
           
              <div class="form-group">
              </div>
              <form method="post" action="" class="candidate"  >
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Email" value="{{old('email')}}">
                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                    </div>
                    <div class="form-group col-6">
                        <label>Mật khẩu</label>
                        <input id="password-field" type="password" name="password" value="" placeholder="Mật khẩu">
                        @error('password')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6 col-md-12">
                        <label>Nhập lại mật khẩu</label>
                        <input type="password" name="re_password" placeholder="Nhập lại mật khẩu" value="">
                        @error('re_password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                      </div>
                      <div class="form-group col-6">
                        <label>Tên Công Ty</label>
                        <input type="text" name="company_name" placeholder="Tên Công ty..." value="{{old('company_name')}}">
                        @error('company_name')
                          <small class="text-danger">{{$message}}</small>
                        @enderror
                      </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                      <label>Web site</label>
                      <input type="text" name="link_web" placeholder="" value="{{old('link_web')}}">
                      @error('link_web')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                    
                    <div class="form-group col-6">
                      <label>Hotline</label>
                      <input type="number" name="phone" placeholder="Số điện thoại" value="{{old('phone')}}">
                      @error('phone')
                          <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label>Loại hình doanh nghiệp</label>
                        <input type="text" name="company_model" placeholder="" value="{{old('company_model')}}">
                        @error('company_model')
                          <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                    <div class="form-group col-6">
                        <label>Tên CEO</label>
                        <input type="text" name="name" placeholder="" value="{{old('name')}}">
                        @error('name')
                          <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="form-group col-6">
                        <label>Web site</label>
                        <input type="text" name="link_web" placeholder="" value="{{old('link_web')}}">
                        @error('link_web')
                          <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                    <div class="form-group col-6">
                        <label>Năm thành lập</label>
                        <input type="text" name="founded_in" placeholder="Năm thành lập" value="{{old('founded_in')}}">
                        @error('founded_in')
                          <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div> --}}
                <div class="row">
                    <div class="form-group col-6">
                        <label>Địa chỉ</label>
                        <input type="text" name="address" placeholder="Địa chỉ" value="{{old('address')}}">
                        @error('address')
                          <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                    <div class="form-group col-6">
                        <label>Số lượng nhân viên</label>
                        <input type="text" name="team" placeholder="Số lượng nhân viên" value="{{old('team')}}">
                        @error('team')
                          <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>


              
              
              
              
              <div class="form-group">
                <button class="theme-btn btn-style-one mt-5" type="submit" name="Register">Đăng ký</button>
              </div>
            </form>
        <div class="bottom-box">
          <div class="text">Bạn đã có tài khoản? <a href="{{route('company.login')}}">Đăng nhập</a></div>
          {{-- <div class="divider"><span>hoặc</span></div>
            <div class="btn-box row">
              <div class="col-lg-12 col-md-12">
                <a href="{{route('getGoogleLoginClient')}}" class="theme-btn social-btn-two google-btn"><i class="fab fa-google"></i> Google</a>
              </div>
            </div>
        </div> --}}
    
          </div>
        </div>
        <!--End Login Form -->
      </div>
    </div>
    <!-- End Info Section -->

  </div><!-- End Page Wrapper -->

</body>


</html>