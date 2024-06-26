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
        //bắt sự kiện duyêt bài đăng
        $('.chap-nhan-bai-dang').click(function (e) {
          console.log('đã duyệt');
          e.preventDefault();
          // lấy giá trị của thuộc tính data-id
          var id = $(this).data('id');
          var data = {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": id,
          //   "status": status
          };
          console.log(data);
          Swal.fire({
              icon: 'warning',
              title: 'xác nhận duyệt bài',
              text: 'Hãy chắc chắn rằng bạn đã kiểm tra bài viết một cách cẩn thận',
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
                      url: "/itjob_portal/public/admin/job-accept/".concat(id),
                      data: data,
                      success: function success(response) {
                        location.reload();
                        toastr.success(response.success);
                      },
                      error: function error(response) {
                        toastr.error("Cập nhật trạng thái thất bại");
                      }
                  });
                }
              });
          
        });
        //từ chối bài đnăg
        $('#tuChoiBaiDangForm').submit(function (e) {
          //ngăn chặn hành vi load lại trang
          e.preventDefault();
          var url = $('#tuChoiBaiDangForm').attr('action');
          console.log('url: '+ url);
          var form = this;
          console.log('form: '+form);
          var dataForm = new FormData(form);
          console.log('dataForm: '+dataForm);
      
          $.ajax({
            type: "POST",
            url: url,
            data: dataForm,
            //để gửi dữ liệu dạng dataForm
            processData: false,
            contentType: false,
            success: function success(response) {
              console.log('response: '+ response.is_check);
              if (response.error) {
                console.log(response.error);
                toastr.error("Nhập lý do từ chối");
                $('.val_info_title').text(response.error.reason != undefined ? response.error.reason : '');
                
              } else {
                toastr.success(response.success);
                location.reload();
              }
            },
            error: function error(response) {
              toastr.error("Thêm thất bại");
            }
          });
        });
        // $('.tu-choi-bai-dang').click(function (e) {
        //     console.log('đã từ chối');
        //     e.preventDefault();
        //     // lấy giá trị của thuộc tính data-id
        //     var id = $(this).data('id');
        //     var data = {
        //       "_token": $('meta[name="csrf-token"]').attr('content'),
        //       "id": id,
        //     //   "status": status
        //     };
        //     console.log(data);
        //     Swal.fire({
        //         icon: 'warning',
        //         title: 'Từ chối duyệt bài',
        //         text: 'Hãy chắc chắn rằng bạn đã kiểm tra bài viết một cách cẩn thận',
        //         showCancelButton: true,
        //         showConfirmButton: true,
        //         confirmButtonText: 'OK',
        //         confirmButtonColor: '#C46F01',
        //         cancelButtonText: 'Hủy'
        //       }).then(function (result) {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 type: "get",
        //                 //cho giống đường dẫn controller status
        //                 url: "/itjob_portal/public/admin/job-refuse/".concat(id),
        //                 data: data,
        //                 success: function success(response) {
        //                   location.reload();
        //                   toastr.success(response.success);
        //                 },
        //                 error: function error(response) {
        //                   toastr.error("Cập nhật trạng thái thất bại");
        //                 }
        //             });
        //           }
        //         });
            
        //   });
        //company
        //bắt sự kiện thay đổi status
        $('.bo-chan-cong-ty').click(function (e) {
          console.log('đã duyệt');
          e.preventDefault();
          // lấy giá trị của thuộc tính data-id
          var id = $(this).data('id');
          var data = {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": id,
          //   "status": status
          };
          console.log(data);
          Swal.fire({
              icon: 'warning',
              title: 'xác nhận ',
              text: 'Hãy chắc chắn rằng bạn muốn thực hiện thao tác này',
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
                      url: "/itjob_portal/public/admin/company-accept/".concat(id),
                      data: data,
                      success: function success(response) {
                        location.reload();
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