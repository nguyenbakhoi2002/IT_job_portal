<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login</title>

  <!-- Stylesheets -->
  <link href="{{ asset('assets/client-bower/css/bootstrap.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/client-bower/css/style.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/client-bower/css/responsive.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('assets/admin-bower/plugins/toastr/toastr.css')}}">
  <link rel="shortcut icon" href="{{ asset('assets/client-bower/images/favicon.png')}}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/client-bower/images/favicon.png')}}" type="image/x-icon">

  <!-- Responsive -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
  <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

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
              <div class="logo"><a href="{{route('login')}}"><img src="" alt="" title=""></a></div>
            </div>
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
            <h3>Đăng nhập vào BaKhoi</h3>
            <!--Login Form-->
            <form method="POST" action="">
                @csrf
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" placeholder="Email" value="{{old('email')}}" >
                @error('email')
                  <small class="text-danger">{{$message}}</small>
                @enderror
              </div>

              <div class="form-group">
                <label>Password</label>
                <input id="password-field" type="password" name="password" value="" placeholder="Password">
                @error('password')
                  <small class="text-danger">{{$message}}</small>
                @enderror
              </div>

              <div class="form-group">
                <button class="theme-btn btn-style-one" type="submit">Đăng nhập</button>

              </div>
              {{-- <input type="hidden" name="_token" value="{!! csrf_token() !!}"> --}}
            </form>
            <div class="bottom-box">
                <div class="text"><a href="">Quên Mật Khẩu?</a><span> Hoặc</span> Bạn chưa có tài khoản? <a href="{{route('register')}}">Đăng ký</a>
                </div>
              <div class="divider"><span>hoặc</span></div>
              <div class="btn-box row">
                <div class="col-lg-12 col-md-12">
                  <a href="" class="theme-btn social-btn-two google-btn"><i class="fab fa-google"></i> Google</a>
                </div>
              </div>
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
  <script src="{{ asset('assets/admin-bower/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('assets/admin-bower/plugins/toastr/toastr.min.js') }}"></script>
</body>
@include('admin.layout.toastr')
</html>
