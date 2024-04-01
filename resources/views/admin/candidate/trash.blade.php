@extends('admin.layout.app')
@section('title')
    {{ __('Company-Thùng rác') }}
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
<section class="content">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
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
                  <input class="form-control" name="key" id="key" placeholder="Nhập tên tài khoản ....">
                  <button type="submit" class="btn btn-primary">
                      <i class="fas fa-search"></i>
                  </button>
              </div>
          </form>
          </div>
          <a href="{{route('admin.candidate.trash')}}" class="btn btn-primary mt-4 mx-4" style="width: 150px">thùng rác <i class="fa fa-trash"></i></a>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-striped dataTable dtr-inline">
              <thead>
              <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Ảnh đại diện</th>
                <th>Email / Số điện thoại</th>
                {{-- <th>Đánh giá</th> --}}
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th><a href="{{route('admin.candidate.create')}}"><i class="fa fa-plus"></i></a></th>
              </tr>
              </thead>
              <tbody>
                
                  @forelse($candidates as $item)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->name}}</td>
                      @if ($item->user_image)
                      <td class="text-center"><img width="100px" src="{{asset('uploads/images/candidate/'. $item->user_image)}}" alt=""></td>
                      @else
                      <td class="text-center"><img width="100px" height="100px" src="{{asset('uploads/images/candidate/logo_default_candidate.jpg')}}" alt=""></td>
                      @endif
                      {{-- <td>{{$item->email}}</td>
                      <td>{{$item->phone}}</td> --}}
                      
                      
                      <td>
                        <label for="">Email:</label>
                        <p class="d-inline-block">{{$item->email}}</p><br>
                        <label for="">SĐT:</label>
                        <p class="d-inline-block">{{$item->phone}}</p>
                      </td>
                      <td>
                          <form action="{{route('admin.candidate.status',  $item->id)}}" method="post">
                            @csrf
                            @method('post')
                            <select class="stu" name="status" data-id="{{$item->id}}">
                              <option @if($item->status == 0) selected @endif value="0">Chặn</option>
                              <option @if($item->status == 1) selected @endif value="1">Hoạt động</option>
                            </select>
                          </form>
                      </td>
                      <td>{{$item->created_at}}</td>

                      <td class="project-actions xoa text-right d-flex align-items-center">
                        <a href="{{route('admin.candidate.restore', $item->id)}}" class="btn btn-success mx-3 ">Khôi phục</a>
                        {{-- <a href="{{route('admin.company.forceDelete', $item->id)}}" onclick="return confirm('Bạn có chắn chắn muốn xóa')" class="btn btn-danger mx-3">Xóa</a> --}}
                        <button data-id="{{$item->id}}" class="btn btn-danger btn-delete">Xóa vĩnh viễn<i class="fa fa-trash mx-2"></i></button>

                    </td>
                  </tr>
                  @empty
                    <tr>
                      <td colspan="9">Trống</td>
                    </tr>
                  @endforelse

              </tbody>
            </table>
            <div class="text-center mt-3">
              {{$candidates->appends(request()->all())->links()}} 
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