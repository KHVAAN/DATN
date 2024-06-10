<?php $__env->startSection('title', 'Bảng kê lương | Quản trị viên'); ?>

<?php $__env->startSection('content'); ?>
    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">Bản kê lương</li>
                <li class="breadcrumb-item"><a href="#">Thêm mới</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Tạo mới bảng kê lương</h3>
                    <div class="tile-body">
                        <div class="row element-button">
                            <div class="col-sm-2">
                                <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><b><i
                                            class="fas fa-folder-plus"></i> Tạo trạng thái mới</b></a>
                            </div>

                        </div>
                        <form class="row">
                            <div class="form-group col-md-3">
                                <label class="control-label">Tên nhân viên</label>
                                <input class="form-control" type="text" placeholder="nhập họ tên nhân viên">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleSelect1" class="control-label">Giới tính</label>
                                <select class="form-control" id="exampleSelect1">
                                    <option>-- Chọn giới tính --</option>
                                    <option>Nam</option>
                                    <option>Nữ</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleSelect1" class="control-label"> Chức vụ</label>
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
                                <label class="control-label">Tiền lương</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Trừ lương</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Tiền thưởng</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Tổng nhận</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleSelect1" class="control-label">Trạng thái</label>
                                <select class="form-control" id="exampleSelect1">
                                    <option>-- Chọn trạng thái --</option>
                                    <option>Đã nhận tiền</option>
                                    <option>Chưa nhận tiền</option>
                                </select>
                            </div>


                    </div>
                    <button class="btn btn-save" type="button">Lưu lại</button>
                    <a class="btn btn-cancel" href="/doc/table-data-oder.html">Hủy bỏ</a>
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
                                <h5>Tạo trạng thái mới</h5>
                            </span>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Nhập tên trạng thái mới</label>
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

<?php echo $__env->make('layout.master_ad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DATN\example-app\resources\views/admin/them-tien-luong.blade.php ENDPATH**/ ?>