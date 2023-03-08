<div class="header-top black-bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="header-top-left">
                    <ul>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div id="show_check_login" class="box box-right">
                    <ul>
                        <li class="settings">                 
                            
                            <?php
                                if(Session::has('username')){
                                    $user = session('username');  
                            ?>
                                <a class="ha-toggle" href="#"><i class="far fa-user"></i><?php echo " ".$user; ?><span class="lnr lnr-chevron-down"></span></a>
                                <ul style="width: 200px;" id="dashboard_user" class="box-dropdown ha-dropdown">
                                    <li><a href="<?php echo e(route('order-list')); ?>">Danh sách đơn hàng</a></li>
                                    <li><a href="<?php echo e(route('my-account')); ?>">Đổi mật khẩu</a></li>                            
                                    <li><a href="<?php echo e(route('dang-xuat')); ?>">Đăng xuất</a></li>
                                </ul>
                            <?php
                                }else{
                            ?>
                                <li class="settings">
                                    <a class="ha-toggle" href="<?php echo e(route('dang-nhap')); ?>"><i class="far fa-user"></i> Đăng nhập</a>
                                </li>
                                <li class="currency">
                                    <a class="ha-toggle" href="<?php echo e(route('dang-ky')); ?>"><i class="far fa-user"></i> Đăng ký</a>
                                </li>
                            <?php
                                }
                            ?>
                        </li>
                    </ul>
                </div>
                <div style="display: none;" class="box box-right" id="show_check_login_success">
                    <ul>
                        <li class="settings">
                            <a class="ha-toggle" href="#"><i class="far fa-user"></i><span style="font-size: 15px;" id="show_info_login_quick"></span><span class="lnr lnr-chevron-down"></span></a>
                            <ul style="width: 200px;" class="box-dropdown ha-dropdown">
                                <li><a href="<?php echo e(route('order-list')); ?>">Danh sách đơn hàng</a></li>
                                <li><a href="<?php echo e(route('my-account')); ?>">Đổi mật khẩu</a></li>
                                <li><a href="<?php echo e(route('dang-xuat')); ?>">Đăng xuất</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#show_check_login_success").hide();
        $("#show_check_login").mouseover(function(){
            $("#dashboard_user").show();
        });
        $("#show_check_login").mouseleave(function(){
            $("#dashboard_user").hide();
        });
    });
</script><?php /**PATH D:\xampp\htdocs\ThucTapTwo\resources\views/layout/header-top.blade.php ENDPATH**/ ?>