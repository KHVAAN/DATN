@extends('layout.master')

@section('title', 'Giỏ Hàng')

@section('content')
    <style>
        /* Đảm bảo không có CSS tùy chỉnh ghi đè */
        td.text-center {
            text-align: center !important;
        }

        td.align-middle {
            vertical-align: middle !important;
        }
    </style>
    <!-- Page Header Start -->
    <div class="container-fluid mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <img src="img/banner.png" alt="" style="width:100%; height:400px;object-fit: cover;">
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th width="10">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                    <label class="form-check-label" for="checkAll">

                                    </label>
                                </div>
                            </th>
                            <th>Ảnh</th>
                            <th>Sản Phẩm</th>
                            <th>Màu sắc</th>
                            <th>Kích thước</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            {{-- <th>Tổng</th> --}}
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($giohang as $item)
                            <tr>
                                <td class="align-middle" width="10">
                                    <input type="checkbox" class="product-checkbox"
                                        data-price="{{ $item->dongia * $item->soluong }}">
                                </td>
                                <td class="align-middle">
                                    <div id="carouselExample{{ $item->id }}" class="carousel slide"
                                        data-ride="carousel">
                                        <div class="carousel-inner">
                                            @php
                                                $hasImage = false; // Biến kiểm tra xem đã có hình ảnh cho sản phẩm này chưa
                                            @endphp
                                            @foreach ($images as $img)
                                                @if ($img->sp_id == $item->productDetail->id && !$hasImage)
                                                    <div class="carousel-item active">
                                                        <img class="d-block w-100"
                                                            src="{{ asset('storage/' . $img->tenimage) }}"
                                                            alt="Product Image"
                                                            style="width: 50px; height: 100px; object-fit: contain;">
                                                    </div>
                                                    @php
                                                        $hasImage = true; // Đánh dấu là đã có hình ảnh cho sản phẩm này
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if (!$hasImage)
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="{{ asset('img/default-image.jpg') }}"
                                                        alt="Default Image"
                                                        style="width: 50px; height: 50px; object-fit: contain;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="align-middle">
                                    {{ $item->productDetail->product->tensanpham }}
                                </td>
                                <td class="align-middle">
                                    {{ $item->productDetail->color->tenmau }}
                                </td>
                                <td class="align-middle">
                                    {{ $item->productDetail->size->tensize }}
                                </td>
                                <td class="align-middle">{{ number_format($item->dongia, 0, ',', '.') }}đ</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mr-3" style="width: 130px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control bg-secondary text-center" name="quantity"
                                            value="{{ $item->soluong }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>

                                {{-- <td class="align-middle">
                                    {{ number_format($item->dongia * $item->soluong, 0, ',', '.') }} đ
                                </td> --}}
                                <td class="align-middle">
                                    <form action="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Mã giảm giá">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Áp dụng mã</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Giỏ hàng</h4>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng thanh toán</h5>
                            <h5 class="font-weight-bold" id="total-price">0 đ</h5>
                        </div>
                        <a href="" class="btn btn-block btn-primary my-3 py-3">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const checkboxes = document.querySelectorAll('.product-checkbox');
            const totalPriceElement = document.getElementById('total-price');
            const checkAll = document.getElementById('checkAll');

            // Xử lý sự kiện khi checkbox "Chọn tất cả" thay đổi
            checkAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = checkAll.checked;
                });
                updateTotalPrice();
            });

            // Xử lý sự kiện khi một checkbox sản phẩm thay đổi
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (!this.checked) {
                        checkAll.checked = false;
                    } else {
                        checkAll.checked = [...checkboxes].every(checkbox => checkbox.checked);
                    }
                    updateTotalPrice();
                });
            });

            // Hàm cập nhật tổng số tiền
            function updateTotalPrice() {
                let total = 0;
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        total += parseFloat(checkbox.getAttribute('data-price'));
                    }
                });
                totalPriceElement.textContent = total > 0 ? total.toLocaleString('vi-VN') + ' đ' : '0 đ';
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Xử lý khi nhấn nút +
            $('.btn-plus').click(function(e) {
                e.preventDefault();
                var quantityInput = $(this).closest('.input-group').find('.input-quantity');
                var currentValue = parseInt(quantityInput.val());
                if (!isNaN(currentValue)) {
                    quantityInput.val(currentValue + 1);
                    updateQuantity();
                }
            });

            // Xử lý khi nhấn nút -
            $('.btn-minus').click(function(e) {
                e.preventDefault();
                var quantityInput = $(this).closest('.input-group').find('.input-quantity');
                var currentValue = parseInt(quantityInput.val());
                if (!isNaN(currentValue) && currentValue > 1) {
                    quantityInput.val(currentValue - 1);
                    updateQuantity();
                }
            });

            // Xử lý khi người dùng nhập số lượng trực tiếp
            $('.input-quantity').change(function() {
                updateQuantity();
            });


        });
    </script>

@endsection
