@extends('admin.layout.app')
@section('title')
    {{ __('Major - add') }}
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
                  <form action="{{ route('admin.degree.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="inputName">Tên bằng cấp <span class="text-danger">*</span></label>
                            <input type="text" id="inputName" name="name" class="form-control" value="{{old('name')}}">
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Cấp độ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="level" value="{{old('level')}}">
                            @error('level')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="">
                        <label class="form-label w-100">Trạng thái</label>
                        <div class="d-flex">
                            <div class="form-check mr-3">
                                <input type="radio" class="form-check-input" id="status" name="status" value="0" checked>Ẩn
                                <label class="form-check-label" for="status"></label>
                            </div>
                          <div class="form-check mr-3">
                            <input type="radio" class="form-check-input" id="status" name="status" value="1" >Hoạt động
                            <label class="form-check-label" for="status"></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary float-left mr-3">Lưu</button>
                        <a href="{{route('admin.degree.index')}}" class="btn btn-secondary">Hủy</a>
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