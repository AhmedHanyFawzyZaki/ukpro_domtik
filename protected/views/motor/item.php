</div>
</div>
<?php
$controller = Yii::app()->controller->id;
?>

<div class="container">
    <div class="wrap">

        <div class="col-md-12 col-xs-12 search animated pulse">
            <p class="form-title">find the car you want now</p>
            <form class="form-horizontal search-form" role="form" method="post" action="<?php echo Yii::app()->getBaseUrl(true) . '/' . $controller; ?>/search">
                <?php // $makn=$_REQUEST['Search']['make'];?>
                <div class="form-group">

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <select class="form-control" name="Search[make]" id="makee" onchange="calldropdown()">

                            <option value=""> Make(any)</option>

                            <?php
                            if ($makes) {
                                foreach ($makes as $make) {


                                    if ($make->id == $mak) {

                                        $selected = 'selected';
                                    } else {

                                        $selected = '';
                                    }
                                    ?>
                                    <option  value="<?php echo $make->id; ?> "   <?php echo $selected ?> ><?php echo $make->title; ?></option>
                                    <?php
                                }
                            }
                            ?>

                        </select>

                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12" id='makemodel'>
                        <select class="form-control" name="Search[model]">
                            <option value=""> Model(any)</option>
                            <?php
                            //if (isset($_POST['mks'])) {
                            //echo "test";die;
                            // $motormodls=  MotorModel::model()->findAll();

                            $motormodls = MotorModel::model()->findAll();
                            //print_r($motormodls);
                            /// } else {
                            // $motormodls = $motormodels;
                            //   }


                            if ($motormodls) {
                                foreach ($motormodls as $motormodel) {


                                    if ($motormodel->id == $mod) {

                                        $selected = 'selected';
                                    } else {

                                        $selected = '';
                                    }
                                    ?>
                                    <option value="<?php echo $motormodel->id; ?>   " <?= $selected ?>><?php echo $motormodel->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>



                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input type="text" name="Search[min_price]" placeholder="Min Price"  id="inputEmail3" class="form-control" value="<?php echo $nprice; ?>">
                    </div>

                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input type="text" name="Search[max_price]" placeholder="Max Price" id="inputEmail3" class="form-control" value="<?php echo $xprice; ?>">
                    </div>


                    <a href="#" class=" col-md-2 col-sm-6 col-xs-12 collapsed more-options " data-toggle="collapse" data-target="#srch-select">more options</a>


                </div>



                <div class="collapse" id="srch-select">

                    <div class="form-group">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control" name="Search[gas]">
                                <option value=""> Gas(any)</option>
                                <?php
                                if ($gass) {
                                    foreach ($gass as $ga) {

                                        if ($ga->id == $gas) {

                                            $selected = 'selected';
                                        } else {

                                            $selected = '';
                                        }
                                        ?>
                                        <option value="<?php echo $ga->id; ?>" <?= $selected ?>><?php echo $ga->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                <option value="">Unlisted</option>
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control" name="Search[door]">
                                <option value=""> Doors(any)</option>
                                <?php
                                if ($doors) {
                                    foreach ($doors as $door) {


                                        if ($door->id == $dor) {

                                            $selected = 'selected';
                                        } else {

                                            $selected = '';
                                        }
                                        ?>
                                        <option value="<?php echo $door->id; ?>" <?= $selected ?>><?php echo $door->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                <option value="">Unlisted</option>
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control" name="Search[kmage]">
                                <option value=""> Kmages(any)</option>
                                <?php
                                if ($kmages) {
                                    foreach ($kmages as $kmage) {

                                        if ($kmage->id == $mage) {

                                            $selected = 'selected';
                                        } else {

                                            $selected = '';
                                        }
                                        ?>
                                        <option value="<?php echo $kmage->id; ?>" <?= $selected ?>><?php echo $kmage->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                <option value="">Unlisted</option>
                            </select>
                        </div>
                    </div>






                    <div class="form-group">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control" name="Search[age]">
                                <option value=""> Ages(any)</option>
                                <?php
                                if ($ages) {
                                    foreach ($ages as $age) {
                                        if ($age->id == $ge) {

                                            $selected = 'selected';
                                        } else {

                                            $selected = '';
                                        }
                                        ?>
                                        <option value="<?php echo $age->id; ?>" <?= $selected ?>><?php echo $age->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control" name="Search[emission]">
                                <option value="">emissions(any)</option>
                                <?php
                                if ($emissions) {
                                    foreach ($emissions as $emission) {
                                        if ($emission->id == $emiss) {

                                            $selected = 'selected';
                                        } else {

                                            $selected = '';
                                        }
                                        ?>
                                        <option value="<?php echo $emission->id; ?>" <?= $selected ?>><?php echo $emission->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                <option value="">Unlisted</option>
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control" name="Search[engine]">
                                <option value="">engines(any)</option>
                                <?php
                                if ($engines) {
                                    foreach ($engines as $engine) {

                                        if ($engine->id == $eng) {

                                            $selected = 'selected';
                                        } else {

                                            $selected = '';
                                        }
                                        ?>
                                        <option value="<?php echo $engine->id; ?> <?= $selected ?>"><?php echo $engine->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                <option value="">Unlisted</option>
                            </select>
                        </div>


                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">

                        <div class="form-group">
                            <select class="form-control" name="Search[power_engine]">
                                <option value="">Select power engines...</option>
                                <option value="1">100cv</option>
                                <option value="2">200cv</option>

                            </select>
                        </div>  
                    </div>
                    <br/><br/>
                    <div class="col-md-6 col-xs-6">
                        <label class="col-md-4 col-sm-4 col-xs-12 control-label "  style="text-align:left !important;">Motor Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px !important;">
                            <label class=" " >
                                <input type="checkBox" name="Search[motor_status1]" value="1"  <?php
                                if (!empty($mot_1)) {
                                    echo "checked";
                                }
                                ?> >
                                Used
                            </label>   
                            <label class=" " >
                                <input type="checkBox" name="Search[motor_status2]" value="2" <?php
                                if (!empty($mot_2)) {
                                    echo "checked";
                                }
                                ?>>
                                Nearly New  
                            </label>      
                            <label class=" " >      
                                <input type="checkBox" name="Search[motor_status3]" value="3" <?php
                                if (!empty($mot_3)) {
                                    echo "checked";
                                }
                                ?>>
                                New</label>  
                        </div>

                    </div>
                </div>

                <div class="form-group">

                    <div class="col-md-12 col-xs-12">




                        <div class="col-md-6 col-xs-6">

                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <button class="btn btn-default search-bt" type="submit">search</button>
                            </div>

                        </div>

                    </div>



                </div>



            </form>

        </div><!--end search-->

    </div>
</div>


<div class="container">
    <div class="wrap">
        <div class="row">

            <div class="col-md-5 zoom-slider">
                <!-- main slider carousel -->

                <?php
                $xml_gallery = XmlGallery::model()->findAll("product_id = $product->id");
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
                <?php }}elseif($product->flag == 1 and $xml_gallery !=null){
                   
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
                } 
                }else{?>
                 <img id="zoom_03" class="slider-zoom" src="<?php echo $product->thumb ?>" data-zoom-image="<?php echo $product->main_image ?>"/>    
                <?php  } ?>
                <!--/main slider carousel-->
            </div>




            <div class="col-md-6 col-xs-12 details-info pull-right">

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

                <p class="info-title"><?= $product->title ?> <span><?= $product->price ?> GBP</span> </p>

                <p class="parag"><?php echo $product->description; ?></p>
                <?php $prodetails = ProductDetails::model()->findByAttributes(array('product_id' => $product->id)); ?>

                <dl class="dl-horizontal">
                    <dt>motor make:</dt>
                    <dd><?= $prodetails->make->title ?></dd>
                    <dt>motor model:</dt>
                    <dd><?= $prodetails->motorModel->title ?></dd>
                    <dt>motor condition:</dt>
                    <dd><?= $prodetails->conditions ?></dd>

                </dl>

                <div class="col-md-12 col-xs-12 order">
                    <?php if($product->flag != 1){ ?>
                    <button class="btn btn-default order-bt" type="button" data-toggle="collapse" data-target="#order">order now</button>
                    <?php }else{
                        ?>
                    <a class="btn btn-default order-bt" href="<?php if($product->url !=''){ echo $product->url;}else{ echo "#";} ?>" target="_balnk" >order now</a>
                    <?php
                    } ?>
                    <!--                    <a class="btn btn-default order-bt" href="#">order now</a>-->
                    <button class="btn btn-default review-bt" type="button" data-toggle="collapse" data-target="#reviews">reviews</button>

                    <div class="col-md-12 col-xs-12 panel-collapse collapse reviews" id="reviews">
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

                                        <p class="rev_date"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/motor/calendar_icon.png"/>
                                            <span><?php echo $review->comment_date; ?></span>
                                        </p>

                                        <div class=" pull-right">
                                            <input id="input-21e" value="<?php echo $review->rate; ?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs">
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
                        <button class="btn review-bt pull-right" data-toggle="collapse" data-target="#add-review">Add your review</button>
                        </p>



                    </div>
                    <div class="col-md-12 col-xs-12 panel-collapse collapse order" id="order">
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
                                <div class="control-group">
                                    <label for="blog_date" class="control-label">Enter your request</label>
                                    <?php echo $form->textArea($message, 'details', array('class' => 'form-control', 'rows' => '3')); ?>
                                </div>
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
                                            'size' => '16',
                                            'readonly' => true,
                                            'id' => 'cin',
                                            'style' => 'cursor:pointer;'
                                        ),
                                    ));
                                    ?>
                                    <span class="glyphicon glyphicon-calendar"></span>

                                </div>


                                <?php echo CHtml::submitButton('Add', array('class' => 'btn review-bt pull-left')); ?>
                                <?php $this->endWidget(); ?>

                            </div>

                            <button class="btn review-bt pull-right" data-toggle="collapse" data-target="#add-order">Order Now</button>

                        <?php } else echo 'Please Login first or create your account'; ?>
                        </p>


                    </div>

                </div>
            </div><!--end details-info-->



            <div class="col-md-12 col-xs-12 title2">you also may linke</div>
            <div class="col-md-12 col-xs-12 items animated wp2">
                <?php
                foreach ($arrivals as $product) {
                    $favs = count(Favourite::model()->findByAttributes("product_id = $product->id"));
                    $prodetails = ProductDetails::model()->findByAttributes(array('product_id' => $product->id));
                    ?>
                    <div href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="col-md-4 col-sm-4 col-xs-12 car-item">
                        <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="item-img">
                          <?php if($product->flag != 1){ ?>
                            <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>" alt="<?= $product->title ?>" />
                          <?php }else{
                              ?>
                        <img src="<?php echo $product->main_image ?>" alt="<?= $product->title ?>" />    
                            <?php
                          } ?>
                        </a>

                        <div class="col-md-11 col-xs-11 item-details">
                            <?php
                            if (!empty(Yii::app()->user->id)) {
                                $check = Helper::checkFav($product->id);
                                if ($check == 1) {
                                    ?>
                                    <a class="fav_star rate_solid"><div class="fav-number"><span><?php echo $favs ?></span></div></a>
                                <?php } else { ?>
                                    <a class="fav_star rate" href="<?php echo Yii::app()->getBaseUrl(true) . '/home/addFav/' . $product->id; ?>"><div class="fav-number"><span><?php echo $favs ?></span></div></a>
                                    <?php
                                }
                            } else {
                                ?>
                                <a data-target="#login-modal" data-toggle="modal" data-dismiss="modal" class="fav_star rate"></a>
                            <?php } ?>
                            <div class="col-md-12 col-xs-12 data">
                                <div class="col-md-6 col-xs-12 data2">
                                    <span><?= $product->title ?></span>
                                    <span><?= $prodetails->make->title ?></span>
                                    <span><?= $prodetails->motorModel->title ?></span>
                                </div>

                                <div class="col-md-5 col-xs-12 details-link">
                                    <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="btn btn-default" type="button">view details</a>
                                </div><!--end details-link-->
                            </div>
                        </div>
                    </div>
                <?php } ?>





            </div><!--end items-->

        </div>
    </div>
</div>




</div>
</div>

<script>
    function calldropdown() {
        var mks = document.getElementById("makee").selectedIndex;
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/index.php/motor/Getmodel?id=" + mks,
            success: function(data) {
                // $('#makemodel').val(data);
                document.getElementById('makemodel').innerHTML = data;
                // alert(mks);
            }
        }
        );

    }

</script>