@extends('layout.master_ad')

@section('title', 'Sửa sản phẩm | Quản trị viên')

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
                <li class="breadcrumb-item"><a href="{{ url('/chinh-sua-san-pham' . $product->id) }}">Chỉnh sửa sản phẩm</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Chỉnh sửa sản phẩm</h3>
                    <div class="tile-body">
                        <form class="row" action="{{ route('cap-nhat-san-pham', ['id' => $product->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- <div class="form-group col-md-3">
                                <label class="control-label">Mã sản phẩm </label>
                                <input class="form-control" type="text" name="masanpham"
                                    value="{{ $product->masanpham }}" placeholder="Mã sản phẩm">
                            </div> --}}
                            <div class="form-group col-md-3">
                                <label class="control-label">Tên sản phẩm</label>
                                <input type="text" name="tensanpham" class="form-control"
                                    value="{{ $product->tensanpham }}" placeholder="Tên sản phẩm">
                                <div class="error-message">{{ $errors->first('tensanpham') }}</div>
                            </div>
                            <div class="form-group  col-md-3">
                                <label class="control-label">Số lượng</label>
                                <input class="form-control" type="number" name="soluong" value="{{ $product->soluong }}"
                                    placeholder="Số lượng">
                                <div class="error-message">{{ $errors->first('soluong') }}</div>
                            </div>
                            <div class="form-group col-md-3 ">
                                <label for="exampleSelect1" class="control-label">Tình trạng</label>
                                <select id="inputState" name="trangthai" class="form-control">
                                    <option value="0" {{ $product->trangthai == 0 ? 'selected' : '' }}>Còn hàng
                                    </option>
                                    <option value="1" {{ $product->trangthai == 1 ? 'selected' : '' }}>Hết hàng
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleSelect1" class="control-label">Danh mục</label>
                                <select class="form-control" id="exampleSelect1" name="loaisp_id">
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $product->loaisp_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->tenloaisp }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 ">
                                <label for="exampleSelect1" class="control-label">Nhãn hiệu</label>
                                <select class="form-control" id="exampleSelect1" name="nhanhieu_id">
                                    @foreach ($brand as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $product->nhanhieu_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->tennhanhieu }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Giá bán</label>
                                <input type="number" name="dongia" class="form-control" value="{{ $product->dongia }}"
                                    placeholder="Đơn giá">
                                <div class="error-message">{{ $errors->first('dongia') }}</div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Giảm giá</label>
                                <input type="number" name="giamgia" class="form-control" value="{{ $product->giamgia }}"
                                    placeholder="Giảm giá">
                                <div class="error-message">{{ $errors->first('giamgia') }}</div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Ảnh sản phẩm</label>
                                <div id="myfileupload">
                                    <input type="file" id="uploadfile" name="image[]" onchange="readURL(this);"
                                        multiple />
                                </div>
                                <div id="thumbbox">
                                    <!-- Hiển thị ảnh hiện tại -->
                                    @if ($product->image && $product->image->count() > 0)
                                        @foreach ($product->image as $image)
                                            <img src="{{ asset($image->tenimage) }}" height="200" width="150"
                                                alt="Thumb image" />
                                        @endforeach
                                    @else
                                        <p>Không tìm thấy hình ảnh sản phẩm.</p>
                                    @endif
                                    <!-- Hiển thị ảnh mới chọn -->
                                    <img id="thumbimage" src="" height="450" width="400" style="display:none;"
                                        alt="Thumb image" />
                                    <a class="removeimg" href="javascript:void(0);" onclick="removeImage();">X</a>
                                </div>
                                <div id="boxchoice">
                                    <a href="javascript:" class="Choicefile"><i class="fas fa-cloud-upload-alt"></i> Chọn
                                        ảnh</a>
                                    <p style="clear:both"></p>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">Mô tả sản phẩm</label>
                                <textarea class="form-control" name="mota" id="mota">{{ $product->mota }}</textarea>
                                <div class="error-message">{{ $errors->first('mota') }}</div>
                                <script>
                                    CKEDITOR.replace('mota');
                                </script>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-save" type="submit">Cập nhật</button>
                                <a class="btn btn-cancel" href="{{ url('/quan-li-san-pham') }}">Hủy bỏ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Hàm này được gọi khi người dùng chọn một file ảnh
        function readURL(input) {
            // Kiểm tra nếu có file nào được chọn từ input
            if (input.files && input.files[0]) {
                // Tạo một đối tượng FileReader để đọc nội dung file
                var reader = new FileReader();

                // Khi FileReader hoàn thành việc đọc file
                reader.onload = function(e) {
                    // Gán nội dung file (ảnh) vào thuộc tính 'src' của thẻ img có id là 'thumbimage'
                    $('#thumbimage').attr('src', e.target.result);
                    // Làm cho ảnh này hiển thị
                    $('#thumbimage').show();
                };

                // Đọc nội dung file và chuyển nó thành một URL base64 mà trình duyệt có thể hiển thị
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Hàm này được gọi khi người dùng muốn xóa ảnh đã chọn
        function removeImage() {
            // Đặt lại thuộc tính 'src' của thẻ img có id là 'thumbimage' thành chuỗi rỗng và ẩn ảnh này đi
            $('#thumbimage').attr('src', '').hide();
            // Xóa giá trị của input file để cho phép chọn lại ảnh mới
            $('#uploadfile').val('');
        }
    </script>

@endsection
