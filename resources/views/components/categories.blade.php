<ul class="category-list">
    @foreach ($categories as $category)
        <li class="onhover-category-list">
            <a href="javascript:void(0)" class="category-name">
                <img src="{{ $category->icon }}" alt="">
                <h6>{{ $category->name }}</h6>
                <i class="fa-solid fa-angle-right"></i>
            </a>

            <div class="onhover-category-box">
                <div class="list-1">
                    <div class="category-title-box">
                        <h5>{{ $category->name }}</h5>
                    </div>
                    <ul>
                        @foreach ($category->categoryChilden as $cate)
                            <li>
                                <a href="{{ route('product.index', ['category' => $cate->name]) }}">{{ $cate->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
                {{-- <div class="list-2">
                    <div class="category-title-box">
                        <h5>Organic Vegetables</h5>
                    </div>
                    <ul>
                        <li>
                            <a href="javascript:void(0)">Potato & Tomato</a>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </li>
    @endforeach
</ul>
