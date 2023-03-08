<?php

if (Session::has('username')) {
    $token = session('username');
} else {
    $token = "no login";
}

?>
<!doctype html>
<html class="no-js" lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Page Title -->
    <title>Trang chủ</title>
    <!--Fevicon-->
    <link rel="icon" href="assets/img/icon/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- linear-icon -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/linear-icon.css">
    <!-- all css plugins css -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    <!-- default style -->
    <link rel="stylesheet" href="assets/css/default.css">
    <!-- Main Style css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- jQuery -->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <input type="hidden" name="" id="userLogin" value="<?php echo e($token); ?>">
    <!-- header area start -->
    <header class="header-pos">
        <!-- Bắt đầu header top -->
        <?php echo $__env->make('layout.header-top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Kết thúc header top -->
        <!-- Bắt đầu header middle -->
        <?php echo $__env->make('layout.header-middle', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Kết thúc header middle -->
        <!-- Bắt đầu header top menu -->
        <?php echo $__env->make('layout.header-top-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Kết thúc header top menu -->
    </header>
    <!-- slider area start -->
    <?php echo $__env->make('layout.slider-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- slider area end -->

    <!-- feature area start -->
    <?php echo $__env->make('layout.feature-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- feature area end -->
    <?php echo $__env->make('layout.home-product-module', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- home banner statics area -->
    <?php echo $__env->make('layout.home-banner-statics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- home banner statics end -->

    <!-- home product module four start -->
    <?php echo $__env->make('layout.home-product-module-four', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- home product module four end -->

    <!-- home product module five start -->
    <?php echo $__env->make('layout.home-product-module-five', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- home product module five end -->

    <!-- home product module six start -->
    <?php echo $__env->make('layout.home-product-module-six', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- home product module five end -->

    <!-- home banner statics area -->
    <?php echo $__env->make('layout.home-banner-2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- home banner statics area end -->

    <!-- brand sale area start -->
    <?php echo $__env->make('layout.brand-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- brand sale area end -->

    <!-- scroll to top -->
    <div class="scroll-top not-visible">
        <i class="fas fa-angle-up"></i>
    </div> <!-- /End Scroll to Top -->

    <!-- footer area start -->
    <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- footer area end -->

    <!-- all js include here -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/ajax-mail.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html><?php /**PATH D:\PHP\xampp\htdocs\ThucTapTwo\resources\views/index.blade.php ENDPATH**/ ?>