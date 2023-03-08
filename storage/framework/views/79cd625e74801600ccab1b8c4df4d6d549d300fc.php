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
	<title>Đổi mật khẩu</title>
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
    
    <!-- header area end -->

    <!-- breadcrumb area start -->
    <div class="breadcrumb-area mb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="http://localhost:8080/ThucTapTwo/public/">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đổi mật khẩu</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- Start of My Account Wrapper -->
    <div class="login-wrapper pb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <main id="primary" class="site-main">
                        <div class="user-login">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12">
                                    <div class="section-title text-center">
                                        <h3>Đổi mật khẩu</h3>
                                    </div>
                                </div>
                            </div> <!-- end of row -->
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-6 offset-lg-2 offset-xl-3">
                                    <div style="padding-top: 40px; padding-bottom: 15px; " class="login-form">
                                        
                                            
                                            <div class="form-group row align-items-center mb-4">
                                                <label for="c-password" class="col-12 col-sm-12 col-md-4 col-form-label">Mật khẩu cũ</label>
                                                <div class="col-12 col-sm-12 col-md-8">
                                                    <input type="password" class="form-control" id="passwordOld" placeholder="Mật khẩu cũ">
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-4">
                                                <label for="c-password" class="col-12 col-sm-12 col-md-4 col-form-label">Mật khẩu mới</label>
                                                <div class="col-12 col-sm-12 col-md-8">
                                                    <input type="password" class="form-control" id="passwordNew" placeholder="Mật khẩu mới">
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-4">
                                                <label for="c-password" class="col-12 col-sm-12 col-md-4 col-form-label">Nhập lại mật khẩu mới</label>
                                                <div class="col-12 col-sm-12 col-md-8">
                                                    <input type="password" class="form-control" id="cpasswordNew" placeholder="Nhập lại mật khẩu mới">
                                                    
                                                </div>
                                            </div>
                                            <div class="login-box mt-0 text-right">
                                                <button type="submit" id="btn_changePassword" class="btn btn-secondary mb-2 mt-0">Xác nhận</button>
                                            </div>
                                            
                                        
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end of user-login -->
                    </main> <!-- end of #primary -->
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div>
    <!-- End of My Account Wrapper -->

   <!-- scroll to top -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div> <!-- /End Scroll to Top -->

    <!-- footer area start -->  
    
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
    $(document).ready(function(result){
        //Kiểm tra xem có đăng nhập chưa
        var customer = $("#userLogin").val();
        if(customer == "no login"){
            //Chưa đăng nhập
            alert("Yêu cầu đăng nhập");
            window.location.href = "http://localhost:8080/ThucTapTwo/public/dang-nhap";
        }
        //Khi nhấn nút xác nhận
        $("#btn_changePassword").click(function(){
            //Lấy thông tin
            //Mật khẩu cũ
            var passwordOld = $("#passwordOld").val();
            //Lấy mật khẩu mới
            var passwordNew = $("#passwordNew").val();
            //Lấy nhập lại mật khẩu cũ
            var cpasswordNew = $("#cpasswordNew").val();
            var customer = $("#userLogin").val();
            //Kiểm tra
            if(!passwordOld){
                alert("Chưa nhập mật khẩu cũ");
                return false;
            }
            if(!passwordNew){
                alert("Chưa nhập mật khẩu mới");
                return false;
            }
            if(!cpasswordNew){
                alert("Chưa nhập lại mật khẩu mới");
                return false;
            }
            if(passwordNew !== cpasswordNew){
                alert("Hai mật khẩu mới không giống nhau");
                return false;
            }
            //Gửi ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('doi-mat-khau')); ?>",
                type: "post",
                dataType: "text",
                data: {
                    passwordOld: passwordOld,
                    passwordNew: passwordNew,
                    customer: customer
                },
                success: function(result){
                    if(result == "error1"){
                        alert("Sai thông tin, yêu cầu đăng nhập lại");
                        window.location.href = "http://localhost:8080/ThucTapTwo/public/dang-xuat";
                    }else if(result == "error2"){
                        alert("Mật khẩu cũ không đúng");
                    }else if(result == "error3"){
                        alert("Đổi mật khẩu không thành công");
                    }else{
                        alert("Đổi mật khẩu thành công");
                        window.location.href = "http://localhost:8080/ThucTapTwo/public/";
                    }
                }
            });
        });
    });
</script><?php /**PATH D:\xampp\htdocs\ThucTapTwo\resources\views/my-account.blade.php ENDPATH**/ ?>