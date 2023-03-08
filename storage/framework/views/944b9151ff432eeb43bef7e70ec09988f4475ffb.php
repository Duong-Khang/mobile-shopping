<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laravel Pagination Demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<?php $__currentLoopData = $shop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo e($item->name); ?><br>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo $shop->links(); ?><?php /**PATH D:\xampp\htdocs\ThucTapTwo\resources\views/cua-hang.blade.php ENDPATH**/ ?>