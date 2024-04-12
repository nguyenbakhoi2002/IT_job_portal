/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/client/create_cv.js ***!
  \******************************************/
$(document).ready(function () {
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
  $('#create_info').submit(function (e) {
    //ngăn chặn hành vi load lại trang
    e.preventDefault();
    var url = $('#create_info').attr('action');
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
        

        console.log('response: '+ typeof(response));
        console.log('response: '+ response.is_check);
        if (response.is_check === true) {
          // nếu có ảnh mới thì lấy ảnh mới, nếu có ảnh cũ thì lấy ảnh cũ,ko có thì lấy ảnh mặc định
          var dataInfo = response.data.image? '<div class="mt-3"> <img width="100px" height="100px"  src="http://localhost/itjob_portal/public/uploads/images/candidate/'+response.data.image+ '" alt=""> </div>' : 
          (response.data.hinhanh_upload_logo_hd?'<div class="mt-3"> <img width="100px" height="100px"  src="http://localhost/itjob_portal/public/uploads/images/candidate/'+response.data.hinhanh_upload_logo_hd+ '" alt=""> </div>':
          '<div class="mt-3"> <img width="100px" height="100px"  src="http://localhost/itjob_portal/public/uploads/images/candidate/logo_default_candidate.jpg" alt=""> </div>');
          dataInfo += "\n <div class=\"mt-3\"> <b>H\u1ECD t\xEAn:</b> " + response.data.name + 
          " </div>\n <div style=\"margin-top: 5px;\"> <b>\u0110\u1ECBa ch\u1EC9:</b> " + 
          response.data.address + " </div>\n <div style=\"margin-top: 5px;\"> <b>S\u1ED1 \u0111i\u1EC7n tho\u1EA1i:</b> +"
           + response.data.phone + " </div>\n <div style=\"margin-top: 5px;\"> <b>Email:</b> " + 
           response.data.email + " </div>\n <div style=\"margin-top: 5px;\"> <b>Tiêu đề hồ sơ:</b> " + 
            response.data.title + " </div>\n <div style=\"margin-top: 5px;\"> <b>Mục tiêu nghề nghiệppppppp:</b> " + 
            response.data.objective + " </div>\n                     ";
          $('.info_pro').html(dataInfo);
          toastr.success(response.success);
          $("#desc").hide(300);
          $(".info_pro").show(300);
            // Chuyển hướng đến URL được chỉ định
          // if (response.redirect_url) {
          //     window.location.href = response.redirect_url;
          // }
        } else {
          console.log(response.error);
          
          printErrorMsg( response.error);
        }
      },
      error: function error(response) {
        toastr.error("Thêm thất bại");
      }
    });
  });
  function printErrorMsg(msg) {
    $('.val_info_name').text(msg.name != undefined ? msg.name : '');
    $('.val_info_image').text(msg.image != undefined ? msg.image : '');
    $('.val_info_address').text(msg.address != undefined ? msg.address : '');
    $('.val_info_phone').text(msg.phone != undefined ? msg.phone : '');
    $('.val_info_email').text(msg.email != undefined ? msg.email : '');
    $('.val_info_title').text(msg.title != undefined ? msg.title : '');
    $('.val_info_objective').text(msg.objective != undefined ? msg.objective : '');
  }  
  // kinh nghiệm làm việc
  $('#create_exp').submit(function (e) {
    e.preventDefault();
    var url = $('#create_exp').attr('action');
    console.log(url);
    var form = this;
    var dataForm = new FormData(form);
    $.ajax({
      type: "POST",
      url: url,
      data: dataForm,
      processData: false,
      contentType: false,
      success: function success(response) {
        if (response.is_check === true) {
          // $("#create_exp")[0].reset();
          // $('#exp-full').load(document.URL +  ' #list-experiences');
          location.reload();
          toastr.success(response.success);
        } else if (response.is_max === true) {
          toastr.error(response.error);
        } else {
          console.log(response.error);

          printErrorMsgExp(response.error);
        }
      },
      error: function error(response) {
        toastr.error("Thêm thất bại");
      }
    });
  });
  $('.update_exp').submit(function (e) {
    e.preventDefault();
    // var url =  $('.update_exp').attr('action');

    var url =  $(this).attr('action');
    console.log(url);
    var form = this;
    var dataForm = new FormData(form);
    $.ajax({
      type: "POST",
      url: url,
      data: dataForm,
      processData: false,
      contentType: false,
      success: function success(response) {

        if (response.is_check === true) {
          // console.log(response);                                  
          location.reload();
          toastr.success(response.success);
        } else {  
          console.log('sai');
          printErrorMsgExp(response.error);
        }
      },
      error: function error(response) {
        toastr.error("Cập nhật thất bại");
      }
    });
  });
  function printErrorMsgExp(msg) {
    $('.val_company_name').text(msg.company_name != undefined ? msg.company_name : '');
    $('.val_position').text(msg.work_position != undefined ? msg.work_position : '');
    $('.val_start_date').text(msg.start_date != undefined ? msg.start_date : '');
    $('.val_end_date').text(msg.end_date != undefined ? msg.end_date : '');
    $('.val_description_exp').text(msg.description != undefined ? msg.description : '');
  }
  $('.delExp').submit(function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    console.log(url);
    var id = $(this).find('.removeExp').data('id-exp');
    // console.log(id);
    var data = {
      id: id,
      "_token": $('meta[name="csrf-token"]').attr('content')
    };
    Swal.fire({
      icon: 'warning',
      title: 'Bạn có chắc chắn muốn xóa ?',
      text: 'Bấm không nếu bạn đổi ý!',
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: 'Xóa',
      confirmButtonColor: '#C46F01',
      cancelButtonText: 'Không'
    }).then(function (result) {
      //nếu đồng ý mới chạy vào đây
      if (result.isConfirmed) {
        $.ajax({
          url: url,
          type: "get",
          data: data,
          success: function success(results) {
            if (results.is_check === true) {
              Swal.fire({
                title: results.success,
                icon: 'success',
                type: 'success',
                showConfirmButton: false,
                timer: 1500
              }).then(function () {
                setTimeout(function () {
                  // console.log('.exp_div' + id);
                    $('.exp_div' + id).remove();
                }, 500);
            });
            } else {
              Swal.fire({
                title: results.error,
                type: 'error',
                icon: 'error',
                timer: 1500
              });
            }
          }
        });
      }
    });
  });


  //tạo Dự án cá nhân
  $('#create_pj').submit(function (e) {
    e.preventDefault();
    var url = $('#create_pj').attr('action');
    console.log(url);
    var form = this;
    var dataForm = new FormData(form);
    $.ajax({
      type: "POST",
      url: url,
      data: dataForm,
      processData: false,
      contentType: false,
      success: function success(response) {
        if (response.is_check === true) {
          location.reload();
          toastr.success(response.success);
        } else if (response.is_max === true) {
          toastr.error(response.error);
        } else {
          // console.log(response.error);
          printErrorMsgPj(response.error);
        }
      },
      error: function error(response) {
        toastr.error("Thêm thất bại");
      }
    });
  });
  //cập nhật dự án cá nhân
  $('.update_pj').submit(function (e) {
    e.preventDefault();
    var url =  $(this).attr('action');
    console.log(url);
    var form = this;
    var dataForm = new FormData(form);
    $.ajax({
      type: "POST",
      url: url,
      data: dataForm,
      processData: false,
      contentType: false,
      success: function success(response) {

        if (response.is_check === true) {
          // console.log(response);                                  
          location.reload();
          toastr.success(response.success);
        } else {  
          console.log(response.error);
          printErrorMsgPj(response.error);
        }
      },
      error: function error(response) {
        toastr.error("Cập nhật thất bại");
      }
    });
  });
  function printErrorMsgPj(msg) {
    $('.val_name_pj').text(msg.name != undefined ? msg.name : '');
    $('.val_start_date_pj').text(msg.start_date != undefined ? msg.start_date : '');
    $('.val_end_date_pj').text(msg.end_date != undefined ? msg.end_date : '');
    $('.val_description_pj').text(msg.description != undefined ? msg.description : '');
  }
  //xóa dự án cá nhân
  $('.delPj').submit(function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    console.log(url);
    var id = $(this).find('.removePj').data('id-pj');
    // console.log(id);
    var data = {
      id: id,
      "_token": $('meta[name="csrf-token"]').attr('content')
    };
    Swal.fire({
      icon: 'warning',
      title: 'Bạn có chắc chắn muốn xóa ?',
      text: 'Bấm không nếu bạn đổi ý!',
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: 'Xóa',
      confirmButtonColor: '#C46F01',
      cancelButtonText: 'Không'
    }).then(function (result) {
      //nếu đồng ý mới chạy vào đây
      if (result.isConfirmed) {
        $.ajax({
          url: url,
          type: "get",
          data: data,
          success: function success(results) {
            if (results.is_check === true) {
              Swal.fire({
                title: results.success,
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
              }).then(function () {
                setTimeout(function () {
                    $('.pj_div' + id).remove();
                }, 500);
            });
            } else {
              Swal.fire({
                title: results.error,
                type: 'error',
                icon: 'error',
                timer: 1500
              });
            }
          }
        });
      }
    });
  });
  $('#formSkill').submit(function (e) {
    e.preventDefault();
    var url = $('#formSkill').attr('action');
    var seeker_id = $('input[name=seeker_id]').val();
    var skill_id = [];
    $("#skills option:selected").each(function () {
      skill_id.push($(this).val());
    });
    var data = {
      "_token": $('meta[name="csrf-token"]').attr('content'),
      "skill_id": skill_id,
      "seeker_id": seeker_id
    };
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function success(response) {
        toastr.success(response.success);
      },
      error: function error(response) {
        toastr.error("Cập nhật thất bại");
      }
    });
  });

  


  // đóng mở form thêm mới 
  $("#block-p").click(function () {
    $("#desc").toggle(300);
    $(".info_pro").toggle(300);
  });
  $(".hide-button").click(function () {
    $("#desc").hide(300);
    $(".info_pro").show(300);

  });

  // kinh nghiệm làm việc
  $("#block-kn").click(function () {
    $("#experiences").toggle(300);
  });
  $(".hide-button-kn").click(function () {
    $("#experiences").hide(300);
  });
  // dự án cá nhân
  $("#block-pj").click(function () {
    $("#projects").toggle(300);
  });
  $(".hide-button-pj").click(function () {
    $("#projects").hide(300);
  });
  // kỹ năng
  $("#block-sk").click(function () {
    $("#skills").toggle(300);
  });
  $(".hide-button-sk").click(function () {
    $("#skills").hide(300);
  });

  // trường học
  $("#block-edu").click(function () {
    $("#educations").toggle(300);
  });
  $(".hide-button-edu").click(function () {
    $("#educations").hide(300);
  });
  // ngôn ngữ
  $("#block-lg").click(function () {
    $("#languages").toggle(300);
  });
  $(".hide-button-lg").click(function () {
    $("#languages").hide(300);
  });
  // chứng chỉ
  $("#block-cer").click(function () {
    $("#certificates").toggle(300);
  });
  $(".hide-button-cer").click(function () {
    $("#certificates").hide(300);
  });
});
/******/ })()
;