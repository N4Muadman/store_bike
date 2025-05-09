@extends('layout')

@section('title', 'Thanh toán')

@section('content')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Thanh Toán</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Thanh Toán</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout section Start -->
    <section class="checkout-section-2 section-b-space">
        <div class="container-fluid-lg">
            <form action="{{ route('placeOrder') }}" method="post">
                @csrf
                <div class="row g-sm-4 g-3">
                    <div class="col-lg-8">
                        <div class="left-sidebar-checkout">
                            <div class="checkout-detail-box">
                                <ul>
                                    <li>
                                        <div class="checkout-icon">
                                            <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                                trigger="loop-on-hover"
                                                colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a" class="lord-icon">
                                            </lord-icon>
                                        </div>
                                        <div class="checkout-box">
                                            <div class="checkout-title">
                                                <h4>Địa chỉ giao hàng</h4>
                                            </div>
                                            <div id="billing-form" class="billing-form">
                                                <div class="row">
        
                                                    <div class="col-md-6 col-12 mb-3">
                                                        <label class="form-lable">Họ và tên <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Họ và tên" name="full_name" required>
                                                    </div>
        
                                                    <div class="col-md-6 col-12 mb-3">
                                                        <label class="form-lable">Email <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                                                    </div>
        
                                                    <div class="col-md-6 col-12 mb-3">
                                                        <label class="form-lable">Số điện thoại <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Số điện thoại" name="phone_number" required>
                                                    </div>
                                                    <div class="col-md-6 col-12 mb-3">
                                                        <label class="form-lable">Tỉnh / Thành phố <span class="text-danger">*</span></label>
                                                        <select class="form-select" name="province" id="provinces" required>
                                                            <option value="" data-id="">Chọn tỉnh / thành phố</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-12 mb-3">
                                                        <label class="form-lable">Quận / huyện <span class="text-danger">*</span></label>
                                                        <select class="form-select" name="district" id="districts" required>
                                                            <option value="" data-id="">Chọn quận / huyện</option>
                                                        </select>
                                                    </div>
        
                                                    <div class="col-md-6 col-12 mb-3">
                                                        <label class="form-lable">Phường / xã <span class="text-danger">*</span></label>
                                                        <select class="form-select" name="ward" id="wards" required>
                                                            <option value="" data-id="">Chọn phường / xã</option>
                                                        </select>
                                                    </div>
        
                                                    <div class="col-12 mb-3">
                                                        <label class="form-lable">Địa chỉ <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Địa chỉ" name="address" required>
                                                    </div>
        
                                                </div>
        
                                            </div>
    
                                        </div>
                                    </li>
    
                                    <li>
                                        <div class="checkout-icon">
                                            <lord-icon target=".nav-item" src="https://cdn.lordicon.com/qmcsqnle.json"
                                                trigger="loop-on-hover" colors="primary:#0baf9a,secondary:#0baf9a"
                                                class="lord-icon">
                                            </lord-icon>
                                        </div>
                                        <div class="checkout-box">
                                            <div class="checkout-title">
                                                <h4>Tùy chọn thanh toán</h4>
                                            </div>
    
                                            <div class="checkout-detail">
                                                <div class="accordion accordion-flush custom-accordion"
                                                    id="accordionFlushExample">
                                                    <div class="accordion-item">
                                                        <div class="accordion-header" id="flush-headingFour">
                                                            <div class="accordion-button collapsed" data-bs-toggle="collapse"
                                                                data-bs-target="#flush-collapseFour">
                                                                <div class="custom-form-check form-check mb-0">
                                                                    <label class="form-check-label" for="cash"><input
                                                                            class="form-check-input mt-0" type="radio"
                                                                            name="payment_method" id="cash" value="cash" checked>
                                                                        Thanh toán khi nhận hàng</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="flush-collapseFour" class="accordion-collapse collapse show"
                                                            data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
                                                                <p class="cod-review">
                                                                    Được phép kiểm tra hàng trước khi nhận
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <div class="accordion-item">
                                                        <div class="accordion-header" id="flush-headingOne">
                                                            <div class="accordion-button collapsed" data-bs-toggle="collapse"
                                                                data-bs-target="#flush-collapseOne">
                                                                <div class="custom-form-check form-check mb-0">
                                                                    <label class="form-check-label" for="credit"><input
                                                                            class="form-check-input mt-0" type="radio"
                                                                            name="payment_method" id="credit" value="vnpay">
                                                                        Thanh toán bằng VNPay</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                            data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
                                                                <img src="/assets/images/payment/VNPAY.jpg" alt="ảnh vnpay">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-lg-4">
                        <div class="right-side-summery-box">
                            <div class="summery-box-2">
                                <div class="summery-header">
                                    <h3>Tóm tắt Đặt hàng</h3>
                                </div>
    
                                <ul class="summery-contain">
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        @php
                                            $total += ($cart['sale_price'] > 0 ? $cart['sale_price'] : $cart['price']) * $cart['quantity'];
                                        @endphp
                                        <li>
                                            <img src="{{ $cart['image'] }}"
                                                class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                            <h4>{{ $cart['product_name'] }} <span>X {{ $cart['quantity'] }}</span></h4>
                                            <h4 class="price"> {{ number_format($cart['sale_price'] > 0 ? $cart['sale_price'] : $cart['price']) }} đ</h4>
                                        </li>
                                    @endforeach
                                </ul>
    
                                <ul class="summery-total">
                                    <li>
                                        <h4>Tổng phụ</h4>
                                        <h4 class="price">{{ number_format($total) }} đ</h4>
                                    </li>
    
                                    <li>
                                        <h4>Vận chuyển</h4>
                                        <h4 class="price">0 đ</h4>
                                    </li>
    
                                    <li>
                                        <h4>Phiếu giảm giá/Mã</h4>
                                        <h4 class="price">0 đ</h4>
                                    </li>
    
                                    <li class="list-total">
                                        <h4>Tổng cộng (VND)</h4>
                                        <h4 class="price">{{ number_format($total) }} đ</h4>
                                    </li>
                                </ul>
                            </div>
    
                            <button type="submit" class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <script>
    async function getProvinces(){
        try{
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
        }catch(e){
            console.log('error', e);
        }
    }
    document.getElementById('provinces').addEventListener('change', async function(){
        let selectedOption = this.options[this.selectedIndex];

        let provinceId = selectedOption.getAttribute('data-id');
        if (provinceId){
            try{
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
                    districtList += `<option value="${it.name}" data-id="${it.code}">${it.name}</option>`;
                });

                document.getElementById('districts').innerHTML = districtList;
            }catch(e){
                console.log('error', e);
            }
        }

    });

    document.getElementById('districts').addEventListener('change', async function(){
        let selectedOption = this.options[this.selectedIndex];

        let provinceId = selectedOption.getAttribute('data-id');
        if (provinceId){
            try{
                const response = await fetch(`https://provinces.open-api.vn/api/d/${provinceId}?depth=2`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                    }
                });
                const data = await response.json();

                let wardList = '<option value="" data-id="">Chọn phường / xã</option>';
                data.wards.forEach(it => {
                    wardList += `<option value="${it.name}" data-id="${it.code}">${it.name}</option>`;
                });

                document.getElementById('wards').innerHTML = wardList;
            }catch(e){
                console.log('error', e);
            }
        }

    });
    getProvinces();
</script>
@endsection
