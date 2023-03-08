<?php
ob_start();
session_start();
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">

<head>
  <meta charSet="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="format-detection" content="telephone=no" />
  <title>Thêm đơn hàng</title><!-- icon -->
  <link rel="icon" type="image/png" href="images/favicon.png" /><!-- fonts -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" />
  <!-- css -->
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.ltr.css" />
  <link rel="stylesheet" href="vendor/highlight.js/styles/github.css" />
  <link rel="stylesheet" href="vendor/simplebar/simplebar.min.css" />
  <link rel="stylesheet" href="vendor/quill/quill.snow.css" />
  <link rel="stylesheet" href="vendor/air-datepicker/css/datepicker.min.css" />
  <link rel="stylesheet" href="vendor/select2/css/select2.min.css" />
  <link rel="stylesheet"
    href="vendor/datatables/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css" />
  <link rel="stylesheet" href="vendor/fullcalendar/main.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <script async=""
    src="https://www.googletagmanager.com/gtag/js?id=UA-97489509-8"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"
    crossorigin="anonymous"></script>
  <script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'UA-97489509-8');
  </script>
</head>

<body>
  <!-- sa-app -->
  <div
    class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
    <!-- sa-app__sidebar -->
    <?php include "layout/sidebar-left.php" ?>
    <!-- sa-app__content -->
    <div class="sa-app__content">
      <!-- sa-app__toolbar -->
      <?php include "layout/app-tool-bar.php" ?>
      <!-- sa-app__body -->
      <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
          <div class="container container--max--xl">
            <div class="py-5">
              <div class="row g-4 align-items-center">
                <div class="col">
                  <nav class="mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sa-simple">
                      <li class="breadcrumb-item"><a href="../Admin/">Trang
                          chủ</a></li>
                      <li class=""><a href="../Admin/app-order-list.php"> / Danh
                          sách đơn hàng</a></li>
                      <li class="" aria-current="page"> / Thêm đơn hàng</li>
                    </ol>
                  </nav>
                </div>

              </div>
            </div>
            <div class=""></div>
            <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
              <div class="sa-layout">
                <div class="sa-layout__backdrop"
                  data-sa-layout-sidebar-close=""></div>
                <?php include "layout/sa-layout-slide-bar-product-list.php" ?>
                <div class="sa-layout__content">
                  <div class="">
                    <div class=""><label for="form-settings/weight-unit"
                        class="form-label">Chọn khách hàng</label>
                      <select id="customer_name" class="form-select">
                        <!-- Hiển thị danh sách khách hàng  -->
                        <?php
                                                $sqlCustomer = "SELECT * FROM user WHERE delete_at IS NULL";
                                                $resultCustomer = $conn->query($sqlCustomer);
                                                if ($resultCustomer->num_rows > 0) {
                                                    while ($rowCustomer = $resultCustomer->fetch_assoc()) {
                                                ?>
                        <option
                          id="option_<?php echo $rowCustomer['username'] ?>"
                          value="<?php echo $rowCustomer['username'] ?>">Khách
                          hàng: <?php echo $rowCustomer['username'] ?></option>
                        <script>
                        //Xử lý khi chọn user sẽ load lại cart
                        $(document).ready(function() {
                          $("#customer_name").click(function() {
                            var customer = $("#customer_name").val();
                            //Gửi ajax
                            $.ajax({
                              url: "Controller/ControllerShowCart.php",
                              type: "get",
                              dataType: "text",
                              data: {
                                customer: customer
                              },
                              success: function(result) {
                                $("#show_cart").html(result);

                                var customer = $("#customer_name")
                                  .val();
                                //Gửi ajax
                                $.ajax({
                                  url: "Controller/ControllerShowSubTotal.php",
                                  type: "get",
                                  dataType: "text",
                                  data: {
                                    customer: customer
                                  },
                                  success: function(
                                    resultSubTotal) {
                                    $("#spend").val(
                                      resultSubTotal);
                                    const numberFormat =
                                      new Intl.NumberFormat(
                                        'vi-VN', {
                                          style: 'currency',
                                          currency: 'VND',
                                        });
                                    resultSubTotal = Math
                                      .round(
                                      resultSubTotal);
                                    resultSubTotal =
                                      numberFormat.format(
                                        resultSubTotal);
                                    $("#show_TamTinh").html(
                                      resultSubTotal);
                                    $("#show_TongCong")
                                      .html(resultSubTotal);
                                  }
                                });
                              }
                            });
                          });
                        });
                        </script>
                        <?php
                                                    }
                                                }
                                                ?>
                      </select>
                    </div>
                    <script>
                    $(document).ready(function() {
                      $("#btn_addOrder").click(function() {
                        //Lấy customer
                        var customer = $("#customer_name").val();
                        //Lấy spend
                        var spend = $("#spend").val();
                        //Lấy Tổng tiền định dạng js
                        var total = $("#show_TongCong").text();
                        //Lấy fullname
                        var fullname = $("#fullname").val();
                        //Lấy phone
                        var phone = $("#phone").val();
                        //Lấy email
                        var email = $("#email").val();
                        //Lấy address
                        var address = $("#address").val();
                        //Kiểm tra
                        if (fullname == '') {
                          alert("Bạn chưa nhập họ và tên!");
                          return false;
                        }
                        if (phone == '') {
                          alert("Bạn chưa nhập số điện thoại!");
                          return false;
                        }
                        if (email == '') {
                          alert("Bạn chưa nhập email!");
                          return false;
                        }
                        if (address == '') {
                          alert("Bạn chưa nhập địa chỉ!");
                          return false;
                        }
                        //Gửi ajax
                        $.ajax({
                          url: "Controller/ControllerAddOrderFinish.php",
                          type: "get",
                          dataType: "text",
                          data: {
                            customer: customer,
                            fullname: fullname,
                            phone: phone,
                            email: email,
                            address: address,
                            total: total,
                            spend: spend
                          },
                          success: function(result) {
                            if (result !== "error") {
                              //Chuyển hướng đến trang danh sách đơn hàng
                              alert("Thêm thành công");
                              window.location.replace(
                                'http://localhost:8080/ThucTapTwo/Admin/app-order-list'
                                );
                            } else {
                              alert("Thất bại");
                            }
                          }
                        });
                      });

                    });
                    </script>
                  </div>
                  <br>
                  <div class="card">
                    <div class="p-4">
                      <div class="row g-4">
                        <div class="col-auto sa-layout__filters-button"><button
                            class="btn btn-sa-muted btn-sa-icon fs-exact-16"
                            data-sa-layout-sidebar-open=""><svg
                              xmlns="http://www.w3.org/2000/svg" width="1em"
                              height="1em" viewBox="0 0 16 16"
                              fill="currentColor">
                              <path
                                d="M7,14v-2h9v2H7z M14,7h2v2h-2V7z M12.5,6C12.8,6,13,6.2,13,6.5v3c0,0.3-0.2,0.5-0.5,0.5h-2 C10.2,10,10,9.8,10,9.5v-3C10,6.2,10.2,6,10.5,6H12.5z M7,2h9v2H7V2z M5.5,5h-2C3.2,5,3,4.8,3,4.5v-3C3,1.2,3.2,1,3.5,1h2 C5.8,1,6,1.2,6,1.5v3C6,4.8,5.8,5,5.5,5z M0,2h2v2H0V2z M9,9H0V7h9V9z M2,14H0v-2h2V14z M3.5,11h2C5.8,11,6,11.2,6,11.5v3 C6,14.8,5.8,15,5.5,15h-2C3.2,15,3,14.8,3,14.5v-3C3,11.2,3.2,11,3.5,11z">
                              </path>
                            </svg></button></div>
                        <div class="col"><input type="text"
                            placeholder="Tìm sản phẩm"
                            class="form-control form-control--search mx-auto"
                            id="table-search" />
                        </div>
                      </div>
                    </div>
                    <div class="sa-divider"></div>
                    <!-- sa-datatables-init -->
                    <table class="sa-datatables-init"
                      data-order="[[ 1, &quot;asc&quot; ]]"
                      data-sa-search-input="#table-search">
                      <thead>
                        <tr>
                          <th class="w-min" data-orderable="false"><input
                              type="checkbox"
                              class="form-check-input m-0 fs-exact-16 d-block"
                              aria-label="..." />
                          </th>
                          <th class="min-w-20x">Sản phẩm</th>
                          <th>Khuyến mãi</th>
                          <th>Màu</th>
                          <th>Danh mục</th>
                          <th>Kho dự trữ</th>
                          <th>Giá</th>

                          <th class="w-min" data-orderable="false"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Hiển thị danh sách sản phẩm ở đây -->
                        <?php
                                                $sql = "SELECT product.*, product_category.id AS cid, product_category.delete_at_category,
                                            description.color1, 
                                            description.color2, description.color3,
                                            description.dcolor1, description.dcolor2,
                                            description.dcolor3,
                                            description.product_id,
                                            description.rom,
                                            description.ram,
                                            description.chip_gpu,
                                            description.chip_set,
                                            description.sr,
                                            description.small_desc,
                                            description.photo_color1,
                                            description.photo_color2,
                                            description.photo_color3,
                                            description.price_color1,
                                            description.price_color2,
                                            description.price_color3,
                                            description.delete_at_desc
                                            FROM ((product
                                            INNER JOIN description ON product.id=description.product_id)
                                            INNER JOIN product_category ON product.category_id=product_category.id)
                                            WHERE product.delete_at IS NULL AND product_category.delete_at_category IS NULL
                                            ";

                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                        <tr>
                          <td><input type="checkbox"
                              class="form-check-input m-0 fs-exact-16 d-block"
                              aria-label="..." /></td>
                          <td>
                            <div class="d-flex align-items-center"><a
                                href="app-product.html" class="me-4">
                                <div id="show_img_<?php echo $row['id'] ?>"
                                  class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                  <img
                                    src="../public/product_images/<?php echo $row['photo_name'] ?>"
                                    width="40" height="40" alt="" />
                                </div>
                              </a>
                              <div><a href="#"
                                  class="text-reset"><?php echo $row['name'] ?></a>
                                <div class="sa-meta mt-0">
                                  <ul class="sa-meta__list">
                                    <li class="sa-meta__item">ID: <span
                                        title="Click to copy product ID"
                                        class="st-copy"><?php echo $row['id'] ?></span>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <?php
                                                                //Lấy % khuyến mãi
                                                                $discount_id = $row['discount_id'];
                                                                $sqlDiscount = "SELECT * FROM discount WHERE id='$discount_id' AND active='1' AND delete_at IS NULL";
                                                                $resultDiscount = $conn->query($sqlDiscount);
                                                                if ($resultDiscount->num_rows > 0) {
                                                                    $rowDiscount = $resultDiscount->fetch_assoc();
                                                                    echo $rowDiscount['discount_percent'] . '%';
                                                                }
                                                                ?>
                          </td>

                          <td>
                            <?php
                                                                //Xử lý hiển thị màu
                                                                $pid = $row['id'];
                                                                $sqlColor = "SELECT * FROM description WHERE product_id='$pid'";
                                                                $resultColor = $conn->query($sqlColor);
                                                                if ($resultColor->num_rows > 0) {
                                                                    while ($rowColor = $resultColor->fetch_assoc()) {
                                                                        // if($rowColor['dcolor1'] != NULL){
                                                                        //     echo '<button id="btn_color_1_'.$pid.'" onclick="showAll(1, '.$pid.')" style="border: none; padding: 10px; background-color: '.$rowColor['color1'].'; margin: 2px; border: 1px solid violet;"></button>
                                                                        //     <input type="hidden" id="color_1_'.$pid.'" value="'.$rowColor['dcolor1'].'">
                                                                        //     ';
                                                                        // }
                                                                        // if($rowColor['dcolor2'] != NULL){
                                                                        //     echo '<button id="btn_color_2_'.$pid.'" onclick="showAll(2, '.$pid.')" style="border: none; padding: 10px; background-color: '.$rowColor['color2'].'; margin: 2px; border: 1px solid #def2d0;"></button>
                                                                        //     <input type="hidden" id="color_2_'.$pid.'" value="'.$rowColor['dcolor2'].'">
                                                                        //     ';
                                                                        // }
                                                                        // if($rowColor['dcolor3'] != NULL){
                                                                        //     echo '<button id="btn_color_3_'.$pid.'" onclick="showAll(3, '.$pid.')" style="border: none; padding: 10px; background-color: '.$rowColor['color3'].'; margin: 2px; border: 1px solid #def2d0;"></button>
                                                                        //     <input type="hidden" id="color_3_'.$pid.'" value="'.$rowColor['dcolor3'].'">
                                                                        //     ';
                                                                        // }

                                                                        if ($rowColor['dcolor1'] != NULL) {
                                                                            echo '<a style="cursor: pointer;" id="btn_color_1_' . $pid . '" onclick="showAll(1, ' . $pid . ')"><img id="_btn_color_1_' . $pid . '" style="height: 30px; width: 30px; margin-bottom: 3px; border: 1px solid violet;" src="../public/product_images_desc/' . $rowColor["photo_color1"] . '" alt=""></a>
                                                                <input type="hidden" id="color_1_' . $pid . '" value="' . $rowColor['dcolor1'] . '">
                                                                ';
                                                                        }

                                                                        if ($rowColor['dcolor2'] != NULL) {
                                                                            echo '<a style="cursor: pointer;" id="btn_color_2_' . $pid . '" onclick="showAll(2, ' . $pid . ')"><img id="_btn_color_2_' . $pid . '" style="height: 30px; width: 30px; margin-bottom: 3px; border: 1px solid #def2d0;" src="../public/product_images_desc/' . $rowColor["photo_color2"] . '" alt=""></a>
                                                                <input type="hidden" id="color_2_' . $pid . '" value="' . $rowColor['dcolor2'] . '">
                                                                ';
                                                                        }

                                                                        if ($rowColor['dcolor3'] != NULL) {
                                                                            echo '<a style="cursor: pointer;" id="btn_color_3_' . $pid . '" onclick="showAll(3, ' . $pid . ')"><img id="_btn_color_3_' . $pid . '" style="height: 30px; width: 30px; margin-bottom: 3px; border: 1px solid #def2d0;" src="../public/product_images_desc/' . $rowColor["photo_color3"] . '" alt=""></a>
                                                                <input type="hidden" id="color_3_' . $pid . '" value="' . $rowColor['dcolor3'] . '">
                                                                ';
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                          </td>

                          <script>
                          var colorClick = 1;

                          //Xử lý khi nhấn vào màu nào thì sẽ hiển thị ảnh, giá, kho tương ứng
                          function showAll(color, pid) {
                            colorClick = color;
                            //Chọn màu 1
                            if (color == 1) {
                              $('#_btn_color_1_' + pid + '').css("border",
                                "1px solid violet");
                              $('#_btn_color_2_' + pid + '').css("border",
                                "1px solid #def2d0");
                              $('#_btn_color_3_' + pid + '').css("border",
                                "1px solid #def2d0");
                              // var price = $('#price_'+pid+'').text();
                              // $('#price_'+pid+'').text(color);
                              // alert(price)
                              //Gửi ajax
                              $.ajax({
                                url: "Controller/ControllerShowChooseCollorProduct.php",
                                type: "get",
                                dataType: "json",
                                data: {
                                  pid: pid,
                                  color: color
                                },
                                success: function(result) {
                                  $.each(result, function(key, item) {
                                    $('#price_' + pid + '').text(item[
                                      'price']);
                                    $('#show_img_' + pid + '').html(
                                      item['img']);
                                    $('#show_stock_' + pid + '').html(
                                      item['stock']);
                                  });
                                }
                              });
                            }
                            //Chọn màu 1
                            if (color == 2) {
                              colorClick = color;
                              $('#_btn_color_2_' + pid + '').css("border",
                                "1px solid violet");
                              $('#_btn_color_1_' + pid + '').css("border",
                                "1px solid #def2d0");
                              $('#_btn_color_3_' + pid + '').css("border",
                                "1px solid #def2d0");
                              //Gửi ajax
                              $.ajax({
                                url: "Controller/ControllerShowChooseCollorProduct.php",
                                type: "get",
                                dataType: "json",
                                data: {
                                  pid: pid,
                                  color: color
                                },
                                success: function(result) {
                                  $.each(result, function(key, item) {
                                    $('#price_' + pid + '').text(item[
                                      'price']);
                                    $('#show_img_' + pid + '').html(
                                      item['img']);
                                    $('#show_stock_' + pid + '').html(
                                      item['stock']);
                                  });
                                }
                              });
                            }
                            //Chọn màu 1
                            if (color == 3) {
                              colorClick = color;
                              $('#_btn_color_3_' + pid + '').css("border",
                                "1px solid violet");
                              $('#_btn_color_2_' + pid + '').css("border",
                                "1px solid #def2d0");
                              $('#_btn_color_1_' + pid + '').css("border",
                                "1px solid #def2d0");
                              //Gửi ajax
                              $.ajax({
                                url: "Controller/ControllerShowChooseCollorProduct.php",
                                type: "get",
                                dataType: "json",
                                data: {
                                  pid: pid,
                                  color: color
                                },
                                success: function(result) {
                                  $.each(result, function(key, item) {
                                    $('#price_' + pid + '').text(item[
                                      'price']);
                                    $('#show_img_' + pid + '').html(
                                      item['img']);
                                    $('#show_stock_' + pid + '').html(
                                      item['stock']);
                                  });
                                }
                              });
                            }
                          }
                          </script>
                          <td><a href="#"
                              class="text-reset"><?php echo $row['manufacturer'] ?></a>
                          </td>
                          <td id="show_stock_<?php echo $row['id'] ?>">
                            <?php
                                                                $inventory_id = $row['inventory_id'];
                                                                $sqlInventory = "SELECT * FROM product_inventory WHERE id='$inventory_id'";
                                                                $resultInventory = $conn->query($sqlInventory);
                                                                if ($resultInventory->num_rows > 0) {
                                                                    $rowInventory = $resultInventory->fetch_assoc();
                                                                    if ($rowInventory['quantity_color1'] > 0) {
                                                                        echo '<div class="badge badge-sa-success">' . $rowInventory['quantity_color1'] . ' sản phẩm</div>';
                                                                    } else {
                                                                        echo '<div class="badge badge-sa-danger">Hết hàng</div>';
                                                                    }
                                                                }
                                                                ?>
                          </td>
                          <td>
                            <div class="sa-price">
                              <span id="price_<?php echo $row['id'] ?>"
                                class="sa-price__integer">
                                <?php
                                                                        $discount_id = $row['discount_id'];
                                                                        $sqlDiscount = "SELECT * FROM discount WHERE id='$discount_id' AND active='1' AND delete_at IS NULL";
                                                                        $resultDiscount = $conn->query($sqlDiscount);
                                                                        if ($resultDiscount->num_rows > 0) {
                                                                            $rowDiscount = $resultDiscount->fetch_assoc();
                                                                            echo number_format(($row['price_color1'] * (100 - $rowDiscount['discount_percent'])) / 100);
                                                                        } else {
                                                                            echo number_format($row['price_color1']);
                                                                        }

                                                                        ?>
                              </span>
                            </div>
                          </td>


                          <td>
                            <div class="col-auto d-flex"><a
                                style="cursor: pointer;"
                                onclick="addToCart(<?php echo $row['id'] ?>)"
                                class="btn btn-primary">Thêm</a></div>
                          </td>
                          <script>
                          function addToCart(pid) {

                            var color = '';

                            //Lấy customer
                            var customer = $("#customer_name").val();

                            //Lấy color
                            if (colorClick == 1) {
                              color = $('#color_1_' + pid + '').val();
                            } else if (colorClick == 2) {
                              color = $('#color_2_' + pid + '').val();
                            } else if (colorClick == 3) {
                              color = $('#color_3_' + pid + '').val();
                            }

                            //Gửi ajax
                            $.ajax({
                              url: "Controller/ControllerAddToCart.php",
                              type: "get",
                              dataType: "text",
                              data: {
                                customer: customer,
                                pid: pid,
                                color: color
                              },
                              success: function(result) {
                                alert(result);
                                //Xử lý hiển thị số lượng trong kho ứng vs màu đã chọn
                                //Gửi ajax
                                $.ajax({
                                  url: "Controller/ControllerShowStock.php",
                                  type: "get",
                                  dataType: "text",
                                  data: {
                                    pid: pid,
                                    color: color
                                  },
                                  success: function(resultStock) {

                                    $('#show_stock_' + pid + '')
                                      .html(resultStock);

                                  }
                                });
                                //Lấy customer
                                var customer = $("#customer_name").val();
                                //Gửi ajax
                                $.ajax({
                                  url: "Controller/ControllerShowCart.php",
                                  type: "get",
                                  dataType: "text",
                                  data: {
                                    customer: customer
                                  },
                                  success: function(resultShowCart) {
                                    $("#show_cart").html(
                                      resultShowCart);
                                  }
                                });

                                var customer = $("#customer_name").val();
                                //Gửi ajax
                                $.ajax({
                                  url: "Controller/ControllerShowSubTotal.php",
                                  type: "get",
                                  dataType: "text",
                                  data: {
                                    customer: customer
                                  },
                                  success: function(resultSubTotal) {
                                    $("#spend").val(resultSubTotal);
                                    const numberFormat = new Intl
                                      .NumberFormat('vi-VN', {
                                        style: 'currency',
                                        currency: 'VND',
                                      });
                                    resultSubTotal = Math.round(
                                      resultSubTotal);
                                    resultSubTotal = numberFormat
                                      .format(resultSubTotal);
                                    $("#show_TamTinh").html(
                                      resultSubTotal);
                                    $("#show_TongCong").html(
                                      resultSubTotal);
                                  }
                                });
                              }
                            });

                          }
                          </script>
                        </tr>
                        <?php
                                                    }
                                                }
                                                ?>

                      </tbody>
                    </table>
                  </div>
                  <div class="card">
                    <div
                      class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                      <h2 class="mb-0 fs-exact-18 me-4">Danh sách sản phẩm đã
                        thêm</h2>
                      <!-- <div class="text-muted fs-exact-14"><a href="#">Edit items</a></div> -->
                    </div>
                    <div class="table-responsive">
                      <table class="sa-table">
                        <!-- Hiển thị danh sách sản phẩm đã thêm -->
                        <tbody id="show_cart">



                        </tbody>
                        <script>
                        $(document).ready(function() {
                          //Lấy customer
                          var customer = $("#customer_name").val();
                          //Gửi ajax
                          $.ajax({
                            url: "Controller/ControllerShowCart.php",
                            type: "get",
                            dataType: "text",
                            data: {
                              customer: customer
                            },
                            success: function(result) {
                              $("#show_cart").html(result);
                            }
                          });
                          //Hiển thị tạm tính và tổng cộng
                          var customer = $("#customer_name").val();
                          //Gửi ajax
                          $.ajax({
                            url: "Controller/ControllerShowSubTotal.php",
                            type: "get",
                            dataType: "text",
                            data: {
                              customer: customer
                            },
                            success: function(resultSubTotal) {
                              $("#spend").val(resultSubTotal);
                              const numberFormat = new Intl
                                .NumberFormat('vi-VN', {
                                  style: 'currency',
                                  currency: 'VND',
                                });
                              resultSubTotal = Math.round(
                                resultSubTotal);
                              resultSubTotal = numberFormat.format(
                                resultSubTotal);
                              $("#show_TamTinh").html(resultSubTotal);
                              $("#show_TongCong").html(
                              resultSubTotal);
                            }
                          });
                        });
                        </script>
                        <tbody class="sa-table__group">
                          <tr>
                            <td colSpan="3">Tạm tính</td>
                            <td class="text-end">
                              <div class="sa-price"><span
                                  class="sa-price__symbol"></span><span
                                  id="show_TamTinh"
                                  class="sa-price__integer">0</span><span
                                  class="sa-price__decimal"></span></div>
                            </td>
                          </tr>

                        </tbody>
                        <tbody>
                          <tr>
                            <td colSpan="3">Tổng cộng</td>
                            <td class="text-end">
                              <div class="sa-price"><span
                                  class="sa-price__symbol"></span><span
                                  id="show_TongCong"
                                  class="sa-price__integer">0</span><span
                                  class="sa-price__decimal"></span></div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>


                </div>

              </div>
              <div class="card">
                <div class="card-body p-5">
                  <div class="mb-5">
                    <h2 class="mb-0 fs-exact-18">Nhập mã giảm giá(nếu có)</h2>
                  </div>
                  <div class="mb-4"><label for="form-category/name"
                      class="form-label">Mã giảm giá</label><input
                      id="discount_code" type="text" class="form-control" />
                  </div>
                  <div class="col-auto d-flex"><a style="cursor: pointer;"
                      id="btn_discount_code" class="btn btn-primary">Áp dụng</a>
                  </div>
                  <script>
                  $(document).ready(function() {
                    //Xử lý nhập mã giảm giá
                    $("#btn_discount_code").click(function() {
                      //Lấy mã giảm giá
                      var discount_code = $("#discount_code").val();
                      if (!discount_code) {
                        alert("Chưa nhập mã giảm giá");
                        return false;
                      }
                      //Gửi ajax
                      var customer = $("#customer_name").val();
                      $.ajax({
                        url: "Controller/ControllerSetDiscountCode.php",
                        type: "get",
                        dataType: "text",
                        data: {
                          discount_code: discount_code,
                          customer: customer
                        },
                        success: function(result) {
                          if (result !== "Success") {
                            alert(result);
                            $("#discount_code").val('');
                          } else {
                            alert("Thêm mã giảm giá thành công");
                            $("#discount_code").val('');
                            //Cập nhật lại tổng tiền
                            //Hiển thị tạm tính và tổng cộng
                            var customer = $("#customer_name")
                              .val();
                            //Gửi ajax
                            $.ajax({
                              url: "Controller/ControllerShowSubTotal.php",
                              type: "get",
                              dataType: "text",
                              data: {
                                customer: customer
                              },
                              success: function(
                                resultSubTotal) {
                                $("#spend").val(
                                  resultSubTotal);
                                const numberFormat =
                                  new Intl.NumberFormat(
                                    'vi-VN', {
                                      style: 'currency',
                                      currency: 'VND',
                                    });
                                resultSubTotal = Math.round(
                                  resultSubTotal);
                                resultSubTotal =
                                  numberFormat.format(
                                    resultSubTotal);
                                $("#show_TamTinh").html(
                                  resultSubTotal);
                                $("#show_TongCong").html(
                                  resultSubTotal);
                              }
                            });
                          }
                        }
                      });
                    });
                  });
                  </script>
                </div>
                <input type="hidden" id="spend" value="0">

                <div class="card-body p-5">
                  <div class="mb-5">
                    <h2 class="mb-0 fs-exact-18">Nhập thông tin khách hàng</h2>
                  </div>
                  <div class="mb-4"><label for="form-category/name"
                      class="form-label">Họ và tên</label><input id="fullname"
                      type="text" class="form-control" />
                  </div>
                  <div class="mb-4"><label for="form-category/name"
                      class="form-label">SĐT</label><input id="phone"
                      type="text" class="form-control" />
                  </div>

                  <div class="mb-4"><label for=""
                      class="form-label">Email</label><input type="text"
                      id="email" class="form-control"></input>
                  </div>
                  <div class="mb-4"><label for="" class="form-label">Địa
                      chỉ</label><input type="text" id="address"
                      class="form-control"></input>
                  </div>
                </div>
              </div>
              <div style="margin-top: 20px;" class="col-auto d-flex"><a
                  style="cursor: pointer;" id="btn_addOrder"
                  class="btn btn-primary">Hoàn tất</a>
              </div>
            </div>

          </div>

        </div>

      </div><!-- sa-app__body / end -->
      <!-- sa-app__footer -->
      <?php include "layout/footer.php" ?>
    </div><!-- sa-app__content / end -->
    <!-- sa-app__toasts -->
    <div class="sa-app__toasts toast-container bottom-0 end-0"></div>
    <!-- sa-app__toasts / end -->
  </div><!-- sa-app / end -->
  <!-- scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/feather-icons/feather.min.js"></script>
  <script src="vendor/simplebar/simplebar.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/highlight.js/highlight.pack.js"></script>
  <script src="vendor/quill/quill.min.js"></script>
  <script src="vendor/air-datepicker/js/datepicker.min.js"></script>
  <script src="vendor/air-datepicker/js/i18n/datepicker.en.js"></script>
  <script src="vendor/select2/js/select2.min.js"></script>
  <script src="vendor/fontawesome/js/all.min.js" data-auto-replace-svg=""
    async=""></script>
  <script src="vendor/chart.js/chart.min.js"></script>
  <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/js/dataTables.bootstrap5.min.js"></script>
  <script src="vendor/nouislider/nouislider.min.js"></script>
  <script src="vendor/fullcalendar/main.min.js"></script>
  <script src="js/stroyka.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/calendar.js"></script>
  <script src="js/demo.js"></script>
  <script src="js/demo-chart-js.js"></script>
</body>

</html>
<?php
ob_flush();
?>