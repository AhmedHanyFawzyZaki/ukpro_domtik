

<div class="col-md-12">
                    	<ul class="page_path wp4 delay-05s">
                        	<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths">Clothes & Accessories</a>  >></li>
                             <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/subcategory/id/<?php  echo $sub->id;?>"><?php echo $sub->title; ?></a>  >></li>
                             <li class="active"><a href="#"><?php echo $product->title; ?></a></li>
                             
                        </ul>
                    </div>
<div class="col-md-12">
    <div class="col-md-6">


        <!-- main slider carousel -->
        <div class="row">
            
            <div class="col-md-12" id="slider">

                <div class="col-md-12" id="carousel-bounding-box">
                    <div id="myCarousel" class="carousel slide">
                        <!-- main slider carousel items -->
                        <div class="carousel-inner">
                            <?php
                            $i = 0;

                            foreach ($photos as $photo) {
                                if ($i == 0) {
                                    $class = 'active';
                                } else {
                                    $class = '';
                                }
                                ?>

                                <div class="<?php echo $class; ?>  item" data-slide-number="<?php echo $i; ?>">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/gallery/<?php echo $photo->rank; ?>medium.jpg" class="img-responsive">
                                </div>
    <?php $i++;
} ?>
                        </div>

                        <!-- main slider carousel nav controls --> <a class="carousel-control left" href="#myCarousel" data-slide="prev">‹</a>

                        <a class="carousel-control right" href="#myCarousel" data-slide="next">›</a>
                    </div>
                </div>

            </div>
        </div>

        <!-- thumb navigation carousel -->
        <div class="col-md-12 hidden-sm hidden-xs" id="slider-thumbs">

            <!-- thumb navigation carousel items -->
            <ul class="list-inline">

                <?php
                $i = 0;
                foreach ($photos as $photo) {
                    ?>
                    <li class="col-md-2 col-xs-6 text-center item_page_img2"><a id="carousel-selector-<?php echo $i; ?>" class="selected ">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/gallery/<?php echo $photo->rank; ?>medium.jpg" class="img-responsive">
                        </a></li>

    <?php $i++;
} ?>

            </ul>

        </div>

        <script>
            $('#myCarousel').carousel({
                interval: 4000
            });

    // handles the carousel thumbnails
            $('[id^=carousel-selector-]').click(function() {
                var id_selector = $(this).attr("id");
                var id = id_selector.substr(id_selector.length - 1);
                id = parseInt(id);
                $('#myCarousel').carousel(id);
                $('[id^=carousel-selector-]').removeClass('selected');
                $(this).addClass('selected');
            });

    // when the carousel slides, auto update
            $('#myCarousel').on('slid', function(e) {
                var id = $('.item.active').data('slide-number');
                id = parseInt(id);
                $('[id^=carousel-selector-]').removeClass('selected');
                $('[id^=carousel-selector-' + id + ']').addClass('selected');
            });
        </script>

        <!--/main slider carousel-->
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
    }elseif(Yii::app()->user->hasFlash('update-error')){
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

                
               <form class="form-horizontal" role="form">
                              <div class="form-group">
                                <label class="col-sm-2 control-label item_specs_lbl wp4 delay-05s">Color</label>
                                <div class="col-sm-10">
                                  <select class="form-control item_select">
                                      <option></option>
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                  </select>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="col-sm-2 control-label item_specs_lbl wp4 delay-07s">Size</label>
                                <div class="col-sm-10">
                                  <select class="form-control item_select">
                                  	  <option></option>
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                  </select>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="col-sm-2 control-label item_specs_lbl wp4 delay-09s">Quantity</label>
                                <div class="col-sm-10">
                                  <select class="form-control item_select">
                                  	  <option></option>
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                  </select>
                                </div>
                              </div>
                              
                              
                              
                              
                              <div class="form-group wp4 delay-1s">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/cart?id=<?=$product->id?>&action=add&cat_id=1&quantity=2" class="btn item_specs_btn">
                                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/cloths/add_to_cart.png" />
                                  Add To Cart</a>
                                    
                                </div>
                              </div>
                            </form>
        </div>

        <div class="prod_collapse">
            <a href="#" data-toggle="collapse" data-target="#item_desc" class="coll_title">
                Product description
            </a>

            <div id="item_desc" class="collapse">
                <p class="prod_desc wp4 delay-05s"><?php echo $product->description; ?></p>
            </div>

        </div>
        <div class="prod_collapse">
            <a href="#" data-toggle="collapse" data-target="#item_rev" class="coll_title">Reviews</a>
            <div id="item_rev" class="collapse">
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
                    <div class="col-md-offset-3 col-md-6 col-sm-6 col-sm-offset-6 col-xs-12 col-xs-offset-0">
<?php echo CHtml::submitButton('Add your review', array('class' => 'btn add-review-link', 'data-toggle' => 'collapse', 'data-target' => '#add-review')); ?>
                    </div>
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


            <?php
            $i = 0;
            foreach ($likes as $like) {

                if ($i == 0) {
                    $class = 'active';
                } else {
                    $class = '';
                }
                if ($i == 0 or $i % 4 == 0) {
                    echo '<div class="item ' . $class . '">';
                }
                ?>
                <div class="col-md-3 col-xs-6 text-center">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/cloths/item/id/<?php echo $like->id; ?>" class="new_arr_item">
                        <div class="item_img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $like->main_image; ?>"/></div>
                        <p class="item_name"><?php echo $like->title; ?></p>
                        <p class="new_arr_price"><?php echo $like->price; ?></p>
                    </a>

                </div>




                <?php
                if ($i != 0) {
                    if ($i % 3 == 0 or $i == $count - 1) {
                        echo '</div>';
                    }
                }

                $i++;
            }
            ?>



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


</div>
</div>