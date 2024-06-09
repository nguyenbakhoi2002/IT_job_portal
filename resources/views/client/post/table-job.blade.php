<div class="ls-outer" aria-live="polite">
    <div class="row searchpate" id="paginated-list" >
        @forelse ($data as $item)
                <div class="job-block col-lg-4 col-md-6 col-sm-12 pagi">
                    <div class="inner-box" style="height:160px; padding: 10px 10px">
                        <div class="content-box d-flex justify-content-center align-items-center" style="height:140px;">
                            <div class="content-logo  me-3">
                                <img class="rounded" style="width:100px; height: 100px;" src="{{asset('uploads/images/company/'.$item->company->logo)}}"alt="">
                            </div>
                            <div class="content-info col-8">
                                <ul class="" style="padding-left: 0; margin-top: 10px;">
                                    <li >
                                        <a class="info-high fw-bold" style="font-size: 20px;" href="{{ route('job-detail', $item) }}">{{ $item->title }}</a>
                                    </li>
                                    <li class=" info-high" style="color: #5d677a">{{ $item->company->company_name }}</li>

                                    <li style="color: #008563 "><i class="fa-solid fa-dollar-sign"></i>{{number_format($item->min_salary, 0, ',', '.')}} - {{number_format($item->max_salary, 0, ',', '.')}} VNĐ</li>
                                    @foreach ($dataProvinces as $value)
                                        @if($value['Id'] == $item->area)
                                        <li><span class="icon flaticon-map-locator"></span>{{$value['Ten']}}</li>
                                        @endif
                                    @endforeach
                                    @if ($current_date->diff($item->end_date)->days>0)
                                        <li>còn {{$current_date->diff($item->end_date)->days}} ngày</li>
                                    @else
                                        <li>còn  {{24 - $current_date->diffInHours($item->end_date)}} giờ</li>
                                    @endif
                                    @if (auth('candidate')->check())
                                        @if (!in_array($item->id, auth('candidate')->user()->saved_jobs->pluck('id')->toArray()))
                                            <a style="top: 0px" href="{{route('saveJob', $item->id)}}"><button
                                                    class="bookmark-btn"><span
                                                        class="flaticon-bookmark"></span></button></a>
                                        @else
                                                <a style="top: 0px" href="{{route('cancelSaveJob', $item->id)}}">
                                                    <button class="bookmark-btn">
                                                        <span><i class="fa-solid fa-bookmark"></i></span>
                                                    </button>
                                                </a>
                                        @endif
                                    @else
                                        <a style="top: 0px" href="#"><button
                                            class="bookmark-btn"><span
                                                class="flaticon-bookmark"></span></button></a>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
        @empty
        <div>
            Không có công việc phù hợp
        </div>
        @endforelse
    </div>
    {{-- <nav class="ls-pagination">
        @if (!empty($urlWith))
            {{$data->appends($urlWith)->links('company.layout.paginate')}}
        @else
            {{$data->links('company.layout.paginate')}}
        @endif
       </nav> --}}
</div>
<div class="text-center mt-3" style="display: flex;
    justify-content: center;">
    {{$data->appends(request()->all())->links()}} 
</div>