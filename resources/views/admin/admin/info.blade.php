@extends('admin.layout.app')
@section('title')
    Thông tin tài khoản
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
                  <h3 class="card-title">Thông tin tài khoản</h3>
                </div>
            <div class="card-body">
                <form action="{{ route('admin.updateDetail')}}" method="post" enctype="multipart/form-data">
                    {{-- @method('PUT') --}}
                    @csrf
                    <input type="hidden" name="id" value="{{ $detail->id }}">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Tên <span style="color: red">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder=""  value="{{old('name')?old('name'):$detail->name}}">
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" placeholder=""  value="{{old('email')?old('email'):$detail->email}}" readonly>
                                @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Số điện thoại <span style="color: red">*</span></label>
                                <input type="number" name="phone" class="form-control" placeholder=""  value="{{old('phone')?old('phone'):$detail->phone}}">
                                @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Địa chỉ <span style="color: red">*</span></label>
                                <input type="text" name="address" class="form-control" placeholder=""  value="{{old('address')?old('address'):$detail->address}}">
                                @error('address')
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
                                <img id="image" src="{{ $detail->image?asset('uploads/images/admin/'. $detail->image):'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg'}}" alt="your image"
                                    style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                                <input name="user_image_clone" type="file" id="img">
                                <small class="form-text text-muted">Chọn ảnh kích thước nhỏ hơn 5mb</small>
                              </div>
                              <input type="text" value="{{$detail->image}}" hidden name="user_image_hd">
                          </div>
                          
                      </div>
                      
                       
                        <br>
                        <div class="mt-3">
                            <input type="submit" value="Lưu" class="btn btn-primary float-left mr-3">
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