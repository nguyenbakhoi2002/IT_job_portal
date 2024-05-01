@extends('client.layout.app')
@section('title')
    BaKhoi|{{ $detail->name }}
@endsection
@section('content')
    <section class="user-dashboard pt-5 mt-5">
        <div class="dashboard-outer">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>Thông tin của bạn</h4>
                            </div>
                            <div class="widget-content">
                                <div class="form-group col-lg-6 col-md-12" style="margin-bottom: 30px">
                                    @if ($detail->type == 1)
                                        <form action="{{ route('status', ['candidate' => $detail->id, $detail->type]) }}"
                                            method="POST">
                                            @csrf
                                            <label>Trạng Thái Tìm Việc</label>
                                            <button class="btn btn-success">Đang Bật</button>
                                        </form>
                                    @else
                                        <form action=""
                                            method="POST">
                                            @csrf
                                            <label>Trạng Thái Tìm Việc</label>
                                            <button class="btn btn-danger">Đang Tắt</button>
                                        </form>
                                    @endif
                                </div>
                                <form class="default-form" action="{{route('updateDetail')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" value="{{$detail->id}}" hidden name="id">
                                        {{-- <div class="col-sm-6">
                                            <div class="form-group">
                                            <label class="form-label w-100">Logo</label>
                                            <img id="image" src="{{ $detail->user_image?asset('uploads/images/candidate/'. $detail->user_image):'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg'}}" alt="your image"
                                                style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                                            <input name="hinhanh_upload_logo" type="file" id="img">
                                            <small class="form-text text-muted">Chọn ảnh kích thước nhỏ hơn 5mb</small>
                                            </div>
                                            <input type="text" value="{{$detail->user_image}}" hidden name="hinhanh_upload_logo_hd">
                                        </div> --}}
                                        <div class="uploading-outer">
                                            <div class="uploadButton" style="width: 200px;height: 200px;">
                                                <input class="uploadButton-input" type="file" name="image"
                                                    accept="image/*, application/pdf" id="upload" multiple />
                                                <label class="uploadButton-button ripple-effect" for="upload"><img
                                                        id="image" src="{{asset('uploads/images/candidate/'. $detail->user_image) }}"
                                                        alt="Ảnh của bạn"
                                                        style="width: 200px;max-height: 200px; margin-bottom: 28px;object-fit: cover;"
                                                        class="img-fluid" /></label>
                                                <span class="uploadButton-file-name"></span>
                                            </div>
                                            <div class="text ms-5 mt-5">Kích thước tệp tối đa là 1MB, Kích thước tối thiểu: 330x300
                                                Và các tệp phù hợp là .jpg & .png</div>
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <input type="text" value="{{$detail->user_image}}" hidden name="image_hd">
                                        </div>
                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Họ và tên</label>
                                            <input type="text" name="name" placeholder="Họ và tên..."
                                                value="{{ $detail->name }}">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Email</label>
                                            <input type="text" name="email" placeholder="Email..."
                                                value="{{ $detail->email }}" readonly>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Số điện thoại</label>
                                            <input type="text" name="phone" placeholder="Số điện thoại..."
                                                value="{{ $detail->phone }}">
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="w-100"></div>
                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <button type="submit" class="theme-btn btn-style-one">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
