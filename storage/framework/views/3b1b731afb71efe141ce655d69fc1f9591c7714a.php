<div class="login-wrapper pb-70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <main id="primary" class="site-main">
                    <div class="user-login">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="section-title text-center">
                                    <h3>Đăng nhập vào tài khoản của bạn</h3>
                                </div>
                            </div>
                        </div> <!-- end of row -->
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-6 offset-lg-2 offset-xl-3">
                                <div class="login-form">
                                    <form action="<?php echo e(route('xu-ly-dang-nhap')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group row align-items-center mb-4">
                                            <label for="email" class="col-12 col-sm-12 col-md-4 col-form-label">Tên tài khoản</label>
                                            <div class="col-12 col-sm-12 col-md-8">
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Tên tài khoản">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center mb-4">
                                            <label for="c-password" class="col-12 col-sm-12 col-md-4 col-form-label">Mật khẩu</label>
                                            <div class="col-12 col-sm-12 col-md-8">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                                                <button class="pass-show-btn" id="showPassword" type="button">Hiển thị</button>
                                            </div>
                                        </div>
                                        <div class="login-box mt-5 text-center">
                                            
                                            <p style="color: tomato;" id="msg_EmptyUsername">Bạn chưa nhập tên tài khoản!</p>
                                            <p style="color: tomato;" id="msg_EmptyPassword">Bạn chưa nhập mật khẩu!</p>
                                            
                                            <p style="color: tomato;" id="msg_ErrorLogin">Tên tài khoản hoặc mật khẩu không đúng!</p>
                                            <p><a href="#">Quên mật khẩu?</a></p>
                                            <button type="submit" id="btn_login" class="btn btn-secondary mb-4 mt-4">Đăng nhập</button>
                                        </div>
                                        <div class="text-center pt-20 top-bordered">
                                            <p>Chưa có tài khoản? <a href="<?php echo e(route('dang-ky')); ?>">Tạo tài khoản</a>.</p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end of user-login -->
                </main> <!-- end of #primary -->
            </div>
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div>

<script>
    $(document).ready(function(){
        //Khi load page thì msg sẽ bị ẩn
        $("#msg_EmptyUsername").hide();
        $("#msg_EmptyPassword").hide();
        $("#msg_ErrorLogin").hide();
        //Khi nhấn nút đăng nhập
        $("#btn_login").click(function(){
            //Lấy data từ form
            var username = $("#username").val();
            var password = $("#password").val();
            //Kiểm tra username xem có rổng không
            if(!username){
                //Hiển thị msg
                $("#msg_EmptyUsername").show();
                return false;
            }
            //Kiểm tra password xem có rổng không
            if(!password){
                //Hiển thị msg
                $("#msg_EmptyPassword").show();
                return false;
            }
        });
        //Khi hiển thị msg xong thì đóng nó lại
        //Đóng username
        $("#username").focus(function(){
            $("#msg_EmptyUsername").hide();
            $("#msg_EmptyPassword").hide();
            $("#msg_ErrorLogin").hide();
        });
        //Đóng password
        $("#password").focus(function(){
            $("#msg_EmptyPassword").hide();
            $("#msg_EmptyUsername").hide();
            $("#msg_ErrorLogin").hide();
        });
        //Hide or Show password
        //Khi nhấn nút Show
        $("#showPassword").click(function(){
            //Thay đổi attr
            var msg = $("#showPassword").text();
            if(msg === "Hiển thị"){
                $("#password").attr("type", "text");
                //Đổi show thành ẩn
                $("#showPassword").text("Ẩn");
            }else{
                $("#password").attr("type", "password");
                //Đổi show thành ẩn
                $("#showPassword").text("Hiển thị");
            }
        });
    });
</script>

<?php
    //Xử lý khi username rỗng
    if(isset($_GET['eu'])){
        echo '<script> 
                $(document).ready(function(){
                    $("#msg_EmptyUsername").show();
                }); 
            </script>';
    }
    //Xử lý khi password rỗng
    if(isset($_GET['ep'])){
        echo '<script> 
                $(document).ready(function(){
                    $("#msg_EmptyPassword").show();
                }); 
            </script>';
    }
    //Xử lý khi login thất bại
    if(isset($_GET['el'])){
        echo '<script>
            $(document).ready(function(){
                $("#msg_ErrorLogin").show();
            });             
            </script>';
    }
?><?php /**PATH D:\Program Files\XamPP\htdocs\ThucTapTwo\resources\views/layout/login-form.blade.php ENDPATH**/ ?>