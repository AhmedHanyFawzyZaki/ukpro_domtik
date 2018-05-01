</div>
</div>
<?php
$this->renderPartial("top_menu");
?>
<div class="container">
    <div class="wrap">
        <div class="all-content col-md-12 col-xs-12">
            
            <!--main-slider-->
            
<!--                <div class="col-md-12 col-xs-12 main-slider">
                <div id="carousel" class="carousel slide animated pulse" data-ride="carousel">
                   Indicators 
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

                   Wrapper for slides 
                  <div class="carousel-inner">
                      <?php
                        $z = 1;
                        foreach($sliders as $slider){
                            if($z == 1){ ?>
                                <div class="item active">
                                    <a href="<?php echo $slider->link; ?>"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/categoryslider/<?php echo $slider->image; ?>" alt="..."></a>
                                    <div class="carousel-caption">
                                        <a class="btn btn-default" href="<?php echo $slider->link; ?>">shop now !</a>
                                    </div>
                                </div>
                            <?php
                            }else{ ?>
                                <div class="item">
                                    <a href="<?php echo $slider->link; ?>"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/categoryslider/<?php echo $slider->image; ?>" alt="..."></a>
                                    <div class="carousel-caption">
                                        <a class="btn btn-default" href="<?php echo $slider->link; ?>">shop now !</a>
                                    </div>
                                </div>
                           <?php
                           }
                            ?>
                        <?php
                        $z++;
                        }
                        ?>
                  </div>

                  <a data-slide="prev" role="button" href="#carousel-example-generic" class="left carousel-control">
                <i class="fa fa-chevron-left"></i>
              </a>

              <a data-slide="next" role="button" href="#carousel-example-generic" class="right carousel-control">
                <i class="fa fa-chevron-right"></i>
              </a>
                </div>
            </div>-->
            
            <!--end main-slider-->

           <div class="col-md-3 col-sm-3 col-xs-12 slide-title "> 
            <div class="title3">
                <span><?php echo $type; ?></span>
            </div>
            </div>
            <?php
            if($products){
            ?>
            <div class="col-md-12 col-xs-12 product-row line">
            <?php 
            $i = 1;
            foreach ($products as $product){ 
                if($i == 5){
                    $i = 1;
                    ?>
                    </div>
                    <div class="col-md-12 col-xs-12 product-row">
                <?php
                }
                ?>
                 <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="products">
                        <a class="product-img" href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/details?pro_id=<?php echo $product->product->id; ?>"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $product->product->main_image; ?>"></a>
                        <span class="price"><?php echo $product->product->price; ?> GBP</span>
                        <span class="title"><?php echo $product->product->title; ?></span>
                        <span class="desc"><?php echo substr($product->product->description, 0,30); ?>...</span>
                        <span class="cart-btn">
                            <a class="add-cart" href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/details?pro_id=<?php echo $product->product->id; ?>"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/add-cart.png">Add to cart</a>
                        </span>
                    </div>
                </div>
            <?php
            $i++;
            }
            ?>
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
        <?php
            $this->widget('CLinkPager', array(
                'currentPage'=>$pages->getCurrentPage(),
                'itemCount'=>$item_count,
                'pageSize'=>$page_size,
                'maxButtonCount'=>5,
                'cssFile' => Yii::app()->theme->baseUrl . "/css/bootstrap.css",
                'firstPageLabel' => '&lt;&lt;',
                'prevPageLabel' => '&lt;',
                'nextPageLabel' => '&gt;',
                'lastPageLabel' => '&gt;&gt;',
                'header' => '',
                'htmlOptions' => array('class' => 'pagination pull-right', 'style' => 'margin-top:15px;'),
        ));
        ?>
        
    </div>    
</div>

<div class="container">
<div class="wrap">

</div>
</div>
</div>
</div>