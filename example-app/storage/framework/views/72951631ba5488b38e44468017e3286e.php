<?php $__env->startSection('title', 'Sản Phẩm'); ?>

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
    <!-- Page Header Start -->
    <div class="container-fluid  mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <img src="<?php echo e(asset('img/all.png')); ?>" alt="" style="width: 100%; height: 400px; object-fit: cover;">
        </div>
    </div>
    <!-- Page Header End -->
    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->


                <!-- Price End -->

                <!-- Color Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Lọc theo màu</h5>
                    <div class="row">
                        <!-- Tông màu nóng -->
                        <div class="col-md-6">
                            <form>
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="custom-control-input" checked id="color-all-hot">
                                    <label class="custom-control-label" for="color-all-hot">Tất cả</label>
                                </div>
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="custom-control-input" id="color-red">
                                    <label class="custom-control-label" for="color-red">Đỏ</label>
                                </div>
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="custom-control-input" id="color-orange">
                                    <label class="custom-control-label" for="color-orange">Cam</label>
                                </div>
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="custom-control-input" id="color-yellow">
                                    <label class="custom-control-label" for="color-yellow">Vàng</label>
                                </div>
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="custom-control-input" id="color-pink">
                                    <label class="custom-control-label" for="color-pink">Hồng</label>
                                </div>
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                                    <input type="checkbox" class="custom-control-input" id="color-brown">
                                    <label class="custom-control-label" for="color-brown">Nâu</label>
                                </div>
                            </form>
                        </div>

                        <!-- Tông màu lạnh -->
                        <div class="col-md-6">
                            <form>
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="custom-control-input" checked id="color-all-cold">
                                </div>
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="custom-control-input" id="color-blue">
                                    <label class="custom-control-label" for="color-blue">Xanh dương</label>
                                </div>
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="custom-control-input" id="color-green">
                                    <label class="custom-control-label" for="color-green">Xanh lá cây</label>
                                </div>
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="custom-control-input" id="color-navy">
                                    <label class="custom-control-label" for="color-navy">Xanh navy</label>
                                </div>
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="custom-control-input" id="color-purple">
                                    <label class="custom-control-label" for="color-purple">Tím</label>
                                </div>
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                                    <input type="checkbox" class="custom-control-input" id="color-gray">
                                    <label class="custom-control-label" for="color-gray">Xám</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Color End -->

                <!-- Size Start -->
                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Lọc theo kích thước</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">Tất cả</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                        </div>
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="<?php echo e(route('tim-kiem')); ?>" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search"
                                        placeholder="Tìm kiếm theo tên">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div>
                                <select class="form-control select-filter" id="select-filter">
                                    <option value="<?php echo e(route('trang-san-pham')); ?>">Sắp xếp</option>
                                    <option value="<?php echo e(route('sap-xep', ['sort' => 'gia-asc'])); ?>">Giá tăng dần</option>
                                    <option value="<?php echo e(route('sap-xep', ['sort' => 'gia-desc'])); ?>">Giá giảm dần</option>
                                </select>
                            </div>


                        </div>
                    </div>

                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div
                                    class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <?php
                                        $firstImage = $product->image->first();
                                    ?>
                                    <?php if($firstImage): ?>
                                        <div
                                            class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                            <img class="img-fluid w-100"
                                                src="<?php echo e(asset('storage/' . $firstImage->tenimage)); ?>"
                                                alt="<?php echo e($product->tensanpham); ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">
                                        <a href="<?php echo e(url('/detail', ['id' => $product->id])); ?>"><?php echo e($product->tensanpham); ?>

                                        </a>
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
                                    <a href="<?php echo e(url('/detail', ['id' => $product->id])); ?>"
                                        class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem
                                        Chi Tiết</a>
                                    
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                <!-- Nút Previous -->
                                <?php if($products->onFirstPage()): ?>
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </span>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo e($products->previousPageUrl()); ?>"
                                            aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <!-- Hiển thị các trang -->
                                <?php $__currentLoopData = $products->getUrlRange(1, $products->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="page-item <?php echo e($page == $products->currentPage() ? 'active' : ''); ?>">
                                        <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <!-- Nút Next -->
                                <?php if($products->hasMorePages()): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo e($products->nextPageUrl()); ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>

    </div>
    <!-- Shop End -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-filter').change(function() {
                var url = $(this).val();
                if (url) {
                    window.location = url;
                }
                return false;
            });
        });
    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\DATN\example-app\resources\views/user/shop.blade.php ENDPATH**/ ?>