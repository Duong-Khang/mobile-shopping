
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
	<title>Kết quả tìm kiếm</title>
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
    <div class="breadcrumb-area mb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Kết quả tìm kiếm</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

   <!-- shop page main wrapper start -->
   <div class="main-wrapper pt-35">
       <div class="container-fluid">
           <div class="row">
               <div class="col-lg-12">
                    <div class="product-shop-main-wrapper mb-50">
                        <div class="shop-product-wrap grid row">
                            <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div style="height: 350px;" class="product-item mb-30">
                                    <div class="product-thumb">
                                        <a href="product-details?pid=<?php echo e($item->id); ?>">
                                            <img style="height: 200px; width: 200px;" src="product_images/<?php echo e($item->photo_name); ?>" class="pri-img" alt="">
                                            <img style="height: 200px; width: 200px;" src="product_images/<?php echo e($item->photo_name); ?>" class="sec-img" alt="">
                                        </a>
                                        <div class="box-label">
                                            <div class="label-product label_sale">
                                                <?php if($item->active == 1): ?>
                                                    <span>-<?php echo e($item->discount_percent); ?>%</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-caption">
                                        <div class="manufacture-product">
                                            <p><a href=""><?php echo e($item->manufacture); ?></a></p>
                                        </div>
                                        <div class="product-name">
                                            <h4><a href="product-details?pid=<?php echo e($item->id); ?>"><?php echo e($item->name); ?></a></h4>
                                        </div>
                                        <input type="hidden" id="pid_<?php echo e($item->id); ?>" value="<?php echo e($item->id); ?>">
                                        <div id="show_star_<?php echo e($item->id); ?>" class="ratings">
                                        </div>
                                        <script>
                                            $(document).ready(function(){
                                                var pid = $("#pid_<?php echo e($item->id); ?>").val();
                                                $.ajax({
                                                    url: "ajax-jQuery/show-star-avg.php",
                                                    type: "get",
                                                    dataType: "text",
                                                    data: {
                                                        pid: pid
                                                    },
                                                    success: function(result){
                                                        $("#show_star_<?php echo e($item->id); ?>").html(result);                                                       
                                                    }
                                                });
                                            });
                                        </script>
                                        <div class="price-box">
                                            <span class="regular-price"><span class="special-price">
                                            <?php if($item->active == 1): ?>
                                                <?php echo e(number_format(($item->price*(100-$item->discount_percent))/100)); ?> đ
                                            <?php endif; ?>
                                            <?php if($item->active == 0 || $item->active == 2): ?>
                                                <?php echo e(number_format($item->price)); ?> đ
                                            <?php endif; ?>

                                        </span></span>
                                            <?php if($item->active == 1): ?>
                                                <span class="old-price"><del><?php echo e(number_format($item->price)); ?> đ</del></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div> <!-- end single grid item -->
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
               </div>
           </div>
       </div>
   </div>
   <!-- shop page main wrapper end -->

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
</html><?php /**PATH D:\xampp\htdocs\ThucTapTwo\resources\views/search-product.blade.php ENDPATH**/ ?>