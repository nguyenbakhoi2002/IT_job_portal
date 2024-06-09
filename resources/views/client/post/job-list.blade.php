@extends('client.layout.app')
@section('title')
    BaKhoi | Danh sách công việc
@endsection
@section('style')
    @parent
    <style>
        .info-high {
        color: #212F3F;
        font-size: 16px;
        height: 24px;
        overflow: hidden; 
        display: block;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        }
        .form-group{
            width: 185px;
        }
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #C46F01;
            border-color: #C46F01;
        }
        .page-link {
            position: relative;
            display: block;
            color: #C46F01;
        }
    </style>
@endsection
@section('content')
    <section class="page-title " style="margin-top: 144px">
        <div class="auto-container">
            <div class="title-outer">
                <h1>Danh sách công việc </h1>
                <ul class="page-breadcrumb">
                    <li><a href="index.html">Trang chủ</a></li>
                    <li>Công việc</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="ls-section">
        <div class="auto-container">
            <div class="filters-backdrop"></div>
            <div class="row">
                <form class="job-search-form" action="">
                    <div class="row">
                        <div class="form-group col-lg-2 col-md-12 col-sm-12" >
                            <span class="icon flaticon-search-1"></span>
                            <input type="text" class="form-control search-input" id="search-text" name="name"
                                placeholder="công việc ">
                        </div>
                        <div class="form-group col-lg-2 col-md-12 col-sm-12" >
                            <span class="icon flaticon-map-locator"></span>
                            <select name="area" id="search-area" class="chosen-select">
                                <option value="">Khu vực</option>
                                @foreach ($dataProvinces as $item)
                                    <option value="{{ $item['Id'] }}">{{ $item['Ten'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-2 col-md-12 col-sm-12">
                            <span class="icon fa fa-history"></span>
                            <select name="type" id="search-exp" name="exp" class="chosen-select">
                                <option value="">Tất cả kinh nghiệm</option>
                                @foreach ($exp as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-2 col-md-12 col-sm-12" >
                            <span class="icon flaticon-pencil"></span>
                            <select name="skill" id="search-skill" class="chosen-select" >
                                <option value="">Kỹ Năng</option>
                                @foreach ($skill as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-12 col-sm-12" >
                            <span class="icon flaticon-briefcase"></span>
                            <select name="major" id="search-major" class="chosen-select">
                                <option value="">Chuyên Ngành</option>
                                @foreach ($major as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-12 col-sm-12" >
                            <span class="icon flaticon-briefcase"></span>
                            <select name="wage" id="search-wage" class="chosen-select">
                                <option value="">Mức lương</option>
                                @foreach (config('custom.wage') as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        
                        <div class="form-group col-lg-1 col-md-12 col-sm-12 p-0">
                            <button type="submit" id="button_search" class="theme-btn btn-style-one btn-search rounded-right">Tìm Kiếm</button>
                        </div>
                    </div>
                </form>
                <div class="content-column col-lg-12 view-table">
                    @include('client.post.table-job')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    @parent
    {{-- <script>
        $(function() {
            function isUndefined(value) {
                return value === undefined || value === null
            }
            $(document).on("click",".pagination li a,#button_search", function(e) {
                e.preventDefault();
                var area = $("#search-area").val();
                var skill = $("#search-skill").val();
                var major = $("#search-major").val();
                var text = $("#search-text").val();
                var type = $("#search-type").val();
                var url=$(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append ;
                if (area.length>0) {
                    finalURL += "&" + $("#search-area").serialize();
                }
                if (skill.length>0) {
                    finalURL += "&" + $("#search-skill").serialize();
                }
                if (major.length>0) {
                    finalURL += "&" + $("#search-major").serialize();
                }
                if (text.length>0) {
                    finalURL += "&" + $("#search-text").serialize();
                }
                if (type.length>0) {
                    finalURL += "&" + $("#search-type").serialize();
                }
                window.history.pushState({}, null, finalURL);
                $.get(finalURL, function(data) {
                    $(".view-table").html(data);
                });
                return false;
            })
            })
    </script> --}}
@endsection
