@extends('layout.master')

@section('title', 'Thanh Toán')

@section('content')
    <div class="container-fluid mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <img src="img/banner.png" alt="" style="width:100%; height:400px;object-fit: cover;">
        </div>
    </div>

    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <form id="checkoutForm" action="{{ route('xu-li-thanh-toan') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $productDetail->sanpham_id }}">
            <input type="hidden" name="size_id" value="{{ $productDetail->size_id }}">
            <input type="hidden" name="color_id" value="{{ $productDetail->mau_id }}">
            <input type="hidden" name="soluong" value="{{ $quantity }}">

            <div class="row px-xl-5">
                <div class="col-lg-7">
                    <div class="mb-4">
                        <h5 class="font-weight-semi-bold mb-4">Thông tin giao hàng</h5>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Họ tên</label>
                                <input class="form-control" type="text" name="tenkhachhang" placeholder="Họ"
                                    value="{{ $deliveryInfo['tenkhachhang'] ?? '' }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control" type="text" name="sodienthoai" placeholder="+123 456 789"
                                    value="{{ $deliveryInfo['sodienthoai'] ?? '' }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Địa chỉ</label>
                                <input class="form-control" type="text" name="diachi" placeholder="Địa chỉ"
                                    value="{{ $deliveryInfo['diachi'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h5 class="font-weight-semi-bold m-0">Tổng thanh toán</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="carousel">
                                        @foreach ($images as $img)
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="{{ asset('storage/' . $img->tenimage) }}"
                                                    alt="Product Image"
                                                    style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="product-details ml-3">
                                        <div class="mb-2">
                                            <h6 class="font-weight-medium">{{ $productDetail->product->tensanpham }}</h6>
                                        </div>
                                        <div class="mb-2">
                                            <p>Màu: {{ $productDetail->color->tenmau }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <p>Kích thước: {{ $productDetail->size->tensize }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <p>Đơn giá: {{ number_format($discountedPrice) }}đ</p>
                                        </div>
                                        <div class="mb-2">
                                            <p>Số lượng: {{ $quantity }}</p>
                                        </div>
                                        <hr class="my-2">
                                        <div class="mb-1">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="font-weight-normal">Tổng tiền hàng </h6>
                                                <h6 class="font-weight-normal">{{ number_format($subtotal) }}đ</h6>
                                            </div>
                                        </div>
                                        <div class="mb-1">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="font-weight-normal">Phí vận chuyển</h6>
                                                <h6 class="font-weight-normal">{{ number_format($phigiaohang) }}đ</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h6 class="font-weight-bold">Tổng thanh toán</h6>
                                <h5 class="font-weight-bold" style="color:#D19C97">{{ number_format($total) }}đ</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h5 class="font-weight-semi-bold m-0">Phương thức thanh toán</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="momo" name="payment_method"
                                        value="momo">
                                    <label class="custom-control-label" for="momo">Ví điện tử Momo</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="vnpay" name="payment_method"
                                        value="vnpay">
                                    <label class="custom-control-label" for="vnpay">Vnpay</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="cod"
                                        name="payment_method" value="cod">
                                    <label class="custom-control-label" for="cod">Thanh toán khi nhận hàng</label>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer border-secondary bg-transparent">
                            <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Đặt
                                Hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
