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
                    {{$item->seekerProfileRequest($item->degree->level, $item->experience->level, $item->skills->pluck('id')->toArray())->count()}} 
                    (đáp ứng)
                    /{{$item->activities->count()}}(ALL)<br> Ngày hết hạn:
                    {{ date_format(new DateTime($item->end_date), 'd/m/Y') }}</td>
                @if ($item->status == 1)
                    <td><p class="text-success">active</p></td>
                @else
                    <td><p class="text-danger">block</p></td>
                @endif

                <td>
                    <div class="option-box">
                        <ul class="option-list d-block text-center">
                            <li class="mb-2"><a target="_blank" href=""><button
                                        data-text="Chi tiết"><span class="la la-eye"></span></button></a></li>
                            <li><a href="{{ route('company.post.edit', $item) }}"><button
                                        data-text="Chỉnh sửa tin"><span class="la la-pencil"></span></button></a></li>
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
