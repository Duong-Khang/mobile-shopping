<?php

    class GetCategoryOld{

        public function getCategoriesOld($table, $conn, $category_id){

            $sql = "SELECT * FROM $table WHERE id='$category_id'";

            $result = $conn->query($sql);

            $arr = array();

            if($result -> num_rows > 0){
                $row = $result->fetch_assoc();
                $arr[] = array(
                    'category_name' => $row['name'],
                    'category_desc' => $row['desc'],
                    'delete_at' => $row['delete_at_category']
                );
            }

            die(json_encode($arr));

        }

    }

?>