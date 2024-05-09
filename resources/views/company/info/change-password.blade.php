@extends('company.layout.app')
@section('title')
    BaKhoi|Đổi mật khẩu company
@endsection
@section('content')
    <section class="user-dashboard pt-5 mt-5">
      <div class="dashboard-outer">
        <div class="row">
          <div class="col-lg-10 m-auto">
            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h4>Đổi mật khẩu</h4>
                </div>

                <div class="widget-content">
                  <form class="default-form" action="{{route("company.updatePassword")}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Mật khẩu cũ</label>
                        <input type="password" name="password_old" placeholder="Mật khẩu cũ" value="">
                        @error('password_old')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                      </div>
                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Mật khẩu mới</label>
                        <input type="password" name="password" placeholder="Mật khẩu mới" value="">
                        @error('password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                      </div>
                      <div class="form-group col-lg-6 col-md-12">
                        <label>Nhập lại mật khẩu</label>
                        <input type="password" name="re_password" placeholder="Nhập lại mật khẩu" value="">
                        @error('re_password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                      </div>
                      <div class="w-100"></div>
                      <!-- Input -->
                      <div class="form-group col-lg-6 col-md-12">
                        <button type="submit" class="theme-btn btn-style-one">Cập nhật</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </section>
@endsection