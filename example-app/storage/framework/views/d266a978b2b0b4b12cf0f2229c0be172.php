<?php $__env->startSection('title', 'Product details'); ?>

<?php $__env->startSection('header'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('header'); ?>
    &gt; <a href="<?php echo e(route('products.index')); ?>">Products</a>
    &gt; <?php echo e($p->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h1><?php echo e($p->name); ?></h1>
    <a href="<?php echo e(route('products.edit', ['product' => $p])); ?>">Sửa</a> <br>
    <form method="post" action="<?php echo e(route('products.destroy', ['product' => $p])); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <input type="submit" value="Xóa">

    </form>
    <img style="width:100px;max-height:100px;object-fit:contain" src="<?php echo e($p->image); ?>">
    <p>Loại: <?php echo e($p->category->name); ?></p>
    <p>Giá: <?php echo e($p->price); ?></p>
    <div>
        <h3>Mô tả: </h3>
        <?php echo e($p->desc); ?>

    </div>
    <br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\example-app\resources\views/product-show.blade.php ENDPATH**/ ?>