@extends('client.layout.app')
@section('content')
    <section class="contact-section" style="margin-top: 140px">
        <div class="auto-container">
            <div class="contact-form default-form">
                <h3>Khôi Phục Mật Khẩu</h3>
                <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <form action="">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" style="margin-bottom: 30px">
                                <label>Tài khoản cần khôi phục mật khẩu</label>
                                <input type="text" name="email" 
                                    placeholder="Mời nhập email cần khôi phục" readonly value={{$candidate->email}}>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" style="margin-bottom: 30px">
                                <label>Mã Xác Nhận</label>
                                <input type="text" name="token" 
                                    placeholder="Nhập mã khôi phục">
                                @error('token')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" style="margin-bottom: 30px">
                                <label>Mật Khẩu Mới</label>
                                <input type="password" name="password" 
                                    placeholder="Mật Khẩu Mới">
                                @error('password')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" style="margin-bottom: 30px">
                                <label>Nhập Lại Mật Khẩu</label>
                                <input type="password" name="re_password"
                                    placeholder="Mật Khẩu Mới">
                                @error('re_password')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <button class="theme-btn btn-style-one" type="submit" >Đặt Lại Mật Khẩu</button>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
