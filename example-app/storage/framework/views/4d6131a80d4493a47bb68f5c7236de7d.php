<?php $__env->startSection('title', 'Danh sách nhãn hiệu | Quản trị viên'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .text-align-center th, td {
            text-align: center;
        }
    </style>

    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="<?php echo e(url('/ds-nhan-hieu')); ?>"><b>Danh sách nhãn hiệu</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead class="text-align-center">
                                <tr>
                                    
                                    <th>STT</th>
                                    <th>Tên nhãn hiệu</th>
                                    <th>Trạng thái</th>
                                    <th>Tính năng</th>
                                </tr>
                            </thead>
                            <tbody class="text-align-center">
                                <tr>
                                    
                                    <td>STT</td>
                                    <td>Tên nhãn hiệu</td>
                                    <td>Trạng thái</td>
                                    <td>
                                        <button class="btn btn-primary btn-add btn-sm" type="button" title="Thêm"><i
                                                class="fas fa-plus"></i> </button>
                                        <button class="btn btn-primary btn-sm trash" type="button" title="Xóa"><i
                                                class="fas fa-trash-alt"></i> </button>
                                        <button class="btn btn-primary btn-sm edit" type="button" title="Sửa"><i
                                                class="fa fa-edit"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master_ad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\DATN\example-app\resources\views/admin/ds-nhan-hieu.blade.php ENDPATH**/ ?>