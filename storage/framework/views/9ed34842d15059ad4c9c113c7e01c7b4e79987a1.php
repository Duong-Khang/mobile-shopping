
<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from template.hasthemes.com/sinrato/sinrato/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Sep 2021 00:25:25 GMT -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Page Title -->
	<title>Register</title>
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
    <!-- header area end -->

    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Register</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- Start of Login Wrapper -->
    <?php echo $__env->make('layout.register-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End of Login Wrapper -->

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

<!-- Mirrored from template.hasthemes.com/sinrato/sinrato/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Sep 2021 00:25:25 GMT -->
</html><?php /**PATH D:\Program Files\XamPP\htdocs\ThucTapTwo\resources\views/register.blade.php ENDPATH**/ ?>