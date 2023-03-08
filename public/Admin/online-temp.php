<?php
    include "connect.php";
    session_start(); //khởi tạo session
    $guest_id = session_id();
    $time = time();
    $time_check = $time-60; //Ấn định thời gian là 10 phút

    $sql = "SELECT * FROM guest_online WHERE guest_id='$guest_id'";
    $result = $conn->query($sql);

    if($result->num_rows>0){//Lần 2
        $sqlu = "UPDATE guest_online SET time='$time' WHERE guest_id='$guest_id'";
        $conn->query($sqlu);
    }else{//Lần đầu
        $sqli = "INSERT INTO guest_online(guest_id, time_live)
        VALUES('$guest_id', '$time')";
        $conn->query($sqli);
    }

    $sqla = "SELECT * FROM guest_online";

    $resulta = $conn->query($sqla);
    echo 'Online: '.$resulta->num_rows - 1;
    echo '</b> '.$guest_id;

    $sqld = "DELETE FROM guest_online WHERE time_live < $time_check";
    $conn->query($sqld);
