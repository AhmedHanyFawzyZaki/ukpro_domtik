<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>
</div>
</div>







<div class="container">
<div class="wrap">

<div class="header-center">
	<h1>Featured Property</h1>
</div>
   <?php  if (Yii::app()->user->hasFlash('add-error')) {
                    ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('add-error'); ?>.
                    </div>
                <?php } ?>
<div class="">
<?php foreach ($products as $product){ ?>
	<div class="col-md-4">
    	<div class="place">
            <?php if($product>flag != 1){ ?>
    	<img src="<?php  echo Yii::app()->request->baseUrl;?>/media/product/<?= $product->main_image ?> ">
            <?php }else{
                ?>
        <img src="<?= $product->main_image ?> ">
        
        <?php
            } ?>
        
        <h3><a class="title"  href="<?php echo Yii::app()->getBaseUrl(true) . '/realstate/item/' . $product->id; ?>"><?= Helper::limit_words($product->title, 10)  ?></a></h3>
        <p class="disc"><?= $product->description ?></p>
        <a href="<?=  Yii::app()->request->baseUrl;?>/realstate/item/id/<?= $product->id ?>" class="link">Show Place</a>
        </div>
    </div>
<?php } ?>
</div>



</div>
</div>
