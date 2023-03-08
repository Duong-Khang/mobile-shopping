<?php

    class UpdateProduct{

        public function updateProduct(
            $conn, 
            $pid,
            $name,
            $desc,
            $short_desc,
            $rom,
            $ram,
            $chip_gpu,
            $chip_set,
            $screen,
            $status,
            $discount,
            $category,
            $price_color1,
            $quantity_color1,
            $price_color2,
            $quantity_color2,
            $price_color3,
            $quantity_color3
        ){

            //Kiểm tra status
            if($status == "0"){
                //Đã bị xóa
                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $delete_at = date("m/d/Y h:ia");
                //Kiểm tra xem có xóa chưa
                $sql = "SELECT * FROM product WHERE id='$pid'";
                $result = $conn->query($sql);
                if($result->num_rows>0){
                    $row = $result->fetch_assoc();
                    if($row['delete_at'] == NULL){
                        //Chưa xóa
                        //Kiểm tra xem màu có tồn tại không
                        //Màu 1
                        if($quantity_color1 != "none"){
                            //Có tồn tại
                            //Cập nhật trong table product_inventory
                            //Lấy inventory_id
                            $inventory_id = $row['inventory_id'];
                            $sqlInventory = "UPDATE product_inventory SET 
                            quantity_color1='$quantity_color1',
                            total_quantity_color1='$quantity_color1' 
                            WHERE id='$inventory_id'";
                            if($conn->query($sqlInventory) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong bảng product
                            //Lấy category name 
                            $sqlCategory = "SELECT * FROM product_category WHERE id='$category'";
                            $resultCategory = $conn->query($sqlCategory);
                            if($resultCategory->num_rows>0){
                                $rowCategory = $resultCategory->fetch_assoc();
                                $category_name = $rowCategory['name'];
                            }
                            $sqlProduct = "UPDATE product SET `name`='$name',
                            `desc`='$desc',
                            category_id='$category',
                            price='$price_color1',
                            discount_id='$discount',
                            manufacturer='$category_name', 
                            delete_at='$delete_at'
                            WHERE id='$pid'
                            ";
                            if($conn->query($sqlProduct) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong bảng description
                            $sqlDesc = "UPDATE `description` SET rom='$rom',
                            ram='$ram',
                            chip_gpu='$chip_gpu',
                            chip_set='$chip_set',
                            sr='$screen',
                            small_desc='$short_desc',
                            price_color1='$price_color1'  
                            WHERE product_id='$pid'
                            ";
                            if($conn->query($sqlDesc) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                        }
                        //Màu 2
                        if($quantity_color2 != "none"){
                            //Cập nhật trong product_inventory
                            $sqlInventory = "UPDATE product_inventory SET 
                            quantity_color2='$quantity_color2',
                            total_quantity_color2='$quantity_color2' 
                            WHERE id='$inventory_id'
                            ";
                            if($conn->query($sqlInventory) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong table description
                            $sqlDesc = "UPDATE `description` SET price_color2='$price_color2' WHERE product_id='$pid'";
                            if($conn->query($sqlDesc) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                        }
                        //Màu 3
                        if($quantity_color3 != "none"){
                            //Cập nhật trong product_inventory
                            $sqlInventory = "UPDATE product_inventory SET 
                            quantity_color3='$quantity_color3',
                            total_quantity_color3='$quantity_color3' 
                            WHERE id='$inventory_id'
                            ";
                            if($conn->query($sqlInventory) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong table description
                            $sqlDesc = "UPDATE `description` SET price_color3='$price_color3' WHERE product_id='$pid'";
                            if($conn->query($sqlDesc) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                        }
                    }else{
                        //Đã xóa
                        //Màu 1
                        if($quantity_color1 != "none"){
                            //Có tồn tại
                            //Cập nhật trong table product_inventory
                            //Lấy inventory_id
                            $inventory_id = $row['inventory_id'];
                            $sqlInventory = "UPDATE product_inventory SET 
                            quantity_color1='$quantity_color1',
                            total_quantity_color1='$quantity_color1' 
                            WHERE id='$inventory_id'";
                            if($conn->query($sqlInventory) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong bảng product
                            //Lấy category name 
                            $sqlCategory = "SELECT * FROM product_category WHERE id='$category'";
                            $resultCategory = $conn->query($sqlCategory);
                            if($resultCategory->num_rows>0){
                                $rowCategory = $resultCategory->fetch_assoc();
                                $category_name = $rowCategory['name'];
                            }
                            $sqlProduct = "UPDATE product SET `name`='$name',
                            `desc`='$desc',
                            category_id='$category',
                            price='$price_color1',
                            discount_id='$discount',
                            manufacturer='$category_name'   
                            WHERE id='$pid'
                            ";
                            if($conn->query($sqlProduct) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong bảng description
                            $sqlDesc = "UPDATE `description` SET rom='$rom',
                            ram='$ram',
                            chip_gpu='$chip_gpu',
                            chip_set='$chip_set',
                            sr='$screen',
                            small_desc='$short_desc',
                            price_color1='$price_color1'  
                            WHERE product_id='$pid'
                            ";
                            if($conn->query($sqlDesc) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                        }
                        //Màu 2
                        if($quantity_color2 != "none"){
                            //Cập nhật trong product_inventory
                            $sqlInventory = "UPDATE product_inventory SET 
                            quantity_color2='$quantity_color2',
                            total_quantity_color2='$quantity_color2' 
                            WHERE id='$inventory_id'
                            ";
                            if($conn->query($sqlInventory) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong table description
                            $sqlDesc = "UPDATE `description` SET price_color2='$price_color2' WHERE product_id='$pid'";
                            if($conn->query($sqlDesc) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                        }
                        //Màu 3
                        if($quantity_color3 != "none"){
                            //Cập nhật trong product_inventory
                            $sqlInventory = "UPDATE product_inventory SET 
                            quantity_color3='$quantity_color3',
                            total_quantity_color3='$quantity_color3' 
                            WHERE id='$inventory_id'
                            ";
                            if($conn->query($sqlInventory) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong table description
                            $sqlDesc = "UPDATE `description` SET price_color3='$price_color3' WHERE product_id='$pid'";
                            if($conn->query($sqlDesc) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                        }
                    }
                }
            }else if($status == "1"){
                //Chưa xóa
                //Kiểm tra xem có xóa chưa
                $sql = "SELECT * FROM product WHERE id='$pid'";
                $result = $conn->query($sql);
                if($result->num_rows>0){
                    $row = $result->fetch_assoc();
                    if($row['delete_at'] == NULL){
                        //Chưa xóa
                        //Kiểm tra xem màu có tồn tại không
                        //Màu 1
                        if($quantity_color1 != "none"){
                            //Có tồn tại
                            //Cập nhật trong table product_inventory
                            //Lấy inventory_id
                            $inventory_id = $row['inventory_id'];
                            $sqlInventory = "UPDATE product_inventory SET 
                            quantity_color1='$quantity_color1',
                            total_quantity_color1='$quantity_color1' 
                            WHERE id='$inventory_id'";
                            if($conn->query($sqlInventory) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong bảng product
                            //Lấy category name 
                            $sqlCategory = "SELECT * FROM product_category WHERE id='$category'";
                            $resultCategory = $conn->query($sqlCategory);
                            if($resultCategory->num_rows>0){
                                $rowCategory = $resultCategory->fetch_assoc();
                                $category_name = $rowCategory['name'];
                            }
                            $sqlProduct = "UPDATE product SET `name`='$name',
                            `desc`='$desc',
                            category_id='$category',
                            price='$price_color1',
                            discount_id='$discount',
                            manufacturer='$category_name' 
                            WHERE id='$pid'
                            ";
                            if($conn->query($sqlProduct) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong bảng description
                            $sqlDesc = "UPDATE `description` SET rom='$rom',
                            ram='$ram',
                            chip_gpu='$chip_gpu',
                            chip_set='$chip_set',
                            sr='$screen',
                            small_desc='$short_desc',
                            price_color1='$price_color1'  
                            WHERE product_id='$pid'
                            ";
                            if($conn->query($sqlDesc) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                        }
                        //Màu 2
                        if($quantity_color2 != "none"){
                            //Cập nhật trong product_inventory
                            $sqlInventory = "UPDATE product_inventory SET 
                            quantity_color2='$quantity_color2',
                            total_quantity_color2='$quantity_color2' 
                            WHERE id='$inventory_id'
                            ";
                            if($conn->query($sqlInventory) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong table description
                            $sqlDesc = "UPDATE `description` SET price_color2='$price_color2' WHERE product_id='$pid'";
                            if($conn->query($sqlDesc) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                        }
                        //Màu 3
                        if($quantity_color3 != "none"){
                            //Cập nhật trong product_inventory
                            $sqlInventory = "UPDATE product_inventory SET 
                            quantity_color3='$quantity_color3',
                            total_quantity_color3='$quantity_color3' 
                            WHERE id='$inventory_id'
                            ";
                            if($conn->query($sqlInventory) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong table description
                            $sqlDesc = "UPDATE `description` SET price_color3='$price_color3' WHERE product_id='$pid'";
                            if($conn->query($sqlDesc) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                        }
                    }else{
                        //Đã xóa
                        //Màu 1
                        if($quantity_color1 != "none"){
                            //Có tồn tại
                            //Cập nhật trong table product_inventory
                            //Lấy inventory_id
                            $inventory_id = $row['inventory_id'];
                            $sqlInventory = "UPDATE product_inventory SET 
                            quantity_color1='$quantity_color1',
                            total_quantity_color1='$quantity_color1' 
                            WHERE id='$inventory_id'";
                            if($conn->query($sqlInventory) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong bảng product
                            //Lấy category name 
                            $sqlCategory = "SELECT * FROM product_category WHERE id='$category'";
                            $resultCategory = $conn->query($sqlCategory);
                            if($resultCategory->num_rows>0){
                                $rowCategory = $resultCategory->fetch_assoc();
                                $category_name = $rowCategory['name'];
                            }
                            $sqlProduct = "UPDATE product SET `name`='$name',
                            `desc`='$desc',
                            category_id='$category',
                            price='$price_color1',
                            discount_id='$discount',
                            manufacturer='$category_name',
                            delete_at=NULL  
                            WHERE id='$pid'
                            ";
                            if($conn->query($sqlProduct) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong bảng description
                            $sqlDesc = "UPDATE `description` SET rom='$rom',
                            ram='$ram',
                            chip_gpu='$chip_gpu',
                            chip_set='$chip_set',
                            sr='$screen',
                            small_desc='$short_desc',
                            price_color1='$price_color1'  
                            WHERE product_id='$pid'
                            ";
                            if($conn->query($sqlDesc) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                        }
                        //Màu 2
                        if($quantity_color2 != "none"){
                            //Cập nhật trong product_inventory
                            $sqlInventory = "UPDATE product_inventory SET 
                            quantity_color2='$quantity_color2',
                            total_quantity_color2='$quantity_color2' 
                            WHERE id='$inventory_id'
                            ";
                            if($conn->query($sqlInventory) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong table description
                            $sqlDesc = "UPDATE `description` SET price_color2='$price_color2' WHERE product_id='$pid'";
                            if($conn->query($sqlDesc) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                        }
                        //Màu 3
                        if($quantity_color3 != "none"){
                            //Cập nhật trong product_inventory
                            $sqlInventory = "UPDATE product_inventory SET 
                            quantity_color3='$quantity_color3',
                            total_quantity_color3='$quantity_color3' 
                            WHERE id='$inventory_id'
                            ";
                            if($conn->query($sqlInventory) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                            //Cập nhật trong table description
                            $sqlDesc = "UPDATE `description` SET price_color3='$price_color3' WHERE product_id='$pid'";
                            if($conn->query($sqlDesc) === TRUE){
                                echo "Success";
                            }else{
                                echo "Error";
                            }
                        }
                    }
                }
            }

        }

    }

?>