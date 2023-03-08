<div class="login-wrapper pb-70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <main id="primary" class="site-main">
                    <div class="user-login">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="section-title text-center">
                                    <h3>Tạo tài khoản</h3>
                                </div>
                            </div>
                        </div> <!-- end of row -->
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 offset-xl-2">
                                <div class="registration-form login-form">
                                    <form action="<?php echo e(route('xu-ly-dang-ky')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="login-info mb-20">
                                            <p>Đã có tài khoản? <a href="<?php echo e(route('dang-nhap')); ?>">Đăng nhập!</a></p>
                                            <p id="msg_EmptyFname" style="color: tomato;">Chưa điền họ tên đệm</p>
                                            <p id="msg_EmptyLname" style="color: tomato;">Chưa điền tên</p>
                                            <p id="msg_EmptyUsername" style="color: tomato;">Chưa điền tên tài khoản</p>
                                            <p id="msg_EmptyPassword" style="color: tomato;">Chưa điền mật khẩu</p>
                                            <p id="msg_EmptyCpassword" style="color: tomato;">Chưa điền xác thực mật khẩu</p>
                                            <p id="msg_EmptyPhone" style="color: tomato;">Chưa điền số điện thoại</p>
                                            <p id="msg_ComparePassword" style="color: tomato;">Hai mật khẩu không giống nhau!</p>
                                            <p id="msg_ErrorRegister" style="color: tomato;"></p>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="f-name" class="col-12 col-sm-12 col-md-4 col-form-label">Tên họ đệm</label>
                                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                <input type="text" class="form-control" name="fname" id="fname">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="l-name" class="col-12 col-sm-12 col-md-4 col-form-label">Tên</label>
                                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                <input type="text" class="form-control" name="lname" id="lname">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-12 col-sm-12 col-md-4 col-form-label">Tên tài khoản</label>
                                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                <input type="text" class="form-control" name="username" id="username">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="newpassword" class="col-12 col-sm-12 col-md-4 col-form-label">Mật khẩu</label>
                                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                <input type="password" class="form-control" name="password" id="password">
                                                <button class="pass-show-btn" id="btn_showPassword" type="button">Hiển thị</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="c-password" class="col-12 col-sm-12 col-md-4 col-form-label">Xác thực mật khẩu</label>
                                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                <input type="password" class="form-control" name="cpassword" id="cpassword">
                                                <button class="pass-show-btn" id="btn_showCpassword" type="button">Hiển thị</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="birth" class="col-12 col-sm-12 col-md-4 col-form-label">Số điện thoại</label>
                                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                <input type="text" class="form-control" name="phone" id="phone">
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="register-box d-flex justify-content-end mt-20">
                                            <button type="submit" id="btn_register" class="btn btn-secondary">Register</button>
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
        //Khi load page ẩn các msg
        $("#msg_EmptyFname").hide();
        $("#msg_EmptyLname").hide();
        $("#msg_EmptyUsername").hide();
        $("#msg_EmptyPassword").hide();
        $("#msg_EmptyCpassword").hide();
        $("#msg_EmptyPhone").hide();
        $("#msg_ComparePassword").hide();
        // $("#msg_ErrorRegister").hide();
        //Khi nhấn nút register
        $("#btn_register").click(function(){
            //Lấy data từ form
            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var username = $("#username").val();
            var password = $("#password").val();
            var cpassword = $("#cpassword").val();
            var phone = $("#phone").val();
            //Kiểm tra xem data có rỗng không
            if(!fname){
                //Hiển thị msg
                $("#msg_EmptyFname").show();
                return false;
            }
            if(!lname){
                //Hiển thị msg
                $("#msg_EmptyLname").show();
                return false;
            }
            if(!username){
                //Hiển thị msg
                $("#msg_EmptyUsername").show();
                return false;
            }
            if(!password){
                //Hiển thị msg
                $("#msg_EmptyPassword").show();
                return false;
            }
            if(!cpassword){
                //Hiển thị msg
                $("#msg_EmptyCpassword").show();
                return false;
            }
            if(!phone){
                //Hiển thị msg
                $("#msg_EmptyPhone").show();
                return false;
            }
            //Kiểm tra xem 2 password trùng k
            if(password !== cpassword){
                $("#msg_ComparePassword").show();
                return false;
            }
        });
        //Xóa các msg khi user nhập mới
        $("#fname").focus(function(){
            $("#msg_EmptyFname").hide();
            $("#msg_EmptyLname").hide();
            $("#msg_EmptyUsername").hide();
            $("#msg_EmptyPassword").hide();
            $("#msg_EmptyCpassword").hide();
            $("#msg_EmptyPhone").hide();
            $("#msg_ComparePassword").hide();
            $("#msg_ErrorRegister").text('');
        });
        $("#lname").focus(function(){
            $("#msg_EmptyFname").hide();
            $("#msg_EmptyLname").hide();
            $("#msg_EmptyUsername").hide();
            $("#msg_EmptyPassword").hide();
            $("#msg_EmptyCpassword").hide();
            $("#msg_EmptyPhone").hide();
            $("#msg_ComparePassword").hide();
            $("#msg_ErrorRegister").text('');
        });
        $("#username").focus(function(){
            $("#msg_EmptyFname").hide();
            $("#msg_EmptyLname").hide();
            $("#msg_EmptyUsername").hide();
            $("#msg_EmptyPassword").hide();
            $("#msg_EmptyCpassword").hide();
            $("#msg_EmptyPhone").hide();
            $("#msg_ComparePassword").hide();
            $("#msg_ErrorRegister").text('');
        });
        $("#password").focus(function(){
            $("#msg_EmptyFname").hide();
            $("#msg_EmptyLname").hide();
            $("#msg_EmptyUsername").hide();
            $("#msg_EmptyPassword").hide();
            $("#msg_EmptyCpassword").hide();
            $("#msg_EmptyPhone").hide();
            $("#msg_ComparePassword").hide();
            $("#msg_ErrorRegister").text('');
        });
        $("#cpassword").focus(function(){
            $("#msg_EmptyFname").hide();
            $("#msg_EmptyLname").hide();
            $("#msg_EmptyUsername").hide();
            $("#msg_EmptyPassword").hide();
            $("#msg_EmptyCpassword").hide();
            $("#msg_EmptyPhone").hide();
            $("#msg_ComparePassword").hide();
            $("#msg_ErrorRegister").text('');
        });
        $("#phone").focus(function(){
            $("#msg_EmptyFname").hide();
            $("#msg_EmptyLname").hide();
            $("#msg_EmptyUsername").hide();
            $("#msg_EmptyPassword").hide();
            $("#msg_EmptyCpassword").hide();
            $("#msg_EmptyPhone").hide();
            $("#msg_ComparePassword").hide();
            $("#msg_ErrorRegister").text('');
        });
        //Hide or Show password
        //Khi nhấn nút Show
        $("#btn_showPassword").click(function(){
            //Thay đổi attr
            var msg = $("#btn_showPassword").text();
            if(msg === "Hiển thị"){
                $("#password").attr("type", "text");
                //Đổi show thành ẩn
                $("#btn_showPassword").text("Ẩn");
            }else{
                $("#password").attr("type", "password");
                //Đổi show thành ẩn
                $("#btn_showPassword").text("Hiển thị");
            }
        });
        $("#btn_showCpassword").click(function(){
            //Thay đổi attr
            var msg = $("#btn_showCpassword").text();
            if(msg === "Hiển thị"){
                $("#cpassword").attr("type", "text");
                //Đổi show thành ẩn
                $("#btn_showCpassword").text("Ẩn");
            }else{
                $("#cpassword").attr("type", "password");
                //Đổi show thành ẩn
                $("#btn_showCpassword").text("Hiển thị");
            }
        });
    });
</script>

<?php

    if(isset($_GET['e'])){
        $error = $_GET['e'];
        echo '<script>
                $(document).ready(function(){
                    $("#msg_ErrorRegister").text("'.$error.'");
                });
            </script>';
    }

?><?php /**PATH D:\Program Files\XamPP\htdocs\ThucTapTwo\resources\views/layout/register-form.blade.php ENDPATH**/ ?>