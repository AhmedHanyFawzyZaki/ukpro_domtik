</div>
</div>
<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>

<div class="container">
    <div class="wrap">
        <div class="col-md-9 col-xs-12">
            <div id="carousel" class="carousel slide animated pulse" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php
                    if ($slides) {
                        foreach ($slides as $i => $slide) {
                            $class = '';
                            if ($i == 0) {
                                $class = 'active';
                            }
                            echo '<li data-target="#carousel" data-slide-to="' . $i . '" class="' . $class . '"></li>';
                        }
                    }
                    ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php
                    if ($slides) {
                        foreach ($slides as $i => $slide) {
                            $desc = $slide->description;
                            $class = 'item';
                            if ($i == 0) {
                                $class = 'item active';
                            }
                            if (!empty($slide->link)) {
                                $link = $slide->link;
                            } else {
                                $link = Yii::app()->request->baseUrl . '/' . $controller . '/item?id=' . $slide->product_id;
                            }
                            echo '<div class="' . $class . '">
                                    <a href="' . $link . '"><img src="' . Yii::app()->request->baseUrl . '/media/categoryslider/' . $slide->image . '" alt="' . $slide->title . '"></a>
                               </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 ad1">
            <?php
                if($main_ad)
                {
                       if($main_ad->product_id != null){
                   $link = Yii::app()->getBaseUrl(true)."/jewelry/item?id=$main_ad->product_id";
               }else{
                   $link = $main_ad->link;
               }
            ?>
             <a href="<?= $link ?>"><img src="<?=Yii::app()->request->baseUrl ."/media/ads/$main_ad->image"?>"></a>
       
                <?php } ?>
            
        </div>
    </div>
</div>
<div class="container">
    <div class="wrap">
<div class=" ads">
    
   <?php if($ads){
     foreach ($ads as $ad){
             if($ad->product_id !=null){
                   $link = Yii::app()->getBaseUrl(true)."/jewelry/item?id=$ad->product_id";
               }else{
                   $link = $ad->link;
               }
         ?>
    <a href="<?= $link ?>" class="col-md-3"><img src="<?php echo Yii::app()->request->baseUrl ."/media/ads/$ad->image"?>"></a>
      
    <?php
     }
    } ?>
</div>
</div>
</div>
<div class="container">
    <div class="wrap">
        <?php foreach ($featured_products as $product) { ?>
            <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0 animated fadeInLeft">
                <div class="shops">
                    <?php if($model->flag != 1){ ?>
                    <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>">
                    <?php }else{
                        ?>
                    <img src="<?php echo $product->main_image ?>">
                    <?php
                    } ?>
                    <p class="shop-link"><?= Helper::limit_words($product->title , 6)?></p>

                </div>
            </a>
        <?php } ?>
    </div>
</div>

<div class="container">
    <div class="wrap">
        <div class="col-md-12">
            <div class="headtitle">
                <span>New products</span>
            </div>

            <div class="row items">

                <?php foreach ($products as $newproduct) {
                    ?>    
                    <div class="col-md-3 col-sm-6 col-xs-12 wp4">
                        <div class="col-md-12 col-sm-12 col-xs-12 item-box">
                            <div href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $newproduct->id ?>" class="col-md-12 col-sm-12 col-xs-12 item-img">
                                <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $newproduct->id ?>" class="prod-img">
                                  <?php if($model->flag != 1){ ?>
                                    <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $newproduct->main_image ?>" alt="<?= $newproduct->title ?>"/>
                                </a>
                                  <?php }else{ ?>
 <img src="<?php echo $product->main_image ?>" alt="<?= $newproduct->title ?>"/>
                                  <?php  } ?>
                                <div class="item-cart"><a class="add" href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $newproduct->id ?>">
                                        <i><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/jewelry/item-cart.png"></i>ADD TO CART</a>

                                </div><!--end item-cart-->


                            </div>



                            <div class="item-info">
                         <a class="item-name" href="<?php echo Yii::app()->getBaseUrl(true) . '/jewelry/item/' . $newproduct->id; ?>"><?= $newproduct->title ?></a>

                                <span class="item-price"><?= $newproduct->price ?> GBP</span>
                            </div><!--end item-info-->

                        </div><!--end item-box-->


                    </div>

                <?php } ?>

            </div>
<?php $count=count($arrivals); 
        if($count>0){
        ?>
            <div class="headtitle head2">
                <span>New Arrivals</span>
            </div>

            <div id="carousel-example-generic2" class="carousel slide animated fadeInUp new_arriv_slider" data-ride="carousel">
                <!-- Wrapper for slides -->
              
                
                 <div class="carousel-inner">


            <div class="item active">
                <?php
                $s = 1;
                foreach ($arrivals as $arrival) {
                    if ($s == 5) {
                        $s = 1;
                        ?>
                    </div>
                    <div class="item">
                        <?php
                    }
                    ?>

                    <div class="col-md-3 col-xs-6 text-center">
                                    <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $arrival->id ?>" class="new_arr_item">
                                        <div class="item_img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $arrival->main_image; ?>"/></div>
                                        <p class="item_name"><?php echo $arrival->title ?></p>
                                        
                                        <p class="new_arr_price"><?php echo $arrival->price; ?> GBP</p>
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
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/jewelry/left_arrow2.png"/>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic2" role="button" data-slide="next">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/jewelry/right_arrow2.png"/>
                </a>
            </div>
        <?php } ?>

        </div>
    </div
</div>
</div>