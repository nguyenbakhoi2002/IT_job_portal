@extends('admin.layout.app')
@section('title')
    Dashboard
@endsection
@section('style')
    @parent
    <style>
        @keyframes bounce {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .info-box-animation {
            animation: bounce 2s infinite; /* Áp dụng animation với tên 'bounce', thời gian 2s, và lặp vô hạn */
        }
        .form-group{
            margin-right: 4px;
        }
        .form-group label{
            margin: 0;
            color: #212529;
            font-weight: 500 !important;
            margin-right: 2px;
        }
    </style>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ count($candidate) }}</h3>

                    <p>Ứng viên có trong hệ thống</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="" class="small-box-footer">Xem chi tiết <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ count($company) }}</h3>

                    <p>Công ty có trong hệ thống</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="" class="small-box-footer">Xem chi tiết <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ count($job_post) }}</h3>

                    <p> Công việc có trong hệ thống</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="" class="small-box-footer">Xem chi tiết <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ count($admin) }}</h3>

                    <p> Quản trị có trong hệ thống</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="" class="small-box-footer">Xem chi tiết <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng số kĩ năng</span>
                    <span class="info-box-number">
                        {{ count($skill) }}
                    </span>
                </div>

            </div>

        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng số chuyên ngành</span>
                    <span class="info-box-number">
                      {{ count($major) }}
                    </span>
                </div>

            </div>

        </div>
        <div class="col-12 col-sm-6 col-md-3">
            @if(count($company_wait)>0)
            <a href="{{route('admin.company.companyWaiting')}}" class="text-dark">
                <div class="info-box info-box-animation  mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-toggle-on"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tổng số Công Ty bị chặn</span>
                        <span class="info-box-number">
                        {{ count($company_wait) }}
                        </span>
                    </div>
                </div>
            </a>
            @else
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-toggle-on"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tổng số Công Ty bị chặn</span>
                        <span class="info-box-number">
                        {{ count($company_wait) }}
                        </span>
                    </div>
                </div>
            @endif

        </div>
        <div class="col-12 col-sm-6 col-md-3">
            @if(count($post_wait)>0)
            <a href="{{route('admin.post.jobPostWaiting')}}" class="text-dark">
                <div class="info-box info-box-animation mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tổng số Công việc chờ xét duyệt</span>
                        <span class="info-box-number">
                        {{ count($post_wait) }}
                        </span>
                    </div>
                </div>
            </a>
            @else
                <div class="info-box  mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tổng số Công việc chờ xét duyệt</span>
                        <span class="info-box-number">
                        {{ count($post_wait) }}
                        </span>
                    </div>
                </div>
            @endif
        </div>
        {{-- <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-solid fa-ban"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng số Công Ty bị chặn</span>
                    <span class="info-box-number">
                      {{ count($countBlockImagePaper) }}
                    </span>
                </div>
            </div>
        </div> --}}

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between ">
                        <h3 class="card-title" id="btn-client" style="padding-top: 4px">Lượt đăng ký công ty</h3>
                        <div class="d-flex ">
                            <div class="form-group d-flex align-items-center">
                                <label for="start_date">Từ</label>
                                <input type="date" name="start_date" value="{{ $sdate }}" id="start_date" class="form-control" style="height: 30px;width: 126px">
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <label for="end_date">Đến</label>
                                <input type="date" name="end_date" value="{{ $edate }}" id="end_date" class="form-control" style="height: 30px;width: 126px">
                            </div>
                            <button type="submit"   id="filterButton" class="btn btn-primary" style="height: 30px;padding-top: 2px;">Áp dụng</button>
                            <div id="error-message" class="error-message"></div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <div id="chartcompany" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between ">
                        <h3 class="card-title" id="btn-client" style="padding-top: 4px">Lượt đăng ký ứng viên</h3>
                        <div class="d-flex ">
                            <div class="form-group d-flex align-items-center">
                                <label for="start_date">Từ</label>
                                <input type="date" name="start_date" value="{{ $sdate }}" id="start_date_candidate" class="form-control" style="height: 30px;width: 126px">
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <label for="end_date">Đến</label>
                                <input type="date" name="end_date" value="{{ $edate }}" id="end_date_candidate" class="form-control" style="height: 30px;width: 126px">
                            </div>
                            <button type="submit"   id="filterButtonCandidate" class="btn btn-primary" style="height: 30px;padding-top: 2px;">Áp dụng</button>
                            <div id="error-message" class="error-message"></div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <div id="chartcandidate" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between ">
                        <h3 class="card-title" id="btn-client" style="padding-top: 4px">Lượt đăng bài</h3>
                        <div class="d-flex ">
                            <div class="form-group d-flex align-items-center">
                                <label for="start_date">Từ</label>
                                <input type="date" name="start_date" value="{{ $sdate }}" id="start_date_post" class="form-control" style="height: 30px;width: 126px">
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <label for="end_date">Đến</label>
                                <input type="date" name="end_date" value="{{ $edate }}" id="end_date_post" class="form-control" style="height: 30px;width: 126px">
                            </div>
                            <button type="submit"   id="filterButtonPost" class="btn btn-primary" style="height: 30px;padding-top: 2px;">Áp dụng</button>
                            <div id="error-message" class="error-message"></div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <div id="chartpost" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('assets/admin-bower/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        $(function() {
            
            var chart_company = new Morris.Bar({
                element: 'chartcompany',
                data:
                {!! $data_company !!}
                ,
                xkey: 'period',
                ykeys: ['total_company'],
                labels: ['Số Company được tạo']
            });
            document.getElementById('filterButton').addEventListener('click', function() {
                var startDate = document.getElementById('start_date').value;
                var endDate = document.getElementById('end_date').value;
                console.log("Start Date: " + startDate);
                console.log("End Date: " + endDate);
                if ((new Date(startDate) > new Date(endDate))||startDate ==''||endDate == '') {
                    // document.getElementById('error-message').innerText = "Ngày tháng sai";
                    alert('sai định dạng');
                    return; // Ngăn chặn các hành động tiếp theo
                }
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: "{{url('/admin/api-company')}}", // This is the URL to the API
                    data: { 
                        "startDate": startDate, 
                        "endDate": endDate, 
                        "_token": $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        chart_company.setData(data);
                    },
                    error: function(error) {
                        console.log('Error fetching data', error);
                    }
                })
            });
            //chert candidate
            var chart_candidate = new Morris.Bar({
                element: 'chartcandidate',
                data:
                {!! $data_candidate !!}
                ,
                xkey: 'period',
                ykeys: ['total_candidate'],
                labels: ['Số ứng viên tạo tài khoản']
            });
            document.getElementById('filterButtonCandidate').addEventListener('click', function() {
                var startDate = document.getElementById('start_date_candidate').value;
                var endDate = document.getElementById('end_date_candidate').value;
                console.log("Start Date: " + startDate);
                console.log("End Date: " + endDate);
                if ((new Date(startDate) > new Date(endDate))||startDate ==''||endDate == '') {
                    // document.getElementById('error-message').innerText = "Ngày tháng sai";
                    alert('sai định dạng');
                    return; // Ngăn chặn các hành động tiếp theo
                }
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: "{{url('/admin/api-candidate')}}", // This is the URL to the API
                    data: { 
                        "startDate": startDate, 
                        "endDate": endDate, 
                        "_token": $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        chart_candidate.setData(data);
                    },
                    error: function(error) {
                        console.log('Error fetching data', error);
                    }
                })
            });
            //chart post
            var chart_post = new Morris.Bar({
                element: 'chartpost',
                data:
                {!! $data_post !!}
                ,
                xkey: 'period',
                ykeys: ['total_post'],
                labels: ['Số bài đăng được thông qua']
            });
            document.getElementById('filterButtonPost').addEventListener('click', function() {
                var startDate = document.getElementById('start_date_post').value;
                var endDate = document.getElementById('end_date_post').value;
                console.log("Start Date: " + startDate);
                console.log("End Date: " + endDate);
                if ((new Date(startDate) > new Date(endDate))||startDate ==''||endDate == '') {
                    // document.getElementById('error-message').innerText = "Ngày tháng sai";
                    alert('sai định dạng');
                    return; // Ngăn chặn các hành động tiếp theo
                }
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: "{{url('/admin/api-post')}}", // This is the URL to the API
                    data: { 
                        "startDate": startDate, 
                        "endDate": endDate, 
                        "_token": $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        chart_post.setData(data);
                    },
                    error: function(error) {
                        console.log('Error fetching data', error);
                    }
                })
            });
    });
    </script>
@endsection
