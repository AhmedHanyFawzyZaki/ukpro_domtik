<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
?>
<!-- /.carousal -->
<div id="carousel-example-generic" class="carousel slide fade" data-ride="carousel">
   
    <!-- Indicators -->
    <ol class="carousel-indicators">

        <?php
        $i = 0;
        foreach ($banners as $banner):
            if ($i == 0) {
                $class = "active";
            } else
                $class = "";
            ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="<?php echo $class; ?>"></li>

            <?php
            $i++;
        endforeach;
        ?>

    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php
        $i = 0;
        foreach ($banners as $banner) {
            if ($i == 0) {
                $class = "active";
            } else
                $class = "";
            $i++;
            ?> 
            <div class="item <?php echo $class; ?>">
                <a href="<?php echo $banner->link; ?>"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/banner/<?php echo $banner->image; ?>" alt="<?php echo $banner->title; ?>"></a>
            </div>

        <?php } ?>

    </div> 
</div>
<!-- /.carousal -->
<div class="row shops">
    <?php foreach ($cats as $cat) { ?>
        <div class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 wp2 shop">
            <a href="<?=Yii::app()->request->baseUrl?>/<?=$cat->url?>"><img src="<?php
            if (empty($cat->image)) {
                echo Yii::app()->getBaseUrl(true) . '/media/item2.png';
            } else {
                echo Yii::app()->getBaseUrl(true) . '/media/category/' . $cat->image
                ;
            }
            ?>
                                                                            " width="100%"></a>
            <span class="shop-name"><?php echo $cat->title; ?></span>
            <a href="<?=Yii::app()->request->baseUrl?>/<?=$cat->url?>" class="browse-shop"><span class="animated shake">SHOP NOW</span><i class="fa fa-angle-double-right"></i></a>
        </div>

    <?php } ?>

</div>


<div class="row heading">
    <div class="col-md-12 col-xs-12"><span>featured items </span>
        <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/heading-border.png" alt="" width="100%">
    </div>
</div><!--end heading-->


<div class="row items">




    <?php
    foreach ($products as $product) {
         $favs = count(Favourite::model()->findAll("product_id = $product->id"));
        $link=Yii::app()->request->baseUrl.'/'.$product->category->url.'/item?id='.$product->id;
        
        if($product->category->id==8 || $product->category->id==7){
            $link=Yii::app()->request->baseUrl.'/'.$product->category->url.'/details?pro_id='.$product->id;
        }elseif($product->category->id==6){
            $link=Yii::app()->request->baseUrl.'/'.$product->category->url.'/details/id/'.$product->id;
        }elseif($product->category->id==10){
            $link=Yii::app()->request->baseUrl.'/'.$product->category->url.'/item/id/'.$product->id;
        }
        
        ?>


        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="col-md-12 col-sm-12 col-xs-12 item-box">

                <div class="col-md-12 col-sm-12 col-xs-12 item-img">
                    <a href="<?=$link?>" class="prod-img"><img src="<?php
                        if ($product->main_image == 0) {
                            echo Yii::app()->getBaseUrl(true) . '/media/item2.png';
                        } else {
                            echo Yii::app()->getBaseUrl(true) . '/media/product/' . $product->main_image;
                        }
                        ?>" alt="<?php echo $product->title; ?>"/></a>

                    <div class="item-cart"><a class="add" href="<?=$link?>">
                            <i><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/item-cart.png"></i>ADD TO CART</a>

                    </div><!--end item-cart-->
                    <?php
                    if (!empty(Yii::app()->user->id)) {
                        $check = Helper::checkFav($product->id);
                        if ($check == 1) {
                            ?>
                            <a class="fav_icon add_fav_solid" href="javascript:void(0);" id="<?php echo $product->id ?>"><span class="fav-number"><?php echo $favs ?></span></a>

                        <?php } else { ?>
                                <a class="add_fav fav_icon" href="javascript:void(0);" id="<?php echo $product->id ?>"><span class="fav-number"><?php echo $favs ?></span>
                                </a>
                        <?php
                        }
                    } else {
                        ?>
                        <!--<a class="add_fav fav_icon" href="<?php echo Yii::app()->getBaseUrl(true) . '/home/confirm/flag/3'; ?>"></a>-->
                            <a data-target="#login-modal" data-toggle="modal" data-dismiss="modal" class="add_fav fav_icon" id="<?php echo $product->id ?>"><span class="fav-number"><?php echo $favs ?></span></a>
    <?php } ?>

                </div>

                <div class="item-info">
                    <span class="item-name"><a href="<?=$link?>"><?php echo $product->title; ?></a></span>
                    <span class="item-categ"><a href="<?=Yii::app()->request->baseUrl?>/<?=$product->category->url?>"><?php echo $product->category->title;    ?></a></span>
                    <span class="item-price"><?php echo $product->price; ?> GBP</span>
                </div><!--end item-info-->

            </div><!--end item-box-->
        </div>
<?php } ?>

</div><!--end items-->
<!--appear-->
<?php $this->renderpartial('../home/sponsor', array('sponsers' => $sponsers)); ?>
<!--end appear-->

</div>
</div>

<script>
   // function getProdcutId(p) {
       <?php  //echo die; ?>
      //   var product_id=p;
        $(function(){
          $(document).delegate(".add_fav","click",function(){ 
              var $this  = $(this);
        var pro_id = $(this).attr('id');  
        $.ajax({
            url:"<?php echo Yii::app()->request->getBaseUrl(true)?>/home/addFav",
            type:"post",
            data:"pro_id="+pro_id ,       
            success:function (data){
                
                console.log(data);
                $this.children(".fav-number").text(data);
                
       // $(this).toggleClass('add_fav');
        //$this.attr('class',"fav_icon add_fav"');
         $this.prop('class',"fav_icon add_fav_solid");
    
                //return true;
            } 
        });
        });
        
        
          $(document).delegate(".add_fav_solid","click",function(){  
           var $this  = $(this);
        var pro_id = $(this).attr('id');  
        $.ajax({
          url:"<?php echo Yii::app()->request->getBaseUrl(true)?>/home/removeFav/",
            type:"post",
            data:"pro_id="+pro_id ,       
            success:function (data){
               
                console.log(data);
                 $this.children(".fav-number").text(data);
                
       //$this.attr('class',"fav_icon add_fav_solid"');
         $this.prop('class',"fav_icon add_fav");
//        $(this).toggleClass('add_fav_solid');
   
             //   return true;
            } 
        });
        });
        
    });
    
</script>

<script>
//    function removefav(p) {
//       <?php  //echo die; ?>
//         var product_id=p;
//        
//        $.ajax({
//            url:"<?=Yii::app()->request->baseUrl?>/home/removeFav/"+product_id,
//            success:function (data){
//                $(".fav-number").text(data);
//                console.log(data);
//                //alert(data);
//                return true;
//            } 
//        });
//    }
    
</script>
