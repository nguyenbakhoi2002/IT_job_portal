@extends('company.layout.app')
@section('title')
    Sửa công ty
@endsection
@section('content')
<section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <div class="upper-title-box">
                  <h3>Tài khoản công ty!</h3>
                </div>
              </div>
              <div class="widget-content">
                <form class="default-form" action="{{route('company.infoUpdate')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="text" value="{{$data->id}}" hidden name="id">
                  <div class="uploading-outer">
                    <div class="uploadButton">
                      <input class="uploadButton-input" type="file" name="hinhanh_upload_logo" accept="image/*, application/pdf" id="upload" />
                      <label class="uploadButton-button ripple-effect fileupload-preview thumbnail" for="upload"><img id="image" src="{{asset('uploads/images/company/'. $data->logo)}}" alt="Ảnh của bạn"
                        style="width: 201px;max-height: 111px; margin-bottom: 28px;object-fit: cover;" class="img-fluid"/></label>
                      <span class="uploadButton-file-name"></span>
                    </div>
                    <div class="text">Kích thước tệp tối đa là 1MB, Kích thước tối thiểu: 330x300 Và các tệp phù hợp là .jpg & .png</div>
                    <input type="text" value="{{$data->logo}}" hidden name="hinhanh_upload_logo_hd">
                    @error('hinhanh_upload_logo')
                    <small class="text-danger">{{$message}}</small>
                  @enderror
                  </div>
                 
                {{-- @dd($data);  --}}
                <input type="hidden" name="logo_old" value="{{$data->logo}}">
           
                <td class="text-center"></td>
                  <div class="row">
                    <!-- Input -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Tên CEO</label>
                      
                      <input type="text" name="name" value="{!!$data->name !!}">
                      @error('name')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Tên Công ty</label>
                      
                      <input type="text" name="company_name" value="{!!$data->company_name !!}">
                      @error('company_name')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                      <label>Email</label>
                      <input type="text" name="email" value="{!!$data->email !!}">
                      @error('email')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
<!-- Input -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Số điện thoại</label>
                      <input type="text" name="phone" value="{!!$data->phone !!}">
                      @error('phone')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>

                    <!-- Input -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Website</label>
                      <input type="text" name="link_web" value="{!!$data->link_web !!}">
                      @error('link_web')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                    
                    {{-- <div class="form-group col-lg-6 col-md-12">
                      <label>Lĩnh vực hoạt động</label>
                      <input type="text" name="company_model" value="{!!$data->company_model !!}">
                    </div> --}}

                    <!-- Input -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Năm thành lập</label>
                      <input type="date" name="founded_in" value="{!!$data->founded_in !!}" placeholder="06.04.2020">
                      @error('founded_in')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                    
                    {{-- @dd($data); --}}
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Địa chỉ</label>
                      <input type="text" name="address" value="{!!$data->address !!}">
                      @error('address')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Loại hình doanh nghiệp</label>
                      <input type="text" name="company_model" value="{!!$data->company_model !!}">
                      @error('phone')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>

                    <!-- Input -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Số lượng nhân viên</label>
                      <input type="text" name="team" value="{!!$data->team !!}">
                      @error('team')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>       
                    <div class="form-group col-lg-6 col-md-12">
                        <label>Map</label>
                        <input type="text" name="map" value="{!!$data->map !!}">
                        @error('map')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>        
                    <div class="form-group col-lg-12 col-md-12">
                      <label>About Company</label>
                      <textarea type="text" name="about">{!!$data->about !!}</textarea>
                      @error('about')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>

                    <!-- Input -->
                    <div class="form-group col-lg-6 col-md-12">
                      <button class="theme-btn btn-style-one">Lưu</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>
@endsection