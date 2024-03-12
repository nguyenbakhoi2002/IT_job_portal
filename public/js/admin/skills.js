/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/admin/skills.js ***!
  \**************************************/
$(function () {
  function readURL(input, selector) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $(selector).attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#img").change(function () {
    readURL(this, '#image');
  });
});
$(document).ready(function () {
  $('.btn-delete').click(function (e) {
    e.preventDefault();
    var arrayUrl = $(location).attr('pathname').split('/');
    var model = arrayUrl[arrayUrl.length - 1];
    var id = $(this).data('id');
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
          type: "DELETE",
          url: "".concat(model, "/").concat(id),
          data: data,
          success: function success(response) {
            Swal.fire(response.success, {
              icon: "success"
            }).then(function (result) {
              location.reload();
            });
          }
        });
      }
    });
  });
});
/******/ })()
;