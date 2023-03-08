<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelDescription;
use App\Models\ModelShowApple;
use Illuminate\Support\Facades\DB;

class ControllerChangeColor extends Controller
{
    //Thay đổi màu ảnh lớn
    public function getColorDesc(Request $request){
        $pid = $request->pid;
        $color = $request->color;

        $chooseColor = ModelDescription::where('product_id', $pid)->get();

        foreach ($chooseColor as $value) {
            if(strpos($value['dcolor1'], $color) !== false){
                echo '<img src="../product_images_desc/'.$value['photo_color1'].'" alt="" />';
            }else if(strpos($value['dcolor2'], $color) !== false){
                echo '<img src="../product_images_desc/'.$value['photo_color2'].'" alt="" />';
            }else if(strpos($value['dcolor3'], $color) !== false){
                echo '<img src="../product_images_desc/'.$value['photo_color3'].'" alt="" />';
            }
        }
    }
    //Thay đổi hình nhỏ
    public function getColorDescNav(Request $request){
        $pid = $request->pid;
        $color = $request->color;

        $chooseColor = ModelDescription::where('product_id', $pid)->get();

        foreach ($chooseColor as $value) {
            if(strpos($value['dcolor1'], $color) !== false){
                echo '<div class="pro-nav-thumb"><img style="width=78px; height:78px;" src="product_images_desc/'.$value['photo_color1'].'" alt="" /></div>';
            }else if(strpos($value['dcolor2'], $color) !== false){
                echo '<div class="pro-nav-thumb"><img style="width=78px; height:78px;" src="product_images_desc/'.$value['photo_color2'].'" alt="" /></div>';
            }else if(strpos($value['dcolor3'], $color) !== false){
                echo '<div class="pro-nav-thumb"><img style="width=78px; height:78px;" src="product_images_desc/'.$value['photo_color3'].'" alt="" /></div>';
            }
        }
    }
    //Cập nhật giá theo màu old
    public function getPriceDesc(Request $request){
        $pid = $request->pid;
        $color = $request->color;
        $chooseColor = ModelDescription::where('product_id', $pid)->get();
        foreach ($chooseColor as $value) {
            if(strpos($value['dcolor1'], $color) !== false){
                echo number_format($value['price_color1']).'đ';
            }else if(strpos($value['dcolor2'], $color) !== false){
                echo number_format($value['price_color2']).'đ';
            }else if(strpos($value['dcolor3'], $color) !== false){
                echo number_format($value['price_color3']).'đ';
            }
        }
    }
    //Cập nhật giá theo màu new
    public function getPriceDescNav(Request $request){
        $pid = $request->pid;
        $color = $request->color;
        $chooseColor = ModelDescription::join('product', 'product.id', '=', 'description.product_id')
        ->select('description.*', 'product.discount_id')
        ->where('description.product_id', $pid)
        ->get();

        foreach ($chooseColor as $value) {
            $discount_id = $value['discount_id'];
            $chooseDiscount = ModelShowApple::join('discount', 'product.discount_id', '=', 'discount.id')
            ->select('product.name', 'discount.discount_percent', 'discount.active')
            ->where('product.discount_id', $discount_id)
            ->get();
            $discount_percent = 0;
            $discount_active = 0;
            foreach ($chooseDiscount as $dvalue) {
                $discount_percent = $dvalue['discount_percent'];
                $discount_active = $dvalue['active'];
            }

            if(strpos($value['dcolor1'], $color) !== false){
                if($discount_active == 1){
                    echo number_format($value['price_color1']*(100 - $discount_percent)/100).'đ';
                }else if($discount_active == 0||$discount_active == 2){
                    echo number_format($value['price_color1']).'đ';
                }
            }else if(strpos($value['dcolor2'], $color) !== false){
                if($discount_active == 1){
                    echo number_format($value['price_color2']*(100 - $discount_percent)/100).'đ';
                }else if($discount_active == 0||$discount_active == 2){
                    echo number_format($value['price_color2']).'đ';
                }
            }else if(strpos($value['dcolor3'], $color) !== false){
                if($discount_active == 1){
                    echo number_format($value['price_color3']*(100 - $discount_percent)/100).'đ';
                }else if($discount_active == 0||$discount_active == 2){
                    echo number_format($value['price_color3']).'đ';
                }
            }
        }
    }
}

