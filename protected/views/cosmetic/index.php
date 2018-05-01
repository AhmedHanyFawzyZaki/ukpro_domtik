</div>
</div>

<?php
$this->renderPartial("top_menu");
$controller=Yii::app()->controller->id;
?>

<div class="container">
    <div class="wrap">
    </div>
</div>

<div class="container">
    <div class="wrap">
        <div class="col-md-9">
            <div id="carousel" class="carousel slide animated pulse" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php
                        if($slides)
                        {
                            foreach($slides as $i=>$slide)
                            {
                                $class='';
                                if($i==0)
                                {
                                    $class='active';
                                }
                                echo '<li data-target="#carousel" data-slide-to="'.$i.'" class="'.$class.'"></li>';
                            }
                        }
                    ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php
                        if($slides)
                        {
                            foreach($slides as $i=>$slide)
                            {
                                $class='item';
                                if($i==0)
                                {
                                    $class='item active';
                                }
                                if($slide->link)
                                {
                                    $link=$slide->link;
                                }
                                else
                                {
                                    $link=Yii::app()->request->baseUrl.'/'.$controller.'/item?id='.$slide->product_id;
                                }
                                echo '<div class="'.$class.'">
                                    <a href="'.$link.'"><img src="'.Yii::app()->request->baseUrl.'/media/categoryslider/'.$slide->image.'" alt="..."></a>
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
        <div class="col-md-3 animated pulse ad1">
            <?php                              
                if($main_ad)
                {
                     if($main_ad->product_id !=null){
                   $link = Yii::app()->getBaseUrl(true)."/cosmetic/item?id=$main_ad->product_id";
               }else{
                   $link = $main_ad->link;
               }
            ?>
            <a href="<?= $link ?>"><img src="<?=Yii::app()->request->baseUrl?>/media/ads/<?=$main_ad->image?>"></a>
            <?php
                }?>
        </div>
    </div>
</div>

<!--<div class="container">
    <div class="wrap">
        <?php
        if ($featured_products) {
            foreach ($featured_products as $fp) {
                if ($fp->price) {
                    $price = $fp->price . ' GBP';
                } else {
                    $min_price = Size::model()->find(array('condition' => 'product_id=' . $fp->id, 'order' => 'price asc'))->price;
                    $price = 'Starting from ' . $min_price . 'GBP';
                }
                ?>

                <div class="col-md-4 animated fadeInLeft">
                    <div class="shops">
                        <div class="shop-img">
                            <a href="<?php echo Yii::app()->getBaseUrl(true) . '/cosmetic/item/' . $fp->id; ?>"><img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $fp->main_image ?>"></a>
                        </div>
          <a class="title" href="<?php echo Yii::app()->getBaseUrl(true) . '/cosmetic/item/' . $fp->id; ?>"><?php echo $fp->title; ?></a>
                        <hr/>
                        <span class="xtitle"><?= $price ?></span>

                        <a href="<?= Yii::app()->request->baseUrl ?>/<?=$controller?>/item?id=<?= $fp->id ?>" class="shop-link">Shop Now</a>
                    </div>
                </div>
        <?php
    }
    ?>
            <?php
        }
        ?>
    </div>
</div>
-->

<div class="container">
    <div class="wrap">
    <div class="col-md-12">
    <div class="row ads">
 <?php if($ads){
     foreach ($ads as $ad){
          if($ad->product_id !=null){
                   $link = Yii::app()->getBaseUrl(true)."/cosmetic/item?id=$ad->product_id";
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
</div>
<div class="container">
    <div class="wrap">
        <div class="col-md-12">
            <div class="headtitle">
                <span>New Products</span>
                <div class="btn-group pull-right">
                    <a class="toggler toggle-big1 active" ><i class="fa fa-th"></i></a>
                    <a class="toggler toggle-big2" ><i class="fa fa-th-large"></i></a>


                </div>
            </div>
            <div class="toggle-div1 open row">  
                <div class="row product-row">
<?php
foreach ($products as $i => $product) {
    if ($product->price) {
        $pro_price = $product->price . ' GBP';
    } else {
        $pro_min_price = Size::model()->find(array('condition' => 'product_id=' . $product->id, 'order' => 'price asc'))->price;
        $pro_price = 'Starting from ' . $pro_min_price . 'GBP';
    }
    if (($i % 4) == 0 && $i != 0) {
        ?>
                        </div>
                        <hr>
                        <div  class="row product-row">
                            <?php
                        }
                        ?>
                        <div class="col-md-3">
                            <div class="products">
                                <a href="<?= Yii::app()->request->baseUrl ?>/<?=$controller?>/item?id=<?= $product->id ?>" class="product-img">
                                <?php if($product->flag != 1){ ?>
                                    <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>">
                                <?php }else{
                                    ?>
                                    <img src="<?= $product->main_image ?>">
                                    <?php
                                } ?>
                                </a>
                                <span class="price"><?= $pro_price ?></span>
                                <a class="title" href="<?php echo Yii::app()->getBaseUrl(true) . '/cosmetic/item/' . $product->id; ?>"><?php echo Helper::limit_words($product->title, 10); ?></a>

                                <span class="desc"><?= substr($product->description, 0, 50) ?></span>
                                <!--<span class="cart-btn"><a href="#" class="add-cart"><img src="<?= Yii::app()->request->baseUrl ?>/img/<?= Yii::app()->controller->id ?>/add-cart.png">Add to cart</a></span>-->
                                <span class="cart-btn"><a href="<?= Yii::app()->request->baseUrl ?>/<?=$controller?>/item?id=<?= $product->id ?>" class="add-cart">Details</a></span>
                            </div>
                        </div>
    <?php
}
?>
                </div>

            </div>

            <div class="toggle-div2 row">     
                <div class="row product-row">
                    <?php
                    foreach ($products as $i => $product) {
                        if ($product->price) {
                            $pro_price = $product->price . ' GBP';
                        } else {
                            $pro_min_price = Size::model()->find(array('condition' => 'product_id=' . $product->id, 'order' => 'price asc'))->price;
                            $pro_price = 'Starting from ' . $pro_min_price . 'GBP';
                        }
                        if (($i % 3) == 0 && $i != 0) {
        ?>
                        </div>
                        <hr>
                        <div  class="row product-row">
                            <?php
                        }
                        ?>
                        <div class="col-md-4">
                            <div class="products">
                                <a href="#" class="product-img">
                                       <?php if($product->flag != 1){ ?>
                                    <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>">
                                <?php }else{
                                    ?>
                                    <img src="<?= $product->main_image ?>">
                                    <?php
                                } ?>
                                </a>
                                <span class="price"><?= $pro_price ?></span>
                                
             <a class="title" href="<?php echo Yii::app()->getBaseUrl(true) . '/cosmetic/item/' . $product->id; ?>"><?php echo $product->title; ?></a>

                                <span class="desc"><?= substr($product->description, 0, 50) ?></span>
                                <span class="cart-btn"><a href="<?= Yii::app()->request->baseUrl ?>/<?=$controller?>/item?id=<?= $product->id ?>" class="add-cart">Details</a></span>
                            </div>
                        </div>
    <?php
}
?>
                        </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="brands">
                        <?php 
                            foreach($brands as $brand)
                            {
                        ?>
                                <div class="col-md-3">
                                    <a href="<?=Yii::app()->request->baseUrl?>/<?=$controller?>/subCategory?brand_id=<?=$brand->id?>" class="brand-link">
                                        <img src="<?=Yii::app()->request->baseUrl?>/media/brand/<?=$brand->image?>">
                                        <br>
                                        <span><?=$brand->title?></span>
                                    </a>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
