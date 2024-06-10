<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="/img/no_image.png" width="50px"
            alt="User Image">
        <div>
            <p class="app-sidebar__user-name"><b>Gia Huy</b></p>
            <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
        </div>
    </div>
    <hr>
    <ul class="app-menu">
        <li><a class="app-menu__item " href="<?php echo e(url('/trang-chu')); ?>"><i class='app-menu__icon bx bx-tachometer'></i><span
                    class="app-menu__label">Trang chủ</span></a></li>
        <li><a class="app-menu__item " href="<?php echo e(url('/quan-li-nhan-vien')); ?>"><i class='app-menu__icon bx bx-id-card'></i>
                <span class="app-menu__label">Quản lý nhân viên</span></a></li>
        <li><a class="app-menu__item" href="<?php echo e(url('/quan-li-khach-hang')); ?>"><i class='app-menu__icon bx bx-user-voice'></i><span
                    class="app-menu__label">Quản lý khách hàng</span></a></li>
        <li><a class="app-menu__item" href="<?php echo e(url('/quan-li-san-pham')); ?>"><i
                    class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản
                    phẩm</span></a>
        </li>
        <li><a class="app-menu__item" href="<?php echo e(url('/quan-li-don-hang')); ?>"><i class='app-menu__icon bx bx-task'></i><span
                    class="app-menu__label">Quản lý đơn hàng</span></a></li>
        <li><a class="app-menu__item" href="<?php echo e(url('/doanh-thu')); ?>"><i
                    class='app-menu__icon bx bx-pie-chart-alt-2'></i><span class="app-menu__label">Báo cáo doanh
                    thu</span></a>
        </li>
    </ul>
</aside>
<?php /**PATH C:\Users\ADMIN\Desktop\DATN\example-app-2\resources\views/layout/sidebar.blade.php ENDPATH**/ ?>