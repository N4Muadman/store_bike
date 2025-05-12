@extends('layout')
@section('title', 'Giỏ Hàng')
@section('content')
    <div class="my-4">
        <div class="container">
            <div class="row">
                <!-- shopping cart section -->
                <div class="col-12 mb-6 mb-md-0">
                    <div class="d-flex flex-column mb-4">
                        <!-- title section -->
                        <div class="d-flex justify-content-between p-3 border-bottom align-items-center">
                            <span class="fs-4 fw-bold">Sản phẩm <span class="fs-6 theme-text-accent-one">(No.
                                    Items)</span></span>
                            <span class="fs-4 fw-bold mb-5"><a class="text">Giỏi Hàng</a></span>
                            <span class="fs-4 fw-bold">Tổng cộng</span>
                        </div>
                        <!-- manage address section -->
                        <div class="d-flex flex-column justify-content-between p-3">
                            <div class="mb-3" id="list-carts-index">
                            </div>
                            <div class="mt-4">
                                <label class="form-label fw-bold mb-4">Bạn có Mã giảm giá không? Vui lòng cung cấp bên dưới.</label>
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="input-group search-input coupon-input">
                                            <input type="text" class="form-control theme-border-radius"
                                                placeholder="Mã giảm giá">
                                            <button
                                                class="d-flex justify-content-center align-items-center custom-btn-primary button-effect"
                                                type="button">Áp dụng</button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex justify-content-end custom-button mt-3 mt-lg-0">
                                            <a href="{{route('product.index')}}"
                                                class="theme-border custom-btn-secondary button-effect px-5">Cập nhật giỏ hàng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- cart summary section -->
                <div class="col-12 col-lg-6 offset-lg-6">
                    <div class="d-flex flex-column mb-4">
                        <!-- title section -->
                        <div class="d-flex justify-content-between p-3 border-bottom">
                            <span class="fs-4 fw-bold">Tóm tắt giỏ hàng</span>
                        </div>
                        <!-- price details -->
                        <div class="p-3">
                            <div class="pt-2">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-8">
                                        <p class="mb-2">Tổng phụ</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="d-flex justify-content-end align-items-end">
                                            <div class="product-price mb-2">
                                                <i class="bi bi-currency-dollar"></i><span class="ms-1" id="subtotal"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- repetable -->
                            <div class="pt-2">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-8">
                                        <p class="mb-2">Phiếu giảm giá</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="d-flex justify-content-end align-items-end">
                                            <div class="product-price mb-2">
                                                <span class="ms-1">0 đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- repetable -->
                            
                            <!-- repetable -->
                            <div class="pt-2">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-8">
                                        <p class="mb-2 fw-bold">Tổng cộng</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="d-flex justify-content-end align-items-end">
                                            <div class="product-price mb-2 fw-bold">
                                                <i class="bi bi-currency-dollar"></i><span class="ms-1" id="total"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- repetable -->
                            <div class="pt-2">
                                <!-- button section -->
                                <div class="row mt-4">
                                    <div class="col">
                                        <a href="{{route('checkout')}}"
                                            class="btn custom-btn-primary fw-bold button-effect transition-3d-hover px-4">Thanh toán</a>
                                    </div>
                                </div>
                            </div>
                            <!-- repetable -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
