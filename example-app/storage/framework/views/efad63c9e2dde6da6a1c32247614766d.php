<?php $__env->startSection('title', 'Edit product'); ?>

<?php $__env->startSection('header'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('header'); ?>
&gt; <a href="<?php echo e(route('products.index')); ?>">Products</a>
&gt; Sửa sản phẩm
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<form method="post" action="<?php echo e(route('products.update',['product'=>$p])); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <label>Tên sản phẩm: </label><input name="name" value="<?php echo e(old('name',$p->name)); ?>"><br>
    <?php if($errors->has('name')): ?> <?php echo e($errors->first('name')); ?> <br> <?php endif; ?>
    <label>Giá: </label><input name="price" value="<?php echo e(old('price',$p->price)); ?>"><br>
    <?php if($errors->has('price')): ?> <?php echo e($errors->first('price')); ?> <br> <?php endif; ?>
    <label>Loại sản phẩm: </label>
    <select name="category">
        <option value="">-- Chọn loại --</option>
        <?php $__currentLoopData = $lst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cat->id); ?>" <?php if($cat->id==old('category',$p->category_id)): ?>
                selected <?php endif; ?>><?php echo e($cat->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select><br>
    <?php if($errors->has('category')): ?> <?php echo e($errors->first('category')); ?> <br> <?php endif; ?>
    <label>Mô tả: </label><textarea name="desc"><?php echo e(old('desc',$p->desc)); ?></textarea><br>
    <?php if($errors->has('desc')): ?> <?php echo e($errors->first('desc')); ?> <br> <?php endif; ?>
    <label>Hình: </label>
    <input type="file" accept="image/*" name="image"> <br>
    <?php if($errors->has('image')): ?> <?php echo e($errors->first('image')); ?> <br> <?php endif; ?>
    <input type="submit">
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\example-app\resources\views/product-edit.blade.php ENDPATH**/ ?>