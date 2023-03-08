<div class="header-top-menu theme-bg">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="top-main-menu">
          <div class="categories-menu-bar">
            <nav id="btn_show" class="categorie-menus ha-dropdown">
              <ul id="menu2">
                <li>
                  <a href="<?php echo e(route('apple')); ?>">Apple<span
                      class="lnr lnr-chevron-right"></span></a>
                </li>
                <li>
                  <a href="<?php echo e(route('xiaomi')); ?>">Xiaomi<span
                      class="lnr lnr-chevron-right"></span></a>
                </li>
                <li>
                  <a href="<?php echo e(route('oppo')); ?>">OPPO<span
                      class="lnr lnr-chevron-right"></span></a>
                </li>
                <li>
                  <a href="<?php echo e(route('samsung')); ?>">Samsung<span
                      class="lnr lnr-chevron-right"></span></a>
                </li>
                <li>
                  <a href="<?php echo e(route('vsmart')); ?>">Vsmart<span
                      class="lnr lnr-chevron-right"></span></a>
                </li>
              </ul>
            </nav>
            <script>
            $(document).ready(function() {
              $("#show").hover(function() {
                $("#btn_show").show();
              });

              $("#show").mouseleave(function() {
                $("#btn_show").hide();
              });

              $("#btn_show").hover(function() {
                $("#btn_show").show();
              });
              $("#btn_show").mouseleave(function() {
                $("#btn_show").hide();
              });
            });
            </script>
          </div>
          <div class="main-menu">
            <nav id="mobile-menu">
              <ul>
                <li><a title="Đến xem sản phẩm Apple"
                    style="margin-left: 40px; padding: 0 0;"
                    href="<?php echo e(route('apple')); ?>"><img
                      style="height: 70px; width: 70px;"
                      src="<?php echo e(asset('img-brand/apple.png')); ?>" alt=""></a>
                </li>
                <li class="static">
                <li><a title="Đến xem sản phẩm Xiaomi"
                    style="margin: 0 40px; padding: 0 0;"
                    href="<?php echo e(route('xiaomi')); ?>"><img
                      style="height: 70px; width: 70px;"
                      src="<?php echo e(asset('img-brand/xiaomi.png')); ?>" alt=""></a>
                <li>
                  <a title="Đến xem sản phẩm Samsung"
                    style="margin-left: 0; margin-right: 40px; padding: 0 0;"
                    href="<?php echo e(route('samsung')); ?>"><img
                      style="height: 70px; width: 70px;"
                      src="<?php echo e(asset('img-brand/samsung.png')); ?>" alt=""></a>
                <li><a title="Đến xem sản phẩm Vsmart"
                    style="margin-left: 0; margin-right: 40px; padding: 0 0;"
                    href="<?php echo e(route('vsmart')); ?>"><img
                      style="height: 70px; width: 70px;"
                      src="<?php echo e(asset('img-brand/vsmart.png')); ?>" alt=""></a></li>
                <li><a title="Đến xem sản phẩm Oppo"
                    style="margin-left: 0; margin-right: 40px; padding: 0 0;"
                    href="<?php echo e(route('oppo')); ?>"><img
                      style="height: 70px; width: 70px;"
                      src="<?php echo e(asset('img-brand/oppo.png')); ?>" alt=""></a></li>
              </ul>
            </nav>
          </div> <!-- </div> end main menu -->
        </div>
      </div>
    </div>
  </div>
</div><?php /**PATH D:\PHP\xampp\htdocs\ThucTapTwo\resources\views/layout/header-top-menu.blade.php ENDPATH**/ ?>