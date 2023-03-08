<div class="home-module-four">
    <div class="container-fluid">
        <div class="section-title">
            <h3>Sản phẩm<span> Bán chạy nhất</span></h3>
        </div>
        <div class="pro-module-four-active owl-carousel owl-arrow-style">
            <?php
                $conn = mysqli_connect('localhost', 'root', '', 'thuctap') or die ('Không thể kết nối đến CSDL');
                mysqli_set_charset($conn, 'utf8');
                $sql = "SELECT product.*, discount.id AS did, discount.active, discount.discount_percent
                FROM product
                INNER JOIN discount ON product.discount_id = discount.id
                WHERE product.delete_at IS NULL
                ";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
            ?>
            <div style="margin-bottom: 15px;" class="product-module-four-item">
                <div style="height: 150px;" class="product-module-caption">
                    <div class="manufacture-com">
                        <p><a><?php echo $row['manufacturer'] ?></a></p>
                    </div>
                    <div class="product-module-name">
                        <h4><a href="product-details?pid=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></h4>
                    </div>
                    <input type="hidden" name="" id="pid___<?php echo $row['id'] ?>" value="<?php echo $row['id'] ?>">
                    <div id="show_star___<?php echo $row['id'] ?>" class="ratings">
                        <!-- Hiển thị trung bình sao ở đây -->
                    </div>
                    <script>
                        $(document).ready(function(){
                            var pid = $("#pid___<?php echo $row['id'] ?>").val();
                            $.ajax({
                                url: "ajax-jQuery/show-star-avg.php",
                                type: "get",
                                dataType: "text",
                                data: {
                                    pid: pid
                                },
                                success: function(result){
                                    $("#show_star___<?php echo $row['id'] ?>").html(result);
                                }
                            });
                        });
                    </script>
                    <div class="price-box-module">
                        <?php
                            if($row['active'] == 1){
                                echo '<span class="regular-price"><span class="special-price">'.number_format(($row['price']*(100-$row['discount_percent']))/100).' đ'.'</span></span>';
                            }else if($row['active'] == 0 || $row['active'] == 2){
                                echo '<span class="regular-price"><span class="special-price">'.number_format($row['price']).' đ</span></span>';
                            }
                        ?>
                        <?php
                            if($row['active'] == 1){
                                echo '
                                <span class="old-price"><del>'.number_format($row['price']).' đ</del></span>
                                ';
                            }
                        ?>
                    </div>
                </div>
                <div class="product-module-thumb">
                    <a href="product-details?pid=<?php echo $row['id'] ?>">
                        <img style="height: 100px; width: 300px;" src="product_images/<?php echo $row['photo_name'] ?>" class="" alt="">
                    </a>
                </div>
            </div> 
            <?php
                    }
                }
            ?>
        </div>
    </div>
</div><?php /**PATH D:\xampp\htdocs\ThucTapTwo\resources\views/layout/home-product-module-six.blade.php ENDPATH**/ ?>