<?php

    class ShowCart{

        public function showCart($table, $conn, $customer){

            $sql = "SELECT $table.*, description.*, product.id, product.name, product.discount_id
            FROM (($table
            INNER JOIN description ON $table._product_id = description.product_id)
            INNER JOIN product ON product.id = $table._product_id)
            WHERE $table._customer='$customer'
            ";

            $result = $conn->query($sql);

            if($result -> num_rows > 0){
                while($row = $result -> fetch_assoc()){
                    ?>
                        <tr id="show_record_<?php echo $row['_id'] ?>">
                            <td class="min-w-20x">
                                <div class="d-flex align-items-center"><img src="../public/product_images_desc/<?php
                                    //Hiển thị ảnh tương ứng với màu
                                    if($row['_color'] == $row['dcolor1']){
                                        echo $row['photo_color1'];
                                    }else if($row['_color'] == $row['dcolor2']){
                                        echo $row['photo_color2'];
                                    }else if($row['_color'] == $row['dcolor3']){
                                        echo $row['photo_color3'];
                                    }
                                ?>" class="me-4" width="40" height="40" alt="" /><a href="app-product.html" class="text-reset"><?php echo $row['name'] ?></a></div>
                            </td>
                            <td class="text-end">
                                <?php echo $row['_color'] ?>
                            </td>
                            <td class="text-end">
                                <div class="sa-price"><span class="sa-price__symbol"></span><span class="sa-price__integer">
                                    <?php
                                        //Hiển thị giá
                                        //Xử lý tính giá có áp dụng khuyến mãi
                                        $discount_id = $row['discount_id'];
                                        $sqldis = "SELECT * FROM discount WHERE id='$discount_id'";

                                        $resultdis = $conn->query($sqldis);

                                        if($resultdis->num_rows > 0){
                                            //Kiểm tra xe discount có hoạt động không
                                            $rowdis = $resultdis->fetch_assoc();
                                            if($rowdis['active'] == 1 && $rowdis['delete_at'] == NULL){
                                                //Lấy giá theo màu có khuyến mãi
                                                if($row['dcolor1'] == $row['_color']){
                                                    echo number_format(($row['price_color1']*(100-$rowdis['discount_percent']))/100)." -".$rowdis['discount_percent']."%";
                                                }else if($row['dcolor2'] == $row['_color']){
                                                    echo number_format(($row['price_color2']*(100-$rowdis['discount_percent']))/100)." -".$rowdis['discount_percent']."%";
                                                }else if($row['dcolor3'] == $row['_color']){
                                                    echo number_format(($row['price_color3']*(100-$rowdis['discount_percent']))/100)." -".$rowdis['discount_percent']."%";
                                                }
                                            }else if($rowdis['active'] == 0 && $rowdis['delete_at'] == NULL){
                                                //Lấy giá theo màu k có khuyến mãi
                                                if($row['dcolor1'] == $row['_color']){
                                                    echo number_format($row['price_color1']);
                                                }else if($row['dcolor2'] == $row['_color']){
                                                    echo number_format($row['price_color2']);
                                                }else if($row['dcolor3'] == $row['_color']){
                                                    echo number_format($row['price_color3']);
                                                }
                                            }else if($rowdis['delete_at'] != NULL){
                                                if($row['dcolor1'] == $row['_color']){
                                                    echo number_format($row['price_color1']);
                                                }else if($row['dcolor2'] == $row['_color']){
                                                    echo number_format($row['price_color2']);
                                                }else if($row['dcolor3'] == $row['_color']){
                                                    echo number_format($row['price_color3']);
                                                }
                                            }
                                        }
                                    ?>
                                </span><span class="sa-price__decimal"></span></div>
                            </td>
                            <td class="text-end">
                                <a id="btn_minus_<?php echo $row['_id'] ?>" style="border: 1px solid #2125291a; padding: 5px 6px; cursor: pointer;"><i class="fas fa-minus"></i></a>
                                <span id="show_quantity_<?php echo $row['_id'] ?>" style="margin: 6px;"><?php echo $row['_quantity'] ?></span>
                                <a id="btn_plus_<?php echo $row['_id'] ?>" style="border: 1px solid #2125291a; padding: 5px 6px; cursor: pointer;"><i class="fas fa-plus"></i></a>
                            </td>
                            <input type="hidden" id="customer_<?php echo $row['_id'] ?>" value="<?php echo $customer ?>">
                            <input type="hidden" id="product_id_<?php echo $row['_id'] ?>" value="<?php  echo $row['_product_id'] ?>">
                            <input type="hidden" id="color_cart_<?php echo $row['_id'] ?>" value="<?php echo $row['_color'] ?>">
                            <script>
                                $(document).ready(function(){
                                    //Xử lý tăng số lượng
                                    $("#btn_plus_<?php echo $row['_id'] ?>").click(function(){
                                        //Lấy customer vs product id vs color
                                        var customer = $("#customer_<?php echo $row['_id'] ?>").val();
                                        var pid = $("#product_id_<?php echo $row['_id'] ?>").val();
                                        var color = $("#color_cart_<?php echo $row['_id'] ?>").val();
                                        //Gửi ajax
                                        $.ajax({
                                            url: "Controller/ControllerPlus.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                customer: customer,
                                                pid: pid,
                                                color: color                                           
                                            },
                                            success: function(result){
                                                if(result == "Sản phẩm trong kho không đủ đáp ứng"){
                                                    alert(result);
                                                }else{
                                                    $("#show_quantity_<?php echo $row['_id'] ?>").html(result);
                                                    //Xử lý cập nhật tổng tiền của product
                                                    var customer = $("#customer_<?php echo $row['_id'] ?>").val();
                                                    var pid = $("#product_id_<?php echo $row['_id'] ?>").val();
                                                    var color = $("#color_cart_<?php echo $row['_id'] ?>").val();
                                                    //Gửi ajax
                                                    $.ajax({
                                                        url: "Controller/ControllerUpdateTotalProduct.php",
                                                        type: "get",
                                                        dataType: "text",
                                                        data: {
                                                            customer: customer,
                                                            pid: pid,
                                                            color: color  
                                                        },
                                                        success: function(resultTotal){
                                                            $("#show_total_price_<?php echo $row['_id'] ?>").html(resultTotal);
                                                        }
                                                    });
                                                    //Hiển thị tạm tính và tổng cộng
                                                    var customer = $("#customer_name").val();
                                                    //Gửi ajax
                                                    $.ajax({
                                                        url: "Controller/ControllerShowSubTotal.php",
                                                        type: "get",
                                                        dataType: "text",
                                                        data: {
                                                            customer: customer
                                                        },
                                                        success: function(resultSubTotal){
                                                            $("#spend").val(resultSubTotal);
                                                            const numberFormat = new Intl.NumberFormat('vi-VN', {
                                                                style: 'currency',
                                                                currency: 'VND',
                                                            });
                                                            resultSubTotal = Math.round(resultSubTotal);
                                                            resultSubTotal = numberFormat.format(resultSubTotal);
                                                            $("#show_TamTinh").html(resultSubTotal);
                                                            $("#show_TongCong").html(resultSubTotal);
                                                        }
                                                    });
                                                    //Xử lý hiển thị số lượng trong kho ứng vs màu đã chọn
                                                    //Gửi ajax
                                                    $.ajax({
                                                        url: "Controller/ControllerShowStock.php",
                                                        type: "get",
                                                        dataType: "text",
                                                        data: {
                                                            pid: pid,
                                                            color: color
                                                        },
                                                        success: function(resultStock){
                                                            $("#show_stock_<?php echo $row['id'] ?>").html(resultStock)
                                                        }
                                                    });
                                                }                              
                                            }
                                        });
                                    });
                                    //Xử lý giảm số lượng
                                    $("#btn_minus_<?php echo $row['_id'] ?>").click(function(){
                                        //Lấy customer vs product id vs color
                                        var customer = $("#customer_<?php echo $row['_id'] ?>").val();
                                        var pid = $("#product_id_<?php echo $row['_id'] ?>").val();
                                        var color = $("#color_cart_<?php echo $row['_id'] ?>").val();
                                        //Gửi ajax
                                        $.ajax({
                                            url: "Controller/ControllerMinus.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                customer: customer,
                                                pid: pid,
                                                color: color                                           
                                            },
                                            success: function(result){
                                                if(result == "Remove"){
                                                    var answer = window.confirm("Bạn muốn xóa sản phẩm này?");
                                                    if (answer) {
                                                        //some code
                                                        //alert("Xóa");
                                                        //Xử lý xóa 
                                                        //Lấy customer vs product id vs color
                                                        var customer = $("#customer_<?php echo $row['_id'] ?>").val();
                                                        var pid = $("#product_id_<?php echo $row['_id'] ?>").val();
                                                        var color = $("#color_cart_<?php echo $row['_id'] ?>").val();
                                                        //Gửi ajax
                                                        $.ajax({
                                                            url: "Controller/ControllerDeleteQuantityOne.php",
                                                            type: "get",
                                                            dataType: "text",
                                                            data: {
                                                                customer: customer,
                                                                pid: pid,
                                                                color: color
                                                            },
                                                            success: function(resultDelete){
                                                                if(resultDelete !== "Success"){
                                                                    alert(resultDelete);
                                                                }else{
                                                                    //Xóa row đó đi
                                                                    $("#show_record_<?php echo $row['_id'] ?>").remove();
                                                                    //Hiển thị tạm tính và tổng cộng
                                                                    var customer = $("#customer_name").val();
                                                                    //Gửi ajax
                                                                    $.ajax({
                                                                        url: "Controller/ControllerShowSubTotal.php",
                                                                        type: "get",
                                                                        dataType: "text",
                                                                        data: {
                                                                            customer: customer
                                                                        },
                                                                        success: function(resultSubTotal){
                                                                            $("#spend").val(resultSubTotal);
                                                                            const numberFormat = new Intl.NumberFormat('vi-VN', {
                                                                                style: 'currency',
                                                                                currency: 'VND',
                                                                            });
                                                                            resultSubTotal = Math.round(resultSubTotal);
                                                                            resultSubTotal = numberFormat.format(resultSubTotal);
                                                                            $("#show_TamTinh").html(resultSubTotal);
                                                                            $("#show_TongCong").html(resultSubTotal);
                                                                        }
                                                                    });
                                                                    //Xử lý hiển thị số lượng trong kho ứng vs màu đã chọn
                                                                    //Gửi ajax
                                                                    $.ajax({
                                                                        url: "Controller/ControllerShowStock.php",
                                                                        type: "get",
                                                                        dataType: "text",
                                                                        data: {
                                                                            pid: pid,
                                                                            color: color
                                                                        },
                                                                        success: function(resultStock){
                                                                            $("#show_stock_<?php echo $row['id'] ?>").html(resultStock)
                                                                        }
                                                                    });
                                                                }
                                                            }
                                                        });
                                                    }
                                                    else {
                                                        //some code
                                                        //alert("Không xóa");
                                                    }
                                                    
                                                }else{
                                                    $("#show_quantity_<?php echo $row['_id'] ?>").html(result);
                                                    //Xử lý cập nhật tổng tiền của product
                                                    var customer = $("#customer_<?php echo $row['_id'] ?>").val();
                                                    var pid = $("#product_id_<?php echo $row['_id'] ?>").val();
                                                    var color = $("#color_cart_<?php echo $row['_id'] ?>").val();
                                                    //Gửi ajax
                                                    $.ajax({
                                                        url: "Controller/ControllerUpdateTotalProduct.php",
                                                        type: "get",
                                                        dataType: "text",
                                                        data: {
                                                            customer: customer,
                                                            pid: pid,
                                                            color: color  
                                                        },
                                                        success: function(resultTotal){
                                                            $("#show_total_price_<?php echo $row['_id'] ?>").html(resultTotal);
                                                        }
                                                    });

                                                    //Hiển thị tạm tính và tổng cộng
                                                    var customer = $("#customer_name").val();
                                                    //Gửi ajax
                                                    $.ajax({
                                                        url: "Controller/ControllerShowSubTotal.php",
                                                        type: "get",
                                                        dataType: "text",
                                                        data: {
                                                            customer: customer
                                                        },
                                                        success: function(resultSubTotal){
                                                            $("#spend").val(resultSubTotal);
                                                            const numberFormat = new Intl.NumberFormat('vi-VN', {
                                                                style: 'currency',
                                                                currency: 'VND',
                                                            });
                                                            resultSubTotal = Math.round(resultSubTotal);
                                                            resultSubTotal = numberFormat.format(resultSubTotal);
                                                            $("#show_TamTinh").html(resultSubTotal);
                                                            $("#show_TongCong").html(resultSubTotal);
                                                        }
                                                    });
                                                    //Gửi ajax
                                                    $.ajax({
                                                        url: "Controller/ControllerShowStock.php",
                                                        type: "get",
                                                        dataType: "text",
                                                        data: {
                                                            pid: pid,
                                                            color: color
                                                        },
                                                        success: function(resultStock){
                                                            $("#show_stock_<?php echo $row['id'] ?>").html(resultStock)
                                                        }
                                                    });
                                                }                                        
                                            }
                                        });
                                    });
                                });
                            </script>
                            <td class="text-end">
                                <div id="show_total_price_<?php echo $row['_id'] ?>" class="sa-price"><span class="sa-price__symbol"></span><span class="sa-price__integer">
                                <?php
                                    //Hiển thị giá
                                    //Xử lý tính giá có áp dụng khuyến mãi
                                    $discount_id = $row['discount_id'];
                                    $sqldis = "SELECT * FROM discount WHERE id='$discount_id'";

                                    $resultdis = $conn->query($sqldis);

                                    if($resultdis->num_rows > 0){
                                        //Kiểm tra xe discount có hoạt động không
                                        $rowdis = $resultdis->fetch_assoc();
                                        if($rowdis['active'] == 1 && $rowdis['delete_at'] == NULL){
                                            //Lấy giá theo màu có khuyến mãi
                                            if($row['dcolor1'] == $row['_color']){
                                                echo number_format((($row['price_color1']*(100-$rowdis['discount_percent']))/100)*$row['_quantity']);
                                            }else if($row['dcolor2'] == $row['_color']){
                                                echo number_format((($row['price_color2']*(100-$rowdis['discount_percent']))/100)*$row['_quantity']);
                                            }else if($row['dcolor3'] == $row['_color']){
                                                echo number_format((($row['price_color3']*(100-$rowdis['discount_percent']))/100)*$row['_quantity']);
                                            }
                                        }else if($rowdis['active'] == 0 && $rowdis['delete_at'] == NULL){
                                            //Lấy giá theo màu k có khuyến mãi
                                            if($row['dcolor1'] == $row['_color']){
                                                echo number_format($row['price_color1']*$row['_quantity']);
                                            }else if($row['dcolor2'] == $row['_color']){
                                                echo number_format($row['price_color2']*$row['_quantity']);
                                            }else if($row['dcolor3'] == $row['_color']){
                                                echo number_format($row['price_color3']*$row['_quantity']);
                                            }
                                        }else if($rowdis['delete_at'] != NULL){
                                            if($row['dcolor1'] == $row['_color']){
                                                echo number_format($row['price_color1']*$row['_quantity']);
                                            }else if($row['dcolor2'] == $row['_color']){
                                                echo number_format($row['price_color2']*$row['_quantity']);
                                            }else if($row['dcolor3'] == $row['_color']){
                                                echo number_format($row['price_color3']*$row['_quantity']);
                                            }
                                        }
                                    }
                                ?>
                                </span><span class="sa-price__decimal"></span></div>
                            </td>
                            <td><a id="btn_delete_<?php echo $row['_id'] ?>" style="cursor: pointer;"><i class="fas fa-trash-alt"></i></a></td>
                            <script>
                                $(document).ready(function(){
                                    //Xử lý xóa
                                    $("#btn_delete_<?php echo $row['_id'] ?>").click(function(){
                                        var answer = window.confirm("Bạn muốn xóa sản phẩm này?");
                                        if (answer) {
                                            //some code
                                            var customer = $("#customer_<?php echo $row['_id'] ?>").val();
                                            var pid = $("#product_id_<?php echo $row['_id'] ?>").val();
                                            var color = $("#color_cart_<?php echo $row['_id'] ?>").val();
                                            //Gửi ajax
                                            $.ajax({
                                                url: "Controller/ControllerDeleteProduct.php",
                                                type: "get",
                                                dataType: "text",
                                                data: {
                                                    customer: customer,
                                                    pid: pid,
                                                    color: color
                                                },
                                                success: function(result){
                                                    if(result !== "Success"){
                                                        alert("Xóa thất bại");
                                                    }else{
                                                        $("#show_record_<?php echo $row['_id'] ?>").remove();
                                                        //Hiển thị tạm tính và tổng cộng
                                                        var customer = $("#customer_name").val();
                                                        //Gửi ajax
                                                        $.ajax({
                                                            url: "Controller/ControllerShowSubTotal.php",
                                                            type: "get",
                                                            dataType: "text",
                                                            data: {
                                                                customer: customer
                                                            },
                                                            success: function(resultSubTotal){
                                                                $("#spend").val(resultSubTotal);
                                                                const numberFormat = new Intl.NumberFormat('vi-VN', {
                                                                    style: 'currency',
                                                                    currency: 'VND',
                                                                });
                                                                resultSubTotal = Math.round(resultSubTotal);
                                                                resultSubTotal = numberFormat.format(resultSubTotal);
                                                                $("#show_TamTinh").html(resultSubTotal);
                                                                $("#show_TongCong").html(resultSubTotal);
                                                            }
                                                        });
                                                        //Xử lý hiển thị số lượng trong kho ứng vs màu đã chọn
                                                        //Gửi ajax
                                                        $.ajax({
                                                            url: "Controller/ControllerShowStock.php",
                                                            type: "get",
                                                            dataType: "text",
                                                            data: {
                                                                pid: pid,
                                                                color: color
                                                            },
                                                            success: function(resultStock){
                                                                $("#show_stock_<?php echo $row['id'] ?>").html(resultStock)
                                                            }
                                                        });
                                                    }
                                                }
                                            });
                                        }
                                        else {
                                            //some code
                                        }
                                    });
                                });
                            </script>
                        </tr>
                    <?php
                }
            }

        }

    }

?>