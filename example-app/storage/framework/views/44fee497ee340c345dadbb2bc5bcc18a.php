<!DOCTYPE html>
<html>

<head>
    <title>App Name - <?php echo $__env->yieldContent('title'); ?></title>
    
    <link rel="stylesheet" href="/css/index.css">
</head>

<body>
    <?php $__env->startSection('header'); ?>
        <a href="/">Home</a>
    <?php echo $__env->yieldSection(); ?>
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>

</html>
<?php /**PATH C:\Users\ADMIN\Desktop\example-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>