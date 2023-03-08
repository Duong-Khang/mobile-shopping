<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Hiển thị trang chủ
Route::get('/', function(){
    return view('index');
})->name('/');

//Hiển thị form login
Route::get('dang-nhap', function(){
    return view('login');
})->name('dang-nhap');

//Hiển thị from register
Route::get('dang-ky', function(){
    return view('register');
})->name('dang-ky');

//Xử lý đăng nhập
Route::post('xu-ly-dang-nhap', 'App\Http\Controllers\ControllerAccount@login')->name('xu-ly-dang-nhap');

//Đăng xuất
Route::get('dang-xuat', 'App\Http\Controllers\ControllerAccount@logout')->name('dang-xuat');

//Xử lý đăng ký
Route::post('xu-ly-dang-ky', 'App\Http\Controllers\ControllerAccount@register')->name('xu-ly-dang-ky');

// Shop
Route::get('cua-hang', 'App\Http\Controllers\ControllerShop@index')->name('shop');

//product details
Route::get('chi-tiet-san-pham/{pid}', 'App\Http\Controllers\ControllerProductDetails@ProductDetails')
->name('chi-tiet-san-pham');

//Show cart
Route::get('gio-hang', function(){
    return view('cart');
})->name('gio-hang');
Route::get('show-cart', 'App\Http\Controllers\ControllerShowCart@showCart')->name('show-cart');

//Checkout
Route::get('checkout', function(){
    return view('checkout');
})->name('checkout');

//Hiển thị danh sách đơn hàng
Route::get('order-list', function(){
    return view('order-list');
})->name('order-list');

//Hiển thị chi tiết đơn hàng
Route::get('order-details', function(){
    return view('order-details');
})->name('order-details');

//Update quantity
Route::get('update-quantity', 'App\Http\Controllers\ControllerUpdateQuantity@updateQuantityCart')->name('update-quantity');

//login quick
Route::get('login-quick', 'App\Http\Controllers\ControllerAccount@loginQuick')->name('login-quick');
//signup quick
Route::get('register-quick', 'App\Http\Controllers\ControllerAccount@registerQuick')->name('register-quick');

//Search product auto
Route::get('search', 'App\Http\Controllers\ControllerSearch@searchAuto')->name('search');

//Search product bình thường
Route::get('tim-san-pham', 'App\Http\Controllers\ControllerSearch@searchResult')->name('tim-san-pham');
//Hiển thị tất cả sp của apple
Route::get('get-apple', 'App\Http\Controllers\ControllerFilterProduct@getApple')->name('get-apple');
//Loc theo gia
//Áp dụng
Route::get('ap-dung-gia', 'App\Http\Controllers\ControllerFilterProduct@getApdung')->name('ap-dung-gia');

//Lọc theo màu trắng
Route::get('set-white', 'App\Http\Controllers\ControllerFilterProduct@getWhite')->name('set-white');
//Loc theo màu xanh
Route::get('set-blue', 'App\Http\Controllers\ControllerFilterProduct@getBlue')->name('set-blue');
//Lọc theo màu đen
Route::get('set-black', 'App\Http\Controllers\ControllerFilterProduct@getBlack')->name('set-black');
//Lọc theo màu tím
Route::get('set-violet', 'App\Http\Controllers\ControllerFilterProduct@getViolet')->name('set-violet');
//Lọc theo màu bạc
Route::get('set-silver', 'App\Http\Controllers\ControllerFilterProduct@getSilver')->name('set-silver');
//Lọc theo màu xám
Route::get('set-gray', 'App\Http\Controllers\ControllerFilterProduct@getGray')->name('set-gray');

//Lọc theo ROM 32gb
Route::get('set-32gb', 'App\Http\Controllers\ControllerFilterProduct@getRom32gb')->name('set-32gb');
//Lọc theo ROM 64gb
Route::get('set-64gb', 'App\Http\Controllers\ControllerFilterProduct@getRom64gb')->name('set-64gb');
//Lọc theo ROM 128gb
Route::get('set-128gb', 'App\Http\Controllers\ControllerFilterProduct@getRom128gb')->name('set-128gb');
//Lọc theo ROM 256gb
Route::get('set-256gb', 'App\Http\Controllers\ControllerFilterProduct@getRom256gb')->name('set-256gb');

//Thay đổi màu tương ứng khi người dùng chọn
Route::get('set-color-desc-large', 'App\Http\Controllers\ControllerChangeColor@getColorDesc')->name('set-color-desc-large');
Route::get('set-color-desc-nav', 'App\Http\Controllers\ControllerChangeColor@getColorDescNav')->name('set-color-desc-nav');

//Cập nhật giá theo màu
route::get('set-price-desc-large', 'App\Http\Controllers\ControllerChangeColor@getPriceDesc')->name('set-price-desc-large');
route::get('set-price-desc-nav', 'App\Http\Controllers\ControllerChangeColor@getPriceDescNav')->name('set-price-desc-nav');

//Xử lý phần reviews
Route::get('set-reviews', 'App\Http\Controllers\ControllerFeedback@setReviews')->name('set-reviews');
//Kiểm tra xem user đã đánh giá sản phẩm chưa
Route::get('check-rating', 'App\Http\Controllers\ControllerFeedback@checkRating')->name('check-rating');
//Hiển thị reviews
Route::get('show-reviews', 'App\Http\Controllers\ControllerFeedback@showReviews')->name('show-reviews');
//Hiển thị tổng số nhận xét
Route::get('count-reviews', 'App\Http\Controllers\ControllerFeedback@countReviews')->name('count-reviews');
//Hiển thị trung bình số sao
Route::get('show-average-star', 'App\Http\Controllers\ControllerFeedback@showStar')->name('show-average-star');
//Trang chủ
//Hiển thị Sản phẩm của chúng tôi
Route::get('get-our-product', 'App\Http\Controllers\ControllerShop@showOurProduct')->name('get-our-product');

//Xử lý nhập mã giảm giá
Route::get('set-discount-code', 'App\Http\Controllers\ControllerDiscountCode@setDiscountCode')->name('set-discount-code');

//Temp product details
Route::get('product-details', function(){
    return view('product-details');
});

Route::get('cua-hang-temp', 'App\Http\Controllers\ControllerShop@productDetails')->name('cua-hang-temp');

//Xử lý Trong Product Details
//Kiểm tra xem sản phẩm đã bị xóa chưa
Route::get('kiem-tra-san-pham-co-bi-xoa', 'App\Http\Controllers\ControllerProductDetails@testProductDelete')->name('kiem-tra-san-pham-co-bi-xoa');
//Cập nhật giá ứng với màu đã chọn
Route::get('cap-nhap-gia-ung-voi-mau', 'App\Http\Controllers\ControllerProductDetails@updatePriceColor')->name('cap-nhap-gia-ung-voi-mau');

//Cập nhật ảnh lớn ứng với màu đã chọn
Route::get('cap-nhat-anh-lon-ung-voi-mau-chon', 'App\Http\Controllers\ControllerProductDetails@updateImagesBigColor')->name('cap-nhat-anh-lon-ung-voi-mau-chon');

//Cập nhật ảnh nhỏ ứng với màu đã chọn
Route::get('cap-nhat-anh-nho-ung-voi-mau-da-chon', 'App\Http\Controllers\ControllerProductDetails@updateImagesTinyColor')->name('cap-nhat-anh-nho-ung-voi-mau-da-chon');

//Thêm vào giỏ hàng
Route::get('them-vao-gio-hang', 'App\Http\Controllers\ControllerProductDetails@addToCart')->name('them-vao-gio-hang');

//Cập nhật số lượng trong biểu tượng cart
Route::get('cap-nhap-so-luong-tren-cart-icon', 'App\Http\Controllers\ControllerProductDetails@updateQuantityCartIcon')->name('cap-nhap-so-luong-tren-cart-icon');


//Xử lý trong cart
//Xóa sản phẩm
Route::get('xoa-san-pham', 'App\Http\Controllers\ControllerCart@removeProduct')->name('xoa-san-pham');

//Tăng số lượng
Route::get('cap-nhat-lai-so-luong-khi-tang', 'App\Http\Controllers\ControllerCart@incProduct')->name('cap-nhat-lai-so-luong-khi-tang');

//Giảm số lượng
Route::get('cap-nhat-lai-so-luong-khi-giam', 'App\Http\Controllers\ControllerCart@decProduct')->name('cap-nhat-lai-so-luong-khi-giam');

//Lấy số lượng
Route::get('lay-so-luong', 'App\Http\Controllers\ControllerCart@getQuantity')->name('lay-so-luong');

//Cập nhật tổng của từng item
Route::get('cap-nhat-tong-cua-tung-item', 'App\Http\Controllers\ControllerCart@updateTotalOfItem')->name('cap-nhat-tong-cua-tung-item');

//Cập nhật lại thành tiền
Route::get('thanh-tien', 'App\Http\Controllers\ControllerCart@updateTotal')->name('thanh-tien');

//Xử lý đổi mật khẩu
Route::get('my-account', function(){
    return view('my-account');
})->name('my-account');

Route::post('doi-mat-khau', 'App\Http\Controllers\ControllerAccount@changePassword')->name('doi-mat-khau');

//Kiểm tra xem người dùng có item trong cart chưa
Route::get('kiem-tra-mua-hang', 'App\Http\Controllers\ControllerCart@testCartEmpty')->name('kiem-tra-mua-hang');

//Kiểm tra xem có đơn hàng không

Route::get('kiem-tra-don-hang', 'App\Http\Controllers\ControllerCart@testOrderList')->name('kiem-tra-don-hang');

//Add customer
Route::get('add-customer', function(){
    return view('add-customer');
})->name('add-customer');

Route::post('them-khach-hang', 'App\Http\Controllers\ControllerAccount@addCustomer')->name('them-khach-hang');

//Edit customer
Route::get('edit-customer', function(){
    return view('edit-customer');
})->name('edit-customer');

Route::post('sua-tai-khoan-khach-hang', 'App\Http\Controllers\ControllerAccount@editCustomer')->name('sua-tai-khoan-khach-hang');

//Kiểm tra xem có nhập mã giảm giá chưa
Route::get('kiem-tra-discount-code', 'App\Http\Controllers\ControllerDiscountCode@testDiscountCode')->name('kiem-tra-discount-code');

//Cập nhật số lượng khi delay keyup
Route::get('cap-nhap-so-luong-delay-keyup', 'App\Http\Controllers\ControllerUpdateQuantity@updateQuantityKeyup')->name('cap-nhap-so-luong-delay-keyup');

//Danh mục apple
Route::get('apple', function(){
    return view('apple-temp');
})->name('apple');

//Show xiaomi
Route::get('xiaomi', function(){
    return view('xiaomi-temp');
})->name('xiaomi');
//Show Oppo
Route::get('oppo', function(){
    return view('oppo-temp');
})->name('oppo');
//Show samsung
Route::get('samsung', function(){
    return view('samsung-temp');
})->name('samsung');
//show vsmart
Route::get('vsmart', function(){
    return view('vsmart-temp');
})->name('vsmart');