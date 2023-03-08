<?php

    include "connect.php";

    $customer = isset($_GET['customer'])?$_GET['customer']:'';

    $sql = "SELECT order_details.*, user.id AS id_user, user.username, order_details.delete_at AS removeOrder
    FROM order_details
    INNER JOIN user ON user.id = order_details.user_id
    WHERE user.username='$customer'
    ";

    $result = $conn->query($sql);

    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            $order_id = $row['id'];
            $uid = $row['id_user'];
            ?>
                <tr>
                    <td>
                        <a style="color: rgb(0, 127, 240);" title="Xem chi tiết" href="order-details?order_id=<?php echo $row['id'] ?>&user=<?php echo $customer ?>"><?php echo $row['id'] ?> (Xem chi tiết)</a>
                    </td>
                    <td>
                        <?php echo $row['order_date'] ?>
                    </td>
                    <td><?php echo $row['delivery_date'] ?></td>
                    <td><?php echo $row['total'] ?></td>
                    <td>
                        <div class="price"><?php
                        
                            if($row['removeOrder'] == NULL){
                                //Chưa xóa
                                if($row['status'] == 1){
                                    echo "Chưa giao hàng";
                                }else if($row['status'] == 0){
                                    echo "Đã giao hàng";
                                }
                            }else if($row['removeOrder'] != NULL){
                                //Đã xóa
                                echo "<span style='color: tomato;'>Đã hủy</span>";
                            }    

                        ?>
                        </div>
                    </td>
                </tr>
            <?php
        }
    }
?>