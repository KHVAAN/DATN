@extends('layout.master_ad')

@section('title', 'Quản lí khách hàng | Quản trị viên')

@section('content')
<style>
        /* .text-align-center th,
            td {
                text-align: center;
            } */

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
                <li class="breadcrumb-item active"><a href="{{ url('/quan-li-khach-hang') }}"><b>Danh sách khách hàng</b></a>
                </li>
            </ul>
            <div id="clock"></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row element-button">
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm print-file" type="button" title="In"
                                    onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
                            </div>

                            <div class="col-sm-2">
                                <a class="btn btn-excel btn-sm" href="" title="In"><i
                                        class="fas fa-file-excel"></i> Xuất Excel</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm pdf-file" type="button" title="In"
                                    onclick="myFunction(this)"><i class="fas fa-file-pdf"></i> Xuất PDF</a>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
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
                            <div class="d-flex align-items-center">
                                <label class="mr-2 mb-0">Tìm kiếm:</label>
                                <input type="search" id="searchInput" class="form-control form-control-sm mr-2"
                                    style="width: 200px; height: 40px;" placeholder="Nhập từ khóa tìm kiếm..."
                                    aria-controls="sampleTable" onkeydown="handleSearch(event)">
                            </div>
                        </div>



                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead class="text-align-center">
                                <tr class="bg-gray text-dark font-weight-bold">
                                    <th>STT</th>
                                    <th>Họ và tên</th>
                                    <th>Địa chỉ</th>
                                    <th>SĐT</th>
                                    <th>Giới tính</th>
                                    <th>Ngày sinh</th>
                                    <th>Chức vụ</th>
                                    <th>Trạng thái</th>
                                    <th>Tính năng</th>
                                </tr>
                            </thead>
                            <tbody class="text-align-center">
                                @foreach ($user as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td> <!-- STT -->
                                        <td>{{ $item->hovaten }}</td>
                                        <td>{{ $item->diachi }}</td>
                                        <td>{{ $item->sdt }}</td>
                                        <td>
                                            @if ($item->gioitinh === 'male')
                                                Nam
                                            @else
                                                Nữ
                                            @endif
                                        </td>
                                        <td>{{ $item->ngaysinh }}</td>
                                        <td>
                                            @if ($item->phanquyen === 2)
                                                User
                                            @else
                                                {{ $item->phanquyen }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->trangthai == 0)
                                                Hoạt động
                                            @else
                                                Vô hiệu hoá
                                            @endif
                                        </td>
                                        <td>
                                            <form id="deleteForm-{{ $item->id }}"
                                                action="{{ url('/xoa-user', ['id' => $item->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ url('/chi-tiet-user', ['id' => $item->id]) }}"
                                                    class="btn btn-add btn-sm" title="Xem chi tiết">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                {{-- <a href="{{ url('/chinh-sua-tai-khoan', ['id' => $item->id]) }}"
                                                    class="btn btn-primary btn-sm edit" type="button" title="Sửa">
                                                    <i class="fa fa-edit"></i>
                                                </a> --}}
                                                <button class="btn btn-primary btn-sm trash" type="button" title="Xóa"
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
                                    Có {{ $user->total() }} thông tin được tìm thấy
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="sampleTable_paginate">
                                    {{ $user->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="confirmDeleteModal-{{ $item->id }}" tabindex="-1" role="dialog"
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

    {{-- <script>
        // JavaScript for handling search
        function handleSearch(event) {
            if (event.keyCode === 13) { // Check if Enter key is pressed
                event.preventDefault(); // Prevent default form submission
                performSearch();
            }
        }

        // Handle search button click
        function handleSearchButton() {
            performSearch();
        }

        // Function to perform search
        function performSearch() {
            var searchText = document.getElementById('searchInput').value.trim().toLowerCase(); // Get search input value

            // Perform search
            var rows = document.querySelectorAll('#sampleTable tbody tr');
            var found = false;
            rows.forEach(function(row) {
                var cells = row.querySelectorAll('td');
                var foundInRow = false;
                cells.forEach(function(cell) {
                    var text = cell.innerText.toLowerCase();
                    if (text.includes(searchText)) {
                        row.style.display = '';
                        found = true;
                        foundInRow = true;
                    }
                });
                if (!foundInRow) {
                    row.style.display = 'none';
                }
            });

            // Show alert if no results found
            if (!found) {
                alert('Không tìm thấy sản phẩm phù hợp.');
            }
        }

        // Submit delete form on confirmation
        document.getElementById('confirmDeleteBtn-{{ $item->id }}').addEventListener('click', function() {
            document.getElementById('deleteForm-{{ $item->id }}').submit();
        });
    </script> --}}

@endsection
