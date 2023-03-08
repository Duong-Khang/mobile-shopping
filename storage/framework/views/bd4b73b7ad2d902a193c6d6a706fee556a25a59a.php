<?php

    if(Session::has('username')){
        $token = session('username');
    }else{
        $token = "guest";
    }

?>
<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from template.hasthemes.com/sinrato/sinrato/product-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Sep 2021 00:25:25 GMT -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Page Title -->
	<title>Chi tiết sản phẩm</title>
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
    <div class="breadcrumb-area mb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- product details wrapper start -->
    
    <?php $__currentLoopData = $product_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
    <input type="hidden" name="" id="pid" value="<?php echo e($item->id); ?>">
    <div class="product-details-main-wrapper pb-50">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="product-large-slider mb-20">
                        <div id="show_img_desc_large" class="pro-large-img">
                            <img src="<?php echo e(asset('product_images_desc')); ?>/<?php echo e($item->photo_color1); ?>" alt="" />
                            
                        </div>
                        
                        
                    </div>
                    <div class="pro-nav" id="show_img_desc_nav">
                        <div class="pro-nav-thumb"><img src="<?php echo e(asset('product_images_desc')); ?>/<?php echo e($item->photo_color1); ?>" alt="" /></div>
                        
                        
                        
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="product-details-inner">
                        <div class="product-details-contentt">
                            <div class="pro-details-name mb-10">
                                <h3><?php echo e($item->name); ?></h3>
                            </div>
                            <div class="pro-details-review mb-20">
                                <ul>
                                    
                                    <li id="show_star">
                                        
                                    </li>
                                    <li><a href="#"><span id="count_reviews">0</span> Nhận xét</a></li>
                                    
                                    <script>
                                        $(document).ready(function(){
                                            var pid = $("#pid").val();
                                            //Gửi ajax để đếm số nhận xét
                                            $.ajax({
                                                url: "<?php echo e(route('count-reviews')); ?>",
                                                type: "get",
                                                dataType: "text",
                                                data: {
                                                    pid: pid
                                                },
                                                success: function(result){
                                                    $("#count_reviews").html(result);
                                                }
                                            });

                                            //Hiển thị trung bình đánh giá
                                            $.ajax({
                                                url: "<?php echo e(route('show-average-star')); ?>",
                                                type: "get",
                                                dataType: "text",
                                                data: {
                                                    pid: pid
                                                },
                                                success: function(result){
                                                    $("#show_star").html(result);
                                                    //alert(result);
                                                }
                                            });
                                        });
                                    </script>
                                </ul>
                            </div>
                            <div class="price-box mb-15">
                                <?php if($item->active == 1): ?>
                                    <span class="regular-price"><span id="show_price_new" class="special-price"><?php echo e(number_format(($item->price_color1*(100 - $item->discount_percent))/100)); ?>đ</span></span>
                                <?php endif; ?>
                                <?php if($item->active == 0): ?>
                                    <span class="regular-price"><span id="show_price_new" class="special-price"><?php echo e(number_format($item->price_color1)); ?>đ</span></span>
                                <?php endif; ?>
                                <?php if($item->active == 1): ?>
                                <span class="old-price"><del id="show_price_old"><?php echo e(number_format($item->price_color1)); ?>đ</del></span>
                                <?php endif; ?>
                                
                                <?php $__currentLoopData = $product_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $psitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class=""><span class="special-price"> 
                                        <?php if($psitem->active == 1): ?>
                                            -<?php echo e($psitem->discount_percent); ?>%
                                        <?php endif; ?>    
                                    </span></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                            <?php $__currentLoopData = $color; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="product-detail-sort-des pb-20">
                                    <p><?php echo e($mitem->small_desc); ?></p>
                                </div>
                            
                            <div class="pro-details-list pt-20">
                                <ul>
                                    <li><span>RAM :</span><?php echo e($mitem->ram); ?></li>
                                    <li><span>ROM :</span><?php echo e($mitem->rom); ?></li>
                                    <li><span>Chip GPU :</span><?php echo e($mitem->chip_gpu); ?></li>
                                    <li><span>Chip set :</span><?php echo e($mitem->chip_set); ?></li>
                                    <li><span>Độ phân giải :</span><?php echo e($mitem->sr); ?></li>
                                    <?php $__currentLoopData = $inventory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><span>Số lượng trong kho :</span><?php echo e($iitem->quantity); ?> sản phẩm</li>
                                        <input id="inventory" type="hidden" name="" value="<?php echo e($iitem->quantity); ?>">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            <div class="product-availabily-option mt-15 mb-15">
                                
                                <div class="color-optionn">
                                    <h4><sup>*</sup>Màu: <span id="updateColor"></span></h4>
                                    <ul>
                                        
                                        <?php $__currentLoopData = $color; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $citem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($citem->color1 != NULL): ?>
                                            <li id="btn_color1" style="border: none; cursor: pointer;">
                                                <a style="background-color: <?php echo e($citem->color1); ?>" class="" style="cursor: pointer;" id="" title="<?php echo e($citem->dcolor1); ?>"></a>
                                                <input type="hidden" name="" id="color1" value="<?php echo e($citem->dcolor1); ?>">
                                            </li>
                                            <?php endif; ?>
                                        
                                            <?php if($citem->color2 != NULL): ?>
                                                <li id="btn_color2" style="border: none; cursor: pointer;">
                                                    <a style="background-color: <?php echo e($citem->color2); ?>" class="" style="cursor: pointer;" id="" title="<?php echo e($citem->dcolor2); ?>"></a>
                                                    <input type="hidden" name="" id="color2" value="<?php echo e($citem->dcolor2); ?>">
                                                </li>
                                            <?php endif; ?>
                                            
                                            <?php if($citem->color3 != NULL): ?>
                                                <li id="btn_color3" style="border: none; cursor: pointer;">
                                                    <a style="background-color: <?php echo e($citem->color3); ?>" class="" style="cursor: pointer;" id="" title="<?php echo e($citem->dcolor3); ?>"></a>
                                                    <input type="hidden" name="" id="color3" value="<?php echo e($citem->dcolor3); ?>">
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                        
                                        
                                    </ul> 
                                </div>
                            </div>
                            
                            <div class="pro-quantity-box mb-30">
                                <span style="color: tomato;" id="showErrorQuantity"></span>
                                <div class="qty-boxx">
                                    
                                    <label>Số lượng :</label>
                                    <input id="SoLuongMain" type="text" value="1" placeholder="0">
                                    <button id="btn_addToCartMain" data-toggle="modal" class="btn-cart lg-btn">Thêm vào giỏ</button>
                                </div>
                            </div>
                            <div class="useful-links mb-20">
                                <ul>
                                    
                                    
                                </ul>
                            </div>
                            <div class="tag-line mb-20">
                                <label>Mục :</label>
                                <?php if($item->manufacturer == "Apple"): ?>
                                    <a href="<?php echo e(route('apple')); ?>"><?php echo e($item->manufacturer); ?></a>
                                <?php elseif($item->manufacturer == "Xiaomi"): ?>
                                    <a href="<?php echo e(route('xiaomi')); ?>"><?php echo e($item->manufacturer); ?></a>
                                <?php elseif($item->manufacturer == "Samsung"): ?>
                                    <a href="<?php echo e(route('samsung')); ?>"><?php echo e($item->manufacturer); ?></a>
                                <?php elseif($item->manufacturer == "Oppo"): ?>
                                    <a href="<?php echo e(route('oppo')); ?>"><?php echo e($item->manufacturer); ?></a>
                                <?php elseif($item->manufacturer == "Vsmart"): ?>
                                    <a href="<?php echo e(route('vsmart')); ?>"><?php echo e($item->manufacturer); ?></a>
                                <?php endif; ?>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product details wrapper end -->

    <!-- product details reviews start -->
            
    <script>
        //Tiến hành xử lý add to cart
        $(document).ready(function(){
            //Khi người mua nhấn nút Thêm vào giỏ
            var color = $("#color1").val();
            var pid = $("#pid").val();//Lấy id của product
                //Gửi ajax large
                $.ajax({
                    url: "<?php echo e(route('set-color-desc-large')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_img_desc_large").html(result);
                    }
                });
                //Gửi ajax mini
                $.ajax({
                    url: "<?php echo e(route('set-color-desc-nav')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_img_desc_nav").html(result);
                    }
                });

                //Cập nhật giá cũ theo màu
                $.ajax({
                    url: "<?php echo e(route('set-price-desc-large')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_price_old").html(result);
                    }
                });
                 //Cập nhật giá mới theo màu
                 $.ajax({
                    url: "<?php echo e(route('set-price-desc-nav')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_price_new").html(result);
                        //alert(result);
                    }
                });
            //Màu mặc định khi user vào page
            $("#btn_color1").css("opacity", "0.5");
            $("#btn_color1").css("border", "1px solid blue");
            $("#btn_color2").css("opacity", "1");
            $("#btn_color3").css("opacity", "1");
            $("#updateColor").text(color);
            //Xử lý lấy màu
            $("#btn_color1").click(function(){
                color = $("#color1").val();
                $("#btn_color1").css("opacity", "0.5");
                $("#btn_color1").css("border", "1px solid blue");
                //alert(color);
                $("#btn_color2").css("opacity", "1");
                $("#btn_color3").css("opacity", "1");
                $("#updateColor").text(color);
                $("#btn_color3").css("border", "none");
                $("#btn_color2").css("border", "none");
                //Thay đổi màu ảnh hiển thị và giá
                var pid = $("#pid").val();//Lấy id của product
                //Gửi ajax large
                $.ajax({
                    url: "<?php echo e(route('set-color-desc-large')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_img_desc_large").html(result);
                    }
                });
                //Gửi ajax mini
                $.ajax({
                    url: "<?php echo e(route('set-color-desc-nav')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_img_desc_nav").html(result);
                    }
                });
                //Cập nhật giá cũ theo màu
                $.ajax({
                    url: "<?php echo e(route('set-price-desc-large')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_price_old").html(result);
                    }
                });
                 //Cập nhật giá mới theo màu
                 $.ajax({
                    url: "<?php echo e(route('set-price-desc-nav')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_price_new").html(result);
                    }
                });
            });
            $("#btn_color2").click(function(){
                color = $("#color2").val();
                $("#btn_color2").css("border", "1px solid blue");
                $("#btn_color2").css("opacity", "0.5");
                $("#btn_color1").css("opacity", "1");
                $("#btn_color3").css("opacity", "1");
                $("#updateColor").text(color);
                $("#btn_color3").css("border", "none");
                $("#btn_color1").css("border", "none");
                //Thay đổi màu ảnh hiển thị và giá
                var pid = $("#pid").val();//Lấy id của product
                //Gửi ajax large
                $.ajax({
                    url: "<?php echo e(route('set-color-desc-large')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_img_desc_large").html(result);
                    }
                });
                //Gửi ajax mini
                $.ajax({
                    url: "<?php echo e(route('set-color-desc-nav')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_img_desc_nav").html(result);
                    }
                });

                //Cập nhật giá cũ theo màu
                $.ajax({
                    url: "<?php echo e(route('set-price-desc-large')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_price_old").html(result);
                    }
                });
                 //Cập nhật giá mới theo màu
                 $.ajax({
                    url: "<?php echo e(route('set-price-desc-nav')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_price_new").html(result);
                        //alert(result);
                    }
                });
            });
            $("#btn_color3").click(function(){
                color = $("#color3").val();
                $("#btn_color3").css("border", "1px solid blue");
                $("#btn_color3").css("opacity", "0.5");
                $("#btn_color2").css("opacity", "1");
                $("#btn_color1").css("opacity", "1");
                $("#updateColor").text(color);
                $("#btn_color2").css("border", "none");
                $("#btn_color1").css("border", "none");
                
                //Thay đổi màu ảnh hiển thị và giá
                var pid = $("#pid").val();//Lấy id của product
                //Gửi ajax large
                $.ajax({
                    url: "<?php echo e(route('set-color-desc-large')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_img_desc_large").html(result);
                    }
                });
                //Gửi ajax mini
                $.ajax({
                    url: "<?php echo e(route('set-color-desc-nav')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_img_desc_nav").html(result);
                    }
                });

                //Cập nhật giá cũ theo màu
                $.ajax({
                    url: "<?php echo e(route('set-price-desc-large')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_price_old").html(result);
                    }
                });
                 //Cập nhật giá mới theo màu
                 $.ajax({
                    url: "<?php echo e(route('set-price-desc-nav')); ?>",
                    type: "get",
                    dataType: "text",
                    data: {
                        pid: pid,
                        color: color
                    },
                    success: function(result){
                        $("#show_price_new").html(result);
                    }
                });
            });
            //alert(color);
            $("#SoLuongMain").focus(function(){
                $("#showErrorQuantity").text('');
            });
            $("#btn_addToCartMain").click(function(){
                $("#btn_addToCartMain").removeAttr("data-target");
                //Kiểm tra xem có đăng nhập chưa
                var token = $("#userLogin").val();
                if(token != "guest"){
                    //alert("Đăng nhập rồi");
                    //Lấy số lượng, id, customer, màu
                    var quantity = $("#SoLuongMain").val();
                    quantity = Number(quantity);
                    //Số lượng k dc < 0
                    if(quantity <= 0){
                        $("#showErrorQuantity").text("Số lượng phải lớn hơn không");
                        return false;
                    }
                    //Số lượng < số lượng trong kho
                    var inventory = $("#inventory").val();
                    if(Number.isInteger(quantity)){
                        if(quantity > inventory){
                            $("#showErrorQuantity").text("Sản phẩm trong kho không đủ");
                            return false;
                        }
                    }
                    
                    //Số lượng phải là số nguyên
                    if(!Number.isInteger(quantity)){
                        $("#showErrorQuantity").text("Số lượng không hợp lệ");
                        return false;
                    }
                    var pid = $("#pid").val();
                    
                    //Tiến hành gửi ajax
                    $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "<?php echo e(route('AddToCart')); ?>",
                        type: "get",
                        dataType: "text",
                        data : {
                            pid: pid,
                            quantity: quantity,
                            token: token,
                            color: color
                        },
                        success : function (result){
                            //alert(result);
                            if(result != "error"){
                                //alert("Thêm vào giỏ thành công");
                                $("#msg_success").text("Thêm vào giỏ thành công");
                                $(document).scrollTop(0);
                                $("#cartHover").css("display", "block");
                                var customer = $("#userLogin").val();
                                //alert(customer);
                                $.ajax({
                                    url: "<?php echo e(route('update-quantity')); ?>",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                        customer: customer
                                    },
                                    success: function(result_quantity){
                                        //alert(result);
                                        $("#quantity_cart_hover").html(result_quantity);
                                    }
                                });
                            }else{
                                alert("Thêm vào giỏ thất bại");
                            }
                        }
                    });
                }else{
                    //alert("Chưa đăng nhập");
                    //Hiển thị form cho đang nhập
                    $("#form_id").show();
                }
            });
        });
    </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    

    
    <!--  Start related-product -->
    <div class="related-product-area mb-40">
        <div class="container-fluid">
            <div class="section-title">
                <h3>Sản phẩm <span>tương tự</span></h3>
            </div>
            <div class="flash-sale-active4 owl-carousel owl-arrow-style">
                
                <?php $__currentLoopData = $relate_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ritem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <div style="height: 420px;" class="product-item mb-30">
                    <div class="product-thumb">
                        <a href="<?php echo e($ritem->id); ?>">
                            <img style="width: 200px; height: 200px;" src="<?php echo e(asset('product_images')); ?>/<?php echo e($ritem->photo_name); ?>" class="pri-img" alt="">
                            <img style="width: 200px; height: 200px;" src="<?php echo e(asset('product_images')); ?>/<?php echo e($ritem->photo_name); ?>" class="sec-img" alt="">
                        </a>
                        <div class="box-label">
                            
                            
                            
                            <div class="label-product label_sale">
                                
                                <?php if($ritem->active == 1): ?>
                                <span>-<?php echo e($ritem->discount_percent); ?>%</span>
                                <?php endif; ?>
                                
                            </div>    
                        </div>
                        
                    </div>
                    <div class="product-caption">
                        <div class="manufacture-product">
                            <p><a href="shop-grid-left-sidebar.html"><?php echo e($ritem->manufacturer); ?></a></p>
                        </div>
                        <div class="product-name">
                            <h4><a href="<?php echo e($ritem->id); ?>"><?php echo e($ritem->name); ?></a></h4>
                        </div>
                        <div id="show_star_<?php echo e($ritem->id); ?>" class="ratings">
                            
                        </div>
                        <input type="hidden" name="" id="pid_<?php echo e($ritem->id); ?>" value="<?php echo e($ritem->id); ?>">
                        <script>
                            $(document).ready(function(){
                                var pid = $("#pid_<?php echo e($ritem->id); ?>").val();
                                $.ajax({
                                    url: "<?php echo e(route('show-average-star')); ?>",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                        pid: pid
                                    },
                                    success: function(result){
                                        $("#show_star_<?php echo e($ritem->id); ?>").html(result);
                                        //alert(result);
                                    }
                                });
                            });
                        </script>
                        <div class="price-box">
                            <span class="regular-price"><span class="special-price">
                                
                                <?php if($ritem->active == 1): ?>
                                    <?php echo e(number_format(($ritem->price*(100-$ritem->discount_percent))/100)); ?>đ
                                <?php endif; ?>

                                <?php if($ritem->active == 0): ?>
                                    <?php echo e(number_format($ritem->price)); ?>đ
                                <?php endif; ?>
                            </span></span>
                            <?php if($ritem->active == 1): ?>
                                <span class="old-price"><del><?php echo e($ritem->price); ?>đ</del></span>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div><!-- </div> end single item -->
                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </div>
        </div>
    </div> 
    <!--  end related-product -->

    
    <div class="product-details-reviews pb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-info mt-half">
                        <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="nav_desctiption" data-toggle="pill" role="tab" aria-controls="tab_description" aria-selected="true">Mô tả chi tiết sản phẩm</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <?php $__currentLoopData = $product_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemReviews): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $itemReviews->desc; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="product-details-reviews pb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-info mt-half">
                        <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="nav_desctiption" data-toggle="pill" role="tab" aria-controls="tab_description" aria-selected="true">Đánh giá - nhận xét từ khách hàng</a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-review">
                        <div id="show_reviews" class="customer-review">
                            
                            
                        </div> <!-- end of customer-review -->

                        <script>
                            //Show reviews
                            $(document).ready(function(){
                                var pid = $("#pid").val();

                                $.ajax({
                                    url: "<?php echo e(route('show-reviews')); ?>",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                        pid: pid
                                    },
                                    success: function(result){
                                        $("#show_reviews").html(result);
                                    }
                                });
                            });
                        </script>

                        <form id="form_reviews" class="review-form">
                            <h2>Viết nhận xét</h2>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="col-form-label"><span class="text-danger">*</span> Nhận xét của bạn</label>
                                    <textarea class="form-control" id="content_reviews" required></textarea>
                                </div>
                            </div>
                            <div id="rating_active" class="form-group row">
                                <div class="col">
                                    <label class="col-form-label"><span class="text-danger">*</span> Đánh giá</label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="hidden" id="value_verypoor" value="1">
                                    <i style="cursor: pointer; color: yellow;" id="rating_verypoor" class="far fa-star"></i>
                                    &nbsp;
                                    <input type="hidden" id="value_poor" value="2">
                                    <i style="cursor: pointer;color: yellow;" id="rating_poor" class="far fa-star"></i>
                                    &nbsp;
                                    <input type="hidden" id="value_average" value="3">
                                    <i style="cursor: pointer;color: yellow;" id="rating_average" class="far fa-star"></i>
                                    &nbsp;
                                    <input type="hidden" id="value_good" value="4">
                                    <i style="cursor: pointer;color: yellow;" id="rating_good" class="far fa-star"></i>
                                    &nbsp;
                                    <input type="hidden" id="value_excellent" value="5">
                                    
                                    <i style="cursor: pointer;color: yellow;" id="rating_excellent" class="far fa-star"></i>
                                    &nbsp;<span id="rating_choose">Excellent</span>
                                </div>
                            </div>
                            <div class="buttons">
                                <button id="btn_reviews" class="btn-cart rev-btn" type="submit">Đăng</button>
                            </div>
                        </form> <!-- end of review-form -->
                    </div> <!-- end of product-review -->
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            //Kiểm tra xem user đã đánh giá sản phẩm chưa
            var user = $("#userLogin").val();
            var pid = $("#pid").val();
            $.ajax({
                url: "<?php echo e(route('check-rating')); ?>",
                type: "get",
                dataType: "text",
                data: {
                    user: user,
                    pid: pid
                },
                success: function(result){
                    if(result == "rated"){
                        $("#rating_active").hide();
                    }else{

                    }
                }
            });
            //Khi nhấn nút Đăng
            $("#form_reviews").submit(function(){
                return false;
            });
            var rating = $("#value_excellent").val();
            //Lấy số sao đánh giá
            $("#rating_verypoor").click(function(){
                rating = $("#value_verypoor").val();
                $("#rating_choose").text("Very poor");
            });
            $("#rating_poor").click(function(){
                rating = $("#value_poor").val();
                $("#rating_choose").text("Poor");
            });
            $("#rating_average").click(function(){
                rating = $("#value_average").val();
                $("#rating_choose").text("Average");
            });
            $("#rating_good").click(function(){
                rating = $("#value_good").val();
                $("#rating_choose").text("Good");
            });
            $("#rating_excellent").click(function(){
                rating = $("#value_excellent").val();
                $("#rating_choose").text("Excellent");
            });
            $("#btn_reviews").click(function(){
                //Lấy nội dung reviews
                var content = $("#content_reviews").val();
                if(content == ''){
                    alert("Bạn chưa nhập nội dung!");
                    return false;
                }
                //alert(content);
                //alert(rating);
                var user = $("#userLogin").val();
                //alert(user);
                var pid = $("#pid").val();
                //alert(pid);
                //Kiểm tra xem user đã đăng nhập chưa
                if(user !== "guest"){
                    //Đã login
                    //alert("Logined");
                    //Gửi ajax insert vào table feedback
                    $.ajax({
                        url: "<?php echo e(route('set-reviews')); ?>",
                        type: "get",
                        dataType: "text",
                        data: {
                            pid: pid,
                            user: user,
                            content: content,
                            rating: rating
                        },
                        success: function(result){
                            if(result !== "success"){
                                alert(result);
                            }else{
                                //Ẩn mục rating đi
                                $("#rating_active").hide();
                                $("#content_reviews").val('');

                                //Cập nhật show reviews
                                var pid = $("#pid").val();
                                $.ajax({
                                    url: "<?php echo e(route('show-average-star')); ?>",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                        pid: pid
                                    },
                                    success: function(result){
                                        $("#show_star").html(result);
                                        //alert(result);
                                    }
                                });
                                //Gửi ajax
                                $.ajax({
                                    url: "<?php echo e(route('count-reviews')); ?>",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                        pid: pid
                                    },
                                    success: function(result){
                                        $("#count_reviews").html(result);
                                    }
                                });
                                $.ajax({
                                    url: "<?php echo e(route('show-reviews')); ?>",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                        pid: pid
                                    },
                                    success: function(result){
                                        $("#show_reviews").html(result);
                                    }
                                });
                            }
                        }
                    });
                }else{
                    //alert("Chưa login");
                    $("#form_id").show();
                }
            });
        });
    </script>
    

   <!-- scroll to top -->
    <div class="scroll-top not-visible">
        <i class="fas fa-angle-up"></i>
    </div> <!-- /End Scroll to Top -->

    <!-- footer area start -->  
    <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- footer area end -->

    <!-- Quick view modal start -->
    

	<!-- all js include here -->
    
    <script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/ajax-mail.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>

</body>

<!-- Mirrored from template.hasthemes.com/sinrato/sinrato/product-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Sep 2021 00:25:25 GMT -->
</html>

<script>
    //Hiển thị qua lại giữa form đăng ký và đăng nhập
    $("#form_id").hide();
    $("#form_id_register").hide();
    $(document).ready(function(){
        //Đăng nhập
        $("#btn_login_quick").click(function(){
            $("#form_id").show();
        });

        $("#btn_close_form_login_quick").click(function(){
            $("#form_id").hide();
        });

        $("#btn_close_form_login_quick_cancel").click(function(){
            $("#form_id").hide();
        });
        //Đăng ký
        $("#btn_register_quick").click(function(){
            $("#form_id_register").show();
        });

        $("#btn_close_form_register_quick").click(function(){
            $("#form_id_register").hide();
        });

        $("#btn_close_form_register_quick_cancel").click(function(){
            $("#form_id_register").hide();
        });

        $("#change_register").click(function(){
            $("#form_id_register").show();
            $("#form_id").hide();
        });

        $("#change_login").click(function(){
            $("#form_id").show();
            $("#form_id_register").hide();
        })
    });
</script>



<div style="z-index: 2000" id="form_id" class="modal">
  
  <form class="modal-content animate" id="form_login_quick">
    <div class="imgcontainer">
        <h2 class="modal-header">Đăng Nhập Để Mua Hàng</h2>
      <span id="btn_close_form_login_quick" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
        <div class="user-form">
            <label class="user-form__label" for="username_login_quick">
                <i class="fas fa-user"></i>
                <b>Tài khoản</b>
            </label>
            <input class="user-form__input" type="text" placeholder="Username" name="uname" id="username_login_quick">
        </div>

        <div class="user-form">
            <label class="user-form__label" for="password_login_quick">
                <i class="fas fa-key"></i>
                <b>Mật khẩu</b>
            </label>
            <input class="user-form__input" type="password" placeholder="Password" name="psw" id="password_login_quick">
        </div>

        <div class="psw-wrap">
            <span class="psw1">
                <a href="#">Quên mật khẩu?</a>
            </span>
            <span class="psw2">
                Bạn mới đến shop? <a id="change_register">Đăng ký</a>
            </span>
        </div>
        
        <button class="form-btn" id="btn_login_quick_submit" type="submit">Đăng nhập</button>
      
    </div>

    <!-- <div class="container">
      <button id="btn_close_form_login_quick_cancel" class="cancelbtn">Cancel</button>
    </div> -->
  </form>
</div>

<style>
    .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}
.modal-content {
  background-color: #fff;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Đăng nhập */
.imgcontainer{
    position: relative;
    background-color: #fedc19;
    border-radius: 0.3rem;
}
.modal-header{
    color: white;
    justify-content: center;
    padding: 24px 0;
}

.close{
    position: absolute;
    top: 0;
    right: 0;
    color: #fff;
    padding: 8px;
    font-size: 2rem;
    opacity: 1;
}

.user-form__label{
    display: inline-block;
    font-size: 1rem;
    color: black;
    margin-top: 15px;
    cursor: pointer;
}

.user-form__input{
    margin-top: 5px;
    width: 100%;
    padding: 4px;
    border: 1px solid #ddd;
    border-radius: 3px;
}

.user-form__input:focus{
    border: 1px solid black;
}

.psw-wrap{
    margin-top: 10px;
}

.psw-wrap .psw2{
    float: right;
}

.psw-wrap .psw a,
.psw-wrap .psw2 a{
    color: #fedc19;
}

.psw-wrap .psw a:hover,
.psw-wrap .psw2 a:hover {
    color: #fedc19;
    cursor: pointer;
}

.form-btn{
    width: 20%;
    margin-top: 10px;
    margin-bottom: 15px;
    padding: 5px;
    color: #fff;
    background-color: #fedc19;
    font-size: 1rem;
    border: none;
    border-radius: 3px;
}

.form-btn:hover{
    cursor: pointer;
    opacity: 0.8;
}

</style>




<div style="z-index: 2000" id="form_id_register" class="modal">
  
  <form class="modal-content animate" id="form_register_quick">
    <div class="imgcontainer">
        <h2 class="modal-header">Đăng Ký</h2>
      <span id="btn_close_form_register_quick" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
        <div class="user-form">
            <label class="user-form__label" for="username_register_quick">
                <i class="fas fa-user"></i>
                <b>Tài khoản</b>
            </label>
            <input class="user-form__input" type="text" placeholder="Username" name="uname" id="username_register_quick" required>
        </div>

        <div class="user-form">
            <label class="user-form__label" for="password_register_quick">
                <i class="fas fa-key"></i>
                <b>Mật khẩu</b>
            </label>
            <input class="user-form__input" type="password" placeholder="Password" name="psw" id="password_register_quick" required> 
        </div>

        <div class="user-form">
            <label class="user-form__label" for="cpassword_register_quick">
                <i class="fas fa-check-circle"></i>
                <b>Xác nhận mật khẩu</b>
            </label>
            <input class="user-form__input" type="password" placeholder="Confirm Password" name="psw" id="cpassword_register_quick" required>
        </div>
        <div class="psw-wrap">
            <span class="psw">
                Bạn đã có tài khoản? <a id="change_login">Đăng nhập</a>
            </span>
        </div>
        
        <button class="form-btn" id="btn_register_quick_submit" type="submit">Đăng ký</button>
      
    </div>

    <!-- <div class="container" style="background-color:#f1f1f1">
      <button id="btn_close_form_register_quick_cancel" class="cancelbtn">Cancel</button>
    </div> -->
  </form>
</div>


<script>
    $(document).ready(function(){
        $("#form_login_quick").submit(function(){
            return false;
        });
        $("#form_register_quick").submit(function(){
            return false;
        })
        //login
        $("#btn_login_quick_submit").click(function(){
            //Lấy username
            var username = $("#username_login_quick").val();
            //Lấy password
            var password = $("#password_login_quick").val()
    
            //Gửi ajax
            $.ajax({
                url: "<?php echo e(route('login-quick')); ?>",
                type: "get",
                dataType: "text",
                data: {
                    username: username,
                    password: password
                },
                success: function(result){
                    if(result !== "error"){
                        $("#show_check_login").hide();
                        $("#show_info_login_quick").html(result);
                        $("#show_check_login_success").show();
                        $("#form_id").hide();
                        $("#userLogin").val(result);
                        //alert("result");
                    }else{  
                        alert("Đăng nhập thất bại");
                    }
                }
            });
        });
        //Signup
        $("#btn_register_quick_submit").click(function(){
            //Lấy username, password, confirm password
            var username = $("#username_register_quick").val();

            var password = $("#password_register_quick").val();

            var cpassword = $("#cpassword_register_quick").val();

            $.ajax({
                url: "<?php echo e(route('register-quick')); ?>",
                type: "get",
                dataType: "text",
                data: {
                    username: username,
                    password: password,
                    cpassword: cpassword
                },
                success: function(result){
                    if(username === result){
                        $("#show_check_login").hide();
                        $("#show_info_login_quick").html(result);
                        $("#show_check_login_success").show();
                        $("#form_id_register").hide();
                        $("#userLogin").val(result);
                    }else{
                        alert(result);
                    }
                }
            });
        });
    });
</script><?php /**PATH D:\Program Files\XamPP\htdocs\ThucTapTwo\resources\views/product-details.blade.php ENDPATH**/ ?>