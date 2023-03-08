<?php

    class DeleteCategory{

        public function removeCategory($table, $conn, $cid){

            $sql = "SELECT * FROM $table WHERE id='$cid'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                //
                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $delete_at = date("m/d/Y h:ia");

                //Update trong product
                //Xóa nó đi
                $sqlup = "UPDATE product SET delete_at='$delete_at' WHERE category_id='$cid' AND delete_at IS NULL";
                $conn->query($sqlup);

                $sqlu = "UPDATE $table SET delete_at_category='$delete_at' WHERE id='$cid'";

                if($conn->query($sqlu) === TRUE){
                    echo $delete_at;
                }else{
                    echo "Xóa thất bại";
                }
            }else{
                echo "Xóa thất bại";
            }

        }

    }

?>