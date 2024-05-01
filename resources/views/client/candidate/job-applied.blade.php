@extends('client.layout.app')
@section('title')
    BaKhoi|Công việc đã ứng tuyển
@endsection
@section('content')
    <section class="user-dashboard pt-5 mt-5">
      <div class="dashboard-outer">
        <div class="row pt-5">
          <div class="col-lg-12">
            <!-- Ls widget -->
            <div class="ls-widget">
              <div class="tabs-box">
                <div class="widget-title">
                  <h3 style="margin: auto">Danh sách {{count($job_applied)}} công việc đã ứng tuyển</h3>

                  <div class="chosen-outer">
                    <!--Tabs Box-->
                    {{-- <select class="chosen-select">
                      <option>Last 6 Months</option>
                      <option>Last 12 Months</option>
                      <option>Last 16 Months</option>
                      <option>Last 24 Months</option>
                      <option>Last 5 year</option>
                    </select> --}}
                  </div>
                </div>

                <div class="widget-content">
                  <div class="table-outer">
                    <table class="default-table manage-job-table">
                      <thead>
                        <tr>
                          <th>Thông tin công việc</th>
                          <th>Ngày ứng tuyển</th>
                          <th>Trạng thái</th>
                          <th>Hành động</th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach($job_applied as  $item)
                        <tr>
                          <td>
                            <!-- Job Block -->
                            <div class="job-block">
                              <div class="inner-box">
                                <div class="content d-flex">
                                  <span class="company-logo" style="width:100px; height: 50px"><img style="width:100px; height: 50px" src="{{asset('/uploads/images/company/'.$item->jobPost->company->logo)}}" alt=""></span>
                                  <div class="ms-5">
                                    <h4><a href="{{route('job-detail', $item->jobPost)}}">{{$item->jobPost->title}}</a></h4>
                                    <ul class="" style="padding: 0px">
                                        <li><span class="icon flaticon-briefcase"></span> {{$item->jobPost->company->company_name}}</li>
                                        <li><span class="icon flaticon-map-locator"></span>{{$item->jobPost->company->address}}</li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>{{$item->created_at}}</td>
                          <td>
                          @if ($item->seen==0)
                            <div class=" btn btn-primary">Nhà tuyển dụng đã nhận</div>
                          @elseif($item->seen==1)  
                            <div class=" btn btn-warning">Nhà tuyển dụng đã xem</div>
                          @elseif($item->seen==2)  
                            <div class=" btn btn-secondary">Đánh giá là chưa phù hợp</div>
                          @else
                            <div class=" btn btn-success">Đánh giá là phù hợp</div>
                          @endif
                        </td>
                          <td>
                            <div class="option-box">
                              <ul class="option-list">
                                <li><a href="{{route('profilePreview', $item->seeker)}}"><button data-text="View Profile"><span class="la la-eye"></span></button></a></li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </section>
@endsection