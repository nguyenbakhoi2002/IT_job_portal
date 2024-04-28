<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Home')</title>
    @section('style')
        @include('client.layout.style')
    @show
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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

<body data-anm=".anm">
    <div class="page-wrapper">
        <div class="preloader"></div>
        @include('client.layout.header')
        {{-- modal báo ko có profile --}}
        <div id="emptySeekerModal" class="modal fade" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Thông báo</h4>
                    </div>
                    <form id="createCVForm" method="POST" action="{{route('createProfile')}}">
                        @csrf
                        <div class="modal-body">
                            <p>Bạn chưa có CV. Hãy nhập tiêu đề CV để tiếp tục.</p>
                            @if(!empty(auth('candidate')->user())) 
                                <input type="hidden" name="candidate_id" value="{{auth('candidate')->user()->id}}"> 
                                <input type="hidden" name="name" value="{{auth('candidate')->user()->name}}"> 
                                @if(!empty(auth('candidate')->user()->email))<input type="hidden" name="email" value="{{auth('candidate')->user()->email}}"> @endif
                                @if(!empty(auth('candidate')->user()->phone)) <input type="hidden" name="phone" value="{{auth('candidate')->user()->phone}}"> @endif
                            @endif
                            <input type="text" name="title" id="cvTitle" class="form-control" placeholder="Nhập tiêu đề CV">
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
        @yield('content')
        @if (!isset($excludeFooter))
            @include('client.layout.footer')
        @endif
        <!-- End Main Footer -->
    </div>
    @section('script')
        @include('client.layout.script')
        @include('admin.layout.toastr')

        
    @show
    {{-- @include('admin.layout.toastr') --}}
</body>

</html>
