@extends('layout.master_ad')

@section('title', 'Danh sách nhãn hiệu | Quản trị viên')

@section('content')
    <style>
        .text-align-center th,
        td {
            text-align: center;
        }
    </style>
    <main class="app-content">
        <div class="row element-button">
            <div class="col-sm-2">
                <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#exampleModalCenter1" title="Thêm"><i
                        class="fas fa-plus"></i>
                    Thêm mới nhãn hiệu</a>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#exampleModalCenter2" title="Thêm"><i
                        class="fas fa-plus"></i>
                    Thêm mới kích thước</a>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#exampleModalCenter3" title="Thêm"><i
                        class="fas fa-plus"></i>
                    Thêm mới màu sắc</a>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#exampleModalCenter4" title="Thêm"><i
                        class="fas fa-plus"></i>
                    Thêm mới loại sản phẩm</a>
            </div>
        </div>

        {{-- Danh sách nhãn hiệu --}}
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="{{ url('/danh-sach-chung') }}"><b>Danh sách nhãn hiệu</b></a>
                </li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead class="text-align-center">
                                <tr>
                                    {{-- <th>STT</th> --}}
                                    <th>Tên nhãn hiệu</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đăng</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Tính năng</th>
                                </tr>
                            </thead>
                            <tbody class="text-align-center">
                                @foreach ($brand as $index => $item)
                                    <tr>
                                        {{-- <td>{{ $index + 1 }}</td> <!-- STT --> --}}
                                        <td>{{ $item->tennhanhieu }}</td>
                                        <td>
                                            @if ($item->trangthai == 0)
                                                Còn hàng
                                            @else
                                                Hết hàng
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <a href="{{ url('/chinh-sua-nhan-hieu', ['id' => $item->id]) }}"
                                                class="btn btn-primary btn-sm edit" type="button" title="Sửa">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-primary btn-sm trash" data-toggle="modal"
                                                data-target="#deleteModal">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        {{-- Danh sách kích thước --}}
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="{{ url('/danh-sach-chung') }}"><b>Danh sách kích
                            thước</b></a>
                </li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead class="text-align-center">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên kích thước</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đăng</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Tính năng</th>
                                </tr>
                            </thead>
                            <tbody class="text-align-center">
                                @foreach ($size as $index => $item)
                                    <td>{{ $index + 1 }}</td> <!-- STT -->
                                    <td>{{ $item->tensize }}</td>
                                    <td>
                                        @if ($item->trangthai == 0)
                                            Còn hàng
                                        @else
                                            Hết hàng
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="{{ url('/chinh-sua-kich-thuoc', ['id' => $item->id]) }}"
                                            class="btn btn-primary btn-sm edit" type="button" title="Sửa">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button class="btn btn-primary btn-sm trash" type="button" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Danh sách màu sắc --}}
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="{{ url('/danh-sach-chung') }}"><b>Danh sách màu sắc</b></a>
                </li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead class="text-align-center">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên màu sắc</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đăng</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Tính năng</th>
                                </tr>
                            </thead>
                            <tbody class="text-align-center">
                                @foreach ($color as $index => $item)
                                    <td>{{ $index + 1 }}</td> <!-- STT -->
                                    <td>{{ $item->tenmau }}</td>
                                    <td>
                                        @if ($item->trangthai == 0)
                                            Còn hàng
                                        @else
                                            Hết hàng
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="{{ url('/chinh-sua-mau-sac', ['id' => $item->id]) }}"
                                            class="btn btn-primary btn-sm edit" type="button" title="Sửa">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button class="btn btn-primary btn-sm trash" type="button" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Danh sách loại sản phẩm --}}
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="{{ url('/danh-sach-chung') }}"><b>Danh sách loại sản
                            phẩm</b></a>
                </li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead class="text-align-center">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên loại sản phẩm</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đăng</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Tính năng</th>
                                </tr>
                            </thead>
                            <tbody class="text-align-center">
                                @foreach ($category as $index => $item)
                                    <td>{{ $index + 1 }}</td> <!-- STT -->
                                    <td>{{ $item->tenloaisp }}</td>
                                    <td>
                                        @if ($item->trangthai == 0)
                                            Còn hàng
                                        @else
                                            Hết hàng
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="{{ url('/chinh-sua-loai', ['id' => $item->id]) }}"
                                            class="btn btn-primary btn-sm edit" type="button" title="Sửa">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button class="btn btn-primary btn-sm trash" type="button" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
