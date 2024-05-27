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
                                        <button
                                        class="theme-btn btn-style-one  "
                                        type="submit"
                                        {{-- href="{{url("company/filter")}}" --}}
                                        {{-- id="search_filter" --}}
                                        >
                                        Tìm kiếm
                                    </button>
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
            <th>Học vấn</th>
            <th>kinh nghiệm</th>
            {{-- <th>Công việc ứng tuyển</th> --}}
            <th>Ngày lưu</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        {{-- list_seekerProfile chỉ là danh sách những ứng viên đã lưu thôi, lười đổi tên biến :)) --}}
        @foreach ($list_seekerProfile as $item)
        @php
            // dd($item->seekerProfileMain->id);
        @endphp
            <tr>
                <td>
                    <h6>{{ $item->name }}</h6>
                    <a target="_blank" href="{{route('company.profilePreview', $item->seekerProfileMain)}}" class="btn btn-primary text-white" >Chi tiết</a>
                    {{-- <span>{{ $item->pivot->seen == 1 ? "Đã xem" : "Chưa xem" }}</span> --}}
                </td>
                <td>
                    @foreach ($item->seekerProfileMain->educations as $edu)
                        <i class="fa-solid fa-book-open me-2"></i>{{$edu->school_name}} - {{$edu->degree->name}}
                    @endforeach  
                </td>
                <?php
                    $totalExperience = $item->seekerProfileMain->total_experience;
                    if ($totalExperience >= 1) {
                        $formattedExperience = floor($totalExperience).' năm kinh nghiệm'; // Làm tròn xuống nếu lớn hơn hoặc bằng 1
                    } else {
                        $formattedExperience = round($totalExperience * 12) . ' tháng kinh nghiệm'; // Chuyển đổi thành số tháng nếu nhỏ hơn 1
                    }
                ?>
                <td>
                    {{$formattedExperience}}
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($item->pivot->created_at)->format('d-m-Y')}}
                </td>
                <td>
                    <a style="top: 0px; display:flex; justify-content:center;align-items:center; padding: 10px;
                    background-color: red;
                    width: 70px;
                    color: white;border-radius: 10px" 
                    href="{{route('company.cancelSaveSeeker', $item->id)}}">
                        Bỏ lưu
                    </a>
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
