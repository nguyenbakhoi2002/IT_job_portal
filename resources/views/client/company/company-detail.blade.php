@extends('client.layout.app')
@section('title')
    'UB work| {{$company_detail->company_name}}'
@endsection
@section('content')
    <section class="job-detail-section">
        <!-- Upper Box -->
        <div class="upper-box">
            <div class="auto-container">
                <!-- Job Block -->
                <div class="job-block-seven">
                    <div class="inner-box">
                        <div class="content">
                            <span class="company-logo"><img src="{{asset('uploads/images/company/'. $company_detail->logo)}}" alt=""></span>
                            <h4><a href="#">{{$company_detail->company_name}}</a></h4>
                            <ul class="job-info">
                                <li><span class="icon flaticon-map-locator"></span> {{$company_detail->link_web}}</li>
                                <li><span class="icon flaticon-briefcase"></span>
                                    @if ($company_detail->team >= 5000)
                                        5000+
                                    @elseif($company_detail->team >= 2000)
                                        2000+
                                    @elseif($company_detail->team >= 1000)
                                        1000 - 2000
                                    @elseif($company_detail->team >= 500)
                                        500 - 1000
                                    @elseif($company_detail->team >= 100)
                                        100 - 500
                                    @else ~100
                                    @endif
                                    Nhân viên
                                </li>
                                <li><span class="icon flaticon-mail"></span>Người theo dõi</li>
                            </ul>
                            <ul class="job-other-info">
                                <li class="time">Công việc – {{ $company_detail->jobPost->count() }}</li>
                            </ul>
                        </div>

                        <div class="btn-box">
                            @if (auth('candidate')->check()) 
                                <a href="{{route('feedback', ['id' => $company_detail->id])}}" class="theme-btn btn-style-one">Đánh giá</a>
                            @else
                                <button class="theme-btn btn-style-one">Đánh giá</button>
                            @endif

                            {{-- @if (auth('candidate')->check()) 
                                 <a class="bookmark-btn"  href="{{route('shortlisted_company', ['id' => $company_detail->id])}}"><i class="flaticon-bookmark"></i></a>
                            @else
                           
                                <button class="bookmark-btn"><i class="flaticon-bookmark"></i></button>
                            @endif --}}
                            @if (auth('candidate')->check()) 
                                @if (!empty($idCompanyShort[$company_detail->id]) )
                                    @if($idCompanyShort[$company_detail->id]->company_id == $company_detail->id)
                                    <a href="{{route('delete_shortlisted_company', ['id' => $idCompanyShort[$company_detail->id]->id])}}"><button class="bookmark-btn" style="background-color: #f7941d;"><span class="flaticon-bookmark" style="color: white" ></span></button></a>
                                    @endif
                                @else
                                    <a href="{{route('shortlisted_company', ['id' => $company_detail->id])}}"><button class="bookmark-btn"  ><span class="flaticon-bookmark" ></span></button></a>
                                @endif
                            @else
                                <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
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
                            <h4>Thông tin công ty</h4>
                            <p>{{$company_detail->about}}
                            </p>
    
                        </div>

                        <!-- Related Jobs -->
                        <div class="related-jobs">
                            {{-- <div class="title-box">
                                <h3>Có {{count($company_job)}} công việc</h3>
                                <div class="text">Năm 2020 - {{count($company_job)}} công việc được đăng tải.</div>
                            </div> --}}

                            <form action="" class="form-inline float-right mr-3 mb-3">
                                <div class="form-group d-flex ">
                                    <input class="form-control" name="key" id="key" placeholder="Nhập tên công việc ....">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            <!-- Job Block -->
                            @foreach ($company_jobs as $item)
                                <div class="job-block">
                                    <div class="inner-box">
                                        <div class="content">
                                        <span class="company-logo" ><img style="width:50px; height:50px" src="{{asset('uploads/images/company/'. $company_detail->logo)}}" alt=""></span>
                                        <h4><a href="{{route('job-detail', $item)}}">{{$item->title}}</a></h4>
                                        <ul class="job-info">
                                            <li><span class="icon flaticon-briefcase"></span>{{$item->major->name}}</li>
                                            @foreach ($dataProvinces as $value)
                                                @if($value['Id'] == $item->area)
                                                    <li><span class="icon flaticon-map-locator"></span>{{$value['Ten']}}</li>
                                                @endif
                                            @endforeach
                                            <li><span class="icon flaticon-money"></span>{{number_format($item->min_salary, 0, ',', '.')}} - {{number_format($item->max_salary, 0, ',', '.')}} đ</li>
                                            <li><span class="icon flaticon-clock-3"></span>còn {{$current_date->diff($item->end_date)->days}} ngày để ứng tuyển</li>
                                            
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
                                            @if (!empty($job_short[$item->id]) )
                                                @if($job_short[$item->id]->job_post_id == $item->id)
                                                <a href="{{route('delete_shortlisted', ['id' => $job_short[$item->id]->id])}}" class="bookmark-btn" style="background-color: #f7941d;"><span class="flaticon-bookmark" style="color: white"></span></a>
                                                @endif
                                            @else
                                                <a href="{{route('shortlisted', ['id' => $item->id])}}"><button class="bookmark-btn"  ><span class="flaticon-bookmark" ></span></button></a>
                                            @endif
                                        @else
                                                <a class="bookmark-btn" href=""><span class="flaticon-bookmark"></span></a>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                        <aside class="sidebar">
                            <div class="sidebar-widget company-widget">
                                <div class="widget-content">
                                    <div class="mb-4 text-center fw-bold fs-4">Thông tin liên hệ </div>
                                    <ul class="company-info mt-0">
                                        {{-- @if($sum >= 10)
                                        <li class="rating-css">
                                            <label>Rating:</label>
                                            <div class="star-icon">
                                                <input @if($average > 0 && $average <= 1.5) checked @endif type="radio" value="1" name="rate"id="rating1" disabled>
                                                <label for="rating1" class="fa fa-star"></label>
                                                <input @if($average > 1.5 && $average <= 2.5) checked @endif type="radio" value="2" name="rate" id="rating2" disabled>
                                                <label for="rating2" class="fa fa-star"></label>
                                                <input @if($average > 2.5 && $average <= 3.5) checked @endif type="radio" value="3" name="rate" id="rating3" disabled>
                                                <label for="rating3" class="fa fa-star"></label>
                                                <input @if($average > 3.5 && $average <= 4.5) checked @endif type="radio" value="4" name="rate" id="rating4" disabled>
                                                <label for="rating4" class="fa fa-star"></label>
                                                <input @if($average > 4.5 && $average <= 5) checked @endif type="radio" value="5" name="rate" id="rating5" disabled>
                                                <label for="rating5" class="fa fa-star"></label>
                                            </div>
                                            <span>(<?php echo $average?>)</span>
                                        </li>
                                        @endif --}}
                                        <li class="mb-0"> địa chỉ công ty: </li> <span>{{$company_detail->address}}</span>
                                        <li>Xem bản đồ <span></span></li>
                                        <li>Truyền thông xã hội:
                                            <div class="social-links">
                                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                <a href="#"><i class="fab fa-twitter"></i></a>
                                                <a href="#"><i class="fab fa-instagram"></i></a>
                                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="btn-box"><a href=""
                                            class="theme-btn btn-style-three">{{$company_detail->link_web}}</a></div>
                                </div>
                            </div>

                            @if(!empty($company_detail->map))
                                <div class="sidebar-widget">
                                <!-- Map Widget -->
                                <h4 class="widget-title">Địa điểm</h4>
                                <div class="widget-content">
                                    <div class="map-outer mb-0">
                                        <iframe class="map-canvas" width="100%" src="{{$company_detail->map}}" frameborder="0"></iframe>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
