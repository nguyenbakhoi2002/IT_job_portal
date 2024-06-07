<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>@yield('title', 'Dashboard')</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    {{-- <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"> --}}
    @section('style')
        @include('admin.layout.style')
    @show
    <style>
        a{
            text-decoration: none !important;
        }
        #emptySeekerModal.modal{
            min-width: 100%;
        }
        #emptySeekerModal.modal .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        #emptySeekerModal.modal .modal-content {
            margin-top: auto;
            margin-bottom: auto;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        {{-- modal báo ko có profile --}}
        <div id="modaltuchoibaidang" class="modal fade" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Lý do từ chối duyệt bài đăng</h4>
                    </div>
                    <form id="tuChoiBaiDangForm" method="POST" action="{{route('admin.post.refuse')}}">
                        @csrf
                        <div class="modal-body">
                            <p>Hãy nêu lý do để nhà tuyển dụng có thể thấy và chỉnh sửa.</p>
                            {{-- @if(!empty(auth('candidate')->user())) 
                                <input type="hidden" name="candidate_id" value="{{auth('candidate')->user()->id}}"> 
                                <input type="hidden" name="name" value="{{auth('candidate')->user()->name}}"> 
                                @if(!empty(auth('candidate')->user()->email))<input type="hidden" name="email" value="{{auth('candidate')->user()->email}}"> @endif
                                @if(!empty(auth('candidate')->user()->phone)) <input type="hidden" name="phone" value="{{auth('candidate')->user()->phone}}"> @endif
                            @endif --}}
                            {{-- <input type="text" name="title" id="cvTitle" class="form-control" placeholder="Nhập tiêu đề CV"> --}}
                            <input type="hidden" name="post_id" id="postId" value="">
                            <textarea  class="form-control" name="reason" placeholder="Nhập lý do từ chối duyệt" id="" cols="30" rows="10"></textarea>
                            <small class="val_info_title text-danger pl-4"></small>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Hủy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end modal --}}
        <!-- Navbar -->
        @include('admin.layout.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.layout.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    @yield('content')

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

    </div>
    <!-- ./wrapper -->
    @section('script')
        @include('admin.layout.script')
    @show
    @include('admin.layout.toastr')
</body>

</html>
