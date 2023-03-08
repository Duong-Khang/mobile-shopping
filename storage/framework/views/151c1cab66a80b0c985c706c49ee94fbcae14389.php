<?php
    include "../Admin/connect.php";
    if(isset($_GET['pid']) && $_GET['pid'] != ''){
        $pid = $_GET['pid'];
    }else{
        $pid = "no pid";
    }

?>
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
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Page Title -->
	<title>Chi tiết sản phẩm</title>
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
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
	<!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
    <input type="hidden" id="pid" value="<?php echo $pid ?>">
    <input type="hidden" name="" id="userLogin" value="<?php echo e($token); ?>">
    <!-- header area start -->
    <header class="header-pos">
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
    <?php
        $sql = "SELECT product.*, description.*, product.id AS pid, description.id AS did
        FROM product
        INNER JOIN description ON product.id=description.product_id
        WHERE product.id='$pid'
        ";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $cate = $row['manufacturer'];
            $desc = $row['desc'];
    ?>
    <div class="product-details-main-wrapper pb-50">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="product-large-slider mb-20">
                        <div class="pro-large-img">
                            <img src="product_images_desc/<?php echo $row['photo_color1'] ?>" alt="" />
                            <div class="img-view">
                                <a class="img-popup" href="product_images_desc/<?php echo $row['photo_color1'] ?>"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="pro-nav">
                        <div class="pro-nav-thumb"><img src="product_images_desc/<?php echo $row['photo_color1'] ?>" alt="" /></div>   
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="product-details-inner">
                        <div class="product-details-contentt">
                            <div class="pro-details-name mb-10">
                                <h3><?php echo $row['name'] ?></h3>
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
                                <p>Canon's press material for the EOS 5D states that it 'defines (a) new D-SLR category', while we're not typically too concerned with marketing talk this particular statement is clearly pretty accurate...</p>
                            </div>
                            <div class="pro-details-list pt-20">
                                <ul>
                                    <li><span>Ex Tax :</span>£60.24</li>
                                    <li><span>Brands :</span><a href="#">Canon</a></li>
                                    <li><span>Product Code :</span>Digital</li>
                                    <li><span>Reward Points :</span>200</li>
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
                            <div class="useful-links mb-20">
                                <ul>
                                    <li>
                                        <a href="#"><i class="fa fa-heart-o"></i>add to wish list</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-refresh"></i>compare this product</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tag-line mb-20">
                                <label>tag :</label>
                                <a href="#">Movado</a>,
                                <a href="#">Omega</a>
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
    <?php
        }
    ?>
    <!-- product details wrapper end -->
    <!--  Start related-product -->
    <div class="related-product-area mb-40">
        <div class="container-fluid">
            <div class="section-title">
                <h3>Sản phẩm<span> liên quan</span></h3>
            </div>
            <div class="flash-sale-active4 owl-carousel owl-arrow-style">
                <?php
                    $sqlRelate = "SELECT product.*, description.*, product.id AS pid, description.id AS did
                    FROM product
                    INNER JOIN description ON product.id=description.product_id
                    WHERE product.id != '$pid' AND product.manufacturer LIKE '$cate'
                    ";
                    $resultRelate = $conn->query($sqlRelate);
                    if($resultRelate->num_rows>0){
                        while ($rowRelate = $resultRelate->fetch_assoc()) {
                ?>
                <div class="product-item mb-30">
                    <div class="product-thumb">
                        <a href="product-details.html">
                            <img src="product_images_desc/<?php echo $rowRelate['photo_color1'] ?>" class="pri-img" alt="">
                            <img src="product_images_desc/<?php echo $rowRelate['photo_color1'] ?>" class="sec-img" alt="">
                        </a>
                        <div class="box-label">
                            <div class="label-product label_new">
                                <span>new</span>
                            </div>
                            <div class="label-product label_sale">
                                <span>-20%</span>
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
                            <h4><a href="product-details.html"><?php echo $rowRelate['name'] ?></a></h4>
                        </div>
                        <div class="ratings">
                            <span class="yellow"><i class="lnr lnr-star"></i></span>
                            <span class="yellow"><i class="lnr lnr-star"></i></span>
                            <span class="yellow"><i class="lnr lnr-star"></i></span>
                            <span class="yellow"><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                        </div>
                        <div class="price-box">
                            <span class="regular-price"><span class="special-price">£65.00</span></span>
                            <span class="old-price"><del>£90.00</del></span>
                        </div>
                        
                    </div>
                </div><!-- </div> end single item -->
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div> 
    <!--  end related-product -->
    <!-- product details reviews start -->

    
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
                           <?php echo $desc ?>
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
        <i class="fa fa-angle-up"></i>
    </div> <!-- /End Scroll to Top -->

    <!-- footer area start -->  
    <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- footer area end -->

    <!-- Quick view modal start -->
    
    <!-- Quick view modal end -->



	<!-- all js include here -->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/ajax-mail.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>

<script>
    $(document).ready(function(){
        var pid = $("#pid").val();
        if(pid == "no pid"){
            window.location.href = "http://localhost:8080/ThucTapTwo/public/";
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "<?php echo e(route('cua-hang-temp')); ?>",
            type: "get",
            dataType: "text",
            data: {
                pid: pid
            },
            success: function(result){
                alert(result);
            }
        });
    });
</script><?php /**PATH D:\xampp\htdocs\ThucTapTwo\resources\views/temp-product-details.blade.php ENDPATH**/ ?>