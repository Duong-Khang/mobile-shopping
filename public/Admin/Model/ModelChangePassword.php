<?php

    class ChangePassword{

        public function changePassword($table, $conn, $passwordOld, $passwordNew, $admin){

            //Kiểm tra password old
            $passwordOld = md5($passwordOld);
            $sqlo = "SELECT * FROM $table WHERE username='$admin' AND `password`='$passwordOld'";
            $resulto = $conn->query($sqlo);
            if($resulto->num_rows > 0){
                //Tiến hành update password
                $passwordNew = md5($passwordNew);
                $sqlu = "UPDATE $table SET `password`='$passwordNew' WHERE username='$admin'";
                if($conn->query($sqlu) === TRUE){
                    echo "1";
                }else{
                    echo "Đổi mật khẩu thất bại";
                }
            }else{
                echo "Mật khẩu cũ không đúng";
            }

        }

    }

?>