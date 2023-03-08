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
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Page Title -->
	<title>Danh sách đơn hàng</title>
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
                                <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
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
                                        <h3>Danh sách đơn hàng</h3>
                                    </div>
                                    <form>
                                        <div class="table-responsive text-center wishlist-style">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>Mã đơn hàng</td>
                                                        <td>Ngày mua</td>
                                                        <td>Ngày giao</td>
                                                        <td>Tổng tiền</td>
                                                        <td>Trạng thái đơn hàng</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="showOrderList">
                                                   
                                                </tbody>
                                                
                                                <script>
                                                    $(document).ready(function(){
                                                        var customer = $("#userLogin").val();
                                                        //Gửi ajax
                                                        $.ajax({
                                                            url: "ajax-jQuery/show-order-list.php",
                                                            type: "get",
                                                            dataType: "text",
                                                            data: {
                                                                customer: customer
                                                            },
                                                            success: function(result){
                                                                $("#showOrderList").html(result);
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

</html>


<script>
    $(document).ready(function(){
        //Lấy customer
        var customer = $("#userLogin").val();

        //Kiểm tra xem có login chưa
        if(customer == "no login"){
            alert("Yêu cầu đăng nhập");
            window.location.href = "http://localhost:8080/ThucTapTwo/public/dang-nhap";
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Gửi ajax kiểm tra
        $.ajax({
            url: "<?php echo e(route('kiem-tra-don-hang')); ?>",
            type: "get",
            dataType: "text",
            data: {
                customer: customer
            },
            success: function(result){
                if(result == "empty"){
                    alert("Không có đơn hàng nào, quay lại để mua hàng");
                    window.location.href = "http://localhost:8080/ThucTapTwo/public/";
                }
            }
        });
    });
</script><?php /**PATH D:\xampp\htdocs\ThucTapTwo\resources\views/order-list.blade.php ENDPATH**/ ?>