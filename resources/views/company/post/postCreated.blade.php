@extends('company.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <!-- Ls widget -->
            <div class="ls-widget">
                <div class="tabs-box">
                    <div class="widget-title">
                        <h4>{{ $title }}</h4>
                        <div class="chosen-outer ">
                            <form action="" class="form-inline float-right mr-3">
                                <div class="form-group d-flex ">
                                    <input class="form-control" name="key" id="key" placeholder="Nhập tên công việc ....">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="widget-content">
                        <div class="table-outer">
                            {{-- table --}}
                            <table class="default-table manage-job-table">
                                <thead>
                                    <tr>
                                        <th>Tin tuyển dụng</th>
                                        <th>Ngày hết hạn</th>
                                        <th>Trạng thái</th>
                                        <th>Hành vi</th>
                                        <th>Đăng bài</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_jobs as $item)
                                        <tr>
                                            <td>
                                                <h6>{{ $item->title }}</h6>
                                                {{-- <span><a class="btn bg-light btn-sm " href="{{ route('company.profileApply', $item->id) }}"> Xem CV đã ứng tuyển</a></span> --}}
                                            </td>
                                            <td>
                                                <h6>{{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}</h6>
                                            </td>
                                            <td class='status-wait-{{$item->id}}'>
                                                @if ($item->status == 1)
                                                    <p class="text-success">Hoạt động</p>
                                                @elseif($item->status == 2)
                                                    <p class="text-danger">Bị từ Chối duyệt</p>
                                                @elseif($item->status == 3)
                                                    <p class="text-warning">Đợi duyệt</p>
                                                @else
                                                    <p class="text-primary">Trạng thái ban đầu</p>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="option-box">
                                                    <ul class="option-list d-block text-center">
                                                        <li class="mb-2"><a target="_blank" href="{{route('job-detail', $item->id)}}"><button
                                                                    data-text="Chi tiết"><span class="la la-eye"></span></button></a></li>
                                                        <li class="mb-2"><a href="{{ route('company.post.edit', $item) }}"><button
                                                                        data-text="Chỉnh sửa tin"><span class="la la-pencil"></span></button></a></li>
                                                        <li><a href="{{ route('company.post.destroy', $item) }}"><button
                                                                    data-text="Xóa tin"><span class="la la-trash"></span></button></a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <form action="{{route('company.postPost', $item->id)}}" method="post">
                                                    @csrf
                                                    @method('post')
                                                    {{-- <input type="hidden" name="id" value="{{$item->id}}"> --}}
                                                    <button value="submit" data-id="{{$item->id}}" class="btn btn-primary dangbai"><span class="text-white">Đăng bài</span></button>
                                                  </form>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                            <div>
                                {{ $list_jobs->appends(request()->all())->links() }}
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- End Info Section -->
    @endsection
    @section('script')
        @parent
        <script src="{{asset('js/company/dangbai.js')}}"></script>

    @endsection
