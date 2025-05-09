<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\CustomerNeedAdviceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmbedYoutubeVideosController;
use App\Http\Controllers\Admin\RivewProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\vnpay\PaymentByVnpay;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('ve-chung-toi', [PagesController::class, 'aboutUs'])->name('aboutUs');
Route::get('lien-he', [PagesController::class, 'contact'])->name('contact');
Route::get('faqs', [PagesController::class, 'faqs'])->name('faqs');
Route::get('dich-vu-cua-chung-toi', [PagesController::class, 'ourService'])->name('ourService');
Route::get('uu-dai-hot', [PagesController::class, 'hotDeal'])->name('hotDeal');
Route::get('khuyen-mai', [PagesController::class, 'promotion'])->name('promotion');

Route::get('chinh-sach-bao-hanh', [PagesController::class, 'warrantyPolicy'])->name('warrantyPolicy');
Route::get('chinh-sach-giao-hang', [PagesController::class, 'shippingPolicy'])->name('shippingPolicy');
Route::get('chinh-sach-bao-mat', [PagesController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('dieu-khoan-dieu-kien', [PagesController::class, 'termsConditions'])->name('termsConditions');
Route::get('cam-ket-gia-ca', [PagesController::class, 'priceCommitment'])->name('priceCommitment');
Route::get('phan-hoi-khach-hang', [PagesController::class, 'feedbackService'])->name('feedbackService');

Route::get('san-pham', [ProductController::class, 'index'])->name('product.index');
Route::get('quick-view/{id}', [ProductController::class, 'quickView'])->name('quick-view');
Route::get('product-detail/{id}', [ProductController::class, 'productDetail'])->name('product.detail');
Route::post('review-product/{id}', [ProductController::class, 'review'])->name('review.product');

Route::get('tin-tuc/{slug}', [BlogController::class, 'detail'])->name('blog.detail');
Route::get('tin-tuc', [BlogController::class, 'index'])->name('blogs');
Route::post('post-comment', [BlogController::class, 'postComment'])->name('postComment');

Route::get('gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('get-carts', [CartController::class, 'getCarts'])->name('getCarts');
Route::post('cart/decrease/{index}', [CartController::class, 'decrease'])->name('decreaseCart');
Route::post('cart/increase/{index}', [CartController::class, 'increase'])->name('increaseCart');
Route::DELETE('delete-cart/{index}', [CartController::class, 'deleteCart'])->name('deleteCart');

Route::middleware('auth')->group(function () {
    Route::get('thanh-toan', [PaymentController::class, 'checkout'])->name('checkout');
    Route::post('dat-hang', [PaymentController::class, 'placeOrder'])->name('placeOrder');
    Route::get('payment-vnpay-return', [PaymentByVnpay::class, 'handlePaymentReturn'])->name('payment.vnpay.return');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});


Route::get('login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::middleware('is_admin')->prefix('admin')->group(function ()  {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('quan-ly-don-hang', [OrderController::class, 'index'])->name('order.index');
    Route::get('chi-tiet-don-hang/{id}', [OrderController::class, 'getOrderItem'])->name('order.getOrderItem');
    Route::post('thay-doi-trang-thai/{id}', [OrderController::class, 'changeStatus'])->name('order.changeStatus');
    Route::delete('xoa-don-hang/{id}', [OrderController::class, 'delete'])->name('order.delete');

    Route::resource('quan-ly-san-pham', AdminProductController::class)->names('admin.products');
    Route::delete('quan-ly-san-pham/{id}/xoa-anh', [AdminProductController::class, 'deleteImage'])->name('admin.product.image.delete');
    Route::delete('quan-ly-san-pham/{id}/xoa-dac-diem', [AdminProductController::class, 'deleteCharacteristic'])->name('admin.product.color.characteristic');

    Route::resource('quan-ly-bai-viet', PostController::class)->names('admin.posts');
    Route::resource('danh-muc-san-pham', CategoryProductController::class)->names('admin.category.product');

    Route::get('danh-gia-san-pham', [RivewProductController::class, 'index'])->name('review.index');
    Route::post('update-review/{id}', [RivewProductController::class, 'update'])->name('review.update');
    Route::delete('destroy-review/{id}', [RivewProductController::class, 'destroy'])->name('review.destroy');
    Route::post('approve-review/{id}', [RivewProductController::class, 'approve'])->name('review.approve');
});
