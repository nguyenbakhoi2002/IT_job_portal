@extends('admin.layout.app')
@section('title')
    Thay đổi mật khẩu
@endsection
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
                  <h3 class="card-title">Thay đổi mật khẩu</h3>
                </div>
            <div class="card-body">
                <form action="{{ route('admin.updatePassword')}}" method="post" enctype="multipart/form-data">
                    {{-- @method('PUT') --}}
                    @csrf
                    <input type="hidden" name="id" value="{{ $detail->id }}">

                    
                    <div class="row">
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Mật khẩu hiện tại<span style="color: red">*</span></label>
                                <input type="password" name="password_old" class="form-control" placeholder="">
                                @error('password_old')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Mật khẩu mới<span style="color: red">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="">
                                @error('password')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nhập lại mật khẩu mới<span style="color: red">*</span></label>
                                <input type="password" name="re_password" class="form-control" placeholder="">
                                @error('re_password')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    
                    {{--  --}}
                        
                      
                       
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