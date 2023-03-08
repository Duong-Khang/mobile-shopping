<?php
    ob_start();
    if(Session::has('username')){
        $token = session('username');
    }else{
        $token = "guest";
    }

    if(isset($_GET['order_id']) && $_GET['order_id'] != ''){
        $order_id = $_GET['order_id'];
    }else{
        $order_id = 0;
    }

    if(isset($_GET['user']) && $_GET['user'] != ''){
        $user = $_GET['user'];
    }else{
        $user = '';
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
	<title>Order Details</title>
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
    <input type="hidden" name="" id="userLogin" value="<?php echo e($token); ?>">
    <input type="hidden" name="" id="order_id" value="<?php echo $order_id ?>">
    <input type="hidden" name="" id="user" value="<?php echo $user ?>">
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
                                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- Start of wishlist Wrapper -->
    <div class="wishlist-wrapper mb-55">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <main id="primary" class="site-main">
                        <div class="wishlist">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h3>Chi tiết đơn hàng</h3>
                                    </div>
                                    <form action="#">
                                        <div class="table-responsive text-center wishlist-style">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>Địa chỉ người nhận</td>
                                                        <td>Hình thức thanh toán</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="show_info">
                                                    <tr>
                                                        <td><p>Dương Hoàng Khang</p>
                                                        <p>TN</p>
                                                        <p>Điện thoại: 00</p>
                                                        </td>
                                                        <td>Thanh toán tiền mặt khi nhận hàng</td>
                                                    </tr>
                                                </tbody>
                                                
                                                <script>
                                                    $(document).ready(function(){
                                                        var order_id = $("#order_id").val();
                                                        //alert(order_id);
                                                        var user = $("#user").val();
                                                        //alert(user);
                                                        var user_login = $("#userLogin").val();
                                                        //alert(user_login);
                                                        if(user !== user_login){
                                                            window.location.replace('http://localhost:8080/ThucTapTwo/public/');
                                                        }
                                                        //Gửi ajax
                                                        $.ajax({
                                                            url: "ajax-jQuery/show-info-buyer-order.php",
                                                            type: "get",
                                                            dataType: "text",
                                                            data: {
                                                                user: user,
                                                                order_id: order_id
                                                            },
                                                            success: function(result){
                                                                $("#show_info").html(result);
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end of wishlist -->
                    </main> <!-- end of #primary -->
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div>
    <!-- End of wishlist Wrapper -->
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
                                        <h3>Mặt hàng</h3>
                                    </div>
                                    
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>Ảnh</td>
                                                        <td>Tên sản phẩm</td>
                                                        <td>Khuyến mãi</td>
                                                        <td>Màu</td>
                                                        <td>Số lượng</td>
                                                        <td>Giá</td>
                                                        <td>Tổng</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="show_info_item">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                   

                                    <div class="cart-amount-wrapper">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-4 offset-md-8">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Tạm tính:</strong></td>
                                                            <td id="order_tamtinh">$860.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Số tiền được giảm:</strong></td>
                                                            <td><span id="show_value_discount" class="color-primary">0 đ</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Thành tiền:</strong></td>
                                                            <td><span id="order_tong" class="color-primary">$860.00</span></td>
                                                        </tr>
                                                        
                                                        
                                                        <script>
                                                            $(document).ready(function(){
                                                                var order_id = $("#order_id").val();
                                                                $.ajax({
                                                                    url: "ajax-jQuery/show-total-order-details.php",
                                                                    type: "get",
                                                                    dataType: "json",
                                                                    data: {
                                                                        order_id: order_id
                                                                    },
                                                                    success: function(result){
                                                                        $.each(result, function(key, item){
                                                                            var code = item['subtotal'];
                                                                            const numberFormat = new Intl.NumberFormat('vi-VN', {
                                                                                style: 'currency',
                                                                                currency: 'VND',
                                                                            });
                                                                            code = Math.round(code);
                                                                            code = numberFormat.format(code);
                                                                            $("#order_tamtinh").html(code);
                                                                            
                                                                            $("#order_tong").html(item['total']);
                                                                        });
                                                                    }
                                                                });

                                                                //Lấy ra giá trị của khuyến mãi
                                                                $.ajax({
                                                                    url: "ajax-jQuery/show-proof.php",
                                                                    type: "get",
                                                                    dataType: "text",
                                                                    data: {
                                                                        order_id: order_id
                                                                    },
                                                                    success: function(result){
                                                                        const numberFormat = new Intl.NumberFormat('vi-VN', {
                                                                            style: 'currency',
                                                                            currency: 'VND',
                                                                        });
                                                                        result = Math.round(result);
                                                                        result = numberFormat.format(result);
                                                                        $("#show_value_discount").html(result);
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
        var order_id = $("#order_id").val();
        //alert(order_id);
        var user = $("#user").val();
        //alert(user);
        var user_login = $("#userLogin").val();
        //alert(user_login);
        if(user !== user_login){
            window.location.replace('http://localhost:8080/ThucTapTwo/public/');
        }
        //Gửi ajax
        $.ajax({
            url: "ajax-jQuery/show-info-item-order.php",
            type: "get",
            dataType: "text",
            data: {
                order_id: order_id,
                user_login: user_login
            },
            success: function(result){
                $("#show_info_item").html(result);
            }
        });
    });
</script>
<?php ob_flush(); ?><?php /**PATH D:\xampp\htdocs\ThucTapTwo\resources\views/order-details.blade.php ENDPATH**/ ?>