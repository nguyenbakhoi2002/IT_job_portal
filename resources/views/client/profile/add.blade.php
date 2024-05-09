@extends('client.layout.app')
@section('style')
<style> 
    .widget-title h1{
        color: #f7941d;
    }
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
        /* border-color:red; */

    }
    /* lỗi modal bs5 */
    

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    .main-menu .navigation .dropdown a{
        text-decoration:none ;
    }
    .btn-themmoi{
        cursor: pointer; 
        margin-left:12px; 
        color: #f7941d; 
        border: 1px solid #f7941d;
        padding: 4px 8px;
        border-radius:10px; 

    }
    .btn-question{
        cursor: pointer; 
        /* margin-left:8px;  */
        color: #f7941d; 
        border: 1px solid #f7941d;
        padding: 4px 10px;
        border-radius:50%; 
    }
    .cv-item{
        background-color: #fff;
        padding: 20px;
    }
    
</style>
@parent

@endsection
@section('title')
    BaKhoi|Profile
@endsection
@section('content')

    <section class="ls-section mt-5">
        
        <div class="auto-container" >
            
            <div class="row">

                <div class="col-lg-12" style="margin-top: 90px, background-color: #e8effd">
                    <!-- CV Manager Widget -->
                    <div class="cv-manager-widget ls-widget " style="background-color: #e8effd">
                        
                        <div class="widget-title " 
                        style="display: flex;
                            align-items: center;
                            justify-content: center;">
                            <h1>Quản lý profile</h1>
                        </div>
                        <div class="widget-content">
                            {{-- <div class="title">
                                <h3>Tạo CV trên hệ thống, tăng cơ hội nhận được việc làm !</h3>
                                <p class="mt-3">
                                    Tạo CV tại hệ thống chúng tôi sẽ tăng <strong>99%</strong> tìm được việc,
                                    hãy tạo ngay cv cho mình nhé.
                                </p>
                            </div> --}}

                            <div class="create-cv">
                                <div class="info mb-3 cv-item">
                                    <form id="create_info" action="{{route('updateCv.updateInfo')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        {{-- <div class="form-group">
                                            <div class="d-flex justify-content-between border-bot">
                                                <div class="font-weight-bold h4" >Tiêu đề hồ sơ</div>
                                                <div id="block-p" style="cursor: pointer;"><i class="fas fa-edit"></i></div>
                                            </div>
                                            <div id="desc" class="mt-3 form" style="display: none">
                                                @if(!empty($seeker)) <input type="hidden" name="id" value="{{$seeker->id}}"> @endif
                                                <div class="form-group">
                                                    <label for="">Họ và tên *</label>
                                                    <input type="text" name="name" class="form-control" @if(!empty($seeker)) value="{{$seeker->name}}" @endif>
                                                        <small class="val_info_name text-danger pl-4"></small>
                                                </div>
                                            </div>
                                        </div>     --}}
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between border-bot">
                                                <div class="font-weight-bold h4" ><i class="fa-regular fa-user"></i> Thông tin cơ bản</div>
                                                <div class="d-flex justify-content-between align-items-center"  >
                                                    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" 
                                                        style="left: 50%;
                                                        transform: translateX(-50%);"
                                                    >
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalToggleLabel"><i class="fa-solid fa-lightbulb"></i> Để CV không chỉ Hay mà còn Đẹp trong mắt Nhà tuyển dụng</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <div class="modal-body">
                                                                Thông tin cá nhân:<br>
                                        - Hãy sử dụng địa chỉ email chuyên nghiệp phù hợp dùng cho công việc, hạn chế sử dụng email khó đọc hoặc dùng nhiều ký tự đặc biệt.<br>
                                        - Ảnh đại diện trên hồ sơ cũng như lần đầu tiên tạo ấn tượng với Nhà tuyển dụng. Nên chọn ảnh đại diện chụp từ vai trở lên, có ánh sáng tốt, không gian hạn chế nhiều chi tiết, nên mặc trang phục công sở.<br>
                                        - Kiểm tra thông tin cá nhân để tránh trường hợp Nhà Tuyển Dụng không liên hệ được
                                                          </div>
                                                          
                                                        </div>
                                                      </div>
                                                      </div>
                                                      <a class="btn-question" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><i class="fa-solid fa-question"></i></a>
                                                <div id="block-p" style="cursor: pointer; margin-left:12px"><i class="fas fa-edit"></i></div>
                                                    
                                                </div>
                                            </div>
                                            <div id="desc" class="mt-3 form" style="display: none">
                                                @if(!empty($seeker)) <input type="hidden" name="id" value="{{$seeker->id}}"> @endif
                                                <input type="hidden" name="candidate_id" value="{{$seeker->candidate_id}}" >
                                                <div class="form-group">
                                                    <label for="">Họ và tên *</label>
                                                    <input type="text" name="name" class="form-control" @if(!empty($seeker)) value="{{$seeker->name}}" @endif>
                                                    <small class="val_info_name text-danger pl-4"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Ngày sinh</label>
                                                    <input type="date" name="date_of_birth" class="form-control" @if(!empty($seeker)) value="{{$seeker->date_of_birth}}" @endif>
                                                    {{-- <small class="val_info_name text-danger pl-4"></small> --}}
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Giới tính</label>
                                                    <input type="text" name="gender" class="form-control" @if(!empty($seeker)) value="{{$seeker->gender}}" @endif>
                                                    {{-- <small class="val_info_name text-danger pl-4"></small> --}}
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Link liên kết</label>
                                                    <input type="text" name="link" class="form-control" @if(!empty($seeker)) value="{{$seeker->link}}" @endif>
                                                    {{-- <small class="val_info_name text-danger pl-4"></small> --}}
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label class="form-label w-100">Ảnh</label>
                                                    <img id="image" @if(!empty($seeker)) src="{{ $seeker->image?asset('uploads/images/candidate/'. $seeker->image):asset('uploads/images/candidate/logo_default_candidate.jpg') }}" @else src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" @endif alt="your image"
                                                        style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                                                    <input name="hinhanh_upload_logo" type="file" id="img">
                                                    <small class="form-text text-muted">Chọn ảnh kích thước nhỏ hơn 5mb</small>
                                                    <small class="val_info_image text-danger pl-4"></small>
                                                    <input type="text" @if(!empty($seeker)) ? value="{{ $seeker->image }}" : value="" @endif hidden name="hinhanh_upload_logo_hd">

                                                  </div>
                                                  <div class="form-group mt-3">
                                                    <label for="">Địa chỉ *</label>
                                                    <input type="text" name="address" class="form-control" @if(!empty($seeker)) value="{{$seeker->address}}" @endif>
                                                    <small class="val_info_address text-danger pl-4"></small>
                                                    {{-- @error('address')
                                                    <small class="text-danger">{{$message}}</small>
                                                    @enderror --}}
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="">Số điện thoại *</label>
                                                    <input type="number" name="phone" class="form-control" @if(!empty($seeker)) value="{{$seeker->phone}}" @endif>
                                                    <small class="val_info_phone text-danger pl-4"></small>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="">Email *</label>
                                                    <input type="email" name="email" class="form-control" @if(!empty($seeker)) value="{{$seeker->email}}" @endif>
                                                    <small class="val_info_email text-danger pl-4"></small>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="">Tiêu đề hồ sơ *</label>
                                                    <input type="text" name="title" class="form-control" @if(!empty($seeker)) value="{{$seeker->title}}" @endif>
                                                    <small class="val_info_title text-danger pl-4"></small>
                                                </div>
                                                
                                               <div class="form-group mt-3">
                                                    <label for="">Mục tiêu nghề nghiệp *</label>
                                                    <textarea name="objective" class="form-control" rows="3">@if(!empty($seeker)) {{$seeker->objective}} @endif </textarea>
                                                    <small class="val_info_objective text-danger pl-4"></small>
                                                    <small class="text-red"><i>Gợi ý: mô tả các mục tiêu ngắn hạn và dài hạn của bạn</i></small>
                                               </div>
                                                <div class="d-flex mt-3 flex-row-reverse">
                                                    <div class="hide-button btn btn-warning">Hủy</div>
                                                    <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Lưu</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    
                                    <div class="info_pro">

                                        @if (!empty($seeker->image))
                                            <div class="mt-3"> <img width="100px" height="100px"  src="{{asset('uploads/images/candidate/'. $seeker->image)}}" alt=""> </div>
                                        {{-- @elseif(!empty($seeker->candidate->user_image))
                                            <div class="mt-3"> <img width="100px" src="{{asset('uploads/images/candidate/'. $seeker->candidate->user_image)}}" alt=""> </div> --}}
                                        @else
                                            <div class="mt-3"> <img width="100px" src="{{asset('uploads/images/candidate/logo_default_candidate.jpg')}}" alt=""> </div>
                                        @endif
                                        @php 
                                        // echo !empty($seeker->logo) ? '<div class="mt-3"> <img width="100px" src="{{asset('uploads/images/company/'. $item->logo)}}" alt=""> </div>' : '';

                                        
                                        echo !empty($seeker->name) ? '<div class="mt-3"> <b>Họ tên:</b> '.$seeker->name.' </div>' : '<div class="mt-3"> <b>Họ tên:</b>  </div>';
                                        @endphp
                                        <div class="mt-3">
                                            @if(!empty($seeker->date_of_birth))
                                                <b>Ngày sinh:</b> {{ \Carbon\Carbon::parse($seeker->date_of_birth)->format('d/m/Y') }}
                                            @else
                                                <b>Ngày sinh:</b> 
                                            @endif
                                        </div>
                                        @php
                                        echo !empty($seeker->gender) ? '<div class="mt-3"> <b>Giới tính:</b> '.$seeker->gender.' </div>' : '<div class="mt-3"> <b>Giới tính</b>:</b>  </div>';
                                        echo !empty($seeker->address) ? '<div style="margin-top: 5px;"> <b>Địa chỉ:</b> '.$seeker->address.' </div>' : '<div style="margin-top: 5px;"> <b>Địa chỉ:</b>  </div>';
                                        echo !empty($seeker->phone) ? '<div style="margin-top: 5px;"> <b>Số điện thoại:</b> +'.$seeker->phone.' </div>' : '<div style="margin-top: 5px;"> <b>Số điện thoại:</b>  </div>';
                                        echo !empty($seeker->email) ? '<div style="margin-top: 5px;"> <b>Email:</b> '.$seeker->email.' </div>' : '<div style="margin-top: 5px;"> <b>Email:</b>  </div>';
                                        echo !empty($seeker->link) ? '<div style="margin-top: 5px;"> <b>Link:</b> '.$seeker->link.' </div>' : '<div style="margin-top: 5px;"> <b>Link:</b>  </div>';
                                        echo !empty($seeker->title) ? '<div style="margin-top: 5px;"> <b>Tiêu đề hồ sơ:</b> '.$seeker->title.' </div>' : '<div style="margin-top: 5px;"> <b>Tiêu đề hồ sơ:</b> </div>';
                                        // echo !empty($seeker->major_id) ? '<div style="margin-top: 5px;"> <b>Chuyên ngành:</b> '.$seeker->major->name.' </div>' : '<div style="margin-top: 5px;"> <b>Chuyên ngành:</b> </div>';
                                        echo !empty($seeker->objective) ? '<div style="margin-top: 5px;"> <b>Mục tiêu nghề nghiệp:</b> '.$seeker->objective.' </div>' : '<div style="margin-top: 5px;"> <b>Mục tiêu nghề nghiệp:</b></div>';
                                        @endphp
                                    </div>
                                </div>

                                @if(!empty($seeker))
                                <div class="experiences mb-3 cv-item">
                                    @include('client.profile.experiences')
                                </div>
                                <div class="projects mb-3 cv-item">
                                    @include('client.profile.projects')
                                </div>
                                <div class="skills mb-3 cv-item">
                                    @include('client.profile.skills')
                                </div>

                                <div class="educations mb-3 cv-item">
                                    @include('client.profile.educations')
                                </div>

                                <div class="languages mb-3 cv-item">
                                    @include('client.profile.languages')
                                </div>
                                <div class="certificates mb-3 cv-item">
                                    {{-- @include('client.profile.certificates') --}}
                                </div>
                                @else
                                <small><i>*Vui lòng tạo thông tin cơ bản trước !</i></small>
                                @endif
                            </div>
                            @if(!empty($seeker))
                            <div class="my-5 text-center">
                                <a href="{{route('profilePreview', $seeker)}}" class="btn btn-primary me-5">Xem trước Profile</a>
                                <a href="{{route('exportProfile', $seeker)}}" class="btn btn-primary">Tải xuống dạng PDF</a>
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
    {{-- <script src="{{asset('js/client/create_cv.js')}}"></script> --}}
    <script>
        

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
    
    //ẩn hiện form hiển thị, sửa, xóa
    //infor
    function EditFormInfo() {
        $('#EditHidePj'+id).hide(300);
        $("#EditFormPj"+id).toggle(300);
        $('#form-border-pj'+id).addClass('border-none');
        $('#btnFormPj'+id).hide();

        $('.hide-button-exp'+id).click(function () {
            $("#EditFormPj"+id).hide(300);
            $('#EditHidePj'+id).show();
            $('#btnFormPj'+id).show();
            $('#form-border-pj'+id).removeClass('border-none');
        })
    }

    //experience
    function EditFormId(id) {
        //ẩn form hiển thị
        $('#EditHide'+id).hide(300);
        //hiện form sửa
        $("#EditForm"+id).toggle(300);
        // ẩn viền form hiển thị là cái dòng kẻ border ở dưới
        $('#form-border'+id).addClass('border-none');
        //ẩn nút sửa xóa
        $('#btnForm'+id).hide();

        // click vào nút hủy
        $('.hide-button-exp'+id).click(function () {
            $('#EditHide'+id).show();
            $("#EditForm"+id).hide(300);
            $('#btnForm'+id).show();
            $('#form-border'+id).removeClass('border-none');
        })
    }
    //project
    function EditFormProjectId(id) {
        $('#EditHidePj'+id).hide(300);
        $("#EditFormPj"+id).toggle(300);
        $('#form-border-pj'+id).addClass('border-none');
        $('#btnFormPj'+id).hide();

        $('.hide-button-pj'+id).click(function () {
            $("#EditFormPj"+id).hide(300);
            $('#EditHidePj'+id).show();
            $('#btnFormPj'+id).show();
            $('#form-border-pj'+id).removeClass('border-none');
        })
    }
    //education
    function EditFormEduEduId(id) {
        $('#EditHideEdu'+id).hide(300);
        $("#EditFormEdu"+id).toggle(300);
        $('#form-border-edu'+id).addClass('border-none');
        $('#btnFormEdu'+id).hide();

        $('.hide-button-edu'+id).click(function () {
            $("#EditFormEdu"+id).hide(300);
            $('#EditHideEdu'+id).show();
            $('#btnFormEdu'+id).show();
            $('#form-border-edu'+id).removeClass('border-none');
        })
    }
    //language
    function EditFormLanguageId(id) {
        $('#EditHideLg'+id).hide(300);
        $("#EditFormLg"+id).toggle(300);
        $('#form-border-lg'+id).addClass('border-none');
        $('#btnFormLg'+id).hide();

        $('.hide-button-lg'+id).click(function () {
            $("#EditFormLg"+id).hide(300);
            $('#EditHideLg'+id).show();
            $('#btnFormLg'+id).show();
            $('#form-border-lg'+id).removeClass('border-none');
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

    // modal
    document.getElementById("btn-modal-exp").addEventListener("click", function() {
        var modal = new bootstrap.Modal(document.getElementById('modal-exp'));
        modal.show();
    });
    // document.getElementById("btn-modal-cer").addEventListener("click", function() {
    //     var modal = new bootstrap.Modal(document.getElementById('modal-cer'));
    //     modal.show();
    // });
    document.getElementById("btn-modal-edu").addEventListener("click", function() {
        var modal = new bootstrap.Modal(document.getElementById('modal-edu'));
        modal.show();
    });
    document.getElementById("btn-modal-pj").addEventListener("click", function() {
        var modal = new bootstrap.Modal(document.getElementById('modal-pj'));
        modal.show();
    });
    document.getElementById("btn-modal-sk").addEventListener("click", function() {
        var modal = new bootstrap.Modal(document.getElementById('modal-sk'));
        modal.show();
    });
    document.getElementById("btn-modal-lg").addEventListener("click", function() {
        var modal = new bootstrap.Modal(document.getElementById('modal-lg'));
        modal.show();
    });
    </script>
@endsection
