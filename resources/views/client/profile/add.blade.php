@extends('client.layout.app')
@section('style')
<style>
    .border-bot {
        border-bottom: 1px solid #f7941d;
        padding-bottom: 10px;
        width: 100%;
    }

    .border-dotted-bot {
        border-bottom: 1px dotted #f7941d;
        padding-bottom: 10px;
        width: 100%;
    }
    .form {
        border: 1px dotted #f7941d;
        padding: 10px;
    }
    .form:hover {
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }
    i {
        color: #f7941d;
    }
    .col-lg-12 {
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    }
    .border-none {
        border: none;
    }
</style>
@parent
@endsection
@section('title')
    {{ __('UB Work') }} | {{__('Cập nhật CV')}}
@endsection
@section('content')
    <section class="ls-section mt-5">
        <div class="container-fluid" style="max-width: 670px">
            <div class="row">

                <div class="col-lg-12">
                    <!-- CV Manager Widget -->
                    <div class="cv-manager-widget ls-widget">
                        <div class="widget-title">
                            <h4>Cập nhật CV</h4>
                        </div>
                        <div class="widget-content">
                            <div class="title">
                                <h1>Tạo CV trên hệ thống, tăng cơ hội nhận được việc làm !</h1>
                                <p class="mt-3">
                                    Tạo CV tại hệ thống chúng tôi sẽ tăng <strong>99%</strong> tìm được việc,<br>
                                    hãy tạo ngay cv cho mình nhé.
                                </p>
                            </div>

                            <div class="create-cv">
                                <div class="info mb-3">
                                    <form id="create_info" action="" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between border-bot">
                                                <div class="font-weight-bold h4" >Thông tin cá nhân</div>
                                                <div id="block-p" style="cursor: pointer;"><i class="fas fa-edit"></i></div>
                                            </div>
                                            <div id="desc" class="mt-3 form" style="display: none">
                                                @if(!empty($seeker)) <input type="hidden" name="id" value="{{$seeker->id}}"> @endif
                                                <input type="hidden" name="candidate_id" value="" >
                                                <div class="form-group">
                                                    <label for="">Họ và tên *</label>
                                                    <input type="text" name="name" class="form-control" @if(!empty($seeker)) value="{{$seeker->name}}" @endif>
                                                        <small class="val_info_name text-danger pl-4"></small>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label class="form-label w-100">Ảnh</label>
                                                    <img id="image" @if(!empty($seeker)) src="{{ $seeker->image?''.Storage::url($seeker->image):'https://via.placeholder.com/100' }}" @else src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" @endif alt="your image"
                                                        style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                                                    <input name="image" type="file" id="img">
                                                    <small class="form-text text-muted">Chọn ảnh kích thước nhỏ hơn 5mb</small>
                                                    <small class="val_info_image text-danger"></small>
                                                  </div>
                                                  <div class="form-group mt-3">
                                                    <label for="">Địa chỉ *</label>
                                                    <input type="text" name="address" class="form-control" @if(!empty($seeker)) value="{{$seeker->address}}" @endif>
                                                    <small class="val_info_address text-danger"></small>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="">Số điện thoại *</label>
                                                    <input type="number" name="phone" class="form-control" @if(!empty($seeker)) value="{{$seeker->phone}}" @endif>
                                                    <small class="val_info_phone text-danger"></small>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="">Email *</label>
                                                    <input type="email" name="email" class="form-control" @if(!empty($seeker)) value="{{$seeker->email}}" @endif>
                                                    <small class="val_info_email text-danger"></small>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="">Chuyên ngành *</label>
                                                    <select name="major_id" class="c_major_id form-select">
                                                        @foreach($maJor as $mj)
                                                            <option @if(!empty($seeker)) @if($seeker->major_id == $mj->id) selected @endif @endif value="{{$mj->id}}">{{$mj->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small class="val_info_major_id text-danger"></small>
                                                </div>
                                               <div class="form-group mt-3">
                                                    <label for="">Giới thiệu chung *</label>
                                                    <textarea name="description" class="form-control" rows="3">@if(!empty($seeker)) {{$seeker->description}} @endif </textarea>
                                                    <small class="val_info_description text-danger"></small>
                                                    <small class="text-red"><i>Gợi ý: Giới thiệu số năm kinh nghiệm làm việc và mục tiêu của bản thân</i></small>
                                               </div>
                                                <div class="d-flex mt-3 flex-row-reverse">
                                                    <div class="hide-button btn btn-warning">Hủy</div>
                                                    <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Lưu</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="info_pro">
                                        @php 
                                        echo !empty($seeker->name) ? '<div class="mt-3"> <b>Họ tên:</b> '.$seeker->name.' </div>' : '';
                                        echo !empty($seeker->address) ? '<div style="margin-top: 5px;"> <b>Địa chỉ:</b> '.$seeker->address.' </div>' : '';
                                        echo !empty($seeker->phone) ? '<div style="margin-top: 5px;"> <b>Số điện thoại:</b> +'.$seeker->phone.' </div>' : '';
                                        echo !empty($seeker->email) ? '<div style="margin-top: 5px;"> <b>Email:</b> '.$seeker->email.' </div>' : '';
                                        echo !empty($seeker->major_id) ? '<div style="margin-top: 5px;"> <b>Chuyên ngành:</b> '.$seeker->major->name.' </div>' : '';
                                        echo !empty($seeker->description) ? '<div style="margin-top: 5px;"> <b>Giới thiệu chung:</b> '.$seeker->description.' </div>' : '';
                                        @endphp
                                    </div>
                                </div>

                                @if(!empty($seeker))
                                <div class="experiences mb-3">
                                    @include('client.profile.experiences')
                                </div>

                                <div class="skills mb-3">
                                    @include('client.profile.skills')
                                </div>

                                <div class="educations mb-3">
                                    @include('client.profile.educations')
                                </div>

                                <div class="certificates mb-3">
                                    {{-- @include('client.profile.certificates') --}}
                                </div>
                                @else
                                <small><i>*Vui lòng tạo thông tin cá nhân trước !</i></small>
                                @endif
                            </div>
                            @if(!empty($seeker))
                            <div class="mt-5 text-center">
                                <a href="" class="btn btn-primary">Tạo file CV</a>
                                
                            </div>
                            @endif
                        </div>
                    </div>
                    <small class="text-red"><i>Ghi chú: Các trường có * là bắt buộc nhập</i></small>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    @parent
    <script src="{{asset('js/client/create_cv.js')}}"></script>
    <script>
        $('.removeEdu').click(function (e) {
            e.preventDefault();
            var url = $('.delEdu').attr('action');
            var id = $(this).data('id-edu');
            var data = {
                id: id,
                "_token": $('meta[name="csrf-token"]').attr('content'),
            }
            Swal.fire({
                icon: 'warning',
                title: 'Bạn có chắc chắn muốn xóa ?',
                text: 'Bấm không nếu bạn đổi ý!',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: 'Xóa',
                confirmButtonColor: '#C46F01',
                cancelButtonText: 'Không'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: "get",
                        data: data,
                        success: function(results) {
                            if (results.is_check === true) {
                                Swal.fire({
                                    title: results.success,
                                    icon: 'success',
                                    type: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                }, setTimeout(function() {
                                
                                }, 500)).then(function() {
                                    $('.edu_div'+id).remove();
                                });
                            } else {
                                Swal.fire({
                                    title: results.error,
                                    type: 'error',
                                    icon: 'error',
                                    timer: 1500
                                });
                            }
                        }
                    });
                }
            });
        });

        $('.removeCer').click(function (e) {
            e.preventDefault();
            var url = $('.delCer').attr('action');
            var id = $(this).data('id-cer');
            var data = {
                id: id,
                "_token": $('meta[name="csrf-token"]').attr('content'),
            }
            Swal.fire({
                icon: 'warning',
                title: 'Bạn có chắc chắn muốn xóa ?',
                text: 'Bấm không nếu bạn đổi ý!',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: 'Xóa',
                confirmButtonColor: '#C46F01',
                cancelButtonText: 'Không'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: "get",
                        data: data,
                        success: function(results) {
                            if (results.is_check === true) {
                                Swal.fire({
                                    title: results.success,
                                    icon: 'success',
                                    type: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                }, setTimeout(function() {
                                
                                }, 500)).then(function() {
                                    $('.cer_div'+id).remove();
                                });
                            } else {
                                Swal.fire({
                                    title: results.error,
                                    type: 'error',
                                    icon: 'error',
                                    timer: 1500
                                });
                            }
                        }
                    });
                }
            });
        });
    
        function EditFormId(id) {
        $('#EditHide'+id).hide(300);
        $("#EditForm"+id).toggle(300);
        $('#form-border'+id).addClass('border-none');
        $('#btnForm'+id).hide();

        $('.hide-button-exp'+id).click(function () {
            $("#EditForm"+id).hide(300);
            $('#EditHide'+id).show();
            $('#btnForm'+id).show();
            $('#form-border'+id).removeClass('border-none');
        })
    }

    function EditFormEduEduId(id) {
        $('#EditHideEdu'+id).hide(300);
        $("#EditFormEdu"+id).toggle(300);
        $('#form-border-edu'+id).addClass('border-none');
        $('#btnFormEdu'+id).hide();

        $('.hide-button-exp'+id).click(function () {
            $("#EditFormEdu"+id).hide(300);
            $('#EditHideEdu'+id).show();
            $('#btnFormEdu'+id).show();
            $('#form-border-edu'+id).removeClass('border-none');
        })
    }

    function EditFormCerId(id) {
        $('#EditHideCer'+id).hide(300);
        $("#EditFormCer"+id).toggle(300);
        $('#form-border-cer'+id).addClass('border-none');
        $('#btnFormCer'+id).hide();

        $('.hide-button-cer'+id).click(function () {
            $("#EditFormCer"+id).hide(300);
            $('#EditHideCer'+id).show();
            $('#btnFormCer'+id).show();
            $('#form-border-cer'+id).removeClass('border-none');
        })
    }
    </script>
@endsection
