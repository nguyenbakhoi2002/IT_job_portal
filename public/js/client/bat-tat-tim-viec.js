/******/ (() => { // webpackBootstrap
    // var __webpack_exports__ = {};
    
    $(document).ready(function () {
        //bắt sự kiện bật tìm kiếm việc làm
        $('#bat-tim-viec').click(function (e) {
          console.log('đã bật');
          e.preventDefault();
          // Lấy giá trị ID từ thuộc tính href
            var href = this.getAttribute('href');
            var id = href.split('/').pop(); // Lấy phần cuối của URL (ID)
          var data = {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id": id,
          //   "status": status
          };
          console.log(data);
          Swal.fire({
              icon: 'warning',
              title: 'Bật chức năng tìm việc',
              text: 'Khi bật tìm việc, bạn sẽ cho phép nhà tuyển dụng , tìm kiếm và xem Profile của mình',
              showCancelButton: true,
              showConfirmButton: true,
              confirmButtonText: 'OK',
              confirmButtonColor: '#C46F01',
              cancelButtonText: 'Hủy'
            }).then(function (result) {
              if (result.isConfirmed) {
                  $.ajax({
                      type: "get",
                      //cho giống đường dẫn controller status
                      url: "/itjob_portal/public/job_search_function_on/".concat(id),
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
        $('#tat-tim-viec').click(function (e) {
            console.log('đã từ chối');
            e.preventDefault();
            // lấy giá trị của thuộc tính data-id
            var id = $(this).data('id');
            var href = this.getAttribute('href');
            var id = href.split('/').pop(); // Lấy phần cuối của URL (ID)
            var data = {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "id": id,
            //   "status": status
            };
            console.log(data);
            Swal.fire({
                icon: 'warning',
                title: 'Tắt chức năng tìm kiếm việc',
                text: 'Nhà tuyển dụng sẽ không thể thấy Profile của bạn',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: 'OK',
                confirmButtonColor: '#C46F01',
                cancelButtonText: 'Hủy'
              }).then(function (result) {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        //cho giống đường dẫn controller status
                        url: "/itjob_portal/public/job_search_function_off/".concat(id),
                        // data: data,
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