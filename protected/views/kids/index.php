</div>
</div>
<?php
$this->renderPartial("top_menu");
?>
<div class="container">
    <div class="wrap">
        <div class="all-content col-md-12 col-xs-12">
                <div class="col-md-12 col-xs-12 main-slider">
                <div id="carousel" class="carousel slide animated pulse" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php
                        $k = 0;
                        foreach($sliders as $icon){
                            if($k == 0){ ?>
                                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                            <?php
                           }else{ ?>
                                <li data-target="#carousel" data-slide-to="<?php echo $k; ?>"></li>
                           <?php
                            } 
                            $k++;
                        }
                        ?>
                    </ol>

                  <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php
                    
                        foreach($sliders as $slider){
                            
                           
            if ($i == 0) {
                $class = "active";
            } else{
                $class = "";
            }
            
           
     if (!empty($slider->link)) {
                                $link = $slider->link;
                            } else {
                                $link = Yii::app()->request->baseUrl . '/' . 'Kids' . '/details/'.  $slider->product_id;
                            }
 
                            
                          ?>
                                <div class="item <?php  echo $class; ?>">
                                    <a href="<?php echo $slider->link; ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/media/categoryslider/<?php echo $slider->image; ?>" alt="..."></a>
<!--                                    <div class="carousel-caption">
                                    <a href="<?php echo $link; ?>"><p class="slider_title"><?php  echo $slider->title;?></p>
                                    <p class="slider_sub_text"><?php echo $slider->description; ?> </p>
                                    </a>
                                        <a class="btn btn-default" href="<?php echo $slider->link; ?>">shop now !</a>
                                    </div>-->
                                </div>
                           
                        
                        <?php 
                            $i++;
                        }
                        ?>
                    </div>

<!--                  <a data-slide="prev" role="button" href="#carousel-example-generic" class="left carousel-control">
                <i class="fa fa-chevron-left"></i>
              </a>

              <a data-slide="next" role="button" href="#carousel-example-generic" class="right carousel-control">
                <i class="fa fa-chevron-right"></i>
              </a>-->
                </div>
            </div><!--end main-slider-->

    <div class="row ads">
    <?php if($ads){
     foreach ($ads as $ad){
             if($ad->product_id !=null){
                   $link = Yii::app()->getBaseUrl(true)."/kids/details?pro_id=$ad->product_id";
               }else{
                   $link = $ad->link;
               }
         ?>
    <a href="<?= $link ?>" class="col-md-3"><img src="<?php echo Yii::app()->request->baseUrl ."/media/ads/$ad->image"?>"></a>
        
    <?php
     }
    } ?>
      
        </div>


            <div class="col-md-11 col-md-offset-1 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 offers animated wp4">
            <div class="col-md-2 col-xs-2 car-img"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/car.png" alt="" /></div>
            <div class="col-md-2 col-xs-2 block1">
            <p>70000 + baby & kids products</p>
            </div>
            <div class="col-md-2 col-xs-2 block2"> <p>400 + brands</p></div>
            <div class="col-md-2 col-xs-2 block3"> <p>happy customers</p></div>
            <div class="col-md-3 col-xs-3 block4"> <p>easy return policy</p></div>
            </div><!--end offers-->

           <div class="col-md-12 col-xs-12 shop-blocks">

                <div class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0 animated wp2">
                <div class="shops">
                <div class="shop-img">
                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/shop1.jpg">
                </div>
                <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/types?type=0" class="shop-link">shop now !</a>
                <p class="title-shop shop1">baby</p>
                </div>

            </div>

            <div class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0 animated wp2">
                <div class="shops">
                <div class="shop-img">
                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/shop2.jpg">
                </div>
                <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/types?type=1" class="shop-link">shop now !</a>
                <p class="title-shop shop2">kids</p>

                </div>
            </div>

            <div class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0 animated wp2">
                <div class="shops">
                <div class="shop-img">
                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/shop3.jpg">
                </div>
                <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/types?type=2" class="shop-link">shop now !</a>
                <p class="title-shop shop3">moms & maternity</p>
                </div>
            </div>


           </div><!--end shop-blocks--> 

           <div class="col-md-12 col-xs-12">
           <div class="headtitle"></div>
           </div>

           <div class="col-md-2 col-sm-3 col-xs-12 slide-title "> 
            <div class="title1">
                <span>fashion</span>
            </div>
            </div>
            <?php
            if($fashions){
            ?>
                <div class="col-md-12 col-xs-12">
                    <div id="carousel-example-generic1" class="carousel slide animated fadeInUp new_arriv_slider" data-ride="carousel">
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
                            $j = 1;
                            foreach($fashions as $fashion){
                                if($j == 5){
                                    $j = 1;
                                    ?>
                                    </div>
                                    <div class="item">
                               <?php
                                }
                                ?>
                                <div class="col-md-3 col-sm-3 col-xs-6 text-center">
                                        <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/details?pro_id=<?php echo $fashion->product->id; ?>" class="new_arr_item">
                                        <div class="item_img">
                                            <?php if($fashion->flag !=1){ ?>
                                            <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $fashion->product->main_image ?>"/>
                                            <?php }else{
                                                ?>
                                            <img src="<?php echo $fashion->main_image ?>"/>
                                            <?php
                                            } ?>
                                        </div>
                                        <p class="item_name"><?php echo $fashion->product->title; ?></p>
                                        <p class="new_arr_price"><?php echo $fashion->product->price; ?> GBP</p>
                                    </a>
                                </div>
                            <?php
                            $j++;
                            }
                            ?>
                                    </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic1" role="button" data-slide="prev">
                            <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/left_arrow2.png"/>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic1" role="button" data-slide="next">
                            <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/right_arrow2.png"/>
                        </a>
                    </div>
                </div>
            <?php
            }else{ ?>
                <div class="nofound">
                    <div class="alert alert-danger">
                    <p>No products found</p>
                    </div>
               </div>
            <?php
            }
            ?>
            <div class="col-md-12 col-xs-12">
                <div class="headtitle"></div>
           </div>

            <div class="col-md-2 col-sm-3 col-xs-12 slide-title "> 
            <div class="title2">
                <span>entertainment</span>
            </div>
            </div>
           <?php
            if($entertainments){
           ?>
           <div class="col-md-12 col-xs-12"> 

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

                                    $s = 1;
                                    foreach ($entertainments as $entertainment){ 
                                        if($s == 5){
                                            $s = 1;
                                            ?>
                                            </div>
                                            <div class="item">
                                        <?php
                                        }
                                        ?>
                                        <div class="col-md-3 col-sm-3 col-xs-6 text-center">
                                            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/details?pro_id=<?php echo $entertainment->product->id; ?>" class="new_arr_item">
                                                <div class="item_img">
                                                    <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $entertainment->product->main_image; ?>"/>
                                                </div>
                                                <p class="item_name"><?php echo $entertainment->product->title; ?></p>
                                                <p class="new_arr_price"><?php echo $entertainment->product->price; ?> GBP</p>
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
                                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/left_arrow2.png"/>
                          </a>
                          <a class="right carousel-control" href="#carousel-example-generic2" role="button" data-slide="next">
                                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/right_arrow2.png"/>
                          </a>
                        </div>
            </div>
           <?php
           }else{ ?>
               <div class="nofound">
                <div class="alert alert-danger">
                <p>No products found</p>
                </div>
               </div>
           <?php
           }
           ?>

            <div class="col-md-12 col-xs-12">
               <div class="headtitle"></div>
               </div>

           <div class="col-md-2 col-sm-3 col-xs-12 slide-title "> 
            <div class="title3">
                <span>nursery & gear</span>
            </div>
            </div>
            <?php
            if($gears){
            ?>
            <div class="col-md-12 col-xs-12"> 
                <div id="carousel-example-generic3" class="carousel slide animated fadeInUp new_arriv_slider" data-ride="carousel">
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
                            $m = 1;
                            foreach ($gears as $gear){
                                if($m == 5){
                                    $m = 1;
                                    ?>
                                    </div>
                                    <div class="item">
                                <?php
                                }
                                ?>
                                <div class="col-md-3 col-sm-3 col-xs-6 text-center">
                                    <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/details?pro_id=<?php echo $gear->product->id; ?>" class="new_arr_item">
                                        <div class="item_img">
                                            <?php if($gear->flag != 1){ ?>
                                            <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $gear->product->main_image; ?>"/>
                                            <?php }else{
                                                ?>
                                             <img src="<?php echo $gear->main_image ?>"/>
                                            <?php
                                            } ?>
                                        </div>
                                        <p class="item_name"><?php echo $gear->product->title; ?></p>
                                        <p class="new_arr_price"><?php echo $gear->product->price; ?> GBP</p>
                                    </a>
                                </div>    
                            <?php
                            $m++;
                            }
                            ?>      
                        </div>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic3" role="button" data-slide="prev">
                          <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/left_arrow2.png"/>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic3" role="button" data-slide="next">
                          <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/right_arrow2.png"/>
                    </a>
                </div>
            </div>
           <?php
            }else{ ?>
                <div class="nofound">
                    <div class="alert alert-danger">
                    <p>No products found</p>
                    </div>
               </div>
           <?php
           }
           ?>

        </div>    
    </div>
</div>

<div class="container">
<div class="wrap">

</div>
</div>

</div>
</div>

