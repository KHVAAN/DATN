<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>

<body>
    <form action="<?php echo e(route('students.store')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <label for="name">Tên đăng nhập</label>
        <input type="text" name="name">
        <label for="password">Mật khẩu</label>
        <input type="password" name="password">
        <button type="submit">Đăng ký</button>
    </form>
</body>

</html><?php /**PATH C:\Users\ADMIN\Desktop\example-app\resources\views/students/create.blade.php ENDPATH**/ ?>