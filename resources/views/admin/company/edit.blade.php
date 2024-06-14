@extends('admin.layout.app')
@section('title')
    {{ __('Sửa Công ty') }}
@endsection
@section('content')
@if ($message = Session::get('error'))
        <div class="alert alert-success alert-block">
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
            <div class="card-body">
                <form action="{{ route('admin.company.update', $company)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{ $company->id }}">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Tên <span style="color: red">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder=""  value="{{old('name')?old('name'):$company->name}}">
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Tên công ty <span style="color: red">*</span></label>
                                <input type="text" name="company_name" class="form-control" placeholder=""  value="{{old('company_name')?old('company_name'):$company->company_name}}">
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
                                <input type="email" name="email" class="form-control" placeholder=""  value="{{old('email')?old('email'):$company->email}}">
                                @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Mật khẩu đã bị mã hóa<span style="color: red">*</span></label>
                                <input type="text" name="password" readonly class="form-control" value="{{old('password')?old('password'):$company->password}}"  value="">
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
                                <input type="number" name="phone" class="form-control" placeholder=""  value="{{old('phone')?old('phone'):$company->phone}}">
                                @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Mã số thuế <span style="color: red">*</span></label>
                                <input type="text" name="tax_code" class="form-control" placeholder=""  value="{{old('tax_code')?old('tax_code'):$company->tax_code}}">
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
                                <input type="text" name="company_model" class="form-control" placeholder=""  value="{{old('company_model')?old('company_model'):$company->company_model}}">
                                @error('conpany_model')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Thời gian làm việc</label>
                                <input type="text" name="working_time" class="form-control" placeholder=""  value="{{old('working_time')?old('working_time'):$company->working_time}}">
                            </div>
                        </div> --}}
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Link Website</label>
                                <input type="text" name="link_web" class="form-control" placeholder=""  value="{{old('link_web')?old('link_web'):$company->link_web}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" placeholder=""  value="{{old('address')?old('address'):$company->address}}">
                            </div>
                        </div>
                    </div>   
                    
                    {{--  --}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Số lượng nhân viên</label>
                                <input type="text" name="team" class="form-control" placeholder=""  value="{{old('team')?old('team'):$company->team}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Ngày thành lập</label>
                                <input type="date" name="founded_in" class="form-control" placeholder=""  value="{{old('link_web')?old('link_web'):$company->link_web}}">
                            </div>
                        </div>
                        
                    </div>  

                    {{--  --}}
                        <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                <label class="form-label w-100">Logo</label>
                                <img id="image" src="{{ $company->logo?asset('uploads/images/company/'. $company->logo):'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg'}}" alt="your image"
                                    style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                                <input name="hinhanh_upload_logo" type="file" id="img">
                                <small class="form-text text-muted">Chọn ảnh kích thước nhỏ hơn 5mb</small>
                              </div>
                              <input type="text" value="{{$company->logo}}" hidden name="hinhanh_upload_logo_hd">
                          </div>
                          <div class="col-sm-6">
                            <label class="form-label w-100">Trạng thái</label>
                            <div class="d-flex">
                              {{-- <div class="form-check mr-3">
                                <input type="radio" class="form-check-input" id="status" name="status" value="0" @if($company->status == 0) checked @endif>Chưa kích hoạt
                                <label class="form-check-label" for="status"></label>
                              </div> --}}
                              <div class="form-check mr-3">
                                <input type="radio" class="form-check-input" id="status" name="status" value="0" @if($company->status == 0) checked @endif>Chặn
                                <label class="form-check-label" for="status"></label>
                              </div>
                              <div class="form-check">
                                <input type="radio" class="form-check-input" id="status2" name="status" value="1" @if($company->status == 1) checked @endif>Hoạt động
                                <label class="form-check-label" for="status2"></label>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label class="form-label w-100">giấy phép kinh doanh</label>
                              <img id="image" src="{{ $company->image_paper?asset('uploads/images/image_paper/'. $company->image_paper):'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg'}}" alt="your image"
                                  style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                              <input name="hinhanh_upload_image_paper" type="file" id="img">
                              <small class="form-text text-muted">Chọn ảnh kích thước nhỏ hơn 5mb</small>
                            </div>
                            <input type="text" value="{{$company->image_paper}}" hidden name="hinhanh_upload_image_paper_hd">

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Về chúng tôi</label>
                                <textarea  type="text" name="about" class="form-control" placeholder="" >{{old('about')?old('about'):$company->about}}</textarea>
                            </div>
                        </div>
                    </div>
                       
                        <br>
                        <div class="mt-3">
                            <input type="submit" value="Lưu" class="btn btn-primary float-left mr-3">
                            <a href="{{route('admin.company.index')}}" class="btn btn-secondary">Hủy</a>
                        </div>
                    </form>
                </div>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>
</section>
@endsection