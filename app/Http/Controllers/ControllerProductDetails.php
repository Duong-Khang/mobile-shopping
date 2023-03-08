<?php

namespace App\Http\Controllers;

use AddToCart;
use Illuminate\Http\Request;
use App\Models\ModelDescription;
use App\Models\ModelShowApple;
use App\Models\ModelAddToCart;
use App\Models\ModelProductInventory;
use Illuminate\Support\Facades\DB;

class ControllerProductDetails extends Controller
{
    //Hàm cập nhật giá theo màu
    public function updatePriceColor(Request $request){

        $pid = $request->pid;

        $color = $request->color;

        //Truy vấn lấy giá ứng với màu đã chọn

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
                    $price_dis = ($value['price_color1']*(100-$discount_percent))/100;
                    echo '<span class="regular-price"><span class="special-price">'.number_format($price_dis).' đ</span></span>
                        <span class="old-price"><del>'.number_format($value['price_color1']).' đ</del></span>';
                }else if($discount_active == 0||$discount_active == 2){
                    echo '<span class="regular-price"><span class="special-price">'.number_format($value['price_color1']).' đ</span></span>';
                }
            }else if(strpos($value['dcolor2'], $color) !== false){
                if($discount_active == 1){
                    $price_dis = ($value['price_color2']*(100-$discount_percent))/100;
                    echo '<span class="regular-price"><span class="special-price">'.number_format($price_dis).' đ</span></span>
                        <span class="old-price"><del>'.number_format($value['price_color2']).' đ</del></span>';
                }else if($discount_active == 0||$discount_active == 2){
                    echo '<span class="regular-price"><span class="special-price">'.number_format($value['price_color2']).' đ</span></span>';
                }
            }else if(strpos($value['dcolor3'], $color) !== false){
                if($discount_active == 1){
                    $price_dis = ($value['price_color3']*(100-$discount_percent))/100;
                    echo '<span class="regular-price"><span class="special-price">'.number_format($price_dis).' đ</span></span>
                        <span class="old-price"><del>'.number_format($value['price_color3']).' đ</del></span>';
                }else if($discount_active == 0||$discount_active == 2){
                    echo '<span class="regular-price"><span class="special-price">'.number_format($value['price_color3']).' đ</span></span>';
                }
            }
        }

    }
    //Hàm cập nhật ảnh lớn ứng với màu đã chọn
    public function updateImagesBigColor(Request $request){

        $pid = $request->pid;
        $color = $request->color;

        $chooseColor = ModelDescription::where('product_id', $pid)->get();

        foreach ($chooseColor as $value) {
            if(strpos($value['dcolor1'], $color) !== false){
                echo '<img style="height: 400px; width: 400px;" src="product_images_desc/'.$value['photo_color1'].'" alt="" />
                <div class="img-view">
                    <a class="img-popup" href="product_images_desc/'.$value['photo_color1'].'"></a>
                </div>';
            }else if(strpos($value['dcolor2'], $color) !== false){
                echo '<img style="height: 400px; width: 400px;" src="product_images_desc/'.$value['photo_color2'].'" alt="" />
                <div class="img-view">
                    <a class="img-popup" href="product_images_desc/'.$value['photo_color2'].'"></a>
                </div>';
            }else if(strpos($value['dcolor3'], $color) !== false){
                echo '<img style="height: 400px; width: 400px;" src="product_images_desc/'.$value['photo_color3'].'" alt="" />
                <div class="img-view">
                    <a class="img-popup" href="product_images_desc/'.$value['photo_color3'].'"></a>
                </div>';
            }
        }

    }
    //Hàm hiển thị ảnh nhỏ ứng với màu đã chọn
    public function updateImagesTinyColor(Request $request){

        $pid = $request->pid;
        $color = $request->color;

        $chooseColor = ModelDescription::where('product_id', $pid)->get();

        foreach ($chooseColor as $value) {
            if(strpos($value['dcolor1'], $color) !== false){
                echo '<div class="pro-nav-thumb"><img style="width=78px; height:78px;" src="product_images_desc/'.$value['photo_color1'].'" alt="" /></div>   ';
            }else if(strpos($value['dcolor2'], $color) !== false){
                echo '<div class="pro-nav-thumb"><img style="width=78px; height:78px;" src="product_images_desc/'.$value['photo_color2'].'" alt="" /></div>   ';
            }else if(strpos($value['dcolor3'], $color) !== false){
                echo '<div class="pro-nav-thumb"><img style="width=78px; height:78px;" src="product_images_desc/'.$value['photo_color3'].'" alt="" /></div>   ';
            }
        }

    }
    //Hàm thêm vào giỏ hàng
    public function addToCart(Request $request){

        $pid = $request->pid;

        $color = $request->color;

        $customer = $request->customer;

        $did = $request->did;

        $quantity = $request->quantity;

        //Tiến hành truy vấn
        //Lấy inventory_id
        $sqlGetInventoryId = DB::table('product')->where('id', $pid)->get();
        foreach ($sqlGetInventoryId as $value) {
            $inventory_id =  $value->inventory_id;
        }
        
        $sqlGetItemCart = DB::table('cart_item')
        ->where('customer', $customer)
        ->where('product_id', $pid)
        ->where('color', $color)
        ->get();

        if(count($sqlGetItemCart) > 0){
            //Kiểm tra xem số lượng có hợp lệ không

            //Màu 1
            //Lấy quantity cũ
            $sqlGetQuantityColor1 = DB::table('product_inventory')
            ->where('id', $inventory_id)
            ->where('color1', $color)
            ->get();
            
            if(count($sqlGetQuantityColor1) > 0){
                foreach ($sqlGetQuantityColor1 as $value) {
                    $quantityOld = $value->quantity_color1;
                    $quantityOld -= $quantity;
                    if($quantityOld < 0){
                        echo "3";
                        return false;
                    }
                }
            }
            //Màu 2
            //Lấy quantity cũ
            $sqlGetQuantityColor2 = DB::table('product_inventory')
            ->where('id', $inventory_id)
            ->where('color2', $color)
            ->get();
            
            if(count($sqlGetQuantityColor2) > 0){
                foreach ($sqlGetQuantityColor2 as $value) {
                    $quantityOld = $value->quantity_color2;
                    $quantityOld -= $quantity;
                    if($quantityOld < 0){
                        echo "3";
                        return false;
                    }
                }
            }

            //Màu 3
            //Lấy quantity cũ
            $sqlGetQuantityColor3 = DB::table('product_inventory')
            ->where('id', $inventory_id)
            ->where('color3', $color)
            ->get();
            
            if(count($sqlGetQuantityColor3) > 0){
                foreach ($sqlGetQuantityColor3 as $value) {
                    $quantityOld = $value->quantity_color3;
                    $quantityOld -= $quantity;
                    if($quantityOld < 0){
                        echo "3";
                        return false;
                    }
                }
            }
            //Lấy quantity old
            foreach ($sqlGetItemCart as $value) {
                $quantityNew = $value->quantity;
            }
            //Đã có trong giỏ hàng
            $quantityNew += $quantity;
            //echo "Có";
            //Update số lượng
            $sqlUpdateQuantiy = DB::table('cart_item')
            ->where('customer', $customer)
            ->where('product_id', $pid)
            ->where('color', $color)
            ->update(['quantity' => $quantityNew]);
            if($sqlUpdateQuantiy){
                //Cập nhật số lượng trong product_inventory
                //Cập nhật theo từng màu nếu nó trùng
                //Màu 1
                //Lấy quantity cũ
                $sqlGetQuantityColor1 = DB::table('product_inventory')
                ->where('id', $inventory_id)
                ->where('color1', $color)
                ->get();
                
                if(count($sqlGetQuantityColor1) > 0){
                    foreach ($sqlGetQuantityColor1 as $value) {
                        $quantityOld = $value->quantity_color1;
                        $quantityOld -= $quantity;
                        //Cập nhật số lượng trong product_inventory
                        DB::table('product_inventory')
                        ->where('id', $inventory_id)
                        ->where('color1', $color)
                        ->update(['quantity_color1' => $quantityOld]);
                    }
                }

                //Màu 2
                //Lấy quantity cũ
                $sqlGetQuantityColor2 = DB::table('product_inventory')
                ->where('id', $inventory_id)
                ->where('color2', $color)
                ->get();
                
                if(count($sqlGetQuantityColor2) > 0){
                    foreach ($sqlGetQuantityColor2 as $value) {
                        $quantityOld = $value->quantity_color2;
                        $quantityOld -= $quantity;
                        //Cập nhật số lượng trong product_inventory
                        DB::table('product_inventory')
                        ->where('id', $inventory_id)
                        ->where('color2', $color)
                        ->update(['quantity_color2' => $quantityOld]);
                    }
                }

                //Màu 3
                //Lấy quantity cũ
                $sqlGetQuantityColor3 = DB::table('product_inventory')
                ->where('id', $inventory_id)
                ->where('color3', $color)
                ->get();
                
                if(count($sqlGetQuantityColor3) > 0){
                    foreach ($sqlGetQuantityColor3 as $value) {
                        $quantityOld = $value->quantity_color3;
                        $quantityOld -= $quantity;
                        //Cập nhật số lượng trong product_inventory
                        DB::table('product_inventory')
                        ->where('id', $inventory_id)
                        ->where('color3', $color)
                        ->update(['quantity_color3' => $quantityOld]);
                    }
                }
                
                echo "1";
            }else{
                echo "2";
            }
        }else{
            //Chưa có trong giỏ hàng
            //Kiểm tra xem số lượng có hợp lệ không

            //Màu 1
            //Lấy quantity cũ
            $sqlGetQuantityColor1 = DB::table('product_inventory')
            ->where('id', $inventory_id)
            ->where('color1', $color)
            ->get();
            
            if(count($sqlGetQuantityColor1) > 0){
                foreach ($sqlGetQuantityColor1 as $value) {
                    $quantityOld = $value->quantity_color1;
                    $quantityOld -= $quantity;
                    if($quantityOld < 0){
                        echo "3";
                        return false;
                    }
                }
            }
            //Màu 2
            //Lấy quantity cũ
            $sqlGetQuantityColor2 = DB::table('product_inventory')
            ->where('id', $inventory_id)
            ->where('color2', $color)
            ->get();
            
            if(count($sqlGetQuantityColor2) > 0){
                foreach ($sqlGetQuantityColor2 as $value) {
                    $quantityOld = $value->quantity_color2;
                    $quantityOld -= $quantity;
                    if($quantityOld < 0){
                        echo "3";
                        return false;
                    }
                }
            }

            //Màu 3
            //Lấy quantity cũ
            $sqlGetQuantityColor3 = DB::table('product_inventory')
            ->where('id', $inventory_id)
            ->where('color3', $color)
            ->get();
            
            if(count($sqlGetQuantityColor3) > 0){
                foreach ($sqlGetQuantityColor3 as $value) {
                    $quantityOld = $value->quantity_color3;
                    $quantityOld -= $quantity;
                    if($quantityOld < 0){
                        echo "3";
                        return false;
                    }
                }
            }

            //Insert vào table cart_item
            $sqlInsertCartItem = DB::table('cart_item')->insert([
                'customer' => $customer,
                'product_id' => $pid,
                'quantity' => $quantity,
                'color' => $color,
                'discount_available' => $did
            ]);

            if($sqlInsertCartItem){
                //Cập nhật số lượng trong product_inventory
                //Cập nhật theo từng màu nếu nó trùng
                //Màu 1
                //Lấy quantity cũ
                $sqlGetQuantityColor1 = DB::table('product_inventory')
                ->where('id', $inventory_id)
                ->where('color1', $color)
                ->get();
                
                if(count($sqlGetQuantityColor1) > 0){
                    foreach ($sqlGetQuantityColor1 as $value) {
                        $quantityOld = $value->quantity_color1;
                        $quantityOld -= $quantity;
                        //Cập nhật số lượng trong product_inventory
                        DB::table('product_inventory')
                        ->where('id', $inventory_id)
                        ->where('color1', $color)
                        ->update(['quantity_color1' => $quantityOld]);
                    }
                }

                //Màu 2
                //Lấy quantity cũ
                $sqlGetQuantityColor2 = DB::table('product_inventory')
                ->where('id', $inventory_id)
                ->where('color2', $color)
                ->get();
                
                if(count($sqlGetQuantityColor2) > 0){
                    foreach ($sqlGetQuantityColor2 as $value) {
                        $quantityOld = $value->quantity_color2;
                        $quantityOld -= $quantity;
                        //Cập nhật số lượng trong product_inventory
                        DB::table('product_inventory')
                        ->where('id', $inventory_id)
                        ->where('color2', $color)
                        ->update(['quantity_color2' => $quantityOld]);
                    }
                }

                //Màu 3
                //Lấy quantity cũ
                $sqlGetQuantityColor3 = DB::table('product_inventory')
                ->where('id', $inventory_id)
                ->where('color3', $color)
                ->get();
                
                if(count($sqlGetQuantityColor3) > 0){
                    foreach ($sqlGetQuantityColor3 as $value) {
                        $quantityOld = $value->quantity_color3;
                        $quantityOld -= $quantity;
                        //Cập nhật số lượng trong product_inventory
                        DB::table('product_inventory')
                        ->where('id', $inventory_id)
                        ->where('color3', $color)
                        ->update(['quantity_color3' => $quantityOld]);
                    }
                }
                
                echo "1";
            }else{
                echo "2";
            }
        }
    }
    //Hàm cập nhật số lượng trên cart icon
    public function updateQuantityCartIcon(Request $request){

        $customer = $request->customer;
        $productExists = ModelAddToCart::where('customer', $customer)->get();
        if(count($productExists) > 0){
            $quantity = count($productExists);
            echo $quantity;
        }else{
            echo "0";
        }

    }
    //Hàm kiểm tra xem sản phẩm có bị xóa chưa
    public function testProductDelete(Request $request){

        $pid = $request->pid;

        $sql = DB::table('product')->where('id', $pid)->get();

        if(count($sql) > 0){
            foreach ($sql as $value) {
                if($value->delete_at != NULL){
                    echo "remove";
                }
            }
        }

    }
}