<?php

    class AddToCart{

        public function addToCart($table, $conn, $pid, $customer, $color){

            //Kiểm tra xem sản phẩm này có còn trong kho không
            $sql = "SELECT * FROM product WHERE id='$pid'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $stock_id = $row['inventory_id'];
                //Kiểm tra số lượng theo từng màu sắc
                $sqlc = "SELECT * FROM product_inventory WHERE id='$stock_id' AND (color1='$color' OR color2='$color' oR color3='$color')";

                $resultc = $conn->query($sqlc);

                if($resultc->num_rows > 0){
                    $rowc = $resultc->fetch_assoc();
                    //Kiểm tra xem còn trong kho hay không
                    if($color == $rowc['color1']){
                        //Kiểm tra số lượng ứng vs màu
                        if($rowc['quantity_color1'] <= 0){
                            echo "Sản phẩm này hiện không còn trong kho";
                        }else{
                            //Còn hàng
                            //Tiến hành add to cart
                            $sqla = "SELECT * FROM $table WHERE _product_id='$pid' AND _color='$color'";

                            $resulta = $conn->query($sqla);

                            if($resulta->num_rows > 0){
                                $rowa = $resulta->fetch_assoc();
                                //Đã tồn tại trong giỏ
                                //Update số lượng trong cart
                                $quantity = $rowa['_quantity'];

                                $quantity += 1;

                                $sqli = "UPDATE $table SET _quantity='$quantity' WHERE _customer='$customer' AND _color='$color'";

                                if($conn->query($sqli) === TRUE){
                                    //Cập nhật lại số lượng trong kho
                                    $sqlin = "SELECT * FROM product_inventory WHERE id='$stock_id' AND (color1='$color' OR color2='$color' OR color3='$color')";
                                    $resultin = $conn->query($sqlin);
                                    if($resultin->num_rows > 0){
                                        $rowin = $resultin->fetch_assoc();
                                        //Cập nhật theo màu sắc
                                        if($rowin['color1'] == $color){
                                            $quantityin = $rowin['quantity_color1'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color1='$quantityin' WHERE id='$stock_id' AND color1='$color'";
                                            $conn->query($sqlu);
                                        }else if($rowin['color2'] == $color){
                                            $quantityin = $rowin['quantity_color2'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color2='$quantityin' WHERE id='$stock_id' AND color2='$color'";
                                            $conn->query($sqlu);
                                        }else if($rowin['color3'] == $color){
                                            $quantityin = $rowin['quantity_color3'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color3='$quantityin' WHERE id='$stock_id' AND color3='$color'";
                                            $conn->query($sqlu);
                                        }
                                    }
                                    echo "Thêm thành công";
                                }else{
                                    echo "Thêm thất bại";
                                }
                            }else{
                                //Chưa có trong giỏ
                                //insert
                                $sqli = "INSERT INTO $table(_customer, _product_id, _color, _quantity)
                                VALUES('$customer', '$pid', '$color', '1')
                                ";
                                if($conn->query($sqli) === TRUE){
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
                                            $conn->query($sqlu);
                                        }else if($rowin['color2'] == $color){
                                            $quantityin = $rowin['quantity_color2'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color2='$quantityin' WHERE id='$stock_id' AND color2='$color'";
                                            $conn->query($sqlu);
                                        }else if($rowin['color3'] == $color){
                                            $quantityin = $rowin['quantity_color3'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color3='$quantityin' WHERE id='$stock_id' AND color3='$color'";
                                            $conn->query($sqlu);
                                        }
                                    }
                                    echo "Thêm thành công";
                                }else{
                                    echo "Thêm thất bại";
                                }
                            }
                        }
                    }else if($color == $rowc['color2']){
                        //Kiểm tra số lượng ứng vs màu
                        if($rowc['quantity_color2'] <= 0){
                            echo "Sản phẩm này hiện không còn trong kho";
                        }else{
                            //Còn hàng
                            //Tiến hành add to cart
                            $sqla = "SELECT * FROM $table WHERE _product_id='$pid' AND _color='$color'";

                            $resulta = $conn->query($sqla);

                            if($resulta->num_rows > 0){
                                $rowa = $resulta->fetch_assoc();
                                //Đã tồn tại trong giỏ
                                //Update số lượng trong cart
                                $quantity = $rowa['_quantity'];

                                $quantity += 1;

                                $sqli = "UPDATE $table SET _quantity='$quantity' WHERE _customer='$customer' AND _color='$color'";

                                if($conn->query($sqli) === TRUE){
                                    //Cập nhật lại số lượng trong kho
                                    $sqlin = "SELECT * FROM product_inventory WHERE id='$stock_id' AND (color1='$color' OR color2='$color' OR color3='$color')";
                                    $resultin = $conn->query($sqlin);
                                    if($resultin->num_rows > 0){
                                        $rowin = $resultin->fetch_assoc();
                                        //Cập nhật theo màu sắc
                                        if($rowin['color1'] == $color){
                                            $quantityin = $rowin['quantity_color1'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color1='$quantityin' WHERE id='$stock_id' AND color1='$color'";
                                            $conn->query($sqlu);
                                        }else if($rowin['color2'] == $color){
                                            $quantityin = $rowin['quantity_color2'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color2='$quantityin' WHERE id='$stock_id' AND color2='$color'";
                                            $conn->query($sqlu);
                                        }else if($rowin['color3'] == $color){
                                            $quantityin = $rowin['quantity_color3'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color3='$quantityin' WHERE id='$stock_id' AND color3='$color'";
                                            $conn->query($sqlu);
                                        }
                                    }
                                    echo "Thêm thành công";
                                }else{
                                    echo "Thêm thất bại";
                                }
                            }else{
                                //Chưa có trong giỏ
                                //insert
                                $sqli = "INSERT INTO $table(_customer, _product_id, _color, _quantity)
                                VALUES('$customer', '$pid', '$color', '1')
                                ";
                                if($conn->query($sqli) === TRUE){
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
                                            $conn->query($sqlu);
                                        }else if($rowin['color2'] == $color){
                                            $quantityin = $rowin['quantity_color2'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color2='$quantityin' WHERE id='$stock_id' AND color2='$color'";
                                            $conn->query($sqlu);
                                        }else if($rowin['color3'] == $color){
                                            $quantityin = $rowin['quantity_color3'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color3='$quantityin' WHERE id='$stock_id' AND color3='$color'";
                                            $conn->query($sqlu);
                                        }
                                    }
                                    echo "Thêm thành công";
                                }else{
                                    echo "Thêm thất bại";
                                }
                            }
                        }
                    }else if($color == $rowc['color3']){
                        //Kiểm tra số lượng ứng vs màu
                        if($rowc['quantity_color3'] <= 0){
                            echo "Sản phẩm này hiện không còn trong kho";
                        }else{
                            //Còn hàng
                            //Tiến hành add to cart
                            $sqla = "SELECT * FROM $table WHERE _product_id='$pid' AND _color='$color'";

                            $resulta = $conn->query($sqla);

                            if($resulta->num_rows > 0){
                                $rowa = $resulta->fetch_assoc();
                                //Đã tồn tại trong giỏ
                                //Update số lượng trong cart
                                $quantity = $rowa['_quantity'];

                                $quantity += 1;

                                $sqli = "UPDATE $table SET _quantity='$quantity' WHERE _customer='$customer' AND _color='$color'";

                                if($conn->query($sqli) === TRUE){
                                    //Cập nhật lại số lượng trong kho
                                    $sqlin = "SELECT * FROM product_inventory WHERE id='$stock_id' AND (color1='$color' OR color2='$color' OR color3='$color')";
                                    $resultin = $conn->query($sqlin);
                                    if($resultin->num_rows > 0){
                                        $rowin = $resultin->fetch_assoc();
                                        //Cập nhật theo màu sắc
                                        if($rowin['color1'] == $color){
                                            $quantityin = $rowin['quantity_color1'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color1='$quantityin' WHERE id='$stock_id' AND color1='$color'";
                                            $conn->query($sqlu);
                                        }else if($rowin['color2'] == $color){
                                            $quantityin = $rowin['quantity_color2'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color2='$quantityin' WHERE id='$stock_id' AND color2='$color'";
                                            $conn->query($sqlu);
                                        }else if($rowin['color3'] == $color){
                                            $quantityin = $rowin['quantity_color3'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color3='$quantityin' WHERE id='$stock_id' AND color3='$color'";
                                            $conn->query($sqlu);
                                        }
                                    }
                                    echo "Thêm thành công";
                                }else{
                                    echo "Thêm thất bại";
                                }
                            }else{
                                //Chưa có trong giỏ
                                //insert
                                $sqli = "INSERT INTO $table(_customer, _product_id, _color, _quantity)
                                VALUES('$customer', '$pid', '$color', '1')
                                ";
                                if($conn->query($sqli) === TRUE){
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
                                            $conn->query($sqlu);
                                        }else if($rowin['color2'] == $color){
                                            $quantityin = $rowin['quantity_color2'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color2='$quantityin' WHERE id='$stock_id' AND color2='$color'";
                                            $conn->query($sqlu);
                                        }else if($rowin['color3'] == $color){
                                            $quantityin = $rowin['quantity_color3'];
                                            $quantityin -= 1;
                                            //Update
                                            $sqlu = "UPDATE product_inventory SET quantity_color3='$quantityin' WHERE id='$stock_id' AND color3='$color'";
                                            $conn->query($sqlu);
                                        }
                                    }
                                    echo "Thêm thành công";
                                }else{
                                    echo "Thêm thất bại";
                                }
                            }
                        }
                    }
                }
            }
        }

    }

?>