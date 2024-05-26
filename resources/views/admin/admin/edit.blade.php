@extends('admin.layout.app')
@section('title')
  {{$title}}
@endsection
{{-- @section('style')
  @parent
<link href="{{asset('assets/client-bower/css/style.css')}}" rel="stylesheet">
@endsection --}}
@section('content')
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
<section class="content">
    <div class="container-fluid">
        <div class="">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">{{$title}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form  method="POST" action="{{ route('admin.admin.update', $admin)}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    {{-- để nhận dk request id --}}
                    <input type="hidden" name="id" value="{{ $admin->id }}">
                    <div class="row">
                      <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                              <label for="inputName">Tên<span class="text-danger">*</span></label>
                              <input type="text" id="inputName" name="name" class="form-control" value="{{old('name')?old('name'):$admin->name}}">
                              @error('name')
                              <small class="text-danger">{{$message}}</small>
                              @enderror
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Số điện thoai<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="phone" value="{{old('phone')?old('phone'):$admin->phone}}">
                              @error('phone')
                              <small class="text-danger">{{$message}}</small>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                              <label for="inputAddress">Địa chỉ<span class="text-danger">*</span></label>
                              <input type="text" id="inputAddress" name="address" class="form-control" value="{{old('address')?old('address'):$admin->address}}">
                              @error('address')
                              <small class="text-danger">{{$message}}</small>
                              @enderror
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Email<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="email" value="{{old('email')?old('email'):$admin->email}}">
                              @error('email')
                              <small class="text-danger">{{$message}}</small>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                              <label for="">Mật khẩu <span class="text-danger">(Nếu muốn thay đổi)</span></label>
                              <input type="text" id="inputName" name="password_new" class="form-control" value="{{old('password_new')}}">
                              @error('password')
                              <small class="text-danger">{{$message}}</small>
                              @enderror
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Loại tài khoản<span class="text-danger">*</span></label>
                              <div class="d-flex">
                                  <div class="form-check mr-3">
                                      <input type="radio" class="form-check-input" id="status" name="type" value="0"  @if($admin->type == 0) checked @endif>Nhân viên
                                      <label class="form-check-label" for="status"></label>
                                  </div>
                                  <div class="form-check mr-3">
                                      <input type="radio" class="form-check-input" id="status" name="type" value="1" @if($admin->type == 1) checked @endif>Admin
                                      <label class="form-check-label" for="status"></label>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="form-label w-100">Image</label>
                        <img id="image" src="{{ $admin->image?asset('uploads/images/admin/'. $admin->image):'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg'}}" alt="your image"
                            style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                        <input name="hinhanh_upload_logo" type="file" id="img">
                        <small class="form-text text-muted">Chọn ảnh kích thước nhỏ hơn 5mb</small>
                      </div>
                      <input type="text" value="{{$admin->image}}" hidden name="hinhanh_upload_logo_hd">
                  </div>
                  </div>
                    <div class="mt-3">
                        <input type="submit" value="Lưu" class="btn btn-primary float-left mr-3">
                        <a href="{{route('admin.admin.index')}}" class="btn btn-secondary">Hủy</a>
                    </div>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>
</section>
@endsection
@section('script')
@parent



{{-- <script src="{{asset('js/admin/candidate.js')}}"></script> --}}
@endsection