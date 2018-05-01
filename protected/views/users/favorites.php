<?php $user=User::model()->findByAttributes(array('id'=>Yii::app()->user->id));?>

<div class="row profile">

<div class="col-md-12">
<ol class="breadcrumb">
      <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/dashboard">Dashboard</a></li>

      <li class="active">Favorites</li>
    </ol>
    
    </div>


<div class="col-md-12 col-xs-12 profile-title">
<p class="profile-name"><?php echo $user->fname,' '.$user->lname;?></p>
</div>
 


    
    
<!--appear-->
<?php $this->renderpartial('../home/menu',array('user'=>$user)); ?>
<!--end appear-->

 <?php
                $this->widget('CLinkPager', array(
                    'pages' => $pages,
                    'htmlOptions' => array('class' => 'pagination pull-right'), // class of pag div
                    'firstPageLabel' => '&lt;&lt;',
                    //'prevPageLabel' => '»',
                    //'nextPageLabel' => '«',
                    'lastPageLabel' => '&gt;&gt;',
                    'header' => '',
                ))
                ;
                ?>


<div class="col-md-9 col-sm-8 col-xs-12">
<div class="row items">
    
    
    
   <?php foreach ($favs as $fav){
       $link=Yii::app()->request->baseUrl.'/'.$fav->category->url.'/item?id='.$fav->id;
        
        if($fav->category->id==8 || $fav->category->id==7){
            $link=Yii::app()->request->baseUrl.'/'.$fav->category->url.'/details?pro_id='.$fav->id;
        }elseif($product->category->id==6){
            $link=Yii::app()->request->baseUrl.'/'.$fav->category->url.'/details/id/'.$fav->id;
        }elseif($product->category->id==10){
            $link=Yii::app()->request->baseUrl.'/'.$fav->category->url.'/item/id/'.$fav->id;
        }

        ?> 
<div class="col-md-4 col-sm-6 col-xs-12 wp4 prod-box">
    
    
<div class="col-md-12 col-sm-12 col-xs-12 item-box">
<div href="#" class="col-md-12 col-sm-12 col-xs-12 item-img">

<div class="item-cart"><a href="<?php echo $link ;?>" class="add">
<i><img src="<?php echo Yii::app()->request->baseUrl;?>/img/general/item-cart.png"></i>ADD TO CART</a>

</div>

<div class="manage-item">
<a href="<?php echo Yii::app()->request->baseUrl?>/users/deletefavorites/<?php echo $fav->id; ?>" onclick="return confirm('Do you want delete this favorite product : <?=$fav->title?>?')" class="delete-item"><img src="<?php echo Yii::app()->request->baseUrl;?>/img/delete-icon.png" alt="" /></a>
</div><!--end manage-item-->
<?php if($fav->flag != 1){ ?>
<a href="<?php echo $link ;?>" class="prod-img"><img src="<?php echo Yii::app()->request->baseUrl;?>/media/product/<?php  echo $fav->main_image;?>" alt="" class="prod-img"/></a>

    <?php }else{
    ?>
<a href="<?php echo $link ;?>" class="prod-img"><img src="<?php  echo $fav->main_image;?>" alt="" class="prod-img"/></a>

<?php
} ?>


</div>



<div class="item-info">
<span class="item-name"><?php echo $fav->title; ?></span>
<span class="item-categ"><?php  echo $fav->category->title?></span>
<span class="item-price"><?php  echo $fav->price;?> GBP</span>
</div><!--end item-info-->

</div><!--end item-box-->
</div>
   <?php  } ?>






</div><!--end items-->
</div>

 <?php
                $this->widget('CLinkPager', array(
                    'pages' => $pages,
                    'htmlOptions' => array('class' => 'pagination pull-right'), // class of pag div
                    'firstPageLabel' => '&lt;&lt;',
                    //'prevPageLabel' => '»',
                    //'nextPageLabel' => '«',
                    'lastPageLabel' => '&gt;&gt;',
                    'header' => '',
                ))
                ;
                ?>
        
        
                </div>

</div>

<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->


</div>
</div>

