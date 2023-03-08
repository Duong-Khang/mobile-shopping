<?php

    if(Session::has('username')){
        $token = session('username');
    }else{
        $token = "guest";
    }

?>
<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from template.hasthemes.com/sinrato/sinrato/shop-grid-full-width-4-column.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Sep 2021 00:25:51 GMT -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Page Title -->
	<title>Shop</title>
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

    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
</head>
<body>
	<!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
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
    <!-- header area end -->

    <!-- breadcrumb area start -->
    <div class="breadcrumb-area mb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop</li>
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
                        <div class="shop-baner-img mb-70">
                            <a href="#"><img src="assets/img/banner/category-image-change.jpg" alt=""></a>
                        </div>
                        
                        <div class="shop-product-wrap grid row">
                            
                            <?php $__currentLoopData = $shop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div style="height: 380px;" class="product-item mb-30">
                                    <div class="product-thumb">
                                        <a href="chi-tiet-san-pham/<?php echo e($item->id); ?>">
                                            <img style="width: 200px; height: 200px;" src="product_images/<?php echo e($item->photo_name); ?>" class="pri-img" alt="">
                                            
                                        </a>
                                        <div class="box-label">
                                            
                                            
                                            
                                            
                                            <?php if($item->active == 1): ?>
                                            <div class="label-product label_sale">
                                                <span>-<?php echo e($item->discount_percent); ?>%</span>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                    <div class="product-caption">
                                        <div class="manufacture-product">
                                            <p><a href="shop-grid-left-sidebar.html"><?php echo e($item->manufacturer); ?></a></p>
                                        </div>
                                        <div class="product-name">
                                            <h4><a href="chi-tiet-san-pham/<?php echo e($item->id); ?>"><?php echo e($item->name); ?></a></h4>
                                        </div>
                                        <div id="show_star_<?php echo e($item->id); ?>" class="ratings">
                                            
                                        </div>
                                        <input type="hidden" name="" id="pid_<?php echo e($item->id); ?>" value="<?php echo e($item->id); ?>">
                                        <script>
                                            $(document).ready(function(){
                                                var pid = $("#pid_<?php echo e($item->id); ?>").val();
                                                $.ajax({
                                                    url: "<?php echo e(route('show-average-star')); ?>",
                                                    type: "get",
                                                    dataType: "text",
                                                    data: {
                                                        pid: pid
                                                    },
                                                    success: function(result){
                                                        $("#show_star_<?php echo e($item->id); ?>").html(result);
                                                        //alert(result);
                                                    }
                                                });
                                            });
                                        </script>
                                        <div class="price-box">
                                            <span class="regular-price"><span class="special-price">
                                                
                                                <?php if($item->active == 1): ?>
                                                    <?php echo e(number_format(($item->price*(100-$item->discount_percent))/100)); ?>đ                 
                                                <?php endif; ?>

                                                <?php if($item->active == 0): ?>
                                                    <?php echo e(number_format($item->price)); ?>đ
                                                <?php endif; ?>
                                            </span></span>
                                            <span class="old-price">
                                                <del>
                                                    
                                                    <?php if($item->active==1): ?>
                                                        <?php echo e(number_format($item->price)); ?>đ                       
                                                    <?php endif; ?>
                                                </del>
                                        </span>
                                        </div>
                                        
                                    </div>
                                </div> <!-- end single grid item -->
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="paginatoin-area style-2 pt-35 pb-20">
                            <div class="row">
                                
                                <div class="col-sm-6">
                                    <ul class="" style="float: right;">
                                        
                                        <li><?php echo $shop->links(); ?></li>
                                    </ul>
                                </div>
                                
                            </div>
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

    <!-- Quick view modal start -->
    <div class="modal fade" id="quickk_view">
        <div class="container">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider mb-20">
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-4.jpg" alt=""/>
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-5.jpg" alt=""/>
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-6.jpg" alt=""/>
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-7.jpg" alt=""/>
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-8.jpg" alt=""/>
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-9.jpg" alt=""/>
                                    </div>
                                </div>
                                <div class="pro-nav">
                                    <div class="pro-nav-thumb"><img src="assets/img/product/product-4.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="assets/img/product/product-5.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="assets/img/product/product-6.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="assets/img/product/product-7.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="assets/img/product/product-8.jpg" alt="" /></div>
                                    <div class="pro-nav-thumb"><img src="assets/img/product/product-9.jpg" alt="" /></div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-inner">
                                    <div class="product-details-contentt">
                                        <div class="pro-details-name mb-10">
                                            <h3>Bose SoundLink Bluetooth Speaker</h3>
                                        </div>
                                        <div class="pro-details-review mb-20">
                                            <ul>
                                                <li>
                                                    <span><i class="far fa-star"></i></span>
                                                    <span><i class="far fa-star"></i></span>
                                                    <span><i class="far fa-star"></i></span>
                                                    <span><i class="far fa-star"></i></span>
                                                    <span><i class="far fa-star"></i></span>
                                                </li>
                                                <li><a href="#">1 Reviews</a></li>
                                            </ul>
                                        </div>
                                        <div class="price-box mb-15">
                                            <span class="regular-price"><span class="special-price">£50.00</span></span>
                                            <span class="old-price"><del>£60.00</del></span>
                                        </div>
                                        <div class="product-detail-sort-des pb-20">
                                            <p>Canon's press material for the EOS 5D states that it 'defines (a) new D-SLR category', while we're not typically too concerned</p>
                                        </div>
                                        <div class="pro-details-list pt-20">
                                            <ul>
                                                <li><span>Availability :</span>In Stock</li>
                                            </ul>
                                        </div>
                                        <div class="product-availabily-option mt-15 mb-15">
                                            <h3>Available Options</h3>
                                            <div class="color-optionn">
                                                <h4><sup>*</sup>color</h4>
                                                <ul>
                                                    <li>
                                                        <a class="c-black" href="#" title="Black"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-blue" href="#" title="Blue"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-brown" href="#" title="Brown"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-gray" href="#" title="Gray"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-red" href="#" title="Red"></a>
                                                    </li>
                                                </ul> 
                                            </div>
                                        </div>
                                        <div class="pro-quantity-box mb-30">
                                            <div class="qty-boxx">
                                                <label>qty :</label>
                                                <input type="text" placeholder="0">
                                                <button class="btn-cart lg-btn">add to cart</button>
                                            </div>
                                        </div>
                                        <div class="pro-social-sharing">
                                            <label>share :</label>
                                            <ul>
                                                <li class="list-inline-item">
                                                    <a href="#" class="bg-facebook" title="Facebook">
                                                        <i class="fab fa-facebook"></i>
                                                        <span>like 0</span>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="bg-twitter" title="Twitter">
                                                        <i class="fab fa-twitter"></i>
                                                        <span>tweet</span>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="bg-google" title="Google Plus">
                                                        <i class="fab fa-google-plus"></i>
                                                        <span>google +</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick view modal end -->

	<!-- all js include here -->
    
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/ajax-mail.js"></script>
    <script src="assets/js/main.js"></script>
</body>

<!-- Mirrored from template.hasthemes.com/sinrato/sinrato/shop-grid-full-width-4-column.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Sep 2021 00:25:52 GMT -->
</html><?php /**PATH D:\xampp\htdocs\baocaothuctap\resources\views/shop.blade.php ENDPATH**/ ?>