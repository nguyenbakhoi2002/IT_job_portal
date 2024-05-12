<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from creativelayers.net/themes/superio/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 31 Aug 2022 09:27:55 GMT -->
<head>
  <meta charset="utf-8">
  <title>BaKhoi | Register</title>

  <!-- Stylesheets -->
  <link href="{{ asset('assets/client-bower/css/bootstrap.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/client-bower/css/style.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/client-bower/css/responsive.css')}}" rel="stylesheet">

  <link rel="shortcut icon" href="{{ asset('assets/client-bower/images/favicon.png')}}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/client-bower/images/favicon.png')}}" type="image/x-icon">

  <!-- Responsive -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
  <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
  
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
    <div class="login-section">
        <div class="image-layer" style="background-image: url({{ asset('assets/client-bower/images/background/12.jpg')}});"></div>
      <div class="outer-box">
        <!-- Login Form -->
        <div class="login-form default-form">
          <div class="form-inner">
            <h3>Tạo mới tài khoản</h3>
            {{-- <h3>ĐĂNG NHẬP</h3> --}}

            <!--Login Form-->
           
              <div class="form-group">
                <div class="btn-box row">
                  {{-- <div class="">
                    <a href="javascript:void(0)" class="theme-btn btn-style-seven btn-candidate"><i class="la la-user"></i> Đăng ký ứng viên </a>
                  </div> --}}
                </div>
              </div>
              <form method="post" action="" class="candidate">
                @csrf
                <div class="form-group">
                    <label>Họ tên</label>
                    <input type="text" name="name" placeholder="Nhập vào họ tên" value="{{old('name')}}">
                    @error('name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Nhập vào email" value="{{old('email')}}">
                @error('email')
                  <small class="text-danger">{{$message}}</small>
                @enderror
              </div>
              

              <div class="form-group">
                <label>Mật khẩu</label>
                <input id="password-field" type="password" name="password" value="{{old('password')}}" placeholder="Nhập vào mật khẩu">
                @error('password')
                  <small class="text-danger">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group">
                <label>Nhập lại mật khẩu</label>
                <input id="password-field" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Nhập lại mật khẩu">
                @error('password_confirmation')
                  <small class="text-danger">{{$message}}</small>
                @enderror
              </div>
              

              {{-- <div class="form-group">
                <label>Giới tính</label> <br>
                <input type="radio" checked id="html" name="gender" value="1">
                <label for="html">Nam</label>
                <input style="margin: " type="radio" id="css" name="gender" value="2">
                <label for="css">Nữ</label>
              </div> --}}

              <div class="form-group">
                <button class="theme-btn btn-style-one " type="submit" name="">Đăng ký</button>
              </div>
            </form> 
            <div class="bottom-box">
              <div class="text">Bạn đã có tài khoản? <a href="{{route('login')}}">Đăng nhập</a></div>
              <div class="divider"><span>hoặc</span></div>
              <div class="btn-box row">
                <div class="col-lg-12 col-md-12">
                  <a href="" class="theme-btn social-btn-two google-btn"><i class="fab fa-google"></i> Google</a>
                </div>
              </div>
            </div>

        <!--End Login Form -->
      </div>
    </div>
    <!-- End Info Section -->


  </div><!-- End Page Wrapper -->


  <script src="{{ asset('assets/client-bower/js/jquery.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/popper.min.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/chosen.min.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/jquery-ui.min.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/jquery.fancybox.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/jquery.modal.min.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/mmenu.polyfills.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/mmenu.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/appear.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/ScrollMagic.min.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/rellax.min.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/owl.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/wow.js')}}"></script>
  <script src="{{ asset('assets/client-bower/js/script.js')}}"></script>

 
</body>


<!-- Mirrored from creativelayers.net/themes/superio/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 31 Aug 2022 09:27:55 GMT -->
</html>