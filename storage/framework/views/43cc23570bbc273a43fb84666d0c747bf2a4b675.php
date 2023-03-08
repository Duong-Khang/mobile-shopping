<div class="login-wrapper pb-70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <main id="primary" class="site-main">
                    <div class="user-login">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="section-title text-center">
                                    <h3>Đăng nhập</h3>
                                </div>
                            </div>
                        </div> <!-- end of row -->
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-6 offset-lg-2 offset-xl-3">
                                <div style="padding-top: 40px; padding-bottom: 15px; " class="login-form">
                                    
                                    
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
                                    <div class="login-box mt-0 text-center">
                                        <button type="submit" id="btn_login" class="btn btn-secondary mb-2 mt-0">Đăng nhập</button>
                                    </div>
                                    <div class="text-center pt-2 top-bordered">
                                        <p>Chưa có tài khoản? <a href="<?php echo e(route('dang-ky')); ?>">Tạo tài khoản</a>.</p>
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
    $(document).ready(function() {
        //Khi nhấn nút đăng nhập
        $("#btn_login").click(function() {
            //Lấy data từ form
            var username = $("#username").val();
            var password = $("#password").val();
            //Kiểm tra username xem có rổng không
            if (!username) {
                //Hiển thị msg
                alert("Chưa nhập tài khoản");
                return false;
            }
            //Kiểm tra password xem có rổng không
            if (!password) {
                //Hiển thị msg
                alert("Chưa nhập mật khẩu");
                return false;
            }
            //Gửi ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('xu-ly-dang-nhap')); ?>",
                type: "post",
                dataType: "text",
                data: {
                    username: username,
                    password: password
                },
                success: function(result) {
                    if (result !== "Success") {
                        alert(result);
                    } else {
                        window.location.href = "/";
                    }
                }
            });
        });
        //Hide or Show password
        //Khi nhấn nút Show
        $("#showPassword").click(function() {
            //Thay đổi attr
            var msg = $("#showPassword").text();
            if (msg === "Hiển thị") {
                $("#password").attr("type", "text");
                //Đổi show thành ẩn
                $("#showPassword").text("Ẩn");
            } else {
                $("#password").attr("type", "password");
                //Đổi show thành ẩn
                $("#showPassword").text("Hiển thị");
            }
        });
    });
</script><?php /**PATH D:\PHP\xampp\htdocs\ThucTapTwo\resources\views/layout/login-form.blade.php ENDPATH**/ ?>