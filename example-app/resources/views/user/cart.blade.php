@extends('layout.master')

@section('title', 'Giỏ Hàng')

@section('content')
    <style>
        .custom-back-button {
            background-color: #D19C97;
            border-color: #D19C97;
        }

        .custom-white-button {
            background-color: #e3dede;
            border-color: #e3dede;
        }

        .custom-back-button:hover {
            background-color: #D19C97;
            border-color: #D19C97;
        }

        #temporary-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            /* Đảm bảo rằng thông báo luôn hiển thị trên các phần tử khác */
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
            <div id="temporary-alert" class="alert alert-warning" role="alert" style="display: none;">
                Vui lòng chọn sản phẩm!
            </div>
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
                                    <input type="checkbox" class="product-checkbox" data-price="{{ $item->dongia }}">

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
                                        action="{{ route('xoa-gio-hang', ['id' => $item->id]) }}" method="POST">
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
            <div class="col-lg-12">
                <div class="card border-secondary mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Phần chọn tất cả (10) và nút Xóa nằm ngang nhau -->
                                <div class="d-flex align-items-center mt-3">
                                    <div class="form-check mr-3">
                                        <input class="form-check-input" type="checkbox" value="" id="select-all">
                                        <label class="form-check-label" for="select-all">
                                            Chọn tất cả (10)
                                        </label>
                                    </div>
                                    <!-- Nút Xóa và modal -->
                                    {{-- <button type="button" class="btn btn-sm btn-primary delete-button"
                                        data-id="{{ $item->id }}" data-toggle="modal"
                                        data-target="#confirmDeleteModal">
                                        Xóa
                                    </button> --}}
                                </div>
                            </div>

                            <!-- Modal -->
                            {{-- <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
                                aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body" id="modal-body">
                                            Bạn có muốn xóa sản phẩm?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary custom-back-button"
                                                data-dismiss="modal">Trở lại</button>
                                            <button type="button" class="btn btn-secondary custom-white-button"
                                                id="confirmDelete">Có</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-lg-4">
                                <!-- Form mã giảm giá -->
                                <form class="mb-3 text-right" action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control p-4" placeholder="Mã giảm giá">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary">Áp dụng mã</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-between mt-4">
                                    <h6 class="font-weight-bold" id="total-summary">Tổng thanh toán (0 sản phẩm): </h6>
                                    <h5 class="font-weight-bold" id="total-price">0₫</h5>
                                </div>
                                <!-- Form Mua Ngay -->
                                <form action="" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-block btn-primary mt-3 py-3"
                                        id="checkoutButton">Mua ngay</button>
                                </form>

                            </div>
                        </div>
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
            const totalSummaryElement = document.getElementById('total-summary');
            const checkAll = document.getElementById('select-all');
            const checkoutButton = document.getElementById('checkoutButton');

            // Xử lý sự kiện khi checkbox "Chọn tất cả" thay đổi
            checkAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = checkAll.checked;
                });
                updateTotalPrice();
            });

            // Xử lý sự kiện khi checkbox sản phẩm thay đổi
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateTotalPrice();
                });
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
                const price = parseInt(input.getAttribute('data-price')); // Sử dụng giá đã giảm

                // Cập nhật số lượng trong ô input
                input.value = newQuantity;

                // Cập nhật giá tiền của sản phẩm
                const totalPriceElement = document.querySelector(`.total-price-${id}`);
                totalPriceElement.textContent = `${(newQuantity * price).toLocaleString()}₫`;

                // Cập nhật tổng giá tiền sau khi thay đổi số lượng
                updateTotalPrice();

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
                        if (!data.success) {
                            alert('Có lỗi xảy ra khi cập nhật số lượng sản phẩm.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi cập nhật số lượng sản phẩm.');
                    });
            }

            // Hàm cập nhật tổng giá tiền và số lượng sản phẩm đã chọn

            function updateTotalPrice() {
                let totalPrice = 0;
                let totalItems = 0;
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        // Lấy giá sản phẩm từ thuộc tính data-price của checkbox
                        const price = parseInt(checkbox.getAttribute('data-price'));

                        // Lấy giá trị số lượng từ ô input liền kề checkbox
                        const quantity = parseInt(checkbox.parentNode.parentNode.querySelector(
                            '.input-quantity').value);

                        // Tính tổng giá tiền bằng cách nhân giá với số lượng
                        totalPrice += price * quantity;

                        // Đếm số lượng sản phẩm đã chọn
                        totalItems++;
                    }
                });
                // Hiển thị tổng giá tiền và số lượng sản phẩm đã chọn
                totalPriceElement.textContent = `${totalPrice.toLocaleString()}₫`;
                totalSummaryElement.textContent = `Tổng thanh toán (${totalItems} sản phẩm): `;
            }

            // Xử lý sự kiện khi nhấn nút "Mua ngay"
            checkoutButton.addEventListener('click', function(event) {
                let selectedItems = 0;
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        selectedItems++;
                    }
                });
                if (selectedItems === 0) {
                    event.preventDefault();
                    alert('Vui lòng chọn ít nhất một sản phẩm để mua.');
                } else {
                    // Gửi thông tin sản phẩm được chọn tới server
                    const selectedProducts = [];
                    checkboxes.forEach(checkbox => {
                        if (checkbox.checked) {
                            selectedProducts.push({
                                product_id: checkbox.getAttribute('data-product-id'),
                                size_id: checkbox.getAttribute('data-size-id'),
                                mau_id: checkbox.getAttribute('data-color-id'),
                                soluong: checkbox.parentNode.parentNode.querySelector(
                                    '.input-quantity').value
                            });
                        }
                    });
                    // Tạo các input hidden và append vào form
                    const form = document.getElementById('buyForm');
                    selectedProducts.forEach(product => {
                        form.appendChild(createHiddenInput('product_id[]', product.product_id));
                        form.appendChild(createHiddenInput('size_id[]', product.size_id));
                        form.appendChild(createHiddenInput('mau_id[]', product.mau_id));
                        form.appendChild(createHiddenInput('soluong[]', product.soluong));
                    });
                    form.submit();
                }
            });

            // Hàm tạo input hidden
            function createHiddenInput(name, value) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                return input;
            }
        });
    </script>
    {{-- delete modal --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButton = document.querySelector('.delete-button');
            const confirmDelete = document.getElementById('confirmDelete');
            const checkboxes = document.querySelectorAll('.product-checkbox');
            let selectedProducts = [];

            deleteButton.addEventListener('click', function() {
                selectedProducts = [];
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        selectedProducts.push(checkbox.getAttribute('data-id'));
                    }
                });

                if (selectedProducts.length === 0) {
                    alert('Vui lòng chọn ít nhất một sản phẩm để xóa.');
                } else {
                    $('#confirmDeleteModal').modal('show');
                }
            });

            confirmDelete.addEventListener('click', function() {
                if (selectedProducts.length > 0) {
                    selectedProducts.forEach(productId => {
                        const form = document.getElementById(`deleteForm-${productId}`);
                        console.log('Submitting form for product ID:', productId);
                        form.submit();
                    });
                } else {
                    console.log('No products selected.');
                }
            });
        });
    </script> --}}



@endsection
