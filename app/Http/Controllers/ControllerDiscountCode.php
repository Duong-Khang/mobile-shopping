<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelDiscountCode;
use App\Models\ModelMyDiscountCode;
use Illuminate\Support\Facades\DB;

class ControllerDiscountCode extends Controller
{
    public function setDiscountCode(Request $request){

        $arr = array();
        $value_code = $request->value_code;
        $customer = $request->customer;

        $checkStatus = ModelDiscountCode::where([['dis_code', $value_code], ['status_code', '1'], ['delete_at', NULL]])->get();
        if(count($checkStatus) > 0){
            //Khi mà khách hàng nhập thêm 1 code nữa chỉ cho phép mỗi đơn hàng dùng 1 code thôi
            $checkExist = ModelMyDiscountCode::where([['customer', $customer], ['active_code', '1']])->get();
            if(count($checkExist) > 0){
                $arr[] = array(
                    'error' => 'Mỗi đơn hàng chỉ được dùng một mã giảm giá',
                );
                die(json_encode($arr));
                return false;
            }
            //Chèn vào table my_discount_code
            //Lấy code và value của nó
            $code = '';
            $value_code = 0;
           
            foreach ($checkStatus as $value) {
                $code = $value['dis_code'];
                $value_code = $value['value_code'];    
                $valueofcode = $value['value_code']; 
            }
            $addMyDiscountCode = DB::table('my_discount_code')->insert(
                [
                    'customer'=>$customer,
                    'dis_code'=>$code,
                    'value_code'=>$value_code,
                    'active_code' => '1'
                ]
            );
            if($addMyDiscountCode){
                //Update status code về 0
                DB::table('discount_code')
                ->where('dis_code', $code)
                ->update(['status_code' => '0']);
                $arr[] = array(
                    'error' => 'success',
                    'valueofcode' => $valueofcode
                );
                die(json_encode($arr));
                return false;
            }else{
                $arr[] = array(
                    'error' => 'Thêm mã giảm giá thất bại',
                );
                die(json_encode($arr));
                return false;
            }
        }else{
            $arr[] = array(
                'error' => 'Mã đã được sử dụng hoặc không tồn tại',
            );
            die(json_encode($arr));
            return false;
        }
    }

    public function testDiscountCode(Request $request){

        $customer = $request->customer;

        $sql = DB::table('my_discount_code')
        ->where('customer', $customer)
        ->where('active_code', '1')
        ->get();

        if(count($sql) > 0){
            foreach ($sql as $value) {
                echo $value->value_code;
            }
        }else{
            echo "0";
        }

    }
}
