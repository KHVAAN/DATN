@extends('layout.master_ad')

@section('title', 'Quản lí sản phẩm | Quản trị viên')

@section('content')
    <style>
        .bg-gray {
            background-color: #f2f2f2;
            /* Màu nền xám */
        }

        .text-dark {
            color: #000000;
            /* Màu chữ đen */
        }

        .font-weight-bold {
            font-weight: bold;
            /* Chữ in đậm */
        }

        .d-flex {
            display: flex;
        }

        .align-items-center {
            align-items: center;
        }

        .form-control-sm.d-inline-block {
            display: inline-block;
            width: auto;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .mr-2 {
            margin-right: 0.5rem;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mt-3 {
            margin-top: 0.5rem;
        }

        .pagination {
            justify-content: flex-end;
        }
    </style>

    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="{{ url('/quan-li-san-pham') }}"><b>Danh sách sản phẩm</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row element-button align-items-center">
                            <div class="col-sm-2">
                                <a class="btn btn-add btn-sm" href="{{ url('/them-san-pham') }}" title="Thêm">
                                    <i class="fas fa-plus"></i> Tạo mới sản phẩm
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm print-file" type="button" title="In"
                                    onclick="myApp.printTable()">
                                    <i class="fas fa-print"></i> In dữ liệu
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a class="btn btn-excel btn-sm" href="" title="In">
                                    <i class="fas fa-file-excel"></i> Xuất Excel
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm pdf-file" type="button" title="In"
                                    onclick="myFunction(this)">
                                    <i class="fas fa-file-pdf"></i> Xuất PDF
                                </a>
                            </div>

                            <div class="ml-auto">
                                <form action="{{ url('/quan-li-san-pham') }}" method="GET"
                                    class="d-flex align-items-center">
                                    <input type="search" id="searchInput" name="search"
                                        class="form-control form-control-sm mr-2" style="width: 200px; height: 40px;"
                                        placeholder="Nhập từ khóa tìm kiếm..." aria-controls="sampleTable"
                                        value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary btn-sm"><i
                                            class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        {{-- <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="d-flex align-items-center">
                                <label class="mr-2 mb-0">Hiển thị
                                    <select name="sampleTable_length" aria-controls="sampleTable"
                                        class="form-control form-control-sm d-inline-block">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                    </select>
                                </label>
                            </div>
                        </div> --}}

                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead class="text-align-center">
                                <tr class="bg-gray text-dark font-weight-bold">
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá tiền</th>
                                    <th>Danh mục</th>
                                    <th>Nhãn hiệu</th>
                                    <th>Tình trạng</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody class="text-align-center">
                                @php
                                    $currentPage = $product->currentPage();
                                    $perPage = $product->perPage();
                                @endphp
                                @foreach ($product as $index => $item)
                                    <tr>
                                        <td>{{ ($currentPage - 1) * $perPage + $index + 1 }}</td>
                                        <td>{{ $item->tensanpham }}</td>
                                        <td>{{ $item->soluong }}</td>
                                        <td>{{ $item->dongia }}</td>
                                        <td>{{ $item->category->tenloaisp }}</td>
                                        <td>{{ $item->brand->tennhanhieu }}</td>
                                        <td>
                                            @if ($item->trangthai == 0)
                                                <span class="badge bg-success">Còn hàng</span>
                                            @else
                                                <span class="badge bg-danger">Hết hàng</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form id="deleteForm-{{ $item->id }}"
                                                action="{{ url('/xoa-san-pham', ['id' => $item->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ url('/them-san-pham-con', ['id' => $item->id]) }}"
                                                    class="btn btn-excel btn-sm" title="Thêm sản phẩm con">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                                <a href="{{ url('/chi-tiet-san-pham', ['id' => $item->id]) }}"
                                                    class="btn btn-add btn-sm" title="Xem chi tiết">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <a href="{{ url('/chinh-sua-san-pham', ['id' => $item->id]) }}"
                                                    class="btn btn-primary btn-sm edit" title="Sửa">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button class="btn btn-primary btn-sm trash" type="submit" title="Xóa"
                                                    data-toggle="modal"
                                                    data-target="#confirmDeleteModal-{{ $item->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="sampleTable_info" role="status" aria-live="polite">
                                    <h6>Có {{ $product->total() }} thông tin được tìm thấy</h6>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="sampleTable_paginate">
                                    <ul class="pagination">
                                        {{-- Link đến trang trước --}}
                                        @if ($product->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $product->previousPageUrl() }}" rel="prev">&laquo;</a>
                                            </li>
                                        @endif

                                        {{-- Các trang phân trang --}}
                                        @foreach ($product->getUrlRange(1, $product->lastPage()) as $page => $url)
                                            @if ($page == $product->currentPage())
                                                <li class="page-item active"><span
                                                        class="page-link">{{ $page }}</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach

                                        {{-- Link đến trang tiếp theo --}}
                                        @if ($product->hasMorePages())
                                            <li class="page-item"><a class="page-link" href="{{ $product->nextPageUrl() }}"
                                                    rel="next">&raquo;</a></li>
                                        @else
                                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="modal fade" id="confirmDeleteModal-{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h4 class="modal-title mt-4 mb-3">Cảnh báo</h4>
                        <h5 class="control-label">Bạn có chắc muốn xóa không?</h5>
                        <div class="form-group mt-4">
                            <button id="confirmDeleteBtn-{{ $item->id }}" class="btn btn-primary mr-2">Xác
                                nhận</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('confirmDeleteBtn-{{ $item->id }}').addEventListener('click', function() {
                document.getElementById('deleteForm-{{ $item->id }}').submit();
            });
        </script> --}}
    </main>
@endsection
