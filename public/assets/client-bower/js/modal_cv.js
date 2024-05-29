
    {/* hiển thị modal create profile */}
    $(document).ready(function () {
        $('.quanlycv').click(function(e) {
            console.log($('#emptySeekerModal'));
            e.preventDefault();
           
            $('#emptySeekerModal').modal('show');
        });
        // $('#quanlycv').submit(function(e) {
        //     //ngăn chặn hành vi load lại trang
        //     e.preventDefault();
        //     var url = $('#quanlycv').attr('action');
        //     console.log('url: '+ url);
        //     var form = this;
        //     console.log('form: '+form);
        //     var dataForm = new FormData(form);
        //     console.log('dataForm: '+dataForm);
        //     $.ajax({
        //     type: "POST",
        //     url: url,
        //     data: dataForm,
        //     success: function(response) {
        //         if (response.hasSeekerProfile===false) {
        //         console.log('đã hiện');
        //         // $('#emptySeekerModal').modal('show');
        //         }
        //     }
        //     });
        // });
    });
