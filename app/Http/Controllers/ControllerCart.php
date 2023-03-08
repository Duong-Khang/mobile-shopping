<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerCart extends Controller
{
    //Hàm xóa sản phẩm
    public function removeProduct(Request $request){

        $pid = $request->pid;

        $color = $request->color;

        $customer = $request->customer;

        //Truy vấn
        //Lấy số lượng để update trong bảng product_inventory
        $sqlGetQuantity = DB::table('cart_item')
        ->where('customer', $customer)
        ->where('product_id', $pid)
        ->where('color', $color)
        ->get();

        if(count($sqlGetQuantity) > 0){
            foreach ($sqlGetQuantity as $value) {
                $quantity = $value->quantity;
            }
        }
        
        //Xóa sản phẩm
        $sqlDeleteProduct = DB::table('cart_item')
        ->where('customer', $customer)
        ->where('product_id', $pid)
        ->where('color', $color)
        ->delete();

        if($sqlDeleteProduct){
            //Cập nhật lại số lượng trong product_inventory
            //Lấy inventory_id
            $sqlGetInventoryId = DB::table('product')->where('id', $pid)->get();
            foreach ($sqlGetInventoryId as $value) {
                $inventory_id =  $value->inventory_id;
            }

            //Màu 1
            //Lấy quantity cũ
            $sqlGetQuantityColor1 = DB::table('product_inventory')
            ->where('id', $inventory_id)
            ->where('color1', $color)
            ->get();
            
            if(count($sqlGetQuantityColor1) > 0){
                foreach ($sqlGetQuantityColor1 as $value) {
                    $quantityOld = $value->quantity_color1;
                    $quantityOld += $quantity;
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
                    $quantityOld += $quantity;
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
                    $quantityOld += $quantity;
                    //Cập nhật số lượng trong product_inventory
                    DB::table('product_inventory')
                    ->where('id', $inventory_id)
                    ->where('color3', $color)
                    ->update(['quantity_color3' => $quantityOld]);
                }
            }

            echo "1";
        }else{
            echo "0";
        }
    }

    //Hàm tăng số lượng
    public function incProduct(Request $request){

        $pid = $request->pid;

        $color = $request->color;

        $customer = $request->customer;

        $quantity = $request->quantity;

        if($quantity == 0){
            echo "error3";
            return false;
        }

        //Lấy quantity ở trong cart_item
        $sqlGetItemCart = DB::table('cart_item')
        ->where('customer', $customer)
        ->where('product_id', $pid)
        ->where('color', $color)
        ->get();
        if(count($sqlGetItemCart) > 0){
            foreach ($sqlGetItemCart as $value) {
                $quantityOfItem = $value->quantity;
            }
        }

        //Truy vấn
        //Lấy inventory_id
        $sqlGetInventoryId = DB::table('product')->where('id', $pid)->get();
        foreach ($sqlGetInventoryId as $value) {
            $inventory_id =  $value->inventory_id;
        }
        //Kiểm tra xem số lượng có hợp lệ không
        //Màu 1
        //Lấy quantity cũ
        $sqlGetQuantityColor1 = DB::table('product_inventory')
        ->where('id', $inventory_id)
        ->where('color1', $color)
        ->get();
        
        if(count($sqlGetQuantityColor1) > 0){
            foreach ($sqlGetQuantityColor1 as $value) {
                $quantityOfInventory = $value->quantity_color1;
                $quantityOfInventory += $quantityOfItem;
                $quantityUpdateOfInc = $quantityOfInventory;
                $quantityOfInventory -= $quantity;
                if($quantityOfInventory < 0){
                    echo "error1";//Số lượng không đủ đáp ứng
                    return false;
                }else{
                    //Cập nhật số lượng trong inventory
                    DB::table('product_inventory')
                    ->where('id', $inventory_id)
                    ->where('color1', $color)
                    ->update(['quantity_color1' => $quantityUpdateOfInc]);
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
                $quantityOfInventory = $value->quantity_color2;
                $quantityOfInventory += $quantityOfItem;
                $quantityUpdateOfInc = $quantityOfInventory;
                $quantityOfInventory -= $quantity;
                if($quantityOfInventory < 0){
                    echo "error1";//Số lượng không đủ đáp ứng
                    return false;
                }else{
                    //Cập nhật số lượng trong inventory
                    DB::table('product_inventory')
                    ->where('id', $inventory_id)
                    ->where('color2', $color)
                    ->update(['quantity_color2' => $quantityUpdateOfInc]);
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
                $quantityOfInventory = $value->quantity_color3;
                $quantityOfInventory += $quantityOfItem;
                $quantityUpdateOfInc = $quantityOfInventory;
                $quantityOfInventory -= $quantity;
                if($quantityOfInventory < 0){
                    echo "error1";//Số lượng không đủ đáp ứng
                    return false;
                }else{
                    //Cập nhật số lượng trong inventory
                    DB::table('product_inventory')
                    ->where('id', $inventory_id)
                    ->where('color3', $color)
                    ->update(['quantity_color3' => $quantityUpdateOfInc]);
                }
            }
        }
        //Nếu thỏa tiến hành update số lượng mới
        $sqlUpdateQuantity = DB::table('cart_item')
        ->where('customer', $customer)
        ->where('product_id', $pid)
        ->where('color', $color)
        ->update(['quantity' => $quantity]);

        if($sqlUpdateQuantity){
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

            echo $quantity;
        }else{
            echo "error2";
        }

    }

    //Hàm tăng số lượng
    public function decProduct(Request $request){

        $pid = $request->pid;

        $color = $request->color;

        $customer = $request->customer;

        $quantity = $request->quantity;

        if($quantity == 0){
            echo "error3";
            return false;
        }

        //Lấy quantity ở trong cart_item
        $sqlGetItemCart = DB::table('cart_item')
        ->where('customer', $customer)
        ->where('product_id', $pid)
        ->where('color', $color)
        ->get();
        if(count($sqlGetItemCart) > 0){
            foreach ($sqlGetItemCart as $value) {
                $quantityOfItem = $value->quantity;
            }
        }

        if($quantityOfItem == 1){
            echo "error3";
            return false;
        }

        //Truy vấn
        //Lấy inventory_id
        $sqlGetInventoryId = DB::table('product')->where('id', $pid)->get();
        foreach ($sqlGetInventoryId as $value) {
            $inventory_id =  $value->inventory_id;
        }
        //Kiểm tra xem số lượng có hợp lệ không
        //Màu 1
        //Lấy quantity cũ
        $sqlGetQuantityColor1 = DB::table('product_inventory')
        ->where('id', $inventory_id)
        ->where('color1', $color)
        ->get();
        
        if(count($sqlGetQuantityColor1) > 0){
            foreach ($sqlGetQuantityColor1 as $value) {
                $quantityOfInventory = $value->quantity_color1;
                $quantityOfInventory += $quantityOfItem;
                $quantityUpdateOfInc = $quantityOfInventory;
                $quantityOfInventory -= $quantity;
                if($quantityOfInventory < 0){
                    echo "error1";//Số lượng không đủ đáp ứng
                    return false;
                }else{
                    //Cập nhật số lượng trong inventory
                    DB::table('product_inventory')
                    ->where('id', $inventory_id)
                    ->where('color1', $color)
                    ->update(['quantity_color1' => $quantityUpdateOfInc]);
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
                $quantityOfInventory = $value->quantity_color2;
                $quantityOfInventory += $quantityOfItem;
                $quantityUpdateOfInc = $quantityOfInventory;
                $quantityOfInventory -= $quantity;
                if($quantityOfInventory < 0){
                    echo "error1";//Số lượng không đủ đáp ứng
                    return false;
                }else{
                    //Cập nhật số lượng trong inventory
                    DB::table('product_inventory')
                    ->where('id', $inventory_id)
                    ->where('color2', $color)
                    ->update(['quantity_color2' => $quantityUpdateOfInc]);
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
                $quantityOfInventory = $value->quantity_color3;
                $quantityOfInventory += $quantityOfItem;
                $quantityUpdateOfInc = $quantityOfInventory;
                $quantityOfInventory -= $quantity;
                if($quantityOfInventory < 0){
                    echo "error1";//Số lượng không đủ đáp ứng
                    return false;
                }else{
                    //Cập nhật số lượng trong inventory
                    DB::table('product_inventory')
                    ->where('id', $inventory_id)
                    ->where('color3', $color)
                    ->update(['quantity_color3' => $quantityUpdateOfInc]);
                }
            }
        }
        //Nếu thỏa tiến hành update số lượng mới
        $sqlUpdateQuantity = DB::table('cart_item')
        ->where('customer', $customer)
        ->where('product_id', $pid)
        ->where('color', $color)
        ->update(['quantity' => $quantity]);

        if($sqlUpdateQuantity){
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

            echo $quantity;
        }else{
            echo "error2";
        }

    }

    //Hàm lấy số lượng
    public function getQuantity(Request $request){

        $pid = $request->pid;

        $color = $request->color;

        $customer = $request->customer;

        $sqlGetQuantity = DB::table('cart_item')
        ->where('customer', $customer)
        ->where('product_id', $pid)
        ->where('color', $color)
        ->get();

        if(count($sqlGetQuantity) > 0){
            foreach ($sqlGetQuantity as $value) {
                echo $value->quantity;
            }
        }
    }
    //Hàm cập nhật tổng của từng item
    public function updateTotalOfItem(Request $request){

        $pid = $request->pid;

        $customer = $request->customer;

        $color = $request->color;

        //Truy vấn
        $totalOfItem = 0;
        $sqlGetTotalOfItem = DB::table('cart_item')
        ->join('description', 'description.product_id', '=', 'cart_item.product_id')
        ->join('discount', 'discount.id', '=', 'cart_item.discount_available')
        ->select('cart_item.*', 'description.*', 'discount.*')
        ->where('cart_item.customer', $customer)
        ->where('cart_item.color', $color)
        ->where('cart_item.product_id', $pid)
        ->get();
        
        if(count($sqlGetTotalOfItem) > 0){
            //Tính tiền theo từng màu
            foreach ($sqlGetTotalOfItem as $value) {
                if($value->active == '1'){
                    //Có discount
                    if($value->dcolor1 == $color){
                        $totalOfItem += (($value->price_color1 * (100 - $value->discount_percent))/100) * $value->quantity;
                    }else if($value->dcolor2 == $color){
                        $totalOfItem += (($value->price_color2 * (100 - $value->discount_percent))/100) * $value->quantity;
                    }else if($value->dcolor3 == $color){
                        $totalOfItem += (($value->price_color3 * (100 - $value->discount_percent))/100) * $value->quantity;
                    }
                }else if($value->active == '0' || $value->active == '2'){
                    //Không có discount
                    if($value->dcolor1 == $color){
                        $totalOfItem += $value->price_color1 * $value->quantity;
                    }else if($value->dcolor2 == $color){
                        $totalOfItem += $value->price_color2 * $value->quantity;
                    }else if($value->dcolor3 == $color){
                        $totalOfItem += $value->price_color3 * $value->quantity;
                    }
                }
                echo number_format($totalOfItem);
            }
        }else{
            echo "0";
        }
    }
    //Hàm cập nhật thành tiền
    public function updateTotal(Request $request){

        $customer = $request->customer;

        //Truy vấn
        $totalOfItem = 0;
        $sqlGetTotalOfItem = DB::table('cart_item')
        ->join('description', 'description.product_id', '=', 'cart_item.product_id')
        ->join('discount', 'discount.id', '=', 'cart_item.discount_available')
        ->select('cart_item.*', 'description.*', 'discount.*')
        ->where('cart_item.customer', $customer)
        ->get();
        
        if(count($sqlGetTotalOfItem) > 0){
            //Tính tiền theo từng màu
            foreach ($sqlGetTotalOfItem as $value) {
                if($value->active == '1'){
                    //Có discount
                    if($value->dcolor1 == $value->color){
                        $totalOfItem += (($value->price_color1 * (100 - $value->discount_percent))/100) * $value->quantity;
                    }else if($value->dcolor2 == $value->color){
                        $totalOfItem += (($value->price_color2 * (100 - $value->discount_percent))/100) * $value->quantity;
                    }else if($value->dcolor3 == $value->color){
                        $totalOfItem += (($value->price_color3 * (100 - $value->discount_percent))/100) * $value->quantity;
                    }
                }else if($value->active == '0' || $value->active == '2'){
                    //Không có discount
                    if($value->dcolor1 == $value->color){
                        $totalOfItem += $value->price_color1 * $value->quantity;
                    }else if($value->dcolor2 == $value->color){
                        $totalOfItem += $value->price_color2 * $value->quantity;
                    }else if($value->dcolor3 == $value->color){
                        $totalOfItem += $value->price_color3 * $value->quantity;
                    }
                }
            }
            echo number_format($totalOfItem).' đ';
        }else{
            echo "0";
        }

    }
    //Hàm kiểm tra mua hàng
    public function testCartEmpty(Request $request){

        $customer = $request->customer;

        //Kiểm tra trong cart_item

        $sqlTestEmpty = DB::table('cart_item')
        ->where('customer', $customer)
        ->get();

        if(count($sqlTestEmpty) > 0){
            echo "put";
        }else{
            echo "empty";
        }

    }
    //Hàm kiểm tra xem có đơn hàng không
    public function testOrderList(Request $request){

        $customer = $request->customer;

        //Lấy user_id

        $sqlGetUserId = DB::table('user')
        ->where('username', $customer)
        ->get();

        if(count($sqlGetUserId) > 0){
            //Lấy user_id
            foreach ($sqlGetUserId as $value) {
                $user_id = $value->id;
                //Kiểm tra trong table order_details
                $sqlTestOrder = DB::table('order_details')
                ->where('user_id', $user_id)
                ->get();
                if(count($sqlTestOrder) > 0){
                    echo "put";
                }else{
                    echo "empty";
                }
            }
        }else{  
            echo "empty";
        }

    }
}
