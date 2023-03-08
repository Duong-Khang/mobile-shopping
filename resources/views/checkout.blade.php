<?php

if (Session::has('username')) {
    $token = session('username');
} else {
    $token = "guest";
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
  <!-- Page Title -->
  <title>Checkout</title>
  <!--Fevicon-->
  <link rel="icon" href="assets/img/icon/favicon.ico" type="image/x-icon" />
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- linear-icon -->
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/linear-icon.css">
  <!-- all css plugins css -->
  <link rel="stylesheet" href="assets/css/plugins.css">
  <!-- default style -->
  <link rel="stylesheet" href="assets/css/default.css">
  <!-- Main Style css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- responsive css -->
  <link rel="stylesheet" href="assets/css/responsive.css">
  <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
  <!-- Modernizer JS -->
  <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
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
  <div class="breadcrumb-area mb-60">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="breadcrumb-wrap">
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- breadcrumb area end -->

  <!-- Start of Checkout Wrapper -->
  <div class="checkout-wrapper pt-10 pb-70">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
          <main id="primary" class="site-main">
            <div class="user-actions-area">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <style>
                  .btn_input_code {
                    cursor: pointer;
                    border: 1px solid #fedc19;
                    background-color: #fedc19;
                    color: white;
                    padding: 0 10px;
                    font-weight: bold;
                  }
                  </style>
                  <div id="show_input_discount" class="">
                    <h3 style="font-size: 14px;
                                        font-weight: 400;margin-bottom: 30px;">
                      <i style="font-size: 20px;" class="fas fa-envelope"></i>
                      Có phiếu giảm giá? <span style="cursor: pointer"
                        id="show_coupon"><button class="btn btn-secondary">Nhập
                          mã</button></span></h3>
                    <div id="checkout_coupon" class="display-content">
                      <div class="coupon-info">
                        <form id="form_discount_code">
                          <div class="row">
                            <div class="col-12 col-sm-12 col-md-6">
                              <div class="input-group">
                                <input type="text" name="" value=""
                                  placeholder="Nhập mã" id="input_discount_code"
                                  class="form-control mr-3">
                                <input type="submit" value="Áp dụng"
                                  id="btn_discount_code"
                                  class="btn btn-secondary">
                              </div>
                            </div>
                          </div>
                        </form>
                        {{-- Xử lý nhập mã giảm giá --}}
                        <script>
                        $(document).ready(function() {
                          $("#form_discount_code").submit(function() {
                            return false;
                          });
                          //Lấy customer
                          var customer = $("#userLogin").val();
                          //Kiểm tra xem đã nhập mã giảm giá chưa sao đó hiển thị ra
                          $.ajax({
                            url: "{{route('kiem-tra-discount-code')}}",
                            type: "get",
                            dataType: "text",
                            data: {
                              customer: customer
                            },
                            success: function(testDiscountCode) {
                              if (testDiscountCode != 0) {
                                var code = testDiscountCode;
                                const numberFormat = new Intl
                                  .NumberFormat('vi-VN', {
                                    style: 'currency',
                                    currency: 'VND',
                                  });
                                code = Math.round(code);
                                code = numberFormat.format(code);
                                //Hiển thị giá trị của mã giảm giá
                                $("#row_total_all").append(
                                  '<tr class="order-total"><th>Mã giảm giá</th><td class="text-center"><strong>' +
                                  code + '</strong></td></tr>');
                              }
                            }
                          });

                          $("#btn_discount_code").click(function() {
                            //Lấy code
                            var value_code = $("#input_discount_code")
                              .val();
                            if (!value_code) {
                              alert("Chưa nhập mã giảm giá");
                              return false;
                            }
                            //Lấy customer
                            var customer = $("#userLogin").val();
                            //Gửi ajax
                            $.ajax({
                              url: "{{route('set-discount-code')}}",
                              type: "get",
                              dataType: "json",
                              data: {
                                value_code: value_code,
                                customer: customer
                              },
                              success: function(result) {
                                $.each(result, function(key,
                                item) {
                                  if (item['error'] !=
                                    'success') {
                                    alert(item['error']);
                                  } else {
                                    alert(
                                      "Thêm mã giảm giá thành công"
                                      );
                                    var code = item[
                                      'valueofcode'];
                                    const numberFormat =
                                      new Intl.NumberFormat(
                                        'vi-VN', {
                                          style: 'currency',
                                          currency: 'VND',
                                        });
                                    code = Math.round(code);
                                    code = numberFormat
                                      .format(code);
                                    //Hiển thị giá trị của mã giảm giá
                                    $("#row_total_all")
                                      .append(
                                        '<tr class="order-total"><th>Mã giảm giá</th><td class="text-center"><strong>' +
                                        code +
                                        '</strong></td></tr>'
                                        );

                                    //$("#show_input_discount").hide();
                                    $("#input_discount_code")
                                      .val('');
                                    //Cập nhật tổng
                                    var customer = $(
                                      "#userLogin").val();
                                    $.ajax({
                                      url: "ajax-jQuery/show-total-checkout.php",
                                      type: "get",
                                      dataType: "text",
                                      data: {
                                        customer: customer
                                      },
                                      success: function(
                                        result_) {
                                        $("#spend").val(
                                          result_);
                                        const
                                          numberFormat =
                                          new Intl
                                          .NumberFormat(
                                            'vi-VN', {
                                              style: 'currency',
                                              currency: 'VND',
                                            });
                                        result_ = Math
                                          .round(
                                            result_);
                                        result_ =
                                          numberFormat
                                          .format(
                                            result_);

                                        //$("#tam_tinh").html(result_);
                                        $("#tong_tien")
                                          .html(
                                          result_);
                                      }
                                    });
                                  }
                                });
                              }
                            });
                          });
                        });
                        </script>
                      </div>
                    </div>
                  </div> <!-- end of user-actions -->
                </div>
              </div> <!-- end of row -->
            </div> <!-- end of user-actions -->

            <div class="checkout-area">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-7">
                  <div class="checkout-form">
                    <div class="section-title left-aligned">
                      <h3>Chi tiết thanh toán</h3>
                    </div>

                    <form id="form_checkout">
                      <div class="form-row mb-3">
                        <div class="form-group col-12 col-sm-12 col-md-6">
                          <label for="first_name">Họ và tên <span
                              class="text-danger">*</span></label>
                          <input type="text" class="form-control"
                            id="fullname_checkout" required>
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-6">
                          <label for="last_name">Số điện thoại <span
                              class="text-danger">*</span></label>
                          <input type="text" class="form-control"
                            id="phone_checkout" required>
                        </div>
                      </div>
                      <div class="form-row mb-3">
                        <div class="form-group col-12 col-sm-12 col-md-6">
                          <label for="company_name">Email</label>
                          <input type="email" class="form-control"
                            id="email_checkout">
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-6">
                          <label for="email_address">Địa chỉ <span
                              class="text-danger">*</span></label>
                          <input type="text" class="form-control"
                            id="address_checkout" required>
                        </div>
                      </div>
                    </form>
                  </div> <!-- end of checkout-form -->
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-5">
                  <div class="order-summary">
                    <div class="section-title left-aligned">
                      <h3>Đơn hàng của bạn</h3>
                    </div>
                    {{-- Hiển thị cart ở đây --}}
                    <div id="showCartCheckout" class="product-container">
                    </div> <!-- end of product-container -->
                    {{-- Xử lý show cart checkout--}}
                    <script>
                    $(document).ready(function() {
                      var customer = $("#userLogin").val();
                      $.ajax({
                        url: "ajax-jQuery/show-cart-checkout.php",
                        type: "get",
                        dataType: "text",
                        data: {
                          customer: customer
                        },
                        success: function(result) {
                          $("#showCartCheckout").html(result);
                        }
                      });
                    });
                    </script>
                    <div class="order-review">
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <tbody id="row_total_all">
                            <tr class="cart-subtotal">
                              <th>Tạm tính</th>
                              <td class="text-center"><span
                                  id="tam_tinh"></span></td>
                            </tr>
                            <tr class="order-total">
                              <th>Tổng tiền</th>
                              <td class="text-center"><strong
                                  id="tong_tien"></strong></td>
                              <input type="hidden" id="spend" value="0">
                            </tr>
                          </tbody>
                          {{-- Xử lý tính tổng tiền --}}
                          <script>
                          $(document).ready(function() {
                            var customer = $("#userLogin").val();
                            $.ajax({
                              url: "ajax-jQuery/show-total-checkout.php",
                              type: "get",
                              dataType: "text",
                              data: {
                                customer: customer
                              },
                              success: function(result) {
                                $("#spend").val(result);
                                const numberFormat = new Intl
                                  .NumberFormat('vi-VN', {
                                    style: 'currency',
                                    currency: 'VND',
                                  });
                                result = Math.round(result);
                                result = numberFormat.format(result);

                                $("#tam_tinh").html(result);

                                $("#tong_tien").html(result);
                              }
                            });
                          });
                          </script>
                        </table>
                      </div>
                    </div>
                    <div class="form-row justify-content-end">
                      <input id="btn_checkout" type="submit"
                        class="btn btn-secondary dark" value="Mua hàng">
                    </div>
                  </div> <!-- end of order-summary -->
                </div>
              </div> <!-- end of row -->
            </div> <!-- end of checkout-area -->
          </main> <!-- end of #primary -->
        </div>
      </div> <!-- end of row -->
    </div> <!-- end of container -->
  </div>
  <!-- End of Checkout Wrapper -->

  <!-- scroll to top -->
  <div class="scroll-top not-visible">
    <i class="fas fa-angle-up"></i>
  </div> <!-- /End Scroll to Top -->

  <!-- footer area start -->
  @include('layout.footer');
  <!-- footer area end -->

  <!-- all js include here -->

  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/ajax-mail.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>
{{-- Xử lý khi nhấn nút mua hàng --}}
<script>
$(document).ready(function() {
  $("#form_checkout").submit(function() {
    return false;
  });
  $("#form_payment").submit(function() {
    return false;
  });
  $("#btn_checkout").click(function() {
    //Lấy user login
    var customer = $("#userLogin").val();
    //Lấy fullname
    var fullname = $("#fullname_checkout").val();
    if (fullname == '') {
      alert("Bạn chưa nhập họ và tên!");
      return false;
    }
    //Lấy phone
    var phone = $("#phone_checkout").val();
    if (phone == '') {
      alert("Bạn chưa nhập số điện thoại!");
      return false;
    }
    //Lấy email
    var email = $("#email_checkout").val();
    if (email == '') {
      alert("Bạn chưa nhập email!");
      return false;
    }
    //Lấy address
    var address = $("#address_checkout").val();
    if (address == '') {
      alert("Bạn chưa nhập địa chỉ!");
      return false;
    }
    //Lấy tổng tiền
    var total = $("#tong_tien").text();
    //Lấy spend
    var spend = $("#spend").val();
    // Gửi ajax
    $.ajax({
      url: "ajax-jQuery/process-checkout.php",
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
          //alert("Success");
          window.location.replace('/order-list');
        } else {
          alert("Thất bại");
        }
      }
    });
  });
});
</script>


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