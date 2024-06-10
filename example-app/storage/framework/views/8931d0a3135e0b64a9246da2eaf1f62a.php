<?php $__env->startSection('title', 'Lịch công tác | Quản trị viên'); ?>

<?php $__env->startSection('content'); ?>
    <main class="app-content">
        <div class="row">
            <div class="col-md-12">
                <div class="app-title">
                    <ul class="app-breadcrumb breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/lich-cong-tac')); ?>"><b>Lịch công tác</b></a></li>
                    </ul>
                    <div id="clock"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div id="external-events">
                                    <h4 class="mb-4">Kéo sự kiện thả vào</h4>
                                    <div class="fc-event"><b>Họp công ty</b></div>
                                    <div class="fc-event"><b>Họp báo</b></div>
                                    <div class="fc-event"><b>Mừng sinh nhật</b></div>
                                    <div class="fc-event"><b>Nghĩ lễ</b></div>
                                    <div class="fc-event"><b>Đi công tác</b></div>
                                    <div class="fc-event"><b>Gặp khách hàng</b></div>
                                    <div class="fc-event"><b>Tổ chức du lịch</b></div>
                                    <p class="animated-checkbox mt-20">
                                        <label>
                                            <input id="drop-remove" type="checkbox"><span class="label-text">Hủy bỏ sau khi
                                                thả</span>
                                        </label>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master_ad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\DATN\example-app\resources\views/admin/lich-cong-tac.blade.php ENDPATH**/ ?>