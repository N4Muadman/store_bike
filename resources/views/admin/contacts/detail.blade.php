<div class="col-4">
    <p>Họ và tên: <strong>{{$contact->name}}</strong></p>
</div>

<div class="col-4">
    <p>Email: <strong>{{$contact->email}}</strong></p>
</div>

<div class="col-4">
    <p>Số điện thoại: <strong>{{$contact->phone}}</strong></p>
</div>

<div class="col-12">
    <p>Nội dung</p>
    <p>{{$contact->message}}</p>
</div>
<div class="text-center">
    <p>{{$contact->product?->name}}</p>
    <img src="{{$contact->product?->images?->first()?->image_path}}" alt="anh san pham" width="50%">
</div>
