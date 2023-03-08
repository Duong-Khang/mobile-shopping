<?php

    class UpdateCategory{

        public function updateCategories($table, $conn, $category_id, $name, $desc, $status){

            $sql = "SELECT * FROM $table WHERE id='$category_id'";

            $result = $conn->query($sql);

            if($result-> num_rows > 0){
                //Update
                if($status == 1){

                    $row = $result->fetch_assoc();

                    //Update trong product
                    //Lấy delete_at_category
                    $delete_at_category = $row['delete_at_category'];
                    $sqlup = "UPDATE product SET delete_at=NULL WHERE category_id='$category_id' AND delete_at='$delete_at_category'";
                    $conn->query($sqlup);

                    $sqlu = "UPDATE $table SET `name`='$name', `desc`='$desc', delete_at_category=NULL WHERE id='$category_id'";

                    if($conn->query($sqlu) === TRUE){
                        echo "Success";
                    }else{
                        echo "Sửa thất bại";
                    }

                }else if($status == 0){

                    $row = $result->fetch_assoc();

                    if($row['delete_at_category'] != NULL){
                        $sqlu = "UPDATE $table SET `name`='$name', `desc`='$desc' WHERE id='$category_id'";

                        if($conn->query($sqlu) === TRUE){
                            echo "Success";
                        }else{
                            echo "Sửa thất bại";
                        }
                    }else{
                        date_default_timezone_set('Asia/Ho_Chi_Minh');

                        $delete_at = date("m/d/Y h:ia");

                        $sqlu = "UPDATE $table SET `name`='$name', `desc`='$desc', delete_at_category='$delete_at' WHERE id='$category_id'";

                        if($conn->query($sqlu) === TRUE){
                            echo "Success";
                        }else{
                            echo "Sửa thất bại";
                        }
                    }   
                }
                
            }else{  
                echo "Danh mục không tồn tại";
            }

        }

    }

?>