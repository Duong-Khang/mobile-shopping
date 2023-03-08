<?php
include "./Admin/connect.php";
if (Session::has('username')) {
    $token = session('username');
} else {
    $token = "no login";
}

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://kit.fontawesome.com/a076d05399.js"
    crossorigin="anonymous"></script>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Page Title -->
  <title>Giỏ hàng</title>
  <!--Fevicon-->
  <link rel="icon" href="{{asset('assets/img/icon/favicon.ico')}}"
    type="image/x-icon" />
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
  <!-- linear-icon -->
  <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/linear-icon.css')}}">
  <!-- all css plugins css -->
  <link rel="stylesheet" href="{{asset('assets/css/plugins.css')}}">
  <!-- default style -->
  <link rel="stylesheet" href="{{asset('assets/css/default.css')}}">
  <!-- Main Style css -->
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <!-- responsive css -->
  <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
  <script src="{{asset('assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
  <!-- Modernizer JS -->
  <script src="{{asset('assets/js/vendor/modernizr-3.5.0.min.js')}}"></script>
</head>

<body>
  {{-- Lưu trữ user login --}}
  <input type="hidden" name="" id="userLogin" value="{{$token}}">

  <!-- header area start -->
  <header class="header-pos">
    <!-- Bắt đầu header top -->
    @include('layout.header-top')
    <!-- Kết thúc header top -->
    <!-- Bắt đầu header middle -->
    @include('layout.header-middle')
    <!-- Kết thúc header middle -->
    <!-- Bắt đầu header top menu -->
    @include('layout.header-top-menu')
    <!-- Kết thúc header top menu -->
  </header>
  <!-- header area end -->

  <!-- breadcrumb area start -->
  <div class="breadcrumb-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="breadcrumb-wrap">
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- breadcrumb area end -->

  <!-- Start cart Wrapper -->
  <div class="shopping-cart-wrapper pb-70">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
          <main id="primary" class="site-main">
            <div class="shopping-cart">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="section-title">
                    <h3>Giỏ hàng</h3>
                  </div>
                  <form action="#">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <td>Ảnh</td>
                            <td>Tên sản phẩm</td>
                            <td>Khuyến mãi</td>
                            <td>Màu</td>
                            <td>Số lượng</td>
                            <td>Giá</td>
                            <td>Tổng</td>
                            <td>Xóa</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                                                    $sqlGetItemCart = "SELECT product.*, cart_item.*, description.*,
                                                        product.id AS pid,
                                                        description.id AS did
                                                        FROM ((cart_item
                                                        INNER JOIN product ON cart_item.product_id = product.id)
                                                        INNER JOIN description ON description.product_id = cart_item.product_id)
                                                        WHERE cart_item.customer='$token'
                                                        ";
                                                    $resultGetItemCart = $conn->query($sqlGetItemCart);
                                                    if ($resultGetItemCart->num_rows > 0) {
                                                        while ($rowGetItemCart = $resultGetItemCart->fetch_assoc()) {
                                                    ?>
                          <tr id="row_<?php echo $rowGetItemCart['cartid'] ?>">
                            <td>
                              <a
                                href="product-details?pid=<?php echo $rowGetItemCart['pid'] ?>"><img
                                  style="border: none;"
                                  src="product_images_desc/<?php
                                                                                                                                                                                            //Lấy ảnh ứng với màu đã mua
                                                                                                                                                                                            if ($rowGetItemCart['dcolor1'] == $rowGetItemCart['color']) {
                                                                                                                                                                                                echo $rowGetItemCart['photo_color1'];
                                                                                                                                                                                            } else if ($rowGetItemCart['dcolor2'] == $rowGetItemCart['color']) {
                                                                                                                                                                                                echo $rowGetItemCart['photo_color2'];
                                                                                                                                                                                            } else if ($rowGetItemCart['dcolor3'] == $rowGetItemCart['color']) {
                                                                                                                                                                                                echo $rowGetItemCart['photo_color3'];
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>"
                                  alt="Cart Product Image"
                                  title="<?php echo $rowGetItemCart['name'] ?>"
                                  class="img-thumbnail"></a>
                            </td>
                            <td>
                              <span><?php echo $rowGetItemCart['name'] ?></span>
                            </td>
                            <td><?php
                                                                    //Lấy discount_percent
                                                                    $discount_id = $rowGetItemCart['discount_available'];
                                                                    $sqlGetDiscount = "SELECT * FROM discount WHERE id='$discount_id' AND active='1'";
                                                                    $resultGetDiscount = $conn->query($sqlGetDiscount);
                                                                    if ($resultGetDiscount->num_rows > 0) {
                                                                        $rowGetDiscount = $resultGetDiscount->fetch_assoc();
                                                                        echo $rowGetDiscount['discount_percent'] . '%';
                                                                    } else {
                                                                        echo '';
                                                                    }
                                                                    ?></td>
                            <td><?php echo $rowGetItemCart['color'] ?></td>
                            <td>
                              <div class="input-group btn-block">
                                <div
                                  id="msg_<?php echo $rowGetItemCart['cartid'] ?>"
                                  class="product-qtyy mr-3">
                                  <input style="border: 1px solid #dee2e6;"
                                    type="text"
                                    id="quantity_<?php echo $rowGetItemCart['cartid'] ?>"
                                    value="<?php echo $rowGetItemCart['quantity'] ?>">
                                  <span style="cursor: pointer"
                                    id="btn_dec_<?php echo $rowGetItemCart['cartid'] ?>"
                                    class="dec qtybtn">
                                    <i class="fas fa-minus"
                                      aria-hidden="true"></i>
                                  </span>
                                  <span style="cursor: pointer"
                                    id="btn_inc_<?php echo $rowGetItemCart['cartid'] ?>"
                                    class="inc qtybtn">
                                    <i class="fas fa-plus"
                                      aria-hidden="true"></i>
                                  </span>
                                  <p id="msgtext_<?php echo $rowGetItemCart['cartid'] ?>"
                                    style="font-size: 12px"></p>
                                </div>
                              </div>
                            </td>

                            <td>
                              <?php
                                                                    //Lấy discount_percent
                                                                    $discount_id = $rowGetItemCart['discount_available'];
                                                                    $sqlGetDiscount = "SELECT * FROM discount WHERE id='$discount_id' AND active='1'";
                                                                    $resultGetDiscount = $conn->query($sqlGetDiscount);
                                                                    if ($resultGetDiscount->num_rows > 0) {
                                                                        $rowGetDiscount = $resultGetDiscount->fetch_assoc();
                                                                        //Lấy giá theo màu

                                                                        if ($rowGetItemCart['dcolor1'] == $rowGetItemCart['color']) {
                                                                            $price = ($rowGetItemCart['price_color1'] * (100 - $rowGetDiscount['discount_percent'])) / 100;
                                                                            echo number_format($price);
                                                                        } else if ($rowGetItemCart['dcolor2'] == $rowGetItemCart['color']) {
                                                                            $price = ($rowGetItemCart['price_color2'] * (100 - $rowGetDiscount['discount_percent'])) / 100;
                                                                            echo number_format($price);
                                                                        } else if ($rowGetItemCart['dcolor3'] == $rowGetItemCart['color']) {
                                                                            $price = ($rowGetItemCart['price_color3'] * (100 - $rowGetDiscount['discount_percent'])) / 100;
                                                                            echo number_format($price);
                                                                        }
                                                                    } else {
                                                                        if ($rowGetItemCart['dcolor1'] == $rowGetItemCart['color']) {
                                                                            $price = $rowGetItemCart['price_color1'];
                                                                            echo number_format($price);
                                                                        } else if ($rowGetItemCart['dcolor2'] == $rowGetItemCart['color']) {
                                                                            $price = $rowGetItemCart['price_color2'];
                                                                            echo number_format($price);
                                                                        } else if ($rowGetItemCart['dcolor3'] == $rowGetItemCart['color']) {
                                                                            $price = $rowGetItemCart['price_color3'];
                                                                            echo number_format($price);
                                                                        }
                                                                    }
                                                                    ?>
                            </td>
                            <td
                              id="show_totalOfItem_<?php echo $rowGetItemCart['cartid'] ?>">
                              <?php

                                                                                                                                    //Lấy discount_percent
                                                                                                                                    $discount_id = $rowGetItemCart['discount_available'];
                                                                                                                                    $sqlGetDiscount = "SELECT * FROM discount WHERE id='$discount_id' AND active='1'";
                                                                                                                                    $resultGetDiscount = $conn->query($sqlGetDiscount);
                                                                                                                                    if ($resultGetDiscount->num_rows > 0) {
                                                                                                                                        $rowGetDiscount = $resultGetDiscount->fetch_assoc();
                                                                                                                                        //Lấy giá theo màu

                                                                                                                                        if ($rowGetItemCart['dcolor1'] == $rowGetItemCart['color']) {
                                                                                                                                            $price = ($rowGetItemCart['price_color1'] * (100 - $rowGetDiscount['discount_percent'])) / 100;
                                                                                                                                            echo number_format($price * $rowGetItemCart['quantity']);
                                                                                                                                        } else if ($rowGetItemCart['dcolor2'] == $rowGetItemCart['color']) {
                                                                                                                                            $price = ($rowGetItemCart['price_color2'] * (100 - $rowGetDiscount['discount_percent'])) / 100;
                                                                                                                                            echo number_format($price * $rowGetItemCart['quantity']);
                                                                                                                                        } else if ($rowGetItemCart['dcolor3'] == $rowGetItemCart['color']) {
                                                                                                                                            $price = ($rowGetItemCart['price_color3'] * (100 - $rowGetDiscount['discount_percent'])) / 100;
                                                                                                                                            echo number_format($price * $rowGetItemCart['quantity']);
                                                                                                                                        }
                                                                                                                                    } else {
                                                                                                                                        if ($rowGetItemCart['dcolor1'] == $rowGetItemCart['color']) {
                                                                                                                                            $price = $rowGetItemCart['price_color1'] * $rowGetItemCart['quantity'];
                                                                                                                                            echo number_format($price);
                                                                                                                                        } else if ($rowGetItemCart['dcolor2'] == $rowGetItemCart['color']) {
                                                                                                                                            $price = $rowGetItemCart['price_color2'] * $rowGetItemCart['quantity'];
                                                                                                                                            echo number_format($price);
                                                                                                                                        } else if ($rowGetItemCart['dcolor3'] == $rowGetItemCart['color']) {
                                                                                                                                            $price = $rowGetItemCart['price_color3'] * $rowGetItemCart['quantity'];
                                                                                                                                            echo number_format($price);
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                    ?>
                            </td>
                            <td>
                              <span class="input-group-btn">
                                <button
                                  id="btn_delete_product_<?php echo $rowGetItemCart['cartid'] ?>"
                                  style="border-radius: 5%;" type="button"
                                  class="btn btn-danger"><i
                                    class="fas fa-times-circle"></i></button>
                              </span>
                            </td>
                          </tr>
                          <input type="hidden"
                            id="pid_<?php echo $rowGetItemCart['cartid'] ?>"
                            value="<?php echo $rowGetItemCart['pid'] ?>">
                          <input type="hidden"
                            id="color_<?php echo $rowGetItemCart['cartid'] ?>"
                            value="<?php echo $rowGetItemCart['color'] ?>">
                          <script>
                          //Xử lý tăng, giảm, nhập số lượng mới, xóa item
                          $(document).ready(function() {
                            //Event delay keyup để nhập số lượng mới
                            var timeout = null;
                            $("#quantity_<?php echo $rowGetItemCart['cartid'] ?>")
                              .keyup(function() {
                                clearTimeout(timeout);
                                timeout = setTimeout(function() {
                                  // Lấy quantity
                                  var quantityKeyup = $(
                                    '#quantity_<?php echo $rowGetItemCart['cartid'] ?>'
                                  ).val();

                                  if (!quantityKeyup) {
                                    $("#msg_<?php echo $rowGetItemCart['cartid'] ?>")
                                      .css("border",
                                        "1px solid tomato");
                                    $("#msgtext_<?php echo $rowGetItemCart['cartid'] ?>")
                                      .text("Chưa nhập số lượng");
                                    return false;
                                  }
                                  if (quantityKeyup <= 0) {
                                    $("#msg_<?php echo $rowGetItemCart['cartid'] ?>")
                                      .css("border",
                                        "1px solid tomato");
                                    $("#msgtext_<?php echo $rowGetItemCart['cartid'] ?>")
                                      .text(
                                        "Không được nhỏ hơn không");
                                    return false;
                                  }
                                  if (Number.isInteger(
                                      quantityKeyup) == false) {
                                    quantityKeyup = Number(
                                      quantityKeyup);
                                    if (Number.isInteger(
                                        quantityKeyup) == false) {
                                      $("#msg_<?php echo $rowGetItemCart['cartid'] ?>")
                                        .css("border",
                                          "1px solid tomato");
                                      $("#msgtext_<?php echo $rowGetItemCart['cartid'] ?>")
                                        .text("Không hợp lệ");
                                      return false;
                                    }
                                  }
                                  $("#msg_<?php echo $rowGetItemCart['cartid'] ?>")
                                    .css("border",
                                      "1px solid #dee2e6");
                                  $("#msgtext_<?php echo $rowGetItemCart['cartid'] ?>")
                                    .text("");
                                  //Gửi ajax cập nhật lại

                                  //Lấy customer
                                  var customer = $("#userLogin")
                                    .val();
                                  //Lấy pid
                                  var pid = $(
                                    "#pid_<?php echo $rowGetItemCart['cartid'] ?>"
                                  ).val();
                                  //Lấy màu
                                  var color = $(
                                    "#color_<?php echo $rowGetItemCart['cartid'] ?>"
                                  ).val();
                                  //Setup ajax
                                  $.ajaxSetup({
                                    headers: {
                                      'X-CSRF-TOKEN': $(
                                        'meta[name="csrf-token"]'
                                      ).attr('content')
                                    }
                                  });

                                  $.ajax({
                                    url: "{{route('cap-nhap-so-luong-delay-keyup')}}",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                      customer: customer,
                                      pid: pid,
                                      color: color,
                                      quantity: quantityKeyup
                                    },
                                    success: function(
                                      resultUpdateKeyup) {
                                      if (resultUpdateKeyup !=
                                        "error1") {
                                        //Cập nhật lại tổng khi tăng, giảm, xóa, nhập số lượng mới
                                        //Lấy customer
                                        var customer = $(
                                          "#userLogin").val();
                                        //Lấy pid
                                        var pid = $(
                                          "#pid_<?php echo $rowGetItemCart['cartid'] ?>"
                                        ).val();
                                        //Lấy màu
                                        var color = $(
                                          "#color_<?php echo $rowGetItemCart['cartid'] ?>"
                                        ).val();
                                        $.ajaxSetup({
                                          headers: {
                                            'X-CSRF-TOKEN': $(
                                              'meta[name="csrf-token"]'
                                            ).attr(
                                              'content')
                                          }
                                        });
                                        $.ajax({
                                          url: "{{route('cap-nhat-tong-cua-tung-item')}}",
                                          type: "get",
                                          dataType: "text",
                                          data: {
                                            customer: customer,
                                            pid: pid,
                                            color: color
                                          },
                                          success: function(
                                            resultUpdateTotalOfItem
                                          ) {
                                            $("#show_totalOfItem_<?php echo $rowGetItemCart['cartid'] ?>")
                                              .text(
                                                resultUpdateTotalOfItem
                                              );
                                          }
                                        });

                                        //Gửi ajax để cập nhật lại thành tiền
                                        //Lấy customer
                                        var customer = $(
                                          "#userLogin").val();
                                        $.ajaxSetup({
                                          headers: {
                                            'X-CSRF-TOKEN': $(
                                              'meta[name="csrf-token"]'
                                            ).attr(
                                              'content')
                                          }
                                        });
                                        $.ajax({
                                          url: "{{route('thanh-tien')}}",
                                          type: "get",
                                          dataType: "text",
                                          data: {
                                            customer: customer
                                          },
                                          success: function(
                                            resultTotal) {
                                            $("#subTotal")
                                              .text(
                                                resultTotal
                                              );
                                            $("#total")
                                              .text(
                                                resultTotal
                                              );
                                          }
                                        });

                                      } else {
                                        alert(
                                          "Số lượng không đủ đáp ứng"
                                        );
                                      }
                                    }
                                  });
                                }, 1000);
                              });
                            //Xóa
                            $("#btn_delete_product_<?php echo $rowGetItemCart['cartid'] ?>")
                              .click(function() {
                                var answer = window.confirm(
                                  "Xóa sản phẩm này?");
                                if (answer) {
                                  //Xóa
                                  //alert("Xóa");
                                  //Lấy customer
                                  var customer = $("#userLogin").val();
                                  //Lấy pid
                                  var pid = $(
                                    "#pid_<?php echo $rowGetItemCart['cartid'] ?>"
                                  ).val();
                                  //Lấy màu
                                  var color = $(
                                    "#color_<?php echo $rowGetItemCart['cartid'] ?>"
                                  ).val();
                                  //Gửi ajax
                                  $.ajaxSetup({
                                    headers: {
                                      'X-CSRF-TOKEN': $(
                                          'meta[name="csrf-token"]')
                                        .attr('content')
                                    }
                                  });
                                  $.ajax({
                                    url: "{{route('xoa-san-pham')}}",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                      customer: customer,
                                      pid: pid,
                                      color: color
                                    },
                                    success: function(result) {
                                      if (result == "1") {
                                        $("#row_<?php echo $rowGetItemCart['cartid'] ?>")
                                          .remove();
                                        //Gửi ajax để cập nhật lại thành tiền
                                        //Lấy customer
                                        var customer = $(
                                          "#userLogin").val();
                                        $.ajaxSetup({
                                          headers: {
                                            'X-CSRF-TOKEN': $(
                                              'meta[name="csrf-token"]'
                                            ).attr(
                                              'content')
                                          }
                                        });
                                        $.ajax({
                                          url: "{{route('thanh-tien')}}",
                                          type: "get",
                                          dataType: "text",
                                          data: {
                                            customer: customer
                                          },
                                          success: function(
                                            resultTotal) {
                                            $("#subTotal")
                                              .text(
                                                resultTotal);
                                            $("#total").text(
                                              resultTotal);
                                          }
                                        });

                                        //Lấy customer
                                        var customer = $(
                                          "#userLogin").val();
                                        $.ajaxSetup({
                                          headers: {
                                            'X-CSRF-TOKEN': $(
                                              'meta[name="csrf-token"]'
                                            ).attr(
                                              'content')
                                          }
                                        });

                                        //Gửi ajax kiểm tra

                                        $.ajax({
                                          url: "{{route('kiem-tra-mua-hang')}}",
                                          type: "get",
                                          dataType: "text",
                                          data: {
                                            customer: customer
                                          },
                                          success: function(
                                            resultCheckCart) {
                                            if (
                                              resultCheckCart ==
                                              "empty") {
                                              alert(
                                                "Giỏ hàng trống, quay lại để mua hàng"
                                              );
                                              window.location
                                                .href = "/";
                                            } else if (
                                              resultCheckCart ==
                                              "put") {

                                            }
                                          }
                                        });

                                      } else if (result == "0") {
                                        alert("Xóa thất bại");
                                      }
                                    }
                                  });
                                } else {
                                  //Không xóa
                                  //alert("Không xóa");
                                }
                              });
                            //Tăng số lượng
                            $("#btn_inc_<?php echo $rowGetItemCart['cartid'] ?>")
                              .click(function() {
                                //Lấy customer
                                var customer = $("#userLogin").val();
                                //Lấy pid
                                var pid = $(
                                  "#pid_<?php echo $rowGetItemCart['cartid'] ?>"
                                ).val();
                                //Lấy màu
                                var color = $(
                                  "#color_<?php echo $rowGetItemCart['cartid'] ?>"
                                ).val();
                                //Lấy số lượng hiển thị kiểm tra xem có hợp lý không
                                var quantity = $(
                                  "#quantity_<?php echo $rowGetItemCart['cartid'] ?>"
                                ).val();
                                //Kiểm tra số lượng xem có hợp lệ không
                                if (!quantity) {
                                  alert("Chưa nhập số lượng");
                                  //Lấy số lượng
                                  $.ajax({
                                    url: "{{route('lay-so-luong')}}",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                      customer: customer,
                                      pid: pid,
                                      color: color
                                    },
                                    success: function(
                                      resultGetQuantity) {
                                      $("#quantity_<?php echo $rowGetItemCart['cartid'] ?>")
                                        .val(resultGetQuantity);
                                    }
                                  });
                                  return false;
                                } else if (quantity <= 0) {
                                  alert("Số lượng phải lớn hơn không");
                                  //Lấy số lượng
                                  $.ajax({
                                    url: "{{route('lay-so-luong')}}",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                      customer: customer,
                                      pid: pid,
                                      color: color
                                    },
                                    success: function(
                                      resultGetQuantity) {
                                      $("#quantity_<?php echo $rowGetItemCart['cartid'] ?>")
                                        .val(resultGetQuantity);
                                    }
                                  });
                                  return false;
                                } else if (Number.isInteger(quantity) ==
                                  false) {
                                  quantity = Number(quantity);
                                  if (Number.isInteger(quantity) ==
                                    false) {
                                    alert("Số lượng không hợp lệ");

                                    //Lấy số lượng
                                    $.ajax({
                                      url: "{{route('lay-so-luong')}}",
                                      type: "get",
                                      dataType: "text",
                                      data: {
                                        customer: customer,
                                        pid: pid,
                                        color: color
                                      },
                                      success: function(
                                        resultGetQuantity) {
                                        $("#quantity_<?php echo $rowGetItemCart['cartid'] ?>")
                                          .val(resultGetQuantity);
                                      }
                                    });
                                    return false;
                                  }
                                }

                                //Gửi ajax để cập nhật lại số lượng
                                $.ajax({
                                  url: "{{route('cap-nhat-lai-so-luong-khi-tang')}}",
                                  type: "get",
                                  dataType: "text",
                                  data: {
                                    customer: customer,
                                    pid: pid,
                                    color: color,
                                    quantity: quantity
                                  },
                                  success: function(
                                    resultUpdateQuantity) {
                                    if (resultUpdateQuantity ==
                                      "error1") {
                                      alert(
                                        "Số lượng không đủ đáp ứng"
                                      );
                                    } else if (
                                      resultUpdateQuantity ==
                                      "error2") {
                                      alert(
                                        "Tăng số lượng thất bại");
                                    } else {
                                      $("#quantity_<?php echo $rowGetItemCart['cartid'] ?>")
                                        .val(resultUpdateQuantity);

                                      //Cập nhật lại tổng khi tăng, giảm, xóa, nhập số lượng mới
                                      //Lấy customer
                                      var customer = $("#userLogin")
                                        .val();
                                      //Lấy pid
                                      var pid = $(
                                        "#pid_<?php echo $rowGetItemCart['cartid'] ?>"
                                      ).val();
                                      //Lấy màu
                                      var color = $(
                                        "#color_<?php echo $rowGetItemCart['cartid'] ?>"
                                      ).val();
                                      $.ajaxSetup({
                                        headers: {
                                          'X-CSRF-TOKEN': $(
                                            'meta[name="csrf-token"]'
                                          ).attr('content')
                                        }
                                      });
                                      $.ajax({
                                        url: "{{route('cap-nhat-tong-cua-tung-item')}}",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                          customer: customer,
                                          pid: pid,
                                          color: color
                                        },
                                        success: function(
                                          resultUpdateTotalOfItem
                                        ) {
                                          $("#show_totalOfItem_<?php echo $rowGetItemCart['cartid'] ?>")
                                            .text(
                                              resultUpdateTotalOfItem
                                            );
                                        }
                                      });

                                      //Gửi ajax để cập nhật lại thành tiền
                                      //Lấy customer
                                      var customer = $("#userLogin")
                                        .val();
                                      $.ajaxSetup({
                                        headers: {
                                          'X-CSRF-TOKEN': $(
                                            'meta[name="csrf-token"]'
                                          ).attr('content')
                                        }
                                      });
                                      $.ajax({
                                        url: "{{route('thanh-tien')}}",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                          customer: customer
                                        },
                                        success: function(
                                          resultTotal) {
                                          $("#subTotal").text(
                                            resultTotal);
                                          $("#total").text(
                                            resultTotal);
                                        }
                                      });

                                    }
                                  }
                                });
                              });


                            //Giảm số lượng
                            $("#btn_dec_<?php echo $rowGetItemCart['cartid'] ?>")
                              .click(function() {
                                //Lấy customer
                                var customer = $("#userLogin").val();
                                //Lấy pid
                                var pid = $(
                                  "#pid_<?php echo $rowGetItemCart['cartid'] ?>"
                                ).val();
                                //Lấy màu
                                var color = $(
                                  "#color_<?php echo $rowGetItemCart['cartid'] ?>"
                                ).val();
                                //Lấy số lượng
                                var quantity = $(
                                  "#quantity_<?php echo $rowGetItemCart['cartid'] ?>"
                                ).val();

                                //Kiểm tra số lượng xem có hợp lệ không
                                if (!quantity) {
                                  alert("Chưa nhập số lượng");
                                  //Lấy số lượng
                                  $.ajax({
                                    url: "{{route('lay-so-luong')}}",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                      customer: customer,
                                      pid: pid,
                                      color: color
                                    },
                                    success: function(
                                      resultGetQuantity) {
                                      $("#quantity_<?php echo $rowGetItemCart['cartid'] ?>")
                                        .val(resultGetQuantity);
                                    }
                                  });
                                  return false;
                                } else if (quantity <= 0) {
                                  alert("Số lượng phải lớn hơn không");
                                  //Lấy số lượng
                                  $.ajax({
                                    url: "{{route('lay-so-luong')}}",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                      customer: customer,
                                      pid: pid,
                                      color: color
                                    },
                                    success: function(
                                      resultGetQuantity) {
                                      $("#quantity_<?php echo $rowGetItemCart['cartid'] ?>")
                                        .val(resultGetQuantity);
                                    }
                                  });
                                  return false;
                                } else if (Number.isInteger(quantity) ==
                                  false) {
                                  quantity = Number(quantity);
                                  if (Number.isInteger(quantity) ==
                                    false) {
                                    alert("Số lượng không hợp lệ");

                                    //Lấy số lượng
                                    $.ajax({
                                      url: "{{route('lay-so-luong')}}",
                                      type: "get",
                                      dataType: "text",
                                      data: {
                                        customer: customer,
                                        pid: pid,
                                        color: color
                                      },
                                      success: function(
                                        resultGetQuantity) {
                                        $("#quantity_<?php echo $rowGetItemCart['cartid'] ?>")
                                          .val(resultGetQuantity);
                                      }
                                    });
                                    return false;
                                  }
                                }

                                //Gửi ajax để cập nhật lại số lượng khi giảm
                                $.ajax({
                                  url: "{{route('cap-nhat-lai-so-luong-khi-giam')}}",
                                  type: "get",
                                  dataType: "text",
                                  data: {
                                    customer: customer,
                                    pid: pid,
                                    color: color,
                                    quantity: quantity
                                  },
                                  success: function(
                                    resultUpdateQuantity) {
                                    if (resultUpdateQuantity ==
                                      "error1") {
                                      alert(
                                        "Số lượng không đủ đáp ứng"
                                      );
                                    } else if (
                                      resultUpdateQuantity ==
                                      "error2") {
                                      alert(
                                        "Tăng số lượng thất bại");
                                    } else if (
                                      resultUpdateQuantity ==
                                      "error3") {
                                      var answer = window.confirm(
                                        "Xóa sản phẩm này?");
                                      if (answer) {
                                        //Xóa
                                        //alert("Xóa");
                                        //Lấy customer
                                        var customer = $(
                                          "#userLogin").val();
                                        //Lấy pid
                                        var pid = $(
                                          "#pid_<?php echo $rowGetItemCart['cartid'] ?>"
                                        ).val();
                                        //Lấy màu
                                        var color = $(
                                          "#color_<?php echo $rowGetItemCart['cartid'] ?>"
                                        ).val();
                                        //Gửi ajax để xóa sản phẩm
                                        $.ajaxSetup({
                                          headers: {
                                            'X-CSRF-TOKEN': $(
                                              'meta[name="csrf-token"]'
                                            ).attr(
                                              'content')
                                          }
                                        });
                                        $.ajax({
                                          url: "{{route('xoa-san-pham')}}",
                                          type: "get",
                                          dataType: "text",
                                          data: {
                                            customer: customer,
                                            pid: pid,
                                            color: color
                                          },
                                          success: function(
                                            resultDelete) {
                                            if (
                                              resultDelete ==
                                              "1") {
                                              $("#row_<?php echo $rowGetItemCart['cartid'] ?>")
                                                .remove();

                                              //Gửi ajax để cập nhật lại thành tiền
                                              //Lấy customer
                                              var customer =
                                                $(
                                                  "#userLogin"
                                                  )
                                                .val();
                                              $.ajaxSetup({
                                                headers: {
                                                  'X-CSRF-TOKEN': $(
                                                      'meta[name="csrf-token"]'
                                                    )
                                                    .attr(
                                                      'content'
                                                    )
                                                }
                                              });
                                              $.ajax({
                                                url: "{{route('thanh-tien')}}",
                                                type: "get",
                                                dataType: "text",
                                                data: {
                                                  customer: customer
                                                },
                                                success: function(
                                                  resultTotal
                                                ) {
                                                  $("#subTotal")
                                                    .text(
                                                      resultTotal
                                                    );
                                                  $("#total")
                                                    .text(
                                                      resultTotal
                                                    );
                                                }
                                              });

                                              //Lấy customer
                                              var customer =
                                                $(
                                                  "#userLogin"
                                                  )
                                                .val();
                                              $.ajaxSetup({
                                                headers: {
                                                  'X-CSRF-TOKEN': $(
                                                      'meta[name="csrf-token"]'
                                                    )
                                                    .attr(
                                                      'content'
                                                    )
                                                }
                                              });

                                              //Gửi ajax kiểm tra

                                              $.ajax({
                                                url: "{{route('kiem-tra-mua-hang')}}",
                                                type: "get",
                                                dataType: "text",
                                                data: {
                                                  customer: customer
                                                },
                                                success: function(
                                                  resultCheckCart
                                                ) {
                                                  if (
                                                    resultCheckCart ==
                                                    "empty"
                                                  ) {
                                                    alert
                                                      (
                                                        "Giỏ hàng trống, quay lại để mua hàng"
                                                        );
                                                    window
                                                      .location
                                                      .href =
                                                      "/";
                                                  } else if (
                                                    resultCheckCart ==
                                                    "put"
                                                  ) {

                                                  }
                                                }
                                              });


                                            } else if (
                                              resultDelete ==
                                              "0") {
                                              alert(
                                                "Xóa thất bại"
                                              );
                                            }
                                          }
                                        });
                                      } else {
                                        //Không xóa
                                        return false;
                                      }
                                    } else {
                                      $("#quantity_<?php echo $rowGetItemCart['cartid'] ?>")
                                        .val(resultUpdateQuantity);

                                      //Cập nhật lại tổng khi tăng, giảm, xóa, nhập số lượng mới
                                      //Lấy customer
                                      var customer = $("#userLogin")
                                        .val();
                                      //Lấy pid
                                      var pid = $(
                                        "#pid_<?php echo $rowGetItemCart['cartid'] ?>"
                                      ).val();
                                      //Lấy màu
                                      var color = $(
                                        "#color_<?php echo $rowGetItemCart['cartid'] ?>"
                                      ).val();
                                      $.ajaxSetup({
                                        headers: {
                                          'X-CSRF-TOKEN': $(
                                            'meta[name="csrf-token"]'
                                          ).attr('content')
                                        }
                                      });
                                      $.ajax({
                                        url: "{{route('cap-nhat-tong-cua-tung-item')}}",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                          customer: customer,
                                          pid: pid,
                                          color: color
                                        },
                                        success: function(
                                          resultUpdateTotalOfItem
                                        ) {
                                          $("#show_totalOfItem_<?php echo $rowGetItemCart['cartid'] ?>")
                                            .text(
                                              resultUpdateTotalOfItem
                                            );
                                        }
                                      });

                                      //Gửi ajax để cập nhật lại thành tiền
                                      //Lấy customer
                                      var customer = $("#userLogin")
                                        .val();
                                      $.ajaxSetup({
                                        headers: {
                                          'X-CSRF-TOKEN': $(
                                            'meta[name="csrf-token"]'
                                          ).attr('content')
                                        }
                                      });
                                      $.ajax({
                                        url: "{{route('thanh-tien')}}",
                                        type: "get",
                                        dataType: "text",
                                        data: {
                                          customer: customer
                                        },
                                        success: function(
                                          resultTotal) {
                                          $("#subTotal").text(
                                            resultTotal);
                                          $("#total").text(
                                            resultTotal);
                                        }
                                      });

                                    }
                                  }
                                });
                              });
                          });
                          </script>
                          <?php
                                                        }
                                                    }
                                                    ?>
                        </tbody>
                      </table>
                    </div>
                  </form>

                  <div class="cart-amount-wrapper">
                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-4 offset-md-8">
                        <table class="table table-bordered">
                          <tbody>
                            <?php

                                                        $total = 0;

                                                        $sqlGetItemCart = "SELECT product.*, cart_item.*, description.*,
                                                            product.id AS pid,
                                                            description.id AS did
                                                            FROM ((cart_item
                                                            INNER JOIN product ON cart_item.product_id = product.id)
                                                            INNER JOIN description ON description.product_id = cart_item.product_id)
                                                            WHERE cart_item.customer='$token'
                                                            ";
                                                        $resultGetItemCart = $conn->query($sqlGetItemCart);
                                                        if ($resultGetItemCart->num_rows > 0) {
                                                            while ($rowGetItemCart = $resultGetItemCart->fetch_assoc()) {
                                                                //Lấy discount_percent
                                                                $discount_id = $rowGetItemCart['discount_available'];
                                                                $sqlGetDiscount = "SELECT * FROM discount WHERE id='$discount_id' AND active='1'";
                                                                $resultGetDiscount = $conn->query($sqlGetDiscount);
                                                                if ($resultGetDiscount->num_rows > 0) {
                                                                    $rowGetDiscount = $resultGetDiscount->fetch_assoc();
                                                                    //Lấy giá theo màu

                                                                    if ($rowGetItemCart['dcolor1'] == $rowGetItemCart['color']) {
                                                                        $price = (($rowGetItemCart['price_color1'] * (100 - $rowGetDiscount['discount_percent'])) / 100) * $rowGetItemCart['quantity'];
                                                                        $total += $price;
                                                                    } else if ($rowGetItemCart['dcolor2'] == $rowGetItemCart['color']) {
                                                                        $price = (($rowGetItemCart['price_color2'] * (100 - $rowGetDiscount['discount_percent'])) / 100) * $rowGetItemCart['quantity'];
                                                                        $total += $price;
                                                                    } else if ($rowGetItemCart['dcolor3'] == $rowGetItemCart['color']) {
                                                                        $price = (($rowGetItemCart['price_color3'] * (100 - $rowGetDiscount['discount_percent'])) / 100) * $rowGetItemCart['quantity'];
                                                                        $total += $price;
                                                                    }
                                                                } else {
                                                                    if ($rowGetItemCart['dcolor1'] == $rowGetItemCart['color']) {
                                                                        $price = $rowGetItemCart['price_color1'] * $rowGetItemCart['quantity'];
                                                                        $total += $price;
                                                                    } else if ($rowGetItemCart['dcolor2'] == $rowGetItemCart['color']) {
                                                                        $price = $rowGetItemCart['price_color2'] * $rowGetItemCart['quantity'];
                                                                        $total += $price;
                                                                    } else if ($rowGetItemCart['dcolor3'] == $rowGetItemCart['color']) {
                                                                        $price = $rowGetItemCart['price_color3'] * $rowGetItemCart['quantity'];
                                                                        $total += $price;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                            <tr>
                              <td><strong>Tạm tính:</strong></td>
                              <td id="subTotal">
                                <?php echo number_format($total); ?> đ</td>
                            </tr>
                            <tr>
                              <td><strong>Tổng cộng:</strong></td>
                              <td><span id="total"
                                  class="color-primary"><?php echo number_format($total); ?>
                                  đ</span></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div
                    class="cart-button-wrapper d-flex justify-content-between mt-4">
                    <a href="{{route('shop')}}" class="btn btn-secondary">Tiếp
                      tục mua sắm</a>
                    <a href="{{route('checkout')}}"
                      class="btn btn-secondary dark align-self-end">Checkout</a>
                  </div>
                </div>
              </div>
            </div> <!-- end of shopping-cart -->
          </main> <!-- end of #primary -->
        </div>
      </div> <!-- end of row -->
    </div> <!-- end of container -->
  </div>
  <!-- End cart Wrapper -->

  <!-- scroll to top -->
  <div class="scroll-top not-visible">
    <i class="fas fa-angle-up"></i>
  </div> <!-- /End Scroll to Top -->

  <!-- footer area start -->
  @include('layout.footer')
  <!-- footer area end -->


  <!-- all js include here -->
  <script src="{{asset('assets/js/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins.js')}}"></script>
  <script src="{{asset('assets/js/ajax-mail.js')}}"></script>
  <script src="{{asset('assets/js/main.js')}}"></script>
</body>

<!-- Mirrored from template.hasthemes.com/sinrato/sinrato/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Sep 2021 00:25:25 GMT -->

</html>

{{-- Xử lý kiểm tra xem giỏ hàng có item không --}}

<script>
$(document).ready(function() {

  //Lấy customer
  var customer = $("#userLogin").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  //Gửi ajax kiểm tra

  $.ajax({
    url: "{{route('kiem-tra-mua-hang')}}",
    type: "get",
    dataType: "text",
    data: {
      customer: customer
    },
    success: function(resultCheckCart) {
      if (resultCheckCart == "empty") {
        alert("Giỏ hàng trống, quay lại để mua hàng");
        window.location.href = "/";
      } else if (resultCheckCart == "put") {

      }
    }
  });

})
</script>