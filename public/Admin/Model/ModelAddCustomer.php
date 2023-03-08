<?php
    class AddCustomer{

        public function addUser($table, $conn, $username, $password){

            $sql = "SELECT * FROM user WHERE username='$username'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                echo "Khách hàng đã tồn tại";
            }else{
                //Insert
                $sqli = "INSERT INTO $table(username, password)
                VALUES('$username', '$password')
                ";
                if($conn->query($sqli) === TRUE){
                    echo "Success";
                }else{
                    echo "Thêm thất bại";
                }
            }

        }

    }

?>