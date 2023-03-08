<?php

    include "connect.php";

    $user = isset($_GET['user'])?$_GET['user']:'';
    $order_id = isset($_GET['order_id'])?$_GET['order_id']:'';

    $sql = "SELECT user_address.*, user.id, user.username
    FROM user_address
    INNER JOIN user ON user_address.user_id = user.id
    WHERE user_address.order_id='$order_id'
    ";

    $result = $conn->query($sql);

    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        ?>
        <tr>
            <td><p><strong><?php echo $row['fullname'] ?></strong></p>
            <p>Địa chỉ: <?php echo $row['address'] ?></p>
            <p>Điện thoại: <?php echo $row['mobile'] ?></p>
            </td>
            <td>Thanh toán tiền mặt khi nhận hàng</td>
        </tr>
        <?php
    }

?>