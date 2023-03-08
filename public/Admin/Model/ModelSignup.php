<?php

    class Signup extends Signin{

        public function signupAccount($conn, $table){
            //Truy vấn
            $username = $this->getUsername();
            $password = $this->getPassword();
            $sql = "SELECT * FROM $table WHERE username='$username'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                echo "Tên tài khoản đã tồn tại";
                return false;
            }else{
                //Mã hóa password
                $password = md5($password);
                $sqli = "INSERT INTO $table(username, password)
                VALUES('$username', '$password')
                ";
                if($conn->query($sqli) === TRUE){
                    $_SESSION["username"] = $username;
                    $_SESSION["password"] = $password;
                    setcookie('username', $username, time() + (86400 * 30), "/"); // 86400 = 1 day
                    echo "Success";
                }else{
                    echo "Đăng ký thất bại";
                }
            }
        }

    }

?>