<div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body p-3">
            <div class="position-absolute top-0 end-0 me-3 mt-3" id="quickViewModalLabel">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <!-- product gallery -->
                    <div class="product-gallery position-relative">
                        <div class="slider slider-for">
                            @foreach ($product->images as $image)
                                <div class="zoom" onmousemove="zoom(event)"
                                    style="background-image: url({{ $image->image_path }})">
                                    <img src="{{ $image->image_path }}" alt="Hunting">
                                </div>
                            @endforeach

                        </div>
                        <div class="slider slider-nav gallery-thumb">
                            @foreach ($product->images as $image)
                                <div>
                                    <img src="{{ $image->image_path }}" alt="Hunting store">
                                </div>
                            @endforeach
                        </div>
                        <!-- products thumb -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <form class="form-add-to-cart" method="post">
                        <input type="text" name="product_id" hidden value="{{ $product->id }}">
                        <div class="mt-5 mt-lg-0">
                            <a href="{{ route('product.detail', $product->id) }}"
                                class="mb-2 d-block h4">{{ $product->name }}</a>
                            <div class="">
                                {!! $product->short_description !!}
                            </div>
                            <div class="mb-2">
                                @php
                                    $rating =
                                        $product->reviews->count() > 0
                                            ? $product->reviews->sum('rating') / $product->reviews->count()
                                            : 5;
                                @endphp

                                <small class="text-warning">

                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                    @endfor
                                </small>
                                <a href="#" class="ms-2">({{ $product->reviews->count() }} đánh giá)</a>
                            </div>
                            @if ($product->price > 0)
                                <div class="row">
                                    <div class="col-12 fs-4">
                                        <span
                                            class="fw-bold theme-text-primary">{{ $product->has_sale ? number_format($product->sale_price) : number_format($product->price) }}
                                            đ</span>
                                        <span
                                            class="text-decoration-line-through text-muted">{{ $product->has_sale ? number_format($product->price) . ' đ' : '' }}</span>

                                    </div>
                                    <div class="col-6">
                                        <div class="input-group input-spinner">
                                            <span class="button-minus btn btn-sm">-</span>
                                            <input type="text" value="1" name="quantity"
                                                class="quantity-field form-control-sm form-input">
                                            <span class="button-plus btn btn-sm">+</span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-6">
                                <div class="mt-3 row justify-content-start g-2 align-items-center">
                                    <div class="col-12 col-md-6">
                                        <button type="submit"
                                            class="custom-btn-primary font-small button-effect justify-content-center align-items-center d-flex w-100">
                                            <i class="feather-icon icon-shopping-bag me-2"></i>Thêm vào giỏ hàng
                                        </button>
                                    </div>
                                </div>
                            @else
                                <p class="fs-3">Giá: <a class="text">Liên hệ</a></p>
                                <hr class="my-6">
                                <div class="mt-0 mt-lg-3 row justify-content-start g-2 align-items-center">
                                    <div class="col-6">
                                        <!-- button -->
                                        <div class="custom-button">
                                            <a data-bs-toggle="modal" data-bs-target="#contactModal"
                                                class="btn custom-demo-btn m-0">
                                                <i class="bi bi-telephone-outbound me-2"></i>Liên hệ ngay
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <hr class="my-6">
                            <div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Mã sản phẩm:</td>
                                            <td>{{ $product->id }}</td>
                                        </tr>
                                        <tr>
                                            <td>Danh mục sản phẩm:</td>
                                            <td>{{ $product->category?->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Trạng thái:</td>
                                            <td>
                                                {!! $product->stock_quantity > 0
                                                    ? '<span class="badge text-bg-success">Còn hàng</span>'
                                                    : '<span class="badge text-bg-danger">Hết hàng</span>' !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vận chuyển:</td>
                                            <td>
                                                <small>Giao hàng trong 03 ngày.<span class="text-muted">(Giao hàng miễn
                                                        phí hôm nay)</span></small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav',
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: false,
        centerMode: true,
        focusOnSelect: true,
    });

    // product slider - Vertical Left Thumbnail
    $('.slider-for-left').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        asNavFor: '.slider-nav-left',
    });
    $('.slider-nav-left').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for-left',
        dots: false,
        arrows: false,
        centerMode: true,
        focusOnSelect: true,
        vertical: true,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                centerMode: true,
                vertical: false,
            }
        }]
    });
    $('.button-minus').click(function() {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        console.log('000');

        return false;
    });
    $('.button-plus').click(function() {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        console.log('000');
        return false;
    });
</script>
