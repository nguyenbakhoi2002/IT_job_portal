<table class="default-table manage-job-table" data-pageApplied>
    <thead>
        <tr>
            <th>Ứng viên</th>
            <th>Thông tin liên hệ </th>
            <th>Ngày apply</th>
            <th>Chi tiết</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list_seekerProfile as $item)
            <tr>
                <td>
                    <h6>{{ $item->name }}</h6>
                    <span>{{ $item->pivot->seen == 1 ? "Đã xem" : "Chưa xem" }}</span>
                </td>
                <td>
                    {{ $item->phone }} <br>{{ $item->email }}
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($item->pivot->created_at)->format('d-m-Y')}}
                </td>
                <td><a target="_blank" href="">Chi tiết</a></td>
            </tr>
        @endforeach
    </tbody>
    {{-- <tfoot>
        <tr>
            <td><nav class="ls-pagination">
              {{$list_seekerProfile->links('company.layout.paginate')}}
             </nav>
            </td>
          </tr>
    </tfoot> --}}
</table>
<div class="text-center mt-3">
    {{$list_seekerProfile->appends(request()->all())->links()}} 
</div>
