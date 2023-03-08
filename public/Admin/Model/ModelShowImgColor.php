<?php

    class ShowImgColor{

        public function showImgColor($table, $conn, $pid, $color){

            $sql = "SELECT * FROM $table WHERE product_id='$pid' AND (dcolor1='$color' OR dcolor2='$color' OR dcolor3='$color')";

            $result = $conn->query($sql);

            if($result -> num_rows > 0){
                $row = $result->fetch_assoc();

                //Hiển thị ảnh tương ứng với màu
                if($color == $row['dcolor1']){
                    echo '<img src="/product_images_desc/'.$row['photo_color1'].'" width="40" height="40" alt="" />';
                }else if($color == $row['dcolor2']){
                    echo '<img src="/product_images_desc/'.$row['photo_color2'].'" width="40" height="40" alt="" />';
                }else if($color == $row['dcolor3']){
                    echo '<img src="/product_images_desc/'.$row['photo_color3'].'" width="40" height="40" alt="" />';
                }
            }

        }

    }
