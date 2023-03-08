<div class="home-module-three hm-1 fix pb-40">
    <div class="container-fluid">
        <div class="section-title module-three">
            <h3><span>Sản phẩm</span> của chúng tôi</h3>
            
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="module-one">
                <div id="showOurProduct" class="module-four-wrapper custom-seven-column">
                    
                    
                </div>
                <div id="style_load_more">
                    <a href="<?php echo e(route('shop')); ?>"><input id="btn_load_more" type="button" value="Xem thêm"></a>
                </div>
                <style>
                    #style_load_more{
                        display: flex;
                        justify-content: center;
                        align-items: center; 
                    }
                    #btn_load_more{
                        cursor: pointer;
                        padding: 5px 20px;
                        border: 1px solid #ffc107;
                        color: #ffc107;
                        background-color: white;
                    }
                    #btn_load_more:hover{
                        color: black;
                        background-color: #ffc107;
                    }
                </style>
                
                <script>
                    $(document).ready(function(){
                        $.ajax({
                            url: "<?php echo e(route('get-our-product')); ?>",
                            type: "get",
                            dataType: "text",
                            data: {

                            },
                            success: function(result){
                                $("#showOurProduct").html(result);
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\xampp\htdocs\baocaothuctap\resources\views/layout/home-product-module.blade.php ENDPATH**/ ?>