<?php

    include "connect.php";  
    $pid = isset($_GET['pid'])?$_GET['pid']:'';

    //Lấy star trong table rating
    $sql = "SELECT AVG(star) AS average FROM rating WHERE product_id='$pid'";

    $result = $conn->query($sql);

    $avg = 0;

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $avg = $row['average'];
    }

    if($avg == 1){
        echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i class="far fa-star"></i></span>
        <span><i class="far fa-star"></i></span>
        <span><i class="far fa-star"></i></span>
        <span><i class="far fa-star"></i></span>';
    }else if($avg > 1 && $avg < 2){
        echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
        <i style="color: yellow;" class="fas fa-star-half-alt"></i>
        <span><i class="far fa-star"></i></span>
        <span><i class="far fa-star"></i></span>
        <span><i class="far fa-star"></i></span>';
    }else if($avg == 2){
        echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i class="far fa-star"></i></span>
        <span><i class="far fa-star"></i></span>
        <span><i class="far fa-star"></i></span>';
    }else if($avg > 2 && $avg < 3){
        echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <i style="color: yellow;" class="fas fa-star-half-alt"></i>   
        <span><i class="far fa-star"></i></span>
        <span><i class="far fa-star"></i></span>';
    }else if($avg == 3){
        echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i class="far fa-star"></i></span>
        <span><i class="far fa-star"></i></span>';
    }else if($avg > 3 && $avg < 4){
        echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <i style="color: yellow;" class="fas fa-star-half-alt"></i>   
        <span><i class="far fa-star"></i></span>';
    }else if($avg == 4){
        echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i class="far fa-star"></i></span>';
    }else if($avg > 4 && $avg < 5){
        echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <i style="color: yellow;" class="fas fa-star-half-alt"></i>';
    }else if($avg == 5){
        echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>
        <span><i style="color: yellow;" class="far fa-star"></i></span>';
    }
?>