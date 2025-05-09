@extends('layout')
@section('content')
    <!--====================  breadcrumb area ====================-->

    <div class="breadcrumb-area section-space--breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <!--=======  breadcrumb wrapper  =======-->

                    <div class="breadcrumb-wrapper">
                        <h2 class="page-title">F.A.Q</h2>
                        <ul class="breadcrumb-list">
                            <li><a href="index.html">Home</a></li>
                            <li class="active">F.A.Q</li>
                        </ul>
                    </div>

                    <!--=======  End of breadcrumb wrapper  =======-->
                </div>
            </div>
        </div>
    </div>

    <!--====================  End of breadcrumb area  ====================-->

    <!--====================  page content wrapper ====================-->

    <div class="page-content-wrapper">

        <!--====================  faq area ====================-->

        <div class="faq-area section-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="faq-wrapper">


                            <!--=======  single faq  =======-->

                            <div class="single-faq">
                                <h2 class="faq-title">Shipping information</h2>
                                <div class="accordion" id="shippingInfo">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                What Shipping Methods are Available?
                                            </button>
                                        </h2>

                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#shippingInfo">
                                            <div class="accordion-body">
                                                <p>Depending on the item(s) you purchase on garageclothing.com and the location to which the item(s) will be delivered, different shipping methods will be available. At checkout, you will be prompted to choose a variety of shipping methods.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Do You Ship Internationally?
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#shippingInfo">
                                            <div class="accordion-body">
                                                <p>At the moment, we only ship to Canada and the United States. For international orders, please contact internationalorders@dynamite.ca.
                                                    If you have any questions, please don’t hesitate to contact our Customer Experience Department by mail or by phone at 1-888-882-1138 (Canada) and 1-888-342-7243 (USA).</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                How to Track My Order?
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#shippingInfo">
                                            <div class="accordion-body">
                                                <p>Once your order has been shipped, you will receive an email with your tracking and shipping information. Simply click on the link in the email or select the ‘track order’ option here and enter your order number and email address or sign into your account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                How Long Will It Take To Get My Package?
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#shippingInfo">
                                            <div class="accordion-body">
                                                <p>We ship only on business days. Business days are from Monday to Friday, excluding holidays. Any order placed after 12 P.M. ET will be processed the following business day. Due to a high volume period, your order may take longer than anticipated. For remote locations, please add an additional 2-5 business day to each shipping method’s expected delivery time. If you are not sure whether your location is remote, please click here for all the details.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--=======  End of single faq  =======-->


                            <!--=======  single faq  =======-->

                            <div class="single-faq">
                                <h2 class="faq-title">Payment information</h2>
                                <div class="accordion" id="paymentInfo">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFive">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                                What Payment Methods Are Accepted?
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse show" aria-labelledby="headingFive" data-bs-parent="#paymentInfo">
                                            <div class="accordion-body">
                                                <p>We gladly accept Visa, MasterCard and American Express. If your card has been issued outside the U.S. or Canada, please note that your order may need additional verification before it can be processed. Unfortunately, we cannot accept COD orders and all orders must be paid in full once submitted online.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSix">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                What Happens If There Is A Pricing Error?
                                            </button>
                                        </h2>
                                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#paymentInfo">
                                            <div class="accordion-body">
                                                <p>We do our best to provide accuracy in the pricing and other product information displayed on our website, but mistakes sometimes happen. In such cases, Furniture.ca expressly reserves the right not to honor pricing errors found on this website when accepting an online order. If an error occurs, we’ll let you know and cancel the order. Any authorized payments for that order will be immediately refunded. If you find an error once your order is delivered, please contact our Customer Care team or refer to our return policy.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSix">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                What Do You Do With My Information?
                                            </button>
                                        </h2>
                                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#paymentInfo">
                                            <div class="card-body">
                                                <p>We use your info to fulfil your order accurately and quickly and to improve your shopping experience. We respect your privacy and never share this information with anyone, except in connection with your order. If you want to know more, take a look at our Private Policy.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--=======  End of single faq  =======-->

                            <!--=======  single faq  =======-->

                            <div class="single-faq">
                                <h2 class="faq-title">Orders and returns</h2>
                                <div class="accordion" id="orderInfo">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingNine">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                                How do I place an Order?
                                            </button>
                                        </h2>
                                        <div id="collapseNine" class="accordion-collapse collapse show" aria-labelledby="headingNine" data-bs-parent="#orderInfo">
                                            <div class="accordion-body">
                                                <p>Click on a Product Photo or Product Name to see more detailed information. To place your order, choose the specification you want and enter the quantity, and click ‘Buy Now’.Please enter the required information such as Delivery Address, Quantity Type etc. Before clicking “Place Order”, please check your Order Details carefully. If you want to add a new Delivery Address, click ” Add a new address”. If you want to edit a current Delivery Address, click ‘Edit this address’. After confirming your Order, you will be automatically taken to the Payment page</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTen">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                                How Can I Cancel Or Change My Order?
                                            </button>
                                        </h2>
                                        <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#orderInfo">
                                            <div class="accordion-body">
                                                <p>Go to Your Orders. Click Cancel Items. Note: Select the checkbox next to each item you wish to remove from the order. If you want to cancel the entire order, select all of the items. Click Cancel checked items when finished.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingEleven">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                                Who Should I Contact If I Have Any Queries?
                                            </button>
                                        </h2>
                                        <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#orderInfo">
                                            <div class="accordion-body">
                                                <p>You can contact our customer support team by provided email or mobile phone. In case, it’s not convenient to talk, you can come to our store to make your request.</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--=======  End of single faq  =======-->


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--====================  End of faq area  ====================-->


    </div>

    <!--====================  End of page content wrapper  ====================-->

    <!--====================  cta area ====================-->

    <div class="cta-area--three bg--dark-grey">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-10 col-md-8 text-center text-md-start">
                    <p class="cta-text">Any unanswered questions?</p>
                </div>
                <div class="col-lg-2 col-md-4 text-center text-md-end">
                    <a href="contact-us.html" class="theme-button">CONTACT US</a>
                </div>
            </div>
        </div>
    </div>

    <!--====================  End of cta area  ====================-->
@endsection
