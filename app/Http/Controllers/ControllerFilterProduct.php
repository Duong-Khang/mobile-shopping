<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class ControllerFilterProduct extends Controller
{
    //Hàm hiển thị Apple
    public function getApple(Request $request){
        $value_product = $request->value_product;
        //Truy van
        $sql = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
            ->select('product.*', 'discount.discount_percent', 'discount.active')
            ->where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
            ->where('product.delete_at', NULL)
            ->get();
        if(count($sql) > 0){
            foreach ($sql as $value) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div style="height: 400px;" class="product-item mb-30">
                            <div class="product-thumb">
                                <a href="product-details?pid=<?php echo $value['id'] ?>">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php echo $value['photo_name'] ?>" class="pri-img" alt="">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php echo $value['photo_name'] ?>" class="sec-img" alt="">
                                </a>
                                <div class="box-label">
                                    <?php   
                                        if($value['active'] == 1){
                                            $discount_percent = $value['discount_percent'];
                                            echo '<div class="label-product label_sale">
                                                <span>-'.$discount_percent.'%</span>
                                            </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a><?php echo $value['manufacturer'] ?></a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details?pid=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h4>
                                </div>
                                <input type="hidden" name="" id="__pid_<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
                                <div id="__show_star_<?php echo $value['id'] ?>" class="ratings">
                                    <!-- Hiển thị trung bình sao ở đây -->
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var pid = $("#__pid_<?php echo $value['id'] ?>").val();
                                        $.ajax({
                                            url: "ajax-jQuery/show-star-avg.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid
                                            },
                                            success: function(result){
                                                $("#__show_star_<?php echo $value['id'] ?>").html(result);
                                            }
                                        });
                                    });
                                </script>
                                <div class="price-box">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format(($value["price"]*(100-$value["discount_percent"]))/100).'</span> đ</span>';
                                        }else if($value['active'] == 0 || $value['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($value['price']).'</span> đ</span>';
                                        }
                                    ?>
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="old-price"><del>'.number_format($value['price']).' đ</del></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div> <!-- end single grid item -->
                    </div>
                <?php
            }
        }else{
            echo "Không có sản phẩm phù hợp";
        }
    }
    //Hàm hiển thị áp dụng
    public function getApdung(Request $request){
        $value_product = $request->value_product;
        $apdungFrom = $request->apdungFrom;
        $apdungTo = $request->apdungTo;

        //Truy van
        $sql = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
            ->select('product.*', 'discount.discount_percent', 'discount.active')
            ->where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
            ->where('product.price', '>', $apdungFrom)
            ->where('product.price', '<', $apdungTo)
            ->where('product.delete_at', NULL)
            ->get();
        if(count($sql) > 0){
            foreach ($sql as $value) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div style="height: 400px;" class="product-item mb-30">
                            <div class="product-thumb">
                                <a href="product-details?pid=<?php echo $value['id'] ?>">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php echo $value['photo_name'] ?>" class="pri-img" alt="">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php echo $value['photo_name'] ?>" class="sec-img" alt="">
                                </a>
                                <div class="box-label">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<div class="label-product label_sale">
                                                    <span>-'.$value['discount_percent'].'%</span>
                                                </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a><?php echo $value['manufacturer'] ?></a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details?pid=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h4>
                                </div>
                                <input type="hidden" name="" id="pid_<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
                                <div id="show_star_<?php echo $value['id'] ?>" class="ratings">
                                    <!-- Hiển thị trung bình sao ở đây -->
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var pid = $("#pid_<?php echo $value['id'] ?>").val();
                                        $.ajax({
                                            url: "ajax-jQuery/show-star-avg.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid
                                            },
                                            success: function(result){
                                                $("#show_star_<?php echo $value['id'] ?>").html(result);
                                            }
                                        });
                                    });
                                </script>
                                <div class="price-box">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format(($value['price']*(100-$value['discount_percent']))/100).'</span>đ</span>';
                                        }else if($value['active'] == 0 || $value['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($value['price']).'</span>đ</span>';
                                        }
                                    ?>
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="old-price"><del>'.number_format($value['price']).'đ</del></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div> <!-- end single grid item -->
                    </div>
                <?php
            }
        }else{
            echo "Không có sản phẩm phù hợp";
        }
    }
    //Hàm lấy apple màu trắng
    public function getWhite(Request $request){
        $value_product = $request->value_product;
        $white = $request->white;

        //Truy van
        $sql = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
        ->join('description', 'product.id', '=', 'description.product_id')
        ->select('product.*', 'discount.discount_percent', 'discount.active', 'description.*', 'product.id AS pid')
        ->where('product.delete_at', NULL)
        ->where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->where('description.dcolor1', 'LIKE', '%'.$white.'%')
        ->orWhere('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->where('description.dcolor2', 'LIKE', '%'.$white.'%')
        ->orWhere('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->where('description.dcolor3', 'LIKE', '%'.$white.'%')
        ->get();
        if(count($sql) > 0){
            foreach ($sql as $value) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div style="height: 400px;" class="product-item mb-30">
                            <div class="product-thumb">
                                <a href="product-details?pid=<?php echo $value['pid'] ?>">
                                    <img style="height: 180px; width: 180px;" src="product_images_desc/<?php
                                        if($value['dcolor1'] == $white){
                                            echo $value['photo_color1'];
                                        }else if($value['dcolor2'] == $white){
                                            echo $value['photo_color2'];
                                        }
                                        else if($value['dcolor3'] == $white){
                                            echo $value['photo_color3'];
                                        }
                                    ?>" class="pri-img" alt="">
                                    <img style="height: 180px; width: 180px;" src="product_images_desc/<?php
                                        if($value['dcolor1'] == $white){
                                            echo $value['photo_color1'];
                                        }else if($value['dcolor2'] == $white){
                                            echo $value['photo_color2'];
                                        }
                                        else if($value['dcolor3'] == $white){
                                            echo $value['photo_color3'];
                                        }
                                    ?>" class="sec-img" alt="">
                                </a>
                                <div class="box-label">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<div class="label-product label_sale">
                                                    <span>-'.$value['discount_percent'].'%</span>
                                                </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a><?php echo $value['manufacturer'] ?></a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details?pid=<?php echo $value['pid'] ?>"><?php echo $value['name'] ?></a></h4>
                                </div>
                                <input type="hidden" name="" id="pid_<?php echo $value['pid'] ?>" value="<?php echo $value['pid'] ?>">
                                <div id="show_star_<?php echo $value['pid'] ?>" class="ratings">
                                    <!-- Hiển thị trung bình sao ở đây -->
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var pid = $("#pid_<?php echo $value['pid'] ?>").val();
                                        $.ajax({
                                            url: "ajax-jQuery/show-star-avg.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid
                                            },
                                            success: function(result){
                                                $("#show_star_<?php echo $value['pid'] ?>").html(result);
                                                //alert(result)
                                            }
                                        });
                                    });
                                </script>
                                <div class="price-box">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format(($value['price']*(100-$value['discount_percent']))/100).'</span>đ</span>';
                                        }else if($value['active'] == 0 || $value['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($value['price']).'</span>đ</span>';
                                        }
                                    ?>
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="old-price"><del>'.number_format($value['price']).'đ</del></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div> <!-- end single grid item -->
                    </div>
                <?php
            }
        }else{
            echo "Không có sản phẩm phù hợp";
        }
    }
    //Hàm lấy apple màu xanh
    public function getBlue(Request $request){
        $value_product = $request->value_product;
        $blue = $request->blue;

        //Truy van
        $sql = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
        ->leftjoin('description', 'product.id', '=', 'description.product_id')
        ->select('product.*', 'discount.discount_percent', 'discount.active', 'description.*', 'product.id AS pid')
        ->Where('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor1', 'LIKE', '%'.$blue.'%')

        ->orWhere('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor2', 'LIKE', '%'.$blue.'%')

        ->orWhere('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor3', 'LIKE', '%'.$blue.'%')
        ->get();
        if(count($sql) > 0){
            foreach ($sql as $value) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div style="height: 400px;" class="product-item mb-30">
                            <div class="product-thumb">
                                <a href="product-details?pid=<?php echo $value['pid'] ?>">
                                    <img style="height: 180px; width: 180px;" src="product_images_desc/<?php
                                        if(strpos($value['dcolor1'], $blue) !== false){
                                            echo $value['photo_color1'];
                                        }else if(strpos($value['dcolor2'], $blue) !== false){
                                            echo $value['photo_color2'];
                                        }
                                        else if(strpos($value['dcolor3'], $blue) !== false){
                                            echo $value['photo_color3'];
                                        }
                                    ?>" class="pri-img" alt="">
                                    <img style="height: 180px; width: 180px;" src="product_images_desc/<?php
                                        if(strpos($value['dcolor1'], $blue) !== false){
                                            echo $value['photo_color1'];
                                        }else if(stripos($value['dcolor2'], $blue) !== false){
                                            echo $value['photo_color2'];
                                        }
                                        else if(strpos($value['dcolor3'], $blue) !== false){
                                            echo $value['photo_color3'];
                                        }
                                    ?>" class="sec-img" alt="">
                                </a>
                                <div class="box-label">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<div class="label-product label_sale">
                                                    <span>-'.$value['discount_percent'].'%</span>
                                                </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a><?php echo $value['manufacturer'] ?></a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details?pid=<?php echo $value['pid'] ?>"><?php echo $value['name'] ?></a></h4>
                                </div>
                                <input type="hidden" name="" id="pid_<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
                                <div id="show_star_<?php echo $value['id'] ?>" class="ratings">
                                    <!-- Hiển thị trung bình sao ở đây -->
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var pid = $("#pid_<?php echo $value['id'] ?>").val();
                                        $.ajax({
                                            url: "ajax-jQuery/show-star-avg.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid
                                            },
                                            success: function(result){
                                                $("#show_star_<?php echo $value['id'] ?>").html(result);
                                                //alert(result)
                                            }
                                        });
                                    });
                                </script>
                                <div class="price-box">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format(($value['price']*(100-$value['discount_percent']))/100).'</span>đ</span>';
                                        }else if($value['active'] == 0 || $value['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($value['price']).'</span>đ</span>';
                                        }
                                    ?>
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="old-price"><del>'.number_format($value['price']).'đ</del></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div> <!-- end single grid item -->
                    </div>
                <?php
            }
        }else{
            echo "Không có sản phẩm phù hợp";
        }
    }
    //Hàm hiển thị màu đen
    public function getBlack(Request $request){
        $value_product = $request->value_product;
        $black = $request->black;

        //Truy van
        $sql = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
        ->join('description', 'product.id', '=', 'description.product_id')
        ->select('product.*', 'discount.discount_percent', 'discount.active', 'description.*')
        ->Where('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor1', 'LIKE', '%'.$black.'%')

        ->orWhere('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor2', 'LIKE', '%'.$black.'%')

        ->orWhere('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor3', 'LIKE', '%'.$black.'%')
        ->get();
        if(count($sql) > 0){
            foreach ($sql as $value) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div style="height: 400px;" class="product-item mb-30">
                            <div class="product-thumb">
                                <a href="product-details?pid=<?php echo $value['id'] ?>">
                                    <img style="height: 180px; width: 180px;" src="product_images_desc/<?php
                                        if(strpos($value['dcolor1'], $black) !== false){
                                            echo $value['photo_color1'];
                                        }else if(strpos($value['dcolor2'], $black) !== false){
                                            echo $value['photo_color2'];
                                        }
                                        else if(strpos($value['dcolor3'], $black) !== false){
                                            echo $value['photo_color3'];
                                        }
                                    ?>" class="pri-img" alt="">
                                    <img style="height: 180px; width: 180px;" src="product_images_desc/<?php
                                        if(strpos($value['dcolor1'], $black) !== false){
                                            echo $value['photo_color1'];
                                        }else if(stripos($value['dcolor2'], $black) !== false){
                                            echo $value['photo_color2'];
                                        }
                                        else if(strpos($value['dcolor3'], $black) !== false){
                                            echo $value['photo_color3'];
                                        }
                                    ?>" class="sec-img" alt="">
                                </a>
                                <div class="box-label">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<div class="label-product label_sale">
                                                    <span>-'.$value['discount_percent'].'%</span>
                                                </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a><?php echo $value['manufacturer'] ?></a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details?pid=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h4>
                                </div>
                                <input type="hidden" name="" id="pid_<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
                                <div id="show_star_<?php echo $value['id'] ?>" class="ratings">
                                    <!-- Hiển thị trung bình sao ở đây -->
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var pid = $("#pid_<?php echo $value['id'] ?>").val();
                                        $.ajax({
                                            url: "ajax-jQuery/show-star-avg.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid
                                            },
                                            success: function(result){
                                                $("#show_star_<?php echo $value['id'] ?>").html(result);
                                                //alert(result)
                                            }
                                        });
                                    });
                                </script>
                                <div class="price-box">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format(($value['price']*(100-$value['discount_percent']))/100).'</span>đ</span>';
                                        }else if($value['active'] == 0 || $value['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($value['price']).'</span>đ</span>';
                                        }
                                    ?>
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="old-price"><del>'.number_format($value['price']).'đ</del></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div> <!-- end single grid item -->
                    </div>
                <?php
            }
        }else{
            echo "Không có sản phẩm phù hợp";
        }
    }
    //Hàm hiển thị màu tím
    public function getViolet(Request $request){
        $value_product = $request->value_product;
        $violet = $request->violet;

        //Truy van
        $sql = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
        ->join('description', 'product.id', '=', 'description.product_id')
        ->select('product.*', 'discount.discount_percent', 'discount.active', 'description.*')
        ->Where('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor1', 'LIKE', '%'.$violet.'%')

        ->orWhere('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor2', 'LIKE', '%'.$violet.'%')

        ->orWhere('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor3', 'LIKE', '%'.$violet.'%')
        ->get();
        if(count($sql) > 0){
            foreach ($sql as $value) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div style="height: 400px;" class="product-item mb-30">
                            <div class="product-thumb">
                                <a href="product-details?pid=<?php echo $value['id'] ?>">
                                    <img style="height: 180px; width: 180px;" src="product_images_desc/<?php
                                        if(strpos($value['dcolor1'], $violet) !== false){
                                            echo $value['photo_color1'];
                                        }else if(strpos($value['dcolor2'], $violet) !== false){
                                            echo $value['photo_color2'];
                                        }
                                        else if(strpos($value['dcolor3'], $violet) !== false){
                                            echo $value['photo_color3'];
                                        }
                                    ?>" class="pri-img" alt="">
                                    <img style="height: 180px; width: 180px;" src="product_images_desc/<?php
                                        if(strpos($value['dcolor1'], $violet) !== false){
                                            echo $value['photo_color1'];
                                        }else if(stripos($value['dcolor2'], $violet) !== false){
                                            echo $value['photo_color2'];
                                        }
                                        else if(strpos($value['dcolor3'], $violet) !== false){
                                            echo $value['photo_color3'];
                                        }
                                    ?>" class="sec-img" alt="">
                                </a>
                                <div class="box-label">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<div class="label-product label_sale">
                                                    <span>-'.$value['discount_percent'].'%</span>
                                                </div>';
                                        }
                                    ?>
                                </div>                            
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a><?php echo $value['manufacturer'] ?></a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details?pid=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h4>
                                </div>
                                <input type="hidden" name="" id="pid_<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
                                <div id="show_star_<?php echo $value['id'] ?>" class="ratings">
                                    <!-- Hiển thị trung bình sao ở đây -->
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var pid = $("#pid_<?php echo $value['id'] ?>").val();
                                        $.ajax({
                                            url: "ajax-jQuery/show-star-avg.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid
                                            },
                                            success: function(result){
                                                $("#show_star_<?php echo $value['id'] ?>").html(result);
                                                //alert(result)
                                            }
                                        });
                                    });
                                </script>
                                <div class="price-box">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format(($value['price']*(100-$value['discount_percent']))/100).'</span>đ</span>';
                                        }else if($value['active'] == 0 || $value['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($value['price']).'</span>đ</span>';
                                        }
                                    ?>
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="old-price"><del>'.number_format($value['price']).'đ</del></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div> <!-- end single grid item -->
                    </div>
                <?php
            }
        }else{
            echo "Không có sản phẩm phù hợp";
        }
    }
    //Màu bạc
    public function getSilver(Request $request){
        $value_product = $request->value_product;
        $silver = $request->silver;

        //Truy van
        $sql = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
        ->join('description', 'product.id', '=', 'description.product_id')
        ->select('product.*', 'discount.discount_percent', 'discount.active', 'description.*')
        ->Where('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor1', 'LIKE', '%'.$silver.'%')

        ->orWhere('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor2', 'LIKE', '%'.$silver.'%')

        ->orWhere('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor3', 'LIKE', '%'.$silver.'%')
        ->get();
        if(count($sql) > 0){
            foreach ($sql as $value) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div style="height: 400px;" class="product-item mb-30">
                            <div class="product-thumb">
                                <a href="product-details?pid=<?php echo $value['id'] ?>">
                                    <img style="height: 180px; width: 180px;" src="product_images_desc/<?php
                                        if(strpos($value['dcolor1'], $silver) !== false){
                                            echo $value['photo_color1'];
                                        }else if(strpos($value['dcolor2'], $silver) !== false){
                                            echo $value['photo_color2'];
                                        }
                                        else if(strpos($value['dcolor3'], $silver) !== false){
                                            echo $value['photo_color3'];
                                        }
                                    ?>" class="pri-img" alt="">
                                    <img style="height: 180px; width: 180px;" src="product_images_desc/<?php
                                        if(strpos($value['dcolor1'], $silver) !== false){
                                            echo $value['photo_color1'];
                                        }else if(stripos($value['dcolor2'], $silver) !== false){
                                            echo $value['photo_color2'];
                                        }
                                        else if(strpos($value['dcolor3'], $silver) !== false){
                                            echo $value['photo_color3'];
                                        }
                                    ?>" class="sec-img" alt="">
                                </a>
                                <div class="box-label">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<div class="label-product label_sale">
                                                    <span>-'.$value['discount_percent'].'%</span>
                                                </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a><?php echo $value['manufacturer'] ?></a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details?pid=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h4>
                                </div>
                                <input type="hidden" name="" id="pid_<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
                                <div id="show_star_<?php echo $value['id'] ?>" class="ratings">
                                    <!-- Hiển thị trung bình sao ở đây -->
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var pid = $("#pid_<?php echo $value['id'] ?>").val();
                                        $.ajax({
                                            url: "ajax-jQuery/show-star-avg.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid
                                            },
                                            success: function(result){
                                                $("#show_star_<?php echo $value['id'] ?>").html(result);
                                                //alert(result)
                                            }
                                        });
                                    });
                                </script>
                                <div class="price-box">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format(($value['price']*(100-$value['discount_percent']))/100).'</span>đ</span>';
                                        }else if($value['active'] == 0 || $value['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($value['price']).'</span>đ</span>';
                                        }
                                    ?>
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="old-price"><del>'.number_format($value['price']).'đ</del></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div> <!-- end single grid item -->
                    </div>
                <?php
            }
        }else{
            echo "Không có sản phẩm phù hợp";
        }
    }
    //Màu xám
    public function getGray(Request $request){
        $value_product = $request->value_product;
        $gray = $request->gray;

        //Truy van
        $sql = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
        ->join('description', 'product.id', '=', 'description.product_id')
        ->select('product.*', 'discount.discount_percent', 'discount.active', 'description.*')
        ->Where('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor1', 'LIKE', '%'.$gray.'%')

        ->orWhere('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor2', 'LIKE', '%'.$gray.'%')

        ->orWhere('product.delete_at', '=', NULL)
        ->Where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->Where('description.dcolor3', 'LIKE', '%'.$gray.'%')
        ->get();
        if(count($sql) > 0){
            foreach ($sql as $value) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div style="height: 400px;" class="product-item mb-30">
                            <div class="product-thumb">
                                <a href="product-details?pid=<?php echo $value['id'] ?>">
                                    <img style="height: 180px; width: 180px;" src="product_images_desc/<?php
                                        if(strpos($value['dcolor1'], $gray) !== false){
                                            echo $value['photo_color1'];
                                        }else if(strpos($value['dcolor2'], $gray) !== false){
                                            echo $value['photo_color2'];
                                        }
                                        else if(strpos($value['dcolor3'], $gray) !== false){
                                            echo $value['photo_color3'];
                                        }
                                    ?>" class="pri-img" alt="">
                                    <img style="height: 180px; width: 180px;" src="product_images_desc/<?php
                                        if(strpos($value['dcolor1'], $gray) !== false){
                                            echo $value['photo_color1'];
                                        }else if(stripos($value['dcolor2'], $gray) !== false){
                                            echo $value['photo_color2'];
                                        }
                                        else if(strpos($value['dcolor3'], $gray) !== false){
                                            echo $value['photo_color3'];
                                        }
                                    ?>" class="sec-img" alt="">
                                </a>
                                <div class="box-label">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<div class="label-product label_sale">
                                                    <span>-'.$value['discount_percent'].'%</span>
                                                </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a><?php echo $value['manufacturer'] ?></a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details?pid=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h4>
                                </div>
                                <input type="hidden" name="" id="pid_<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
                                <div id="show_star_<?php echo $value['id'] ?>" class="ratings">
                                    <!-- Hiển thị trung bình sao ở đây -->
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var pid = $("#pid_<?php echo $value['id'] ?>").val();
                                        $.ajax({
                                            url: "ajax-jQuery/show-star-avg.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid
                                            },
                                            success: function(result){
                                                $("#show_star_<?php echo $value['id'] ?>").html(result);
                                                //alert(result)
                                            }
                                        });
                                    });
                                </script>
                                <div class="price-box">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format(($value['price']*(100-$value['discount_percent']))/100).'</span>đ</span>';
                                        }else if($value['active'] == 0 || $value['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($value['price']).'</span>đ</span>';
                                        }
                                    ?>
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="old-price"><del>'.number_format($value['price']).'đ</del></span>';
                                        }
                                    ?>
                                </div>
                                <!-- <button class="btn-cart" type="button">add to cart</button> -->
                            </div>
                        </div> <!-- end single grid item -->
                    </div>
                <?php
            }
        }else{
            echo "Không có sản phẩm phù hợp";
        }
    }

    //Lọc theo rom 32gb
    public function getRom32gb(Request $request){
        $value_product = $request->value_product;
        $rom32gb = $request->rom32gb;

        //Truy van
        $sql = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
        ->join('description', 'product.id', '=', 'description.product_id')
        ->select('product.*', 'discount.discount_percent', 'discount.active', 'description.*')
        ->where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->where('product.delete_at', NULL)
        ->where('description.rom', 'LIKE', '%'.$rom32gb.'%')
        ->get();

        if(count($sql) > 0){
            foreach ($sql as $value) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div style="height: 400px;" class="product-item mb-30">
                            <div class="product-thumb">
                                <a href="product-details?pid=<?php echo $value['id'] ?>">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php
                                        echo $value['photo_name']
                                    ?>" class="pri-img" alt="">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php
                                        echo $value['photo_name']
                                    ?>" class="sec-img" alt="">
                                </a>
                                <div class="box-label">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<div class="label-product label_sale">
                                                    <span>-'.$value['discount_percent'].'%</span>
                                                </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a><?php echo $value['manufacturer'] ?></a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details?pid=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h4>
                                </div>
                                <input type="hidden" name="" id="pid_<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
                                <div id="show_star_<?php echo $value['id'] ?>" class="ratings">
                                    <!-- Hiển thị trung bình sao ở đây -->
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var pid = $("#pid_<?php echo $value['id'] ?>").val();
                                        $.ajax({
                                            url: "ajax-jQuery/show-star-avg.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid
                                            },
                                            success: function(result){
                                                $("#show_star_<?php echo $value['id'] ?>").html(result);
                                                //alert(result)
                                            }
                                        });
                                    });
                                </script>
                                <div class="price-box">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format(($value['price']*(100-$value['discount_percent']))/100).'</span>đ</span>';
                                        }else if($value['active'] == 0 || $value['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($value['price']).'</span>đ</span>';
                                        }
                                    ?>
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="old-price"><del>'.number_format($value['price']).'đ</del></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div> <!-- end single grid item -->
                    </div>
                <?php
            }
        }else{
            echo "Không có sản phẩm phù hợp";
        }
    }
    //64gb
    public function getRom64gb(Request $request){
        $value_product = $request->value_product;
        $rom64gb = $request->rom64gb;

        //Truy van
        $sql = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
        ->join('description', 'product.id', '=', 'description.product_id')
        ->select('product.*', 'discount.discount_percent', 'discount.active', 'description.*')
        ->where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->where('product.delete_at', NULL)
        ->where('description.rom', 'LIKE', '%'.$rom64gb.'%')
        ->get();

        if(count($sql) > 0){
            foreach ($sql as $value) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div style="height: 400px;" class="product-item mb-30">
                            <div class="product-thumb">
                                <a href="product-details?pid=<?php echo $value['id'] ?>">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php
                                        echo $value['photo_name']
                                    ?>" class="pri-img" alt="">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php
                                        echo $value['photo_name']
                                    ?>" class="sec-img" alt="">
                                </a>
                                <div class="box-label">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<div class="label-product label_sale">
                                                    <span>-'.$value['discount_percent'].'%</span>
                                                </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a><?php echo $value['manufacturer'] ?></a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details?pid=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h4>
                                </div>
                                <input type="hidden" name="" id="pid_<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
                                <div id="show_star_<?php echo $value['id'] ?>" class="ratings">
                                    <!-- Hiển thị trung bình sao ở đây -->
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var pid = $("#pid_<?php echo $value['id'] ?>").val();
                                        $.ajax({
                                            url: "ajax-jQuery/show-star-avg.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid
                                            },
                                            success: function(result){
                                                $("#show_star_<?php echo $value['id'] ?>").html(result);
                                                //alert(result)
                                            }
                                        });
                                    });
                                </script>
                                <div class="price-box">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format(($value['price']*(100-$value['discount_percent']))/100).'</span>đ</span>';
                                        }else if($value['active'] == 0 || $value['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($value['price']).'</span>đ</span>';
                                        }
                                    ?>
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="old-price"><del>'.number_format($value['price']).'đ</del></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div> <!-- end single grid item -->
                    </div>
                <?php
            }
        }else{
            echo "Không có sản phẩm phù hợp";
        }
    }
    //128gb
    public function getRom128gb(Request $request){
        $value_product = $request->value_product;
        $rom128gb = $request->rom128gb;

        //Truy van
        $sql = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
        ->join('description', 'product.id', '=', 'description.product_id')
        ->select('product.*', 'discount.discount_percent', 'discount.active', 'description.*')
        ->where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->where('product.delete_at', NULL)
        ->where('description.rom', 'LIKE', '%'.$rom128gb.'%')
        ->get();

        if(count($sql) > 0){
            foreach ($sql as $value) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div style="height: 400px;" class="product-item mb-30">
                            <div class="product-thumb">
                                <a href="product-details?pid=<?php echo $value['id'] ?>">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php
                                        echo $value['photo_name']
                                    ?>" class="pri-img" alt="">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php
                                        echo $value['photo_name']
                                    ?>" class="sec-img" alt="">
                                </a>
                                <div class="box-label">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<div class="label-product label_sale">
                                                    <span>-'.$value['discount_percent'].'%</span>
                                                </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a><?php echo $value['manufacturer'] ?></a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details?pid=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h4>
                                </div>
                                <input type="hidden" name="" id="pid_<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
                                <div id="show_star_<?php echo $value['id'] ?>" class="ratings">
                                    <!-- Hiển thị trung bình sao ở đây -->
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var pid = $("#pid_<?php echo $value['id'] ?>").val();
                                        $.ajax({
                                            url: "ajax-jQuery/show-star-avg.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid
                                            },
                                            success: function(result){
                                                $("#show_star_<?php echo $value['id'] ?>").html(result);
                                                //alert(result)
                                            }
                                        });
                                    });
                                </script>
                                <div class="price-box">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format(($value['price']*(100-$value['discount_percent']))/100).'</span>đ</span>';
                                        }else if($value['active'] == 0 || $value['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($value['price']).'</span>đ</span>';
                                        }
                                    ?>
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="old-price"><del>'.number_format($value['price']).'đ</del></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div> <!-- end single grid item -->
                    </div>
                <?php
            }
        }else{
            echo "Không có sản phẩm phù hợp";
        }
    }
    //128gb
    public function getRom256gb(Request $request){
        $value_product = $request->value_product;
        $rom256gb = $request->rom256gb;

        //Truy van
        $sql = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
        ->join('description', 'product.id', '=', 'description.product_id')
        ->select('product.*', 'discount.discount_percent', 'discount.active', 'description.*')
        ->where('product.manufacturer', 'LIKE', '%'.$value_product.'%')
        ->where('product.delete_at', NULL)
        ->where('description.rom', 'LIKE', '%'.$rom256gb.'%')
        ->get();

        if(count($sql) > 0){
            foreach ($sql as $value) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div style="height: 400px;" class="product-item mb-30">
                            <div class="product-thumb">
                                <a href="product-details?pid=<?php echo $value['id'] ?>">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php
                                        echo $value['photo_name']
                                    ?>" class="pri-img" alt="">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php
                                        echo $value['photo_name']
                                    ?>" class="sec-img" alt="">
                                </a>
                                <div class="box-label">                                  
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<div class="label-product label_sale">
                                                    <span>-'.$value['discount_percent'].'%</span>
                                                </div>';
                                        }
                                    ?>
                                </div>                              
                            </div>
                            <div class="product-caption">
                                <div class="manufacture-product">
                                    <p><a><?php echo $value['manufacturer'] ?></a></p>
                                </div>
                                <div class="product-name">
                                    <h4><a href="product-details?pid=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h4>
                                </div>
                                <input type="hidden" name="" id="pid_<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
                                <div id="show_star_<?php echo $value['id'] ?>" class="ratings">
                                    <!-- Hiển thị trung bình sao ở đây -->
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var pid = $("#pid_<?php echo $value['id'] ?>").val();
                                        $.ajax({
                                            url: "ajax-jQuery/show-star-avg.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid
                                            },
                                            success: function(result){
                                                $("#show_star_<?php echo $value['id'] ?>").html(result);
                                                //alert(result)
                                            }
                                        });
                                    });
                                </script>
                                <div class="price-box">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format(($value['price']*(100-$value['discount_percent']))/100).'</span>đ</span>';
                                        }else if($value['active'] == 0 || $value['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($value['price']).'</span>đ</span>';
                                        }
                                    ?>
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="old-price"><del>'.number_format($value['price']).'đ</del></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div> <!-- end single grid item -->
                    </div>
                <?php
            }
        }else{
            echo "Không có sản phẩm phù hợp";
        }
    }
}
