<?php

    include "connect.php";

    //Lấy data
    $pid = isset($_GET['pid'])?$_GET['pid']:'';
    $reviews_id = isset($_GET['reviews_id'])?$_GET['reviews_id']:'';
    $reviewer = isset($_GET['reviewer'])?$_GET['reviewer']:'';
    $replyer = isset($_GET['replyer'])?$_GET['replyer']:'';
    $content = isset($_GET['content'])?$_GET['content']:'';

    //Lấy thời gian reply
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $time = date("h:ia");
    $date = date("d/m/Y");

    //Lấy user_id
    $user_reply_id = 0;
    $getUserID = "SELECT * FROM user WHERE username='$replyer'";

    $resultGetUserID = $conn->query($getUserID);

    if($resultGetUserID->num_rows > 0){
        $rowResultGetUserID = $resultGetUserID->fetch_assoc();
        $user_reply_id = $rowResultGetUserID['id'];
    }

    //Insert vào table reply
    $sql = "INSERT INTO reply(product_id, feedback_id, reviewer, replyer, content_reply, user_reply_id, time_reply, date_reply)
    VALUES('$pid', '$reviews_id', '$reviewer', '$replyer', '$content', '$user_reply_id', '$time', '$date')
    ";

    if($conn->query($sql) === TRUE){
        echo "success";
    }else{
        echo "error";
    }
?>