@extends('admin.layout.app')
@section('title')
    {{ __('Công ty') }}
@endsection
<style>
  body {font-family: Arial, Helvetica, sans-serif;}
  
  #myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
  }
  .cursoi {
    cursor: pointer;
  }
  .ds-block {
    display: block !important;
  }
  #myImg:hover {opacity: 0.7;}
  
  /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 30px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
  }
  
  /* Modal Content (image) */
  .modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 500px;
  }
  
  /* Caption of Modal Image */
  #caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
  }
  
  /* Add Animation */
  .modal-content, #caption {  
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
  }
  
  @-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
  }
  
  @keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
  }
  
  /* The Close Button */
  .close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
  }
  
  .close:hover,
  .close:focus {
    color: rgb(246, 241, 241);
    text-decoration: none;
    cursor: pointer;
  }
  
  /* 100% Image Width on Smaller Screens */
  @media only screen and (max-width: 700px){
    .modal-content {
      width: 100%;
    }
  }
  </style>
@section('content')
@if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
    @endif
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{$title}}</h3>
              <form action="" class="form-inline float-right mr-3">
                <div class="form-group">
                    <input class="form-control" name="key" id="key" placeholder="Nhập tiêu đề bài đăng ....">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            </div>
            {{-- <a href="{{route('admin.company.trash')}}" class="btn btn-primary mt-4 mx-4" style="width: 150px">thùng rác <i class="fa fa-trash"></i></a> --}}
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped dataTable dtr-inline">
                <thead>
                <tr>
                  <th>STT</th>
                  <th>Tiêu đề bài đăng</th>
                  <th>Tên công ty</th>
                  <th>Ngày gửi yêu cầu</th>
                  <th>xem chi tiết</th>
                  <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                  
                    @foreach($companies as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->company->company_name}}</td>
                        <td>
                          {{$item->date_request}}
                        </td>
                        <td>
                            <a target="_blank" href="{{route('job-detail', $item->id)}}" class="btn btn-success">
                                Chi tiết
                            </a>
                        </td>
                        <td>
                            <form action="{{route('admin.post.accept', $item->id)}}" method="post">
                                @csrf
                                @method('post')
                                {{-- <input type="hidden" name="id" value="{{$item->id}}"> --}}
                                <button value="submit" data-id="{{$item->id}}" class="btn btn-primary chap-nhan-bai-dang"><span class="text-white">Chấp nhận bài đăng</span></button>
                              </form>
                            <a href="{{route('admin.post.refuse', $item->id)}}"  data-id="{{$item->id}}" class="btn btn-danger tu-choi-bai-dang"><span class="text-white">Từ chối bài đăng</span></a>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div class="text-center mt-3">
                {{$companies->appends(request()->all())->links()}} 
            </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
@endsection
@section('script')
@parent
<script src="{{asset('js/admin/duyet-bai.js')}}"></script>
@endsection