<?php

    class ShowColorChoose{

        public function showColor($table, $conn, $pid, $color){

            $arr = array();

            if($color == 1){
                //Màu 1
                $sql = "SELECT description.*, product.*
                FROM description
                INNER JOIN product ON product.id = description.product_id
                WHERE product.id = '$pid'
                ";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();

                    //Lấy stock
                    $stock = '';
                    $inventory_id = $row['inventory_id'];
                    $sqlIn = "SELECT * FROM product_inventory WHERE id='$inventory_id'";
                    $resultIn = $conn->query($sqlIn);
                    if($resultIn->num_rows > 0){
                        $rowIn = $resultIn->fetch_assoc();
                        if($rowIn['quantity_color1'] > 0){
                            $stock = '<div class="badge badge-sa-success">'.$rowIn['quantity_color1'].' sản phẩm</div>';
                        }else{
                            $stock = '<div class="badge badge-sa-danger">Hết hàng</div>';
                        }
                    }

                    //Xử lý giá có tính % khuyến mãi
                    $price = 0;
                    $discount_id = $row['discount_id'];
                    $sqlDis = "SELECT * FROM discount WHERE id='$discount_id' AND active='1' AND delete_at IS NULL";
                    $resultDis = $conn->query($sqlDis);
                    if($resultDis->num_rows > 0){
                        $rowDis = $resultDis->fetch_assoc();
                        //Có %
                        $price = ($row['price_color1']*(100-$rowDis['discount_percent']))/100;
                    }else{
                        //0 %
                        $price = $row['price_color1'];
                    }

                    $arr[] = array(
                        'price' => number_format($price),
                        'img' => '<img src="/product_images_desc/'.$row['photo_color1'].'" width="40"
                        height="40" alt="" />',
                        'stock' => $stock
                    );
                }
                die(json_encode($arr));
            }else if($color == 2){
                //Màu 2
                $sql = "SELECT description.*, product.*
                FROM description
                INNER JOIN product ON product.id = description.product_id
                WHERE product.id = '$pid'
                ";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();

                    //Lấy stock
                    $stock = '';
                    $inventory_id = $row['inventory_id'];
                    $sqlIn = "SELECT * FROM product_inventory WHERE id='$inventory_id'";
                    $resultIn = $conn->query($sqlIn);
                    if($resultIn->num_rows > 0){
                        $rowIn = $resultIn->fetch_assoc();
                        if($rowIn['quantity_color1'] > 0){
                            $stock = '<div class="badge badge-sa-success">'.$rowIn['quantity_color2'].' sản phẩm</div>';
                        }else{
                            $stock = '<div class="badge badge-sa-danger">Hết hàng</div>';
                        }
                    }

                    //Xử lý giá có tính % khuyến mãi
                    $price = 0;
                    $discount_id = $row['discount_id'];
                    $sqlDis = "SELECT * FROM discount WHERE id='$discount_id' AND active='1' AND delete_at IS NULL";
                    $resultDis = $conn->query($sqlDis);
                    if($resultDis->num_rows > 0){
                        $rowDis = $resultDis->fetch_assoc();
                        //Có %
                        $price = ($row['price_color2']*(100-$rowDis['discount_percent']))/100;
                    }else{
                        //0 %
                        $price = $row['price_color2'];
                    }

                    $arr[] = array(
                        'price' => number_format($price),
                        'img' => '<img src="/product_images_desc/'.$row['photo_color2'].'" width="40"
                        height="40" alt="" />',
                        'stock' => $stock  
                    );
                }
                die(json_encode($arr));
            }else if($color == 3){
                //Màu 3
                $sql = "SELECT description.*, product.*
                FROM description
                INNER JOIN product ON product.id = description.product_id
                WHERE product.id = '$pid'
                ";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();

                    //Lấy stock
                    $stock = '';
                    $inventory_id = $row['inventory_id'];
                    $sqlIn = "SELECT * FROM product_inventory WHERE id='$inventory_id'";
                    $resultIn = $conn->query($sqlIn);
                    if($resultIn->num_rows > 0){
                        $rowIn = $resultIn->fetch_assoc();
                        if($rowIn['quantity_color1'] > 0){
                            $stock = '<div class="badge badge-sa-success">'.$rowIn['quantity_color3'].' sản phẩm</div>';
                        }else{
                            $stock = '<div class="badge badge-sa-danger">Hết hàng</div>';
                        }
                    }

                    //Xử lý giá có tính % khuyến mãi
                    $price = 0;
                    $discount_id = $row['discount_id'];
                    $sqlDis = "SELECT * FROM discount WHERE id='$discount_id' AND active='1' AND delete_at IS NULL";
                    $resultDis = $conn->query($sqlDis);
                    if($resultDis->num_rows > 0){
                        $rowDis = $resultDis->fetch_assoc();
                        //Có %
                        $price = ($row['price_color3']*(100-$rowDis['discount_percent']))/100;
                    }else{
                        //0 %
                        $price = $row['price_color3'];
                    }

                    $arr[] = array(
                        'price' => number_format($price),
                        'img' => '<img src="/product_images_desc/'.$row['photo_color3'].'" width="40"
                        height="40" alt="" />',
                        'stock' => $stock  
                    );
                }
                die(json_encode($arr));
            }

        }

    }
