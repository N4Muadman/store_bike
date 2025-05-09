@extends('layout')

@section('content')
    <div class="page-content-wrapper">
        <div class="factory">
            <div class="banner">
                <div class="banner-overlay"></div>
                <div class="content">
                    <div class="text-content">
                        <p class="text-top">XƯỞNG SẢN XUẤT PHÒNG CHÁY CHỮA CHÁY HÀNG ĐẦU VIỆT NAM</p>
                        <h1>CHUYÊN SẢN XUẤT PHÒNG CHÁY CHỮA CHÁY THEO YÊU CẦU</h1>
                        <p class="description">Chúng tôi cung cấp các sản phẩm phòng cháy chữa cháy đạt chuẩn chất lượng quốc tế,
                            đảm bảo an toàn cho người lao động trong mọi môi trường làm việc. Đáp ứng mọi nhu cầu thiết kế
                            riêng của khách hàng.</p>
                    </div>
                    <div class="icon-content">
                        <div class="row justify-content-between">
                            <div class="item-introl">
                                <div class="icon-introl">
                                    <i class="fa fa-handshake-o" aria-hidden="true"></i>
                                </div>
                                <p>Sản phẩm đạt chứng nhận chất lượng</p>
                            </div>
                            <div class="item-introl">
                                <div class="icon-introl">
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                </div>
                                <p>Đội ngũ tư vấn và thiết kế tận tâm</p>
                            </div>
                            <div class="item-introl">
                                <div class="icon-introl">
                                    <i class="fa fa-truck" aria-hidden="true"></i>
                                </div>
                                <p>Giao hàng nhanh, đúng hẹn</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="factory-content pt-5">
                    <h2 class="text-uppercase text-center fw-bold fs-1 mb-4">Quy mô xưởng sản xuất</h2>
                    <ul style="list-style: unset; color: #333333">
                        <li class="mb-2">
                            <h3 class="fs-5">Xưởng có diện tích <strong>3,000m2</strong>, được trang bị hệ thống máy móc
                                hiện đại, đảm bảo sản xuất nhanh và chính xác.</h3>
                        </li>
                        <li class="mb-2">
                            <h3 class="fs-5">Hơn <strong>100 công nhân</strong> tay nghề cao với kinh nghiệm trên 10 năm,
                                sẵn sàng đáp ứng mọi đơn hàng.</h3>
                        </li>
                        <li class="mb-2">
                            <h3 class="fs-5">Chuyên sản xuất đa dạng các sản phẩm phòng cháy chữa cháy như quần áo, mũ, găng
                                tay, giày và các thiết bị bảo hộ khác.</h3>
                        </li>
                    </ul>
                    <img src="{{ asset('assets/img/factory/5.webp') }}" width="100%" height="600px" alt="">
                    <div class="row mt-4">
                        <div class="col-12 col-md-6">
                            <div class="title-img text-center">
                                <p class="text-uppercase">kho nhiên liệu</p>
                            </div>
                            <img src="{{ asset('assets/img/factory/3.jpg') }}" width="100%" alt="">
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="title-img text-center">
                                <p class="text-uppercase">kho nhiên liệu</p>
                            </div>
                            <img src="{{ asset('assets/img/factory/4.jpg') }}" width="100%" alt="">
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="title-img text-center">
                                <p class="text-uppercase">kho nhiên liệu</p>
                            </div>
                            <img src="{{ asset('assets/img/factory/2.webp') }}" width="100%" alt="">
                        </div>
                    </div>
                    <h2 class="text-uppercase text-center fw-bold fs-1 m-5">Sản phẩm của chúng tôi khác biệt ở đâu?</h2>
                    <ul class="ul-lama">
                        <li class="li-lama">
                            <h3 class="text-uppercase">Thiết kế tiện dụng</h3>
                            <ul style="list-style: inside; margin-left: 20px; font-size: 18px">
                                <li>Thiết kế bảo hộ tối ưu cho từng ngành nghề: xây dựng, y tế, công nghiệp.</li>
                                <li>Các sản phẩm bảo hộ được may đo theo yêu cầu, đảm bảo vừa vặn và thoải mái.</li>
                            </ul>
                            <div class="mt-4 text-center">
                                <img src="{{ asset('assets/img/factory/factory-8.jpg') }}" width="60%" alt="">
                                <p class="fs-6 w-75 w-md-50 m-auto"><i>Khung sofa bằng gỗ Sồi Nga có độ bền cao gấp nhiều
                                        lần so với
                                        các loại gỗ tạp khác như Keo, Xoan</i></p>
                            </div>
                        </li>
                        <li class="li-lama">
                            <h3 class="text-uppercase">Chứng nhận an toàn</h3>
                            <ul style="list-style: inside; margin-left: 20px; font-size: 18px">
                                <li>Tất cả sản phẩm đều đạt các tiêu chuẩn an toàn lao động: ISO 9001, EN 388.</li>
                                <li>Cam kết hoàn tiền 200% nếu sản phẩm không đạt tiêu chuẩn.</li>
                            </ul>
                            <div class="mt-4 text-center">
                                <img src="{{ asset('assets/img/factory/6.webp') }}" width="60%" alt="">
                                <p class="fs-6 w-75 w-md-50 m-auto"><i>Chứng nhận an toàn từ Chính quyền</i></p>
                            </div>
                        </li>
                    </ul>
                    <h2 class="text-uppercase text-center fw-bold fs-1 m-5">Tại sao chọn chúng tôi?</h2>
                    <ul class="ul-lama">
                        <li class="li-lama mb-5">
                            <h3 class="text-uppercase">Tiết kiệm chi phí</h3>
                            <ul style="list-style: inside; margin-left: 20px; font-size: 18px">
                                <li>Không qua trung gian, giá gốc tại xưởng giúp bạn tiết kiệm đến 30% chi phí.</li>
                                <li>Sản xuất linh hoạt theo số lượng đơn hàng của khách hàng.</li>
                            </ul>
                        </li>
                        <li class="li-lama mb-5">
                            <h3 class="text-uppercase">Đa dạng sản phẩm</h3>
                            <ul style="list-style: inside; margin-left: 20px; font-size: 18px">
                                <li>Cung cấp đầy đủ quần áo bảo hộ, giày, mũ, găng tay và thiết bị bảo hộ.</li>
                                <li>Nhận thiết kế sản phẩm theo logo và màu sắc thương hiệu của khách hàng.</li>
                            </ul>
                        </li>
                        <li class="li-lama">
                            <h3 class="text-uppercase">Hỗ trợ tận tình</h3>
                            <ul style="list-style: inside; margin-left: 20px; font-size: 18px">
                                <li>Hỗ trợ tư vấn tại chỗ và đo đạc trực tiếp tại công ty hoặc nhà máy của bạn.</li>
                                <li>Bảo hành dài hạn và dịch vụ hỗ trợ khách hàng 24/7.</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="our-sofa">
                <h2 class="text-uppercase text-center fw-bold fs-1 mb-4" style="color: #073A91">Đối tác và khách hàng</h2>
                <p class="text-center mb-5" style="font-size: 18px; color: #333333;">
                    Trong hơn một thập kỷ qua, chúng tôi đã hợp tác với nhiều đối tác lớn và nhỏ trên khắp cả nước, bao gồm
                    các công ty xây dựng, nhà máy, khu công nghiệp và bệnh viện.
                </p>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-6 col-md-3 text-center mb-4 p-3 d-flex align-items-center">
                            <img src="{{ asset('assets/img/factory/logo-customer.png') }}" alt="Đối tác 1" width="100%">
                        </div>
                        <div class="col-6 col-md-3 text-center mb-4 p-3 d-flex align-items-center">
                            <img src="{{ asset('assets/img/factory/CNPTTPNG.png') }}" alt="Đối tác 1" width="100%">
                        </div>
                    </div>
                </div>
                <p class="text-center mt-4"><i>Chúng tôi tự hào là lựa chọn hàng đầu của hơn 200 khách hàng lớn nhỏ trên
                        toàn quốc!</i></p>
            </div>
            <div class="our-commitments">
                <div class="container">
                    <h2 class="text-uppercase text-center fw-bold fs-1 mb-4">Cam kết của chúng tôi</h2>
                    <ul class="ul-lama">
                        <li class="li-lama mb-5">
                            <h3 class="text-uppercase">Chất lượng sản phẩm</h3>
                            <p style="font-size: 18px;">Tất cả sản phẩm đều được kiểm định kỹ lưỡng và đáp ứng tiêu chuẩn
                                ISO 9001, đảm bảo an toàn tuyệt đối cho người lao động.</p>
                        </li>
                        <li class="li-lama mb-5">
                            <h3 class="text-uppercase">Giá cả cạnh tranh</h3>
                            <p style="font-size: 18px;">Giá gốc tại xưởng, không qua trung gian, giúp khách hàng tiết kiệm
                                đến 30% chi phí mà vẫn đảm bảo chất lượng hàng đầu.</p>
                        </li>
                        <li class="li-lama mb-5">
                            <h3 class="text-uppercase">Dịch vụ hậu mãi</h3>
                            <p style="font-size: 18px;">Bảo hành sản phẩm lên đến 2 năm, hỗ trợ khách hàng tận tình trong
                                suốt quá trình sử dụng.</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="discount">
                <div class="star-gif"></div>
                <div class="container">
                    <div class="img-discount-1">
                        <p class="fw-bold text-1 text-uppercase">GIẢM TỚI 35%</p>
                        <p class="fw-bold text-2 text-uppercase">Cho 30 khách hàng đăng ký sớm nhất trong tháng</p>
                    </div>
                    <div class="img-discount-2"></div>
                    <p class="text-center text-3">CAM KẾT HOÀN TIỀN 200% NẾU SẢN PHẨM KHÔNG ƯNG Ý</p>

                    <div class="btn-support btn-fixed text-center" id="btn-support">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#supportDialog">Nhận tư vấn báo giá</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="supportDialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="DiscountDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="supportDialogcontent d-flex">
                        <div class="left-support">
                            <div class="text-discount">Giảm giá 25%</div>
                            <p class="text-center text-uppercase text-support-1" style="color: color: rgb(5, 34, 74);">Nhận ngay
                                khuyến mại & tư vấn, báo giá</p>

                            <div class="deal-countdown"
                                data-countdown="">
                                <div class="single-countdown"><span class="single-countdown__time">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">00</font>
                                        </font>
                                    </span><span class="single-countdown__text">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Ngày</font>
                                        </font>
                                    </span></div>
                                <div class="single-countdown"><span class="single-countdown__time">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">00</font>
                                        </font>
                                    </span><span class="single-countdown__text">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Giờ</font>
                                        </font>
                                    </span></div>
                                <div class="single-countdown"><span class="single-countdown__time">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">00</font>
                                        </font>
                                    </span><span class="single-countdown__text">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Phút</font>
                                        </font>
                                    </span></div>
                                <div class="single-countdown"><span class="single-countdown__time">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">00</font>
                                        </font>
                                    </span><span class="single-countdown__text">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Giây</font>
                                        </font>
                                    </span></div>
                            </div>
                            <form action="{{ route('CustomerNeedAdvice') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="name" class="form-control p-2 border-primary"
                                        placeholder="Họ và tên">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="phone_number" class="form-control p-2 border-primary"
                                        placeholder="Số điện thoại">
                                </div>

                                <button type="submit" class="btn-support-dialog">Tư vấn báo giá cho tôi</button>
                            </form>
                            <p class="text-center mt-3 text-support-2">(Bạn sẽ nhận được tư vấn, báo giá sofa trong khoảng 5p)</p>
                        </div>
                        <div class="right-support">
                            <img src="{{ asset('assets/img/factory/discount-1.png') }}" width="100%" alt="">
                            <p class="text-center"><i><u>Lưu ý: </u>Khuyến mại 25% áp dụng cho 30 khách hàng đầu tiên trong
                                    tháng</i></p>
                        </div>

                        <button type="button" style="position: absolute; top: 10px; right: 10px;" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('wheel', function() {
            var btnSupport = document.getElementById('btn-support');

            if (btnSupport) {
                var rect = btnSupport.getBoundingClientRect();

                var isAtBottom = (window.innerHeight + window.scrollY) >= document.documentElement.scrollHeight -
                    500;

                if (isAtBottom) {
                    if (btnSupport.classList.contains('btn-fixed')) {
                        btnSupport.classList.remove('btn-fixed');
                    }
                } else {
                    if (!btnSupport.classList.contains('btn-fixed')) {
                        btnSupport.classList.add('btn-fixed');
                    }
                }
            }
        });
    </script>
@endsection
