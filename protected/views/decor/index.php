<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>
</div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="banner">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/categoryslider/<?php echo $cat_slider->image; ?>" alt="" />
            <p> <?= $cat_slider->description; ?><span><?= $cat_slider->title; ?></span></p>

        </div><!--end banner-->
    </div>
</div>

<div class="container">
    <div class="wrap">
 <div class=" ads">
      <?php if($ads){
     foreach ($ads as $ad){
             if($ad->product_id !=null){
                   $link = Yii::app()->getBaseUrl(true)."/decor/details/item?id=$ad->product_id";
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
        <div class="col-md-3 col-sm-3 col-xs-12 left-menu">

            <ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
                <li class="menu-title">HOME DÉCOR Type</li>

                <?php
                foreach ($decortypes as $decortype) {
                    ?>
                    <li class="<?= $class; ?>"><a href="<?= Yii::app()->request->baseUrl; ?>/decor/sub?type_id=<?= $decortype->id ?>"><?= $decortype->title; ?></a></li>
                <?php } ?>
            </ul>

            <ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
                <li class="menu-title">Home Décor Style</li>

                <?php
                foreach ($decorstyles as $decorstyle) {
                    ?>
                    <li class=""><a href="<?= Yii::app()->request->baseUrl; ?>/decor/sub?style_id=<?= $decorstyle->id ?>"><?php echo $decorstyle->title; ?></a></li>
                <?php } ?>


            </ul>
        </div><!--end menu-->
        <div class="col-md-9 col-sm-9 col-xs-12 latets-design">
            <span class="menu-title">latest designs</span>

            <div class="col-md-12 col-xs-12 items">
                <?php foreach ($prods as $prod) { ?>
                <div class="col-md-6 col-xs-12 ">
                    <div href="<?= Yii::app()->request->baseUrl; ?>/decor/details/id/<?= $prod->id ?>" class="item-design">
                        <a href="<?= Yii::app()->request->baseUrl; ?>/decor/details/id/<?= $prod->id ?>">
                            <?php if($prod->flag != 1){  ?>
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?= $prod->main_image; ?>" alt="" />
                            <?php }else{
                                ?>
                           <img src="<?= $prod->main_image; ?>" alt="" /> 
                            <?php
                            } ?>
                        </a>
                        <div class="col-md-11 col-xs-11 item-name">
                            <a href="<?= Yii::app()->request->baseUrl; ?>/decor/details/id/<?= $prod->id ?>"><?php echo Helper::limit_words($prod->title, 2); ?></a>
                        </div>

                        <div class="price_tag">
                            <p class="item_price"><?php echo $prod->price; ?> GBP</p>

                        </div>

                    </div>
                    </div>

                <?php } ?>
            </div><!--end items-->

            <div class="col-md-12 col-xs-12">

                <?php
                echo CHtml::button('More...', array('submit' => array('decor/sub', 'id' => '1'),
                    'name' => 'onclick',
                    'class' => 'btn btn-default more-btn',
//'style'=>'width:80px;'
                ));
                ?>
            </div>
        </div><!--end latest-design-->
    </div>
</div>








</div>
</div>
