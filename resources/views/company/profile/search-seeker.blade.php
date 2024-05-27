@extends('company.layout.app')
@section('title')
{{$title}}
@endsection
@section('content')

{{-- @if ($company->status == 1) --}}
{{-- <section class="page-title style-two"> --}}
    <div class="auto-container mb-0" >
    </div>
  {{-- </section> --}}
  <!--End Page Title-->

  <!-- Listing Section -->
  <section class="ls-section pt-0" >
    <div class="auto-container">
      <div class="filters-backdrop"></div>

      <div class="row">
        <!-- Content Column -->
        <div class="content-column col-lg-12">
          <div class="ls-outer">
            <!-- ls Switcher -->
            <form method="" action="">

            <div class="ls-switcher">
              <div class="showing-result">
                <div class="top-filters justify-content-center">
                    {{-- <div class="row"> --}}
                    
                        <div class="form-group mt-3">
                          <input style="padding: 13px; border: 2px solid #e6e8ed;border-radius: 10px;"
                          type="text" class="search_address form-control" id="search-text" name="search_address" placeholder="Tìm theo địa chỉ">
                        </div>
      
                        <div class="form-group mt-3 ">
                          <select name="major" style="padding: 13px; border: 2px solid #e6e8ed;border-radius: 10px;" class="selectMajor select2">
                            <option value="">Chọn chuyên ngành</option>
                            @foreach ($major as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group mt-3 ">
                          <select name="gender" style="padding: 13px; border: 2px solid #e6e8ed;border-radius: 10px;" class="selectGender select2">
                              <option value="">Giới Tính</option>
                              <option value="1"> Nam </option>
                              <option value="2"> Nữ </option>
                            </select>
                        </div>
                    {{-- </div>    --}}

                  <div class="form-group mt-3">
                    <select name="skill" style="padding: 13px; border: 2px solid #e6e8ed;border-radius: 10px;" class="selectSkill select2">
                        <option value="">Kỹ năng chính</option>
                        @foreach ($skill as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group mt-3">
                    <select name="experience"  style="padding: 13px; border: 2px solid #e6e8ed;border-radius: 10px;" class="selectYearKn select2">
                        <option value="">Năm kinh nghiệm</option>
                        @foreach ($time_exp as $value)
                            <option value="{{ $value['id']}}">{{ $value['name']}}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group mt-3">
                    <select name="type_degree" style="padding: 13px; border: 2px solid #e6e8ed;border-radius: 10px;" class="select_type_degree select2">
                        <option value="">Trình độ học vấn</option>
                        @foreach ($degree as $value)
                            <option value="{{ $value['id']}}">{{ $value['name']}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group mt-3">
                    <select name="language" style="padding: 13px; border: 2px solid #e6e8ed;border-radius: 10px;" class="select_type_degree select2">
                        <option value="">Ngoại ngữ</option>
                        @foreach ($language as $value)
                            <option value="{{ $value['id']}}">{{ $value['name']}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group mt-3">
                    <select name="language_level" style="padding: 13px; border: 2px solid #e6e8ed;border-radius: 10px;" class="select_type_degree select2">
                        <option value="">Trình độ ngoại ngữ</option>
                            <option value="1">Sơ cấp</option>
                            <option value="2">Trung cấp</option>
                            <option value="3">Cao cấp</option>
                            <option value="4">Bản ngữ</option>
                    </select>
                  </div>
                  {{-- <div class="form-group mt-3">
                    <select name="name_cty" class="select_name_cty select2">
                        <option value="">Từng làm tại công ty</option>
                        @foreach ($getNameCty as $item)
                            <option value="{{$item->company_name}}">{{ $item->company_name }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group mt-3">
                    <select name="name_edu" class="select_name_edu select2">
                        <option value="">Từng học tại trường</option>
                        @foreach ($nameEdu as $item)
                            <option value="{{$item->name_education}}">{{ $item->name_education }}</option>
                        @endforeach
                    </select>
                  </div> --}}
                  
                  {{-- <form class="mt-3" onsubmit="return false"> --}}
                    <div class="form-group " >
                        <span class="input-group-append">
                            <button
                                class="theme-btn btn-style-one  "
                                type="submit"
                                {{-- href="{{url("company/filter")}}" --}}
                                {{-- id="search_filter" --}}
                                >
                                Tìm kiếm
                            </button>
                        </span>
                    </div>

                </div>
              </div>
            </form>
            </div>
            <div class="viewList">
                <div class="row">
                    @foreach ($seekerProfile as $item)
                    
                    <div class="candidate-block-four col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                          @if(!empty($item->image))
                          <span class="thumb"><img src="{{ !empty($item->image) ? asset('uploads/images/candidate/'. $item->image) : asset('uploads/images/candidate/logo_default_candidate.jpg') }}" alt=""></span>
                          @else
                          <span class="thumb"><img src="{{ !empty($item->candidate->avatar) ? asset('uploads/images/candidate/'. $item->candidate->avatar) : asset('uploads/images/candidate/logo_default_candidate.jpg') }}" alt=""></span>
                          @endif
                          <h3 class="name"><a href="#">
                            @php
                            if(!empty($item->name)){
                              // $nameAt = $item->name;
                              // $count = mb_substr($nameAt, 0, 4,'UTF-8');
                              echo $item->name;
                            }else {
                              // $nameAt = $item->candidate->name;
                              // $count = mb_substr($nameAt, 0, 4,'UTF-8');
                              echo $item->candidate->name;
                            }
                            @endphp
                          </a></h3>
                          @if ($item->candidate->job_search_function   ==  0)
                            <span class="btn  btn-danger  rounded-pill my-3" style="min-height: 22px">Đang tắt</span>
                          @else
                            <span class="btn  btn-success rounded-pill my-3" style="min-height: 22px">Tìm việc gấp</span>
                          @endif
                         
                          <ul class="job-info justify-content-start">
                            <li style="min-height: 22px;-webkit-line-clamp: 1; -webkit-box-orient: vertical; display: -webkit-box; overflow: hidden;">
                              @if (!empty($item->address))
                              <span class="icon flaticon-map-locator"></span>{{$item->address}}
                              @elseif(!empty($item->candidate->address))
                              <span class="icon flaticon-map-locator"></span>{{$item->candidate->address}}
                              @endif         
                            </li>
                            {{-- học vấn --}}
                            <li style="min-height: 22px; padding-left:0px">
                              @foreach ($item->educations as $edu)
                                <i class="fa-solid fa-book-open me-2"></i>{{$edu->school_name}} - {{$edu->degree->name}}
                              @endforeach  
                            </li>
                            <?php
                                $totalExperience = $item->total_experience;
                                if ($totalExperience >= 1) {
                                    $formattedExperience = floor($totalExperience).' năm kinh nghiệm'; // Làm tròn xuống nếu lớn hơn hoặc bằng 1
                                } else {
                                    $formattedExperience = round($totalExperience * 12) . ' tháng kinh nghiệm'; // Chuyển đổi thành số tháng nếu nhỏ hơn 1
                                }
                            ?>
                            <li style="min-height: 22px; padding-left:0px">
                                <i class="fa-solid fa-hourglass me-2"></i>{{$formattedExperience}}
                            </li>
                          </ul>
                          {{-- <ul class="post-tags">
                            @if(count($item->skills) > 0)
                            @foreach ($item->skills as $sk)
                            <li><a href="javascript:void(0)">{{$sk->name}}</a></li>
                            @endforeach
                            <li><a href="javascript:void(0)">Xem thêm</a></li>
                            @else
                            <li><a href="javascript:void(0)">Chưa cập nhật</a></li>
                            @endif
                
                          </ul> --}}
                          
                          
                          <div class="d-flex justify-content-between">
                            @if (!empty($item->candidate_id))
                              <a href="{{route('company.profilePreview', $item)}}" target="_blank" class="theme-btn btn-style-three">Xem Chi Tiết</a>
                              {{-- @if (!in_array($item->candidate_id, auth('company')->user()->saved_seekers->pluck('id')->toArray())) --}}
                                  <a style="top: 0px; width: 40px; display:flex; justify-content:center;align-items:center" href="{{route('company.saveSeeker', $item->candidate_id)}}">
                                    <i class="fa-regular fa-bookmark" style="font-size: 20px;"></i>
                                  </a>
                              {{-- @else
                                      <a style="top: 0px; width: 40px; display:flex; justify-content:center;align-items:center" href="{{route('company.cancelSaveSeeker', $item->candidate_id)}}">
                                          <i class="fa-solid fa-bookmark" style="font-size: 20px;"></i>
                                      </a>
                              @endif --}}
                            @endif                                  
                
                          </div>
                        </div>
                      </div>
                    @endforeach
                  <!-- Candidate block Four -->
                </div>
                
                <!-- Pagination -->
                <nav class="ls-pagination">
                    {{$seekerProfile->appends(request()->all())->links()}} 
                </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- @elseif ($company->status == 2)
  <span class="text-warning" style="font-weight: 900">Bạn chưa đủ điều kiện xét duyệt, Vui lòng liên hệ admin</span>
  @else
  <span class="text-warning" style="font-weight: 900">Bạn cần chờ xét duyệt</span>

  @endif --}}
@endsection
@section('script')
  @parent
  {{-- <script src="{{asset('js/paginate.js')}}"></script> --}}
  <script>
    //$(function() {
    //     $(document).on("click",".pagination li a,#button_search", function(e) {
    //         e.preventDefault();
    //         var url=$(this).attr("href");
    //         var append = url.indexOf("?") == -1 ? "?" : "&";
    //         var finalURL = url + append + $("#search").serialize();
    //         window.history.pushState({}, null, finalURL);
    //         $.get(finalURL, function(data) {
    //             $(".viewList").html(data);
    //         });
    //         return false;
    //     })})

    //   $( document ).ready(function() {

    //       $('#search_filter').click(function (e){
    //         e.preventDefault();
    //         var id_gender = $('.selectGender').find(":selected").val();
    //         var id_major = $('.selectMajor').find(":selected").val();
    //         var id_skill = $('.selectSkill').find(":selected").val();
    //         var type_degree = $('.select_type_degree').find(":selected").val();
    //         var name_edu = $('.select_name_edu').find(":selected").val();
    //         var name_cty = $('.select_name_cty').find(":selected").val();
    //         var search_address = $('.search_address').val();
    //         var selectYearKn = $('.selectYearKn').find(":selected").val();
    //         var data = {
    //                 "id_major": id_major,
    //                 "id_gender": id_gender,
    //                 "id_skill": id_skill,
    //                 "type_degree": type_degree,
    //                 "name_edu": name_edu,
    //                 "name_cty": name_cty,
    //                 "search_address" : search_address,
    //                 "selectYearKn" : selectYearKn,
    //             }
    //         $.ajax({
    //           url: "filter",
    //           type: "get",
    //           data: data,
    //           success: function(data)
    //           {
    //             $(".viewList").html(data);
    //           },
    //           error: function(){
    //             Swal.fire({
    //                     icon: 'error',
    //                     title: 'Cảnh báo',
    //                     text: 'Dữ liệu bị lỗi',
    //                     showCancelButton: false,
    //                     showConfirmButton: false,
    //                     confirmButtonText: 'Đồng ý',
    //                     confirmButtonColor: '#C46F01',
    //                     cancelButtonText: 'Không'
    //                 })
    //           }
    //         });

    //       });

    //   });
  </script>
@endsection