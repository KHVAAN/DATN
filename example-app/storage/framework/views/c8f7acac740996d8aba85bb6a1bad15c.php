<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark" href="">FAQs</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Help</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Support</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark px-2" href="">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-dark pl-2" href="">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold border px-3 mr-1">E</span>StyleVista</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge">0</span>
            </a>
            <a href="" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">0</span>
            </a>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Phân loại</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
                id="navbar-vertical" style="width: calc(100% - 30px); z-index: 10;">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    
                    <a href="" class="nav-item nav-link">Áo sơ mi</a>
                    <a href="" class="nav-item nav-link">Áo khoác cổ cao</a>
                    <a href="" class="nav-item nav-link">Áo khoác có nón</a>
                    <a href="" class="nav-item nav-link">Áo thun</a>
                    <a href="" class="nav-item nav-link">Áo hoodie</a>
                    <a href="" class="nav-item nav-link">Áo polo</a>
                    <a href="" class="nav-item nav-link">Áo T-shirt</a>
                    <a href="" class="nav-item nav-link">Quần jeans</a>
                    <a href="" class="nav-item nav-link">Quần short</a>
                    <a href="" class="nav-item nav-link">Quần kaki</a>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">E</span>StyleVista</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="<?php echo e(url('/')); ?>" class="nav-item nav-link">Trang Chủ</a>
                        <a href="<?php echo e(url('/shop')); ?>" class="nav-item nav-link">Tất Cả</a>
                        <a href="<?php echo e(url('/detail')); ?>" class="nav-item nav-link">Sản Phẩm</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Trang</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="<?php echo e(url('/cart')); ?>" class="dropdown-item">Giỏ Hàng</a>
                                <a href="<?php echo e(url('/checkout')); ?>" class="dropdown-item">Thanh Toán</a>
                            </div>
                        </div>
                        <a href="<?php echo e(url('/intro')); ?>" class="nav-item nav-link">Giới Thiệu</a>
                        <a href="<?php echo e(url('/contact')); ?>" class="nav-item nav-link">Liên Hệ</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        <a href="<?php echo e(route('dang-nhap')); ?>" class="nav-item nav-link">Đăng nhập</a>
                        <a href="<?php echo e(url('/register')); ?>" class="nav-item nav-link">Đăng ký</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->
<?php /**PATH D:\DATN\example-app\resources\views/layout/header.blade.php ENDPATH**/ ?>