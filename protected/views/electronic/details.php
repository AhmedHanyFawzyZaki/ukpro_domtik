<div class="row"> 

    <div class="col-md-12">
        <h1 class="product-address">
            <?php if($product->flag != 1){ ?>
            <label><?= $product->title; ?></label>
            <?php }else{
                ?>
            <label><a target="_blank" href="<?php echo $product->url; ?>" ><?= $product->title; ?></a></label>
            <?php
            } ?>
            <label class="pull-right"><?= $product->price; ?> GBP</label>
        </h1>
    </div>
    <div class="zoom col-md-6">
        <?php
        $xml_gallery = XmlGallery::model()->findAll("product_id = $product->id");
        
        if($product->flag != 1 ){
        if (!empty($photoes)) {
            $i = 0;
            foreach ($photoes as $photo) {
                $i++;
                if ($i <= 1) {
                    ?>
                    <img id="zoom_03" class="slider-zoom" src="<?= Yii::app()->request->baseUrl; ?>/gallery/medium/<?php echo $photo->rank ?>medium.jpg" data-zoom-image="<?= Yii::app()->request->baseUrl; ?>/gallery/large/<?php echo $photo->rank ?>large.jpg"/> 
                    <?php
                }
            }
            ?>
            <div id="gallery_01">
                <?php foreach ($photoes as $photo) { ?>
                    <a href="#" data-image="<?= Yii::app()->request->baseUrl; ?>/gallery/medium/<?php echo $photo->rank ?>medium.jpg" data-zoom-image="<?= Yii::app()->request->baseUrl; ?>/gallery/large/<?php echo $photo->rank ?>large.jpg" > 
                        <img id="img_01" src="<?= Yii::app()->request->baseUrl; ?>/gallery/small/<?php echo $photo->rank ?>small.jpg" /> 
                    </a> 
                <?php } ?>
            </div>  
        <?php }}elseif($product->flag ==1 and $xml_gallery != null){ 
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
                        <img id="img_01" src="<?php echo $gal->image ?>" /> 
                    </a> 
                <?php } ?>
            </div> 
        
          <?php      }else{ ?>
                    
                    <img id="zoom_03" class="slider-zoom" src="<?php echo $product->main_image; ?>" data-zoom-image="<?php echo $product->main_image; ?>"/>             
        <?php }?>            
    </div>
    <div class="col-md-6">

        <div class="main_item_specs">
            <?php if ($product->quantity <= 0 and $product->flag != 1) { ?>
                <div class="nofound">
                    <div class="alert alert-danger">
                        <p>Out of Stock</p>
                    </div>
                </div>
                <?php
            } elseif ($shippings) {
                ?>

                <form class="form-horizontal" role="form" method="post" action="<?php echo Yii::app()->getBaseUrl(true); ?>/home/Addtocart">

                    <div class="form-group">
                        <label class="col-sm-2 control-label item_specs_lbl">Product Owner: </label>
                        <div class="col-sm-10">
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/owner/<?php echo $product->user_id; ?>"><?php echo $product->user->fname . ' ' . $product->user->lname; ?> </a>
                        </div>
                    </div>
                    <div class='form-group'>
                        <?php
                                if ($colors) {?>
                        <label class="col-sm-2 control-label item_specs_lbl">Color</label>
                        <div class="col-sm-4">
                              
                            <select name="color_id" class="form-control item_select">
                                <option value=""> Select Color </option>
                                <?php
                                if ($colors) {
                                    foreach ($colors as $color) {
                                        ?>
                                        <option value="<?= $color->id; ?>"><?php echo $color->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                                <?php } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php if($product->flag != 1){ ?>
                        <label class="col-sm-2 control-label item_specs_lbl">Quantity</label>
                        <div class="col-sm-4">

                            <select class="form-control item_select"  required="required" name="qty">
                                <?php
                                for ($k = 1; $k <= 10; $k++) {
                                    ?>
                                    <option value="<?php echo $k ?>"><?php echo $k; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        <?php } ?>
                            <input name="product_id" hidden="true" value="<?php echo $product->id; ?>">
                            <input name="category_id" hidden="true" value="7">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <?php if($product->flag != 1){ ?>
                            <button class="btn item_specs_btn" type="submit">
                                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/add_to_cart.png" />
                                Add To Cart</button>
                            <?php }else{ ?>
                            <a class="btn item_specs_btn" href="<?php if($product->url !=''){ echo $product->url;}else{ echo "#";} ?>" target="_blank">
                                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/add_to_cart.png" />
                                Add To Cart</a>
                            <?php } ?>
                        </div>
                    </div>
                </form>

                <?php
            } else {
                ?>
                <div class="nofound">
                    <div class="alert alert-danger">
                        <p>No Shipping Options for this product</p>
                    </div>
                </div>
                <?php
            }
            ?>
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
    <div class="col-md-12">
        <h1 class="product-address">
            <label>YOU MAY ALSO LIKE</label>
        </h1>
    </div>
    <div class="col-md-12 carsol">
        <div id="carousel-example-generic2" class="carousel slide animated fadeInUp new_arriv_slider" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic2" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic2" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic2" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

                <div class="item active">
<?php
$x = 1;
foreach ($similars as $similar) {
    if ($x == 5) {
        $x = 1;
        ?>
                        </div>
                        <div class="item">
                            <?php
                        }
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/electronic/details?pro_id=<?php echo $product->id; ?>" class="new_arr_item">
                                <div class="item_img">
                                   <?php if($similar->flag != 1) { ?>
                                    <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?= $similar->main_image; ?>"/>
                                   <?php }else{
                                       ?>
                                    <img src="<?= $similar->main_image; ?>"/>
                                    <?php
                                   } ?>
                                </div>
                                <p class="item_name"><?php echo $similar->title; ?></p>
                                <p class="new_arr_price"><?php echo $similar->price; ?>GBP</p>
                            </a>
                        </div>
    <?php
    $x++;
}
?>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic2" role="button" data-slide="prev">
                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/electronic/left_arrow2.png"/>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic2" role="button" data-slide="next">
                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/electronic/right_arrow2.png"/>
            </a>
        </div>
    </div>
</div>
<script>
    $("#shipping_id").change(function() {
        var shipp_id = $(this).val();
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/home/changeShipping?id=" + shipp_id,
            success: function(data) {
                var arr = data.split('*_*');
                $('#ship_val').val(arr[0]);
                $('#ship_city').val(arr[1]);
                $('#ship_country').val(arr[2]);
            }
        });

    });
</script>