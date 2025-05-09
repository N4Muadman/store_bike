@extends('layout')

@section('title', 'Đăng nhập')

@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2 class="mb-2">Đăng nhập</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Đăng nhập</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- log in section start -->
    <section class="log-in-section background-image-2 section-b-space">
        <div class="container-fluid-lg w-100">
            <div class="row">
                <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                    <div class="image-contain">
                        <img src="../assets/images/inner-page/log-in.png" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h3>Xin chào bạn đến với lotte mart</h3>
                            <h4>Đăng nhập với tài khoản của bạn</h4>
                        </div>

                        <div class="input-box">
                            <form class="row g-4" action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Địa chỉ email">
                                        <label for="email">Địa chỉ email</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                                        <label for="password">Mật khẩu</label>
                                    </div>
                                </div>
                                @error('loginError')
                                    <p style="color: red">Tên đăng nhập hoặc mật khẩu không đúng</p>
                                @enderror


                                <div class="col-12">
                                    <button class="btn btn-animation w-100 justify-content-center" type="submit">Đăng
                                        nhập</button>
                                </div>
                            </form>
                        </div>

                        <div class="other-log-in">
                            <h6></h6>
                        </div>

                        <div class="sign-up-box">
                            <h4>Bạn chưa có tài khoản?</h4>
                            <a href="{{ route('register.form') }}">Đăng kí</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
