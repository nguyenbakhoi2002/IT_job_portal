@extends('client.layout.app')
@section('title')
    {{-- {{ __('UB Work') }} --}}
    NBK
@endsection
@section('content')
@section('style')
@parent
<style>
    .form-control:focus{
        box-shadow: none;
    }
    .tt-menu{
        left: -15px !important;
        top: 80px !important;
        width: 305px;
        border-radius: 5px;
    }
    .tt-dataset{
        border-radius: 5px;
    }
    .tt-dataset a{
        font-family: 'Roboto', sans-serif;
    }
    .tt-dataset a:hover{
            color:#f7941d;
    }
</style>
@endsection
    <section class="banner-section">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInUp" data-wow-delay="1000ms">
                        <div class="title-box">
                            <h3>Có<span class="colored"> 
                                {{-- <!-- {{ $countJob }} --> --}}
                            </span> Bài đăng ở đây<br>dành cho @if (auth('candidate')->user()->email)
                                {{auth('candidate')->user()->email}}
                                @else bạn
                            @endif</h3>
                            <div class="text">Tìm việc làm, Cơ hội việc làm & Nghề nghiệp</div>
                        </div>
                        <!-- Job Search Form -->
                        <div class="job-search-form">
                            <form method="get" action="job">
                                <div class="row">
                                    <div class="form-group col-lg-5 col-md-12 col-sm-12">
                                        <span class="icon flaticon-search-1"></span>
                                        <input type="text" class="form-control search-input" name="search" placeholder="Mời Nhập Từ Khóa">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-12 col-sm-12 location">
                                        <span class="icon flaticon-briefcase"></span>
                                        <select name="major" class="chosen-select">
                                            <option value="">Chuyên Ngành</option>
                                            {{-- <!-- @foreach ($maJor as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach --> --}}
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-12 col-sm-12 btn-box">
                                        <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">Tìm
                                                Kiếm</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <!-- Job Search Form -->

                        <!-- Popular Search -->
                    </div>
                </div>
                <div class="image-column col-lg-5 col-md-12">
                    <div class="image-box">
                        <figure class="main-image wow fadeIn animated" data-wow-delay="500ms"
                            style="visibility: visible; animation-delay: 500ms; animation-name: fadeIn;"><img
                                src="{{ asset('/assets/client-bower/images/resource/banner-img-1.png') }}" alt="">
                        </figure>

                        <!-- Info BLock One -->
                        <div class="info_block anm wow fadeIn animated" data-wow-delay="1000ms" data-speed-x="2"
                            data-speed-y="2"
                            style="transform: translate3d(-4px, -7.36px, 0px) scale(1) rotate(0deg); opacity: 1; visibility: visible; animation-delay: 1000ms; animation-name: fadeIn;">
                            <span class="icon flaticon-email-3"></span>
                            <p>
                                {{-- <!-- {{$countJobActive}}  --> --}}
                                công việc <br>được ứng tuyển</p>
                        </div>

                        <!-- Info BLock Two -->
                        <div class="info_block_two anm wow fadeIn animated" data-wow-delay="2000ms" data-speed-x="1"
                            data-speed-y="1"
                            style="transform: translate3d(-2px, -3.68px, 0px) scale(1) rotate(0deg); opacity: 1; visibility: visible; animation-delay: 2000ms; animation-name: fadeIn;">
                            <p>
                                {{-- <!-- {{$countCandidate}}+  --> --}}
                                Ứng viên</p>
                            <div class="image"><img
                                    src="{{ asset('/assets/client-bower/images/resource/multi-peoples.png') }}"
                                    alt=""></div>
                        </div>

                        <!-- Info BLock Three -->
                        <div class="info_block_three anm wow fadeIn animated" data-wow-delay="1500ms" data-speed-x="4"
                            data-speed-y="4"
                            style="transform: translate3d(-8px, -14.72px, 0px) scale(1) rotate(0deg); opacity: 1; visibility: visible; animation-delay: 1500ms; animation-name: fadeIn;">
                            <span class="icon flaticon-briefcase"></span>
                            <p>
                                {{-- <!-- {{$countJob}}+  --> --}}
                                Công việc</p>
                            <span class="sub-text">Hãy tìm <span style="color=#f7941d;">công việc</span> phù hợp với bạn</span>
                            <span class="right_icon fa fa-check"></span>
                        </div>

                        <!-- Info BLock Four -->
                        <div class="info_block_four anm wow fadeIn animated" data-wow-delay="2500ms" data-speed-x="3"
                            data-speed-y="3"
                            style="transform: translate3d(-6px, -11.04px, 0px) scale(1) rotate(0deg); opacity: 1; visibility: visible; animation-delay: 2500ms; animation-name: fadeIn;">
                            <span class="icon flaticon-file"></span>
                            <div class="inner">
                                <p>Tải lên CV của bạn</p>
                                <span class="sub-text">Chỉ mất vài giây CV của bạn sẽ được đăng tải</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Section-->

    <!-- Job Categories -->
    <section class="job-categories">
        <div class="auto-container">
            <div class="row wow fadeInUp">
                <div class="sec-title text-center">
                    <h2>Về Chúng Tôi</h2>
                    <div class="text">Ubwork là website công nghệ nhân sự (HR Tech). Với năng lực lõi là
                        công nghệ, sứ mệnh của Ubwork đặt ra cho mình là thay đổi thị
                        trường tuyển dụng - nhân sự ngày một hiệu quả hơn. Bằng công nghệ, chúng tôi tạo ra nền tảng cho
                        phép người lao động tạo CV, phát triển được các kỹ năng cá nhân, xây dựng hình ảnh chuyên nghiệp
                        trong mắt nhà tuyển dụng và tiếp cận với các cơ hội việc làm phù hợp.</div>
                </div>
                <div class="job-carousel owl-carousel owl-theme default-dots category-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="content">
                            <span class="icon fas fa-user"></span>
                            <h4><a href="#">Ứng Viên</a></h4>
                            <p>
                                {{-- <!-- Có {{ count($user) }}  --> --}}
                                ứng viên sử dụng dịch vụ.</p>
                        </div>
                    </div>
                    <div class="inner-box">
                        <div class="content">
                            <span class="icon fas fa-building"></span>
                            <h4><a href="#">Doanh Nghiệp</a></h4>
                            <p>
                                {{-- <!-- Có {{ count($company) }}  --> --}}
                                doanh nghiệp sử dụng dịch vụ.</p>
                        </div>
                    </div>
                    <div class="inner-box">
                        <div class="content">
                            <span class="icon fas fa-clipboard-list"></span>
                            <h4><a href="#">Bài Đăng</a></h4>
                            <p>
                                {{-- <!-- Có {{ count($job_post) }} --> --}}
                                 bài đăng đã được đăng tải.</p>
                        </div>
                    </div>
                    <div class="inner-box">
                        <div class="content">
                            <span class="icon fas fa-search"></span>
                            <h4><a href="#">Tìm Việc</a></h4>
                            <p>
                                {{-- <!-- Có {{ count($user_type) }}  --> --}}
                                người dùng đang bật chế độ tìm việc.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sec-title text-center">
                <h2>Các chuyên ngành công việc phổ biến</h2>
                <div class="text">
                    {{-- <!-- {{ $data != '' ? $countJob : 0 }}  --> --}}
                    việc làm được đăng tải</div>
            </div>

            <div class="row wow fadeInUp">
                {{-- <!-- @foreach ($data_job_type as $item_job)
                    <div class="category-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <span class="{{ $item_job->icon }}"></span>
                                <h4><a href="{{ route('job', ['id' => $item_job->id]) }}">{{ $item_job->name }}</a>
                                </h4>
                                <p>( {{ $count[$item_job->id] }} bài đăng)</p>
                            </div>
                        </div>
                    </div>
                @endforeach --> --}}
            </div>
        </div>
    </section>
    <!-- End Job Categories -->

    <!-- Job Section -->
    <section class="job-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <h2>Việc làm nổi bật</h2>
                <div class="text">Biết giá trị của bạn và tìm công việc phù hợp với cuộc sống của bạn
                </div>
                <div class="row wow fadeInUp mt-3">
                    <!-- Job Block -->
                    {{-- <!-- @foreach ($data as $item)
                        <div class="job-block col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-box">
                                <div class="content">
                                    <span class="company-logo"><img src="{{ asset('storage/images/company/' . $item->company->logo) }}"
                                            alt=""></span>
                                    <h4 style="text-align: left;"><a
                                            href="{{ route('job-detail', ['id' => $item->id]) }}">{{ $item->title }}</a>
                                    </h4>
                                    <ul class="job-info">
                                        <li><span class="icon flaticon-briefcase"></span>{{ $item->major->name }}</li>
                                        <li><span class="icon flaticon-map-locator"></span>{{ $item->company->address }}
                                        </li>
                                        <li><span class="icon flaticon-clock-3"></span>{{ $item->company->working_time }}
                                            giờ</li>
                                        <li><span class="icon flaticon-money"></span>{{number_format($item->min_salary, 0, ',', '.')}} - {{number_format($item->max_salary, 0, ',', '.')}} đ</li>
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
                                        @if (!empty($job_short[$item->id]))
                                           @if ($job_short[$item->id]->job_post_id == $item->id)
                                                <a href="{{ route('delete_shortlisted', ['id' => $job_short[$item->id]->id]) }}"
                                                    class="bookmark-btn"><span class="flaticon-bookmark"
                                                        style="color: #f7941d"></span></a>
                                            @endif
                                        @else
                                            <a href="{{ route('shortlisted', ['id' => $item->id]) }}"
                                                class="bookmark-btn"><span class="flaticon-bookmark"
                                                    style="color: black"></span></a>
                                        @endif
                                    @else
                                        <button class="bookmark-btn"><span class="flaticon-bookmark"
                                                style="color: black"></span></button>
                                        <a href="{{route('candidate.login')}}" class="bookmark-btn"><span class="flaticon-bookmark" style="color: black"></span></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach --> --}}
                </div>

                <div class="btn-box">
                    <a href="" class="theme-btn btn-style-one bg-blue"><span class="btn-title">Xem
                            thêm</span></a>
                </div>
            </div>
             {{-- @if (auth('candidate')->check())
                @if(!empty($seeker->major_id))
                    <div class="sec-title text-center">
                    <h2>Việc làm có thể phù hợp với bạn</h2>
                    <div class="text">Dựa trên thông tin của bạn. Vậy nên hãy nhập đúng thông tin cá nhân của mình!
                    </div>

                    <div class="row wow fadeInUp mt-3">
                        @foreach ($dataYour as $item)
                            <div class="job-block col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-box">
                                    <div class="content">
                                        <span class="company-logo"><img
                                                src="{{ asset('storage/' . $item->company->logo) }}"
                                                alt=""></span>
                                        <h4 style="text-align: left;"><a
                                                href="{{ route('job-detail', ['id' => $item->id]) }}">{{ $item->title }}</a>
                                        </h4>
                                        <ul class="job-info">
                                            <li><span class="icon flaticon-briefcase"></span>{{ $item->major->name }}</li>
                                            <li><span
                                                    class="icon flaticon-map-locator"></span>{{ $item->company->address }}
                                            </li>
                                            <li><span
                                                    class="icon flaticon-clock-3"></span>{{ $item->company->working_time }}
                                                giờ</li>
                                            <li><span class="icon flaticon-money"></span>{{number_format($item->min_salary, 0, ',', '.')}} - {{number_format($item->max_salary, 0, ',', '.')}} đ</li>
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
                                            @if (!empty($job_short[$item->id]))
                                                @if ($job_short[$item->id]->job_post_id == $item->id)
                                                    <a href="{{ route('delete_shortlisted', ['id' => $job_short[$item->id]->id]) }}"
                                                        class="bookmark-btn"><span class="flaticon-bookmark"
                                                            style="color: #f7941d"></span></a>
                                                @endif
                                            @else
                                                <a href="{{ route('shortlisted', ['id' => $item->id]) }}"
                                                    class="bookmark-btn"><span class="flaticon-bookmark "
                                                        style="color: black"></span></a>
                                            @endif
                                        @else
                                            <button class="bookmark-btn"><span class="flaticon-bookmark"
                                                    style="color: black"></span></button>
                                            <a href="{{route('candidate.login')}}" class="bookmark-btn"><span class="flaticon-bookmark"  style="color: black"></span></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            @endif --}}
    </section>
    <!-- End Job Section -->

@endsection
@section('script')
@parent

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<!-- <script>
$(document).ready(function($) {
    var engine1 = new Bloodhound({
        remote: {
            url: '/search/title?value=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    $(".search-input").typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, [
        {
            source: engine1.ttAdapter(),
            name: 'job-name',
            display: function(data) {
                return data.title;
            },
            templates: {
                suggestion: function (data) {
                    return '<a href="/job-detail/' + data.id + '" class="list-group-item">' + data.title + '</a>';
                }
            }
        },
    ]);
});

</script> -->
@endsection
