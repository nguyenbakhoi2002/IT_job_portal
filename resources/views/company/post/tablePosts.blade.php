<table class="default-table manage-job-table">
    <thead>
        <tr>
            <th>Tin tuyển dụng</th>
            <th>Chi tiết</th>
            <th>Trạng thái</th>
            <th>
                <button class="add-info-btn text-center"><a href="{{ route('company.post.create') }}"><span
                            class="icon flaticon-plus"></span></a></button>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list_jobs as $item)
            <tr>
                <td>
                    <h6>{{ $item->title }}</h6>
                    <span><a class="btn bg-light btn-sm "
                            href="{{ route('company.profileApply', $item->id) }}"> Xem CV</a></span>
                </td>
                <td>Lượt ứng tuyển:
                    @php
                        $total = 0;
                        $all_profile=$item->activities;
                        foreach ($all_profile as $it) {
                            $satisfyString = $it->satisfy;
                            if($satisfyString!=''){
                                $elementsArray = explode('|', $satisfyString);
                                $numberOfElements = count($elementsArray);
                                if($numberOfElements == 4){
                                    $total++;
                                }
                            }
                        }
                    @endphp
                    {{$total}}
                    {{-- {{$item->seekerProfileRequest($item->degree->level, $item->experience->level, $item->skills->pluck('id')->toArray())->count()}}  --}}
                    (đáp ứng)
                    /{{$item->activities->count()}}(ALL)<br> Ngày hết hạn:
                    {{ date_format(new DateTime($item->end_date), 'd/m/Y') }}</td>
                @if ($item->status == 1)
                    <td><p class="text-success">Hoạt động</p></td>
                @elseif($item->status == 2)
                    <td><p class="text-danger">Bị từ Chối duyệt</p></td>
                    @elseif($item->status == 3)
                    <td><p class="text-warning">Đợi duyệt</p></td>
                @else
                    <td><p class="text-primary">Trạng thái ban đầu</p></td>
                @endif

                <td>
                    <div class="option-box">
                        <ul class="option-list d-block text-center">
                            <li class="mb-2"><a target="_blank" href="{{route('job-detail', $item->id)}}"><button
                                        data-text="Chi tiết"><span class="la la-eye"></span></button></a></li>
                            {{-- <li><a href="{{ route('company.post.edit', $item) }}"><button
                                        data-text="Chỉnh sửa tin"><span class="la la-pencil"></span></button></a></li> --}}
                            {{-- <li><button data-text="Delete Aplication"><span class="la la-trash"></span></button></li> --}}
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
    
</table>
<div>
    {{ $list_jobs->appends(request()->all())->links() }}
</div>
