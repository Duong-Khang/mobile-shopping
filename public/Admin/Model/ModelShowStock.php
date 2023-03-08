<?php

    class ShowStock{

        public function showStock($table, $conn, $pid, $color){

            $sql = "SELECT * FROM product WHERE id='$pid'";

            $result = $conn->query($sql);

            if($result -> num_rows > 0){
                $row = $result->fetch_assoc();

                $stock_id = $row['inventory_id'];

                //Lấy stock ứng vs màu sắc
                $sqlin = "SELECT * FROM product_inventory WHERE id='$stock_id' AND (color1='$color' OR color2='$color' oR color3='$color')";
                $resultin = $conn->query($sqlin);
                if($resultin->num_rows > 0){
                    $rowin = $resultin->fetch_assoc();
                    //Cập nhật theo màu sắc
                    if($rowin['color1'] == $color){
                        $quantityin = $rowin['quantity_color1'];
                        if($quantityin > 0){
                            echo '<div class="badge badge-sa-success">' . $quantityin . ' trong kho</div>';
                        }else{
                            echo '<div class="badge badge-sa-danger">Hết hàng</div>';
                        }
                    }else if($rowin['color2'] == $color){
                        $quantityin = $rowin['quantity_color2'];
                        if($quantityin > 0){
                            echo '<div class="badge badge-sa-success">' . $quantityin . ' trong kho</div>';
                        }else{
                            echo '<div class="badge badge-sa-danger">Hết hàng</div>';
                        }
                    }else if($rowin['color3'] == $color){
                        $quantityin = $rowin['quantity_color3'];
                        if($quantityin > 0){
                            echo '<div class="badge badge-sa-success">' . $quantityin . ' trong kho</div>';
                        }else{
                            echo '<div class="badge badge-sa-danger">Hết hàng</div>';
                        }
                    }
                }
            }

        }

    }

?>