
<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from template.hasthemes.com/sinrato/sinrato/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Sep 2021 00:25:25 GMT -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Page Title -->
	<title>Đăng nhập</title>
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
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
</head>
<body>
	<!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('/')); ?>">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- Start of Login Wrapper -->
    <?php echo $__env->make('layout.login-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End of Login Wrapper -->

   <!-- scroll to top -->
    <div class="scroll-top not-visible">
        <i class="fas fa-angle-up"></i>
    </div> <!-- /End Scroll to Top -->

	<!-- all js include here -->
    
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/ajax-mail.js"></script>
    <script src="assets/js/main.js"></script>
</body>

<!-- Mirrored from template.hasthemes.com/sinrato/sinrato/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Sep 2021 00:25:25 GMT -->
</html><?php /**PATH D:\xampp\htdocs\baocaothuctap\resources\views/login.blade.php ENDPATH**/ ?>