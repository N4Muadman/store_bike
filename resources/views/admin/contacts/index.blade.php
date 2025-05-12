@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Thống kê</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Liên hệ khách hàng</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">Danh sách liên hệ của khách hàng</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.contacts.index') }}" method="get">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-3">
                <input type="text" class="form-control" name="full_name" placeholder="Tìm kiếm theo tên khách hàng"
                    value="{{ request('full_name') }}">
            </div>

            <div class="col-12 col-md-3">
                <input type="text" class="form-control" name="product" placeholder="Tìm kiếm theo tên sản phẩm"
                    value="{{ request('product') }}">
            </div>

            <div class="col-3">
                <button type="submit" class="btn btn-info">Tìm kiếm</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover text-center" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Nội dung</th>
                                    <th>Tên sản phẩm</th>
                                    <th></th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contacts as $it)
                                    <tr class="parent-row">
                                        <td>{{ $it->id }}</td>
                                        <td>{{ $it->name }}</td>
                                        <td>{{ $it->email }}</td>
                                        <td>{{ $it->phone }}</td>
                                        <td>{{ $it->message }}</td>
                                        <td>{{ $it->product?->name }}
                                        </td>
                                        <td><img src="{{ $it->product?->images?->first()?->image_path }}" width="40px"
                                                alt=""></td>
                                        <td>
                                            @if ($it->is_read)
                                                <a href="#!"class="avtar avtar-xs btn-link-success"
                                                    data-id="{{ $it->id }}" title="Đã xem">
                                                    <i class="ti ti-circle-check f-20"></i>
                                                </a>
                                            @else
                                                <a href="#!"class="avtar btn-seen avtar-xs btn-link-secondary"
                                                    data-bs-toggle="modal" data-bs-target="#seen-contact"
                                                    data-id="{{ $it->id }}" data-name="{{ $it->name }}"
                                                    title="Cập nhật trạng thái">
                                                    <i class="ti ti-circle-check f-20"></i>
                                                </a>
                                            @endif
                                            <a href="#!"class="avtar btn-show avtar-xs btn-link-secondary"
                                                data-id="{{ $it->id }}" data-bs-toggle="modal"
                                                data-bs-target="#show-contact" title="Xem">
                                                <i class="ti ti-eye f-20"></i>
                                            </a>
                                            <a href="#!" class="avtar btn-delete avtar-xs btn-link-secondary"
                                                data-bs-toggle="modal" data-bs-target="#delete-contact"
                                                data-name="{{ $it->name }}" data-id="{{ $it->id }}"
                                                title="XÓA Danh mục">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <p class="text-center">Không có liên hệ nào</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $contacts->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-contact" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Xóa liên hệ khách hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có muốn xóa liên hệ của <strong id="name-contact-delete"></strong> không ?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <form method="post" id="form-delete-contact">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-info">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="seen-contact" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Cập nhật trạng thái đã xem của liên hệ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có muốn cập nhật trạng thái liên hệ của <strong id="name-contact-seen"></strong> thành đã xem
                        không ?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <form method="post" id="form-seen-contact">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-info">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="show-contact" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Chi tiết liên hệ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="content-contact-show">
                        
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.querySelectorAll('.btn-delete').forEach(element => {
            element.addEventListener('click', () => {
                document.getElementById('name-contact-delete').innerHTML = element.dataset.name;
                document.getElementById('form-delete-contact').action =
                    '{{ route('admin.contacts.destroy', ':id') }}'.replace(':id', element.dataset.id);
            })
        });

        document.querySelectorAll('.btn-seen').forEach(element => {
            element.addEventListener('click', () => {
                document.getElementById('name-contact-seen').innerHTML = element.dataset.name;
                document.getElementById('form-seen-contact').action =
                    '{{ route('admin.contacts.seen', ':id') }}'.replace(':id', element.dataset.id);
            })
        });

        document.querySelectorAll('.btn-show').forEach(element => {
            element.addEventListener('click', async () => {
                const contactId = element.dataset.id;

                if (contactId) {
                    const response = await fetch('{{ route('admin.contacts.show', ':id') }}'.replace(
                        ':id', contactId), {
                        method: "get",
                        headers: {
                            'X-CSTF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    const data = await response.text();

                    if (!response.ok) {
                        alert("Có lỗi xảy ra");
                        return;
                    }

                    document.getElementById('content-contact-show').innerHTML = data;
                }
            })
        });
    </script>
@endsection
