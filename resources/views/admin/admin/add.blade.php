@extends('admin.layout.app')
@section('title')
    Admin-Add
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="">

            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">{{__($title)}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form action="{{ route('admin.admin.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="inputName">Tên<span class="text-danger">*</span></label>
                                <input type="text" id="inputName" name="name" class="form-control" value="{{old('name')}}">
                                @error('name')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Số điện thoai<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
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
                                <input type="text" id="inputAddress" name="address" class="form-control" value="{{old('address')}}">
                                @error('address')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" value="{{old('email')}}">
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
                                <label for="">Mật khẩu<span class="text-danger">*</span></label>
                                <input type="text" id="inputName" name="password" class="form-control" value="{{old('password')}}">
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
                                        <input type="radio" class="form-check-input" id="status" name="type" value="0" checked>Nhân viên
                                        <label class="form-check-label" for="status"></label>
                                    </div>
                                    <div class="form-check mr-3">
                                        <input type="radio" class="form-check-input" id="status" name="type" value="1" >Admin
                                        <label class="form-check-label" for="status"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label class="form-label w-100">Logo</label>
                              <img id="image" src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" alt="your image"
                                  style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                              <input name="hinhanh_upload_logo" type="file" id="img">
                              @error('hinhanh_upload_logo')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary float-left mr-3">{{__('Lưu')}}</button>
                        <a href="{{route('admin.skill.index')}}" class="btn btn-secondary">{{__('Hủy')}}</a>
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