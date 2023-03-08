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
                            <a href="#"><img src="assets/img/banner/category-image.jpg" alt=""></a>
                        </div>
                        
                        <div class="shop-product-wrap grid row">
                            
                            <?php $__currentLoopData = $shop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="product-item mb-30">
                                    <div class="product-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-4.jpg" class="pri-img" alt="">
                                            <img src="assets/img/product/product-11.jpg" class="sec-img" alt="">
                                        </a>
                                        <div class="box-label">
                                            <div class="label-product label_new">
                                                <span>new</span>
                                            </div>
                                            <div class="label-product label_sale">
                                                <span>-10%</span>
                                            </div>
                                        </div>
                                        <div class="action-links">
                                            <a href="#" title="Wishlist"><i class="lnr lnr-heart"></i></a>
                                            <a href="#" title="Compare"><i class="lnr lnr-sync"></i></a>
                                            <a href="#" title="Quick view" data-target="#quickk_view" data-toggle="modal"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-caption">
                                        <div class="manufacture-product">
                                            <p><a href="shop-grid-left-sidebar.html">apple</a></p>
                                        </div>
                                        <div class="product-name">
                                            <h4><a href="product-details.html">jony XB10 Portable  Wireless Speaker</a></h4>
                                        </div>
                                        <div class="ratings">
                                            <span class="yellow"><i class="lnr lnr-star"></i></span>
                                            <span class="yellow"><i class="lnr lnr-star"></i></span>
                                            <span class="yellow"><i class="lnr lnr-star"></i></span>
                                            <span class="yellow"><i class="lnr lnr-star"></i></span>
                                            <span><i class="lnr lnr-star"></i></span>
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price"><span class="special-price">£50.00</span></span>
                                            <span class="old-price"><del>£60.00</del></span>
                                        </div>
                                        <button class="btn-cart" type="button">add to cart</button>
                                    </div>
                                </div> <!-- end single grid item -->
                                <div class="sinrato-list-item mb-30">
                                    <div class="sinrato-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-7.jpg" class="pri-img" alt="">
                                            <img src="assets/img/product/product-3.jpg" class="sec-img" alt="">
                                        </a>
                                        <div class="box-label">
                                            <div class="label-product label_new">
                                                <span>new</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sinrato-list-item-content">
                                        <div class="manufacture-product">
                                            <span><a href="#">Canon</a></span>
                                        </div>
                                        <div class="sinrato-product-name">
                                            <h4><a href="product-details.html">Koss KPH7 Portable Headphone</a></h4>
                                        </div>
                                        <div class="sinrato-ratings mb-15">
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        </div>
                                        <div class="sinrato-product-des">
                                            <p>Stop your co-workers in their tracks with the stunning new 30-inch diagonal HP LP3065 Flat Panel Monitor. This flagship monitor features best-in-class performance and presentation features on a huge w..</p>
                                        </div>
                                    </div>
                                    <div class="sinrato-box-action">
                                        <div class="price-box">
                                            <span class="regular-price"><span class="special-price">£60.00</span></span>
                                            <span class="old-price"><del>£60.00</del></span>
                                        </div>
                                        <button class="btn-cart" type="button">add to cart</button>
                                        <div class="action-links sinrat-list-icon">
                                            <a href="#" title="Wishlist"><i class="lnr lnr-heart"></i></a>
                                            <a href="#" title="Compare"><i class="lnr lnr-sync"></i></a>
                                            <a href="#" title="Quick view" data-target="#quickk_view" data-toggle="modal"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                    </div>
                                </div> <!-- end single list item -->
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="paginatoin-area style-2 pt-35 pb-20">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="pagination-area">
                                        <p>Showing 1 to 9 of 9 (1 Pages)</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="pagination-box pagination-style-2">
                                        <li><a class="Previous" href="#">Previous</a>
                                        </li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li>
                                          <a class="Next" href="#"> Next </a>
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
   <!-- shop page main wrapper end -->

   <!-- scroll to top -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
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
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
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
                                                        <i class="fa fa-facebook"></i>
                                                        <span>like 0</span>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="bg-twitter" title="Twitter">
                                                        <i class="fa fa-twitter"></i>
                                                        <span>tweet</span>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="bg-google" title="Google Plus">
                                                        <i class="fa fa-google-plus"></i>
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
</html><?php /**PATH D:\xampp\htdocs\ThucTapTwo\resources\views/shop-all.blade.php ENDPATH**/ ?>