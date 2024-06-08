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
        {{-- Modal 1 --}}
        <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('them-nhan-hieu') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="thong-tin-thanh-toan">
                                        <h5>Thêm mới nhãn hiệu</h5>
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="control-label">Nhập tên nhãn hiệu mới</label>
                                    <input type="text" name="tennhanhieu" class="form-control"
                                        placeholder="Tên nhãn hiệu">
                                    <div class="error-message">{{ $errors->first('tennhanhieu') }}</div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label">Tình trạng</label>
                                    <select id="inputState" name="trangthai" class="form-control">
                                        <option value="">-- Chọn tình trạng --</option>
                                        <option value="0">Còn hàng</option>
                                        <option value="1">Hết hàng</option>
                                    </select>
                                    <div class="error-message">{{ $errors->first('trangthai') }}</div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-save" type="submit">Lưu lại</button>
                            <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                            <br>
                        </form>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>

        {{-- Modal Sửa 1 --}}
        {{-- <div class="modal fade" id="exampleModalCenterEdit1" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('cap-nhat-nhan-hieu', ['id' => $brand->id]) }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <label for="inputEmail4">Tên nhãn hiệu</label>
                                    <input type="text" name="tennhanhieu" class="form-control"
                                        placeholder="Tên nhãn hiệu">
                                    <div class="error-message">{{ $errors->first('tennhanhieu') }}</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputState">Trạng thái</label>
                                    <select id="inputState" name="trangthai" class="form-control">
                                        <option selected value=" ">Trạng thái</option>
                                        <option value="0">Xuất bản</option>
                                        <option value="1">Nháp</option>
                                    </select>
                                    <div class="error-message">{{ $errors->first('trangthai') }}</div>
                                </div>
                            </div>
                            <button class="btn btn-save" type="submit">Cập nhật</button>
                            <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                            <br>
                        </form>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div> --}}


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
                                    <th>STT</th>
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
                                        <td>{{ $index + 1 }}</td> <!-- STT -->
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
                                            <button class="btn btn-primary btn-sm trash" data-toggle="modal"
                                                data-target="#exampleModalCenterEdit1" type="button" title="Xóa">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <button class="btn btn-primary btn-sm edit" type="button" title="Sửa">
                                                <i class="fa fa-edit"></i>
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


        {{-- Modal 2 --}}
        <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('them-kich-thuoc') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="thong-tin-thanh-toan">
                                        <h5>Thêm mới kích thước</h5>
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="control-label">Nhập tên kích thước mới</label>
                                    <input type="text" name="tensize" class="form-control"
                                        placeholder="Tên kích thước">
                                    <div class="error-message">{{ $errors->first('tensize') }}</div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label">Tình trạng</label>
                                    <select id="inputState" name="trangthai" class="form-control">
                                        <option value="">-- Chọn tình trạng --</option>
                                        <option value="0">Còn hàng</option>
                                        <option value="1">Hết hàng</option>
                                    </select>
                                    <div class="error-message">{{ $errors->first('trangthai') }}</div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-save" type="submit">Lưu lại</button>
                            <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                            <br>
                        </form>
                    </div>
                    <div class="modal-footer"></div>
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
                                        <button class="btn btn-primary btn-sm trash" type="button" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm edit" type="button" title="Sửa">
                                            <i class="fa fa-edit"></i>
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

        {{-- Modal 3 --}}
        <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('them-mau-sac') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="thong-tin-thanh-toan">
                                        <h5>Thêm mới màu sắc</h5>
                                    </span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label">Nhập tên màu sắc mới</label>
                                    <input type="text" name="tenmau" class="form-control" placeholder="Tên màu sắc">
                                    <div class="error-message">{{ $errors->first('tenmau') }}</div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label">Tình trạng</label>
                                    <select id="inputState" name="trangthai" class="form-control">
                                        <option value="">-- Chọn tình trạng --</option>
                                        <option value="0">Còn hàng</option>
                                        <option value="1">Hết hàng</option>
                                    </select>
                                    <div class="error-message">{{ $errors->first('trangthai') }}</div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-save" type="submit">Lưu lại</button>
                            <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                            <br>
                        </form>
                    </div>
                    <div class="modal-footer"></div>
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
                                        <button class="btn btn-primary btn-sm trash" type="button" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm edit" type="button" title="Sửa">
                                            <i class="fa fa-edit"></i>
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

        {{-- Modal 4 --}}
        <div class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('them-loai') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="thong-tin-thanh-toan">
                                        <h5>Thêm mới loại sản phẩm</h5>
                                    </span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label">Nhập tên loại sản phẩm mới</label>
                                    <input type="text" name="tenloaisp" class="form-control" placeholder="Tên loại">
                                    <div class="error-message">{{ $errors->first('tenloaisp') }}</div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label">Tình trạng</label>
                                    <select id="inputState" name="trangthai" class="form-control">
                                        <option value="">-- Chọn tình trạng --</option>
                                        <option value="0">Còn hàng</option>
                                        <option value="1">Hết hàng</option>
                                    </select>
                                    <div class="error-message">{{ $errors->first('trangthai') }}</div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-save" type="submit">Lưu lại</button>
                            <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                            <br>
                        </form>
                    </div>
                    <div class="modal-footer"></div>
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
                                    <th>Tên mloại sản phẩm</th>
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
                                        <button class="btn btn-primary btn-sm trash" type="button" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm edit" type="button" title="Sửa">
                                            <i class="fa fa-edit"></i>
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
