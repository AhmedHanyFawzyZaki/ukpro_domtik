<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>



</div>

</div>



<div class="container">
    <div class="wrap">

        <div class="row">


            <div class="col-md-5 zoom-slider"   >

                <!-- main slider carousel -->
                <?php
                if (!empty($photos)) {
                    $i = 0;
                    foreach ($photos as $photo) {
                        $i++;
                        if ($i <= 1) {
                            ?>

                            <img id="zoom_03" class="slider-zoom" src="<?= Yii::app()->request->baseUrl; ?>/gallery/medium/<?php echo $photo->rank ?>medium.jpg" data-zoom-image="<?= Yii::app()->request->baseUrl; ?>/gallery/large/<?php echo $photo->rank ?>large.jpg"/> 


            <!--                        <img id="zoom_03"   class="slider-zoom" src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/small/image1.png" data-zoom-image=" <?= Yii::app()->request->baseUrl ?>/img/lifestyle/large/image1.jpg"/> -->

                            <?php
                        }
                    }
                    ?>
                    <div id="gallery_01">
                        <?php foreach ($photos as $photo) { ?>


                            <a href="#" data-image="<?= Yii::app()->request->baseUrl; ?>/gallery/medium/<?php echo $photo->rank ?>medium.jpg" data-zoom-image="<?= Yii::app()->request->baseUrl; ?>/gallery/large/<?php echo $photo->rank ?>large.jpg" > 
                                <img id="img_01" src="<?= Yii::app()->request->baseUrl; ?>/gallery/small/<?php echo $photo->rank ?>small.jpg" /> 
                            </a> 

        <!--                    <a href="#" data-image="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/small/image4.png" data-zoom-image="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/large/image4.jpg"> 
        <img id="img_01" src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/thumb/image4.jpg" /> 
        </a> -->



                        <?php } ?>
                    </div>  
                <?php } ?>
                <!--/main slider carousel-->
            </div>






            <!--    
            <div class="col-md-5 zoom-slider">
                 main slider carousel 
                
            <img id="zoom_03" class="slider-zoom" src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/small/image1.png" data-zoom-image=" <?= Yii::app()->request->baseUrl ?>/img/lifestyle/large/image1.jpg"/> 
            <div id="gallery_01">
                
            <a href="#" data-image="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/small/image1.png" data-zoom-image="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/large/image1.jpg" > 
                    <img id="img_01" src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/thumb/image1.jpg" /> 
            </a> 
                
            <a href="#" data-image="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/small/image2.png" data-zoom-image="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/large/image2.jpg"> 
                    <img id="img_01" src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/thumb/image2.jpg" /> 
            </a> 
                
            <a href="#" data-image="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/small/image3.png" data-zoom-image="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/large/image3.jpg"> 
                    <img id="img_01" src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/thumb/image3.jpg" /> 
            </a> 
                
            <a href="#" data-image="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/small/image4.png" data-zoom-image="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/large/image4.jpg"> 
                    <img id="img_01" src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/thumb/image4.jpg" /> 
            </a> 
            
            
            </div>  
                        
              
                
                
             
                </div>
            -->






            <div class="col-md-6 col-sm-6 col-xs-12 details-tabs pull-right">


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






                <?php if ($product->type == 0) {
                    ?>

                    <!--    //product-->
                    <!-- add to cart if product is product  -->


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
                                        <label class="col-sm-2 control-label item_specs_lbl wp4 delay-09s">Product Owner: </label>
                                        <div class="col-sm-10">
                                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/owner/<?php echo $product->user_id; ?>"><?php echo $product->user->fname . ' ' . $product->user->lname; ?> </a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label item_specs_lbl wp4 delay-09s">Quantity</label>
                                        <div class="col-sm-10">
                                            <select class="form-control item_select" id="shipping_id" name="qty" required="required">

                                                <?php
                                                for ($i = 1; $i <= 10; $i++) {
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
                                            <button class="btn btn-default buy-bt" type="submit">
                                                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/<?= $controller ?>/add_to_cart.png" />
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




                    <?php }
                ?>



                <div  style="width:500px;height:40px;clear: both;"></div>             

                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#details" role="tab" data-toggle="tab">description</a></li>
                    <li><a href="#reviews" role="tab" data-toggle="tab">reviews</a></li>
                    <?php if ($product->type == 1) {
                        ?>
                        <li><a href="#order" role="tab" data-toggle="tab">order</a></li>
                        <li><a href="#map" role="tab" data-toggle="tab">map</a></li>

                        <?php }
                    ?>



                </ul>

                <div class="tab-content">

                    <div class="tab-pane fade in active" id="details">

                        <div class="details">

                            <h6>  <?php echo $product->description; ?> </h6>
                        </div>
                        <div class="details">
                            <h5 class="title">Facilities:</h5>
                            <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled ..Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled ..Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled ..</h6>
                        </div>

                    </div>






                    <div class="tab-pane fade" id="reviews">

                        <p class="prod_desc">

<?php foreach ($reviews as $review) { ?>
                            <div class="one_review">
                                <div class="col-xs-2">
                                    <div class="rev_user_img">
                                        <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/members/<?php echo $review->user->image; ?>"/>
                                    </div>
                                    <a class="rev_username" href="javascript:void(0);"><?php echo $review->user->username; ?></a>
                                </div>
                                <div class="col-xs-10">
                                    <div class="review_box">
                                        <p class="rev_txt"><?php echo $review->comment; ?> </p>

                                        <p class="rev_date"><img src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/calendar_icon.png"/>
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


                            <?php echo CHtml::submitButton('Add your review', array('class' => 'btn add-review-link')); ?>

<?php $this->endWidget(); ?>


                        </div>


                        <!--
                                                            <div class="add-review">
                                                                <form action="#" id="add-review" class="collapse">
                                                                        <textarea class="form-control" rows="3"></textarea>
                                                      <input id="input-21e" value="0" type="number" class="rating" min=0 max=5 step=1 data-size="xs" >
                                                                </form>
                                                            
                                                            </div>-->



                        <button class="btn pull-right review-bt" data-toggle="collapse" data-target="#add-review">Add your review</button>
                        </p>



                    </div>

                    <?php if ($product->type == 1) {
                        ?>

                        <div class="tab-pane fade" id="order">



                            <div class="main_item_specs">
                                <div class="form-group">
                                    <p class="prod_desc">
                                        <?php if (!empty(Yii::app()->user->id)) { ?>
                                            please fill the below forms and submit, to send your order to the owner.
                                        <div class="add-order">
                                            <?php
                                            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                                'id' => 'add-order',
                                                'enableAjaxValidation' => false,
                                                'type' => 'vertical',
                                                'htmlOptions' => array('class' => 'collapse', 'enctype' => 'multipart/form-data'
                                                ),
                                            ));
                                            ?>

                                            <?php echo $form->textArea($message, 'details', array('class' => 'form-control', 'rows' => '3')); ?>



                                            <?php echo CHtml::submitButton('Add', array('style' => 'margin-top:20px', 'class' => 'btn review-bt pull-left')); ?>
                                            <?php $this->endWidget(); ?>

                                        </div>

                                        <button class="btn review-bt pull-right" data-toggle="collapse" data-target="#add-order">Order Now</button>

                                    <?php } else echo 'Please Login first or create your account'; ?>
                                    </p>

                                </div>
                            </div>


                            <!--     <div class="details">
                                     <textarea cols="3" class="form-control"></textarea>
                                      <button class="btn pull-right review-bt" style="form-control">Order now</button>
                                 </div>-->




                        </div>


                        <?php }
                    ?>

<div class="tab-pane" id="map">
                <div style="width:302px;height:352px"><iframe width="500" height="352" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=<?php echo str_replace(" ","%2B",$proddetails->address);?>&ie=UTF8&z=12&t=m&iwloc=near&output=embed"></iframe><br><table width="302" cellpadding="0" cellspacing="0" border="0"><tr><td align="left"><!-- <small><a href="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=Keighley%2BWest%2BYorkshire&ie=UTF8&z=12&t=m&iwloc=near">View Larger Map</a></small></td><td align="right"><small>--></td></tr></table></div>
                </div>

    </div>

                </div> 
            </div>


            <!--<button type="button" class="btn btn-default buy-bt">buy now</button>-->
        </div>


        <div class="col-md-12 col-xs-12 likes_slider">
            <div class="header-center">
                <h1>you may also like</h1>
            </div>


            <div id="carousel-example-generic3" class="carousel slide animated fadeInUp new_arriv_slider" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner">





                    <div class="item active">

                        <?php
                        $i = 0;
                        foreach ($arrivals as $arrival) {
                            $i++;
                            if ($i <= 4) {
                                ?>


                                <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $arrival->id ?>" class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="place">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $arrival->main_image; ?>">
                                        <h3 class="title"><?php echo $arrival->title ?><span><?php echo $arrival->price; ?> GBP</span></h3>


                                    </div>
                                </a>


                                <?php
                            }
                        }
                        ?>
                    </div>             



                    <!--                      
                                  <div class="item active">
                                        
                                            <a href="#" class="col-md-3 col-sm-6 col-xs-12">
                            <div class="place">
                            <img src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/item-img.jpg">
                            <h3 class="title">Place name<span>200 GBP</span></h3>
                            
                        
                            </div>
                        </a>
                                            
                                           
                                            
                                        
                               </div>
                    -->




                    <div class="item">

                        <?php
                        $i = 0;
                        foreach ($arrivals as $arrival) {
                            $i++;
                            if ($i >= 5 and $i <= 8) {
                                ?>



                                <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $arrival->id ?>" class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="place">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $arrival->main_image; ?>">
                                        <h3 class="title"><?php echo $arrival->title; ?><span><?php echo $arrival->price; ?> GBP</span></h3>


                                    </div>
                                </a>

                                <?php
                            }
                        }
                        ?>
                    </div>    


                    <div class="item">

                        <a href="#" class="col-md-3 col-sm-6 col-xs-12">
                            <div class="place">
                                <img src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/item-img.jpg">
                                <h3 class="title">Place name<span>200 GBP</span></h3>


                            </div>
                        </a>

                    </div>



                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic3" role="button" data-slide="prev">
                    <img src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/left_arrow2.png"/>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic3" role="button" data-slide="next">
                    <img src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/right_arrow2.png"/>
                </a>
            </div>
        </div>

    </div>


    <!-- InstanceEndEditable -->


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

