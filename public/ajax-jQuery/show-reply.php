<?php

    include "connect.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';
    $reviews_id = isset($_GET['reviews_id'])?$_GET['reviews_id']:'';
    $reviewer = isset($_GET['reviewer'])?$_GET['reviewer']:'';
    //echo $reviews_id;

    $sql = "SELECT * FROM reply WHERE feedback_id='$reviews_id' AND product_id='$pid' AND reviewer='$reviewer'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            ?>
                <div style="width: 96%;margin-left: 40px;border: 1px solid #ccc;border-radius: 12px;" class="table table-striped table-bordered">
                    <header class="header-reply" style="display: flex;align-items: center;">
                        <strong style="margin-left: 1rem;"><?php echo $row['replyer'] ?></strong>
                        <i class="fas fa-circle" aria-hidden="true" style="font-size: 4px;margin: 0 4px;opacity: 0.7;"></i>
                        <span class="text-right" style="opacity: 0.7;"><?php echo $row['time_reply'].' - '.$row['date_reply'] ?></span>
                    </header>
                    <div class="body-reply" style="margin: 10px 0;">
                        <p style="margin-left: 1rem;"><?php echo $row['content_reply'] ?></p>
                                <!-- <div class="product-ratings">
                                    <ul class="ratting d-flex mt-2">
                                        <li><i class="far fa-star"></i></li>
                                        <li><i class="far fa-star"></i></li>
                                        <li><i class="far fa-star"></i></li>
                                        <li><i class="far fa-star"></i></li>
                                        <li><i class="far fa-star"></i></li>
                                    </ul>
                                </div> -->
                    </div>
                </div>
            <?php
        }
    }

?>
