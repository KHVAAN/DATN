@extends('layout.master')

@section('title', 'Chi Tiết Sản Phẩm')

@section('content')
    <style>
        .preserve-format {
            white-space: pre-wrap;
        }

        .btn-disabled {
            opacity: 0.5;
            /* Reduce opacity to indicate disabled state */
            pointer-events: none;
            /* Disable pointer events */
        }
    </style>
    <!-- Page Header Start -->
    <div class="container-fluid mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <img src="{{ asset('img/banner.png') }}" alt="" style="width:100%; height:400px;object-fit: cover;">
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($image as $index => $img)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img class="d-block w-100" src="{{ asset('storage/' . $img->tenimage) }}"
                                    alt="Product Image">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $product->tensanpham }}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        @for ($i = 0; $i < 5; $i++)
                            <small class="fas fa-star{{ $i < $product->rating ? '' : '-half-alt' }}"></small>
                        @endfor
                    </div>
                    <small class="pt-1">({{ $product->reviews_count }} Đánh giá)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">
                    {{ number_format($product->dongia - ($product->dongia * $product->giamgia) / 100, 0, ',', '.') }} ₫
                    <del style="font-size: 16px;">
                        {{ number_format($product->dongia, 0, ',', '.') }} ₫
                    </del>
                </h3>
                @if (isset($uniqueDetails))
                    @php
                        $usedSizes = [];
                    @endphp

                    <div class="d-flex mb-4">
                        <p class="text-dark font-weight-medium mb-0 mr-3">Màu sắc</p>
                        <form>
                            @foreach ($uniqueDetails as $detail)
                                @if (!in_array($detail->color->tenmau, $usedSizes))
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="color-{{ $detail->mau_id }}"
                                            name="color" value="{{ $detail->mau_id }}">
                                        <label class="custom-control-label"
                                            for="color-{{ $detail->mau_id }}">{{ $detail->color->tenmau }}</label>
                                    </div>
                                    @php
                                        $usedSizes[] = $detail->color->tenmau;
                                    @endphp
                                @endif
                            @endforeach
                        </form>
                    </div>

                    <div class="d-flex mb-4">
                        <p class="text-dark font-weight-medium mb-0 mr-3">Kích thước</p>
                        <form>
                            @foreach ($uniqueDetails as $detail)
                                @if (!in_array($detail->size->tensize, $usedSizes))
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="size-{{ $detail->size_id }}"
                                            name="size" value="{{ $detail->size_id }}">
                                        <label class="custom-control-label"
                                            for="size-{{ $detail->size_id }}">{{ $detail->size->tensize }}</label>
                                    </div>
                                    @php
                                        $usedSizes[] = $detail->size->tensize;
                                    @endphp
                                @endif
                            @endforeach
                        </form>
                    </div>
                @endif

                <div class="d-flex align-items-center mb-4 pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Số lượng</p>
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" name="quantity" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <span class="ml-2" id="stock-quantity">{{ $product->totalStock }} sản phẩm có sẵn</span>
                </div>

                <div class="d-flex align-items-center mb-4 pt-2">
                    <form action="{{ route('them-gio-hang') }}" method="POST" id="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="size_id" id="selectedSizeId" value="">
                        <input type="hidden" name="mau_id" id="selectedColorId" value="">
                        <input type="hidden" name="soluong" id="selectedQuantity" value="1">
                        <button type="submit" class="btn btn-primary px-3 mr-2" id="btn-add-to-cart">
                            <i class="fa fa-shopping-cart mr-1"></i> Thêm Vào Giỏ Hàng
                        </button>
                    </form>
                    <a href="" class="btn btn-primary px-3">Mua Ngay</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Mô Tả</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Bình Luận
                    ({{ $product->reviews_count }})</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Mô tả sản phẩm</h4>
                    <p class="preserve-format">{{ $product->mota }}</p>
                </div>
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">{{ $product->reviews_count }} bình luận cho sản phẩm
                                "{{ $product->tensanpham }}"</h4>
                            <div class="col-md-6">
                                <h4 class="mb-4">Bình luận</h4>
                                <small>Địa chỉ email của bạn sẽ được bảo mật. Các trường bắt buộc được đánh dấu *</small>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Đánh giá sao * :</p>
                                    <div class="text-primary">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="message">Bình luận *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tên *</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Đăng bài" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Xử lý khi nhấn nút +
            $('.btn-plus').click(function(e) {
                e.preventDefault();
                var quantityInput = $(this).closest('.input-group').find('input[name="quantity"]');
                var currentValue = parseInt(quantityInput.val());
                if (!isNaN(currentValue)) {
                    quantityInput.val(currentValue + 1);
                    updateSelectedQuantity(currentValue + 1);
                }
            });

            // Xử lý khi nhấn nút -
            $('.btn-minus').click(function(e) {
                e.preventDefault();
                var quantityInput = $(this).closest('.input-group').find('input[name="quantity"]');
                var currentValue = parseInt(quantityInput.val());
                if (!isNaN(currentValue) && currentValue > 1) {
                    quantityInput.val(currentValue - 1);
                    updateSelectedQuantity(currentValue - 1);
                }
            });

            // Xử lý khi thay đổi màu sắc
            $('input[name="color"]').change(function() {
                var selectedColor = $(this).val();
                updateSelectedColor(selectedColor);
                updateAddToCartButton();
            });

            // Xử lý khi thay đổi kích thước
            $('input[name="size"]').change(function() {
                var selectedSize = $(this).val();
                updateSelectedSize(selectedSize);
                updateAddToCartButton();
            });

            // Hàm cập nhật size đã chọn
            function updateSelectedSize(sizeId) {
                $('#selectedSizeId').val(sizeId);
            }

            // Hàm cập nhật màu đã chọn
            function updateSelectedColor(colorId) {
                $('#selectedColorId').val(colorId);
            }

            // Hàm cập nhật số lượng đã chọn
            function updateSelectedQuantity(quantity) {
                $('#selectedQuantity').val(quantity);
            }

            // Hàm cập nhật nút Thêm vào Giỏ Hàng và Mua Ngay
            function updateAddToCartButton() {
                var selectedColor = $('input[name="color"]:checked').val();
                var selectedSize = $('input[name="size"]:checked').val();
                if (selectedColor && selectedSize) {
                    // Lọc chi tiết sản phẩm dựa trên màu và kích thước
                    var filteredDetail = @json($uniqueDetails).filter(detail => detail.mau_id ==
                        selectedColor && detail.size_id == selectedSize);
                    if (filteredDetail.length > 0) {
                        // Cập nhật số lượng tồn kho
                        var stockQuantity = filteredDetail[0].soluong;
                        $('#stock-quantity').text(stockQuantity + ' sản phẩm có sẵn').css('color', '');
                        // Enable nút Thêm vào Giỏ Hàng và Mua Ngay và cập nhật dữ liệu
                        $('#btn-add-to-cart').removeClass('btn-disabled').prop('disabled', false);
                        $('a.btn-primary').removeClass('btn-disabled').prop('disabled', false);
                    } else {
                        // Nếu không tìm thấy chi tiết sản phẩm phù hợp
                        $('#stock-quantity').text('Hết hàng').css('color', 'red');
                        // Disable nút Thêm vào Giỏ Hàng và Mua Ngay
                        $('#btn-add-to-cart').addClass('btn-disabled').prop('disabled', true);
                        $('a.btn-primary').addClass('btn-disabled').prop('disabled', true);
                    }
                } else {
                    // Nếu chưa chọn màu sắc hoặc kích thước
                    $('#stock-quantity').text('{{ $product->totalStock }} sản phẩm có sẵn').css('color', '');
                    // Disable nút Thêm vào Giỏ Hàng và Mua Ngay
                    $('#btn-add-to-cart').addClass('btn-disabled').prop('disabled', true);
                    $('a.btn-primary').addClass('btn-disabled').prop('disabled', true);
                }
            }

            // Gọi hàm cập nhật nút khi trang được tải lần đầu
            updateAddToCartButton();
        });
    </script>

@endsection
