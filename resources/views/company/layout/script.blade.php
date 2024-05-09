<script src="{{asset('assets/client-bower/js/jquery.js')}}"></script>
<script src="{{asset('assets/client-bower/js/popper.min.js')}}"></script>
<script src="{{asset('assets/client-bower/js/chosen.min.js')}}"></script>
<script src="{{asset('assets/client-bower/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/client-bower/js/jquery-ui.min.js')}}"></script>
   
<script src="{{asset('assets/client-bower/js/jquery.fancybox.js')}}"></script>
<script src="{{asset('assets/client-bower/js/jquery.modal.min.js')}}"></script>

<script src="{{asset('assets/client-bower/js/appear.js')}}"></script>
<script src="{{asset('assets/client-bower/js/ScrollMagic.min.js')}}"></script>
<script src="{{asset('assets/client-bower/js/rellax.min.js')}}"></script>
<script src="{{asset('assets/client-bower/js/owl.js')}}"></script>
<script src="{{asset('assets/client-bower/js/wow.js')}}"></script>

<script src="{{asset('assets/client-bower/js/mmenu.polyfills.js')}}"></script>
<script src="{{asset('assets/client-bower/js/mmenu.js')}}"></script>
<script src="{{asset('assets/client-bower/js/script.js')}}"></script>
<script src="{!! asset('assets/admin-bower/plugins/select2-master/select2.full.min.js') !!}"></script>
<script src="{{ asset('assets/admin-bower/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/admin-bower/plugins/toastr/toastr.min.js') }}"></script>
<script>
    const parentLinks = document.querySelectorAll('.parent-link');

    parentLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            console.log('khôi');
            event.preventDefault(); // Ngăn chặn mặc định hành vi click
            const navigation = this.nextElementSibling; // Lấy phần tử anh em kế tiếp của menu cha
            navigation.classList.toggle('active'); // Thêm hoặc loại bỏ lớp active
        });
    });
</script>