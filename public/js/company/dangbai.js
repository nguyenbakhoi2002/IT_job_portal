/******/ (() => { // webpackBootstrap
    // var __webpack_exports__ = {};
    
    $(document).ready(function () {
      //sự kiến click vào nút xóa trong thùng rác
      $('.btn-delete').click(function (e) {
        //ngăn chặn hàng động mặc định của trình duyệt là chuyển hướng tới một trang mới
        e.preventDefault();
        var arrayUrl = $(location).attr('pathname').split('/');
        var model = arrayUrl[arrayUrl.length - 1];
        console.log(model);
        //vì trong tên đặt ở controller có "-trash" VD "company-trash", mà ở controller force-delete lại là company-force-delete
        // nên p loại bỏ "trash" 
        var new_model =model.split('-')[0];
        console.log(new_model);
        var id = $(this).data('id');
    
        // var url ="".concat(new_model, "-forceDelete/").concat(id);
        // console.log(url);
        Swal.fire({
          icon: 'warning',
          text: 'Bạn có muốn xóa?',
          showCancelButton: true,
          confirmButtonText: 'Yes',
          confirmButtonColor: '#e3342f',
          cancelButtonText: 'No'
        }).then(function (results) {
          if (results.isConfirmed) {
            var data = {
              "_token": $('meta[name="csrf-token"]').attr('content'),
              "id": id
            };
            $.ajax({
              type: "GET",
              url: "".concat(new_model, "-forceDelete/").concat(id),
              data: data,
              success: function success(response) {
                Swal.fire(response.success, {
                  icon: "success"
                }).then(function (result) {
                  location.reload();
                });
              },
             
            });
          }
        });
      });
      //bắt sự kiện thay đổi status
      $('.dangbai').click(function (e) {
        console.log('đã đăng');
        e.preventDefault();
        //  Lấy địa chỉ URL hiện tại và tách nó thành một mảng dựa trên dấu gạch chéo (/).
        var arrayUrl = $(location).attr('pathname').split('/');
        console.log(arrayUrl);
        // lấy ptu cuối cùng
        var model = arrayUrl[arrayUrl.length - 1];
        console.log(model);
        // lấy giá trị của thuộc tính data-id
        var id = $(this).data('id');
        console.log(id);
        var status = $(this).val();
        console.log(status);
        var url ="".concat(model, "-status/").concat(id);
        console.log(url);
        console.log($('.stu'));
        // alert(status);
        var data = {
          "_token": $('meta[name="csrf-token"]').attr('content'),
          "id": id,
        //   "status": status
        };
        console.log(data);
        Swal.fire({
            icon: 'warning',
            title: 'Bạn có chắc chắn muốn đăng bài',
            text: 'Hãy chắc chắn rằng bài đăng của bạn không vi phạm nội quy của chúng tôi',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#C46F01',
            cancelButtonText: 'Hủy'
          }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    //cho giống đường dẫn controller status
                    url: "".concat(model, "-status/").concat(id),
                    data: data,
                    success: function success(response) {
                      console.log(id);
                      var dataInfo = '<p class="text-warning">Đợi duyệt</p>';
                      $('.status-wait-' + id).html(dataInfo);
                      console.log($('.status-wait' + id))
                      toastr.success(response.success);
                    },
                    error: function error(response) {
                      toastr.error("Cập nhật trạng thái thất bại");
                    }
                });
              }
            });
        
      });
      
    });
    
    /******/ })()
    ;