<div class="header-middle">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-lg-2 col-md-4 col-sm-4 col-12">
        <div class="logo">
          <a href="{{route('/')}}"><img
              src="{{asset('assets/img/logo/logo-mobile-shop.png')}}"
              alt="brand-logo"></a>
        </div>
      </div>
      <div class="col-lg-8 col-md-12 col-12 order-sm-last">
        <div class="header-middle-inner">
          <form method="GET" action="{{route('tim-san-pham')}}">
            {{-- @csrf --}}
            <div class="top-cat hm1">
              <div class="search-form">
                <select style="display: none;" name="filter_product"
                  id="fproduct">
                  <optgroup label="Electronics">
                    <option value="all">Tất cả</option>
                    <option value="Apple">Apple</option>
                    <option value="Samsung">Samsung</option>
                    <option value="Oppo">Oppo</option>
                    <option value="Xiaomi">Xiaomi</option>
                    <option value="VSmart">VSmart</option>
                  </optgroup>
                </select>
              </div>
            </div>
            <input name="keyword_search" type="text" id="search_auto"
              class="top-cat-field" placeholder="Tìm kiếm sản phẩm">
            <input style="padding: 0 0" id="btn_search_product" type="submit"
              class="top-search-btn" value="Tìm kiếm">
          </form>
          {{-- Hiển thị search auto ở đây --}}
          <div style="position: absolute; width: 80%">
            <ul id="show_result_search_auto"
              style="position: relative; z-index: 1000; box-shadow: 0 3px 5px rgb(0 0 0 / 50%);">
            </ul>
          </div>
          {{-- Xử lý search autocomplet --}}
          <script>
          $(document).ready(function() {

            // Khai báo đối tượng timeout để dùng cho hàm
            // clearTimeout
            var timeout = null;

            // Sự kiện keyup
            $('#search_auto').keyup(function() {
              var keyword = $("#search_auto").val();
              var filter = $("#fproduct").val();

              // Xóa đi những gì ta đã thiết lập ở sự kiện 
              // keyup của ký tự trước (nếu có)
              clearTimeout(timeout);
              // Sau khi xóa thì thiết lập lại timeout
              timeout = setTimeout(function() {
                $.ajax({
                  url: "{{route('search')}}",
                  type: "get",
                  dataType: "text",
                  data: {
                    keyword: keyword,
                    filter: filter
                  },
                  success: function(result) {
                    $("#show_result_search_auto").html(
                    result);
                  }
                });
              }, 1000);
            });

            //Xử lý search bình thường
            $("#btn_search_product").click(function() {
              var keyword = $("#search_auto").val();
              if (keyword == '') {
                alert("Bạn chưa nhập từ khóa tìm kiếm");
                return false;
              }
            });
          });
          </script>
        </div>
      </div>

      <div class="col-lg-2 col-md-8 col-12 col-sm-8 order-lg-last">
        <div class="mini-cart-option">
          <ul>
            <li id="cartMoveHover" class="my-cart">
              <a href="{{route('gio-hang')}}" class="ha-toggle"
                style="cursor: pointer;"><span class="lnr lnr-cart"></span><span
                  id="quantity_cart_hover" class="count">0</span>Giỏ hàng</a>
              <ul id="cartHover" class="mini-cart-drop-down ha-dropdown">
                <li style="margin: 0 0; padding: 0 0;" class="mb-30">
                  <div style="padding: 0 0; margin: 0 0" class="cart-info">
                    <p id="msg_success" style="color: black"></p>
                  </div>
                </li>
                <li style="margin: 0 0; padding: 0 0;" id="show_info_cart"
                  class="mt-30">
                  <a style="padding: 0 0; margin: 0 0" class="cart-button"
                    href="{{route('gio-hang')}}">Xem giỏ hàng và thanh toán</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $("#cartHover").mouseleave(function() {
    $("#cartHover").css("display", "none");
  });
  var customer = $("#userLogin").val();
  $.ajax({
    url: "{{route('update-quantity')}}",
    type: "get",
    dataType: "text",
    data: {
      customer: customer
    },
    success: function(result_quantity) {
      $("#quantity_cart_hover").html(result_quantity);
    }
  });

  $("#cartMoveHover").click(function() {
    $("#cartHover").css("display", "none");
  });
});
</script>