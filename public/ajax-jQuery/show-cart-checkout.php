<?php

    include "connect.php";

    $customer = isset($_GET['customer'])?$_GET['customer']:'';
    //Thực hiện truy vấn
    $sql = "SELECT cart_item.product_id, cart_item.customer, product.*, cart_item.quantity, cart_item.color
    FROM cart_item
    INNER JOIN product
    ON cart_item.product_id=product.id
    WHERE cart_item.customer='$customer'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            //Lấy %discount
            $discount_id = $row['discount_id'];
            $sqld = "SELECT * FROM discount WHERE id='$discount_id'";
            $resultd = $conn->query($sqld);
            if($resultd->num_rows > 0){
                while($rowd = $resultd->fetch_assoc()){
                    $desc_id = $row['product_id'];
                    //Lấy ảnh trong desc
                    $sqlc = "SELECT * FROM `description` WHERE product_id='$desc_id'";
                    $resultc = $conn->query($sqlc);
                    if($resultc->num_rows > 0){
                        while($rowc = $resultc->fetch_assoc()){
                   ?>
                        <div class="product-list">
                            <div class="product-inner media align-items-center">
                                <div class="product-image mr-4 mr-sm-5 mr-md-4 mr-lg-5">
                                    <a href="product-details?pid=<?php echo $row['product_id'] ?>">
                                        <?php  
                                            if($rowc['dcolor1'] == $row['color']){
                                                echo '<img src="product_images_desc/'.$rowc['photo_color1'].'" alt="Compete Track Tote" title="'.$row['name'].'">';
                                            }else if($rowc['dcolor2'] == $row['color']){
                                                echo '<img src="product_images_desc/'.$rowc['photo_color2'].'" alt="Compete Track Tote" title="'.$row['name'].'">';
                                            }else if($rowc['dcolor3'] == $row['color']){
                                                echo '<img src="product_images_desc/'.$rowc['photo_color3'].'" alt="Compete Track Tote" title="'.$row['name'].'">';
                                            } 
                                        ?>
                                        
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h5><?php echo $row['name'] ?></h5>
                                    <p class="product-quantity">Số lượng: <?php echo $row['quantity'] ?></p>
                                    <p class="product-quantity">Màu: <?php echo $row['color'] ?></p>
                                    <p class="product-final-price">Giá: 
                                    <?php 
                                        //Hiển thị giá tiền theo màu
                                        if(strpos($row['color'], $rowc['dcolor1']) !== false){
                                            if($rowd['active'] == 1){
                                                echo number_format(($rowc['price_color1']*(100-$rowd['discount_percent']))/100);
                                            }else if($rowd['active'] == 0||$rowd['active'] == 2){
                                                echo number_format($rowc['price_color1']);
                                            }
                                        }else if(strpos($row['color'], $rowc['dcolor2']) !== false){
                                            if($rowd['active'] == 1){
                                                echo number_format(($rowc['price_color2']*(100-$rowd['discount_percent']))/100);
                                            }else if($rowd['active'] == 0||$rowd['active'] == 2){
                                                echo number_format($rowc['price_color2']);
                                            }
                                        }else if(strpos($row['color'], $rowc['dcolor3']) !== false){
                                            if($rowd['active'] == 1){
                                                echo number_format(($rowc['price_color3']*(100-$rowd['discount_percent']))/100);
                                            }else if($rowd['active'] == 0||$rowd['active'] == 2){
                                                echo number_format($rowc['price_color3']);
                                            }
                                        } 
                                    ?>
                                     đ</p>
                                </div>
                            </div>
                        </div>
                   <?php
                        }
                    }
                }
            }
        }
    }
?>