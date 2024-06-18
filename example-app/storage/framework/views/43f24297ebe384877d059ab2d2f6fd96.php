<?php $__env->startSection('title', 'Chi Tiết Sản Phẩm'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header Start -->
    <div class="container-fluid mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <img src="img/banner.png" alt="" style="width:100%; height:400px;object-fit: cover;">
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <?php $__currentLoopData = $image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php echo e($index == 0 ? 'active' : ''); ?>">
                                <img class="w-100 h-100" src="<?php echo e(asset($image->path)); ?>" alt="Image">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold"><?php echo e($product->tensanpham); ?></h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <small class="fas fa-star<?php echo e($i < $product->rating ? '' : '-half-alt'); ?>"></small>
                        <?php endfor; ?>
                    </div>
                    <small class="pt-1">(<?php echo e($product->reviews_count); ?> Đánh giá)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">
                    ₫<?php echo e(number_format($product->dongia - ($product->dongia * $product->giamgia) / 100, 0, ',', '.')); ?></h3>
                <p class="mb-4"><?php echo e($product->mota); ?></p>

                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Size</p>
                    <form>
                        <?php $__currentLoopData = $uniqueDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="size-<?php echo e($detail->size_id); ?>"
                                    name="size" value="<?php echo e($detail->size_id); ?>">
                                <label class="custom-control-label"
                                    for="size-<?php echo e($detail->size_id); ?>"><?php echo e($detail->size->tensize); ?></label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </form>
                </div>

                <div class="d-flex mb-4">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Màu sắc</p>
                    <form>
                        <?php $__currentLoopData = $uniqueDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-<?php echo e($detail->color_id); ?>"
                                    name="color" value="<?php echo e($detail->color_id); ?>">
                                <label class="custom-control-label"
                                    for="color-<?php echo e($detail->color_id); ?>"><?php echo e($detail->color->tenmau); ?></label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </form>
                </div>

                <div class="d-flex align-items-center mb-4 pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Số lượng</p>
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-primary px-3 mr-2"><i class="fa fa-shopping-cart mr-1"></i>Thêm Vào Giỏ
                        Hàng</button>
                    <button class="btn btn-primary px-3">Mua Ngay</button>
                </div>

                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Chia sẻ</p>
                    <div class="d-inline-flex">
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
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Mô Tả</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Bình Luận
                        (<?php echo e($product->reviews_count); ?>)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Mô tả sản phẩm</h4>
                        <p><?php echo e($product->mota); ?></p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4"><?php echo e($product->reviews_count); ?> bình luận cho sản phẩm
                                    "<?php echo e($product->ten); ?>"</h4>
                                
                                <div class="col-md-6">
                                    <h4 class="mb-4">Bình luận</h4>
                                    <small>Địa chỉ email của bạn sẽ được bảo mật. Các trường bắt buộc được đánh dấu
                                        *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Đánh giá sao * :</p>
                                        <div class="text-primary">
                                            <!-- Example of a star rating input -->
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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\DATN\example-app\resources\views/user/detail.blade.php ENDPATH**/ ?>