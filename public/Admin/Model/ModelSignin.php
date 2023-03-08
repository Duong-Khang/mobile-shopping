<?php

    class Signin{

        protected $username;

        protected $password;

        function __construct($username, $password) {
            $this->username = $username;
            $this->password = $password;
        }

        public function getUsername(){
            return $this->username;
        }

        public function getPassword(){
            return $this->password;
        }

        public function signinAccount($conn, $table){
            //Truy vấn
            $username = $this->getUsername();
            $password = $this->getPassword();
            $password = md5($password);
            $sql = "SELECT * FROM $table WHERE username='$username' AND password='$password' LIMIT 1";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $_SESSION["username"] = $row['username'];
                $_SESSION["password"] = $row['password'];
                setcookie('username', $username, time() + (86400 * 30), "/"); // 86400 = 1 day
                echo "Success";
            }else{
                echo "Tên tài khoản hoặc mật khẩu không đúng";
            }
        }

    }

?>