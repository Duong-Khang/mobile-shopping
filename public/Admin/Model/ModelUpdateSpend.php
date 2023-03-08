<?php

    class UpdateSpend{

        public function updateSpend($conn, $oid, $total, $spend){

            $sql = "UPDATE order_details SET total='$total', spend='$spend' WHERE id='$oid'";

            if($conn->query($sql) === TRUE){
                echo "Success";
            }else{
                echo "Error";
            }

        }

    }

?>