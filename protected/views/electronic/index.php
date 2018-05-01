<div class="row"> 
    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 contents pull-left">
        <div class="slideshow">
            <div id="carousel" class="carousel slide animated pulse" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php
                    if ($slides) {
                        foreach ($slides as $i => $slide) {
                            $class = 'item';
                            if ($i == 0) {
                                $class = 'item active';
                            }
                            if ($slide->link) {
                                $link = $slide->link;
                            } else {
                                $link = Yii::app()->request->baseUrl . '/' . $controller . '/item?id=' . $slide->product_id;
                            }
                            echo '<div class="' . $class . '">
                                    <a href="' . $link . '"><img src="' . Yii::app()->request->baseUrl . '/media/categoryslider/' . $slide->image . '" alt="..."></a>
                                </div>';
                        }
                    }
                    ?>

                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="product-content">
            <h1 class="product-address">
                <label>Hot Deals</label>
            </h1>

            <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
                <div class="cbp-vm-options">
                    <a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Grid View</a>
                    <a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">List View</a>
                </div>
                <ul>
                    <?php foreach ($deals as $deal) { ?>
                        <li>
                            <div class="product-block wp4">
                                <a class="cbp-vm-image" href="<?php echo Yii::app()->getBaseUrl(true); ?>/electronic/details?pro_id=<?= $deal->id; ?>"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $deal->main_image; ?>" /></a>
                                <a class="cbp-vm-add" href="<?php echo Yii::app()->getBaseUrl(true); ?>/electronic/details?pro_id=<?= $deal->id; ?>">
                                    <span class="boot-tooltip">
                                        <i data-toggle="tooltip" data-original-title="Add to Cart" class="fa fa-shopping-cart wp2"></i>
                                    </span>
                                </a>
                                <div class="clearfix"></div>
                                <h3 class="cbp-vm-title"><?php echo $deal->title; ?></h3>
                                <div class="cbp-vm-price"><?php echo $deal->price; ?> GBP</div> 
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="product-content">

            <h1 class="product-address">
                <label>Featured Products</label>
            </h1>

            <div id="cbp-vm2" class="cbp-vm-switcher cbp-vm-view-grid">
                <div class="cbp-vm-options">
                    <a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Grid View</a>
                    <a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">List View</a>
                </div>
                <ul>
                    <?php foreach ($features as $feature) { ?>
                        <li>
                            <div class="product-block wp6">
                                <a class="cbp-vm-image" href="<?php echo Yii::app()->getBaseUrl(true); ?>/electronic/details?pro_id=<?= $feature->id; ?>">
                                <?php if($model->flag != 1){ ?>   
                                    <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $feature->main_image; ?>" alt="">
                                <?php }else{
                                 ?>
                            <img src="<?php echo $feature->main_image; ?>" alt="">        
                                    <?php
                                } ?>
                                </a>
                                <a class="cbp-vm-add" href="<?php echo Yii::app()->getBaseUrl(true); ?>/electronic/details?pro_id=<?= $feature->id; ?>">
                                    <span class="boot-tooltip">
                                        <i data-toggle="tooltip" data-original-title="Add to Cart" class="fa fa-shopping-cart wp2"></i>
                                    </span>
                                </a>
                                <div class="clearfix"></div>
                                <h3 class="cbp-vm-title"><?php echo Helper::limit_words($feature->title , 10); ?></h3>
                                <div class="cbp-vm-price"><?= $feature->price; ?> GBP</div> 
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>



    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pull-right side-menu">
        <?php
        $i = 1;
        foreach ($ads as $ad) {
            if ($i == 1) {
                $ad_one = $ad;
                if ($ad_one->link) {
                    $link_one = $ad_one->link;
                } else {
                    $link_one = Yii::app()->getBaseUrl(true) . '/electronic/details?pro_id=' . $ad_one->id;
                }
            } else {
                $ad_two = $ad;
                if ($ad_two->link) {
                    $link_two = $ad_two->link;
                } else {
                    $link_two = Yii::app()->getBaseUrl(true) . '/electronic/details?pro_id=' . $ad_two->id;
                }
            }
            $i++;
        }
        $j = 1;
        foreach ($specialoffers as $offer) {
            if ($j == 1) {
                $offer_one = $offer;
            } else {
                $offer_two = $offer;
            }
            $j++;
        }
        ?>
        <div class="wrap-thin demo-thin wp4">
            <div class="viewport">
                <a href="<?php echo $link_one; ?>"> 
                    <span class="dark-background"><?= $ad_one->title; ?><em><?= $ad_one->description; ?></em></span>
                    <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/ads/<?= $ad_one->image; ?>" alt="iphone" />
                </a> 
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="offer wp6">
            <h1><?php echo $offer_one->title; ?></h1>
            <h3><?php echo $offer_one->old_price; ?></h3>
            <h3><?php echo $offer_one->description; ?></h3>
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/electronic/details?pro_id=<?php echo $offer_one->id; ?>"><img class="zoom_01" src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $offer_one->main_image; ?>" data-zoom-image="<?php echo Yii::app()->getBaseUrl(true); ?>/image/electronic/offer.jpg"/></a>
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/electronic/details?pro_id=<?php echo $offer_one->id; ?>" class="shop-now">shop now !</a>
        </div>

        <div class="clearfix"></div>

        <div class="wrap-thin demo-thin wp4">
            <div class="viewport"> 
                <a href="<?php echo $link_two; ?>"> 
                    <span class="dark-background"><?= $ad_two->title; ?><em><?= $ad_two->description; ?></em></span>
                    <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/ads/<?php echo $ad_two->image; ?>" alt="iphone" />
                </a> 
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="offer wp6">
            <h1><?= $offer_two->title; ?></h1>
            <h3><?php echo $offer_two->old_price; ?></h3>
            <h3><?= $offer_two->description; ?></h3>
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/electronic/details?pro_id=<?php echo $offer_two->id; ?>"><img class="zoom_01" src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $offer_two->main_image; ?>" data-zoom-image="<?php echo Yii::app()->getBaseUrl(true); ?>image/electronic/offer.jpg"/></a>
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/electronic/details?pro_id=<?php echo $offer_two->id; ?>" class="shop-now">shop now !</a>
        </div>
    </div>
</div>

<!-- container end -->