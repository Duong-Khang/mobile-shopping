<div class="product-wrapper fix pb-70">
  <div class="container-fluid">
    <div class="section-title product-spacing hm-11">
      <h3><span>Sản phẩm</span> của chúng tôi</h3>
    </div>
    <div class="tab-content">
      <div class="tab-pane fade show active">
        <div class="product-gallary-wrapper">
          {{-- Hiển thị Sản phẩm của chúng tôi ở đây --}}
          <div id="show_our_product"
            class="product-gallary-active owl-carousel owl-arrow-style product-spacing">
            <?php
                        include './Admin/connect.php';
                        $sql = "SELECT product.*, discount.id AS did, discount.active, discount.discount_percent
                            FROM product
                            INNER JOIN discount ON product.discount_id = discount.id
                            ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
            <div style="height: 380px;" class="product-item">
              <div class="product-thumb">
                <a href="/chi-tiet-san-pham/<?php echo $row['id'] ?>">
                  <img style="height: 200px; width: 200px;"
                    src="product_images/<?php echo $row['photo_name'] ?>"
                    class="pri-img" alt="">
                  <img style="height: 200px; width: 200px;"
                    src="product_images/<?php echo $row['photo_name'] ?>"
                    class="sec-img" alt="">
                </a>
                <div class="box-label">
                  <?php
                                            if ($row['active'] == 1) {
                                                echo '
                                            <div class="label-product label_sale">
                                                <span>-' . $row['discount_percent'] . '%</span>
                                            </div>
                                            ';
                                            }
                                            ?>
                </div>
              </div>
              <div class="product-caption">
                <div class="manufacture-product">
                  <p><a><?php echo $row['manufacturer'] ?></a></p>
                </div>
                <div class="product-name">
                  <h4><a
                      href="/chi-tiet-san-pham/<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
                  </h4>
                </div>
                <input type="hidden" name="" id="pid_<?php echo $row['id'] ?>"
                  value="<?php echo $row['id'] ?>">
                <div id="show_star_<?php echo $row['id'] ?>" class="ratings">
                  <!-- Hiển thị trung bình sao ở đây -->
                </div>
                <script>
                $(document).ready(function() {
                  var pid = $("#pid_<?php echo $row['id'] ?>").val();
                  $.ajax({
                    url: "{{route('show-average-star')}}",
                    type: "get",
                    dataType: "text",
                    data: {
                      pid: pid
                    },
                    success: function(result) {
                      $("#show_star_<?php echo $row['id'] ?>").html(
                        result);
                    }
                  });
                });
                </script>
                <div class="price-box">
                  <?php
                                            if ($row['active'] == 1) {
                                                echo '<span class="regular-price"><span class="special-price">' . number_format(($row['price'] * (100 - $row['discount_percent'])) / 100) . '</span>đ</span>';
                                            } else if ($row['active'] == 0) {
                                                echo '<span class="regular-price"><span class="special-price">' . number_format($row['price']) . '</span>đ</span>';
                                            }
                                            ?>
                  <?php
                                            if ($row['active'] == 1) {
                                                echo '
                                            <span class="old-price"><del>' . number_format($row['price']) . 'đ</del></span>
                                            ';
                                            }
                                            ?>
                </div>
              </div>
            </div>
            <?php
                            }
                        }
                        ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>