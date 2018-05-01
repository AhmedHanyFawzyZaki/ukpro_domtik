<?php
$this->renderPartial("top_menu");
$controller = Yii::app()->controller->id;
?>
    




<div class="col-md-12 col-xs-12 bg" style="background:url(<?= Yii::app()->request->baseUrl; ?>/media/categoryslider/<?= $slider->image ?>) no-repeat !important;">
<div class="container">
<div class="wrap animated zoomIn">
	
    
    	 <form class="search-bg"   method="post" action="<?php echo Yii::app()->getBaseUrl(true); ?>/lifestyle/search">
    	
             <input type="text"   name="search"  class="form-control input-lg rent-txt" placeholder="WHAT ARE YOU LOOKING FOR ? ">
        
        
        <button class="btn btn-lg rent-btn">search</button>
        
       
        
    </form>
    
    
</div>
    

   
    
    
</div>

</div>

<div class="container">
<div class="wrap">

<div class="row ads">
     <?php if($ads){
     foreach ($ads as $ad){
             if($ad->product_id !=null){
                   $link = Yii::app()->getBaseUrl(true)."/lifestyle/item?id=$ad->product_id";
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

<div class="col-md-12 col-xs-12 header-center">
	<h1>recommended for you  </h1>
</div>
<div class="row">
    
    <?php foreach ($featured_products as $product) { ?>
    
            <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $product->id ?>" class="col-md-4 col-xs-12" >
             <div class="place">
                 <?php if($product->flag != 1){ ?>
                <img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $product->main_image ?>">
               <?php }else{
                   ?>
                <img src="<?php echo $product->main_image ?>">
                <?php
               } ?>
                <h3 class="title"><?= $product->title ?><span><?= $product->price ?>GBP</span></h3>
                    
                </div>
            </a>
        <?php } ?>
    

	
    
    
<!--   
    <a href="#" class="col-md-4 col-xs-12">
    	<div class="place">
    	<img src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/place.jpg">
        <h3 class="title">Place name<span>200 GBP</span></h3>
        
        </div>
    </a>-->
    
    
    
</div>


<div class="col-md-12 col-xs-12 header-center">
	<h1 class="new">New Arrivals</h1>
</div>

<div class="row slider">

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
                if($arrivals){
                    
                
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

                            
                                    
                      	<a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $arrival->id ?>" class="col-md-3 col-sm-6 col-xs-12">
    	<div class="place">
    	<img src="<?php echo Yii::app()->request->baseUrl; ?>/media/product/<?php echo $arrival->main_image; ?>">
        <h3 class="title"><?php echo $arrival->title ?><span><?php echo $arrival->price; ?> GBP</span></h3>
        
    
        </div>
    </a>
            

                    <?php
                    $s++;
                }
                }
                ?>
            </div>


        </div>
                
                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel-example-generic1" role="button" data-slide="prev">
                  	<img src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/left_arrow2.png"/>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic1" role="button" data-slide="next">
                  	<img src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/right_arrow2.png"/>
                  </a>
                </div>


</div>


<div class="col-md-12 col-xs-12 header-center">
	<h1>latest products</h1>
</div>

<div class="row">
    
    
     <?php foreach ($products as $newproduct) {
         
         ?>
    
    <a href="<?= Yii::app()->request->baseUrl ?>/<?= $controller ?>/item?id=<?= $newproduct->id ?>" class="col-md-4 col-xs-12">
    	<div class="place">
            <?php if($newproduct->flag != 1 ){ ?>
    	<img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?= $newproduct->main_image ?>">
            <?php }else{
                ?>
        <img src="<?php echo $newproduct->main_image ?>">
        <?php
            } ?>
        <h3 class="title"><?= $newproduct->title ?> <span><?= $newproduct->price ?>GBP</span></h3>
        
    
        </div>
    </a>
    
    
    <?php
         
     }
        ?> 

	
    
<!--    
    <a href="#" class="col-md-4 col-xs-12">
    	<div class="place">
    	<img src="<?= Yii::app()->request->baseUrl ?>/img/lifestyle/place.jpg">
        <h3 class="title">Place name<span>200 GBP</span></h3>
        
        </div>
    </a>-->
    
    
    
</div>

<!-- InstanceEndEditable -->



</div>
</div>
