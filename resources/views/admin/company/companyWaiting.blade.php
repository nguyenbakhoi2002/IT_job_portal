@extends('admin.layout.app')
@section('title')
    Công ty bị chặn
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
                    <input class="form-control" name="key" id="key" placeholder="Nhập tên công ty ....">
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
                  <th>Tên</th>
                  <th>Tên công ty</th>
                  <th>Ảnh</th>
                  <th>Email / Số điện thoại</th>
                  {{-- <th>Đánh giá</th> --}}
                  <th>Ảnh xác thực</th>
                  <th>Hành vi</th>
                  {{-- <th>Trạng thái</th> --}}
                  {{-- <th><a href="{{route('admin.company.create')}}"><i class="fa fa-plus"></i></a></th> --}}
                </tr>
                </thead>
                <tbody>
                  
                    @foreach($companies as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->company_name}}</td>
                        @if ($item->logo)
                        <td class="text-center"><img width="100px" src="{{asset('uploads/images/company/'. $item->logo)}}" alt=""></td>
                        @else
                        <td class="text-center"><img width="100px" src="{{asset('uploads/images/company/logo_default_company.png')}}" alt=""></td>
                        @endif
                        
                        <td>
                          <label for="">Email:</label>
                          <p>{{$item->email}}</p>
                          <label for="">SĐT:</label>
                          <p>{{$item->phone}}</p>
                        </td>
                        {{-- <td>{{$item->phone}}</td> --}}
                        {{-- <td>
                          chưa làm
                      
                        </td> --}}
                        @if ($item->image_paper)
                          <td><img onclick="modalImg({{$item->id}})" class="myImg{{$item->id}} cursoi" width="100px" src="{{asset('uploads/images/image_paper/'. $item->image_paper)}}" alt=""></td>
                          <div id="myModal" class="myModal{{$item->id}} modal">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="img01{{$item->id}}">
                          </div>
                        @else
                        <td style="color: red;">Chưa cấp ảnh</td>
                        @endif
                        
                        {{-- <td>
                            <form action="{{route('admin.company.status',  $item->id)}}" method="post">
                              @csrf
                              @method('post')
                              <select class="stu" name="status" data-id="{{$item->id}}">
                                <option @if($item->status == 0) selected @endif value="0">Chưa kích hoạt</option>
                                <option @if($item->status == 1) selected @endif value="1">Đã kích hoạt</option>
                                <option @if($item->status == 2) selected @endif value="2">Chặn</option>
                              </select>
                            </form>
                        </td> --}}
                        <td class="project-actions xoa text-right d-flex align-items-center">
                          <a class="btn btn-info mr-3 bo-chan-cong-ty"  data-id="{{$item->id}}" href="">
                            <i class="fa fa-edit"></i>Bỏ chặn
                          </a>
                          {{-- <form action="{{route('admin.company.destroy', $item)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger mt-3"><i class="fa fa-trash"></i></button>
                          </form> --}}
                          {{-- <button data-id="{{$item->id}}" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button> --}}
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
<script src="{{asset('js/admin/candidate.js')}}"></script>
<script src="{{asset('js/admin/duyet-bai.js')}}"></script>
<script>
  function modalImg(id) {
    $('.myModal'+id).addClass('ds-block');
    var srcImg = $('.myImg'+id).prop('src');
    $('#img01'+id).attr('src', srcImg);

    $('.close').click(function () {
      $('.myModal'+id).removeClass('ds-block');
    })
  }
  </script>
@endsection