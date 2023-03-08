<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelAddToCart;
use Illuminate\Support\Facades\DB;

class ControllerUpdateQuantity extends Controller
{
    public function updateQuantityCart(Request $request){
        $customer = $request->customer;
        $productExists = ModelAddToCart::where('customer', $customer)->get();
        if(count($productExists) > 0){
            $quantity = count($productExists);
            echo $quantity;
        }else{
            echo "0";
        }
    }

    public function updateQuantityKeyup(Request $request){

        $customer = $request->customer;

        $color = $request->color;

        $pid = $request->pid;

        $quantityNew = $request->quantity;

        //Cập nhật lại số lượng

        //Lấy inventory_id
        $sqlGetIn = DB::table('product')
        ->where('id', $pid)
        ->get();

        if(count($sqlGetIn) > 0){
            foreach ($sqlGetIn as $value) {
                $inventory_id = $value->inventory_id;
            }
        }

        //Lấy số lượng cũ
        $sqlGetQuantityOld = DB::table('cart_item')
        ->where('customer', $customer)
        ->where('color', $color)
        ->where('product_id', $pid)
        ->get();

        if(count($sqlGetQuantityOld) > 0){
            foreach ($sqlGetQuantityOld as $value) {
                $quantityOld = $value->quantity;
            }
        }

        //Cộng lại quantity trong product_inventory

        //Màu 1
        $sqlGetInColor1 = DB::table('product_inventory')
        ->where('color1', $color)
        ->where('id', $inventory_id)
        ->get();

        if(count($sqlGetInColor1) > 0){
            foreach ($sqlGetInColor1 as $value) {
                $quantityColor1 = $value->quantity_color1;
                //Cộng với quantityOld
                $quantityColor1 += $quantityOld;
                //Kiểm tra xem quantityNew hợp lý không
                if($quantityColor1 < $quantityNew){
                    //Không đủ đáp ứng
                    echo "error1";//Không đủ số lượng đáp ứng
                    return false;
                }else{
                    //Hợp lý tiến hành update số lượng trong cart_item
                    $sqlUpdateColor1 = DB::table('cart_item')
                    ->where('customer', $customer)
                    ->where('product_id', $pid)
                    ->where('color', $color)
                    ->update(['quantity' => $quantityNew]);
                    if($sqlUpdateColor1){
                        //Cập nhập số lượng trong product_inventory
                        $quantityColor1 -= $quantityNew;
                        $sqlUpdateInColor1 = DB::table('product_inventory')
                        ->where('color1', $color)
                        ->where('id', $inventory_id)
                        ->update(['quantity_color1' => $quantityColor1]);
                        if($sqlUpdateInColor1){
                            echo "success";
                            return false;
                        }else{
                            //echo "error2";
                            return false;
                        }                        
                    }else{
                        //echo "error2";
                        return false;
                    }
                }
            }
        }

        //Màu 2
        $sqlGetInColor2 = DB::table('product_inventory')
        ->where('color2', $color)
        ->where('id', $inventory_id)
        ->get();

        if(count($sqlGetInColor2) > 0){
            foreach ($sqlGetInColor2 as $value) {
                $quantityColor2 = $value->quantity_color2;
                //Cộng với quantityOld
                $quantityColor2 += $quantityOld;
                //Kiểm tra xem quantityNew hợp lý không
                if($quantityColor2 < $quantityNew){
                    //Không đủ đáp ứng
                    echo "error1";//Không đủ số lượng đáp ứng
                    return false;
                }else{
                    //Hợp lý tiến hành update số lượng trong cart_item
                    $sqlUpdateColor2 = DB::table('cart_item')
                    ->where('customer', $customer)
                    ->where('product_id', $pid)
                    ->where('color', $color)
                    ->update(['quantity' => $quantityNew]);
                    if($sqlUpdateColor2){
                        //Cập nhập số lượng trong product_inventory
                        $quantityColor2 -= $quantityNew;
                        $sqlUpdateInColor2 = DB::table('product_inventory')
                        ->where('color2', $color)
                        ->where('id', $inventory_id)
                        ->update(['quantity_color2' => $quantityColor2]);
                        if($sqlUpdateInColor2){
                            echo "success";
                            return false;
                        }else{
                            //echo "error2";
                            return false;
                        }                        
                    }else{
                        //echo "error2";
                        return false;
                    }
                }
            }
        }

        //Màu 3
        $sqlGetInColor3 = DB::table('product_inventory')
        ->where('color3', $color)
        ->where('id', $inventory_id)
        ->get();

        if(count($sqlGetInColor3) > 0){
            foreach ($sqlGetInColor3 as $value) {
                $quantityColor3 = $value->quantity_color3;
                //Cộng với quantityOld
                $quantityColor3 += $quantityOld;
                //Kiểm tra xem quantityNew hợp lý không
                if($quantityColor3 < $quantityNew){
                    //Không đủ đáp ứng
                    echo "error1";//Không đủ số lượng đáp ứng
                    return false;
                }else{
                    //Hợp lý tiến hành update số lượng trong cart_item
                    $sqlUpdateColor3 = DB::table('cart_item')
                    ->where('customer', $customer)
                    ->where('product_id', $pid)
                    ->where('color', $color)
                    ->update(['quantity' => $quantityNew]);
                    if($sqlUpdateColor3){
                        //Cập nhập số lượng trong product_inventory
                        $quantityColor3 -= $quantityNew;
                        $sqlUpdateInColor3 = DB::table('product_inventory')
                        ->where('color3', $color)
                        ->where('id', $inventory_id)
                        ->update(['quantity_color3' => $quantityColor3]);
                        if($sqlUpdateInColor3){
                            echo "success";
                            return false;
                        }else{
                            //echo "error2";
                            return false;
                        }                        
                    }else{
                        //echo "error2";
                        return false;
                    }
                }
            }
        }

    }
}
