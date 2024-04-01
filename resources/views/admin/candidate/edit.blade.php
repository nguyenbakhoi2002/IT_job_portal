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
                <form action="{{ route('admin.candidate.update', $candidate)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{ $candidate->id }}">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Tên <span style="color: red">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder=""  value="{{old('name')?old('name'):$candidate->name}}">
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Email <span style="color: red">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder=""  value="{{old('email')?old('email'):$candidate->email}}">
                                @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Mật khẩu đã bị mã hóa<span style="color: red">*</span></label>
                                <input type="text" name="password" readonly class="form-control" value="{{old('password')?old('password'):$candidate->password}}"  value="">
                                @error('password')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Số điện thoại <span style="color: red">*</span></label>
                                <input type="number" name="phone" class="form-control" placeholder=""  value="{{old('phone')?old('phone'):$candidate->phone}}">
                                @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nhập mật khẩu mới <span style="color: red">(Chỉ khi bạn muốn thay đổi mật khẩu)</span></label>
                                <input type="text" name="new_password"  class="form-control" value="{{old('new_password')?old('new_password'):''}}" >
                                @error('new_password')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    {{--  --}}
                        <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                <label class="form-label w-100">Ảnh đại diện</label>
                                <img id="image" src="{{ $candidate->logo?asset('uploads/images/candidate/'. $candidate->logo):'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg'}}" alt="your image"
                                    style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                                <input name="user_image_clone" type="file" id="img">
                                <small class="form-text text-muted">Chọn ảnh kích thước nhỏ hơn 5mb</small>
                              </div>
                              <input type="text" value="{{$candidate->user_image}}" hidden name="user_image_hd">
                          </div>
                          <div class="col-sm-6">
                            <label class="form-label w-100">Trạng thái</label>
                            <div class="d-flex">
                              <div class="form-check mr-3">
                                <input type="radio" class="form-check-input" id="status" name="status" value="0" @if($candidate->status == 0) checked @endif>chặn
                                <label class="form-check-label" for="status"></label>
                              </div>
                              <div class="form-check mr-3">
                                <input type="radio" class="form-check-input" id="status" name="status" value="1" @if($candidate->status == 1) checked @endif>hoạt động
                                <label class="form-check-label" for="status"></label>
                              </div>
                              
                            </div>
                          </div>
                      </div>
                      
                       
                        <br>
                        <div class="mt-3">
                            <input type="submit" value="Lưu" class="btn btn-primary float-left mr-3">
                            <a href="{{route('admin.candidate.index')}}" class="btn btn-secondary">Hủy</a>
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