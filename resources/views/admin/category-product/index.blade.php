@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Thống kê</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Danh mục sản phẩm</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">Danh sách danh mục</h2>
                        <button data-bs-toggle="modal" data-bs-target="#add-category"
                            class="btn btn-light-primary d-flex align-items-center gap-2"><i class="ti ti-plus"></i> Thêm
                            danh mục</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.category.product.index') }}" method="get">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-3">
                <input type="text" class="form-control" name="name" placeholder="Tìm kiếm theo tên" value="{{ request('name') }}">
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
                        <table class="table table-hover text-center table-fixed" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên danh mục</th>
                                    <th>Icon</th>
                                    <th>Số lượng sản phẩm</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $it)
                                    <tr class="parent-row">
                                        <td>{{ $it->id }}</td>
                                        <td>{{ $it->name }}</td>
                                        <td>
                                            {!! $it->icon ? '<img src="'.$it->icon.'" style="width: 25px; height: 25px"
                                            class="blur-up lazyload" alt=""></td>' : 'Không có' !!} 
                                        </td>
                                        <td>{{ $it->products->count() }}</td>
                                        <td>
                                            <a href="#"class="avtar avtar-edit avtar-xs btn-link-secondary"
                                                data-id="{{ $it->id }}" title="CẬP NHẬT">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            <a href="#" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                data-name="{{ $it->name }}" data-id="{{ $it->id }}"
                                                title="XÓA Danh mục">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-center">Không có danh mục nào</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $categories->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-category" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Thêm mới danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.category.product.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-lable">Tên danh mục</label>
                            <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục" required>
                        </div>

                        <div class="mb-3 icon">
                            <label for="" class="form-lable">Link Icon</label>
                            <input type="text" class="form-control" name="icon" placeholder="Nhập link Icon" required>
                        </div>

                        <button type="submit" class="btn btn-info" >Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog-edit"></div>
    <div id="dialog-delete"></div>
    <script>
        
        document.querySelectorAll('.avtar-edit').forEach((element) => {
            element.addEventListener('click', async () =>{
                const id = element.dataset.id;

                if (id){
                    const response = await fetch('{{ route('admin.category.product.show', ':id') }}'.replace(':id', id), {
                        method: "get",
                        headers: {
                            'X-CSTF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await response.json();

                    if (!response.ok){
                        alert("Có lỗi xảy ra");
                        return;
                    }
                    const category = data.category;

                    document.getElementById('dialog-edit').innerHTML = `<div class="modal fade" id="edit-category" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="orderModalLabel">Chỉnh sửa danh mục</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form action="{{ route('admin.category.product.update', ':id') }}" method="post">
                                                                                            @csrf
                                                                                            @method('put')
                                                                                            <div class="mb-3">
                                                                                                <label for="" class="form-lable">Tên danh mục</label>
                                                                                                <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục" value="${category.name}" required>
                                                                                            </div>
                                                                                            
                                                                                            <div class="mb-3 icon">
                                                                                                <label for="" class="form-lable">Link Icon</label>
                                                                                                <input type="text" class="form-control" name="icon" value="${category.icon}" placeholder="Nhập link Icon">
                                                                                            </div>

                                                                                            <button type="submit" class="btn btn-info" >Cập nhật</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>`.replace(':id', id);
                    const modal = new bootstrap.Modal(document.getElementById('edit-category'));
                    modal.show();
                }
            })
        });


        document.querySelectorAll('.avtar-delete').forEach((element) => {
            element.addEventListener('click', async () =>{
                const id = element.dataset.id;
                const name = element.dataset.name;

                if(id){
                    document.getElementById('dialog-delete').innerHTML = `<div class="modal fade" id="delete-category" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="orderModalLabel">Xác nhận xóa</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Bạn có muốn xóa danh mục: <strong>${name}</strong> không?</p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                                        <form action="{{ route('admin.category.product.destroy', ':id') }}" method="post">
                                                                                            @csrf
                                                                                            @method('delete')
                                                                                            <button type="submit" class="btn btn-info">Xóa</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>`.replace(':id', id);
                    const modal = new bootstrap.Modal(document.getElementById('delete-category'));
                    modal.show();
                }
            });
        });
    </script>
@endsection
