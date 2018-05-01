
</div>
</div>
<?php
$controller = Yii::app()->controller->id;
?>


	
<div class="container">
<div class="wrap">
<div class="col-md-3 col-sm-3 col-xs-12 left-menu">

<ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
<li class="menu-title">HOME DÉCOR Type</li>

        <?php
        $i = 0;
        foreach ($decortypes as $decortype){
            if ($i == 0) {
                $class = "active";
            } else
                $class = "";
            $i++;
            ?>
      <li class="<?= $class;?>"><a href="<?= Yii::app()->request->baseUrl; ?>/decor/sub?type_id=<?= $decortype->id?>"><?= $decortype->title; ?></a></li>
<?php } ?>
    </ul>
    
<ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
<li class="menu-title">Home Décor Style</li>

<?php
        $i = 0;
        foreach ($decorstyles as $decorstyle){
            if ($i == 0) {
                $class = "active";
            } else
                $class = "";
           $i++; ?>
      <li class="<?= $class;?>"><a href="<?= Yii::app()->request->baseUrl; ?>/decor/sub?style_id=<?= $decorstyle->id?>"><?php echo $decorstyle->title; ?></a></li>
      <?php } ?>

  
    </ul>
</div><!--end menu-->
<div class="col-md-9 col-sm-9 col-xs-12 latets-design">
<span class="menu-title"><?= $product->title;?></span>

 
<div class="col-md-9 col-xs-12 big-slide">
    <?php
        $i = 0;
        foreach ($photos as $photo) {
            $i++;
            if ($i <= 1) {
                ?>
                            <img id="zoom_03" class="slider-zoom" src="<?= Yii::app()->request->baseUrl; ?>/gallery/medium/<?php echo $photo->rank ?>medium.jpg" data-zoom-image="<?= Yii::app()->request->baseUrl; ?>/gallery/large/<?php echo $photo->rank ?>large.jpg"/> 


<?php }
} ?>
</div>

<div class="col-md-3 col-xs-12 small-slides">
<div id="gallery_01">
    
    
    <?php foreach ($photos as $photo) { ?>
<a href="#" data-image="<?= Yii::app()->request->baseUrl; ?>/gallery/medium/<?php echo $photo->rank ?>medium.jpg" data-zoom-image="<?= Yii::app()->request->baseUrl; ?>/gallery/large/<?php echo $photo->rank ?>large.jpg" > 
                                <img id="img_01" src="<?= Yii::app()->request->baseUrl; ?>/gallery/small/<?php echo $photo->rank ?>small.jpg" /> 
                            </a> 
<?php } ?>



</div> 


</div>

 


<div class="col-md-12 col-xs-12 tabs">

<ul role="tablist" class="nav nav-tabs" id="myTab">
      <li class="active"><a data-toggle="tab" role="tab" href="#description">description</a></li>
      <li class=""><a data-toggle="tab" role="tab" href="#reviews">Review</a></li>
      <li class=""><a data-toggle="tab" role="tab" href="#dimensions">dimensions</a></li>
      <li class=""><a data-toggle="tab" role="tab" href="#order">Order Now</a></li>      
    </ul>
    
    <div class="tab-content" id="myTabContent">
        
        
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
      <div id="description" class="tab-pane fade active in">
        <p>Product Owner: <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/owner/<?php echo $product->user_id; ?>"><?php echo $product->user->fname.' '.$product->user->lname; ?> </a></p>
        <p><?= $product->description; ?></p>
      </div>
      
      <div class="tab-pane fade" id="reviews">
<p class="prod_desc">
     <?php
                            foreach ($revs as $rev) {
                                $user = User::model()->findByAttributes(array('id' => $rev->user_id));
                                ?>
    
                                   <div class="one_review">
                                        <div class="col-xs-2">
                                            <div class="rev_user_img">
                                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/members/<?= $user->image; ?>"/>
                                            </div>
                                            <a class="rev_username" href="#"><?= $user->username; ?></a>
                                        </div>
                                        <div class="col-xs-10">
                                        	<div class="review_box">
                                            	<p class="rev_txt"><?= $rev->comment; ?></p>
                                                
                                                <p class="rev_date"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/decor/calendar_icon.png"/>
                                                <span><?= $rev->comment_date;?></span>
                                                </p>
                                                
                                                <div class=" pull-right">
    <input id="input-21e" value="<?= $rev->rate; ?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs">
    </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                  <?php } ?>








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


<?php echo CHtml::submitButton('Add', array('class' => 'btn review-bt pull-right')); ?>
<?php $this->endWidget(); ?>

                        </div>
                        <button class="btn review-bt pull-left" data-target="#add-review" data-toggle="collapse">Add your review</button>                    </p>
                   
</div>
      
      <div id="dimensions" class="tab-pane fade">
        <dl class="dl-horizontal">
          <dt class="">Dimensions:</dt>
          <dd><?= $productdetails->dimensions;?></dd>
          
        </dl>
      </div>
      
  <div id="order" class="tab-pane fade">
            <div class="main_item_specs">
                    <?php
                    if ($product->quantity > 0) {
                        $shippings = ShippingValue::model()->findAllByAttributes(array('user_id' => $product->user_id));
                        if (!empty($shippings)) {
                            ?>
                            <form class="form-horizontal" role="form" method="post" action="<?php echo Yii::app()->getBaseUrl(true); ?>/home/addtocart">
                               

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
                                        <select class="form-control item_select" id="shipping_id" name=""  required="required">
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
                                            <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/decor/cart-icon.png" />
                                            Add To Cart</button>
                                    </div>
                                </div>
                            </form>
                        <?php } else echo "shipping address of these product not determined";
                    }else {
                        echo "these product out of stock";
                    } ?>
                </div>
      </div>     
    </div>
    
   

</div><!--end tabs-->


</div><!--end latest-design-->
</div>
</div>









</div>
</div>
