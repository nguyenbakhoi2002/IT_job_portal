@extends('client.layout.app')
@section('title')
    {{ __('UB Work') }}
@endsection
@section('content')
<div class="auto-container">
    <div class="row mt-5 pt-5 mt-3">
    <h1>Liên hệ</h1>
    <h2>Địa chỉ văn phòng</h2>
    <h3>Trịnh Văn Bô, Nam Từ Liêm, Hà Nội</h3><br>

    <br>

    <div class="col-md-12 col-sm-12 mb-3">
        <h2>Dành cho nhà tuyển dụng</h2>
        <span>Hãy gọi ngay cho đội ngũ Bán Hàng của chúng tôi
        HCM: 0386868686<br>
        Hà Nội: 0123456789<br>
        Hãy để lại thông tin để được chúng tôi sẽ liên hệ tư vấn ngay<br>
        Chúng tôi sẵn sàng để giúp bạn phát triển</span> <br>
    </div>

    <br>

    <div class="col-md-12 col-sm-12 mb-3">
        <h2>Dành cho ứng viên</h2>
        <span>Đặt câu hỏi trên Facebook BaKhoi<br>
        Đọc các bài blog của chúng tôi về bí quyết viết CV và kỹ năng phỏng vấn<br>
        Gọi chúng tôi theo số +84 28 6681 1397<span><br>
        <hr>
        <div class="other-options">
            Kết nối với chúng tôi qua hệ thống mạng xã hội<br>
            <div class="social-share mt-3">
                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="#" class="twitter"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#" class="google"><i class="fab fa-google"></i> Google+</a>
            </div>
            <hr>
        </div>
    </div>
</div>
</div>

@endsection