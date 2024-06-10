<?php $__env->startSection('title', 'Add product'); ?>

<?php $__env->startSection('header'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('header'); ?>
    &gt; <a href="<?php echo e(route('products.index')); ?>">Products</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<h1>Danh sách sản phẩm</h1>
    <a href="<?php echo e(route('products.create')); ?>">Thêm</a>
    <?php $__currentLoopData = $lst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="product">
            <img style="width:100px;max-height:100px;object-fit:contain;" src="<?php echo e($p->image); ?>" alt="">
            <a href="<?php echo e(route('products.show',['product'=>$p])); ?>"><?php echo e($p->name); ?></a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\example-app\resources\views/product-index.blade.php ENDPATH**/ ?>