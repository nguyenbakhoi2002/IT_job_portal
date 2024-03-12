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
                            @include('company.post.tablePosts')
                            
                           
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
        
        <script>
            $( document ).ready(function() {
                $(".btn_profileApplied").on("click", function(e) {
                e.preventDefault();
                var url=$(this).attr("href");
                window.history.pushState({}, null,url);
                $.get(url, function(data) {
                    $(".row").html(data);
                });
                return false;
             })
            });
        </script>
    @endsection
