<?php $__env->startSection('title', 'Trang Chủ'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .product-img img {
            width: 100%;
            height: 400px;
            /* Chiều cao cố định cho hình ảnh */
            object-fit: cover;
            /* Đảm bảo hình ảnh được cắt đúng kích thước mà không bị méo */
        }
    </style>
    <!-- Slideshow Start-->
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 410px;">
                <img class="img-fluid" src="img/carousel-1.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order
                        </h4>
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                        <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="height: 410px;">
                <img class="img-fluid" src="img/carousel-2.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order
                        </h4>
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                        <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
    <!-- Slideshow End-->

    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Sản Phẩm Chất Lượng</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Miễn Phí Vận Chuyển</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Hoàn Trong 14 Ngày</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Hỗ Trợ 24/7</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    
    <!-- Categories End -->


    <!-- Offer Start -->
    <div class="container-fluid offer pt-5">
        <div class="row px-xl-5">
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                    <img src="img/offer-1.png" alt="">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">Giảm giá 20% cho tất cả đơn hàng</h5>
                        <h1 class="mb-4 font-weight-semi-bold">BTS Mùa Xuân</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Mua ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                    <img src="img/offer-2.png" alt="">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">Giảm giá 20% cho tất cả đơn hàng</h5>
                        <h1 class="mb-4 font-weight-semi-bold">BTS Mùa Đông</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->

    <!-- Sản phẩm phân theo brand start -->
    <div class="container-fluid pt-5">
        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2"><?php echo e($brand->tennhanhieu); ?></span></h2>
            </div>
            <div class="row px-xl-5 pb-3">
                <?php
                    $brand_products = $products->where('nh_id', $brand->id);
                ?>
                <?php if($brand_products->count() > 0): ?>
                    <?php $__currentLoopData = $brand_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $firstImage = $item->image->first();
                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <?php if($firstImage): ?>
                                    <div
                                        class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid w-100" src="<?php echo e(asset('storage/' . $firstImage->tenimage)); ?>"
                                            alt="<?php echo e($item->tensanpham); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">
                                        <a href="<?php echo e(url('/detail', ['id' => $item->id])); ?>"><?php echo e($item->tensanpham); ?></a>
                                    </h6>
                                    <div class="d-flex justify-content-center">
                                        <h6><?php echo e(number_format($item->dongia * (1 - $item->giamgia / 100))); ?> ₫</h6>
                                        <?php if($item->giamgia > 0): ?>
                                            <h6 class="text-muted ml-2">
                                                <del><?php echo e(number_format($item->dongia)); ?> ₫</del>
                                            </h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="<?php echo e(url('/detail', ['id' => $item->id])); ?>"
                                        class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem
                                        Chi Tiết</a>
                                    <form action="<?php echo e(url('/them-gio-hang')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="product_id" value="<?php echo e($item->id); ?>">
                                        <button type="submit" class="btn btn-sm text-dark p-0"><i
                                                class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Vào Giỏ
                                            Hàng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p>Không tìm thấy sản phẩm cho nhãn hiệu <?php echo e($brand->tennhanhieu); ?>.</p>
                <?php endif; ?>
                
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Sản phẩm phân theo brand end -->



    <!-- Subscribe Start -->
    <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Cập Nhật Liên
                            Tục</span>
                    </h2>
                    <p>"Chúng tôi liên tục cập nhật sản phẩm mới để đem đến trải nghiệm mua sắm đa dạng và thú
                        vị
                        cho quý
                        khách hàng."</p>
                </div>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-white p-4" placeholder="Email...">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Subscribe End -->


    <!-- Sản Phẩm mới start-->

    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sản Phẩm Mới</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <?php
                                $firstImage = $product->image->first(); // Giả sử $product có mối quan hệ 'image'
                            ?>
                            <?php if($firstImage): ?>
                                <img class="img-fluid" src="<?php echo e(asset('storage/' . $firstImage->tenimage)); ?>"
                                    alt="<?php echo e($product->tensanpham); ?>">
                            <?php else: ?>
                                <img class="img-fluid" src="<?php echo e(asset('storage/default.jpg')); ?>"
                                    alt="<?php echo e($product->tensanpham); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <!-- Hiển thị tên sản phẩm -->
                            <h6 class="text-truncate mb-3">
                                <a href="<?php echo e(url('/detail', ['id' => $item->id])); ?>"><?php echo e($item->tensanpham); ?></a>
                            </h6>
                            <div class="d-flex justify-content-center">
                                <!-- Hiển thị giá bán -->
                                <?php
                                    $finalPrice = $product->dongia * (1 - $product->giamgia / 100);
                                ?>
                                <h6><?php echo e(number_format($finalPrice)); ?> ₫</h6>
                                <!-- Hiển thị giá gốc (nếu có giảm giá) -->
                                <?php if($product->giamgia > 0): ?>
                                    <h6 class="text-muted ml-2">
                                        <del><?php echo e(number_format($product->dongia)); ?> ₫</del>
                                    </h6>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="<?php echo e(url('/detail', ['id' => $item->id])); ?>" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-eye text-primary mr-1"></i>Xem
                                Chi Tiết</a>
                            <form action="<?php echo e(url('/them-gio-hang')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="product_id" value="<?php echo e($item->id); ?>">
                                <button type="submit" class="btn btn-sm text-dark p-0"><i
                                        class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Vào Giỏ
                                    Hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>


    <!-- Sản phẩm mới end -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="vendor-item border p-4">
                        <img src="img/1.png" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/2.png" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/3.png" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/4.png" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Xử lý khi nhấn nút Trước
            $('.prev-btn').click(function() {
                var target = $($(this).data('target')).find('.product-slide.active');
                var prev = target.prev();
                if (prev.length === 0) {
                    prev = target.siblings().last();
                }
                target.removeClass('active');
                prev.addClass('active');
            });

            // Xử lý khi nhấn nút Tiếp
            $('.next-btn').click(function() {
                var target = $($(this).data('target')).find('.product-slide.active');
                var next = target.next();
                if (next.length === 0) {
                    next = target.siblings().first();
                }
                target.removeClass('active');
                next.addClass('active');
            });
        });
    </script>
    <!-- Vendor End -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\DATN\example-app\resources\views/user/index.blade.php ENDPATH**/ ?>