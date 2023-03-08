<?php

    include "connect.php";

    $user_login = isset($_GET['user_login'])?$_GET['user_login']:'';
    $order_id = isset($_GET['order_id'])?$_GET['order_id']:'';

    //Lấy item trong order_items
    $sql = "SELECT order_details.*, order_items.*
    FROM order_details
    INNER JOIN order_items ON order_details.id = order_items.order_id
    WHERE order_details.id='$order_id'
    ";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            //Lấy tên sản phẩm và lấy ảnh tương ứng vs màu sắc
            $pid = $row['product_id'];
            // $sqli = "SELECT product.id, product.name, description.*
            // FROM product
            // INNER JOIN description ON product.id = description.product_id
            // WHERE product.id='$pid'
            // ";
            //Thử join 3 bảng
            $sqli = "SELECT product.id, product.name, product.price, product.discount_id, description.*, discount.id, discount.discount_percent, discount.active
            FROM ((product
            INNER JOIN description ON product.id = description.product_id)
            INNER JOIN discount ON product.discount_id = discount.id)
            WHERE product.id='$pid'
            ";
            $resulti = $conn->query($sqli);
            if($resulti->num_rows>0){
                while($rowi = $resulti->fetch_assoc()){
            ?>
                <tr>
                    <td>
                        
                        <?php  
                            if($rowi['dcolor1'] == $row['color']){
                                echo '<a href="product-details?pid='.$pid.'"><img src="product_images_desc/'.$rowi['photo_color1'].'" alt="Compete Track Tote" title="'.$rowi['name'].'"></a>';
                            }else if($rowi['dcolor2'] == $row['color']){
                                echo '<a href="product-details?pid='.$pid.'"><img src="product_images_desc/'.$rowi['photo_color2'].'" alt="Compete Track Tote" title="'.$rowi['name'].'"></a>';
                            }else if($rowi['dcolor3'] == $row['color']){
                                echo '<a href="product-details?pid='.$pid.'"><img src="product_images_desc/'.$rowi['photo_color3'].'" alt="Compete Track Tote" title="'.$rowi['name'].'"></a>';
                            } 
                        ?>
                        
                    </td>
                    <td>
                        <a href="product-details?pid=<?php echo $pid ?>"><?php echo $rowi['name'] ?></a>
                        <!-- <span>Delivery Date: 2019-09-22</span>
                        <span>Color: Brown</span>
                        <span>Reward Points: 300</span> -->
                    </td>
                    <td>
                        <?php
                            if(!$row['discount_percent_available']){
                                echo '';
                            }else{
                                echo $row['discount_percent_available'].'%';
                            }
                        ?>
                    </td>
                    <td><?php echo $row['color'] ?></td>
                    <td>
                        <div class="input-group btn-block">
                            <?php echo $row['quantity'] ?>
                        </div>
                    </td>
                    
                    <td>
                        <?php 
                            //Hiển thị giá theo màu sắc
                            if(strpos($row['color'], $rowi['dcolor1']) !== false){
                                if($row['discount_percent_available'] != NULL){
                                    echo number_format(($rowi['price_color1']*(100-$row['discount_percent_available']))/100).' đ';
                                }else if($row['discount_percent_available'] == NULL){
                                    echo number_format($rowi['price_color1']).' đ';
                                }
                            }else if(strpos($row['color'], $rowi['dcolor2']) !== false){
                                if($row['discount_percent_available'] != NULL){
                                    echo number_format(($rowi['price_color2']*(100-$row['discount_percent_available']))/100).' đ';
                                }else if($row['discount_percent_available'] == NULL){
                                    echo number_format($rowi['price_color2']).' đ';
                                }
                            }else if(strpos($row['color'], $rowi['dcolor3']) !== false){
                                if($row['discount_percent_available'] != NULL){
                                    echo number_format(($rowi['price_color3']*(100-$row['discount_percent_available']))/100).' đ';
                                }else if($row['discount_percent_available'] == NULL){
                                    echo number_format($rowi['price_color3']).' đ';
                                }
                            } 
                        ?>
                    </td>
                    <td>
                        <?php
                            if(strpos($row['color'], $rowi['dcolor1']) !== false){
                                if($row['discount_percent_available'] != NULL){
                                    echo number_format((($rowi['price_color1']*(100-$row['discount_percent_available']))/100)*$row['quantity']);
                                }else if($row['discount_percent_available'] == NULL){
                                    echo number_format($rowi['price_color1']*$row['quantity']);
                                }
                            }else if(strpos($row['color'], $rowi['dcolor2']) !== false){
                                if($row['discount_percent_available'] != NULL){
                                    echo number_format((($rowi['price_color2']*(100-$row['discount_percent_available']))/100)*$row['quantity']);
                                }else if($row['discount_percent_available'] == NULL){
                                    echo number_format($rowi['price_color2']*$row['quantity']);
                                }
                            }else if(strpos($row['color'], $rowi['dcolor3']) !== false){
                                if($row['discount_percent_available'] != NULL){
                                    echo number_format((($rowi['price_color3']*(100-$row['discount_percent_available']))/100)*$row['quantity']);
                                }else if($row['discount_percent_available'] == NULL){
                                    echo number_format($rowi['price_color3']*$row['quantity']);
                                }
                            } 
                        ?>
                    đ</td>
                </tr>
            <?php
                }
            }
        }
    }
?>