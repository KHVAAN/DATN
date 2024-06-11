<?php $__env->startSection('title', 'Thông tin sản phẩm | Quản trị viên'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .Choicefile {
            display: block;
            background: #14142B;
            border: 1px solid #fff;
            color: #fff;
            width: 150px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            padding: 5px 0px;
            border-radius: 5px;
            font-weight: 500;
            align-items: center;
            justify-content: center;
        }

        .Choicefile:hover {
            text-decoration: none;
            color: white;
        }

        #uploadfile,
        .removeimg {
            display: none;
        }

        #thumbbox {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .removeimg {
            height: 25px;
            position: absolute;
            background-repeat: no-repeat;
            top: 5px;
            left: 5px;
            background-size: 25px;
            width: 25px;
            /* border: 3px solid red; */
            border-radius: 50%;

        }

        .removeimg::before {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            content: '';
            border: 1px solid red;
            background: red;
            text-align: center;
            display: block;
            margin-top: 11px;
            transform: rotate(45deg);
        }

        .removeimg::after {
            /* color: #FFF; */
            /* background-color: #DC403B; */
            content: '';
            background: red;
            border: 1px solid red;
            text-align: center;
            display: block;
            transform: rotate(-45deg);
            margin-top: -2px;
        }
    </style>
    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/quan-li-san-pham')); ?>">Danh sách sản phẩm</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(url('/chi-tiet-san-pham', ['id' => $product->id])); ?>">Thông tin sản
                        phẩm</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Thông tin sản phẩm</h3>
                    <div class="tile-body">
                        <form class="row" action="<?php echo e(route('chi-tiet-san-pham', ['id' => $product->id])); ?>"
                            method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group col-md-4">
                                <label class="control-label">Mã sản phẩm </label>
                                <input class="form-control" type="text" value="<?php echo e($product->id); ?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Tên sản phẩm</label>
                                <input type="text" name="tensanpham" class="form-control"
                                    value="<?php echo e($product->tensanpham); ?>">
                                <div class="error-message"><?php echo e($errors->first('tensanpham')); ?></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Số lượng</label>
                                <input class="form-control" type="number" name="soluong" value="<?php echo e($product->soluong); ?>">
                                <div class="error-message"><?php echo e($errors->first('soluong')); ?></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleSelect1" class="control-label">Tình trạng sản phẩm</label>
                                <select class="form-control" name="trangthai" id="exampleSelect1">
                                    <option value="Còn hàng" <?php echo e($product->trangthai == 'Còn hàng' ? 'selected' : ''); ?>>Còn
                                        hàng</option>
                                    <option value="Hết hàng" <?php echo e($product->trangthai == 'Hết hàng' ? 'selected' : ''); ?>>Hết
                                        hàng</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Giá bán</label>
                                <input class="form-control" type="text" value="<?php echo e($product->dongia); ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleSelect1" class="control-label">Danh mục</label>
                                <select class="form-control" id="exampleSelect1" name="loaisp_id">
                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"
                                            <?php echo e($item->id == $product->category->id ? 'selected' : ''); ?>>
                                            <?php echo e($item->tenloaisp); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="error-message"><?php echo e($errors->first('category')); ?></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleSelect1" class="control-label">Nhãn hiệu</label>
                                <select class="form-control" id="exampleSelect1" name="nhanhieu_id">
                                    <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"
                                            <?php echo e($item->id == $product->brand->id ? 'selected' : ''); ?>>
                                            <?php echo e($item->tennhanhieu); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="error-message"><?php echo e($errors->first('brand')); ?></div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="control-label">Mô tả sản phẩm</label>
                                <textarea class="form-control" name="mota" id="mota"><?php echo e($product->mota); ?></textarea>
                                <div class="error-message"><?php echo e($errors->first('mota')); ?></div>
                                <script>
                                    CKEDITOR.replace('mota');
                                </script>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Ảnh sản phẩm</label>
                                <div id="thumbbox">
                                    <?php $__currentLoopData = $image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-group col-md-6">
                                            <img src="<?php echo e(asset($item->tenimage)); ?>" alt="Product Image" class="img-fluid"
                                                style="height: 100px;">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <a class="removeimg" href="javascript:"></a>
                                </div>

                                <div id="boxchoice">
                                    <a href="javascript:" class="Choicefile"><i class="fas fa-cloud-upload-alt"></i> Chọn
                                        ảnh</a>
                                    <p style="clear:both"></p>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                
                                <a class="btn btn-cancel" href="<?php echo e(route('quan-li-san-pham')); ?>">Hủy bỏ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master_ad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\DATN\example-app\resources\views/admin/chi-tiet-san-pham.blade.php ENDPATH**/ ?>