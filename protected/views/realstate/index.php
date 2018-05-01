<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;

?>
</div>
</div>
<div class="bg" style="background:url(<?= Yii::app()->request->baseUrl; ?>/media/categoryslider/<?= $slider->image ?>) no-repeat center;">
    
<div class="container">
<div class="wrap animated zoomIn">
	<h1>Find Your Happy</h1>
    <h5>Search properties for sale or rent</h5>
   
    	
    	            <form class="search-bg" role="form" method="post" action="<?php echo Yii::app()->getBaseUrl(true) . '/' . realstate; ?>/search">

    	<input type="text"  name="title" class="form-control input-lg rent-txt" placeholder="Search">

      

      
        
      
        
  <?php 

echo CHtml::button('For Rent',
array('submit' => array('realstate/search','id'=>1),
'name'=>'onclick',
    'id'=>'rent',
'class'=>'btn btn-success btn-lg rent-btn',
//'style'=>'width:80px;'
)); 
?>   
        <?php 

echo CHtml::button('For Sale',
array('submit' => array('realstate/search','id'=>2),
'name'=>'onclick',
 'id'=>'sale',
'class'=>'btn btn-success btn-lg rent-btn',
//'style'=>'width:80px;'
)); 
?>
                </form>
   
        
</div>
</div>

</div>



<div class="container">
    <div class="wrap">
 <div class=" ads">
    
      <?php if($ads){
     foreach ($ads as $ad){
             if($ad->product_id !=null){
                   $link = Yii::app()->getBaseUrl(true)."/realstate/item/id/$ad->product_id";
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

<div class="header-center">
	<h1>Featured Property</h1>
</div>
<div class="">
<?php foreach ($products as $product){ ?>
	<div class="col-md-4">
    	<div class="place">
    	<?php if($product->flag != 1){ ?>
            <img src="<?= Yii::app()->request->baseUrl;?>/media/product/<?= $product->main_image ?>">
        <?php }else{
            ?>
            <img src="<?= $product->main_image ?>">
            <?php
            
        } ?>
        <h3> <a  class="title" href="<?php echo Yii::app()->getBaseUrl(true) . '/realstate/item/' . $product->id; ?>"><?= $product->title ?></a></h3>
        <p class="disc"><?= $product->description ?></p>
        <a href="<?=  Yii::app()->request->baseUrl;?>/realstate/item/id/<?= $product->id ?>" class="link">Show Place</a>
        </div>
    </div>
    <?php } ?>
</div>



</div>
</div>
    
    