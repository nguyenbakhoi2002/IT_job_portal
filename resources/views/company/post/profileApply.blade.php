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
                          @include('company.post.tableProfileApply')
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
