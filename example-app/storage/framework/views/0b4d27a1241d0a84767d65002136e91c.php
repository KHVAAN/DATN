<?php $__env->startSection('title', 'Thêm nhân viên | Quản trị viên'); ?>

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
                <li class="breadcrumb-item"><a href="<?php echo e(route('quan-li-nhan-vien')); ?>">Danh sách quản trị</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('them-admin')); ?>">Thêm quản trị viên</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Tạo mới quản trị viên</h3>
                    <div class="tile-body">
                        <form action="<?php echo e(route('them-admin')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <form class="row">
                                <div class="form-group col-md-4">
                                    <label class="control-label">Họ và tên</label>
                                    <input class="form-control" name="hovaten" type="text" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Địa chỉ email</label>
                                    <input class="form-control" name="email" type="text" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Địa chỉ</label>
                                    <input class="form-control" name="diachi" type="text" required>
                                </div>
                                <div class="form-group  col-md-4">
                                    <label class="control-label">Số điện thoại</label>
                                    <input class="form-control" name="sdt" type="number" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Số CMND</label>
                                    <input class="form-control" type="number" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Ngày cấp</label>
                                    <input class="form-control" type="date" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Nơi cấp</label>
                                    <input class="form-control" type="text" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Giới tính</label>
                                    <select class="form-control" id="exampleSelect2" required>
                                        <option>-- Chọn giới tính --</option>
                                        <option>Nam</option>
                                        <option>Nữ</option>
                                    </select>
                                </div>

                                <div class="form-group  col-md-3">
                                    <label for="exampleSelect1" class="control-label">Chức vụ</label>
                                    <select class="form-control" id="exampleSelect1">
                                        <option>-- Chọn chức vụ --</option>
                                        <option>Bán hàng</option>
                                        <option>Tư vấn</option>
                                        <option>Dịch vụ</option>
                                        <option>Thu Ngân</option>
                                        <option>Quản kho</option>
                                        <option>Bảo trì</option>
                                        <option>Kiểm hàng</option>
                                        <option>Bảo vệ</option>
                                        <option>Tạp vụ</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Bằng cấp</label>
                                    <select class="form-control" id="exampleSelect3">
                                        <option>-- Chọn bằng cấp --</option>
                                        <option>Tốt nghiệp Đại Học</option>
                                        <option>Tốt nghiệp Cao Đẳng</option>
                                        <option>Tốt nghiệp Phổ Thông</option>
                                        <option>Chưa tốt nghiệp</option>
                                        <option>Không bằng cấp</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Tình trạng hôn nhân</label>
                                    <select class="form-control" id="exampleSelect2">
                                        <option>-- Chọn tình trạng hôn nhân --</option>
                                        <option>Độc thân</option>
                                        <option>Đã kết hôn</option>
                                        <option>Góa</option>
                                        <option>Khác</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="control-label">Ảnh 3x4 nhân viên</label>
                                    <div id="myfileupload">
                                        <input type="file" id="uploadfile" name="ImageUpload"
                                            onchange="readURL(this);" />
                                    </div>
                                    <div id="thumbbox">
                                        <img height="300" width="300" alt="Thumb image" id="thumbimage"
                                            style="display: none" />
                                        <a class="removeimg" href="javascript:"></a>
                                    </div>
                                    <div id="boxchoice">
                                        <a href="javascript:" class="Choicefile"><i class='bx bx-upload'></i></a>
                                        <p style="clear:both"></p>
                                    </div>

                                </div>



                    </div>
                    <button class="btn btn-save" type="button">Lưu lại</button>
                    <a class="btn btn-cancel" href="/doc/table-data-table.html">Hủy bỏ</a>
                </div>

    </main>


    <!--
              MODAL
            -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="row">
                        <div class="form-group  col-md-12">
                            <span class="thong-tin-thanh-toan">
                                <h5>Tạo chức vụ mới</h5>
                            </span>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Nhập tên chức vụ mới</label>
                            <input class="form-control" type="text" required>
                        </div>
                    </div>
                    <BR>
                    <button class="btn btn-save" type="button">Lưu lại</button>
                    <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                    <BR>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!--
              MODAL
            -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master_ad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\DATN\example-app\resources\views/admin/them-nhan-vien.blade.php ENDPATH**/ ?>