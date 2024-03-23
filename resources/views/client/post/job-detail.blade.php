@extends('client.layout.app')
@section('title')
    'BaKhoi'| {{$data_job->title}}
@endsection
@section('content')
    <section class="job-detail-section">
      <!-- Upper Box -->
      <div class="upper-box" style="background-image: url({{asset('storage/images/bg-4.png')}}) ">
        <div class="auto-container">
          <!-- Job Block -->
          <div class="job-block-seven">
            <div class="inner-box">
              <div class="content">
                <span class="company-logo"><img src="{{asset('uploads/images/company/'.$data_job->company->logo)}}"></span>
                <h4><a href="{{route('job-detail', $data_job)}}">{{$data_job->title}}</a></h4>
                <ul class="job-info">
                  {{-- <li><span class="icon flaticon-briefcase"></span> {{$data_job->major->name}}</li> --}}
                  <li><span class="icon flaticon-map-locator"></span>{{$data_job->company->address}}</li>
                  <li><span class="icon flaticon-clock-3"></span>{{$data_job->company->working_time}}</li>
                  <li><span class="icon flaticon-money"></span> {{number_format($data_job->min_salary)}} - {{number_format($data_job->max_salary)}}</li>
                </ul>
                <ul class="job-other-info">
                  @foreach (config('custom.type_work') as $value)
                      @if($value['id'] == $data_job->type_work)
                          <li class="time">
                              {{$value['name']}}
                          </li>
                      @endif
                  @endforeach
                </ul>
              </div>

              <div class="btn-box">
                @if (auth('candidate')->check())
                    @if (!empty($idJobApplied[$data_job->id]) )
                      @if($idJobApplied[$data_job->id]->job_post_id == $data_job->id )
                      <button class="theme-btn btn-style-one" >Đã ứng tuyển</button>
                      @endif
                    @else
                      <a  @if(!empty($seeker->id)) href="{{route('applied', ['id' => $data_job->id])}}" @else href="{{route('CreateCV')}}" @endif class="theme-btn btn-style-one">Ứng tuyển ngay</a>
                    @endif
                @else
                  <a class="theme-btn btn-style-one" href="{{route('login')}}">Ứng tuyển ngay</a>
                @endif

                @if (auth('candidate')->check())
                  @if (!empty($idJobShort[$data_job->id]) )
                    @if($idJobShort[$data_job->id]->job_post_id == $data_job->id)
                      <a href="{{route('delete_shortlisted', ['id' => $idJobShort[$data_job->id]->id])}}" class="bookmark-btn" style="background-color: #f7941d;"><span class="flaticon-bookmark" style="color: white"></span></a>
                    @endif
                  @else
                    <a href="{{route('shortlisted', ['id' => $data_job->id])}}"><button class="bookmark-btn"  ><span class="flaticon-bookmark" ></span></button></a>
                  @endif
                @else
                    <a class="bookmark-btn" href="{{route('login')}}"><span class="flaticon-bookmark"></span></a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="job-detail-outer">
        <div class="auto-container">
          <div class="row">
            <div class="content-column col-lg-8 col-md-12 col-sm-12">
              <div class="job-detail">
                <h4>Mô tả công việc</h4>
                <p>{!! $data_job->description !!}</p>
                <h4>Yêu cầu công việc</h4>
                <ul class="list-style-three">
                  {!! $data_job->requirement !!}
                </ul>
                @if(!empty($data_job->benefits))
                <h4>Quyền lợi</h4>
                <ul class="list-style-three">
                  {!! $data_job->benefits !!}
                </ul>
                @endif
                <h4>Kĩ năng và kinh nghiệm</h4>
                <ul class="list-style-three">
                  <li>Y/C: {{ $data_job->experience->level != 0 ?"Ít nhất ". $data_job->experience->name." kinh nghiệm": "Không yêu cầu kinh nghiệm" }}
                </ul>
              </div>

              <!-- Other Options -->
              {{-- <div class="other-options">
                <div class="social-share">
                  <h5>Chia sẻ công việc</h5>
                  <a href="#" class="facebook"><i class="fab fa-facebook-f"></i> Facebook</a>
                  <a href="#" class="twitter"><i class="fab fa-twitter"></i> Twitter</a>
                  <a href="#" class="google"><i class="fab fa-google"></i> Google+</a>
                </div>
              </div> --}}

              <!-- Related Jobs -->
              <div class="related-jobs">
                <div class="title-box">
                  <h3>Công việc liên quan</h3>
                  <div class="text">{{count($data_job_relate)}} việc làm.</div>
                </div>

                <!-- Job Block -->
                @foreach ($data_job_relate as $item)
                    <div class="job-block">
                        <div class="inner-box">
                            <div class="content">
                            <span class="company-logo"><img src="{{asset('uploads/images/company/'.$item->company->logo)}}" alt=""></span>
                            <h4><a href="{{route('job-detail', $item)}}">{{$item->title}}</a></h4>
                            <ul class="job-info">
                                {{-- <li><span class="icon flaticon-briefcase"></span>{{$item->major->name}}</li> --}}
                                <li><span class="icon flaticon-map-locator"></span>{{$item->company->address}}</li>
                                <li><span class="icon flaticon-clock-3"></span>{{$item->company->working_time}} giờ/ngày</li>
                                <li><span class="icon flaticon-money"></span>{{number_format($item->min_salary)}} - {{number_format($data_job->max_salary)}}</li>
                            </ul>
                            <ul class="job-other-info">
                                 @foreach (config('custom.type_work') as $value)
                                      @if($value['id'] == $item->type_work)
                                          <li class="time">
                                              {{$value['name']}}
                                          </li>
                                      @endif
                                  @endforeach
                            </ul>
                           @if (auth('candidate')->check())
                              @if (!empty($idJobShort[$item->id]) )
                                @if($idJobShort[$item->id]->job_post_id == $item->id)
                                  <a href="{{route('delete_shortlisted', ['id' => $idJobShort[$item->id]->id])}}" class="bookmark-btn" style="background-color: #f7941d;"><span class="flaticon-bookmark" style="color: white"></span></a>
                                @endif
                              @else
                                <a href="{{route('shortlisted', ['id' => $item->id])}}"><button class="bookmark-btn"  ><span class="flaticon-bookmark" ></span></button></a>
                              @endif
                            @else
                              <a href="{{route('login')}}" class="bookmark-btn"><span class="flaticon-bookmark"></span></a>
                            @endif
                            </div>
                        </div>
                    </div>
                @endforeach
              </div>
            </div>

            <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
              <aside class="sidebar">
                <div class="sidebar-widget">
                  <!-- Job Overview -->
                  <h4 class="widget-title">Tổng quan về công việc</h4>
                  <div class="widget-content">
                    <ul class="job-overview">
                      <li>
                        <i class="icon icon-calendar"></i>
                        <h5>Ngày đăng:</h5>
                        <span>{{date("d-m-Y", strtotime($data_job->created_at))}}</span>
                      </li>
                      <li>
                        <i class="icon icon-expiry"></i>
                        <h5>Ngày hết hạn:</h5>
                        <span>{{date("d-m-Y", strtotime($data_job->end_date))}}</span>
                      </li>
                      <li>
                        <i class="icon icon-location"></i>
                        <h5>Địa điểm:</h5>
                        <span>{{$data_job->company->address}}</span>
                      </li>
                      <li>
                        <i class="icon icon-clock"></i>
                        <h5>Giờ làm việc:</h5>
                        <span>{{$data_job->company->working_time}} giờ/ngày</span>
                      </li>
                      <li>
                        <i class="icon icon-salary"></i>
                        <h5>Lương:</h5>
                         <span>{{number_format($data_job->min_salary, 0, ',', '.')}} - {{number_format($data_job->max_salary, 0, ',', '.')}} đ</span>
                      </li>
                      <li>
                        <i class="icon icon-rate"></i>
                        <h5>Trung bình:</h5>
                         <span>{{number_format($data_job->min_salary/8/27, 0, ',', '.')}} - {{number_format($data_job->max_salary/8/27, 0, ',', '.')}} đ / giờ</span>
                      </li>
                    </ul>
                  </div>

                  <!-- Map Widget -->
                  {{-- <h4 class="widget-title">Đia điểm</h4>
                  <div class="widget-content">
                    <div class="map-outer">
                      <div class="map-canvas">
                        <iframe class="map-canvas" width="100%" src="{{$data_job->company->map}}" frameborder="0"></iframe>
                      </div>
                    </div>
                  </div> --}}

                  <!-- Job Skills -->
                  {{-- <h4 class="widget-title">Kĩ năng</h4> --}}
                  <div class="widget-content">
                    <ul class="job-skills">
                      {{-- @foreach($job_skills as $item)
                      <li><a href="#">{{$item->name}}</a></li>
                      @endforeach --}}
                    </ul>
                  </div>
                </div>

                <div class="sidebar-widget company-widget">
                  <div class="widget-content">
                    <div class="company-title">
                      <div class="company-logo"><img src="{{asset('/uploads/images/company/'.$data_job->company->logo)}}" alt=""></div>
                      <h5 class="company-name">{{$data_job->company->company_name}}</h5>
                      <a href="{{route('company-detail',$data_job->company)}}" class="profile-link">Thông tin công ty</a>
                    </div>

                    <ul class="company-info">
                      <li>Loại hình doanh nghiệp: <span>{{$data_job->company->company_model}}</span></li>
                      {{-- <li>Quy mô: <span>{{$data_job->company->company_size}}</span></li> --}}
                      <li>Thành lập: <span>{{date('d-m-Y', strtotime($data_job->company->founded_in))}}</span></li>
                      <li>Số điện thoại: <span>{{$data_job->company->phone}}</span></li>
                      <li>Email: <span>{{$data_job->company->email}}</span></li>
                      <li>Địa điểm: <span>{{$data_job->company->address}}</span></li>
                      {{-- <li>Truyền thông xã hội:
                        <div class="social-links">
                          <a href="#"><i class="fab fa-facebook-f"></i></a>
                          <a href="#"><i class="fab fa-twitter"></i></a>
                          <a href="#"><i class="fab fa-instagram"></i></a>
                          <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                      </li> --}}
                    </ul>
                    <div class="btn-box"><a target="_blank" href="{{$data_job->company->link_web}}" class="theme-btn btn-style-three">Website công ty</a></div>
                  </div>
                </div>
              </aside>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
