<?php

    class TestProductExists{

        public function productExists($table, $conn, $name, $file){

            //Trong product
            $sql = "SELECT * FROM $table WHERE `name`='$name'";

            $result = $conn->query($sql);

            if($result->num_rows>0){
                echo "exists";
                return false;
            }
            $sql = "SELECT * FROM $table WHERE photo_name='$file'";

            $result = $conn->query($sql);

            if($result->num_rows>0){
                echo "exists";
                return false;
            }
            //Trong description
            $sql = "SELECT * FROM description WHERE photo_color1='$file' OR photo_color2='$file' OR photo_color3='$file'";
            $result = $conn->query($sql);

            if($result->num_rows>0){
                echo "exists";
                return false;
            }
        }

    }

?>