<?php $__env->startSection('title', 'Chỉnh sửa nhãn hiệu | Quản trị viên'); ?>

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
            border-radius: 50%;
        }

        .removeimg::before {
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
                <li class="breadcrumb-item"><a href="<?php echo e(url('/danh-sach-chung')); ?>">Danh sách nhãn hiệu</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(url('/chinh-sua-nhan-hieu', ['id' => $brand->id])); ?>">Chỉnh sửa nhãn hiệu</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Chỉnh sửa nhãn hiệu</h3>
                    <div class="tile-body">
                        <form class="row" action="<?php echo e(route('cap-nhat-nhan-hieu', ['id' => $brand->id])); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            
                            <div class="form-group col-md-3">
                                <label class="control-label">Tên nhãn hiệu</label>
                                <input type="text" name="tennhanhieu" class="form-control" value="<?php echo e($brand->tennhanhieu); ?>" placeholder="Tên nhãn hiệu">
                                <div class="error-message"><?php echo e($errors->first('tennhanhieu')); ?></div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="exampleSelect1" class="control-label">Tình trạng</label>
                                <select id="inputState" name="trangthai" class="form-control">
                                    <option>-- Chọn tình trạng --</option>
                                    <option value="0" <?php if($brand->trangthai == 0): ?> selected <?php endif; ?>>Còn hàng</option>
                                    <option value="1" <?php if($brand->trangthai == 1): ?> selected <?php endif; ?>>Hết hàng</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-save" type="submit">Lưu lại</button>
                                <a class="btn btn-cancel" href="<?php echo e(url('/quan-li-san-pham')); ?>">Hủy bỏ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master_ad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\DATN\example-app\resources\views/admin/chinh-sua-nhan-hieu.blade.php ENDPATH**/ ?>