@extends('admin.layout.app')
@section('title')
    {{ __('Major - edit') }}
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
                <div class="card-body">
                  <form  method="POST" action="{{ route('admin.major.update', $major)}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{ $major->id }}">
                    <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="inputName">{{__('Tên chuyên ngành')}} <span class="text-danger">*</span></label>
                            <input type="text" id="inputName" name="name" class="form-control" value="{{old('name')? old('name') :$major->name}}">
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>{{__('Mô tả')}}</label>
                        <input type="text" class="form-control" name="description" value="{{old('description')? old('description') :$major->description}}">
                        @error('description')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                  </div>
                  <div class="">
                    <label class="form-label w-100">Trạng thái</label>
                    <div class="d-flex">
                        <div class="form-check mr-3">
                            <input type="radio" class="form-check-input" id="status" name="status" value="0" @if($major->status == 0) checked @endif>Ẩn
                            <label class="form-check-label" for="status"></label>
                        </div>
                      <div class="form-check mr-3">
                        <input type="radio" class="form-check-input" id="status" name="status" value="1" @if($major->status == 1) checked @endif >Hoạt động
                        <label class="form-check-label" for="status"></label>
                      </div>
                    </div>
                  </div>
                    </div>
                    <div class="mt-3">
                        <input type="submit" value="Lưu" class="btn btn-primary float-left mr-3">
                        <a href="{{route('admin.major.index')}}" class="btn btn-secondary">Hủy</a>
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