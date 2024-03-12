
@extends('company.layout.app')
@section('content')
    <div class="row">
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="ui-item">
                <div class="left">
                    <i class="icon flaticon-briefcase"></i>
                </div>
                <div class="right">
                    <h4>jobPost_Count</h4>
                    <p>Tin tuyển dụng</p>
                </div>
            </div>
        </div>
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="ui-item ui-red">
                <div class="left">
                    <i class="icon la la-file-invoice"></i>
                </div>
                <div class="right">
                    <h4>__Applies__</h4>
                    <p>Ứng tuyển</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class=" col-lg-12">
            <!-- Graph widget -->
            <div class="graph-widget ls-widget">
                <div class="tabs-box">
                    <div class="widget-title">
                        <h4>Thống kê</h4>
                        <div class="chosen-outer">
                            <!--Tabs Box-->
                            <select id="time-search" class="chosen-select">
                                <option value="7">7 ngày trước</option>
                                <option value="28">28 ngày trước</option>
                            </select>
                        </div>
                    </div>

                    <div class="widget-content">
                        <canvas id="chart" width="100" height="45"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="image-layer" style="background-image: url({{ asset('/assets/client-bower/images/background/12.jpg') }});">
    </div>
    </div>
    <!-- End Info Section -->
    <a href="{{route('company.post.index')}}">post index</a>
@endsection
