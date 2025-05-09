@extends('layout')
@section('title', 'Giỏ Hàng')
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Giỏ Hàng</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Giỏ Hàng</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-5 g-3">
                <div class="col-xxl-9">
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            <table class="table">
                                <tbody id="list-carts-index">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3">
                    <div class="summery-box p-sticky">
                        <div class="summery-header">
                            <h3>Tóm tắt giỏ hàng</h3>
                        </div>

                        <div class="summery-contain">
                            <div class="coupon-cart">
                                <h6 class="text-content mb-2">Áp dụng phiếu giảm giá</h6>
                                <div class="mb-3 coupon-box input-group">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Nhập mã giảm giá ở đây">
                                    <button class="btn-apply">Áp Dụng</button>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <h4>TỔNG PHỤ</h4>
                                    <h4 class="price" id="subtotal">0 đ</h4>
                                </li>

                                <li>
                                    <h4>Giảm Giá</h4>
                                    <h4 class="price">(-) 0 đ</h4>
                                </li>

                                <li class="align-items-start">
                                    <h4>Phí ship</h4>
                                    <h4 class="price text-end">0 đ</h4>
                                </li>
                            </ul>
                        </div>

                        <ul class="summery-total">
                            <li class="list-total border-top-0">
                                <h4>Total (USD)</h4>
                                <h4 class="price theme-color" id="total">0 đ</h4>
                            </li>
                        </ul>

                        <div class="button-group cart-button">
                            <ul>
                                <li>
                                    <button onclick="location.href = '{{route('checkout')}}';"
                                        class="btn btn-animation proceed-btn fw-bold">Tiến Hành Thanh Toán</button>
                                </li>

                                <li>
                                    <button onclick="location.href = '{{ redirect()->back() }}"
                                        class="btn btn-light shopping-button text-dark">
                                        <i class="fa-solid fa-arrow-left-long"></i>Quay Lại Mua Sắm</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section End -->
@endsection
