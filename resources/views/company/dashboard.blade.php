
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
                        <h4>Thống kê</h4>
                        <div class="chosen-outer">
                            <!--Tabs Box-->
                            <select id="time-search" class="chosen-select">
                                <option value="7">7 ngày trước</option>
                                <option value="30">30 ngày trước</option>
                                <option value="60">60 ngày trước</option>
                                <option value="90">90 ngày trước</option>
                            </select>
                        </div>
                    </div>

                    {{-- <div class="widget-content">
                        <canvas id="chart" width="100" height="45"></canvas>
                    </div> --}}
                    
                    {{-- <ul class="nav nav-pills ranges">
                        <li class="active"><a href="#" data-range='7'>7 Days</a></li>
                        <li><a href="#" data-range='30'>30 Days</a></li>
                        <li><a href="#" data-range='60'>60 Days</a></li>
                        <li><a href="#" data-range='90'>90 Days</a></li>
                      </ul> --}}
                    <div id="chart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="image-layer" style="background-image: url({{ asset('/assets/client-bower/images/background/12.jpg') }});">
    </div>
    </div>
    <!-- End Info Section -->
    {{-- <a href="{{route('company.post.index')}}">post index</a> --}}
@endsection
@section('script')
@parent
<script>
    $(function() {
        console.log('b1');
        $('#time-search').on('change',function(){
            console.log('b2');

            var days = $(this).val(); // Lấy giá trị của select
            console.log(days); // In ra giá trị của select
            requestData(days); // Gửi yêu cầu AJAX với số ngày đã chọn
        });
        // Create a function that will handle AJAX requests
        function requestData(days, chart){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "./company/api", // This is the URL to the API
                data: { days: days }
            })
            .done(function( data ) {
                // When the response to the AJAX request comes back render the chart with new data
                chart.setData(data);
                console.log(data);                                                                                                                                                            
            })
            .fail(function() {
                // If there is no communication between the server, show an error
                alert( "error occured" );
            });
        }

        var chart = Morris.Bar({
            // ID of the element in which to draw the chart.
            element: 'chart',
            data: [0, 0], // Set initial data (ideally you would provide an array of default data)
            xkey: 'date', // Set the key for X-axis
            ykeys: ['value'], // Set the key for Y-axis
            labels: ['Orders'] // Set the label when bar is rolled over
        });

        // Request initial data for the past 7 days:
        requestData(7, chart);

});
    // Morris.Bar({
    //   element: 'chart',
    //   data: [
    //     { date: '04-02-2014', value: 3 },
    //     { date: '04-03-2014', value: 10 },
    //     { date: '04-04-2014', value: 5 },
    //     { date: '04-05-2014', value: 17 },
    //     { date: '04-06-2014', value: 6 }
    //   ],
    //   xkey: 'date',
    //   ykeys: ['value'],
    //   labels: ['Orders']
    // });
</script>
@endsection
