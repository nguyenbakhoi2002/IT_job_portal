@extends('admin.layout.app')
@section('title')
    {{ __('Thêm công ty') }}
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">{{$title}}</h3>
                </div>
                <!-- /.card-header -->
                <p class="mx-4 mt-3">Chú ý: những trường có kí tự <span style="color: red">*</span> là bắt buộc</p>
                <div class="card-body">
                  <form action="{{ route('admin.company.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Tên <span style="color: red">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder=""  value="{{old('name')}}">
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Tên công ty <span style="color: red">*</span></label>
                                <input type="text" name="company_name" class="form-control" placeholder=""  value="{{old('company_name')}}">
                            @error('company_name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Email <span style="color: red">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder=""  value="{{old('email')}}">
                                @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Mật khẩu <span style="color: red">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder=""  value="">
                                @error('password')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Số điện thoại <span style="color: red">*</span></label>
                                <input type="number" name="phone" class="form-control" placeholder=""  value="{{old('phone')}}">
                                @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Mã số thuế <span style="color: red">*</span></label>
                                <input type="text" name="tax_code" class="form-control" placeholder=""  value="{{old('tax_code')}}">
                                @error('tax_code')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Mô hình công ty</label>
                                <input type="text" name="company_model" class="form-control" placeholder=""  value="{{old('company_model')}}">
                                @error('conpany_model')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Thời gian làm việc</label>
                                <input type="text" name="working_time" class="form-control" placeholder=""  value="{{old('working_time')}}">
                            </div>
                        </div> --}}
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Link Website</label>
                                <input type="text" name="link_web" class="form-control" placeholder=""  value="{{old('link_web')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" placeholder=""  value="{{old('address')}}">
                            </div>
                        </div>
                    </div>   
                    
                    {{--  --}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Số lượng nhân viên</label>
                                <input type="text" name="team" class="form-control" placeholder=""  value="{{old('team')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Ngày thành lập</label>
                                <input type="date" name="founded_in" class="form-control" placeholder=""  value="{{old('link_web')}}">
                            </div>
                        </div>
                        
                    </div>  

                    {{--  --}}
                        <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                <label class="form-label w-100">Logo</label>
                                <img id="image" src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" alt="your image"
                                    style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                                <input name="hinhanh_upload_logo" type="file" id="img">
                                <small class="form-text text-muted">Chọn ảnh kích thước nhỏ hơn 5mb</small>
                              </div>
                          </div>
                          <div class="">
                            <label class="form-label w-100">Trạng thái</label>
                            <div class="d-flex">
                                <div class="form-check mr-3">
                                    <input type="radio" class="form-check-input" id="status" name="status" value="0" checked>{{__('Chưa kích hoạt')}}
                                    <label class="form-check-label" for="status"></label>
                                </div>
                              <div class="form-check mr-3">
                                <input type="radio" class="form-check-input" id="status" name="status" value="1" >{{__('Kích hoạt')}}
                                <label class="form-check-label" for="status"></label>
                              </div>
                              <div class="form-check">
                                <input type="radio" class="form-check-input" id="status2" name="status" value="2">{{__('Chặn')}}
                                <label class="form-check-label" for="status2"></label>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label class="form-label w-100">giấy phép kinh doanh</label>
                              <img id="image" src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" alt="your image"
                                  style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                              <input name="hinhanh_upload_image_paper" type="file" id="img">
                              <small class="form-text text-muted">Chọn ảnh kích thước nhỏ hơn 5mb</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Về chúng tôi</label>
                                <textarea  type="text" name="about" class="form-control" placeholder="" >{{old('about')}}</textarea>
                            </div>
                        </div>
                    </div>
                        <br>
                        <div class="mt-3">
                            <input type="submit" value="Thêm" class="btn btn-primary float-left mr-3">
                            <a href="{{route('admin.company.index')}}" class="btn btn-secondary">Hủy</a>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>
</section>
@endsection