@extends('admin.layout.app')
@section('style')
    @parent
    {{-- @include('company.layout.style') --}}
    {{-- liên quan select 2 --}}
    <link href="{{asset('assets/client-bower/css/style.css')}}" rel="stylesheet">

    {{-- hết liên quan --}}
    <link rel="stylesheet" href="{{ asset('assets/admin-bower/plugins/summernote/summernote-bs5.min.css') }}">
    <style>
        .card {
            height: auto;
        }

        textarea .description ul {
            list-style: disc !important;
            list-style-position: inside !important;
        }

        textarea .description ol {
            list-style: decimal !important;
            list-style-position: inside !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <!-- Ls widget -->
            <div class="ls-widget">
                <div class="tabs-box">
                    <div class="widget-title">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="widget-content">
                        <form class="default-form" action="{{route('admin.post.update', $post)}}" method="post"  id="formPost">
                            @method('PUT')
                            @csrf
                            <input type="number" hidden name="admin_edit_id" value="{{auth('admin')->user()->id}}">
                            <div class="row">
                                <div class="column col-12">
                                    <!--Accordian Box-->
                                    <ul class="accordion-box" style="border-radius: 0px">
                                        <!--Block-->
                                        <li class="accordion block active-block">
                                            @if ($errors->has('title') || $errors->has('amount') || $errors->has('min_salary') || $errors->has('max_salary') || $errors->has('address'))
                                                <div class="acc-btn active">Thông tin chung <p class="text-danger">(Chưa hoàn thành)</p> <span
                                                class="icon flaticon-add"></span></div>    
                                            @else
                                                <div class="acc-btn active">Thông tin chung <span
                                                class="icon flaticon-add"></span></div>
                                            @endif
                                            <div class="acc-content current">
                                                <div class="content row">
                                                    <div class="form-group col-lg-12 col-md-12">
                                                        <label>Tiêu đề tin tuyển dụng</label>
                                                        <input type="text" name="title" value="{{old('title')? old('title'): $post->title}}"
                                                            placeholder="Tiêu đề">
                                                        @error('title')
                                                            <div class="text-danger pl-4">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-6 col-md-12">
                                                        <label>Chuyên ngành</label>
                                                        <select data-placeholder="Chọn ... " class="chosen-select"
                                                            name="major_id">
                                                            @foreach ($majors as $value)
                                                                <option
                                                                        {{ old('major_id') ? (old('major_id') == $value['id'] ? 'selected' : '') : ($post->major_id == $value['id'] ? 'selected' : '') }} 
                                                                    value="{{ $value->id }}">{{ $value->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-6 col-md-12">
                                                        <label>Bằng cấp</label>
                                                        <select data-placeholder="Chọn ... " class="chosen-select" name="degree_id">
                                                            @foreach ($degrees as $value )
                                                                <option 
                                                                    value="{{$value->id}}" 
                                                                    {{ old('degree_id') ? (old('degree_id') == $value['id'] ? 'selected' : '') : ($post->degree_id == $value['id'] ? 'selected' : '') }}
                                                                >
                                                                    {{$value->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-3 col-md-12">
                                                        <label>Kinh nghiệm</label>
                                                        <select class="chosen-select" name="time_exp_id">
                                                            @foreach ($time_exp as $value)
                                                                <option
                                                                    {{ old('time_exp_id') ? (old('time_exp_id') == $value['id'] ? 'selected' : '') : ($post->time_exp_id == $value['id'] ? 'selected' : '') }}
                                                                    value="{{ $value['id'] }}">{{ $value['name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group col-lg-3 col-md-12">
                                                        <label>Loại công việc</label>
                                                        <select class="chosen-select" name="type_work">
                                                            @foreach (config('custom.type_work') as $value)
                                                                <option
                                                                    {{ old('type_work') ? (old('type_work') == $value['id'] ? 'selected' : '') : ($post->type_work == $value['id'] ? 'selected' : '') }}
                                                                    value="{{ $value['id'] }}">{{ $value['name'] }}
                                                                   
                                                                </option>
                                                            @endforeach
                                                                {{-- <option value="0" {{old('type_work') == 0|| $post->type_work == 0 ? 'selected' : '' }}>Thực tập</option>
                                                                <option value="1" {{old('type_work') == 1|| $post->type_work == 1 ? 'selected' : '' }}>Bán thời gian</option>
                                                                <option value="2" {{old('type_work') == 2|| $post->type_work == 2 ? 'selected' : '' }}>Toàn thời gian</option>
                                                                <option value="3" {{old('type_work') == 3|| $post->type_work == 3 ? 'selected' : '' }}>Tại nhà</option> --}}
                                                        </select>
                                                        
                                                    </div>
                                                   
                                                    <div class="form-group col-lg-3 col-md-12">
                                                        <label>Cấp bậc</label>
                                                        <select class="chosen-select" name="level">
                                                            @foreach (config('custom.level') as $value)
                                                                <option  
                                                                    {{ old('level') != null ? (old('level') == $value['id'] ? 'selected' : '') : ($post->level == $value['id'] ? 'selected' : '') }}
                                                                    value="{{ $value['id'] }}">{{ $value['name'] }}
                                                                </option>
                                                            @endforeach
                                                            {{-- <option value="0" {{old('level') == 0|| $post->level == 0 ? 'selected' : '' }}>Nhân viên</option>
                                                            <option value="1" {{old('level') == 1|| $post->level== 1 ? 'selected' : '' }}>Trưởng nhóm</option>
                                                            <option value="2" {{old('level') == 2|| $post->level == 2 ? 'selected' : '' }}>Trưởng Phòng</option>
                                                            <option value="3" {{old('level') == 3|| $post->level == 3 ? 'selected' : '' }}>Giám đốc</option> --}}
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-3 col-md-12">
                                                        <label>Số lượng</label>
                                                        <input type="number" name="amount"
                                                            value="{{old('amount')? old('amount'):  $post->amount }}">
                                                        @error('amount')
                                                            <div class="text-danger pl-4">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-6 col-md-12">
                                                        <label>Lương nhỏ nhất (VNĐ)</label></label>
                                                        <input type="text" name="min_salary" value="{{old('min_salary')? old('min_salary'):$post->min_salary}}">
                                                        @error('min_salary')
                                                            <div class="text-danger pl-4">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-6 col-md-12">
                                                        <label>Lương lớn nhất (VNĐ)</label>
                                                        <input type="text" name="max_salary" value="{{old('max_salary')? old('max_salary'):$post->max_salary}}">
                                                        @error('max_salary')
                                                            <div class="text-danger pl-4">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-3 col-md-12">
                                                        <label>Khu vực</label>
                                                        <select class="chosen-select" name="area">
                                                           @foreach ($dataProvinces as  $value)
                                                                <option value="{{ $value['Id']}}" 
                                                                {{ old('area') != null ? (old('area') == $value['Id'] ? 'selected' : '') : ($post->area == $value['Id'] ? 'selected' : '') }}
                                                                >
                                                                    {{ $value['Ten']}}
                                                                </option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-9 col-md-12">
                                                        <label>Địa chỉ</label>
                                                        <input type="text" name="address" placeholder=""
                                                            value="{{ old('address')? old('address'): $post->address }}">
                                                        @error('address')
                                                            <div class="text-danger pl-4">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                        </li>
                                        <li class="accordion block">
                                            @if ($errors->has('description') || $errors->has('requirement') || $errors->has('benefits') || $errors->has('skill'))
                                                <div class="acc-btn "> Nội dung tuyển dụng chi tiết <p class="text-danger">(Chưa hoàn thành)</p> <span
                                                class="icon flaticon-add"></span></div>
                                            @else
                                                <div class="acc-btn"> Nội dung tuyển dụng chi tiết <span
                                                class="icon flaticon-add"></span></div>
                                            @endif
                                            <div class="acc-content">
                                                <div class="content row">
                                                    <div class="form-group col-lg-12 col-md-12">
                                                        <label>Mô tả công việc</label>
                                                        <textarea class="description" name="description" placeholder="">{{ $post->description }}</textarea>
                                                        @error('description')
                                                            <div class="text-danger pl-4">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-lg-12 col-md-12">
                                                        <label>Yêu cầu công việc</label>
                                                        <textarea class="description" name="requirement" placeholder="">{{ $post->requirement }}</textarea>
                                                        @error('requirement')
                                                            <div class="text-danger pl-4">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12 col-md-12">
                                                        <label>Kĩ năng liên quan</label>
                                                        <select data-placeholder="Chọn ... " class="chosen-select"
                                                            name="skill[]" multiple>
                                                            @foreach ($skills as $value)
                                                                <option {{in_array($value['id'],$skillActive) ? 'selected' : ''}}  value="{{ $value['id'] }}">{{ $value['name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('skill')
                                                            <div class="text-danger pl-4">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    {{-- language --}}
                                                    <div class="form-group col-lg-12 col-md-12">
                                                        <label>Yêu cầu ngôn ngữ</label>
                                                        <table width="100%" class="table-bordered table-sm table">
                                                            <thead class="text-uppercase table-light">
                                                            <tr>
                                                                <th class="text-center">Ngoại ngữ</th>
                                                                <th class="text-center">Trình độ ngoại ngữ</th>
                                                                <th class="text-center">Delete</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="languagedetail_tr">
                                                            @foreach($job_post_language as $item)
                                                                <tr>
                                                                    <td>
                                                                        <select data-placeholder="Chọn ... " class="chosen-select" name="language_id[]">
                                                                            @foreach ($languages as $value )
                                                                                <option value="{{$value->id}}" 
                                                                                    {{ old('language_id') ? (old('language_id') == $value['id'] ? 'selected' : '') : ($item->language_id == $value['id'] ? 'selected' : '') }}
                                                                                    {{-- {{ old('language_id') == $value->id ? 'selected' : '' }} --}}
                                                                                    >
                                                                                    {{$value->name}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <select data-placeholder="Chọn ... " class="chosen-select" name="language_level[]">
                                                                            @foreach (config('custom.language_level') as $value)
                                                                                <option value="{{ $value['id']}}" 
                                                                                {{ old('language_level') ? (old('language_level') == $value['id'] ? 'selected' : '') : ($item->level == $value['id'] ? 'selected' : '') }}
                                                                                {{-- {{ old('language_level') == $value['id'] ? 'selected' : '' }} --}}
                                                                                >{{ $value['name']}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        
                                                                    </td>
                                                                    
                                                                    <td class="text-center">
                                                                        <div class="btn btn-primary delete">
                                                                            <i class="fa-solid fa-trash"></i>
                                                                        </div>
                                                                        
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                
                                                            </tbody>
                                                        </table>
                                                        <div class="btn btn-primary" id="plus-language" style="max-width: 250px">
                                                            <i class="fa-solid fa-plus"></i>Thêm ngôn ngữ   
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- end_language --}}
                                                    <div class="form-group col-lg-12 col-md-12">
                                                        <label>Quyền lợi</label>
                                                        <textarea class="description" name="benefits" placeholder="">{{ $post->benefits }}</textarea>
                                                        @error('benefits')
                                                            <div class="text-danger pl-4">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 text-right clearfix">
                                    <button type="submit" class="theme-btn btn-style-one float-end"
                                        id="buttonSubmit">Sửa</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @parent
    {{-- @include('company.layout.script') --}}
    {{-- liên quan sellect 2 --}}
    {{-- <script src="{{asset('assets/client-bower/js/chosen.min.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/appear.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/rellax.min.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/script.js')}}"></script>
    <script src="{!! asset('assets/admin-bower/plugins/select2-master/select2.full.min.js') !!}"></script>
    <script src="{{asset('assets/client-bower/js/jquery.js')}}"></script> --}}

    {{-- hết liên quan select 2 --}}
    {{-- cop hết bên scrip company sang cho đồng bộ --}}
    <script src="{{asset('assets/client-bower/js/jquery.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/chosen.min.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/jquery-ui.min.js')}}"></script>
    
    <script src="{{asset('assets/client-bower/js/jquery.fancybox.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/jquery.modal.min.js')}}"></script>

    <script src="{{asset('assets/client-bower/js/appear.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/ScrollMagic.min.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/rellax.min.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/owl.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/wow.js')}}"></script>

    <script src="{{asset('assets/client-bower/js/mmenu.polyfills.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/mmenu.js')}}"></script>
    <script src="{{asset('assets/client-bower/js/script.js')}}"></script>
    <script src="{!! asset('assets/admin-bower/plugins/select2-master/select2.full.min.js') !!}"></script>
    <script src="{{ asset('assets/admin-bower/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/admin-bower/plugins/toastr/toastr.min.js') }}"></script>


    @include('admin.layout.toastr')
    <script src="{{ asset('assets/admin-bower/plugins/summernote/summernote-bs4.min.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            $('.description').summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', [13]],
                    ['para', ['ul', 'ol']],
                ],
                height: 150,
            });
            $(document).on('click', '#plus-language', function () {
                console.log('khôi');
                $('#languagedetail_tr').append(addLanguage());
            });
            $(document).on('click', '.delete', function () {
                var rowToRemove = $(this).closest('tr');
                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: 'Bạn sẽ không thể khôi phục dữ liệu này!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Có, xóa!',
                    cancelButtonText: 'Không, hủy bỏ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('Người dùng đã xác nhận');
                        rowToRemove.remove();
                        Swal.fire(
                            'Đã xóa!',
                            'Dữ liệu của bạn đã được xóa.',
                            'success'
                        );
                    } else {
                        console.log('Người dùng đã hủy bỏ');
                    }
                });
            });

        });
        function addLanguage() {
            var html = `<tr>
                    <td>
                        <select data-placeholder="Chọn ... " class="chosen-select" name="language_id[]">
                            @foreach ($languages as $value )
                                <option value="{{$value->id}}" {{ old('language_id') == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select data-placeholder="Chọn ... " class="chosen-select" name="language_level[]">
                            @foreach (config('custom.language_level') as $value)
                                <option value="{{ $value['id']}}" {{ old('language_level') == $value['id'] ? 'selected' : '' }}>{{ $value['name']}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="text-center">
                        <div class="btn btn-primary delete">
                            <i class="fa-solid fa-trash"></i>
                        </div>
                    </td>
                </tr>`;
            return html;
        }
    </script>
@endsection
