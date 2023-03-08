<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class ControllerShop extends Controller
{
    public function index(){
        $shop = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
        ->select('product.*', 'discount.discount_percent', 'discount.active', 'discount.id AS did', 'discount.delete_at AS remove_date')
        ->where('product.delete_at', NULL)
        ->paginate(12);
        return view('shop', ['shop'=>$shop]);
    }

    public function productDetails(Request $request){

        $pid = $request->pid;

        echo $pid;

    }

    //Hiển thị Sản phẩm của chúng tôi
    public function showOurProduct(){
        $shop = Shop::join('discount', 'product.discount_id', '=', 'discount.id')
        ->select('product.*', 'discount.discount_percent', 'discount.active', 'discount.id AS did', 'product.delete_at AS removeProduct')
        ->where('product.delete_at', NULL)
        ->limit(20)->get();

        if(count($shop) > 0){
            foreach ($shop as $value) {
                ?>             
                    <div class="col mb-30">                 
                        <div style="height: 400px;" class="product-item">
                            <div class="product-thumb">
                                <a href="product-details?pid=<?php echo $value['id'] ?>">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php echo $value['photo_name'] ?>" class="pri-img" alt="">
                                    <img style="height: 180px; width: 180px;" src="product_images/<?php echo $value['photo_name'] ?>" class="sec-img" alt="">
                                </a>
                                <div class="box-label">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '
                                            <div class="label-product label_sale">
                                                <span>-'.$value['discount_percent'].'%</span>
                                            </div>
                                            ';
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
                                <input type="hidden" name="" id="_pid_<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
                                <div id="_show_star_<?php echo $value['id'] ?>" class="ratings">
                                    <!-- Hiển thị trung bình sao ở đây -->
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var pid = $("#_pid_<?php echo $value['id'] ?>").val();
                                        $.ajax({
                                            url: "ajax-jQuery/show-star-avg.php",
                                            type: "get",
                                            dataType: "text",
                                            data: {
                                                pid: pid
                                            },
                                            success: function(result){
                                                $("#_show_star_<?php echo $value['id'] ?>").html(result);                          
                                            }
                                        });
                                    });
                                </script>
                                <div class="price-box">
                                    <?php
                                        if($value['active'] == 1){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format(($value['price']*(100-$value['discount_percent']))/100).'</span> đ</span>';
                                        }else if($value['active'] == 0 || $value['active'] == 2){
                                            echo '<span class="regular-price"><span class="special-price">'.number_format($value['price']).'</span> đ</span>';
                                        }
                                    ?>
                                    <?php
                                        if($value['active'] == 1){
                                            echo '
                                            <span class="old-price"><del>'.number_format($value['price']).' đ</del></span>
                                            ';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>                       
                    </div>
                <?php
            }
        }
    }
}
