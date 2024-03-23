<div class="ls-outer" aria-live="polite">
    <div class="row searchpate" id="paginated-list" >
        @foreach ($data as $item)
                <div class="job-block col-lg-4 col-md-6 col-sm-12 pagi">
                    <div class="inner-box" style="height:160px; padding: 10px 10px">
                        <div class="content-box d-flex justify-content-center align-items-center" style="height:140px;">
                            <div class="content-logo  me-3">
                                <img class="rounded" style="width:100px; height: 100px;" src="{{asset('uploads/images/company/'.$item->company->logo)}}"alt="">
                            </div>
                            <div class="content-info col-8">
                                <ul class="">
                                    <li >
                                        <a class="info-high fw-bold" href="{{ route('job-detail', $item) }}">{{ $item->title }}</a>
                                    </li>
                                    <li class=" info-high lead fw-light">{{ $item->company->company_name }}</li>

                                    <li>{{number_format($item->min_salary, 0, ',', '.')}} - {{number_format($item->max_salary, 0, ',', '.')}} VNĐ</li>
                                    <li>còn {{$current_date->diff($item->end_date)->days}} ngày</li>

                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
        @endforeach
    </div>
    {{-- <nav class="ls-pagination">
        @if (!empty($urlWith))
            {{$data->appends($urlWith)->links('company.layout.paginate')}}
        @else
            {{$data->links('company.layout.paginate')}}
        @endif
       </nav> --}}
</div>