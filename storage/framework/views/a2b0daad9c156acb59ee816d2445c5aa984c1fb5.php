
<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from template.hasthemes.com/sinrato/sinrato/shop-grid-left-sidebar-4-column.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Sep 2021 00:25:51 GMT -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Page Title -->
	<title>Apple</title>
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
    <input type="hidden" name="" id="value_product" value="Apple">
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
                                <li class="breadcrumb-item active" aria-current="page">Apple</li>
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
               <div class="col-lg-3">
                    <div class="shop-sidebar-inner mb-30">
                        <!-- filter-price-content start -->
                        <div class="single-sidebar mb-45">
                            <div class="sidebar-inner-title mb-25">
                                <h3>Giá</h3>
                            </div>
                             <div class="sidebar-content-box"> 
                                 <div class="filter-price-content">
                                     
                                         
                                         <div class="filter-price-wapper">
                                            <input id="duoi10trieu" type="hidden" name="" value="10000000">
                                            <input id="btn_duoi10trieu" style="border:none; margin: 4px; cursor: pointer;" type="submit" value="Dưới 10.000.000">
                                            <input id="to20m" type="hidden" name="" value="20000000">
                                            <input id="btn_10mto20m" style="border:none; margin: 4px; cursor: pointer;" type="submit" value="Từ 10.000.000 đến 20.000.000">
                                            <input id="btn_on20m" style="border:none; margin: 4px; cursor: pointer;" type="submit" value="Trên 20.000.000">
                                             <div class="filter-price-cont">
                                                 <div class="input-type">
                                                     <input id="apdungFrom" style="border: 1px solid #fedc19; width: 100px;" id="" type="text">
                                                 </div>
                                                 -
                                                 <div class="input-type">
                                                     <input id="apdungTo" style="border: 1px solid #fedc19; width: 100px;" id="" type="text">
                                                 </div>
                                             </div>
                                             <input id="btn_Apdung" style="border: 1px solid #fedc19; color: #fedc19; background-color: white; cursor: pointer;" type="submit" value="Áp dụng">
                                         </div>
                                    
                                 </div> 
                             </div>
                        </div>

                        
                        <script>
                            $(document).ready(function(){
                                var value_product = $("#value_product").val();
                                //Dưới 10 triệu
                                $("#btn_duoi10trieu").click(function(){
                                    var duoi10trieu = $("#duoi10trieu").val();
                                    var value_product = $("#value_product").val();
                                    
                                    //Gui ajax
                                    $.ajax({
                                        url: "<?php echo e(route('under-10m')); ?>",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                            duoi10trieu: duoi10trieu,
                                            value_product: value_product
                                        },
                                        success: function(result){
                                            $("#show_result_filter").html(result);
                                        }
                                    });
                                });
                                //Hiển thị tất cả sẩn phẩm của apple
                                $.ajax({
                                    url: "<?php echo e(route('get-apple')); ?>",
                                    type: 'get',
                                    dataType: "text",
                                    data: {
                                        value_product: value_product
                                    },
                                    success: function(result){
                                        $("#show_result_filter").html(result);
                                    }
                                });
                                //Giá từ 10m-20m
                                $("#btn_10mto20m").click(function(){
                                    var from10m = $("#duoi10trieu").val();
                                    var to20m = $("#to20m").val();
                                    var value_product = $("#value_product").val();
                                    $.ajax({
                                        url: "<?php echo e(route('from10mto20m')); ?>",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                            value_product: value_product,
                                            from10m: from10m,
                                            to20m: to20m
                                        },
                                        success: function(result){
                                            $("#show_result_filter").html(result);
                                        }
                                    });
                                });
                                //Giá trên 20m
                                $("#btn_on20m").click(function(){
                                    var to20m = $("#to20m").val();
                                    var value_product = $("#value_product").val();

                                    $.ajax({
                                        url: "<?php echo e(route('on20m')); ?>",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                            value_product: value_product,
                                            to20m: to20m
                                        },
                                        success: function(result){
                                            $("#show_result_filter").html(result);
                                        }
                                    });
                                });
                                //Áp dụng
                                $("#btn_Apdung").click(function(){
                                    var value_product = $("#value_product").val();
                                    var apdungFrom = $("#apdungFrom").val();
                                    var apdungTo = $("#apdungTo").val();

                                    if(apdungFrom == ''){
                                        alert("Bạn chưa điền giá bắt đầu");
                                        return false;
                                    }

                                    if(apdungTo == ''){
                                        alert("Bạn chưa điền giá kết thúc");
                                        return false;
                                    }
                                    
                                    $.ajax({
                                        url: "<?php echo e(route('ap-dung-gia')); ?>",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                            value_product: value_product,
                                            apdungFrom: apdungFrom,
                                            apdungTo: apdungTo
                                        },
                                        success: function(result){
                                            $("#show_result_filter").html(result);
                                            $("#apdungFrom").val('');
                                            $("#apdungTo").val('');
                                        }
                                    });
                                });
                            });
                        </script>

                         <!-- filte price end -->
                         <!-- categories filter start -->
                         <div class="single-sidebar mb-45">
                             <div class="sidebar-inner-title mb-25">
                                 <h3>ROM</h3>
                             </div>
                             <div class="sidebar-content-box">
                                 <div class="">
                                     <ul>
                                         <li><a id="btn_32gb" style="cursor: pointer;">32GB</a></li>
                                         <li><a id="btn_64gb" style="cursor: pointer;">64GB</a></li>
                                         <li><a id="btn_128gb" style="cursor: pointer;">128GB</a></li>
                                         <li><a id="btn_256gb" style="cursor: pointer;">256GB</a></li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                         
                         <script>
                             $(document).ready(function(){
                                 //32GB
                                $("#btn_32gb").click(function(){
                                    var value_product = $("#value_product").val();
                                    var rom32gb = $(this).text();
                                    $("#btn_32gb").addClass("active");
                                    $("#btn_64gb").removeClass("active");
                                    $("#btn_128gb").removeClass("active");
                                    $("#btn_256gb").removeClass("active");
                                    //
                                    $("#btn_white").removeClass("active");
                                    $("#btn_blue").removeClass("active");
                                    $("#btn_black").removeClass("active");
                                    $("#btn_violet").removeClass("active");
                                    $("#btn_silver").removeClass("active");
                                    $("#btn_gray").removeClass("active");
                                    $.ajax({
                                        url: "<?php echo e(route('set-32gb')); ?>",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                            value_product: value_product,
                                            rom32gb: rom32gb
                                        },
                                        success: function(result){
                                            $("#show_result_filter").html(result);
                                        }
                                    });
                                });
                                //64GB
                                $("#btn_64gb").click(function(){
                                    var value_product = $("#value_product").val();
                                    var rom64gb = $(this).text();
                                    $("#btn_64gb").addClass("active");
                                    $("#btn_256gb").removeClass("active");
                                    $("#btn_128gb").removeClass("active");
                                    $("#btn_32gb").removeClass("active");
                                    //
                                    $("#btn_white").removeClass("active");
                                    $("#btn_blue").removeClass("active");
                                    $("#btn_black").removeClass("active");
                                    $("#btn_violet").removeClass("active");
                                    $("#btn_silver").removeClass("active");
                                    $("#btn_gray").removeClass("active");
                                    $.ajax({
                                        url: "<?php echo e(route('set-64gb')); ?>",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                            value_product: value_product,
                                            rom64gb: rom64gb
                                        },
                                        success: function(result){
                                            $("#show_result_filter").html(result);
                                        }
                                    });
                                });
                                //128GB
                                $("#btn_128gb").click(function(){
                                    var value_product = $("#value_product").val();
                                    var rom128gb = $(this).text();
                                    $("#btn_128gb").addClass("active");
                                    $("#btn_64gb").removeClass("active");
                                    $("#btn_256gb").removeClass("active");
                                    $("#btn_32gb").removeClass("active");
                                    //
                                    $("#btn_white").removeClass("active");
                                    $("#btn_blue").removeClass("active");
                                    $("#btn_black").removeClass("active");
                                    $("#btn_violet").removeClass("active");
                                    $("#btn_silver").removeClass("active");
                                    $("#btn_gray").removeClass("active");
                                    $.ajax({
                                        url: "<?php echo e(route('set-128gb')); ?>",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                            value_product: value_product,
                                            rom128gb: rom128gb
                                        },
                                        success: function(result){
                                            $("#show_result_filter").html(result);
                                        }
                                    });
                                });
                                //256GB
                                $("#btn_256gb").click(function(){
                                    var value_product = $("#value_product").val();
                                    var rom256gb = $(this).text();
                                    $("#btn_256gb").addClass("active");
                                    $("#btn_64gb").removeClass("active");
                                    $("#btn_128gb").removeClass("active");
                                    $("#btn_32gb").removeClass("active");
                                    //
                                    $("#btn_white").removeClass("active");
                                    $("#btn_blue").removeClass("active");
                                    $("#btn_black").removeClass("active");
                                    $("#btn_violet").removeClass("active");
                                    $("#btn_silver").removeClass("active");
                                    $("#btn_gray").removeClass("active");
                                    $.ajax({
                                        url: "<?php echo e(route('set-256gb')); ?>",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                            value_product: value_product,
                                            rom256gb: rom256gb
                                        },
                                        success: function(result){
                                            $("#show_result_filter").html(result);
                                        }
                                    });
                                });
                             });
                         </script>
                         <!-- categories filter end -->
                         <!-- categories filter start -->
                         
                         <!-- categories filter end -->
                         <!-- categories filter start -->
                         <div class="single-sidebar mb-45">
                             <div class="sidebar-inner-title mb-25">
                                 <h3>Màu</h3>
                             </div>
                             <div class="sidebar-content-box">
                                 <div class="filter-attribute-container">
                                     <ul>
                                         
                                         <li><a id="btn_white" style="cursor: pointer;">Trắng</a></li>
                                         <li><a id="btn_blue" style="cursor: pointer;">Xanh</a></li>
                                         <li><a id="btn_black" style="cursor: pointer;">Đen</a></li>
                                         <li><a id="btn_violet" style="cursor: pointer;">Tím</a></li>
                                         <li><a id="btn_silver" style="cursor: pointer;">Bạc</a></li>
                                         <li><a id="btn_gray" style="cursor: pointer;">Xám</a></li>
                                     </ul>
                                     <script>
                                         $(document).ready(function(){
                                             //Màu trắng
                                            $("#btn_white").click(function(){
                                                var white = $(this).text();
                                                var value_product = $("#value_product").val();
                                                $("#btn_white").addClass("active");
                                                $("#btn_blue").removeClass("active");
                                                $("#btn_black").removeClass("active");
                                                $("#btn_violet").removeClass("active");
                                                $("#btn_silver").removeClass("active");
                                                $("#btn_gray").removeClass("active");
                                                //
                                                $("#btn_32gb").removeClass("active");
                                                $("#btn_64gb").removeClass("active");
                                                $("#btn_128gb").removeClass("active");
                                                $("#btn_256gb").removeClass("active");
                                                $.ajax({
                                                    url: "<?php echo e(route('set-white')); ?>",
                                                    type: "get",
                                                    dataType: "text",
                                                    data: {
                                                        value_product: value_product,
                                                        white: white
                                                    },
                                                    success: function(result){
                                                        $("#show_result_filter").html(result);
                                                    }
                                                });
                                            });
                                            //Màu xanh
                                            $("#btn_blue").click(function(){
                                                var blue = $(this).text();                                           
                                                var value_product = $("#value_product").val();
                                                $("#btn_blue").addClass("active");
                                                $("#btn_white").removeClass("active");
                                                $("#btn_black").removeClass("active");
                                                $("#btn_violet").removeClass("active");
                                                $("#btn_silver").removeClass("active");
                                                $("#btn_gray").removeClass("active");
                                                //
                                                $("#btn_32gb").removeClass("active");
                                                $("#btn_64gb").removeClass("active");
                                                $("#btn_128gb").removeClass("active");
                                                $("#btn_256gb").removeClass("active");
                                                $.ajax({
                                                    url: "<?php echo e(route('set-blue')); ?>",
                                                    type: "get",
                                                    dataType: "text",
                                                    data: {
                                                        value_product: value_product,
                                                        blue: blue
                                                    },
                                                    success: function(result){
                                                        $("#show_result_filter").html(result);
                                                    }
                                                });
                                            });
                                            //Màu đen
                                            $("#btn_black").click(function(){
                                                var black = $(this).text();                                           
                                                var value_product = $("#value_product").val();
                                                $("#btn_black").addClass("active");
                                                $("#btn_white").removeClass("active");
                                                $("#btn_blue").removeClass("active");
                                                $("#btn_violet").removeClass("active");
                                                $("#btn_silver").removeClass("active");
                                                $("#btn_gray").removeClass("active");
                                                //
                                                $("#btn_32gb").removeClass("active");
                                                $("#btn_64gb").removeClass("active");
                                                $("#btn_128gb").removeClass("active");
                                                $("#btn_256gb").removeClass("active");
                                                $.ajax({
                                                    url: "<?php echo e(route('set-black')); ?>",
                                                    type: "get",
                                                    dataType: "text",
                                                    data: {
                                                        value_product: value_product,
                                                        black: black
                                                    },
                                                    success: function(result){
                                                        $("#show_result_filter").html(result);
                                                    }
                                                });
                                            });
                                            //Màu tím
                                            $("#btn_violet").click(function(){
                                                var violet = $(this).text();                                           
                                                var value_product = $("#value_product").val();
                                                $("#btn_violet").addClass("active");
                                                $("#btn_white").removeClass("active");
                                                $("#btn_blue").removeClass("active");
                                                $("#btn_black").removeClass("active");
                                                $("#btn_silver").removeClass("active");
                                                $("#btn_gray").removeClass("active");
                                                //
                                                $("#btn_32gb").removeClass("active");
                                                $("#btn_64gb").removeClass("active");
                                                $("#btn_128gb").removeClass("active");
                                                $("#btn_256gb").removeClass("active");
                                                $.ajax({
                                                    url: "<?php echo e(route('set-violet')); ?>",
                                                    type: "get",
                                                    dataType: "text",
                                                    data: {
                                                        value_product: value_product,
                                                        violet: violet
                                                    },
                                                    success: function(result){
                                                        $("#show_result_filter").html(result);
                                                    }
                                                });
                                            });
                                            //Màu bạc
                                            $("#btn_silver").click(function(){
                                                var silver = $(this).text();                                           
                                                var value_product = $("#value_product").val();
                                                $("#btn_silver").addClass("active");
                                                $("#btn_white").removeClass("active");
                                                $("#btn_blue").removeClass("active");
                                                $("#btn_black").removeClass("active");
                                                $("#btn_violet").removeClass("active");
                                                $("#btn_gray").removeClass("active");
                                                //
                                                $("#btn_32gb").removeClass("active");
                                                $("#btn_64gb").removeClass("active");
                                                $("#btn_128gb").removeClass("active");
                                                $("#btn_256gb").removeClass("active");
                                                $.ajax({
                                                    url: "<?php echo e(route('set-silver')); ?>",
                                                    type: "get",
                                                    dataType: "text",
                                                    data: {
                                                        value_product: value_product,
                                                        silver: silver
                                                    },
                                                    success: function(result){
                                                        $("#show_result_filter").html(result);
                                                    }
                                                });
                                            });
                                            //Màu xám
                                            $("#btn_gray").click(function(){
                                                var gray = $(this).text();                                           
                                                var value_product = $("#value_product").val();
                                                $("#btn_gray").addClass("active");
                                                $("#btn_white").removeClass("active");
                                                $("#btn_blue").removeClass("active");
                                                $("#btn_black").removeClass("active");
                                                $("#btn_violet").removeClass("active");
                                                $("#btn_silver").removeClass("active");
                                                //
                                                $("#btn_32gb").removeClass("active");
                                                $("#btn_64gb").removeClass("active");
                                                $("#btn_128gb").removeClass("active");
                                                $("#btn_256gb").removeClass("active");
                                                $.ajax({
                                                    url: "<?php echo e(route('set-gray')); ?>",
                                                    type: "get",
                                                    dataType: "text",
                                                    data: {
                                                        value_product: value_product,
                                                        gray: gray
                                                    },
                                                    success: function(result){
                                                        $("#show_result_filter").html(result);
                                                    }
                                                });
                                            });
                                         });
                                     </script>
                                 </div>
                             </div>
                         </div>
                    </div>
                     <!-- sidebar promote picture start -->
                     <div class="single-sidebar mb-30">
                         <div class="sidebar-thumb">
                             <a href="#"><img src="assets/img/banner/img-static-sidebar-change.jpg" alt=""></a>
                         </div>
                     </div>
                     <!-- sidebar promote picture end -->
               </div>
               <div class="col-lg-9 order-first order-lg-last">
                    <div class="product-shop-main-wrapper mb-50">
                        <div class="shop-baner-img mb-70">
                            <a href="#"><img src="assets/img/banner/category-image-change.jpg" alt=""></a>
                        </div>
                        
                        
                        <div id="show_result_filter" class="shop-product-wrap grid row">
                            
                            
                            
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

<!-- Mirrored from template.hasthemes.com/sinrato/sinrato/shop-grid-left-sidebar-4-column.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Sep 2021 00:25:51 GMT -->
</html>

<?php /**PATH D:\xampp\htdocs\baocaothuctap\resources\views/apple.blade.php ENDPATH**/ ?>