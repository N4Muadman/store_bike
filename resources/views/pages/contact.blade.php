@extends('layout')

@section('title')
<title>Liên hệ </title>
@endsection
@section('content')
    <div class="breadcrumb-area section-space--breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">

                    <div class="breadcrumb-wrapper">
                        <h2 class="page-title">Liên hệ</h2>
                        <ul class="breadcrumb-list">
                            <li><a href="index.html">Trang chủ</a></li>
                            <li class="active">Liên hệ</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="page-content-wrapper">

        <!--=======  map area  =======-->

        <div class="box-layout-map-area section-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-layout-map-container">
                            <p style="text-align: center;">
                                <iframe style="border: 0;"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.7557904946275!2d105.78093437613639!3d20.962320080670523!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135add4f887f7a5%3A0x57d6351f0b1d2d1d!2zVOG6rXAgdGjhu4MgY8O0bmcgYW4gxJBhIFPhu7k!5e0!3m2!1sen!2s!4v1715764188548!5m2!1sen!2s"
                                    width="100%" height="450" allowfullscreen="allowfullscreen">
                                </iframe>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="contact-icon-text-area section-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="contact-icon-text-wrapper">
                            <div class="row">
                                <div class="col-sm-4">

                                    <div class="single-contact-icon-text">
                                        <div class="single-contact-icon-text__icon">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <h3 class="single-contact-icon-text__title">Địa chỉ</h3>
                                        <p class="single-contact-icon-text__value">Tập thể công an, Đa Sỹ, Hà Đông, Hà Nội</p>
                                    </div>
                                </div>
                                <div class="col-sm-4">

                                    <div class="single-contact-icon-text">
                                        <div class="single-contact-icon-text__icon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <h3 class="single-contact-icon-text__title">Số điện thoại</h3>
                                        <p class="single-contact-icon-text__value"> 0983.15.27.25 – 0243.522.8616</p>
                                    </div>

                                </div>
                                <div class="col-sm-4">

                                    <div class="single-contact-icon-text">
                                        <div class="single-contact-icon-text__icon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <h3 class="single-contact-icon-text__title">Địa chỉ email</h3>
                                        <p class="single-contact-icon-text__value">info@website.com</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-form-content-area section-space--contact-form">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-form-content-wrapper">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="contact-form-wrapper">
                                        <form id="contact-form"
                                            action="https://htmldemo.net/robin/robin/assets/php/mail.php" method="post">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6">
                                                    <input type="text" placeholder="Tên *" name="customerName"
                                                        id="customername" required>
                                                </div>
                                                <div class="col-lg-4 col-sm-6">
                                                    <input type="text" placeholder="Email *" name="customerEmail"
                                                        id="customerEmail" required>
                                                </div>
                                                <div class="col-lg-4">
                                                    <input type="text" placeholder="Chủ đề" name="contactSubject"
                                                        id="contactSubject">
                                                </div>
                                                <div class="col-lg-12">
                                                    <textarea cols="30" rows="10" placeholder="Nội dung *" name="contactMessage" id="contactMessage" required></textarea>
                                                </div>
                                                <div class="col-lg-12">
                                                    <button type="submit" id="submit" class="theme-button"> Gửi</button>
                                                </div>
                                            </div>
                                        </form>
                                        <p class="form-messege"></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="contact-form-content">
                                        <p>Vui lòng xem Câu hỏi thường gặp của chúng tôi để tìm câu trả lời cho các câu hỏi của bạn hoặc gửi
                                            email cho chúng tôi để hỏi các câu hỏi chung! Do khối lượng công việc không mong muốn, chúng tôi
                                            mất nhiều thời gian hơn một chút so với thời gian chúng tôi muốn trả lời email. Thời gian phản
                                            hồi email hiện tại của chúng tôi là 3 ngày làm việc.</p>

                                        <ul class="social-links">
                                            <li><a href="http://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="http://www.plus.google.com/"><i class="fa fa-google-plus"></i></a>
                                            </li>
                                            <li><a href="http://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="http://www.twitter.com/"><i class="fa fa-twitter"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
