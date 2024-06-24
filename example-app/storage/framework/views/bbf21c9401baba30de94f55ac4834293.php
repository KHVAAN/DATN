<?php $__env->startSection('title', 'Thêm sản phẩm | Quản trị viên'); ?>

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

        .thumbimage {
            height: 200px;
            width: 150px;
            margin-right: 10px;
            margin-bottom: 10px;
            display: block;
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

        .removeimg::before,
        .removeimg::after {
            box-sizing: border-box;
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background: red;
            top: 50%;
            left: 0;
        }

        .removeimg::before {
            transform: rotate(45deg);
        }

        .removeimg::after {
            transform: rotate(-45deg);
        }
    </style>
    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/quan-li-san-pham')); ?>">Danh sách sản phẩm</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(url('/them-san-pham')); ?>">Thêm sản phẩm</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Tạo mới sản phẩm</h3>
                    <div class="tile-body">
                        <form class="row" action="<?php echo e(route('xu-li-them-san-pham')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            
                            <div class="form-group col-md-3">
                                <label class="control-label">Tên sản phẩm</label>
                                <input type="text" name="tensanpham" class="form-control" placeholder="Tên sản phẩm">
                                <div class="error-message"><?php echo e($errors->first('tensanpham')); ?></div>
                            </div>
                            <div class="form-group  col-md-3">
                                <label class="control-label">Số lượng</label>
                                <input class="form-control" type="number" name="soluong" placeholder="Số lượng">
                                <div class="error-message"><?php echo e($errors->first('soluong')); ?></div>
                            </div>
                            <div class="form-group col-md-3 ">
                                <label for="exampleSelect1" class="control-label">Tình trạng</label>
                                <select id="inputState" name="trangthai" class="form-control">
                                    <option>-- Chọn tình trạng --</option>
                                    <option value="0">Còn hàng</option>
                                    <option value="1">Hết hàng</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleSelect1" class="control-label">Danh mục</label>
                                <select class="form-control" id="exampleSelect1" name="loaisp_id">
                                    <option>-- Chọn danh mục --</option>
                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->tenloaisp); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3 ">
                                <label for="exampleSelect1" class="control-label">Nhãn hiệu</label>
                                <select class="form-control" id="exampleSelect1" name="nh_id">
                                    <option>-- Chọn nhãn hiệu --</option>
                                    <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->tennhanhieu); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Giá bán</label>
                                <input type="number" name="dongia" class="form-control" placeholder="Đơn giá">
                                <div class="error-message"><?php echo e($errors->first('dongia')); ?></div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Giảm giá</label>
                                <input type="number" name="giamgia" class="form-control" placeholder="Giảm giá">
                                <div class="error-message"><?php echo e($errors->first('giamgia')); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Ảnh sản phẩm</label>
                                <div id="thumbbox">
                                    <!-- Khu vực hiển thị ảnh thumbnail trước khi upload -->
                                    <img height="200" width="150" alt="Thumbnail" id="thumbimage"
                                        style="display: none;" />
                                    <a class="removeimg" href="javascript:">
                                        <!-- Đường dẫn xóa ảnh thumbnail nếu cần -->
                                    </a>
                                </div>
                                <div id="boxchoice">
                                    <!-- Button chọn ảnh từ máy tính -->
                                    <label for="uploadfile" class="Choicefile"><i class="fas fa-cloud-upload-alt"></i> Chọn
                                        ảnh</label>
                                    <!-- Input hidden để chọn file -->
                                    <input type="file" id="uploadfile" name="image[]" onchange="previewImages(this);"
                                        multiple style="display: none;" />
                                    <!-- Thông báo lựa chọn ảnh -->
                                    <p style="clear:both"></p>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Mô tả sản phẩm</label>
                                <textarea class="form-control" name="mota" id="mota"></textarea>
                                <div class="error-message"><?php echo e($errors->first('mota')); ?></div>
                                <script>
                                    CKEDITOR.replace('mota');
                                </script>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-save" type="submit">Lưu lại</button>
                                <a class="btn btn-cancel" href="<?php echo e(url('/them-san-pham')); ?>">Hủy bỏ</a>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Đoạn js hiển thị nhiều ảnh khi tạo sản phẩm -->
    <script>
        function previewImages(input) {
            var preview = document.querySelector('#thumbbox');
            preview.innerHTML = ''; // Xóa các ảnh trước đó trong khu vực hiển thị

            if (input.files) {
                var filesAmount = input.files.length;

                for (var i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        var imgElement = document.createElement('img');
                        imgElement.setAttribute('src', event.target.result);
                        imgElement.setAttribute('height', '200');
                        imgElement.setAttribute('width', '150');
                        imgElement.classList.add('thumbimage');

                        var removeImgElement = document.createElement('a');
                        removeImgElement.classList.add('removeimg');
                        removeImgElement.setAttribute('href', 'javascript:');

                        removeImgElement.onclick = function() {
                            imgElement.remove();
                            removeImgElement.remove();
                        };

                        var container = document.createElement('div');
                        container.style.position = 'relative';
                        container.style.display = 'inline-block';
                        container.appendChild(imgElement);
                        container.appendChild(removeImgElement);

                        preview.appendChild(container);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master_ad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\DATN\example-app\resources\views/admin/them-san-pham.blade.php ENDPATH**/ ?>