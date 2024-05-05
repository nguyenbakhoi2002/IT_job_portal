@extends('company.layout.app')
@section('title')
    Cập nhật giấy phép kinh doanh
@endsection
@section('style')
  @parent
  <style>
    .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1000; /* Sit on top */
  padding-top: 150px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
  left: 50%;
    transform: translateX(-50%);
    /* display: block; */
    padding-left: 0px;
}

/* Style the close button */
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
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* Style the Image */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}
.modal-content {
  position: absolute; /* Đặt nội dung modal ở vị trí tuyệt đối */
  left: 50%; /* Đặt nội dung modal ở giữa theo chiều ngang */
  top: 50%; /* Đặt nội dung modal ở giữa theo chiều dọc */
  transform: translate(-50%, -50%); /* Dịch chuyển modal ngược lại 50% chiều rộng và chiều cao của nó */
  background-color: #fefefe; /* Màu nền cho nội dung modal */
  margin: auto; /* Tự động canh giữa */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Chiều rộng của nội dung modal */
  max-width: 600px; /* Chiều rộng tối đa của nội dung modal */
  max-height: 80%; /* Chiều cao tối đa của nội dung modal */
  overflow-y: auto; /* Cho phép cuộn nếu nội dung quá dài */
}
  </style>
@endsection
@section('content')
<section class="user-dashboard">
  <div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
  </div>
    <div class="dashboard-outer">
      
      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="upper-title-box">
                <h3 style="text-align: center; top: 20px">Giấy phép kinh doanh</h3>
              </div>
              <div class="widget-title">
                <h4>Thông tin giấy phép kinh doanh</h4>
              </div>
              <div class="widget-content">
                {{-- @dd($data); --}}
                <form class="default-form" action="{{route('company.imagePaperUpdate')}}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="form-group col-lg-6 col-md-12">
                  @if ($data->image_paper)
                    <label>Trạng thái :</label> 
                      @if ($data->status == 0)
                      <span class="text-warning" style="font-weight: 900">Chờ duyệt</span>
                      @elseif ( $data->status == 1)
                      <span class="text-success" style="font-weight: 900">Xác thực thành công</span>
                      @else
                      <span class="text-danger" style="font-weight: 900">Xác thực thất bại</span>
                      @endif
                  @endif
                </div>
                <div class="form-group col-lg-6 col-md-12">
                    <label>Giấy phép kinh doanh / Giấy ủy quyền</label>    
                </div>
                  
                <div class="form-group">
                  <label class="form-label w-100">giấy phép kinh doanh</label>
                  <img id="image" class="click-to-zoom" src="{{ $data->image_paper?asset('uploads/images/image_paper/'. $data->image_paper):'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg'}}" alt="your image"
                      style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                  <input name="hinhanh_upload_image_paper" type="file" id="img">
                  {{-- <small class="form-text text-muted">Chọn ảnh kích thước nhỏ hơn 5mb</small> --}}
                </div>
                <input type="text" value="{{$data->image_paper}}" hidden name="hinhanh_upload_image_paper_hd">
                  <div class="text">Dung lượng file không vượt quá 5MB</div>
                  @error('hinhanh_upload_image_paper')
                      <small class="text-danger">{{$message}}</small>
                  @enderror
              </div>

                {{-- <input type="hidden" name="hinhanh_upload_image_paper" value="{{$data->image_paper}}"> --}}
                    <div class="form-group col-lg-6 col-md-12">
                      <button class="theme-btn btn-style-one">Lưu</button>
                    </div>
                    {{-- <div class="form-group col-lg-6 col-md-12">
                      <label>Tài liệu hướng dẫn</label>    
                  </div> --}}
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>
@endsection
@section('script')
  @parent
  <script>
   document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('myModal');
    var modalImg = document.getElementById('img01');
    var images = document.querySelectorAll('.click-to-zoom');

    images.forEach(function(image) {
        image.addEventListener('click', function() {
            modal.style.display = 'block';
            modalImg.src = this.src;
        });
    });

    var span = document.getElementsByClassName('close')[0];

    span.onclick = function() {
        modal.style.display = 'none';
    };

    modal.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
});
</script>
@endsection