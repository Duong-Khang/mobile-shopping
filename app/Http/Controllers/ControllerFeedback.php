<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ModelUser;
use App\Models\ModelFeedback;
use App\Models\ModelReply;
use App\Models\ModelRating;

class ControllerFeedback extends Controller
{
    //Hiển thị trung bình star
    public function showStar(Request $request){
        $pid = $request->pid;

        $avg = ModelRating::where('product_id', $pid)->avg('star');
        //<i style="color: yellow;" class="far fa-star-half-alt"></i>
        if($avg == 1){
            echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i class="far fa-star"></i></span>
            <span><i class="far fa-star"></i></span>
            <span><i class="far fa-star"></i></span>
            <span><i class="far fa-star"></i></span>';
        }else if($avg > 1 && $avg < 2){
            echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
            <i style="color: yellow;" class="fas fa-star-half-alt"></i>
            <span><i class="far fa-star"></i></span>
            <span><i class="far fa-star"></i></span>
            <span><i class="far fa-star"></i></span>';
        }else if($avg == 2){
            echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i class="far fa-star"></i></span>
            <span><i class="far fa-star"></i></span>
            <span><i class="far fa-star"></i></span>';
        }else if($avg > 2 && $avg < 3){
            echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <i style="color: yellow;" class="fas fa-star-half-alt"></i>   
            <span><i class="far fa-star"></i></span>
            <span><i class="far fa-star"></i></span>';
        }else if($avg == 3){
            echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i class="far fa-star"></i></span>
            <span><i class="far fa-star"></i></span>';
        }else if($avg > 3 && $avg < 4){
            echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <i style="color: yellow;" class="fas fa-star-half-alt"></i>   
            <span><i class="far fa-star"></i></span>';
        }else if($avg == 4){
            echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i class="far fa-star"></i></span>';
        }else if($avg > 4 && $avg < 5){
            echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <i style="color: yellow;" class="fas fa-star-half-alt"></i>';
        }else if($avg == 5){
            echo '<span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>
            <span><i style="color: yellow;" class="far fa-star"></i></span>';
        }
        
        //echo $avg;
    }

    //Đếm tổng số nhận xét
    public function countReviews(Request $request){
        $pid = $request->pid;

        $sql = ModelFeedback::where('product_id', $pid)->count();

        $sqlr = ModelReply::where('product_id', $pid)->count();

        echo $sqlr + $sql;
    }

    //insert reviews
    public function setReviews(Request $request){
        $user = $request->user;
        $pid = $request->pid;
        $content = $request->content;
        $rating = $request->rating;

        //Kiểm tra xem user đã đánh giá sản phẩm chưa
        $checkUser = ModelFeedback::where([['product_id', $pid], ['reviewer', $user]])->get();
        $ratingExists = 0;
        if(count($checkUser) > 0){
            foreach ($checkUser as $rvalue) {
                $ratingExists = $rvalue['rating'];
            }
        }else{
            $ratingExists = $rating;
        }
        //Kiểm tra xem trong table rating đã có user này rate chưa
        $checkRating = ModelRating::where([['product_id', $pid], ['reviewer', $user]])->get();
        if(count($checkRating) > 0){

        }else{
            DB::table('rating')->insert([
                'product_id' => $pid,
                'reviewer' => $user,
                'star' => $ratingExists
            ]);
        }
        //Lấy userid
        $getUserID = ModelUser::where('username', $user)->get();
        $user_id = 0;
        foreach ($getUserID as $value) {
            $user_id = $value['id'];
        } 

        //Lấy thời gian reviews
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $time = date("h:ia");
        $date = date("d/m/Y");
        //insert
        $query = DB::table('feedback')->insert([
            'product_id' => $pid,
            'reviewer' => $user,
            'user_id' => $user_id,
            'rating' => $ratingExists,
            'content' => $content,
            'time_reviews' => $time,
            'date_reviews' => $date
        ]);

        if($query){
            echo "success";
        }else{
            echo "Thất bại";
        }
    }
    //Kiểm tra xem user đã đánh giá sản phẩm đó chưa
    public function checkRating(Request $request){
        $user = $request->user;
        $pid = $request->pid;

        $check = ModelFeedback::where([['reviewer', $user], ['product_id', $pid]])->get();

        if(count($check) > 0){
            echo "rated";
        }else{
            echo "rate";
        }
    }
    //Hiển thị reviews
    public function showReviews(Request $request){
        $pid = $request->pid;

        $show = ModelFeedback::where('product_id', $pid)->get();

        if(count($show) > 0){
            foreach ($show as $value) {
                ?>
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <strong><?php echo $value['reviewer'] ?></strong>
                                    <div class="product-ratings" style="display: flex;align-items: center;">
                                        <p class="comment-rate">Đánh giá: </p>
                                        <ul class="ratting d-flex ml-2">
                                            <?php
                                                if($value['rating'] == 1){
                                                    echo '
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    ';
                                                }else if($value['rating'] == 2){
                                                    echo '
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    ';
                                                }else if($value['rating'] == 3){
                                                    echo '
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    ';
                                                }else if($value['rating'] == 4){
                                                    echo '
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    ';
                                                }else if($value['rating'] == 5){
                                                    echo '
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    <li><i style="color: yellow;" class="far fa-star"></i></li>
                                                    ';
                                                }
                                            ?>
                                            
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="comment-content" style="margin: 10px 0;">
                                        <p><?php echo $value['content'] ?></p>
                                    </div>
                                    <span class="text-left" style="opacity: 0.7; display: block;"><?php echo $value['time_reviews']." - ".$value['date_reviews'] ?></span>
                                    <button id="btn_reply<?php echo $value['id'] ?>" class="mt-1" style="cursor: pointer;background: white;padding: 2px 8px;color: #fedc19;border: 1px solid #fedc19;border-radius: 4px;display: inline-block;" class="mt-1">
                                        <span>Bình luận</span>
                                    </button>
                                    <div id="content_reply<?php echo $value['id'] ?>" class="form-group row">
                                        <div class="col">
                                            <label class="col-form-label"><span class="text-danger">*</span> Bình luận của bạn</label>
                                            <textarea class="form-control" id="content_reply_<?php echo $value['id'] ?>" required></textarea>
                                        </div>
                                    </div>
                                    <span class="btn_reply" id="btn_reply_submit<?php echo $value['id'] ?>" style="cursor: pointer;">Đăng</span>
                                </td>
                                <style>
                                    .btn_reply{
                                        border: 1px solid #fedc19;
                                        padding: 3px 10px;
                                        border-radius: 4px;
                                        color: #fedc19;
                                    }
                                </style>
                            </tr>
                        </tbody>
                        <!-- Hiện thị reply ở đây -->
                        
                        
                    </table>
                    <div>
                        <div id="show_reply_<?php echo $value['id'] ?>">
                            
                        </div>
                    </div>
                    <!-- Reviewer -->
                    <input type="hidden" name="" id="reviewer<?php echo $value['id'] ?>" value="<?php echo $value['reviewer'] ?>">
                    <!-- ID của reviews -->
                    <input type="hidden" name="" id="reviews_id<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
                    <!-- Xử lý reply -->
                    <script>
                        $(document).ready(function(){
                            //Hiển thị reply
                            var pid = $("#pid").val();
                            var reviews_id = $("#reviews_id<?php echo $value['id'] ?>").val();
                            var reviewer = $("#reviewer<?php echo $value['id'] ?>").val();
                            
                            $.ajax({
                                url: "ajax-jQuery/show-reply.php",
                                type: "get",
                                dataType: "text",
                                data: {
                                    pid: pid,
                                    reviews_id: reviews_id,
                                    reviewer: reviewer
                                },
                                success: function(result){
                                    $("#show_reply_<?php echo $value['id'] ?>").html(result);
                                    //alert(result)
                                }
                            });
                            //Khi page load lên sẽ ẩn form rep vs Đăng
                            $("#btn_reply_submit<?php echo $value['id'] ?>").hide();
                            $("#content_reply<?php echo $value['id'] ?>").hide();
                            $("#btn_reply<?php echo $value['id'] ?>").click(function(){
                                var replyer = $("#userLogin").val();
                                if(replyer !== "no login"){
                                    //Hiển thị form và Đăng
                                    $("#btn_reply_submit<?php echo $value['id'] ?>").show();
                                    $("#content_reply<?php echo $value['id'] ?>").show();
                                    //Ẩn đi nút Bình luận
                                    $(this).hide();
                                }else{
                                    //alert("Chưa login");
                                    $("#form_id").show();
                                }
                            });

                            //Khí nhấn nút Đăng
                            $("#btn_reply_submit<?php echo $value['id'] ?>").click(function(){
                                //Lấy nội dung
                                
                                var content = $("#content_reply_<?php echo $value['id'] ?>").val();
                                if(content == ''){
                                    $("#btn_reply_submit<?php echo $value['id'] ?>").hide();
                                    $("#content_reply<?php echo $value['id'] ?>").hide();
                                    $("#btn_reply<?php echo $value['id'] ?>").show();
                                    return false;
                                }
                                //alert(content);
                                //lấy product_id
                                var pid = $("#pid").val();
                                //alert(pid);
                                //Lấy tên chủ tus
                                var reviewer = $("#reviewer<?php echo $value['id'] ?>").val();
                                //alert(reviewer)
                                //Lấy tên người rep
                                var replyer = $("#userLogin").val();
                                //alert(replyer)
                                //Lấy id của cái reviewer
                                var reviews_id = $("#reviews_id<?php echo $value['id'] ?>").val();
                                //alert(reviews_id)
                                //Gửi ajax
                                $.ajax({
                                    url: "ajax-jQuery/set-reply.php",
                                    type: "get",
                                    dataType: "text",
                                    data: {
                                        pid: pid,
                                        reviews_id: reviews_id,
                                        reviewer: reviewer,
                                        replyer: replyer,
                                        content: content
                                    },
                                    success: function(result){
                                        //alert(result);
                                        if(result !== "error"){
                                            //Hiển thị nú bình luận
                                            $("#btn_reply<?php echo $value['id'] ?>").show();
                                            //Ẩn nút Đăng vs form
                                            $("#btn_reply_submit<?php echo $value['id'] ?>").hide();
                                            $("#content_reply<?php echo $value['id'] ?>").hide();
                                            $("#content_reply_<?php echo $value['id'] ?>").val('');
                                            //Hiển thị reply
                                            var pid = $("#pid").val();
                                            var reviews_id = $("#reviews_id<?php echo $value['id'] ?>").val();
                                            var reviewer = $("#reviewer<?php echo $value['id'] ?>").val();
                                            //alert(reviews_id);
                                            $.ajax({
                                                url: "ajax-jQuery/show-reply.php",
                                                type: "get",
                                                dataType: "text",
                                                data: {
                                                    pid: pid,
                                                    reviews_id: reviews_id,
                                                    reviewer: reviewer
                                                },
                                                success: function(result){
                                                    $("#show_reply_<?php echo $value['id'] ?>").html(result);
                                                    //Cập nhật tổng nhận xét
                                                    var pid = $("#pid").val();
                                                    //Gửi ajax
                                                    $.ajax({
                                                        url: "ajax-jQuery/ajax-count-reviews.php",
                                                        type: "get",
                                                        dataType: "text",
                                                        data: {
                                                            pid: pid
                                                        },
                                                        success: function(result){
                                                            $("#count_reviews").html(result);
                                                        }
                                                    });
                                                }
                                            });
                                        }else{
                                            alert(result);
                                        }
                                    }
                                });
                            });
                        });
                    </script>
                <?php
            }
        }
    }
}
