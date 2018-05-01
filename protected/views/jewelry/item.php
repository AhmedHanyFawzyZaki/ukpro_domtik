</div>
</div>
<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>
<div class="container">
    <div class="wrap">
        <div class="col-md-12 col-xs-12">
            <ul class="page_path">
                <li><a href="<?= Yii::app()->request->baseUrl ?>">Home</a>>></li>
                <li><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>"><?= $controller ?></a> >></li>
                <li class="active"><?= $product->title ?></li>
                 <li class="seller-link">Product Owner: <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/owner/<?php echo $product->user_id; ?>"><?php echo $product->user->fname.' '.$product->user->lname; ?> </a></li>

            </ul>
        </div>

    </div>
</div>

<div class="container">
    <div class="wrap">
        <div class="col-md-12 col-xs-12">
            <div class="col-md-6 col-md-offset-0 col-xs-12 col-sm-10 col-sm-offset-2" style="padding:0">

                <!-- main slider carousel -->
                <?php
                if($product->flag != 1){
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
                <?php }}elseif($product->flag == 1 and $xml_gallery != null){
                    $xml_gallery = XmlGallery::model()->findAll("product_id = $product->id");
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
                    
                            
                            <?php
                }}else{
                    ?>
                            <img id="zoom_03" class="slider-zoom" src="<?php echo $product->thumb ?>" data-zoom-image="<?php echo $product->main_image ?>"/> 
                            <?php
                } ?>
                <!--/main slider carousel-->
            </div>
            <div class="col-md-6 col-xs-12">
                <?php
                if (Yii::app()->user->hasFlash('add-success')) {
                    ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo Yii::app()->user->getFlash('add-success'); ?>.
                    </div>

                    <?php
                } elseif (Yii::app()->user->hasFlash('add-error')) {
                    ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('add-error'); ?>.
                    </div>
                <?php } ?>
                <p class="main_item_name"><?= $product->title ?></p>
                <p class="main_item_price"><?= $product->price ?> GBP</p>
                <div class="main_item_specs">
                    <?php
                    if ($product->quantity > 0) {
                        $shippings = ShippingValue::model()->findAllByAttributes(array('user_id' => $product->user_id));
                        if (!empty($shippings)) {
                            ?>
                            <form class="form-horizontal" role="form" method="post" action="<?php echo Yii::app()->getBaseUrl(true); ?>/home/addtocart">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label item_specs_lbl ">Size</label>
                                    <div class="col-sm-10">
                                        <select class="form-control item_select" name="size_id">
                                            <option value=""> Select your size </option>
                                            <?php
                                    
                                            
                                            ?>
                                            
                                            <?php
                                            if (!empty($sizes)) {
                                                foreach ($sizes as $size) {
                                                    ?>
                                                    <option value="<?php echo $size->id ?>"><?php echo $size->title; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label item_specs_lbl ">Quantity</label>
                                    <div class="col-sm-10">
                                        <select class="form-control item_select" name="qty" required="required">
                                           
                                            <?php
                                            for($i=1;$i<=10;$i++) {
                                                ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <input name="product_id" type="hidden" value="<?php echo $product->id; ?>" required>
                                        <input name="category_id" type="hidden" value="<?php echo $product->category_id; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button class="btn item_specs_btn" type="submit">
                                            <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/<?= $controller ?>/add_to_cart.png" />
                                            Add To Cart</button>
                                    </div>
                                </div>
                            </form>
                        <?php } else echo "shipping address of these product not determined";
                    }else {
                   if($product->flag !=1)     echo "these product out of stock";
                    } ?>
                    <?php if($product->flag == 1){
                        ?>
                    <a class="btn item_specs_btn" href="<?php if($product->url !=''){ echo $product->url;}else{ echo "#";} ?>" target="_blank">
                                            <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/<?= $controller ?>/add_to_cart.png" />
                                            Add To Cart</a>
                    <?php
                    } ?>
                </div>

                <div class="prod_collapse">
                    <a  data-toggle="collapse" data-target="#item_desc" class="coll_title">
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
                            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                'id' => 'add-review',
                                'enableAjaxValidation' => false,
                                'type' => 'vertical',
                                'htmlOptions' => array('class' => 'collapse', 'enctype' => 'multipart/form-data'
                                ),
                            ));
                            ?>

<?php echo $form->textArea($review, 'comment', array('class' => 'form-control', 'rows' => '3')); ?>

                            <input id="input-21e" name="Review[rate]" type="number" class="rating" min=0 max=5 step=1 data-size="xs" >


<?php echo CHtml::submitButton('Add', array('class' => 'btn add-review-link')); ?>
<?php $this->endWidget(); ?>

                        </div>
                        <button class="btn add-review-link" data-target="#add-review" data-toggle="collapse">Add your review</button>                    </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12 col-xs-12">  
<?php
$count = count($arrivals);
if ($count > 0) {
    ?>

            <div class="headtitle head2">
                <span>you may also like</span>
            </div>  


            <div id="carousel-example-generic2" class="carousel slide animated fadeInUp new_arriv_slider" data-ride="carousel">
                <!-- Wrapper for slides -->
              
                
                
                
 <div class="carousel-inner">


            <div class="item active">
                <?php
                $s = 1;
                foreach ($arrivals as $arrival) {
                    if ($s == 5) {
                        $s = 1;
                        ?>
                    </div>
                    <div class="item">
                        <?php
                    }
                    ?>

                   <div class="col-md-3 col-xs-6 text-center">
                                    <a href="#" class="new_arr_item">
                                        <div class="item_img">
                                            <?php if($product->flag != 1) { ?>
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $arrival->main_image; ?>"/>
                                            <?php }else{ ?>
                                             <img src="<?php echo $product->main_image ?>"/>
                                            <?php  } ?>
                                        </div>
                                        <p class="item_name"><?php echo $arrival->title ?></p>
                                        <p class="new_arr_price"><?php echo $arrival->price; ?> GBP</p>
                                    </a>
                                </div>


                    <?php
                    $s++;
                }
                ?>
            </div>


        </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic2" role="button" data-slide="prev">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/jewelry/left_arrow2.png"/>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic2" role="button" data-slide="next">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/jewelry/right_arrow2.png"/>
                </a>
            </div>


<?php } ?>

    </div>

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

