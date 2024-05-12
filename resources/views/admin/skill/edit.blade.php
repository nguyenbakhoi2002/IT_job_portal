@extends('admin.layout.app')
@section('title')
  {{$title}}
@endsection
{{-- @section('style')
  @parent
<link href="{{asset('assets/client-bower/css/style.css')}}" rel="stylesheet">
@endsection --}}
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
                  <form  method="POST" action="{{ route('admin.skill.update', $skill)}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    {{-- để nhận dk request id --}}
                    <input type="hidden" name="id" value="{{ $skill->id }}">
                    <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="inputName">{{__('Tên kĩ năng')}} <span class="text-danger">*</span></label>
                            <input type="text" id="inputName" name="name" class="form-control" value="{{old('name')? old('name') :$skill->name}}">
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>{{__('Mô tả')}}</label>
                        <input type="text" class="form-control" name="description" value="{{old('description')? old('description') :$skill->description}}">
                        @error('description')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                  </div>
                  
                    </div>
                    <div class="mt-3">
                        <input type="submit" value="Lưu" class="btn btn-primary float-left mr-3">
                        <a href="{{route('admin.skill.index')}}" class="btn btn-secondary">Hủy</a>
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