@extends('layout.master_ad')

@section('title', 'Thông tin sản phẩm | Quản trị viên')

@section('content')
    <style>
        .Choicefile {
            display: block;
            background: #14142B;
            border: 1px solid #fff;
            color: #fff;
            width: 150px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            padding: 5px 0px;
            border-radius: 5px;
            font-weight: 500;
            align-items: center;
            justify-content: center;
        }

        .Choicefile:hover {
            text-decoration: none;
            color: white;
        }

        #uploadfile,
        .removeimg {
            display: none;
        }

        #thumbbox {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .removeimg {
            height: 25px;
            position: absolute;
            background-repeat: no-repeat;
            top: 5px;
            left: 5px;
            background-size: 25px;
            width: 25px;
            /* border: 3px solid red; */
            border-radius: 50%;

        }

        .removeimg::before {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            content: '';
            border: 1px solid red;
            background: red;
            text-align: center;
            display: block;
            margin-top: 11px;
            transform: rotate(45deg);
        }

        .removeimg::after {
            /* color: #FFF; */
            /* background-color: #DC403B; */
            content: '';
            background: red;
            border: 1px solid red;
            text-align: center;
            display: block;
            transform: rotate(-45deg);
            margin-top: -2px;
        }
    </style>
    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/quan-li-san-pham') }}">Danh sách sản phẩm</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/chi-tiet-san-pham', ['id' => $product->id]) }}">Thông tin sản
                        phẩm</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Thông tin sản phẩm</h3>
                    <div class="tile-body">
                        <form class="row" action="{{ route('chi-tiet-san-pham', ['id' => $product->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="control-label">Mã sản phẩm </label>
                                    <input class="form-control" type="text" value="{{ $product->id }}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Tên sản phẩm</label>
                                    <input type="text" name="tensanpham" class="form-control"
                                        value="{{ $product->tensanpham }}">
                                    <div class="error-message">{{ $errors->first('tensanpham') }}</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Số lượng</label>
                                    <input class="form-control" type="number" name="soluong"
                                        value="{{ $product->soluong }}">
                                    <div class="error-message">{{ $errors->first('soluong') }}</div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleSelect1" class="control-label">Tình trạng sản phẩm</label>
                                    <select class="form-control" name="trangthai" id="exampleSelect1"
                                        value="{{ $product->trangthai }}">
                                        <option>Còn hàng</option>
                                        <option>Hết hàng</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Giá bán</label>
                                    <input class="form-control" type="text" value="{{ $product->dongia }}">
                                </div>
                                <div class="form-group col-md-4">
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
                                <div class="form-group col-md-4">
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
                                <div class="form-group col-md-8">
                                    <label class="control-label">Mô tả sản phẩm</label>
                                    <textarea class="form-control" name="mota" id="mota">{{ $product->mota }}</textarea>
                                    <div class="error-message">{{ $errors->first('mota') }}</div>
                                    <script>
                                        CKEDITOR.replace('mota');
                                    </script>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Ảnh sản phẩm</label>
                                <div id="thumbbox">
                                    @foreach ($image as $item)
                                        <div class="form-group col-md-6">
                                            <img src="{{ asset($item->tenimage) }}" alt="Product Image" class="img-fluid"
                                                style="height: 100px;">
                                        </div>
                                    @endforeach
                                    <a class="removeimg" href="javascript:"></a>
                                </div>

                                <div id="boxchoice">
                                    <a href="javascript:" class="Choicefile"><i class="fas fa-cloud-upload-alt"></i> Chọn
                                        ảnh</a>
                                    <p style="clear:both"></p>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                {{-- <button class="btn btn-save" type="submit">Lưu lại</button> --}}
                                <a class="btn btn-cancel" href="#">Hủy bỏ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
