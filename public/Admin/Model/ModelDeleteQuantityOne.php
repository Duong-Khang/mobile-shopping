<?php

    class DeleteQuantityOne{

        public function removeQuantityOne($table, $conn, $customer, $pid, $color){

            $sql = "DELETE FROM $table WHERE _customer='$customer' AND _product_id='$pid' AND _color='$color'";

            if($conn->query($sql) === TRUE){
                //Cập nhật số lượng trong inventory
                $sqlget = "SELECT * FROM product WHERE id='$pid'";
                    $resultget = $conn->query($sqlget);
                    if($resultget->num_rows > 0){
                        $rowget = $resultget->fetch_assoc();
                        $stock_id = $rowget['inventory_id'];
                        // $sqlin = "SELECT * FROM product_inventory WHERE id='$stock_id'";
                        // $resultin = $conn->query($sqlin);
                        // if($resultin->num_rows > 0){
                        //     $rowin = $resultin->fetch_assoc();
                        //     $quantityin = $rowin['quantity'];
                        //     $quantityin += 1;
                        //     //Update
                        //     $sqlu_ = "UPDATE product_inventory SET quantity='$quantityin' WHERE id='$stock_id'";
                        //     $conn->query($sqlu_);
                        // }

                        //Cập nhật lại số lượng trong kho
                        $sqlin = "SELECT * FROM product_inventory WHERE id='$stock_id' AND (color1='$color' OR color2='$color' oR color3='$color')";
                        $resultin = $conn->query($sqlin);
                        if($resultin->num_rows > 0){
                            $rowin = $resultin->fetch_assoc();
                            //Cập nhật theo màu sắc
                            if($rowin['color1'] == $color){
                                $quantityin = $rowin['quantity_color1'];
                                $quantityin += 1;
                                //Update
                                $sqlu = "UPDATE product_inventory SET quantity_color1='$quantityin' WHERE id='$stock_id' AND color1='$color'";
                                $conn->query($sqlu);
                            }else if($rowin['color2'] == $color){
                                $quantityin = $rowin['quantity_color2'];
                                $quantityin += 1;
                                //Update
                                $sqlu = "UPDATE product_inventory SET quantity_color2='$quantityin' WHERE id='$stock_id' AND color2='$color'";
                                $conn->query($sqlu);
                            }else if($rowin['color3'] == $color){
                                $quantityin = $rowin['quantity_color3'];
                                $quantityin += 1;
                                //Update
                                $sqlu = "UPDATE product_inventory SET quantity_color3='$quantityin' WHERE id='$stock_id' AND color3='$color'";
                                $conn->query($sqlu);
                            }
                        }
                    }
                echo "Success";
            }else{
                echo "Error";
            }

        }

    }

?>