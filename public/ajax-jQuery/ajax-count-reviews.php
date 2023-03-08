<?php

    include "connect.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';

    $total = 0;

    $sql = "SELECT COUNT(product_id) AS totalReviews FROM feedback WHERE product_id='$pid'";

    $result = $conn->query($sql);

    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $total += $row['totalReviews'];
    }

    $sql = "SELECT COUNT(product_id) AS totalReviews FROM reply WHERE product_id='$pid'";

    $result = $conn->query($sql);

    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $total += $row['totalReviews'];
    }

    echo $total;
?>