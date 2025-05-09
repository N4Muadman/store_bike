<ul class="deal-offer-list">
    @forelse ($dealTodayProducts as $key => $product)
        <li class="list-{{($key % 3) + 1}}">
            <div class="deal-offer-contain">
                <a href="#" class="deal-image">
                    <img src="{{$product->images[0]?->image_path}}" class="blur-up lazyload"
                        alt="">
                </a>

                <a href="#" class="deal-contain">
                    <h5>{{$product->name}}</h5>
                    <h6>{{number_format($product->sale_price)}} đ<del>{{number_format($product->price)}} đ</del></h6>
                </a>
            </div>
        </li>

    @empty

    <p class="w-100 text-center">Không có sản phẩm nào được giảm giá trong hôm nay</p>
    @endforelse
</ul>