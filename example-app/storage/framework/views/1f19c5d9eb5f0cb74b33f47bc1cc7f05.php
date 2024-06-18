<?php $__env->startSection('title', 'Quản lí sản phẩm | Quản trị viên'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .text-align-center th,
        td {
            text-align: center;
        }

        .active {
            font-weight: bold;
            /* Thêm kiểu hiển thị cho class active */
            color: #007bff;
            /* Màu sắc khác để dễ phân biệt */
        }
    </style>

    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="<?php echo e(url('/quan-li-san-pham')); ?>"><b>Danh sách sản phẩm</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row element-button">
                            <div class="col-sm-2">
                                <a class="btn btn-add btn-sm" href="<?php echo e(url('/them-san-pham')); ?>" title="Thêm"><i
                                        class="fas fa-plus"></i> Tạo mới sản phẩm</a>
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
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead class="text-align-center">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá tiền</th>
                                    <th>Danh mục</th>
                                    <th>Nhãn hiệu</th>
                                    <th>Tình trạng</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody class="text-align-center">
                                <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td> <!-- Chỉnh sửa chỉ số -->
                                        <td><?php echo e($item->tensanpham); ?></td>
                                        <td><?php echo e($item->soluong); ?></td>
                                        <td><?php echo e($item->dongia); ?></td>
                                        <td><?php echo e($item->category->tenloaisp); ?></td>
                                        <td><?php echo e($item->brand->tennhanhieu); ?></td>
                                        <td>
                                            <?php if($item->trangthai == 0): ?>
                                                Còn hàng
                                            <?php else: ?>
                                                Hết hàng
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <form id="deleteForm-<?php echo e($item->id); ?>"
                                                action="<?php echo e(url('/xoa-san-pham', ['id' => $item->id])); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <a href="<?php echo e(url('/them-san-pham-con', ['id' => $item->id])); ?>"
                                                    class="btn btn-excel btn-sm" title="Thêm sản phẩm con">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                                <a href="<?php echo e(url('/chi-tiet-san-pham', ['id' => $item->id])); ?>"
                                                    class="btn btn-add btn-sm" title="Xem chi tiết">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <a href="<?php echo e(url('/chinh-sua-san-pham', ['id' => $item->id])); ?>"
                                                    class="btn btn-primary btn-sm edit" type="button" title="Sửa">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button class="btn btn-primary btn-sm trash" type="button" title="Xóa"
                                                    data-toggle="modal"
                                                    data-target="#confirmDeleteModal-<?php echo e($item->id); ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmDeleteModal-<?php echo e($item->id); ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h4 class="modal-title mt-4 mb-3">Cảnh báo</h4>
                        <h5 class="control-label">Bạn có chắc muốn xóa không?</h5>
                        <div class="form-group mt-4">
                            <button id="confirmDeleteBtn-<?php echo e($item->id); ?>" class="btn btn-primary mr-2">Xác
                                nhận</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('confirmDeleteBtn-<?php echo e($item->id); ?>').addEventListener('click', function() {
                document.getElementById('deleteForm-<?php echo e($item->id); ?>').submit();
            });
        </script>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master_ad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\DATN\example-app\resources\views/admin/quan-li-san-pham.blade.php ENDPATH**/ ?>