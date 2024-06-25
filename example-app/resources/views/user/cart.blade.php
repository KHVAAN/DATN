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
                                    <div>
                                        <a href="#" data-toggle="modal" data-target="#confirmDeleteModal"
                                            id="deleteButton">
                                            Xóa
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
                                aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">

                                        <div class="modal-body" id="modal-body">
                                            Bạn có muốn bỏ các sản phẩm đã chọn?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary custom-back-button"
                                                data-dismiss="modal">Trở lại</button>
                                            <button type="button"
                                                class="btn btn-secondary custom-white-button">Có</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                <!-- Nút mua ngay -->
                                <a href="{{ route('mua-ngay') }}" class="btn btn-block btn-primary mt-3 py-3">Mua
                                    ngay</a>
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
                            updateTotalPrice(); // Cập nhật tổng giá tiền sau khi cập nhật số lượng
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

            $(document).ready(function() {
                let modalShown = false;

                $(document).on('click', '#deleteButton', function(event) {
                    event.preventDefault();
                    event.stopImmediatePropagation();

                    const checkboxes = document.querySelectorAll('.product-checkbox:checked');
                    const selectedCount = checkboxes.length;

                    if (modalShown) {
                        return;
                    }

                    if (selectedCount === 0) {
                        // Hiển thị thông báo tạm thời nếu không có sản phẩm nào được chọn
                        $('#temporary-alert').fadeIn();
                        setTimeout(function() {
                            $('#temporary-alert').fadeOut();
                        }, 2000);
                    } else {
                        // Hiển thị modal xác nhận nếu có sản phẩm được chọn
                        $('#confirmDeleteModal').modal('show');
                        $('#modal-body').text(`Bạn có muốn bỏ ${selectedCount} sản phẩm đã chọn?`);
                        modalShown = true; // Đánh dấu là đã hiển thị modal
                    }
                });

                $('#confirmDeleteModal .modal-footer .btn-secondary').on('click', function() {
                    $('#confirmDeleteModal').modal('hide');
                    modalShown = false;
                });

                $('#confirmDeleteModal .modal-footer .btn-danger').on('click', function() {
                    // Thực hiện hành động xóa tại đây
                    // Sau khi xử lý xong, đóng modal và đặt lại biến
                    $('#confirmDeleteModal').modal('hide');
                    modalShown = false;
                });
            });

            $(document).ready(function() {
                const checkboxes = document.querySelectorAll('.product-checkbox');
                const totalPriceElement = document.getElementById('total-price');
                const totalSummaryElement = document.getElementById('total-summary');
                const checkAll = document.getElementById('select-all');

                // Xử lý sự kiện khi checkbox "Chọn tất cả" thay đổi
                $('#select-all').change(function() {
                    const isChecked = $(this).prop('checked');

                    checkboxes.forEach(checkbox => {
                        checkbox.checked = isChecked;
                    });

                    // Tính toán và cập nhật tổng giá tiền
                    updateTotalPrice();
                });

                // Xử lý sự kiện khi checkbox sản phẩm thay đổi
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        updateTotalPrice();
                    });
                });

                // Hàm tính toán tổng giá tiền và số lượng sản phẩm đã chọn
                function updateTotalPrice() {
                    let totalPrice = 0;
                    let totalItems = 0;

                    checkboxes.forEach(checkbox => {
                        if (checkbox.checked) {
                            const price = parseFloat(checkbox.getAttribute('data-price'));
                            totalPrice += price;
                            totalItems++;
                        }
                    });

                    // Hiển thị tổng giá tiền và số lượng sản phẩm đã chọn
                    totalPriceElement.textContent = `${totalPrice.toLocaleString()}₫`;
                    totalSummaryElement.textContent = `Tổng thanh toán (${totalItems} sản phẩm): `;
                }
            });
        });
    </script>
@endsection
