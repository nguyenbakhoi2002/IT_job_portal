/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************!*\
  !*** ./resources/js/admin/candidate.js ***!
  \*****************************************/
// $(function () {
//   function readURL(input, selector) {
//     if (input.files && input.files[0]) {
//       var reader = new FileReader();
//       reader.onload = function (e) {
//         $(selector).attr('src', e.target.result);
//       };
//       reader.readAsDataURL(input.files[0]);
//     }
//   }
//   $("#img").change(function () {
//     readURL(this, '#image');
//   });
// });
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
      icon: 'error',
      text: 'Nguy hiểm, tất cả dữ liệu liên quan sẽ bị xóa?',
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
            if(response.success) {
              Swal.fire({
                icon: "success",
                text: response.success,
              }).then(function (result) {
                location.reload();
              });
            }
            else if(response.error) {
              Swal.fire( {
                icon: "error",
                text: response.error,
              })
            }
            else{
              Swal.fire( {
                icon: "warning",
                text: "Không thể xóa, sẽ ảnh hướng tới trang web",
              })
            }

           
          },
         
        });
      }
    });
  });
  //bắt sự kiện thay đổi status
  $('.stu').change(function () {
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
      "status": status
    };
    console.log(data);
    $.ajax({
      type: "POST",
      //cho giống đường dẫn controller status
      url: "".concat(model, "-status/").concat(id),
      data: data,
      success: function success(response) {
        toastr.success(response.success);
      },
      error: function error(response) {
        toastr.error("Cập nhật trạng thái thất bại");
      }
    });
  });
  // $('.btn-delete').click(function (e) {
  //   e.preventDefault();
  //   var arrayUrl = $(location).attr('pathname').split('/');
  //   var model = arrayUrl[arrayUrl.length - 1];
  //   var id = $(this).data('id');
  //   Swal.fire({
  //     icon: 'warning',
  //     text: 'Bạn có muốn xóa?',
  //     showCancelButton: true,
  //     confirmButtonText: 'Yes',
  //     confirmButtonColor: '#e3342f',
  //     cancelButtonText: 'No'
  //   }).then(function (results) {
  //     if (results.isConfirmed) {
  //       var data = {
  //         "_token": $('meta[name="csrf-token"]').attr('content'),
  //         "id": id
  //       };
  //       $.ajax({
  //         type: "DELETE",
  //         url: "".concat(model, "-forceDelete/").concat(id),
  //         data: data,
  //         success: function success(response) {
  //           Swal.fire(response.success, {
  //             icon: "success"
  //           }).then(function (result) {
  //             location.reload();
  //           });
  //         }
  //       });
  //       console.log(url);
  //     }
  //   });
  // });
});
/******/ })()
;