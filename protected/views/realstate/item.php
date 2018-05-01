<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>

<blockquote class="col-md-12 search-mrg">
    <p><?= $product->title ?></p>
</blockquote>
<div class="col-md-6 slider-tabs">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#images" role="tab" data-toggle="tab">Images</a></li>

    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade in active" id="images">
            <!-- main slider carousel -->

            <?php
            $xml_gallery = XmlGallery::model()->findAll("product_id = $product->id");
            if($product->flag != 1){
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
            <?php  }elseif($product->flag == 1 and $xml_gallery !=null) { 
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
                    
            <?php }else{
                ?>
                   
            <img id="zoom_03" class="slider-zoom" src="<?php echo $product->thumb ?>" data-zoom-image="<?php echo $product->main_image ?>"/>         
                    <?php
            } ?>
        </div>

    </div>
</div>

<div class="col-md-6 details-tabs">
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
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="#book" role="tab" data-toggle="tab">Book Now</a></li>
        <li><a href="#reviews" role="tab" data-toggle="tab">Reviews</a></li>
        <li><a href="#map" role="tab" data-toggle="tab">Show On Map</a></li>

        <li class="active"><a href="#details" role="tab" data-toggle="tab">Details</a></li>

    </ul>
    <div class="tab-content">
        <?php if($product->flag != 1){ ?>
        <div class="tab-pane fade" id="book">
            <?php if (!empty(Yii::app()->user->id)) { ?>
                please fill the below forms and submit, to send your order to the owner.

                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'fff',
                    'enableAjaxValidation' => false,
                    'type' => 'vertical',
                    'htmlOptions' => array('class' => '', 'enctype' => 'multipart/form-data'
                    ),
                ));
                ?> 

                <?php echo $form->textArea($message, 'details', array('class' => '', 'rows' => '3')); ?>
                <div class="control-group">
                    <label for="blog_date" class="control-label">Booking Date</label>

                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'message_date',
                        'attribute' => 'message_date',
                        'model' => $message,
                        'options' => array(
                            'dateFormat' => 'yy-mm-d',
                            'altFormat' => 'yy-mm-d',
                            'minDate' => date('Y-m-d'),
                            'changeMonth' => true,
                            'changeYear' => true,
                        //'appendText' => 'yyyy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'size' => '8',
                            'readonly' => true,
                            'id' => 'cin',
                            'style' => 'cursor:pointer;'
                        ),
                    ));
                    ?>
                    <span class="glyphicon glyphicon-calendar"></span>

                </div>


                <?php echo CHtml::submitButton('Add', array('class' => 'btn btn-success pull-right')); ?>
                <?php $this->endWidget(); ?>

            <?php
            } else{
                echo 'Please Login first or create your account';
            }
            ?>

        </div>
        
          <?php }else{
                ?>
                
        <div class="tab-pane fade" id="book">
            
            <a href="<?php if($product->url !=''){ echo $product->url;}else{ echo "#";} ?>" target="_blank" class="btn btn-success pull-right">Book Now</a>
        </div>
                <?php
            } ?>
        <div class="tab-pane fade" id="reviews">
            <p class="prod_desc">
                <?php
                foreach ($revs as $rev) {
                    $user = User::model()->findByAttributes(array('id' => $rev->user_id));
                    ?>


                <div class="one_review">
                    <div class="col-xs-2">
                        <div class="rev_user_img">
                            <img src="<?= Yii::app()->request->baseUrl; ?>/media/members/<?= $user->image ?>"/>
                        </div>
                        <a class="rev_username" href="#"><?= $user->username ?></a>
                    </div>
                    <div class="col-xs-10">
                        <div class="review_box">
                            <p class="rev_txt"><?= $rev->comment ?></p>

                            <p class="rev_date"><img src="<?= Yii::app()->request->baseUrl; ?>/img/realstate/calendar_icon.png"/>
                                <span><?= $rev->comment_date ?></span>
                            </p>
                            <div class=" pull-right">
                                <input id="input-21e" value="<?= $rev->rate ?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs">
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


                <?php echo CHtml::submitButton('Add', array('class' => 'btn review-bt pull-left')); ?>
<?php $this->endWidget(); ?>

            </div>
            <button class="btn btn-success pull-right" data-target="#add-review" data-toggle="collapse">Add your review</button>                    </p>


        </div>



        <div class="tab-pane fade in active" id="details">
            <div class="details">
                <p><i class="fa fa-globe"></i>Product Owner: <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/owner/<?php echo $product->user_id; ?>"><?php echo $product->user->fname . ' ' . $product->user->lname; ?> </a></p>
                <p><i class="fa fa-globe"></i>Place name:<?= $product->title ?></p>
                <p><i class="fa fa-map-marker"></i>Country: <?= $proddet->country->title ?></p>
                <p><i class="fa fa-tag"></i>City: <?= $proddet->city->title ?></p>


            </div>

            <div class="details">
                <h5 class="title">Description:</h5>
                <h6><?= $product->description ?></h6>
            </div>
            <div class="details">
                <h5 class="title">Facilities:</h5>
                <h6><?php
                    echo $proddet->real_estate_facilities;
                    ?></h6>
            </div>

        </div>




        <div class="tab-pane" id="map">
                        <div style="width:302px;height:352px"><iframe width="500" height="352" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=<?php echo str_replace(" ", "%2B", $proddetails->address); ?>&ie=UTF8&z=12&t=m&iwloc=near&output=embed"></iframe><br><table width="302" cellpadding="0" cellspacing="0" border="0"><tr><td align="left"><!-- <small><a href="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=Keighley%2BWest%2BYorkshire&ie=UTF8&z=12&t=m&iwloc=near">View Larger Map</a></small></td><td align="right"><small>--></td></tr></table></div>
        </div>

    </div>

</div>

<div class="col-md-12 likes_slider">
    <div class="sections_title"><h3>Recommended Places</h3></div>


    <div id="carousel-example-generic2" class="carousel slide animated fadeInUp new_arriv_slider" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner">


            <div class="item active">
                <?php
                $s = 1;
                foreach ($arrivls as $arrivl) {
                    if ($s == 5) {
                        $s = 1;
                        ?>
                    </div>
                    <div class="item">
                        <?php
                    }
                    ?>

                    <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                        <a href="<?= Yii::app()->request->baseUrl; ?>/realstate/item/id/<?= $arrivl->id ?>" class="new_arr_item">
                            <div class="item_img">
                                <?php if($arrivl->flag !=1){?>
                                 <img src="<?= Yii::app()->request->baseUrl; ?>/media/product/<?= $arrivl->main_image ?>"/>

                               <?php }else{   ?>
                       <img src="<?= $arrivl->main_image ?>"/>
           
                                 <?php
                               } ?>
                            </div>
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
            <img src="<?= Yii::app()->request->baseUrl; ?>/img/realstate/left_arrow.png"/>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic2" role="button" data-slide="next">
            <img src="<?= Yii::app()->request->baseUrl; ?>/img/realstate/right_arrow.png"/>
        </a>
    </div>
</div>

</div>
</div>
