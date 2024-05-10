@extends('company.layout.app')
@section('style')
    @parent
    <style>
        /* để hiện thị tooltip khi hover vào các tiêu chí thỏa mãn trong applied */
        [data-tooltip] {
            position: relative;
            cursor: pointer;
        }

        [data-tooltip]::before {
            content: attr(title);
            position: absolute;
            top:-100px;
            left: -100px;
            background-color: #333;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            white-space: pre-line; /* Hiển thị nội dung trên nhiều dòng */
            display: none;
            transition: opacity 0.3s ease;
            z-index: 999;
        }

        [data-tooltip]:hover::before {
            display: block;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <!-- Ls widget -->
            <div class="ls-widget">
                <div class="tabs-box">
                    <div class="widget-title">
                        <h4>{{ $title }}</h4>
                        <div class="chosen-outer ">
                            <form action="">
                                <div class="input-group " >
                                    <input class="form-control border-end-5 border  ml-2" type="text" name="search"
                                    style="border-radius:20px 0px 0px 20px" 
                                        id="search" placeholder="Tìm kiếm">
                                    <span class="input-group-append">
                                        <button
                                            class="btn btn-outline-warning bg-white border-start-0 border  "
                                            style="border-radius:0px 20px 20px 0px" 
                                            type="button"
                                            href=""
                                            id="button_search">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="widget-content">
                        <div class="table-outer">
                          {{-- @include('company.post.tableProfileApply') --}}
                          
<table class="default-table manage-job-table" data-pageApplied>
    <thead>
        <tr>
            <th>Ứng viên</th>
            <th>Công việc ứng tuyển</th>
            <th>Ngày apply</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list_seekerProfile as $item)
            <tr>
                <td>
                    <h6>{{ $item->name }}</h6>
                    <a target="_blank" href="{{route('profilePreview', $item)}}" class="btn btn-primary text-white" >Chi tiết</a>
                    {{-- <span>{{ $item->pivot->seen == 1 ? "Đã xem" : "Chưa xem" }}</span> --}}
                </td>
                @php
                    $job_post = \App\Models\JobPost::find($item->pivot->job_post_id);
                    echo '<td>'.$job_post->title.'</td>'
                @endphp
                {{-- <td>
                    {{ $job_post->name }}
                </td> --}}
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
                {{-- <td><a target="_blank" href="" class="btn btn-primary text-white" >Chi tiết</a></td> --}}
                {{-- <td><a target="_blank" href="{{route('profilePreview', $item)}}" class="btn btn-primary text-white" >Chi tiết</a></td> --}}
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
  @parent
  <script src="{{asset('js/paginate.js')}}"></script>
  <script src="{{asset('js/company/update-status-profile.js')}}"></script>
  <script>
      $(function() {
        $(document).on("click",".pagination li a,#button_search", function(e) {
            e.preventDefault();
            var url=$(this).attr("href");
            var append = url.indexOf("?") == -1 ? "?" : "&";
            var finalURL = url + append + $("#search").serialize();
            window.history.pushState({}, null, finalURL);
            $.get(finalURL, function(data) {
                $(".table-outer").html(data);
            });
            return false;
        })})
  </script>
  {{-- hiển thị tooltip --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tooltip.js/1.3.0/umd/tooltip.min.js"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-tooltip-title]'));
          var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
              return new Tooltip(tooltipTriggerEl, {
                  title: tooltipTriggerEl.getAttribute('data-tooltip-title'),
                  html: true
              });
          });
      });
  </script>
  {{-- end tooltip --}}
@endsection
