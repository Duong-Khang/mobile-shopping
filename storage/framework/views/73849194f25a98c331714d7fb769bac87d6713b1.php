<div class="header-top-menu theme-bg sticker">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-main-menu">
                    <div class="categories-menu-bar">
                        
                        <nav id="btn_show" class="categorie-menus ha-dropdown">
                            <ul id="menu2">
                                <li><a href="<?php echo e(route('apple')); ?>">Apple<span class="lnr lnr-chevron-right"></span></a>
                                    
                                    <input type="hidden" name="" id="apple_link" value="Apple">
                                    <ul style="width: 530px;" id="show_link_apple" class="cat-submenu">
                                        
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/1">Điện Thoại iPhone 11 128GB - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/2">Điện Thoại iPhone 12 64GB - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/3">Điện Thoại iPhone 12 Pro Max 128GB - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/4">Điện Thoại iPhone 12 Mini 64GB - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/5">Điện Thoại iPhone 11 64GB - Hàng Chính Hãng</a></li>
                                    </ul>
                                    
                                    <script>
                                        $(document).ready(function(){
                                            var cate = $("#apple_link").val();

                                            $.ajax({
                                                url: "<?php echo e(route('show-link-product')); ?>",
                                                type: "get",
                                                dataType: "text",
                                                data: {
                                                    cate: cate
                                                },
                                                success: function(result){
                                                    $("#show_link_apple").html(result);
                                                }
                                            });
                                        });
                                    </script>
                                </li>
                                <li><a href="<?php echo e(route('xiaomi')); ?>">Xiaomi<span class="lnr lnr-chevron-right"></span></a>
                                    
                                    <input type="hidden" name="" id="xiaomi_link" value="Xiaomi">
                                    <ul style="width: 530px;" id="show_link_xiaomi" class="cat-submenu">
                                        
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/6">Điện thoại Xiaomi Redmi 9A (2GB/32GB) - Hàng chính hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/7">Điện thoại Xiaomi POCO X3 PRO - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/8">Điện thoại POCO M3 Pro 5G (6GB/128GB) - Hàng chính hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/9">Điện Thoại Xiaomi Redmi Note 10 Pro - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/10">Điện Thoại Thông Minh Xiaomi Poco F3 - Hàng Chính Hãng</a></li>
                                    </ul>
                                    
                                    <script>
                                        $(document).ready(function(){
                                            var cate = $("#xiaomi_link").val();

                                            $.ajax({
                                                url: "<?php echo e(route('show-link-product')); ?>",
                                                type: "get",
                                                dataType: "text",
                                                data: {
                                                    cate: cate
                                                },
                                                success: function(result){
                                                    $("#show_link_xiaomi").html(result);
                                                }
                                            });
                                        });
                                    </script>
                                </li>
                                <li><a href="<?php echo e(route('oppo')); ?>">OPPO<span class="lnr lnr-chevron-right"></span></a>
                                    
                                    <input type="hidden" name="" id="oppo_link" value="Oppo">
                                    <ul style="width: 530px;" id="show_link_oppo" class="cat-submenu">
                                        
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/11">Điện Thoại Samsung Galaxy S20 Plus (8GB/128GB) - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/12">Điện Thoại Samsung Galaxy A51 (6GB/128GB) - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/13">Điện Thoại Samsung Galaxy M11 (3GB/32GB) - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/14">Điện Thoại Samsung Galaxy A11 (3GB/32GB) - Hàng Chính Hãng</a></li>
                                        
                                    </ul>
                                    
                                    <script>
                                        $(document).ready(function(){
                                            var cate = $("#oppo_link").val();

                                            $.ajax({
                                                url: "<?php echo e(route('show-link-product')); ?>",
                                                type: "get",
                                                dataType: "text",
                                                data: {
                                                    cate: cate
                                                },
                                                success: function(result){
                                                    $("#show_link_oppo").html(result);
                                                }
                                            });
                                        });
                                    </script>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('samsung')); ?>">Samsung<span class="lnr lnr-chevron-right"></span></a>
                                    <input type="hidden" name="" id="samsung_link" value="Samsung">
                                    <ul style="width: 530px;" id="show_link_samsung" class="cat-submenu">
                                        
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/16">Điện Thoại Oppo A54 (4GB/128GB) - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/17">Điện Thoại Oppo Reno 6 5G (8GB/128G) - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/19">Điện Thoại Oppo Find X3 Pro 5G (12GB/256G) - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/20">Điện Thoại Oppo A94 (8GB/128G) - Hàng Chính Hãng</a></li>
                                    </ul>
                                    
                                    <script>
                                        $(document).ready(function(){
                                            var cate = $("#samsung_link").val();

                                            $.ajax({
                                                url: "<?php echo e(route('show-link-product')); ?>",
                                                type: "get",
                                                dataType: "text",
                                                data: {
                                                    cate: cate
                                                },
                                                success: function(result){
                                                    $("#show_link_samsung").html(result);
                                                }
                                            });
                                        });
                                    </script>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('vsmart')); ?>">Vsmart<span class="lnr lnr-chevron-right"></span></a>
                                    <input type="hidden" name="" id="vsmart_link" value="Vsmart">
                                    <ul style="width: 530px;" id="show_link_vsmart" class="cat-submenu">
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/22">Điện Thoại Vsmart Joy 4 - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/23">Điện Thoại Vsmart Star 5 (4GB/64GB) - Hàng Chính Hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/24">Điện thoại Vsmart Aris Pro (8GB/128GB) - Hàng chính hãng</a></li>
                                        <li><a href="http://localhost:8080/ThucTapTwo/public/chi-tiet-san-pham/25">Điện thoại Vsmart Aris (6GB/64GB) - Hàng Chính Hãng</a></li>
                                    </ul>
                                    
                                    <script>
                                        $(document).ready(function(){
                                            var cate = $("#vsmart_link").val();

                                            $.ajax({
                                                url: "<?php echo e(route('show-link-product')); ?>",
                                                type: "get",
                                                dataType: "text",
                                                data: {
                                                    cate: cate
                                                },
                                                success: function(result){
                                                    $("#show_link_vsmart").html(result);
                                                }
                                            });
                                        });
                                    </script>
                                </li>
                            </ul>
                        </nav>
                        <script>
                            $(document).ready(function(){
                                $("#show").hover(function(){
                                    $("#btn_show").show();
                                });

                                $("#show").mouseleave(function(){
                                    $("#btn_show").hide();
                                });

                                $("#btn_show").hover(function(){
                                    $("#btn_show").show();
                                });
                                $("#btn_show").mouseleave(function(){
                                    $("#btn_show").hide();
                                });
                            });
                        </script>
                    </div>
                    <div class="main-menu">
                        <nav id="mobile-menu">
                            <ul>
                                <li><a title="Đến xem sản phẩm Apple" style="margin-left: 40px; padding: 0 0;" href="<?php echo e(route('apple')); ?>"><img style="height: 70px; width: 70px;" src="<?php echo e(asset('img-brand/apple.png')); ?>" alt=""></a>
                                </li>
                                <li class="static">
                                    <li><a title="Đến xem sản phẩm Xiaomi" style="margin: 0 40px; padding: 0 0;" href="<?php echo e(route('xiaomi')); ?>"><img style="height: 70px; width: 70px;" src="<?php echo e(asset('img-brand/xiaomi.png')); ?>" alt=""></a>
                                <li>
                                    <a title="Đến xem sản phẩm Samsung" style="margin-left: 0; margin-right: 40px; padding: 0 0;" href="<?php echo e(route('samsung')); ?>"><img style="height: 70px; width: 70px;" src="<?php echo e(asset('img-brand/samsung.png')); ?>" alt=""></a>
                                <li><a title="Đến xem sản phẩm Vsmart" style="margin-left: 0; margin-right: 40px; padding: 0 0;" href="<?php echo e(route('vsmart')); ?>"><img style="height: 70px; width: 70px;" src="<?php echo e(asset('img-brand/vsmart.png')); ?>" alt=""></a></li>
                                <li><a title="Đến xem sản phẩm Oppo" style="margin-left: 0; margin-right: 40px; padding: 0 0;" href="<?php echo e(route('oppo')); ?>"><img style="height: 70px; width: 70px;" src="<?php echo e(asset('img-brand/oppo.png')); ?>" alt=""></a></li>
                            </ul>
                        </nav>
                    </div> <!-- </div> end main menu -->
                    
                </div>
            </div>
            <div class="col-12 d-block d-lg-none">
                <div class="mobile-menu"></div>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\Program Files\XamPP\htdocs\ThucTapTwo\resources\views/layout/header-top-menu.blade.php ENDPATH**/ ?>