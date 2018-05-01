</div>
</div>

<?php
$this->renderPartial("top_menu");
?>
<div class="container">
    <div class="wrap">
        <div class="col-md-12 col-xs-12 pages">
            <ul class="page_path">
                <li><a href="javascript:void(0);">Categories</a> >> </li>
                <li><a href="<?php Yii::app()->getBaseUrl(true); ?>/kids">kids</a> >> </li>
                <li class="active"><a href="<?php Yii::app()->getBaseUrl(true); ?>/kids/category?cat_id=<?php echo $product->productCategory->id; ?>"><?php echo $product->productCategory->title; ?></a></li>
               <li class="seller-link">Product Owner: <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/owner/<?php echo $product->user_id; ?>"><?php echo $product->user->fname.' '.$product->user->lname; ?> </a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="wrap">

        <div class="col-md-6 col-md-offset-0 col-xs-12 col-sm-10 col-sm-offset-2" style="padding:0">

            <!-- main slider carousel -->
            <?php
            $xml_gallery = XmlGallery::model()->findAll("product_id = $product->id");
            if($product->flag !=1){
            if (!empty($photos)) {
                $i = 0;
                foreach ($photos as $photo) {
                    $i++;
                    if ($i <= 1) {
                        ?>
                            <img id="zoom_03" class="slider-zoom" src="<?= Yii::app()->request->baseUrl; ?>/gallery/medium/<?php echo $photo->rank ?>medium.jpg" data-zoom-image="<?= Yii::app()->request->baseUrl; ?>/gallery/large/<?php echo $photo->rank ?>large.jpg"/> 
                        <?php
                    }
                }
                ?>
                <div id="gallery_01">
                    <?php foreach ($photos as $photo) { ?>

                         <a href="#" data-image="<?= Yii::app()->request->baseUrl; ?>/gallery/medium/<?php echo $photo->rank ?>medium.jpg" data-zoom-image="<?= Yii::app()->request->baseUrl; ?>/gallery/large/<?php echo $photo->rank ?>large.jpg" > 
                                <img id="img_01" src="<?= Yii::app()->request->baseUrl; ?>/gallery/small/<?php echo $photo->rank ?>small.jpg" /> 
                            </a> 
                    <?php } ?>
                </div>  
            <?php }} elseif($product->flag == 1 and $xml_gallery != null){
                   if (!empty($xml_gallery)) {
                $i = 0;
                foreach ($xml_gallery as $gal) {
                    $i++;
                    if ($i <= 1) {
                        ?>
                            <img id="zoom_03" class="slider-zoom" src="<?php echo $gal->thumb ?>" data-zoom-image="<?php echo $gal->image ?>"/> 
                        <?php
                    }
                }
                ?>
                <div id="gallery_01">
                    <?php foreach ($xml_gallery as $gal) { ?>

                         <a href="#" data-image="<?php echo $gal->thumb ?>" data-zoom-image="<?php echo $gal->image ?>" > 
                                <img id="img_01" src="<?php echo $gal->thumb ?>" /> 
                            </a> 
                    <?php } ?>
                </div>  
            <?php } 
            }else{
                ?>
                             <img id="zoom_03" class="slider-zoom" src="<?php echo $product->thumb ?>" data-zoom-image="<?php echo $product->main_image ?>"/> 
                            <?php
            }
?>
            <!--/main slider carousel-->
        </div>
        <div class="col-md-6 col-xs-12">
            <p class="main_item_name"><?php echo $product->title; ?></p>
            <p class="main_item_price"><?php echo $product->price; ?> GBP</p>
             <div class="main_item_specs">
            <?php
            if($product->quantity <= 0){ ?>
                <div class="nofound">
                    <div class="alert alert-danger">
                    <?php if($product->flag != 1) {?><p>Out of Stock</p><?php } ?>
                    </div>
                </div>
            <?php
            }
            elseif($shippings){ ?>
                    <form class="form-horizontal" role="form" method="post" action="<?php echo Yii::app()->getBaseUrl(true); ?>/home/Addtocart">
                        <div class="form-group">
                            <label class="col-sm-2 control-label item_specs_lbl">Color</label>
                            <div class="col-sm-10">
                                <select class="form-control item_select" name="color_id">
                                    <option value=""> Select Color </option>
                                    <?php
                                    if($colors){
                                        foreach($colors as $color){
                                    ?>
                                        <option value="<?= $color->id;?>"><?php echo $color->title; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label item_specs_lbl">Size</label>
                            <div class="col-sm-10">
                                <select class="form-control item_select" name="size_id">
                                    <option value=""> Select Size </option>
                                    <?php
                                    if ($sizes) {
                                        foreach ($sizes as $size) {
                                            ?>
                                                <option value="<?= $size->id;?>"><?php echo $size->title; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label item_specs_lbl">Quantity</label>
                            <div class="col-sm-4">
                                <select class="form-control item_select"  required="required" name="qty">
                                <?php
                                    for($k = 1; $k <= 10; $k++) {
                                    ?>
                                        <option value="<?php echo $k ?>"><?php echo $k; ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                                <input name="product_id" hidden="true" value="<?php echo $product->id; ?>">
                                <input name="category_id" hidden="true" value="8">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn item_specs_btn" type="submit">
                                    <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/add_to_cart.png" />
                                    Add To Cart</button>
                            </div>
                        </div>
                    </form>
                 
                
            <?php
            }
            else{ ?>
                <div class="nofound">
                    <div class="alert alert-danger">
                    <p>No Shipping Options for this product</p>
                    </div>
                </div>
            <?php
            }
            ?>
                 <?php if($product->flag == 1){
                     ?>
                 <a class="btn item_specs_btn" href="<?php if($product->url !=''){ echo $product->url;}else{ echo "#";} ?>" target="_blank">
                                    <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/add_to_cart.png" />
                                    Add To Cart</a>
                 <?php
                 } ?>
            </div>
            <div class="prod_collapse">
                <a data-toggle="collapse" data-target="#item_desc" class="coll_title">
                    Product description
                </a>
                <div id="item_desc" class="collapse">
                    <p class="prod_desc"><?php echo $product->description; ?></p>
                </div>
            </div>
            <div class="prod_collapse">
                <a data-toggle="collapse" data-target="#item_rev" class="coll_title">Reviews</a>
                <div id="item_rev" class="collapse">
                    <p class="prod_desc">
                    <?php foreach ($reviews as $review) { ?>
                        <div class="one_review">
                            <div class="col-md-2 col-md-offset-0 col-sm-2 col-sm-offset-0 col-xs-6 col-xs-offset-3">
                                <div class="rev_user_img">
                                    <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/members/<?php echo $review->user->image; ?>"/>
                                </div>
                                <a class="rev_username" href="javascript:void(0);"><?php echo $review->user->username; ?></a>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-12 rev-post">
                                <div class="review_box">
                                    <p class="rev_txt"><?php echo $review->comment; ?> </p>

                                    <p class="rev_date"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/calendar_icon.png"/>
                                        <span><?php echo $review->comment_date; ?></span>
                                    </p>

                                    <div class=" pull-right">
                                        <input id="input-21e" value="<?php echo $review->rate; ?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="add-review">
                        <?php
                        if(Yii::app()->user->isGuest){ ?>
                            <div class="nofound">
                                <div class="alert alert-danger">
                                    <p>Login First To Add Review</p>
                                </div>
                            </div>
                        <?php
                        }else{ ?>
                            <form id="add-review" class="collapse" method="post" action="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/addReview">
                                <textarea class="form-control" rows="3" name="comment"></textarea>
                                <input id="input-21e" value="0" type="number" class="rating" min=0 max=5 step=1 data-size="xs" name="rate">
                                <input name="product" hidden="true" value="<?php echo $product->id; ?>">
                                <button class="btn add-review-link" type="submit">ADD</button>
                            </form>
                        <?php
                        } ?>
                    </div>
                    <button class="btn add-review-link" data-toggle="collapse" data-target="#add-review">Add your review</button>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
<script>
    function checkQuantity()
    {
        var quantity = document.getElementById('quant').value;
        if (/^[0-9]+$/.test(quantity))
        {
            return true;
        }
        else
        {
            alert("Invalid Quantity Value");
            document.getElementById('quant').value = 1;
            quantity = 1;

        }
    }
</script>
<script>
    $("#shipping_id").change(function() {
        var shipp_id=$(this).val();
        $.ajax({
            url:"<?=Yii::app()->request->baseUrl?>/home/changeShipping?id="+shipp_id,
            success:function (data){
                var arr=data.split('*_*');
                $('#ship_val').val(arr[0]);
                $('#ship_city').val(arr[1]);
                $('#ship_country').val(arr[2]);
            } 
        });
        
    });
</script>