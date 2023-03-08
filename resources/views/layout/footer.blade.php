<footer>
  <!-- news-letter area start -->
  <div class="newsletter-group">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="newsletter-box">
            <div class="newsletter-inner">
              <div class="newsletter-title">
                <h3>Đăng ký để nhận thông báo</h3>
                <p>Trở thành người đầu tiên nhận thông báo. Đăng ký ngay</p>
              </div>
              <div class="newsletter-box">
                <input type="email" id="mc-email" autocomplete="off"
                  class="email-box" placeholder="nhập email">
                <button class="newsletter-btn" type="submit" id="">Đăng ký
                  !</button>
              </div>
            </div>
            <div class="link-follow">
              <a href="https://www.facebook.com/"><i
                  class="fab fa-facebook"></i></a>
              <a href="https://plus.google.com/discover"><i
                  class="fab fa-google-plus"></i></a>
              <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
              <a href="https://www.youtube.com/"><i
                  class="fab fa-youtube"></i></a>
            </div>
          </div>
          <!-- mailchimp-alerts Start -->
          <div class="mailchimp-alerts">
            <div class="mailchimp-submitting"></div>
            <!-- mailchimp-submitting end -->
            <div class="mailchimp-success"></div><!-- mailchimp-success end -->
            <div class="mailchimp-error"></div><!-- mailchimp-error end -->
          </div><!-- mailchimp-alerts end -->
        </div>
      </div>
    </div>
  </div>
  <!-- news-letter area end -->
  <!-- footer top area start -->
  <div class="footer-top pt-50 pb-50">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="footer-single-widget">
            <div class="widget-title">
              <div class="footer-logo mb-30">
                <a href="{{route('/')}}">
                  <img src="assets/img/logo/logo-mobile-shop.png" alt="">
                </a>
              </div>
            </div>
          </div>
        </div> <!-- single widget end -->
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="footer-single-widget">
            <div class="widget-title">
              <h4>Về Shop</h4>
            </div>
            <div class="widget-body">
              <div class="footer-useful-link">
                <ul>
                  <li><a href="#">Giới Thiệu Về Shop</a></li>
                  <li><a href="#">Vận Chuyển</a></li>
                  <li><a href="#">Chính Sách Bảo Mật</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div> <!-- single widget end -->
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="footer-single-widget">
            <div class="widget-title">
              <h4>Thông Tin Liên Hệ</h4>
            </div>
            <div class="widget-body">
              <div class="footer-useful-link">
                <ul>
                  <li><span>Địa chỉ:</span> Tây Ninh</li>
                  <li><span>Email:</span> dev.khang283@gmail.com</li>
                  <li><span>Số điện thoại:</span> <strong>0967.633.119</strong>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- single widget end -->
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="widget-body">
            <!-- <p>We are a team of designers and developers that create high quality Magento, Prestashop, Opencart.</p> -->
            <div class="payment-method">
              <h4>Thanh toán</h4>
              <img src="assets/img/payment/payment.png" alt="">
            </div>
          </div>
          <!-- <div class="footer-single-widget">
                        <div class="widget-title">
                            <h4>Twitter Feed</h4>
                        </div>
                        <div class="widget-body">
                            <div class="twitter-article">
                                <div class="twitter-text">
                                    Check out "Alice - Multipurpose Responsive #Magento #Theme" on #Envato by <a href="#">@sinratos</a> #Themeforest <a href="#">https://t.co/DNdhAwzm88</a>
                                    <span class="tweet-time"><i class="fab fa-twitter"></i><a href="#">30 sep</a></span>
                                </div>
                            </div>
                        </div>
                    </div> -->
        </div>
        <!-- single widget end -->
      </div>
    </div>
  </div>
  <!-- footer top area end -->
  <!-- footer bottom area start -->
  <div class="footer-bottom">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="footer-bottom-content">
            <div class="footer-copyright">
              <p>
                &copy; <?php echo date("Y"); ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- footer bottom area end -->
</footer>

<?php
include './Admin/connect.php';
mysqli_set_charset($conn, 'utf8');
session_start(); //khởi tạo session
$guest_id = session_id();
$time = time();
$time_check = $time - 300; //Ấn định thời gian là 10 phút

$sql = "SELECT * FROM guest_online WHERE guest_id='$guest_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) { //Lần 2
    $sqlu = "UPDATE guest_online SET time_live='$time' WHERE guest_id='$guest_id'";
    $conn->query($sqlu);
} else { //Lần đầu
    $sqli = "INSERT INTO guest_online(guest_id, time_live)
        VALUES('$guest_id', '$time')";
    $conn->query($sqli);
}
$sqld = "DELETE FROM guest_online WHERE time_live < $time_check";
$conn->query($sqld);
?>

<!-- KIỂM TRA START DATE VÀ END DATE CỦA MÃ GIẢM GIÁ VÀ KHUYẾN MÃI Sau 5s-->
<script>
//Lấy ngày, tháng, năm của thời điểm hiện tại
var date = new Date();
var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();
//Kiểm tra code
setInterval(function() {
  $.ajax({
    url: "../Admin/Controller/ControllerCheckValidCode.php",
    type: "get",
    dataType: "json",
    data: {
      day: day,
      month: month,
      year: year
    },
    success: function(result) {
      for (let i = 0; i < result.length; i++) {
        //Kiểm tra ngày
        var dateCode = new Date(result[i]);
        var end_date = result[i];
        var check = dateCode - date;
        if (check <= 0) {
          //Hết hạn
          //Gửi ajax để cập nhật trạng thái
          $.ajax({
            url: "../Admin/Controller/ControllerUpdateStatusCodeTimeExpired.php",
            type: "get",
            dataType: "text",
            data: {
              end_date: end_date
            },
            success: function(resultUpdateStatus) {
              if (resultUpdateStatus == '1') {
                //console.log("Success");
              } else if (resultUpdateStatus == "0") {
                //console.log("Error");
              }
            }
          });
        }
      }
    }
  });
}, 5000);

//Discount
setInterval(function() {
  $.ajax({
    url: "../Admin/Controller/ControllerCheckValidDiscount.php",
    type: "get",
    dataType: "json",
    data: {
      day: day,
      month: month,
      year: year
    },
    success: function(result) {
      for (let i = 0; i < result.length; i++) {
        //Kiểm tra ngày
        var dateCode = new Date(result[i]);
        var end_date = result[i];
        var check = dateCode - date;
        if (check <= 0) {
          //Hết hạn
          //Gửi ajax để cập nhật trạng thái
          $.ajax({
            url: "../Admin/Controller/ControllerUpdateStatusDiscountTimeExpired.php",
            type: "get",
            dataType: "json",
            data: {
              end_date: end_date
            },
            success: function(resultUpdateStatus) {
              if (resultUpdateStatus == '1') {
                //console.log("Success");
              } else if (resultUpdateStatus == "0") {
                //console.log("Error");
              }
            }
          });
        }
      }
    }
  });
}, 5000);
</script>