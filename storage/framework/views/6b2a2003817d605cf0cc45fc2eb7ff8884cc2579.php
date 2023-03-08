<div class="login-wrapper pb-70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <main id="primary" class="site-main">
                    <div class="user-login">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="section-title text-center">
                                    <h3>Đăng ký</h3>
                                </div>
                            </div>
                        </div> <!-- end of row -->
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 offset-xl-2">
                                <div class="registration-form login-form">
                                    
                                        <div class="login-info mb-20">
                                            <p>Đã có tài khoản? <a style="color: #007bff;" href="<?php echo e(route('dang-nhap')); ?>">Đăng nhập!</a></p>
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
                                        
                                        <div class="register-box d-flex justify-content-end mt-20">
                                            <button type="submit" id="btn_register" class="btn btn-secondary">Đăng ký</button>
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

<script>
    $(document).ready(function(){
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
           
            if(!username){
                //Hiển thị msg
                alert("Chưa nhập tên tài khoản");
                return false;
            }
            if(!password){
                //Hiển thị msg
                alert("Chưa nhập mật khẩu");
                return false;
            }
            if(!cpassword){
                //Hiển thị msg
                alert("Chưa nhập lại mật khẩu");
                return false;
            }
            //Kiểm tra xem 2 password trùng k
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
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('xu-ly-dang-ky')); ?>",
                type: "post",
                dataType: "text",
                data: {
                    username: usernameNew,
                    password: password
                },
                success: function(result){
                    if(result !== "Success"){
                        alert(result);
                    }else{
                        window.location.href = "http://localhost:8080/ThucTapTwo/public/";
                    }                   
                }
            });
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
<?php /**PATH D:\xampp\htdocs\ThucTapTwo\resources\views/layout/register-form.blade.php ENDPATH**/ ?>