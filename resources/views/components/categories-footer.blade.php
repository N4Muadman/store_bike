<ul>
    @foreach ($categories as $category)
        <li>
            <a href="{{route('product.index', ['category_l1' => $category->name])}}" class="text-content">{{$category->name}}</a>
        </li>
    @endforeach
</ul>