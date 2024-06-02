
@extends('company.layout.app')
@section('style')
@parent
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
@endsection
@section('content')

    <div class="row">
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="ui-item justify-content-around">
                <div class="left">
                    <i class="icon flaticon-briefcase"></i>
                </div>
                <div class=" ">
                    <p>Tin tuyển dụng đã đăng</p>
                    <p>{{count($list_job)}}</p>
                </div>
            </div>
        </div>
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="ui-item ui-red">
                <div class="left">
                    <i class="icon la la-file-invoice"></i>
                </div>
                <div class="">
                    <p>Số CV đã ứng tuyển</p>
                    <p>{{($count_applied)}}</p>

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
                        <h4>Thống kê số bài đăng</h4>
                        <div class="chosen-outer">
                            <!--Tabs Box-->
                            <select id="dashboarh-filter" class="form-control">
                                <option>--Chọn--</option>
                                <option value="7ngay">7 ngày trước</option>
                                <option value="thangtruoc">Tháng trước</option>
                                <option value="thangnay">Tháng này</option></option>
                                {{-- <option value="365ngay">365 ngày qua</option> --}}
                            </select>
                        </div>
                    </div>
                    <div id="myfirstchart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
        <div class=" col-lg-12">
            <!-- Graph widget -->
            <div class="graph-widget ls-widget">
                <div class="tabs-box">
                    <div class="widget-title">
                        <h4>Thống kê số lượt ứng tuyển</h4>
                        <div class="chosen-outer">
                            <!--Tabs Box-->
                            <select id="dashboarh-filter-cv" class="form-control">
                                <option>--Chọn--</option>
                                <option value="7ngay">7 ngày trước</option>
                                <option value="thangtruoc">Tháng trước</option>
                                <option value="thangnay">Tháng này</option></option>
                                {{-- <option value="365ngay">365 ngày qua</option> --}}
                            </select>
                        </div>
                    </div>
                    <div id="myfirstchartcv" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="image-layer" style="background-image: url({{ asset('/assets/client-bower/images/background/12.jpg') }});"> --}}
    </div>
    </div>
    <!-- End Info Section -->
    {{-- <a href="{{route('company.post.index')}}">post index</a> --}}
@endsection
@section('script')
@parent
<script>
    $(function() {
        var chart = new Morris.Bar({
        element: 'myfirstchart',
        data: 
            {!! $data_post !!}
        ,
        xkey: 'period',
        ykeys: ['total_post'],
        labels: ['Số bài đăng']
        });
        var chart_profile = new Morris.Bar({
            element: 'myfirstchartcv',
            data:
                {!! $data !!}
                // { period: '2024', total_cv: 10 },
                // { period: '2025', total_cv: 20 },
                // { period: '2026', total_cv: 30 },
                // { period: '2027', total_cv: 40 },
                // { period: '2028', total_cv: 50 },
                
            ,
            xkey: 'period',
            ykeys: ['total_cv'],
            labels: ['Số CV nhận được']
        });
        $('#dashboarh-filter').on('change',function(){
            var dashboard_value = $(this).val(); // Lấy giá trị của select
            // alert(dashboard_value);
            $.ajax({
                type: "post",
                dataType: 'json',
                url: "{{url('/company/api')}}", // This is the URL to the API
                data: { 
                    "dashboard_value": dashboard_value, 
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    chart.setData(data);
                },
                error: function(error) {
                    console.log('Error fetching data', error);
                }
            })
        });
        $('#dashboarh-filter-cv').on('change',function(){
            var dashboard_value = $(this).val(); // Lấy giá trị của select
            // alert(dashboard_value);
            $.ajax({
                type: "post",
                dataType: 'json',
                url: "{{url('/company/api-cv')}}", // This is the URL to the API
                data: { 
                    "dashboard_value": dashboard_value, 
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    chart_profile.setData(data);
                },
                error: function(error) {
                    console.log('Error fetching data', error);
                }
            })
        });
});
</script>
@endsection
