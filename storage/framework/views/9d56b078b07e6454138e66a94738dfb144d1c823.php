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
    $token = "no login";
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
                        <div id="show_img_big" class="pro-large-img">
                            <img style="height: 400px; width: 400px;" src="product_images_desc/<?php echo $row['photo_color1'] ?>" alt="" />
                            <div class="img-view">
                                <a class="img-popup" href="product_images_desc/<?php echo $row['photo_color1'] ?>"></a>
                                
                            </div>
                        </div>
                    </div>
                    <div id="show_img_tiny" class="pro-nav">
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
                                    <li id="show_star">
                                        <?php
                                            //Lấy star trong table rating
                                            $sqlr = "SELECT AVG(star) AS average FROM rating WHERE product_id='$pid'";

                                            $resultr = $conn->query($sqlr);

                                            $avg = 0;

                                            if($resultr->num_rows > 0){
                                                $rowr = $resultr->fetch_assoc();
                                                $avg = $rowr['average'];
                                            }

                                            if($avg == 1){
                                                echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i class="far fa-star"></i></span>
                                                <span><i class="far fa-star"></i></span>
                                                <span><i class="far fa-star"></i></span>
                                                <span><i class="far fa-star"></i></span>';
                                            }else if($avg > 1 && $avg < 2){
                                                echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <i style="color: yellow;" class="fas fa-star-half-alt"></i>
                                                <span><i class="far fa-star"></i></span>
                                                <span><i class="far fa-star"></i></span>
                                                <span><i class="far fa-star"></i></span>';
                                            }else if($avg == 2){
                                                echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i class="far fa-star"></i></span>
                                                <span><i class="far fa-star"></i></span>
                                                <span><i class="far fa-star"></i></span>';
                                            }else if($avg > 2 && $avg < 3){
                                                echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <i style="color: yellow;" class="fas fa-star-half-alt"></i>   
                                                <span><i class="far fa-star"></i></span>
                                                <span><i class="far fa-star"></i></span>';
                                            }else if($avg == 3){
                                                echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i class="far fa-star"></i></span>
                                                <span><i class="far fa-star"></i></span>';
                                            }else if($avg > 3 && $avg < 4){
                                                echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <i style="color: yellow;" class="fas fa-star-half-alt"></i>   
                                                <span><i class="far fa-star"></i></span>';
                                            }else if($avg == 4){
                                                echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i class="far fa-star"></i></span>';
                                            }else if($avg > 4 && $avg < 5){
                                                echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <i style="color: yellow;" class="fas fa-star-half-alt"></i>';
                                            }else if($avg == 5){
                                                echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>
                                                <span><i style="color: yellow;" class="far fa-star"></i></span>';
                                            }
                                        ?>
                                    </li>
                                    <li><a href="#"><span id="count_reviews">
                                    <?php
                                        //Điếm số reviews
                                        $t = 0;
                                        $sqlx = "SELECT COUNT(product_id) AS countReview FROM feedback WHERE product_id='$pid'";
                                        $resultx = $conn->query($sqlx);
                                        if($resultx->num_rows>0){
                                            $rowx = $resultx->fetch_assoc();
                                            $t = $rowx['countReview'];
                                        }
                                        $sqlx = "SELECT COUNT(product_id) AS countReview FROM reply WHERE product_id='$pid'";
                                        $resultx = $conn->query($sqlx);
                                        if($resultx->num_rows>0){
                                            $rowx = $resultx->fetch_assoc();
                                            $t += $rowx['countReview'];
                                        }
                                        echo $t;
                                    ?>
                                    </span> nhận xét</a></li>
                                </ul>
                            </div>
                            <div id="show_price" class="price-box mb-15">
                                <?php
                                    $discout_id = $row['discount_id'];
                                    $sqlDis = "SELECT * FROM discount WHERE id='$discout_id'";
                                    $resultDis = $conn->query($sqlDis);
                                    if($resultDis->num_rows>0){
                                        $rowDis = $resultDis->fetch_assoc();
                                        if($rowDis['active'] == 1){
                                            $price_dis = ($row['price_color1']*(100-$rowDis['discount_percent']))/100;
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($price_dis).' đ</span></span>
                                                <span class="old-price"><del>'.number_format($row['price_color1']).' đ</del></span>
                                                <span class="old-price">-'.$rowDis['discount_percent'].'%</span>
                                                ';
                                        }else if($rowDis['active'] == 0||$rowDis['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($row['price_color1']).' đ</span></span>';
                                        }
                                    }
                                ?>
                                
                            </div>
                            <input type="hidden" id="discount_id" value="<?php echo $row['discount_id'] ?>">
                            <div class="product-detail-sort-des pb-20">
                                <p><?php echo $row['small_desc'] ?></p>
                            </div>
                            <div class="pro-details-list pt-20">
                                <ul>
                                    <li><span>ROM :</span><?php echo $row['rom'] ?></li>
                                    <li><span>RAM :</span><?php echo $row['ram'] ?></li>
                                    <li><span>CHIP GPU :</span><?php echo $row['chip_gpu'] ?></li>
                                    <li><span>CHIP SET :</span><?php echo $row['chip_set'] ?></li>
                                    <li><span>Độ phân giải màn hình :</span><?php echo $row['sr'] ?></li>
                                </ul>
                            </div>
                            <div class="product-availabily-option mt-15 mb-15">
                                <div class="color-optionn">
                                    <h4><sup>*</sup>Màu: <span id="show_color"><?php echo $row['dcolor1'] ?></span></h4>
                                    <ul>                                       
                                        <?php
                                            //Hiển thị ảnh theo màu
                                            if($row['dcolor1'] != NULL){
                                                echo '<li id="color1" style="cursor: pointer;">
                                                    <img style="height: 35px; width: 35px;" src="product_images_desc/'.$row['photo_color1'].'" alt="">
                                                    <input type="hidden" id="value_color1" value="'.$row['dcolor1'].'">
                                                </li>';
                                            }
                                            if($row['dcolor2'] != NULL){
                                                echo '<li id="color2" style="cursor: pointer;">
                                                    <img style="height: 35px; width: 35px;" src="product_images_desc/'.$row['photo_color2'].'" alt="">
                                                    <input type="hidden" id="value_color2" value="'.$row['dcolor2'].'">
                                                </li>';
                                            }
                                            if($row['dcolor3'] != NULL){
                                                echo '<li id="color3" style="cursor: pointer;">
                                                    <img style="height: 35px; width: 35px;" src="product_images_desc/'.$row['photo_color3'].'" alt="">
                                                    <input type="hidden" id="value_color3" value="'.$row['dcolor3'].'">
                                                </li>';
                                            }
                                        ?>
                                    </ul> 
                                </div>
                            </div>
                            <table class="table table-bordered pro-table pt-20 pb-20">
                                <tbody>
                                    <tr class="">
                                        <td style="border: none">
                                            Số lượng: 
                                            <div class="product-qty">
                                                <input style="border: 1px solid #f8f9fa" type="text" id="quantity" value="1">
                                            <span class="dec qtybtn"><i class="fa fa-minus"></i></span><span class="inc qtybtn"><i class="fa fa-plus"></i></span></div>
                                        </td>   
                                        
                                    </tr>    
                                </tbody>
                            </table>
                            <div class="pro-quantity-box mb-30">
                                <div class="qty-boxx">
                                    <button id="btn_addToCart" class="btn btn-secondary">Thêm vào giỏ</button>
                                </div>
                            </div>

                            <div class="tag-line mb-20">
                                <label>Danh mục :</label>
                                <?php if($row['manufacturer'] == "Apple"): ?>
                                    <a href="<?php echo e(route('apple')); ?>"><?php echo e($row['manufacturer']); ?></a>
                                <?php elseif($row['manufacturer'] == "Xiaomi"): ?>
                                    <a href="<?php echo e(route('xiaomi')); ?>"><?php echo e($row['manufacturer']); ?></a>
                                <?php elseif($row['manufacturer'] == "Samsung"): ?>
                                    <a href="<?php echo e(route('samsung')); ?>"><?php echo e($row['manufacturer']); ?></a>
                                <?php elseif($row['manufacturer'] == "Oppo"): ?>
                                    <a href="<?php echo e(route('oppo')); ?>"><?php echo e($row['manufacturer']); ?></a>
                                <?php elseif($row['manufacturer'] == "Vsmart"): ?>
                                    <a href="<?php echo e(route('vsmart')); ?>"><?php echo e($row['manufacturer']); ?></a>
                                <?php endif; ?>       
                            </div>
                            <script>
                                $(document).ready(function(){
                                    //Chọn màu sắc
                                    //Biến lưu màu
                                    var pid = $("#pid").val();
                                    var color = $("#value_color1").val();
                                    $("#color1").css("border", "2px solid #111");
                                    //Xử lý khi click chọn màu #6c757d
                                    $("#color1").click(function(){
                                        $("#color1").css("border", "2px solid #111");
                                        color = $("#value_color1").val();
                                        $("#show_color").text(color);
                                        $("#color3").css("border", "1px solid #6c757d");
                                        $("#color2").css("border", "1px solid #6c757d");
                                        //Khi chọn vào màu 1 sẽ tiến hành đổi giá ứng với màu 1
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        $.ajax({
                                            url: "<?php echo e(route('cap-nhap-gia-ung-voi-mau')); ?>",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid,
                                                color: color
                                            },
                                            success: function(result){
                                                $("#show_price").html(result);
                                            }
                                        });
                                        //Cập nhật ảnh lớn ứng với màu đã chọn
                                        $.ajax({
                                            url: "<?php echo e(route('cap-nhat-anh-lon-ung-voi-mau-chon')); ?>",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid,
                                                color: color
                                            },
                                            success: function(result){
                                                $("#show_img_big").html(result);
                                            }
                                        });
                                        //Cập nhật ảnh nhỏ ứng với màu đã chọn
                                        $.ajax({
                                            url: "<?php echo e(route('cap-nhat-anh-nho-ung-voi-mau-da-chon')); ?>",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid,
                                                color: color
                                            },
                                            success: function(result){
                                                $("#show_img_tiny").html(result);
                                            }
                                        });
                                    });
                                    $("#color2").click(function(){
                                        $("#color2").css("border", "2px solid #111");
                                        color = $("#value_color2").val();
                                        $("#show_color").text(color);
                                        $("#color1").css("border", "1px solid #6c757d");
                                        $("#color3").css("border", "1px solid #6c757d");
                                        //Khi chọn vào màu 1 sẽ tiến hành đổi giá ứng với màu 1
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        $.ajax({
                                            url: "<?php echo e(route('cap-nhap-gia-ung-voi-mau')); ?>",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid,
                                                color: color
                                            },
                                            success: function(result){
                                                $("#show_price").html(result);
                                            }
                                        });
                                        //Cập nhật ảnh lớn ứng với màu đã chọn
                                        $.ajax({
                                            url: "<?php echo e(route('cap-nhat-anh-lon-ung-voi-mau-chon')); ?>",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid,
                                                color: color
                                            },
                                            success: function(result){
                                                $("#show_img_big").html(result);
                                            }
                                        });
                                        //Cập nhật ảnh nhỏ ứng với màu đã chọn
                                        $.ajax({
                                            url: "<?php echo e(route('cap-nhat-anh-nho-ung-voi-mau-da-chon')); ?>",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid,
                                                color: color
                                            },
                                            success: function(result){
                                                $("#show_img_tiny").html(result);
                                            }
                                        });
                                    });
                                    $("#color3").click(function(){
                                        $("#color3").css("border", "2px solid #111");
                                        color = $("#value_color3").val();
                                        $("#show_color").text(color);
                                        $("#color1").css("border", "1px solid #6c757d");
                                        $("#color2").css("border", "1px solid #6c757d");
                                        //Khi chọn vào màu 1 sẽ tiến hành đổi giá ứng với màu 1
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        $.ajax({
                                            url: "<?php echo e(route('cap-nhap-gia-ung-voi-mau')); ?>",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid,
                                                color: color
                                            },
                                            success: function(result){
                                                $("#show_price").html(result);
                                            }
                                        });
                                        //Cập nhật ảnh lớn ứng với màu đã chọn
                                        $.ajax({
                                            url: "<?php echo e(route('cap-nhat-anh-lon-ung-voi-mau-chon')); ?>",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid,
                                                color: color
                                            },
                                            success: function(result){
                                                $("#show_img_big").html(result);
                                            }
                                        });
                                        //Cập nhật ảnh nhỏ ứng với màu đã chọn
                                        $.ajax({
                                            url: "<?php echo e(route('cap-nhat-anh-nho-ung-voi-mau-da-chon')); ?>",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid,
                                                color: color
                                            },
                                            success: function(result){
                                                $("#show_img_tiny").html(result);
                                            }
                                        });
                                    });

                                    //Khi nhấn Add To Cart
                                    $("#btn_addToCart").click(function(){
                                        //Lấy customer
                                        var customer = $("#userLogin").val();
                                        if(customer == "no login"){
                                            //alert("No");
                                            $("#form_id").show();
                                        }else{
                                            //alert("Yes");
                                            //Lấy pid
                                            var pid = $("#pid").val();
                                            //Lấy số lượng
                                            var quantity = $("#quantity").val();
                                            //Kiểm tra số lượng xem có hợp lệ không
                                            if(quantity <= 0){
                                                alert("Số lượng phải lớn hơn không");
                                                return false;
                                            }else if(Number.isInteger(quantity) == false){
                                                quantity = Number(quantity);
                                                if(Number.isInteger(quantity) == false){
                                                    alert("Số lượng không hợp lệ");
                                                    return false;
                                                } 
                                            }
                                            //Lấy discount id
                                            var did = $("#discount_id").val();
                                            //Gửi ajax để add to cart
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $.ajax({
                                                url: "<?php echo e(route('them-vao-gio-hang')); ?>",
                                                type: "get",
                                                dataType: "text",
                                                data: {
                                                    customer: customer,
                                                    pid: pid,
                                                    color: color,
                                                    did: did,
                                                    quantity: quantity
                                                },
                                                success: function(result){
                                                    if(result === "1"){
                                                        $("#msg_success").text("Thêm vào giỏ thành công");
                                                        $(document).scrollTop(0);
                                                        $("#cartHover").css("display", "block");
                                                        //Cập nhật số lượng trên cart icon
                                                        $.ajax({
                                                            url: "<?php echo e(route('cap-nhap-so-luong-tren-cart-icon')); ?>",
                                                            type: "get",
                                                            dataType: "text",
                                                            data: {
                                                                customer: customer
                                                            },
                                                            success: function(resultQuantity){
                                                                $("#quantity_cart_hover").text(resultQuantity);
                                                            }
                                                        });
                                                    }else if(result === "2"){
                                                        alert("Thêm vào giỏ hàng thất bại");
                                                    }else if(result === "3"){
                                                        alert("Số lượng không đủ đáp ứng");
                                                    }
                                                }
                                            });
                                            
                                        }
                                    });
                                });
                            </script>
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
                    WHERE product.id != '$pid' AND product.manufacturer LIKE '$cate' AND product.delete_at IS NULL
                    ";
                    $resultRelate = $conn->query($sqlRelate);
                    if($resultRelate->num_rows>0){
                        while ($rowRelate = $resultRelate->fetch_assoc()) {
                ?>
                <div style="height: 370px;" class="product-item mb-30">
                    <div class="product-thumb">
                        <a href="product-details?pid=<?php echo $rowRelate['pid'] ?>">
                            <img style="height: 150px; width: 150px;" src="product_images_desc/<?php echo $rowRelate['photo_color1'] ?>" class="pri-img" alt="">
                            <img style="height: 150px; width: 150px;" src="product_images_desc/<?php echo $rowRelate['photo_color1'] ?>" class="sec-img" alt="">
                        </a>
                        <div class="box-label">
                            <?php
                                //Lấy discount id
                                $discount_id = $rowRelate['discount_id'];
                                //Truy vấn lấy discount
                                $sqlDis = "SELECT * FROM discount WHERE id='$discount_id'";
                                $resultDis = $conn->query($sqlDis);
                                if($resultDis->num_rows>0){
                                    $rowDis = $resultDis->fetch_assoc();
                                    //Kiểm tra xem còn hoạt động không
                                    if($rowDis['active'] == 1){
                                        echo '<div class="label-product label_sale">
                                            <span>-'.$rowDis['discount_percent'].'%</span>
                                        </div>';
                                    }
                                }
                            ?>
                            
                        </div>
                    </div>
                    <div class="product-caption">
                        <div class="manufacture-product">
                            <p><a href="#"><?php echo $rowRelate['manufacturer'] ?></a></p>
                        </div>
                        <div class="product-name">
                            <h4><a href="product-details?pid=<?php echo $rowRelate['pid'] ?>"><?php echo $rowRelate['name'] ?></a></h4>
                        </div>
                        <div class="ratings">
                            <?php
                                $pidr = $rowRelate['pid'];
                                //Lấy star trong table rating
                                $sqlr = "SELECT AVG(star) AS average FROM rating WHERE product_id='$pidr'";

                                $resultr = $conn->query($sqlr);

                                $avg = 0;

                                if($resultr->num_rows > 0){
                                    $rowr = $resultr->fetch_assoc();
                                    $avg = $rowr['average'];
                                }

                                if($avg == 1){
                                    echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>';
                                }else if($avg > 1 && $avg < 2){
                                    echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <i style="color: yellow;" class="fas fa-star-half-alt"></i>
                                    <span><i class="far fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>';
                                }else if($avg == 2){
                                    echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>';
                                }else if($avg > 2 && $avg < 3){
                                    echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <i style="color: yellow;" class="fas fa-star-half-alt"></i>   
                                    <span><i class="far fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>';
                                }else if($avg == 3){
                                    echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>';
                                }else if($avg > 3 && $avg < 4){
                                    echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <i style="color: yellow;" class="fas fa-star-half-alt"></i>   
                                    <span><i class="far fa-star"></i></span>';
                                }else if($avg == 4){
                                    echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>';
                                }else if($avg > 4 && $avg < 5){
                                    echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <i style="color: yellow;" class="fas fa-star-half-alt"></i>';
                                }else if($avg == 5){
                                    echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>
                                    <span><i style="color: yellow;" class="far fa-star"></i></span>';
                                }
                            ?>
                        </div>
                        <div class="price-box">
                            <?php
                                //Tính giá dựa trên discount
                                //Lấy discount id
                                $discount_id = $rowRelate['discount_id'];
                                //Truy vấn lấy discount
                                $sqlDis = "SELECT * FROM discount WHERE id='$discount_id'";
                                $resultDis = $conn->query($sqlDis);
                                if($resultDis->num_rows>0){
                                    $rowDis = $resultDis->fetch_assoc();
                                    //Kiểm tra xem còn hoạt động không
                                    if($rowDis['active'] == 1){
                                        $price_dis = ($rowRelate['price_color1']*(100-$rowDis['discount_percent']))/100;
                                        echo '<span class="regular-price"><span class="special-price">'.number_format($price_dis).' đ</span></span>
                                                <span class="old-price"><del>'.number_format($rowRelate['price_color1']).' đ</del></span>';
                                    }else if($rowDis['active'] == 0 || $rowDis['active'] == 2){
                                        echo '<span class="regular-price"><span class="special-price">'.number_format($rowRelate['price_color1']).' đ</span></span>';
                                    }
                                }
                            ?>
                            
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
                                    <textarea class="form-control" id="content_reviews"></textarea>
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
                                    &nbsp;<span id="rating_choose">Tuyệt vời</span>
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
            //Kiểm tra xem sản phẩm này bị xóa chưa

            $.ajax({
                url: "<?php echo e(route('kiem-tra-san-pham-co-bi-xoa')); ?>",
                type: "get",
                dataType: "text",
                data: {
                    pid: pid
                },
                success: function(result){
                    if(result === "remove"){
                        window.location.href = "http://localhost:8080/ThucTapTwo/public/";
                    }
                }
            });

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
                $("#rating_choose").text("Rất tệ");
                $("#rating_verypoor").css("color", "yellow");
                $("#rating_poor").css("color", "#ced4da");
                $("#rating_average").css("color", "#ced4da");
                $("#rating_good").css("color", "#ced4da");
                $("#rating_excellent").css("color", "#ced4da");
            });
            $("#rating_poor").click(function(){
                rating = $("#value_poor").val();
                $("#rating_choose").text("Tệ");
                $("#rating_poor").css("color", "yellow");
                $("#rating_verypoor").css("color", "yellow");
                $("#rating_average").css("color", "#ced4da");
                $("#rating_good").css("color", "#ced4da");
                $("#rating_excellent").css("color", "#ced4da");
            });
            $("#rating_average").click(function(){
                rating = $("#value_average").val();
                $("#rating_choose").text("Trung bình");
                $("#rating_average").css("color", "yellow");
                $("#rating_poor").css("color", "yellow");
                $("#rating_verypoor").css("color", "yellow");
                $("#rating_good").css("color", "#ced4da");
                $("#rating_excellent").css("color", "#ced4da");
            });
            $("#rating_good").click(function(){
                rating = $("#value_good").val();
                $("#rating_choose").text("Tốt");
                $("#rating_good").css("color", "yellow");
                $("#rating_average").css("color", "yellow");
                $("#rating_poor").css("color", "yellow");
                $("#rating_verypoor").css("color", "yellow");
                $("#rating_excellent").css("color", "#ced4da");
            });
            $("#rating_excellent").click(function(){
                rating = $("#value_excellent").val();
                $("#rating_choose").text("Tuyệt vời");
                $("#rating_good").css("color", "yellow");
                $("#rating_average").css("color", "yellow");
                $("#rating_poor").css("color", "yellow");
                $("#rating_verypoor").css("color", "yellow");
                $("#rating_excellent").css("color", "yellow");
            });
            $("#btn_reviews").click(function(){
                
                //alert(content);
                //alert(rating);
                var user = $("#userLogin").val();
                //alert(user);
                var pid = $("#pid").val();
                //alert(pid);
                //Kiểm tra xem user đã đăng nhập chưa
                if(user !== "no login"){
                    //Lấy nội dung reviews
                    var content = $("#content_reviews").val();
                    if(content == ''){
                        alert("Bạn chưa nhập nội dung!");
                        return false;
                    }
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
                //alert(result);
            }
        });
    });
</script>

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





<div style="z-index: 2000" id="form_msg_login" class="modal">
    <form style="width: 20%; background-color: #fedc19;" class="modal-content animate">
        <p style="color: black" class="modal-header">Đăng nhập thành công</p>
        <span class="close" title="Close Modal">&times;</span>
    </form>
</div>


<div style="z-index: 2000" id="form_msg_signup" class="modal">
    <form style="width: 20%; background-color: #fedc19;" class="modal-content animate">
        <p style="color: black" class="modal-header">Đăng ký thành công</p>
        <span class="close" title="Close Modal">&times;</span>
    </form>
</div>

<div style="z-index: 2000" id="form_id" class="modal">
  
  <form class="modal-content animate" id="form_login_quick">
    <div class="imgcontainer">
        <h2 class="modal-header">Đăng nhập để tiếp tục</h2>
      <span id="btn_close_form_login_quick" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
        <div class="user-form">
            <label class="user-form__label" for="username_login_quick">
                <i class="fas fa-user"></i>
                <b>Tài khoản</b>
            </label>
            <input class="user-form__input" type="text" placeholder="Tài khoản" name="uname" id="username_login_quick">
        </div>

        <div class="user-form">
            <label class="user-form__label" for="password_login_quick">
                <i class="fas fa-key"></i>
                <b>Mật khẩu</b>
            </label>
            <input class="user-form__input" type="password" placeholder="Mật khẩu" name="psw" id="password_login_quick">
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
        <h2 class="modal-header">Đăng ký</h2>
      <span id="btn_close_form_register_quick" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
        <div class="user-form">
            <label class="user-form__label" for="username_register_quick">
                <i class="fas fa-user"></i>
                <b>Tài khoản</b>
            </label>
            <input class="user-form__input" type="text" placeholder="Tên tài khoản" name="uname" id="username_register_quick">
        </div>

        <div class="user-form">
            <label class="user-form__label" for="password_register_quick">
                <i class="fas fa-key"></i>
                <b>Mật khẩu</b>
            </label>
            <input class="user-form__input" type="password" placeholder="Mật khẩu" name="psw" id="password_register_quick"> 
        </div>

        <div class="user-form">
            <label class="user-form__label" for="cpassword_register_quick">
                <i class="fas fa-check-circle"></i>
                <b>Xác nhận mật khẩu</b>
            </label>
            <input class="user-form__input" type="password" placeholder="Nhập lại mật khẩu" name="psw" id="cpassword_register_quick">
        </div>
        <div class="psw-wrap">
            <span class="psw">
                Bạn đã có tài khoản? <a id="change_login">Đăng nhập</a>
            </span>
        </div>
        
        <button class="form-btn" id="btn_register_quick_submit" type="submit">Đăng ký</button>
    </div>
  </form>
</div>


<script>
    $(document).ready(function(){
        $("#form_msg_login").hide();
        $("#form_msg_signup").hide();
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
            var password = $("#password_login_quick").val();

            if(!username){
                alert("Chưa nhập tên tài khoản");
                return false;
            }

            if(!password){
                alert("Chưa nhập mật khẩu");
                return false;
            }
            
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
                    if(result == "error1"){
                        alert("Tên tài khoản hoặc mật khẩu không đúng");
                    }else if(result == "error2"){  
                        alert("Tài khoản không tồn tại");
                    }else{
                        $("#show_check_login").hide();
                        $("#show_info_login_quick").html(result);
                        $("#show_check_login_success").show();
                        $("#form_id").hide();
                        $("#userLogin").val(result);
                        //Hiển thị hợp msg khi đăng nhập thành công
                        $("#form_msg_login").show();
                        var customer = result;
                        //Cập nhật số lượng trên cart icon
                        $.ajax({
                            url: "<?php echo e(route('cap-nhap-so-luong-tren-cart-icon')); ?>",
                            type: "get",
                            dataType: "text",
                            data: {
                                customer: customer
                            },
                            success: function(resultQuantity){
                                $("#quantity_cart_hover").text(resultQuantity);
                            }
                        });
                        function sleep (time) {
                            return new Promise((resolve) => setTimeout(resolve, time));
                        }

                        // Usage!
                        sleep(1000).then(() => {
                            // Do something after the sleep!
                            $("#form_msg_login").hide();
                        });
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

            if(!username){
                alert("Chưa nhập tên tài khoản");
                return false;
            }

            if(!password){
                alert("Chưa nhập mật khẩu");
                return false;
            }

            if(!cpassword){
                alert("Chưa nhập lại mật khẩu");
                return false;
            }

            if(password !== cpassword){
                alert("Hai mật khẩu không giống nhau");
                return false;
            }

            //Kiểm tra xem tên tài khoản có hợp lệ không
            //length
            var usernameNew = username.replace(/[^a-zA-Z0-9]/g,'');
            if(usernameNew.length < username.length){
                alert("Tên tài khoản không cho phép ký tự đặc biệt hoặc khoảng trắng");
                return false;
            }
            
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
                        //Hiển thị hợp msg khi đăng nhập thành công
                        $("#form_msg_signup").show();
                        function sleep (time) {
                            return new Promise((resolve) => setTimeout(resolve, time));
                        }

                        // Usage!
                        sleep(1000).then(() => {
                            // Do something after the sleep!
                            $("#form_msg_signup").hide();
                        });
                    }else{
                        alert(result);
                    }
                }
            });
        });
    });
</script><?php /**PATH D:\xampp\htdocs\ThucTapTwo\resources\views/product-details.blade.php ENDPATH**/ ?>