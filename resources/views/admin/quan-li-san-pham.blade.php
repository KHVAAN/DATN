@extends('layout.master_ad')

@section('title', 'Quản lí sản phẩm | Quản trị viên')

@section('content')
    <style>
        .text-align-center th,
        td {
            text-align: center;
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
                        <div class="row element-button">
                            <div class="col-sm-2">
                                <a class="btn btn-add btn-sm" href="{{ url('/them-san-pham') }}" title="Thêm"><i
                                        class="fas fa-plus"></i>
                                    Tạo mới sản phẩm</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm nhap-tu-file" type="button" title="Nhập"
                                    onclick="myFunction(this)"><i class="fas fa-file-upload"></i> Tải từ file</a>
                            </div>

                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm print-file" type="button" title="In"
                                    onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm print-file js-textareacopybtn" type="button"
                                    title="Sao chép"><i class="fas fa-copy"></i> Sao chép</a>
                            </div>

                            <div class="col-sm-2">
                                <a class="btn btn-excel btn-sm" href="" title="In"><i
                                        class="fas fa-file-excel"></i> Xuất Excel</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm pdf-file" type="button" title="In"
                                    onclick="myFunction(this)"><i class="fas fa-file-pdf"></i> Xuất PDF</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm" type="button" title="Xóa" onclick="myFunction(this)"><i
                                        class="fas fa-trash-alt"></i> Xóa tất cả </a>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead class="text-align-center">
                                <tr>
                                    <th>Mã sản phẩm</th>
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
                                @foreach ($product as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->tensanpham }}</td>
                                        <td>{{ $item->soluong }}</td>
                                        <td>{{ $item->dongia }}</td>
                                        <td>{{ $item->category->tenloaisp }}</td>
                                        <td>{{ $item->brand->tennhanhieu }}</td>
                                        <td>
                                            @if ($item->trangthai == 0)
                                                Còn hàng
                                            @else
                                                Hết hàng
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-add btn-sm" data-toggle="modal" data-target="#ModalUP1"
                                                type="button" title="Xem chi tiết">
                                                <i class="far fa-eye"></i>
                                            </button>
                                            <button class="btn btn-primary btn-sm edit" data-toggle="modal"
                                                data-target="#ModalUP" type="button" title="Sửa">
                                                <i class="fa fa-edit"></i>
                                            </button>
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


    <!--MODAL thông tin sản phẩm-->
    {{-- <div class="modal fade" id="ModalUP1" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                @if (isset($product))
                    <form action="{{ route('chi-tiet-san-pham', ['id' => $product->id]) }}" method="post">
                    @else
                        <form>
                @endif
                @csrf
                <input type="hidden" id="productId" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="thong-tin-thanh-toan">
                                <h5>Thông tin sản phẩm</h5>
                            </span>
                        </div>
                    </div>
                    @if (isset($product))
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Mã sản phẩm </label>
                                <input class="form-control" type="text" name="masanpham"
                                    value="{{ $product->id }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Tên sản phẩm</label>
                                <input type="text" name="tensanpham" class="form-control"
                                    value="{{ $product->tensanpham }}">
                                <div class="error-message">{{ $errors->first('tensanpham') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Số lượng</label>
                                <input class="form-control" type="number" name="soluong"
                                    value="{{ $product->soluong }}">
                                <div class="error-message">{{ $errors->first('soluong') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1" class="control-label">Tình trạng sản phẩm</label>
                                <select class="form-control" name="trangthai" id="exampleSelect1"
                                    value="{{ $product->trangthai }}">
                                    <option>Còn hàng</option>
                                    <option>Hết hàng</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Giá bán</label>
                                <input class="form-control" type="text" value="{{ $product->dongia }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1" class="control-label">Danh mục</label>
                                <select class="form-control" id="exampleSelect1" name="loaisp_id">
                                    <option selected value="{{ $product->category->id }}">
                                        {{ $product->category->tenloaisp }}</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->tenloaisp }}</option>
                                    @endforeach
                                </select>
                                <div class="error-message">{{ $errors->first('category') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1" class="control-label">Nhãn hiệu</label>
                                <select class="form-control" id="exampleSelect1" name="nhanhieu_id">
                                    <option selected value="{{ $product->brand->id }}">
                                        {{ $product->brand->tennhanhieu }}</option>
                                    @foreach ($brand as $item)
                                        <option value="{{ $item->id }}">{{ $item->tennhanhieu }}</option>
                                    @endforeach
                                </select>
                                <div class="error-message">{{ $errors->first('brand') }}</div>
                            </div>
                        </div>
                    @endif
                    <div class="modal-footer">
                        @if (isset($product))
                            <button class="btn btn-save" type="submit">Lưu lại</button>
                        @endif
                        <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div> --}}

    <!-- MODAL-->

    {{-- Modal chi tiết sản phẩm --}}
    {{-- <script>
        $(document).ready(function() {
            $('.btn-save').click(function() {
                var productId = $(this).closest('tr').find('td:first-child')
                    .text(); // Lấy mã sản phẩm từ hàng của nút được nhấn
                $('#productId').val(productId); // Thiết lập giá trị của input ẩn là mã sản phẩm
                $('#ModalUP1').modal('show'); // Hiển thị modal
            });
        });
    </script> --}}

@endsection
