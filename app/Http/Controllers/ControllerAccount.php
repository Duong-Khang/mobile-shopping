<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LengthException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class ControllerAccount extends Controller
{
    //Hàm xử lý đăng nhập
    public function login(Request $request){
        $username = $request['username'];
        $password = $request['password'];
        
        //Xử lý truy vấn đăng nhập
        $sql = DB::table('user')->where(['username'=>$username, 'delete_at'=>NULL])->get();
        if(count($sql) > 0){
            foreach ($sql as $value) {
                if(Hash::check($password, $value->password)){
                    //Tiến hành đặt session và cookie
                    session(['username' => $username]);
                    //Trả về trang index
                    echo "Success";
                }else{
                    //Trả về trang login
                    echo "Tên tài khoản hoặc mật khẩu không đúng";
                }
            }
        }else{
            echo "Tài khoản không tồn tại";
        }
    }

    //Hàm đăng xuất
    public function logout(){
        if(Session::has('username')){
            Session::forget('username');
            return Redirect::route('/');
        }
    }

    //Hàm đăng ký
    public function register(Request $request){
        $username = $request['username'];
        $password = $request['password'];
        $password = Hash::make($password);
        //Kiểm tra xem user có tồn tại chưa
        $user = DB::table('user')
                ->where('username', $username)
                ->get();
        if(count($user) > 0){
            echo "Tên tài khoản đã tồn tại";
        }else{
            //Xử lý insert vào table
            $query = DB::table('user')->insert([
                'username' => $username,
                'password' => $password
            ]);
            if($query){
                //Đặt session
                session(['username' => $username]);
                //Điều hướng đến index
                echo "Success";
            }else{
                echo "Đăng ký thất bại";
            }
        }
    }
    //Hàm login quick
    public function loginQuick(Request $request){
        $username = $request['username'];
        $password = $request['password'];
        //Xử lý truy vấn đăng nhập
        $token = DB::table('user')->where(['username'=>$username, 'delete_at'=>NULL])->get();
        if(count($token) > 0){
            foreach ($token as $value) {
                if(Hash::check($password, $value->password)){
                    //Tiến hành đặt session và cookie
                    session(['username' => $username]);
                    //Trả về trang index
                    echo $username;
                }else{
                    //Trả về trang login
                    echo "error1";
                }
            }
        }else{
            echo "error2";
        }
    }

    public function registerQuick(Request $request){
        $username = $request['username'];
        $password = $request['password'];
        $cpassword = $request['cpassword'];
        if($password !== $cpassword){
            echo "Hai mật khẩu không giống nhau";
            return false;
        }
        $token = DB::table('user')->where('username',$username)->get();
        if(count($token) > 0){  
            echo "Tài khoản đã tồn tại";
            return false;
        }else{
            //insert
            $password = Hash::make($password);
            $query = DB::table('user')->insert([
                'username' => $username,
                'password' => $password
            ]);

            if($query){
                //Đặt session
                session(['username' => $username]);
                //Điều hướng đến index
                echo $username;
            }else{
                echo "Đăng ký thất bại";
            }
        }
    }

    //Hàm đổi mật khẩu
    public function changePassword(Request $request){

        $passwordOld = $request->passwordOld;

        $passwordNew = $request->passwordNew;

        $customer = $request->customer;

        //Truy vấn
        $sqlGetCustomer = DB::table('user')
        ->where('username', $customer)
        ->get();

        if(count($sqlGetCustomer) > 0){
            //Phải khách hàng
            //Kiểm tra mật khẩu cũ

            foreach ($sqlGetCustomer as $value) {
                if(Hash::check($passwordOld, $value->password)){
                    //Đúng mật khẩu cũ
                    //Update
                    $passwordNew = Hash::make($passwordNew);
                    $sqlUpdatePassword = DB::table('user')
                    ->where('username', $customer)
                    ->update(['password' => $passwordNew]);
                    if($sqlUpdatePassword){
                        //Đổi thành công
                        echo "Success";
                    }else{
                        //Đổi mật khẩu thất bại
                        echo "error3";
                        return false;
                    }
                }else{
                    //sai mật khẩu cũ
                    echo "error2";
                    return false;
                }
            }
        }else{
            echo "error1";
        }
    }

    public function addCustomer(Request $request){

        $username = $request->username;

        $password = $request->password;

        $password = Hash::make($password);
        //Kiểm tra xem user có tồn tại chưa
        $user = DB::table('user')
                ->where('username', $username)
                ->get();
        if(count($user) > 0){
            echo "Tên tài khoản đã tồn tại";
        }else{
            //Xử lý insert vào table
            $query = DB::table('user')->insert([
                'username' => $username,
                'password' => $password
            ]);
            if($query){
                echo "Success";
            }else{
                echo "Đăng ký thất bại";
            }
        }

    }

    public function editCustomer(Request $request){

        $username = $request->username;

        $password = $request->password;

        $status = $request->status;

        //Kiểm tra status
        if($status == 1){
            //Hoạt động
            //Cập nhật
            //Kiểm tra mật khẩu
            $sqlGetCustomer = DB::table('user')
            ->where('username', $username)
            ->get();
            if(count($sqlGetCustomer) > 0){
                //Có tồn tại
                foreach ($sqlGetCustomer as $value) {
                    if($value->password === $password){
                        //Không đổi
                        //Update
                        //Kiểm tra xem xóa chưa
                        if($value->delete_at == NULL){
                            //Chưa xóa
                            echo "Success";
                        }else if($value->delete_at != NULL){
                            //Đã xóa
                            $sqlUpdatePassword = DB::table('user')
                            ->where('username', $username)
                            ->update(['delete_at' => NULL]);
                            if($sqlUpdatePassword){
                                echo "Success";
                            }else{
                                echo "error2";//Update thất bại
                            }
                        }                        
                    }else{
                        //Đổi phải dùng hàm hash
                        $password = Hash::make($password);
                        //Update
                        $sqlUpdatePassword = DB::table('user')
                        ->where('username', $username)
                        ->update(['password' => $password, 'delete_at' => NULL]);
                        if($sqlUpdatePassword){
                            echo "Success";
                        }else{
                            echo "error2";//Update thất bại
                        }
                    }
                }
            }else{
                echo "error1";//Không tồn tại khách hàng
            }
        }else if($status == 0){
            //Xóa
            //Kiểm tra xem xóa chưa
            $sqlCheckDelete = DB::table('user')
            ->where('username', $username)
            ->get();
            if(count($sqlCheckDelete) > 0){
                foreach ($sqlCheckDelete as $value) {
                    if($value->delete_at == NULL){
                        //Chưa xóa
                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                        $delete_at = date("m/d/Y h:ia");
                        //Kiểm tra xem có thay đổi password không
                        if($password === $value->password){
                            //Không đổi update
                            $sqlu = DB::table('user')
                            ->where('username', $username)
                            ->update(['delete_at'=>$delete_at]);
                            if($sqlu){
                                echo "Success";
                            }else{
                                echo "error2";
                            }
                        }else{
                            //Phải hash
                            $password = Hash::make($password);
                            $sqlu = DB::table('user')
                            ->where('username', $username)
                            ->update(['password'=>$password, 'delete_at'=>$delete_at]);
                            if($sqlu){
                                echo "Success";
                            }else{
                                echo "error2";
                            }
                        }
                    }else if($value->delete_at != NULL){
                        //Đã xóa
                        //Kiểm tra xem có thay đổi password không
                        if($password === $value->password){
                            //Không đổi
                            echo "Success";
                        }else{
                            //Đổi
                            $password = Hash::make($password);
                            $sqlu = DB::table('user')
                            ->where('username', $username)
                            ->update(['password'=>$password]);
                            if($sqlu){
                                echo "Success";
                            }else{
                                echo "error2";
                            }
                        }
                    }
                }
            }else{  
                echo "error1";//Không tồn tại khách hàng
            }
        }

    }
}
