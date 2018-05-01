
<div class="row">

    <div class="col-md-12">
        <ul class="page_path wp4 delay-05s">
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths">Clothes & Accessories</a>  >></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/subcategory/id/<?php echo $sub->id; ?>"><?php echo $sub->title; ?></a>  >></li>
            <li><a ><?php echo $product->title; ?></a>  </li>
            <li class="seller-link">Product Owner: <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/owner/<?php echo $product->user_id; ?>"><?php echo $product->user->fname.' '.$product->user->lname; ?> </a></li>
        </ul>
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-6" style="padding:0">
        <!-- main slider carousel -->
        <?php
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
    </div>
    <div class="col-md-6 wp4 delay-05s">


        <?php
        if (Yii::app()->user->hasFlash('update-success')) {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo Yii::app()->user->getFlash('update-success'); ?>.
            </div>

            <?php
        } elseif (Yii::app()->user->hasFlash('update-error')) {
            ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('update-error'); ?>.
                <?php echo Yii::app()->user->getFlash('Passchange'); ?>.
            </div>
        <?php } ?>

        <p class="main_item_name"><?php echo $product->title; ?></p>
        <p class="main_item_price"><?php echo $product->price; ?> GBP</p>
        <div class="main_item_specs">
            <?php
            if ($product->quantity > 0) {
                $shippings = ShippingValue::model()->findAllByAttributes(array('user_id' => $product->user_id));
                if (!empty($shippings)) {
                    ?>
                    <form class="form-horizontal" role="form" method="post" action="<?php echo Yii::app()->getBaseUrl(true); ?>/home/addtocart">
                        <div class='form-group'>
                            <label class="col-sm-2 control-label item_specs_lbl wp4 delay-05s">Color</label>
                            <div class="col-sm-10">
                                <select name="color_id" class="form-control item_select">
                                     <option> Select Color </option>
                                     <?php
                                    if($colors){
                                        foreach($colors as $color){
                                    ?>
                                        <option value="<?= $color->id;?>"><?php echo $color->title; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    /*
                                    foreach ($color_ar as $value => $caption) {
                                        echo "<option value=\"$value\">$caption</option>";
                                    }
                                    */
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class="col-sm-2 control-label item_specs_lbl wp4 delay-07s">Size</label>
                            <div class="col-sm-10">
                                <select name="size_id"  class="form-control item_select">
                                     <option> Select Size </option>
                                      <?php
                                    if ($sizes) {
                                        foreach ($sizes as $size) {
                                            ?>
                                                <option value="<?= $size->id;?>"><?php echo $size->title; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                    
                                    <?php
                                    /*
                                    foreach ($size_ar as $value => $caption) {
                                        echo "<option value=\"$value\">$caption</option>";
                                    }
                                    */
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                                    <label class="col-sm-2 control-label item_specs_lbl wp4 delay-09s">Quantity</label>
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


                        Shipping to
                        <div class="form-group">
                            <label class="col-sm-2 control-label item_specs_lbl wp4 delay-07s animated fadeInRight">City</label>
                            <div class="col-sm-10">
                                <select class="form-control item_select" id="shipping_id"  required="required">
                                    <option value=""> Select your city </option>
                                    <?php
                                    foreach ($shippings as $shipping) {
                                        ?>
                                        <option value="<?php echo $shipping->id ?>"><?php echo $shipping->shippingcountry->title . ' (' . $shipping->shippingcity->title . ')'; ?></option>
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
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/cloths/add_to_cart.png" />
                                    Add To Cart</button>
                            </div>
                        </div>
                    </form>
                    <?php
                } else
                    echo "shipping address of these product not determined";
            }else {
                echo "these product out of stock";
            }
            ?>
            
        </div>       



        <div class="prod_collapse">
           
            
            <a href="javascript:void{0};" data-toggle="collapse" data-target="#item_desc" class="coll_title">Product description</a>

            <div id="item_desc" class="collapse">
                <p class="prod_desc wp4 delay-05s"><?php echo $product->description; ?></p>
            </div>

        </div>
        <div class="prod_collapse">
            <a href="javascript:void{0};" data-toggle="collapse" data-target="#item_rev" class="coll_title">Reviews</a>                    <div id="item_rev" class="collapse">
                <p class="prod_desc">

                    <?php
                    foreach ($revs as $rev) {
                        $user = User::model()->findByAttributes(array('id' => $rev->user_id));
                        ?>


                    <div class="one_review wp4 delay-05s">
                        <div class="col-xs-2">
                            <div class="rev_user_img">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/members/<?php echo $user->image; ?>"/>
                            </div>
                            <a class="rev_username" href="<?php echo Yii::app()->request->baseUrl; ?>/users/dashboard/<?php echo $user->id; ?>"><?php echo $user->username; ?></a>
                        </div>
                        <div class="col-xs-10">
                            <div class="review_box">
                                <p class="rev_txt"><?php echo $rev->comment; ?></p>

                                <p class="rev_date"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/cloths/calendar_icon.png"/>
                                    <span><?php echo $rev->comment_date; ?></span>
                                </p>

                                <div class=" pull-right">
                                    <input id="input-21e" value="<?php echo $rev->rate; ?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs">
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>




                <div class="add-review">

                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'editprofile-form',
                        'enableAjaxValidation' => false,
                        'type' => 'vertical',
                        'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'
                        ),
                    ));
                    ?>

                    <?php echo $form->textArea($review, 'comment', array('class' => 'form-control', 'rows' => '3')); ?>

                    <input id="input-21e" name="Review[rate]" type="number" class="rating" min=0 max=5 step=1 data-size="xs" >




                </div>
                <div class="form-group">
                   
                        <?php echo CHtml::submitButton('Add your review', array('class' => 'btn add-review-link', 'data-toggle' => 'collapse', 'data-target' => '#add-review')); ?>
                   
                </div>
                <?php $this->endWidget(); ?>
            </div>

        </div>
    </div>

</div>

<div class="col-md-12 likes_slider">
    <p class="sections_title">You may also Like</p>
    <div class="seprator_line"></div>

    <div id="carousel-example-generic2" class="carousel slide animated fadeInUp new_arriv_slider" data-ride="carousel">
        <!-- Indicators -->


        <!-- Wrapper for slides -->

        
        
        
             <div class="carousel-inner">


            <div class="item active">
                <?php
                $s = 1;
                foreach ($likes as $like) {
                    if ($s == 5) {
                        $s = 1;
                        ?>
                    </div>
                    <div class="item">
                        <?php
                    }
                    ?>

                    <div class="col-md-3 col-xs-6 text-center">
                            <a href="<?=Yii::app()->request->baseUrl ?>/cloths/item/id/<?= $like->id ?>" class="new_arr_item">
                                <div class="item_img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $like->main_image; ?>"/></div>
                                <p class="item_name"><?php $like->title ?></p>
                                <p class="new_arr_price"><?php $like->price; ?> GBP</p>
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
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/cloths/left_arrow2.png"/>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic2" role="button" data-slide="next">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/cloths/right_arrow2.png"/>
        </a>
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



