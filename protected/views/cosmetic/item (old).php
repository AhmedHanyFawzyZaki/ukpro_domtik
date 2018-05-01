</div>
</div>

<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>
<div class="container">
    <div class="wrap">
        <div class="col-md-12 col-xs-12 pages">
            <ol class="breadcrumb">
                <li><a href="<?= Yii::app()->request->baseUrl ?>/home">Home</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>"><?= $controller ?></a></li>
                <li class="active"><?= $product->title ?></li>
                <li class="seller-link">Product Owner: <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/owner/<?php echo $product->user_id; ?>"><?php echo $product->user->fname.' '.$product->user->lname; ?> </a></li>
            </ol>
        </div>
    </div>
</div>

<div class="container">
    <div class="wrap">

        <div class="col-md-6 col-md-offset-0 col-xs-12 col-sm-10 col-sm-offset-2" style="padding:0">
            
            
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
            
            
            

            <!-- main slider carousel -->
            <?php
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
            <?php } ?>
            <!--/main slider carousel-->
        </div>
        
        
        
        
        
        
  
            
        

        <div class="col-md-6 col-xs-12 wp4 delay-05s">
            
            
            <p class="main_item_name"><?php echo $product->title; ?></p>
            <!--<p class="main_item_price"><?php echo $product->price; ?> GBP</p>-->
            <div class="main_item_specs">
                <?php if (!empty($sizes)){
                        $shippings = ShippingValue::model()->findAllByAttributes(array('user_id' => $product->user_id));
                        if(!empty($shippings)){
                        ?>
                <form class="form-horizontal" role="form" method="post" action="<?php echo Yii::app()->getBaseUrl(true); ?>/home/addtocart">

                    <div class="form-group">
                        <label class="col-sm-2 control-label item_specs_lbl wp4 delay-07s animated fadeInRight">Size</label>
                        <div class="col-sm-10">
                            <select class="form-control item_select" name="size_id" required>
                                <option value=""></option>
                                <?php
                                if (!empty($sizes)) {
                                    foreach ($sizes as $size) {
                                        

$sizee=Size::model()->findByPk(array('id'=>$size->size_id));

                                        ?>
                                <option value="<?php echo $size->id; ?>"><?php echo $sizee->title; ?> (<?=$size->price?>)</option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                     <div class="form-group">
                                    <label class="col-sm-2 control-label item_specs_lbl wp4 delay-09s">Quantity</label>
                                    <div class="col-sm-10">
                                        <select class="form-control item_select" id="shipping_id" name="qty" required="required">
                                           
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
                    
                    Shipping to
                    <div class="form-group">
                        <label class="col-sm-2 control-label item_specs_lbl wp4 delay-07s animated fadeInRight">City</label>
                        <div class="col-sm-10">
                            <select class="form-control item_select" id="shipping_id"  required="required">
                                <option value=""> Select your city </option>
                                <?php
                                    foreach ($shippings as $shipping) {
                                        ?>
                                <option value="<?php echo $shipping->id ?>"><?php echo $shipping->shippingcountry->title.' ('.$shipping->shippingcity->title.')'; ?></option>
                                        <?php
                                    }
                               
                                ?>
                            </select>
                            <input name="ship_country" id="ship_country" type="hidden" required>
                            <input name="ship_city"  id="ship_city" type="hidden" required>
                            <input name="ship_val"  id="ship_val" class="form-control" type="hidden" required>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-2 control-label item_specs_lbl wp4 delay-09s">Shipping Value (GBP)</label>
                        <div class="col-sm-10">
                            <input name="ship_val" required="required" id="ship_val" class="form-control" type="text" readonly="">
                        </div>
                    </div>-->
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label item_specs_lbl wp4 delay-09s">Shipping Address</label>
                        <div class="col-sm-10">
                            <input name="ship_address" type="text" required="required" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label item_specs_lbl wp4 delay-09s">Shipping Postcode</label>
                        <div class="col-sm-10">
                            <input name="ship_postcode" type="text" required="required" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group wp4 delay-1s">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button class="btn item_specs_btn" type="submit">
                                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/<?= $controller ?>/add_to_cart.png" />
                                Add To Cart</button>
                        </div>
                    </div>
                </form>
                <?php }else echo "shipping address of these product not determined";}else { echo "these product out of stock"; }?>
            </div>

            <div class="prod_collapse">
                <a  data-toggle="collapse" data-target="#item_desc" class="coll_title">
                    Product description
                </a>

                <div id="item_desc" class="collapse">
                    <p class="prod_desc wp4 delay-05s"><?php echo $product->description; ?></p>
                </div>

            </div>
            <div class="prod_collapse">
                <a data-toggle="collapse" data-target="#item_rev" class="coll_title">Reviews</a>
                <div id="item_rev" class="collapse">
                    <p class="prod_desc">
                        <?php foreach ($reviews as $review) { ?>
                        <div class="one_review wp4 delay-05s">
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
                    
                    
                    
<!--
                    <div class="add-review">
                        <form id="add-review" class="collapse" method="post" action="<?php echo Yii::app()->getBaseUrl(true); ?>/<?= $controller ?>/addReview">
                            <textarea class="form-control" rows="3" name="Review[comment]"></textarea>
                            <input id="input-21e" value="0" type="number" class="rating" min=0 max=5 step=1 data-size="xs" name="Review[rate]">
                            <input name="Review[product]" hidden="true" value="<?php echo $product->id; ?>">
                            <button class="btn add-review-link" type="submit">ADD</button>
                        </form>

                    </div>
                    -->
                    
                    
                    <button class="btn add-review-link" data-toggle="collapse" data-target="#add-review">Add your review</button>
                    </p>
                </div>

            </div>
        </div>

    </div>




</div>
</div>
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