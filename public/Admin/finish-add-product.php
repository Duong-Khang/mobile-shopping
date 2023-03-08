<?php
ob_start();
session_start();
include "connect.php";
//Lấy tên sản phẩm
$product_name = $_POST['product_name'];

//Kiểm tra name
$sql = "SELECT * FROM product WHERE name='$product_name'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Sản phẩm đã tồn tại, xin nhập lại thông tin");
            window.location.href="../Admin/add-product.php";
        </script>';
    //header("location: add-product");
    return false;
}

//Lấy mô tả sản phẩm
$product_desc = $_POST['product_desc'];

//Lấy tên danh mục sản phẩm
$product_category = $_POST['product_category'];

//Lấy % khuyến mãi
$product_discount = $_POST['product_discount'];

//Lấy ROM
$product_rom = $_POST['product_rom'];

//Lấy RAM
$product_ram = $_POST['product_ram'];

//Lấy Chip gpu
$product_chip_gpu = $_POST['product_chip_gpu'];

//Lấy Chip set
$product_chip_set = $_POST['product_chip_set'];

//Lấy độ phân giải màn hình
$product_screen = $_POST['product_screen'];

//Lấy mô tả ngắn
$product_desc_short = $_POST['product_desc_short'];

//Lấy thông tin sản phẩm màu 1
//Màu 1
$color1 = $_POST['color1'];
//Mã màu 1
//$code_color1 = $_POST['code_color1'];
//Giá màu 1
$price_color1 = $_POST['price_color1'];
//Số lượng màu 1
$quantity_color1 = $_POST['quantity_color1'];
//Lấy ảnh được upload 1
$product_img_1 = $_FILES["fileToUpload_1"]["name"];

//Lấy thông tin sản phẩm màu 2
//Màu 2
$color2 = $_POST['color2'];
//Mã màu 2
//$code_color2 = $_POST['code_color2'];
//Giá màu 2
$price_color2 = $_POST['price_color2'];
//Số lượng màu 2
$quantity_color2 = $_POST['quantity_color2'];
//Lấy ảnh được upload 2
$product_img_2 = $_FILES["fileToUpload_2"]["name"];

//Lấy thông tin sản phẩm màu 3
//Màu 3
$color3 = $_POST['color3'];
//Mã màu 3
//$code_color3 = $_POST['code_color3'];
//Giá màu 3
$price_color3 = $_POST['price_color3'];
//Số lượng màu 3
$quantity_color3 = $_POST['quantity_color3'];
//Lấy ảnh được upload 3
$product_img_3 = $_FILES["fileToUpload_3"]["name"];

$sql = "SELECT * FROM product WHERE photo_name='$product_img_1'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Sản phẩm đã tồn tại, xin nhập lại thông tin");
            window.location.href="../Admin/add-product.php";
        </script>';
    return false;
}
$sql = "SELECT * FROM product WHERE photo_name='$product_img_2'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Sản phẩm đã tồn tại, xin nhập lại thông tin");
            window.location.href="../Admin/add-product.php";
        </script>';
    return false;
}
$sql = "SELECT * FROM product WHERE photo_name='$product_img_3'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Sản phẩm đã tồn tại, xin nhập lại thông tin");
            window.location.href="../Admin/add-product.php";
        </script>';
    return false;
}


$sql = "SELECT * FROM `description` WHERE photo_color1='$product_img_1'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Sản phẩm đã tồn tại, xin nhập lại thông tin");
            window.location.href="../Admin/add-product.php";
        </script>';
    return false;
}
$sql = "SELECT * FROM `description` WHERE photo_color2='$product_img_1'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Sản phẩm đã tồn tại, xin nhập lại thông tin");
            window.location.href="../Admin/add-product.php";
        </script>';
    return false;
}
$sql = "SELECT * FROM `description` WHERE photo_color3='$product_img_1'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Sản phẩm đã tồn tại, xin nhập lại thông tin");
            window.location.href="../Admin/add-product.php";
        </script>';
    return false;
}

$sql = "SELECT * FROM `description` WHERE photo_color1='$product_img_2'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Sản phẩm đã tồn tại, xin nhập lại thông tin");
            window.location.href="../Admin/add-product.php";
        </script>';
    return false;
}
$sql = "SELECT * FROM `description` WHERE photo_color2='$product_img_2'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Sản phẩm đã tồn tại, xin nhập lại thông tin");
            window.location.href="../Admin/add-product.php";
        </script>';
    return false;
}

$sql = "SELECT * FROM `description` WHERE photo_color3='$product_img_2'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Sản phẩm đã tồn tại, xin nhập lại thông tin");
            window.location.href="../Admin/add-product.php";
        </script>';
    return false;
}

$sql = "SELECT * FROM `description` WHERE photo_color1='$product_img_3'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Sản phẩm đã tồn tại, xin nhập lại thông tin");
            window.location.href="../Admin/add-product.php";
        </script>';
    return false;
}

$sql = "SELECT * FROM `description` WHERE photo_color2='$product_img_3'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Sản phẩm đã tồn tại, xin nhập lại thông tin");
            window.location.href="../Admin/add-product.php";
        </script>';
    return false;
}

$sql = "SELECT * FROM `description` WHERE photo_color3='$product_img_3'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Sản phẩm đã tồn tại, xin nhập lại thông tin");
            window.location.href="../Admin/add-product.php";
        </script>';
    return false;
}


//Last id của product_inventory
$last_id_inventory = 0;
$last_id_product = 0;
//Tên của ảnh 1
$name_color1 = '';
$name_color2 = '';
$name_color3 = '';

//Xử lý thêm sản phẩm
//Màu 1
if ($color1 != '') {
    //Insert vào table product_inventory 1
    $sqlIn = "INSERT INTO product_inventory(
            quantity_color1, color1,
            total_quantity_color1
        )
        VALUES(
        '$quantity_color1',
        '$color1',
        '$quantity_color1'
        )
        ";
    if ($conn->query($sqlIn) === TRUE) {
        $last_id_inventory = $conn->insert_id;
    } else {
        echo "Lổi khi insert vào product_inventory";
    }
    //Insert vào product 2
    //Upload ảnh 1 vào product


    $target_dir = "../public/product_images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload_1"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload_1"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload_1"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        //$name = $_FILES["fileToUpload"]["name"];
        // $arr = explode(".",$name);
        // $newfilename= "user".".".$arr[1];
        if (move_uploaded_file($_FILES["fileToUpload_1"]["tmp_name"], $target_file)) {
            //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            $name_color1 = $_FILES["fileToUpload_1"]["name"];
            $file = "../public/product_images/" . $name_color1;
            $newfile = "../public/product_images_desc/" . $name_color1;
            if (!copy($file, $newfile)) {
                echo "failed to copy $file";
            } else {
                //echo "copied $file into $newfile\n";
                $name_color1 = $_FILES["fileToUpload_1"]["name"];
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    //Lấy name category
    $sqlCate = "SELECT * FROM product_category WHERE id='$product_category'";
    $resultCate = $conn->query($sqlCate);
    if ($resultCate->num_rows > 0) {
        $rowCate = $resultCate->fetch_assoc();
        $cate_name = $rowCate['name'];
    }

    $sqlPr = "INSERT INTO product(
            `name`,
            photo_name,
            `desc`,
            category_id,
            inventory_id,
            price,
            discount_id,
            manufacturer
        )
        VALUES(
            '$product_name',
            '$name_color1',
            '$product_desc',
            '$product_category',
            '$last_id_inventory',
            '$price_color1',
            '$product_discount',
            '$cate_name'
        )
        ";

    if ($conn->query($sqlPr) === TRUE) {
        $last_id_product = $conn->insert_id;
    } else {
        echo "Lổi khi insert vào product";
    }

    //Insert vào descript
    //Upload ảnh 1 vào description
    //Bắt đầu insert vào description
    $sqlDesc = "INSERT INTO description(
            product_id,
            small_desc,
            dcolor1,
            rom,
            ram,
            chip_gpu,
            chip_set,
            sr,
            photo_color1,
            price_color1
        )
        VALUES(
            '$last_id_product',
            '$product_desc_short',
            '$color1',
            '$product_rom',
            '$product_ram',
            '$product_chip_gpu',
            '$product_chip_set',
            '$product_screen',
            '$name_color1',
            '$price_color1'
        )
        ";

    if ($conn->query($sqlDesc) === TRUE) {
        //echo "Success";
        //header("location: app-product-list");
    } else {
        echo "Error";
    }
}

//Màu 2
if ($color2 != '') {
    //echo "Màu 2";
    //Update product_inventory
    $sqluIn = "UPDATE product_inventory SET color2='$color2', 
        quantity_color2='$quantity_color2', 
        total_quantity_color2='$quantity_color2' WHERE id='$last_id_inventory'
        ";
    if ($conn->query($sqluIn) === TRUE) {
    } else {
        echo "Lổi trong update inventory màu 2";
    }

    //Upload ảnh desc màu 2

    $target_dir = "../public/product_images_desc/";
    $target_file = $target_dir . basename($_FILES["fileToUpload_2"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload_2"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload_2"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        //$name = $_FILES["fileToUpload"]["name"];
        // $arr = explode(".",$name);
        // $newfilename= "user".".".$arr[1];
        if (move_uploaded_file($_FILES["fileToUpload_2"]["tmp_name"], $target_file)) {
            //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            $name_color2 = $_FILES["fileToUpload_2"]["name"];
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    //Update trong description
    $sqluDesc = "UPDATE description SET dcolor2='$color2',
        photo_color2='$name_color2',
        price_color2='$price_color2'
        WHERE product_id='$last_id_product'
        ";
    if ($conn->query($sqluDesc) === TRUE) {
    } else {
        echo "Lổi trong update description màu 2";
    }
}

//Màu 3
if ($color3 != '') {
    //echo "Màu 3";
    //Update product_inventory
    $sqluIn = "UPDATE product_inventory SET color3='$color3', 
        quantity_color3='$quantity_color3', 
        total_quantity_color3='$quantity_color3' WHERE id='$last_id_inventory'
        ";
    if ($conn->query($sqluIn) === TRUE) {
    } else {
        echo "Lổi trong update inventory màu 3";
    }

    //Upload ảnh desc màu 3

    $target_dir = "../public/product_images_desc/";
    $target_file = $target_dir . basename($_FILES["fileToUpload_3"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload_3"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload_3"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        //$name = $_FILES["fileToUpload"]["name"];
        // $arr = explode(".",$name);
        // $newfilename= "user".".".$arr[1];
        if (move_uploaded_file($_FILES["fileToUpload_3"]["tmp_name"], $target_file)) {
            //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            $name_color3 = $_FILES["fileToUpload_3"]["name"];
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    //Update trong description
    $sqluDesc = "UPDATE description SET dcolor3='$color3',
        photo_color3='$name_color3',
        price_color3='$price_color3'
        WHERE product_id='$last_id_product'
        ";
    if ($conn->query($sqluDesc) === TRUE) {
    } else {
        echo "Lổi trong update description màu 3";
    }
}
//Đều hướng đến trang app-product-list
//header("location: app-product-list");
echo '<script>
            alert("Thêm sản phẩm thành công");
            window.location.href="../Admin/app-product-list.php";
        </script>';
ob_flush();
