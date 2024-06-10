<?php $__env->startSection('title', 'Quản lí khách hàng | Quản trị viên'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .text-align-center th {
            text-align: center;
        }
    </style>

    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="<?php echo e(url('/quan-li-khach-hang')); ?>"><b>Danh sách khách hàng</b></a>
                </li>
            </ul>
            <div id="clock"></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">

                        <div class="row element-button">
                            <div class="col-sm-2">

                                <a class="btn btn-add btn-sm" href="<?php echo e(url('/them-khach-hang')); ?>" title="Thêm"><i
                                        class="fas fa-plus"></i>
                                    Tạo mới khách hàng</a>
                            </div>

                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm print-file" type="button" title="In"
                                    onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
                            </div>

                            <div class="col-sm-2">
                                <a class="btn btn-excel btn-sm" href="" title="In"><i
                                        class="fas fa-file-excel"></i> Xuất Excel</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm pdf-file" type="button" title="In"
                                    onclick="myFunction(this)"><i class="fas fa-file-pdf"></i> Xuất PDF</a>
                            </div>

                        </div>
                        <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0"
                            border="0" id="sampleTable">
                            <thead class="text-align-center">
                                <tr>
                                    <th width="10"><input type="checkbox" id="all"></th>
                                    <th>ID nhân viên</th>
                                    <th width="150">Họ và tên</th>
                                    <th width="300">Địa chỉ</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th>SĐT</th>
                                    <th>Chức vụ</th>
                                    <th width="100">Tính năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="10"><input type="checkbox" name="check1" value="1"></td>
                                    <td>#CD12837</td>
                                    <td>Hồ Thị Thanh Ngân</td>
                                    <td>155-157 Trần Quốc Thảo, Quận 3, Hồ Chí Minh </td>
                                    <td>12/02/1999</td>
                                    <td>Nữ</td>
                                    <td>0926737168</td>
                                    <td>Bán hàng</td>
                                    <td class="table-td-center"><button class="btn btn-primary btn-sm trash" type="button"
                                            title="Xóa" onclick="myFunction(this)"><i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm edit" type="button" title="Sửa"
                                            id="show-emp" data-toggle="modal" data-target="#ModalUP"><i
                                                class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="10"><input type="checkbox" name="check2" value="2"></td>
                                    <td>#SX22837</td>
                                    <td>Trần Khả Ái</td>
                                    <td>6 Nguyễn Lương Bằng, Tân Phú, Quận 7, Hồ Chí Minh</td>
                                    <td>22/12/1999</td>
                                    <td>Nữ</td>
                                    <td>0931342432</td>
                                    <td>Bán hàng</td>
                                    <td><button class="btn btn-primary btn-sm trash" type="button" title="Xóa"
                                            onclick="myFunction(this)"><i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm edit" type="button" title="Sửa"
                                            id="show-emp" data-toggle="modal" data-target="#ModalUP"><i
                                                class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--
                  MODAL
                -->
    <div class="modal fade" id="ModalUP" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="row">
                        <div class="form-group  col-md-12">
                            <span class="thong-tin-thanh-toan">
                                <h5>Chỉnh sửa thông tin nhân viên cơ bản</h5>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">ID nhân viên</label>
                            <input class="form-control" type="text" required value="#CD2187" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Họ và tên</label>
                            <input class="form-control" type="text" required value="Võ Trường">
                        </div>
                        <div class="form-group  col-md-6">
                            <label class="control-label">Số điện thoại</label>
                            <input class="form-control" type="number" required value="09267312388">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Địa chỉ email</label>
                            <input class="form-control" type="text" required value="truong.vd2000@gmail.com">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Ngày sinh</label>
                            <input class="form-control" type="date" value="15/03/2000">
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="exampleSelect1" class="control-label">Chức vụ</label>
                            <select class="form-control" id="exampleSelect1">
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
                    </div>
                    <BR>
                    <a href="#" style="    float: right;
        font-weight: 600;
        color: #ea0000;">Chỉnh
                        sửa nâng cao</a>
                    <BR>
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

<?php echo $__env->make('layout.master_ad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\DATN\example-app\resources\views/admin/quan-li-khach-hang.blade.php ENDPATH**/ ?>