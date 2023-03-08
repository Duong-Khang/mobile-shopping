<div class="brand-area pb-70">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h3><span>Thương Hiệu</span></h3>
        </div>
      </div>
      <div class="col-12">
        <ul class="">
          <li style="display: inline; margin-right: 30px;" id="btn_brand_apple">
            <a style="cursor: pointer;">
              <img style="height: 100px; width: 100px;"
                src="assets/img/brand/brand1.png" alt="">
            </a>
          </li>
          <li style="display: inline; margin-right: 30px;"
            id="btn_brand_xiaomi">
            <a style="cursor: pointer;">
              <img style="height: 115px; width: 160px;"
                src="assets/img/brand/brand2.png" alt="">
            </a>
          </li>
          <li style="display: inline; margin-right: 80px;"
            id="btn_brand_samsung">
            <a style="cursor: pointer;">
              <img style="height: 100px; width: 200px;"
                src="assets/img/brand/brand3.png" alt="">
            </a>
          </li>
          <li style="display: inline; margin-right: 80px;" id="btn_brand_oppo">
            <a style="cursor: pointer;">
              <img style="height: 100px; width: 100px;"
                src="assets/img/brand/brand4.png" alt="">
            </a>
          </li>
          <li style="display: inline; margin-right: 80px;"
            id="btn_brand_vsmart">
            <a style="cursor: pointer;">
              <img style="height: 100px; width: 50px;"
                src="assets/img/brand/brand5.png" alt="">
            </a>
          </li>
          <li style="display: inline;">
            <a>
              <img style="height: 100px; width: 150px;"
                src="assets/img/brand/brand7.png" alt="">
            </a>
          </li>
        </ul>
      </div>
      <div id="showBrand" class="module-four-wrapper custom-seven-column">
      </div>
      <div id="style_load_more_">
        <a id="change_filter_product" href="<?php echo e(route('shop')); ?>"><input
            id="btn_load_more_" type="button" class="btn btn-secondary"
            value="Xem thêm"></a>
      </div>
      <style>
      #style_load_more_ {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
      }

      /* #btn_load_more_{
                    cursor: pointer;
                    padding: 5px 20px;
                    border: 1px solid #ffc107;
                    color: #ffc107;
                    background-color: white;
                }
                #btn_load_more_:hover{
                    color: black;
                    background-color: #ffc107;
                } */
      </style>
      
      <script>
      $(document).ready(function() {
        //Hiển thị Apple khi load page
        var value_product = "Apple";
        $.ajax({
          url: "<?php echo e(route('get-apple')); ?>",
          type: "get",
          dataType: "text",
          data: {
            value_product: value_product
          },
          success: function(result) {
            $("#showBrand").html(result);
            $("#change_filter_product").attr("href",
              "<?php echo e(route('apple')); ?>");
          }
        });
        //Khi nhấn vào Apple
        $("#btn_brand_apple").click(function() {
          var value_product = "Apple";
          $.ajax({
            url: "<?php echo e(route('get-apple')); ?>",
            type: "get",
            dataType: "text",
            data: {
              value_product: value_product
            },
            success: function(result) {
              $("#showBrand").html(result);
              $("#change_filter_product").attr("href",
                "<?php echo e(route('apple')); ?>");
            }
          });
        });
        //Khi nhấn vào Xiaomi
        $("#btn_brand_xiaomi").click(function() {
          var value_product = "Xiaomi";
          $.ajax({
            url: "<?php echo e(route('get-apple')); ?>",
            type: "get",
            dataType: "text",
            data: {
              value_product: value_product
            },
            success: function(result) {
              $("#showBrand").html(result);
              $("#change_filter_product").attr("href",
                "<?php echo e(route('xiaomi')); ?>");
            }
          });
        });
        //Khi nhấn vào samsung
        $("#btn_brand_samsung").click(function() {
          var value_product = "Samsung";
          $.ajax({
            url: "<?php echo e(route('get-apple')); ?>",
            type: "get",
            dataType: "text",
            data: {
              value_product: value_product
            },
            success: function(result) {
              $("#showBrand").html(result);
              $("#change_filter_product").attr("href",
                "<?php echo e(route('samsung')); ?>");
            }
          });
        });
        //Khi nhấn vào oppo
        $("#btn_brand_oppo").click(function() {
          var value_product = "Oppo";
          $.ajax({
            url: "<?php echo e(route('get-apple')); ?>",
            type: "get",
            dataType: "text",
            data: {
              value_product: value_product
            },
            success: function(result) {
              $("#showBrand").html(result);
              $("#change_filter_product").attr("href",
                "<?php echo e(route('oppo')); ?>");
            }
          });
        });
        //Khi nhấn vào vsmart
        $("#btn_brand_vsmart").click(function() {
          var value_product = "Vsmart";
          $.ajax({
            url: "<?php echo e(route('get-apple')); ?>",
            type: "get",
            dataType: "text",
            data: {
              value_product: value_product
            },
            success: function(result) {
              $("#showBrand").html(result);
              $("#change_filter_product").attr("href",
                "<?php echo e(route('vsmart')); ?>");
            }
          });
        });
      });
      </script>
    </div>
  </div>
</div><?php /**PATH D:\PHP\xampp\htdocs\ThucTapTwo\resources\views/layout/brand-area.blade.php ENDPATH**/ ?>