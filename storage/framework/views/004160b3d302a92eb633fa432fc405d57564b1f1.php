<?php

    if(Session::has('username')){
        $token = session('username');
    }else{
        $token = "guest";
    }

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Page Title -->
	<title>Cart</title>
	<!--Fevicon-->
	<link rel="icon" href="<?php echo e(asset('assets/img/icon/favicon.ico')); ?>" type="image/x-icon" />
	<!-- Bootstrap css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
    <!-- linear-icon -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/linear-icon.css')); ?>">
    <!-- all css plugins css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins.css')); ?>">
    <!-- default style -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/default.css')); ?>">
    <!-- Main Style css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <!-- responsive css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsive.css')); ?>">
    <script src="<?php echo e(asset('assets/js/vendor/jquery-1.12.4.min.js')); ?>"></script>
    <!-- Modernizer JS -->
    <script src="<?php echo e(asset('assets/js/vendor/modernizr-3.5.0.min.js')); ?>"></script>
</head>
<body>
    
    <input type="hidden" name="" id="userLogin" value="<?php echo e($token); ?>">
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
                                <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- Start cart Wrapper -->
    <div class="shopping-cart-wrapper pb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <main id="primary" class="site-main">
                        <div class="shopping-cart">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h3>Giỏ hàng</h3>
                                    </div>
                                    <form action="#">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>Ảnh</td>
                                                        <td>Tên sản phẩm</td>
                                                        <td>Màu</td>
                                                        <td>Số lượng</td>
                                                        <td>Giá</td>
                                                        <td>Tổng</td>
                                                        <td>Xóa</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="showCart">                                      
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>

                                    

                                    <div class="cart-amount-wrapper">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-4 offset-md-8">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Tạm tính:</strong></td>
                                                            <td id="subTotal">0đ</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Tổng cộng:</strong></td>
                                                            <td><span id="total" class="color-primary">0đ</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cart-button-wrapper d-flex justify-content-between mt-4">
                                        <a href="<?php echo e(route('shop')); ?>" class="btn btn-secondary">Tiếp tục mua sắm</a>
                                        <a href="<?php echo e(route('checkout')); ?>" class="btn btn-secondary dark align-self-end">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end of shopping-cart -->
                    </main> <!-- end of #primary -->
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div>
    <!-- End cart Wrapper -->

   <!-- scroll to top -->
    <div class="scroll-top not-visible">
        <i class="fas fa-angle-up"></i>
    </div> <!-- /End Scroll to Top -->

    <!-- footer area start -->  
    <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- footer area end -->
    

	<!-- all js include here -->
    <script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/ajax-mail.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
</body>

<!-- Mirrored from template.hasthemes.com/sinrato/sinrato/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Sep 2021 00:25:25 GMT -->
</html>


<script>
    $(document).ready(function(){
        //Lấy user đã login
        var customer = $("#userLogin").val();
        //alert(customer);
        //Gửi ajax
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "<?php echo e(route('show-cart')); ?>",
            type: "get",
            dataType: "text",
            data: {
                customer: customer
            },
            success: function(result){
                $("#showCart").html(result);
                //alert(result);
            }
        });
    });
</script><?php /**PATH D:\xampp\htdocs\baocaothuctap\resources\views/cart.blade.php ENDPATH**/ ?>