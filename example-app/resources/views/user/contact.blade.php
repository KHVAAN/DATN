@extends('layout.master')

@section('title', 'Liên Hệ')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid  mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <img src="img/all.png" alt="" style="width:100%; height:400px;object-fit: cover;">
        </div>
    </div>
    <!-- Page Header End -->
    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Liên Hệ</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" placeholder="Tên"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" placeholder="Email"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject" placeholder="Vấn đề"
                                required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="6" id="message" placeholder="Lời nhắn"
                                required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <h5 class="font-weight-semi-bold mb-3">Hãy liên hệ với chúng tôi</h5>
                <p>Đừng ngần ngại liên hệ với chúng tôi nếu bạn cần bất kỳ sự trợ giúp nào. Chúng tôi luôn ở đây để lắng nghe và hỗ trợ bạn!</p>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-semi-bold mb-3">Cửa hàng 1</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Địa chỉ 1</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>Email 1</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>SĐT 1</p>
                </div>
                <div class="d-flex flex-column">
                    <h5 class="font-weight-semi-bold mb-3">Cửa hàng 2</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Địa chỉ 2</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>Email 1</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>SĐT 2</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
