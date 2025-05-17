@extends('layout')

@section('title', 'Thanh toán')

@section('content')

    <div class="py-5 theme-bg-accent-three">
        <div class="container">
            <!-- row -->
            <div class="row ">
                <!-- col -->
                <div class="col-12 align-self-center">
                    <!-- breadcrumb -->
                    <div class="page-breadcrumb">
                        <ul class="list">
                            <li><a href="/">Trang chủ</a></li>
                            <li>Thanh toán</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop section - checkout cart -->
    <div class="py-5">
        <div class="container">
            <form action="{{ route('placeOrder') }}" method="post">
                @csrf
                <div class="row">
                    <!-- shop checkout section -->
                    <div class="col-lg-7 mb-6 mb-md-0">
                        <div class="d-flex flex-column mb-4">
                            <!-- title section -->
                            <div class="d-flex justify-content-between border-bottom pb-4">
                                <span class="fs-4 fw-bold">Thông tin khách hàng</span>
                            </div>
                            <!-- manage address section -->
                            <div class="d-flex flex-column justify-content-between">
                                <div class="pt-4">
                                    <div class="row g-3">
                                        <div class="col-12 col-lg-6">
                                            <input type="text"
                                                class="form-control min-h @error('full_name')
                                                border-danger
                                            @enderror"
                                                placeholder="Họ và tên" aria-label="name" required="" name="full_name"
                                                value="{{ old('full_name') }}">
                                            @error('full_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <input type="text"
                                                class="form-control min-h
                                            @error('phone_number')
                                                border-danger
                                            @enderror"
                                                placeholder="Số điện thoại" aria-label="mobile" required=""
                                                name="phone_number" value="{{ old('phone_number') }}">
                                            @error('phone_number')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <input type="email"
                                                class="form-control min-h @error('email')
                                                border-danger
                                            @enderror"
                                                name="email" placeholder="Email" value="{{ old('Email') }}">
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>

                                        <div class="col-12 col-lg-12">
                                            <select
                                                class="form-select min-h @error('province')
                                                border-danger
                                            @enderror"
                                                name="province" id="provinces" required>
                                                <option value="" data-id="">Chọn tỉnh / thành phố
                                                </option>
                                            </select>
                                            @error('province')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>

                                        <div class="col-12 col-lg-12">
                                            <select
                                                class="form-select min-h @error('district')
                                                border-danger
                                            @enderror"
                                                name="district" id="districts" required>
                                                <option value="" data-id="">Chọn quận / huyện
                                                </option>
                                            </select>
                                            @error('district')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>

                                        <div class="col-12 col-lg-12">
                                            <select
                                                class="form-select min-h @error('wards')
                                                border-danger
                                            @enderror"
                                                name="ward" id="wards" required>
                                                <option value="" data-id="">Chọn phường / xã
                                                </option>
                                            </select>
                                            @error('wards')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>

                                        <div class="col-12 col-lg-12">
                                            <textarea
                                                class="form-control @error('address')
                                                border-danger
                                            @enderror"
                                                id="exampleFormControlTextarea2" name="address" rows="3" placeholder="Địa chỉ chi tiết"> {{ old('address') }}</textarea>
                                            @error('address')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- product details section -->
                    <div class="col-lg-5">
                        <div class="d-flex flex-column order-detail mb-4">
                            <!-- title section -->
                            <div class="d-flex justify-content-between pb-3 border-bottom">
                                <span class="fs-4 fw-bold">Chi tiết sản phẩm</span>
                            </div>
                            <!-- product items -->
                            <div class="pb-3">
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                    @php
                                        $total +=
                                            ($cart['sale_price'] > 0 ? $cart['sale_price'] : $cart['price']) *
                                            $cart['quantity'];
                                    @endphp

                                    <div class="border-bottom pt-2">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="{{ $cart['image'] }}"
                                                    class="img-fluid blur-up lazyloaded checkout-image"
                                                    style="max-height: 70px" alt="">
                                            </div>
                                            <div class="col-9 col-md-5 col-lg-5">
                                                <p class="mb-2 text">{{ $cart['product_name'] }}</p>
                                            </div>
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="d-flex justify-content-end align-items-end">
                                                    <div class="product-price mb-3 fw-bold">
                                                        {{ $cart['quantity'] }} x
                                                        <span
                                                            class="ms-1">{{ number_format($cart['sale_price'] > 0 ? $cart['sale_price'] : $cart['price']) }}
                                                            đ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- title section -->
                            <div class="d-flex justify-content-between pb-3 border-bottom">
                                <span class="fs-4 fw-bold">Chi tiết giá</span>
                            </div>
                            <!-- price details -->
                            <div class="p-0">
                                <div class="border-bottom pt-2">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-8">
                                            <p class="mb-2">Tổng phụ</p>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="d-flex justify-content-end align-items-end">
                                                <div class="product-price mb-2">
                                                    <span class="ms-1">{{ number_format($total) }} đ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- repetable -->
                                <div class="border-bottom pt-2">
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
                                <div class="border-bottom pt-2">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-8">
                                            <p class="mb-2">Phí vận chuyển</p>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="d-flex justify-content-end align-items-end">
                                                <div class="product-price mb-2">
                                                    <span class="ms-1"> 0đ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-bottom pt-2">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-8">
                                            <p class="mb-2 fw-bold text-uppercase">Tổng</p>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="d-flex justify-content-end align-items-end">
                                                <div class="product-price mb-2 fw-bold text-uppercase">
                                                    <span class="ms-1">{{ number_format($total) }} đ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- repetable -->
                            </div>
                            <!-- payment option -->
                            <div class="col my-4">
                                <div class="form-pay">
                                    <div class="pay-radio">
                                        <label for="visa">
                                            {{-- <img src="assets/images/icons/payment-visa.png"
                                                alt="payment"> --}}
                                            Thanh toán khi nhận hàng</label>
                                        <input checked="" id="visa" value="cash" name="payment_method"
                                            type="radio">
                                    </div>

                                    <div class="pay-radio">
                                        <label for="paypal">
                                            <img src="assets/images/icons/payment-vnpay.webp" width="24px"
                                                alt="payment">
                                            VnPay</label>
                                        <input id="paypal" value="vnpay" name="payment_method" type="radio">
                                    </div>

                                </div>
                            </div>
                            <!-- button section -->
                            <div class="col">
                                {{-- <p class="mb-3">Your personal data will be used to process your order, support your
                                experience
                                throughout
                                this website,
                                and for other purposes described in our <a href="privacy.html">privacy policy</a>.</p> --}}
                                <button type="submit"
                                    class="btn custom-btn-primary w-100 fw-bold button-effect transition-3d-hover px-4">
                                    Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        async function getProvinces() {
            try {
                const response = await fetch('https://provinces.open-api.vn/api/p/', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                    }
                });
                const data = await response.json();
                let provinceList = '<option value="" data-id="">Chọn tỉnh / thành phố</option>';
                data.forEach(it => {
                    provinceList += `<option value="${it.name}" data-id="${it.code}">${it.name}</option>`;
                });

                document.getElementById('provinces').innerHTML = provinceList;
            } catch (e) {
                console.log('error', e);
            }
        }
        document.getElementById('provinces').addEventListener('change', async function() {
            let selectedOption = this.options[this.selectedIndex];

            let provinceId = selectedOption.getAttribute('data-id');
            if (provinceId) {
                try {
                    const response = await fetch(`https://provinces.open-api.vn/api/p/${provinceId}?depth=2`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    const data = await response.json();


                    let districtList = '<option value="" data-id="">Chọn quận / huyện</option>';
                    data.districts.forEach(it => {
                        districtList +=
                            `<option value="${it.name}" data-id="${it.code}">${it.name}</option>`;
                    });

                    document.getElementById('districts').innerHTML = districtList;
                } catch (e) {
                    console.log('error', e);
                }
            }

        });

        document.getElementById('districts').addEventListener('change', async function() {
            let selectedOption = this.options[this.selectedIndex];

            let provinceId = selectedOption.getAttribute('data-id');
            if (provinceId) {
                try {
                    const response = await fetch(`https://provinces.open-api.vn/api/d/${provinceId}?depth=2`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                        }
                    });
                    const data = await response.json();

                    let wardList = '<option value="" data-id="">Chọn phường / xã</option>';
                    data.wards.forEach(it => {
                        wardList +=
                            `<option value="${it.name}" data-id="${it.code}">${it.name}</option>`;
                    });

                    document.getElementById('wards').innerHTML = wardList;
                } catch (e) {
                    console.log('error', e);
                }
            }

        });
        getProvinces();
    </script>
@endsection
