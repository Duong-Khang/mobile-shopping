<?php

    class CheckDeleteCategory{

        public function checkDeleteCategory($table, $conn, $cid){

            $sql = "SELECT * FROM $table WHERE id='$cid'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();

                if(!$row['delete_at_category']){
                    echo "1";
                }else{
                    echo "0";
                }
            }else{
                echo "1";
            }

        }

    }

?>