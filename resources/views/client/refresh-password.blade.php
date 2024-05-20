<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Quên mật khẩu</title>

  <!-- Stylesheets -->
  <link href="{{ asset('assets/client-bower/css/bootstrap.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/client-bower/css/style.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/client-bower/css/responsive.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('assets/admin-bower/plugins/toastr/toastr.css')}}">
  <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">
  <link rel="icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">

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

    <section class="contact-section">
        <div class="auto-container">
            <div class="contact-form default-form">
                <h3>Khôi Phục Mật Khẩu</h3>
                <form method="post" action="" id="email-form">
                    @csrf
                    <div class="row">
                        <form action="">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" style="margin-bottom: 30px">
                                <label>Email</label>
                                <input type="text" name="email" class="subject"
                                    placeholder="Mời nhập email cần khôi phục" required>
                                    @error('email')
                                      <small class="text-danger">{{$message}}</small>
                                    @enderror
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <button class="theme-btn btn-style-one" type="submit" >Khôi Phục</button>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </section>

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
