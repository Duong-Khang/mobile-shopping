<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ModelShowCart;
use App\Models\ModelProductDesc;
use App\Models\ModelCartDiscount;

class ControllerShowCart extends Controller
{
    public function showCart(Request $request){
        $customer = $request['customer'];
        //echo $customer;
        //Tiến hành truy vấn lấy item trong cart
        //Lấy item trong giỏ hàng
        $infoProduct = ModelShowCart::join('product', 'cart_item.product_id', '=', 'product.id')
            ->join('description', 'cart_item.product_id', '=', 'description.product_id')
            ->select('cart_item.*', 'product.*', 'description.*')
            ->where('customer', '=', $customer)
            ->get();
        foreach ($infoProduct as $value) {
            $pid = $value['product_id'];
            $discount_id = $value['discount_id'];
            //Lấy description
            $infoDesc = ModelProductDesc::where('product_id', '=', $pid)->get();
            //Lấy discount
            $infoDiscount = ModelCartDiscount::where('id', '=', $discount_id)->get();
            foreach($infoDesc as $dvalue){
                foreach ($infoDiscount as $disvalue) {
            ?>
                
                <tr id="item_<?php echo $value['cartid'] ?>">
                <input type="hidden" name="" id="pcolor_<?php echo $value['cartid'] ?>" value="<?php echo $value['color'] ?>">
                <input type="hidden" name="" id="pid_<?php echo $value['cartid'] ?>" value="<?php echo $value['id'] ?>">
                    <td>
                        <a href="chi-tiet-san-pham/<?php echo $value['id'] ?>"><img src="product_images_desc/<?php 
                        
                            if(strpos($value['color'], $dvalue['dcolor1']) !== false){
                                echo $dvalue['photo_color1'];
                            }else if(strpos($value['color'], $dvalue['dcolor2']) !== false){
                                echo $dvalue['photo_color2'];
                            }else if(strpos($value['color'], $dvalue['dcolor3']) !== false){
                                echo $dvalue['photo_color3'];
                            }
                        
                        ?>" alt="Cart Product Image" title="<?php echo $value['name'] ?>" class="img-thumbnail"></a>
                    </td>
                    <td>
                        <a href="chi-tiet-san-pham/<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a>
                    </td>
                    <td><?php echo $value['color']; ?></td>
                    <td>
                        <div class="input-group btn-block">
                            <div style="border: none;" class="">
                                <span id="btn_tang_<?php echo $value['cartid'] ?>" style="cursor: pointer;" class="inc"><i class="fas fa-plus" aria-hidden="true"></i></span>
                                <input id="quantity_<?php echo $value['cartid'] ?>" style="width: 35px; height: 35px; text-align: center; border: 1px solid rgb(236, 236, 236); margin: 10px 10px;" type="text" value="<?php echo $value['quantity'] ?>" readonly>
                                <span id="btn_giam_<?php echo $value['cartid'] ?>" style="cursor: pointer;" class="dec"><i class="fas fa-minus" aria-hidden="true"></i></span>
                                
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php 
                            //Xử lý hiển thị giá discount theo màu
                            if(strpos($value['color'], $dvalue['dcolor1']) !== false){
                                if($disvalue['active'] == 1){
                                    echo number_format(($dvalue['price_color1']*(100-$disvalue['discount_percent']))/100).'đ';
                                }else if($disvalue['active'] == 0||$disvalue['active'] == 2){
                                    echo number_format($dvalue['price_color1']).'đ';
                                }
                            }else if(strpos($value['color'], $dvalue['dcolor2']) !== false){
                                if($disvalue['active'] == 1){
                                    echo number_format(($dvalue['price_color2']*(100-$disvalue['discount_percent']))/100).'đ';
                                }else if($disvalue['active'] == 0||$disvalue['active'] == 2){
                                    echo number_format($dvalue['price_color2']).'đ';
                                }
                            }else if(strpos($value['color'], $dvalue['dcolor3']) !== false){
                                if($disvalue['active'] == 1){
                                    echo number_format(($dvalue['price_color3']*(100-$disvalue['discount_percent']))/100).'đ';
                                }else if($disvalue['active'] == 0||$disvalue['active'] == 2){
                                    echo number_format($dvalue['price_color3']).'đ';
                                }
                            } 
                            if($disvalue['active'] == 1){
                                $d = $disvalue['discount_percent'];
                                echo "(-$d%)<br>";
                            }else if($disvalue['active'] == 0){
                                echo '<br>';
                            }       
                            //Xử lý hiển thị giá gốc theo màu
                            if(strpos($value['color'], $dvalue['dcolor1']) !== false){
                                if($disvalue['active'] == 1){
                                    echo 'Giá gốc: '.number_format($dvalue['price_color1']).'đ';
                                }else if($disvalue['active'] == 0||$disvalue['active'] == 2){
                                    echo '';
                                }
                            }else if(strpos($value['color'], $dvalue['dcolor2']) !== false){
                                if($disvalue['active'] == 1){
                                    echo 'Giá gốc: '.number_format($dvalue['price_color2']).'đ';
                                }else if($disvalue['active'] == 0||$disvalue['active'] == 2){
                                    echo '';
                                }
                            }else if(strpos($value['color'], $dvalue['dcolor3']) !== false){
                                if($disvalue['active'] == 1){
                                    echo 'Giá gốc: '.number_format($dvalue['price_color3']).'đ';
                                }else if($disvalue['active'] == 0||$disvalue['active'] == 2){
                                    echo '';
                                }
                            }        

                        ?>
                    </td>
                    <td id="total_item_<?php echo $value['cartid'] ?>">
                    <?php 
                        //Hiển thị tổng cộng theo giá
                        if(strpos($value['color'], $dvalue['dcolor1']) !== false){
                            if($disvalue['active'] == 1){
                                echo number_format((($dvalue['price_color1']*(100-$disvalue['discount_percent']))/100)*$value['quantity']).'đ';
                            }else if($disvalue['active'] == 0||$disvalue['active'] == 2){
                                echo number_format($dvalue['price_color1']*$value['quantity']).'đ';
                            }
                        }else if(strpos($value['color'], $dvalue['dcolor2']) !== false){
                            if($disvalue['active'] == 1){
                                echo number_format((($dvalue['price_color2']*(100-$disvalue['discount_percent']))/100)*$value['quantity']).'đ';
                            }else if($disvalue['active'] == 0||$disvalue['active'] == 2){
                                echo number_format($dvalue['price_color2']*$value['quantity']).'đ';
                            }
                        }else if(strpos($value['color'], $dvalue['dcolor3']) !== false){
                            if($disvalue['active'] == 1){
                                echo number_format((($dvalue['price_color3']*(100-$disvalue['discount_percent']))/100)*$value['quantity']).'đ';
                            }else if($disvalue['active'] == 0||$disvalue['active'] == 2){
                                echo number_format($dvalue['price_color3']*$value['quantity']).'đ';
                            }
                        } 
                    ?>
                    </td>
                    <td>
                        <span class="input-group-btn">
                            <button id="btn_delete_<?php echo $value['cartid'] ?>" style="border-radius: 5%;" type="button" class="btn btn-danger pull-right"><i class="fas fa-times-circle"></i></button>
                        </span>
                    </td>
                </tr> 
                <script>
                  $(document).ready(function(){
                    var customer = $("#userLogin").val();
                    var pid = $("#pid_<?php echo $value['cartid'] ?>").val();
                    $.ajax({
                        url: "ajax-jQuery/thanh-tien.php",
                        type: "get",
                        dataType: "text",
                        data: {
                            customer: customer
                        },
                        success: function(result_thanh_tien){
                            $("#subTotal").html(result_thanh_tien);
                            $("#total").html(result_thanh_tien);
                        }
                    });
                    //Khi nhấn nút tăng
                    $("#btn_tang_<?php echo $value['cartid'] ?>").click(function(){
                        //alert("Inc")
                        //Lấy tên người mua
                        var customer = $("#userLogin").val();
                        //Lấy màu của sp
                        var pcolor = $("#pcolor_<?php echo $value['cartid'] ?>").val();
                        //Lấy id của product
                        var pid = $("#pid_<?php echo $value['cartid'] ?>").val();
                        //Tiến hành gửi ajax
                        $.ajax({
                            url: "ajax-jQuery/so-luong-tang.php",
                            type: "get",
                            dataType: "text",
                            data: {
                                customer: customer,
                                pcolor: pcolor,
                                pid: pid
                            },
                            success: function(result){
                                $("#quantity_<?php echo $value['cartid'] ?>").val(result);
                                //alert(result);
                                //Xử lý update Tổng
                                $.ajax({
                                    url: "ajax-jQuery/cap-nhat-tong.php",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                        customer: customer,
                                        pcolor: pcolor,
                                        pid: pid
                                    },
                                    success: function(result_update_total){
                                        $("#total_item_<?php echo $value['cartid'] ?>").text(result_update_total);
                                        //Update tổng tiền trong giỏ hàng
                                        $.ajax({
                                            url: "ajax-jQuery/thanh-tien.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                customer: customer                                     
                                            },
                                            success: function(result_thanh_tien){
                                                $("#subTotal").html(result_thanh_tien);
                                                $("#total").html(result_thanh_tien);
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    });
                    //Khi nhấn nút giảm
                    $("#btn_giam_<?php echo $value['cartid'] ?>").click(function(){
                        //alert("desc")
                        //Lấy tên người mua
                        var customer = $("#userLogin").val();
                        //Lấy màu của sp
                        var pcolor = $("#pcolor_<?php echo $value['cartid'] ?>").val();
                        //Lấy id của product
                        var pid = $("#pid_<?php echo $value['cartid'] ?>").val();
                        //Tiến hành gửi ajax
                        $.ajax({
                            url: "ajax-jQuery/so-luong-giam.php",
                            type: "get",
                            dataType: "text",
                            data: {
                                customer: customer,
                                pcolor: pcolor,
                                pid: pid
                            },
                            success: function(result){
                                if(result != "bang_1"){
                                    $("#quantity_<?php echo $value['cartid'] ?>").val(result);
                                    //Xử lý update Tổng
                                    $.ajax({
                                        url: "ajax-jQuery/cap-nhat-tong.php",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                            customer: customer,
                                            pcolor: pcolor,
                                            pid: pid
                                        },
                                        success: function(result_update_total){
                                            $("#total_item_<?php echo $value['cartid'] ?>").text(result_update_total);
                                            $.ajax({
                                                url: "ajax-jQuery/thanh-tien.php",
                                                type: "get",
                                                dataType: "text",
                                                data: {
                                                    customer: customer
                                                },
                                                success: function(result_thanh_tien){
                                                    $("#subTotal").html(result_thanh_tien);
                                                    $("#total").html(result_thanh_tien);
                                                }
                                            });
                                        }
                                    });
                                }else{
                                    // số lượng = 1
                                    var answer = window.confirm("Bạn muốn xóa mặt hàng này?");
                                    if (answer) {
                                        //alert("Yes");
                                        $.ajax({
                                        url: "ajax-jQuery/xoa-so-luong-bang-1.php",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                            customer: customer,
                                            pcolor: pcolor,
                                            pid: pid
                                        },
                                        success: function(result_delete_quantity_1){
                                            if(result_delete_quantity_1 === "removed"){
                                                $("#item_<?php echo $value['cartid'] ?>").remove();
                                                $.ajax({
                                                    url: "ajax-jQuery/thanh-tien.php",
                                                    type: "get",
                                                    dataType: "text",
                                                    data: {
                                                        customer: customer
                                                    },
                                                    success: function(result_thanh_tien){
                                                        $("#subTotal").html(result_thanh_tien);
                                                        $("#total").html(result_thanh_tien);
                                                    }
                                                });
                                            }
                                        }
                                    });
                                    }else{
                                        //alert("No");
                                    }
                                }
                                //alert(result);
                            }
                        });
                    });
                    //Xử lý xóa
                    $("#btn_delete_<?php echo $value['cartid'] ?>").click(function(){
                        var customer = $("#userLogin").val();
                        //Lấy màu của sp
                        var pcolor = $("#pcolor_<?php echo $value['cartid'] ?>").val();
                        //Lấy id của product
                        var pid = $("#pid_<?php echo $value['cartid'] ?>").val();
                        var answer = window.confirm("Bạn muốn xóa mặt hàng này?");
                        if(answer){
                            //alert(customer);
                            //Gửi ajax
                            $.ajax({
                                url: "ajax-jQuery/xoa-mat-hang.php",
                                type: "get",
                                dataType: "text",
                                data: {
                                    customer: customer,
                                    pcolor: pcolor,
                                    pid: pid
                                },
                                success: function(result){
                                    // alert(result);
                                    if(result === "removed"){
                                        $("#item_<?php echo $value['cartid'] ?>").remove();
                                        $.ajax({
                                            url: "ajax-jQuery/thanh-tien.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                customer: customer
                                            },
                                            success: function(result_thanh_tien){
                                                $("#subTotal").html(result_thanh_tien);
                                                $("#total").html(result_thanh_tien);
                                            }
                                        });
                                    }
                                }
                            });
                        }else{
                            //alert("No");
                        }
                    });
                  });
                </script>
            <?php
                }
            }
        }
    }
}
