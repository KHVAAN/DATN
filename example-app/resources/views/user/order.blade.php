@extends('layout.master')

@section('title', 'Đơn Hàng')

@section('content')
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
                                    <label class="form-check-label" for="checkAll"></label>
                                </div>
                            </th>
                            <th class="text-left">Sản Phẩm</th>
                            <th>Đơn Giá</th>
                            <th>Số lượng</th>
                            <th>Số tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($giohang as $item)
                            <tr>
                                <td class="align-middle" width="80">
                                    <input type="checkbox" class="product-checkbox"
                                        data-price="{{ $item->dongia * $item->soluong }}">
                                </td>
                                <td class="align-middle text-left">
                                    <div class="d-flex align-items-center">
                                        <div id="carouselExample{{ $item->id }}" class="carousel slide mr-3"
                                            data-ride="carousel" style="width: 80px; height: 80px;">
                                            <div class="carousel-inner">
                                                @php
                                                    $hasImage = false;
                                                @endphp
                                                @foreach ($images as $img)
                                                    @if ($img->sp_id == $item->productDetail->id && !$hasImage)
                                                        <div class="carousel-item active">
                                                            <img class="d-block w-100"
                                                                src="{{ asset('storage/' . $img->tenimage) }}"
                                                                alt="Product Image"
                                                                style="width: 80px; height: 80px; object-fit: contain;">
                                                        </div>
                                                        @php
                                                            $hasImage = true;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @if (!$hasImage)
                                                    <div class="carousel-item active">
                                                        <img class="d-block w-100"
                                                            src="{{ asset('img/default-image.jpg') }}" alt="Default Image"
                                                            style="width: 80px; height: 80px; object-fit: contain;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <p class="mb-0">{{ $item->productDetail->product->tensanpham }}</p>
                                            <p class="mb-0">
                                                <span class="product-attribute" style="font-size: smaller;">Màu: <span
                                                        class="color"
                                                        style="color: #333;">{{ $item->productDetail->color->tenmau }}</span></span>,
                                                <span class="product-attribute" style="font-size: smaller;">Kích thước:
                                                    <span class="size"
                                                        style="color: #333;">{{ $item->productDetail->size->tensize }}</span></span>
                                            </p>
                                            <span
                                                style="color:#D19C97; font-size: smaller; border: 1px solid #D19C97; padding: 3px;">Đổi
                                                ý miễn phí 15 ngày</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" width="250">
                                    @php
                                        $originalPrice = $item->product->dongia;
                                        $discountedPrice = $item->dongia;
                                    @endphp

                                    <del style="font-size: 14px;margin-right: 5px;">
                                        {{ number_format($originalPrice, 0, ',', ',') }}₫
                                    </del>
                                    {{ number_format($discountedPrice, 0, ',', ',') }}₫
                                </td>
                                <td class="align-middle" style="text-align: center;">
                                    <form id="updateQuantityForm-{{ $item->id }}"
                                        action="{{ route('cap-nhat-so-luong', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        <div class="input-group quantity mx-auto" style="width: 130px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary btn-minus" type="button"
                                                    data-id="{{ $item->id }}" data-price="{{ $item->dongia }}">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text"
                                                class="form-control bg-secondary text-center input-quantity" name="soluong"
                                                value="{{ $item->soluong }}" data-id="{{ $item->id }}"
                                                data-price="{{ $item->dongia }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary btn-plus" type="button"
                                                    data-id="{{ $item->id }}" data-price="{{ $item->dongia }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td class="align-middle total-price-{{ $item->id }}" style="color: #D19C97;"
                                    width="200">
                                    {{ number_format($item->dongia * $item->soluong, 0, ',', ',') }}₫
                                </td>
                                <td class="align-middle" width="200">
                                    <form id="deleteForm-{{ $item->id }}"
                                        action="{{ url('/xoa-gio-hang', ['id' => $item->id]) }}" method="POST">
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
                checkbox.addEventListener('change', updateTotalPrice);
            });

            // Xử lý sự kiện khi nhấn nút tăng số lượng
            document.querySelectorAll('.btn-plus').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentNode.parentNode.querySelector('.input-quantity');
                    const newQuantity = parseInt(input.value) + 1;
                    updateCartItemQuantity(input, newQuantity);
                });
            });

            // Xử lý sự kiện khi nhấn nút giảm số lượng
            document.querySelectorAll('.btn-minus').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentNode.parentNode.querySelector('.input-quantity');
                    const newQuantity = Math.max(1, parseInt(input.value) - 1);
                    updateCartItemQuantity(input, newQuantity);
                });
            });

            // Xử lý sự kiện khi thay đổi số lượng trực tiếp
            document.querySelectorAll('.input-quantity').forEach(input => {
                input.addEventListener('change', function() {
                    const newQuantity = Math.max(1, parseInt(this.value));
                    updateCartItemQuantity(this, newQuantity);
                });
            });

            // Hàm cập nhật số lượng sản phẩm trong giỏ hàng
            function updateCartItemQuantity(input, newQuantity) {
                const id = input.getAttribute('data-id');
                const price = parseFloat(input.getAttribute('data-price'));

                // Cập nhật số lượng trong ô input
                input.value = newQuantity;

                // Gửi yêu cầu AJAX để cập nhật số lượng trên server
                fetch(`{{ url('update-cart') }}/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            soluong: newQuantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Cập nhật giá tiền của sản phẩm
                            const totalPriceElement = document.querySelector(`.total-price-${id}`);
                            totalPriceElement.textContent = `${(newQuantity * price).toLocaleString()}₫`;
                            updateTotalPrice();
                        } else {
                            alert('Có lỗi xảy ra khi cập nhật số lượng sản phẩm.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi cập nhật số lượng sản phẩm.');
                    });
            }

            // Hàm cập nhật tổng giá tiền
            function updateTotalPrice() {
                let totalPrice = 0;
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const price = parseFloat(checkbox.getAttribute('data-price'));
                        totalPrice += price;
                    }
                });
                totalPriceElement.textContent = `${totalPrice.toLocaleString()}₫`;
            }
        });
    </script>
@endsection
