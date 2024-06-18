<header class="app-header">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
        aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <?php if(Auth::check() && Auth::user()->phanquyen !== null): ?>
            <!-- Nếu người dùng đã đăng nhập và phân quyền không null -->
            <li>
                <a class="app-nav__item" href="<?php echo e(route('dang-xuat')); ?>"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='bx bx-log-out bx-rotate-180'></i>
                </a>
            </li>
            <form id="logout-form" action="<?php echo e(route('dang-xuat')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        <?php endif; ?>

    </ul>
</header>
<?php /**PATH C:\Users\ADMIN\Desktop\DATN\example-app\resources\views/layout/header_ad.blade.php ENDPATH**/ ?>