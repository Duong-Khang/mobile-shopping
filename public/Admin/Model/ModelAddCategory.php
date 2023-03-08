<?php

    class AddCategory{

        public function addCategories($table, $conn, $category_name, $category_desc){
            
            $sql = "SELECT * FROM $table WHERE name='$category_name'";

            $result = $conn->query($sql);

            if($result -> num_rows > 0){
                echo "Danh mục đã tồn tại";
            }else{
                $sqli = "INSERT INTO product_category (`name`, `desc`)
                VALUES ('$category_name', '$category_desc')";
                
                if($conn->query($sqli) === TRUE){
                    echo "Success";
                }else{
                    echo "Thêm thất bại";
                }
            }

        }

    }

?>