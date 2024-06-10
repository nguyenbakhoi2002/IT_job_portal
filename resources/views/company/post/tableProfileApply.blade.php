
<table class="default-table manage-job-table" data-pageApplied>
    <thead>
        <tr>
            <th>Ứng viên</th>
            <th>Thông tin liên hệ </th>
            <th>Yêu cầu đáp ứng</th>
            <th>Ngày apply</th>
            <th>Chi tiết</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list_seekerProfile as $item)
            <tr>
                <td>
                    <h6>{{ $item->name }}</h6>
                    <a target="_blank" href="{{route('company.profilePreview', ['seeker_profile' =>$item, 'job_post_id'=>$id])}}" class="btn btn-primary text-white" >Xem Profile</a>
                </td>
                <td>
                    {{ $item->phone }} <br>{{ $item->email }}
                </td>
                <td>
                    {{-- @if ( $item->pivot->satisfy)
                        @if (count(explode('|', $item->pivot->satisfy))==4)
                            <div class="btn btn-success">Đủ tiêu chí</div>
                        @else
                            <div class="btn btn-warning">Thỏa mãn {{count(explode('|', $item->pivot->satisfy))}} tiêu chí</div>
                        @endif
                    @else
                        <div class="btn btn-danger">Không thỏa mãn</div>
                    @endif --}}
                    {{-- chỉ để hiện thị thông báo tooltip cho đẹp mắt --}}
                    @php
                        $satisfyItems = explode('|', $item->pivot->satisfy);
                        $title = '';
                    @endphp
                    @foreach (['edu', 'exp', 'skill', 'language'] as $criteria)
                        {{-- kiểm tra xem trong satisfy có phần tử nào --}}
                        @if (in_array($criteria, $satisfyItems))
                            {{-- nếu title không rỗng, thì thêm kí tự xuống dòng --}}
                            @if ($title != '')
                                @php $title .= '&#10;'; @endphp
                            @endif
                            @php $title .= $criteria; @endphp
                        @else
                            {{-- @if ($title != '')
                                @php $title .= '&#10;'; @endphp
                            @endif --}}
                            {{-- @php $title .= $criteria.':'.$item->name.' (loại)'; @endphp --}}
                        @endif
                    @endforeach
                {{-- xong phần hiển thị tooltip --}}
                    @if ( $item->satisfy_count)
                        
                        @if ($item->satisfy_count==4)
                            <div class="btn btn-success" data-tooltip="true" title='edu&#10;exp&#10;skill&#10;language'>Đủ tiêu chí</div>
                        @else
                            <div class="btn btn-warning" data-tooltip="true" 
                                title='{!! $title !!}'>
                                    Thỏa mãn {{$item->satisfy_count}} tiêu chí 
                            </div>
                        @endif
                    @else
                        <div class="btn btn-danger" data-tooltip="true" title='không đáp ứng bất kì tiêu chí nào'>Không thỏa mãn</div>
                    @endif
                   
                    
                   
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($item->pivot->created_at)->format('d-m-Y')}}
                </td>
                <td>
                    <form action="{{route('company.updateStatusAll',  $item->pivot->id)}}" method="post">
                        @csrf
                        @method('post')
                        <select class="status-profile" name="status" data-id="{{$item->pivot->id}}">
                          <option @if($item->pivot->seen == 0) selected @endif value="0">Chưa xem</option>
                          <option @if($item->pivot->seen == 1) selected @endif value="1">Đã xem</option>
                          <option @if($item->pivot->seen == 2) selected @endif value="2">Không phù hợp</option>
                          <option @if($item->pivot->seen == 3)  selected @endif value="3" >Phù hợp</option>
                        </select>
                      </form>
                </td>
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
