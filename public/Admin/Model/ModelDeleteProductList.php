<?php

    class DeleteProductList{

        public function removeProductList($table, $conn, $pid){

            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $delete_at = date("m/d/Y h:ia");

            $sql = "UPDATE $table SET delete_at='$delete_at' WHERE id='$pid'";

            if($conn->query($sql) === TRUE){
                echo $delete_at;
            }else{
                echo '';
            }

        }

    }

?>