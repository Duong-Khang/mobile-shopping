<?php

    class PlusProduct{

        public function plusProduct($table, $conn, $customer, $pid, $color){

            $sql = "SELECT * FROM $table WHERE _product_id='$pid' AND _color='$color' AND _customer='$customer'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $quantity = $row['_quantity'];
                //Update số lượng
                $quantity += 1;
                //Kiểm tra xem trong kho còn đủ không

                $sqlget = "SELECT * FROM product WHERE id='$pid'";
                    $resultget = $conn->query($sqlget);
                    if($resultget->num_rows > 0){
                        $rowget = $resultget->fetch_assoc();
                        $stock_id = $rowget['inventory_id'];
                        $sqlin = "SELECT * FROM product_inventory WHERE id='$stock_id' AND (color1='$color' OR color2='$color' OR color3='$color')";
                        $resultin = $conn->query($sqlin);
                        if($resultin->num_rows > 0){
                            $rowin = $resultin->fetch_assoc();
                            // $quantityin = $rowin['quantity'];
                            // $quantityin -= 1;
                            // //check
                            // if($quantityin <= 0){
                            //     echo "Sản phẩm trong kho không đủ đáp ứng";
                            //     return false;
                            // }
                            if($color == $rowin['color1']){
                                $quantityin = $rowin['quantity_color1'];
                                $quantityin -= 1;
                                //check
                                if($quantityin <= 0){
                                    echo "Sản phẩm trong kho không đủ đáp ứng";
                                    return false;
                                }
                            }else if($color == $rowin['color2']){
                                $quantityin = $rowin['quantity_color2'];
                                $quantityin -= 1;
                                //check
                                if($quantityin <= 0){
                                    echo "Sản phẩm trong kho không đủ đáp ứng";
                                    return false;
                                }
                            }else if($color == $rowin['color3']){
                                $quantityin = $rowin['quantity_color3'];
                                $quantityin -= 1;
                                //check
                                if($quantityin <= 0){
                                    echo "Sản phẩm trong kho không đủ đáp ứng";
                                    return false;
                                }
                            }
                        }
                    }
                $sqlu = "UPDATE $table SET _quantity='$quantity' WHERE _product_id='$pid' AND _color='$color' AND _customer='$customer'";
                
                if($conn->query($sqlu) === TRUE){
                    //Cập nhật lại số lượng trong kho
                    //Lấy $stock_id
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
                        //     $quantityin -= 1;
                        //     //Update
                        //     $sqlu_ = "UPDATE product_inventory SET quantity='$quantityin' WHERE id='$stock_id'";
                        //     if($conn->query($sqlu_) === TRUE){
                        //         echo $quantity;
                        //     }
                        // }

                        //Cập nhật lại số lượng trong kho
                        $sqlin = "SELECT * FROM product_inventory WHERE id='$stock_id' AND (color1='$color' OR color2='$color' oR color3='$color')";
                        $resultin = $conn->query($sqlin);
                        if($resultin->num_rows > 0){
                            $rowin = $resultin->fetch_assoc();
                            //Cập nhật theo màu sắc
                            if($rowin['color1'] == $color){
                                $quantityin = $rowin['quantity_color1'];
                                $quantityin -= 1;
                                //Update
                                $sqlu = "UPDATE product_inventory SET quantity_color1='$quantityin' WHERE id='$stock_id' AND color1='$color'";
                                if($conn->query($sqlu) === TRUE){
                                    echo $quantity;
                                }
                            }else if($rowin['color2'] == $color){
                                $quantityin = $rowin['quantity_color2'];
                                $quantityin -= 1;
                                //Update
                                $sqlu = "UPDATE product_inventory SET quantity_color2='$quantityin' WHERE id='$stock_id' AND color2='$color'";
                                if($conn->query($sqlu) === TRUE){
                                    echo $quantity;
                                }
                            }else if($rowin['color3'] == $color){
                                $quantityin = $rowin['quantity_color3'];
                                $quantityin -= 1;
                                //Update
                                $sqlu = "UPDATE product_inventory SET quantity_color3='$quantityin' WHERE id='$stock_id' AND color3='$color'";
                                if($conn->query($sqlu) === TRUE){
                                    echo $quantity;
                                }
                            }
                        }
                    }
                }
            }

        }

    }

?>