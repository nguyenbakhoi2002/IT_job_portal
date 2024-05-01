@extends('client.layout.app')
@section('title')
    BaKhoi|Công việc đã lưu
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
                  <h3 style="margin: auto">Danh sách {{count($saved_jobs)}} công việc đã lưu</h3>

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
                          <th>Ngày lưu</th>
                          {{-- <th>Trạng thái</th> --}}
                          <th>Hành động</th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach($saved_jobs as  $item)
                        <tr>
                          <td>
                            <!-- Job Block -->
                            <div class="job-block">
                              <div class="inner-box">
                                <div class="content d-flex">
                                  <span class="company-logo" style="width:100px; height: 50px"><img style="width:100px; height: 50px" src="{{asset('/uploads/images/company/'.$item->company->logo)}}" alt=""></span>
                                  <div class="ms-5">
                                    <h4><a href="{{route('job-detail', $item)}}">{{$item->title}}</a></h4>
                                    <ul class="" style="padding: 0px">
                                        <li><span class="icon flaticon-briefcase"></span> {{$item->company->company_name}}</li>
                                        <li><span class="icon flaticon-map-locator"></span>{{$item->company->address}}</li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>{{\Carbon\Carbon::parse($item->pivot->created_at)->format('d-m-Y H:i') }}</td>
                          {{-- <td>
                          @if ($item->seen==0)
                            <div class=" btn btn-primary">Nhà tuyển dụng đã nhận</div>
                          @elseif($item->seen==1)  
                            <div class=" btn btn-warning">Nhà tuyển dụng đã xem</div>
                          @elseif($item->seen==2)  
                            <div class=" btn btn-secondary">Đánh giá là chưa phù hợp</div>
                          @else
                            <div class=" btn btn-success">Đánh giá là phù hợp</div>
                          @endif
                        </td> --}}
                          <td>
                            <div class="d-flex text-white">

                                @if (count(array_intersect($client_profile, $item->seekerProfile()->pluck('seeker_profile_id')->toArray()))>0)
                                    <a href="{{route('job-detail', $item)}}" class="btn btn-success">Hủy ứng tuyển</a>
                                @else
                                    <a href="{{route('job-detail', $item)}}" class="btn btn-success">Ứng tuyển</a>
                                @endif
                                <a href="{{route('cancelSaveJob', $item->id)}}" class="ms-3 btn btn-secondary">Bỏ lưu</a>
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