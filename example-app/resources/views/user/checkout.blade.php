@extends('layout.master')

@section('title', 'Thanh Toán')

@section('content')
    <div class="container-fluid  mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <img src="img/banner.png" alt="" style="width:100%; height:400px;object-fit: cover;">
        </div>
    </div>
    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Thông tin giao hàng</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="ho">Họ</label>
                            <input id="ho" name="ho" class="form-control" type="text" placeholder="Họ">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="ten">Tên</label>
                            <input id="ten" name="ten" class="form-control" type="text" placeholder="Tên">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="email">E-mail</label>
                            <input id="email" name="email" class="form-control" type="text" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="phone">Số điện thoại</label>
                            <input id="phone" name="phone" class="form-control" type="text" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="address">Địa chỉ</label>
                            <input id="address" name="address" class="form-control" type="text" placeholder="Địa chỉ">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="district">Quận/Huyện</label>
                            <select id="district" name="district" class="custom-select">
                                <option selected>United States</option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="city">Thành phố/Tỉnh</label>
                            <input id="city" name="city" class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto" data-toggle="collapse" data-target="#shipping-address">Giao hàng đến địa chỉ khác</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse mb-4" id="shipping-address">
                    <h4 class="font-weight-semi-bold mb-4">Địa chỉ giao hàng khác</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="alt_ho">Họ</label>
                            <input id="alt_ho" name="alt_ho" class="form-control" type="text" placeholder="John">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="alt_ten">Tên</label>
                            <input id="alt_ten" name="alt_ten" class="form-control" type="text" placeholder="Doe">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="alt_email">E-mail</label>
                            <input id="alt_email" name="alt_email" class="form-control" type="text" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="alt_phone">Số điện thoại</label>
                            <input id="alt_phone" name="alt_phone" class="form-control" type="text" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="alt_address">Địa chỉ</label>
                            <input id="alt_address" name="alt_address" class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="alt_district">Quận/Huyện</label>
                            <select id="alt_district" name="alt_district" class="custom-select">
                                <option selected>United States</option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="alt_city">Thành phố/Tỉnh</label>
                            <input id="alt_city" name="alt_city" class="form-control" type="text" placeholder="New York">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Tổng thanh toán</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Sản phẩm</h5>
                        <div class="d-flex justify-content-between">
                            <p>Tên sản phẩm 1</p>
                            <p>Giá đ</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Tên sản phẩm 2</p>
                            <p>Giá đ</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Tên sản phẩm 3</p>
                            <p>Giá đ</p>
                        </div>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Tạm tính</h6>
                            <h6 class="font-weight-medium">Giá đ</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí vận chuyển</h6>
                            <h6 class="font-weight-medium">Giá đ</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng thanh toán</h5>
                            <h5 class="font-weight-bold">Giá đ</h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Phương thức thanh toán</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="paypal">
                                <label class="custom-control-label" for="paypal">Ví điện tử Momo</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="directcheck">
                                <label class="custom-control-label" for="directcheck">Vnpay</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="banktransfer">
                                <label class="custom-control-label" for="banktransfer">Thanh toán khi nhận hàng</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Đặt Hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->
@endsection
