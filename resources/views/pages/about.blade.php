@extends('layout')
@section('content')
<div class="breadcrumb-area section-space--breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">

                <div class="breadcrumb-wrapper">
                    <h2 class="page-title">Về chúng tôi</h2>
                    <ul class="breadcrumb-list">
                        <li><a href="index.html">Trang chủ</a></li>
                        <li class="active">Về chúng tôi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-content-wrapper">
    <div class="about-page-top-wrapper section-space">
        <div class="about-us-brief-wrapper section-space--small">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-lg-5">
                        <h2 class="about-us-brief-title">A Better Way To Shop Online For Furniture</h2>
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <div class="about-us-brief-desc">
                            <p>Robin is more than just an online furniture store. We hand pick and curate the best in quality and style for you and your home.</p>

                            <p>Why spend days driving from store to store trying to find that perfect look or unique piece. Find everything you’re looking for and more from the comfort of your own home.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-us-slider-wrapper section-space--small">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-us-slider theme-slick-slider" data-slick-setting='{
                            "slidesToShow": 1,
                            "slidesToScroll": 1,
                            "arrows": false,
                            "dots": true,
                            "autoplay": false,
                            "autoplaySpeed": 5000,
                            "speed": 500,
                            "prevArrow": {"buttonClass": "slick-prev", "iconClass": "fa fa-angle-left" },
                            "nextArrow": {"buttonClass": "slick-next", "iconClass": "fa fa-angle-right" }
                        }' data-slick-responsive='[
                            {"breakpoint":1501, "settings": {"slidesToShow": 1, "arrows": false} },
                            {"breakpoint":1199, "settings": {"slidesToShow": 1, "arrows": false} },
                            {"breakpoint":991, "settings": {"slidesToShow": 1, "arrows": false, "slidesToScroll": 1} },
                            {"breakpoint":767, "settings": {"slidesToShow": 1, "arrows": false, "slidesToScroll": 1} },
                            {"breakpoint":575, "settings": {"slidesToShow": 1, "arrows": false, "slidesToScroll": 1} },
                            {"breakpoint":479, "settings": {"slidesToShow": 1, "arrows": false, "slidesToScroll": 1} }
                        ]'>
                            <div class="single-image">
                                <img src="assets/img/about/about_us_slide_01.jpg" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-us-process-wrapper">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-process">
                            <h3 class="title"> <span>01.</span> SERVICE</h3>
                            <p class="description">Our Customer Care Team can answer any questions you may have, as well as provide personalized assistance with: scheduling, availability, bulk orders, custom orders and delivery options.</p>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-process">
                            <h3 class="title"> <span>02.</span> SELECTION</h3>
                            <p class="description">Shop our extensive selection of quality furniture and home décor for every room, plus a vast assortment of mattresses, appliances and electronics at prices that can’t be beat!</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-process">
                            <h3 class="title"> <span>03.</span> SATISFACTION</h3>
                            <p class="description">Shop with confidence! Our Satisfaction Guarantee and Price Match Promise ensure you are always happy with your purchase.</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-process">
                            <h3 class="title"> <span>04.</span> DELIVERY</h3>
                            <p class="description">Our One Of A Kind Delivery network is fast, reliable and FREE on thousands of items. Delivery is free on all purchases over $799, plus many home decor items qualify for FREE SHIPPING.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="team-member-area section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center">
                        <h2 class="section-title">MEET OUR TEAM</h2>
                        <p class="section-subtitle">Your Satisfaction defines our Success</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="team-member-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="single-team-member">
                                    <div class="single-team-member__image">
                                        <img src="assets/img/about/team-member-1.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="single-team-member__content">
                                        <h3 class="name">Tiny Boer</h3>
                                        <h4 class="designation">CEO</h4>
                                        <p class="short-desc">Tiny's focus is clear: Deliver the best possible customer experience for each of their clients. She works with all team members to ensure that goal is met - each and every day.</p>

                                        <ul class="social-profiles">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="single-team-member">
                                    <div class="single-team-member__image">
                                        <img src="assets/img/about/team-member-2.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="single-team-member__content">
                                        <h3 class="name">John Wilson</h3>
                                        <h4 class="designation">Manager</h4>
                                        <p class="short-desc">John has always focused on exceptional customer service, attention to detail and offering a friendly, professional and detail-oriented approach for every customer shopping with his team.</p>

                                        <ul class="social-profiles">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="single-team-member">
                                    <div class="single-team-member__image">
                                        <img src="assets/img/about/team-member-3.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="single-team-member__content">
                                        <h3 class="name">Charlotte Hill</h3>
                                        <h4 class="designation">Design</h4>
                                        <p class="short-desc">"I create environments that compliment your daily life, from a sanctuary for a good night's sleep to a welcoming home to share with family and friends. Color is a key element to any design project".</p>

                                        <ul class="social-profiles">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="single-team-member">
                                    <div class="single-team-member__image">
                                        <img src="assets/img/about/team-member-4.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="single-team-member__content">
                                        <h3 class="name">Jim Shafer</h3>
                                        <h4 class="designation">Marketing</h4>
                                        <p class="short-desc">Jim has over 25 years' experience in the Marketing and Advertising world. He held several senior marketing roles in the automotive business working for Volvo Cars of North America, LLC.</p>

                                        <ul class="social-profiles">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
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
    <div class="contact-form-area section-space--inner--contact-form bg--dark-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center">
                        <h2 class="section-title">DO YOU HAVE ANY QUESTION ?</h2>
                        <p class="section-subtitle">Your Satisfaction defines our Success</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <div class="contact-form-wrapper">
                        <form id="contact-form" action="https://htmldemo.net/robin/robin/assets/php/mail.php" method="post">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                    <input type="text" placeholder="First Name *" name="customerName" id="customername" required>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <input type="text" placeholder="Email *" name="customerEmail" id="customerEmail" required>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" placeholder="Subject" name="contactSubject" id="contactSubject">
                                </div>
                                <div class="col-lg-12">
                                    <textarea cols="30" rows="10" placeholder="Message *" name="contactMessage" id="contactMessage" required></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" id="submit" class="theme-button"> SEND A MESSAGE</button>
                                </div>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
