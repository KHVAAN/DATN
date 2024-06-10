<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>
    <a href="<?php echo e(route('students.create')); ?>">Add</a>
    <h1>Danh sách sinh viên</h1>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Username</th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>

                <td><?php echo e($item['Username']); ?></td>
                <td><?php echo e($item['Age']); ?></td>
            </tr>
            <td style="display:flex">
                <a href="<?php echo e(route('students.edit', ['id' => $id])); ?>">Edit</a>
                <form action="<?php echo e(route('students.destroy', ['id' => $id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit">Delete</button>
                </form>
                <a href="<?php echo e(route('students.show', ['id' => $id])); ?>">Show</a>
            </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>

</html><?php /**PATH C:\Users\ADMIN\Desktop\example-app\resources\views/students/index.blade.php ENDPATH**/ ?>