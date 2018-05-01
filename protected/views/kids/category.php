</div>
</div>
<?php
$this->renderPartial("top_menu");
?>
<div class="container">
    <div class="wrap">
        <div class="all-content col-md-12 col-xs-12">
                

           <div class="col-md-3 col-sm-3 col-xs-12 slide-title "> 
            <div class="title3">
                <span><?php echo $category->title; ?></span>
            </div>
            </div>
            <?php
            if($products){
            ?>
            <div class="col-md-12 col-xs-12 product-row">
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
                        <a class="product-img" href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/details?pro_id=<?php echo $product->id; ?>">
                        <?php if($product->flag != 1){ ?>
                            <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $product->main_image; ?>">
                        <?php }else{
                            ?>
                             <img src="<?php echo $product->main_image; ?>">
                            <?php
                        } ?>
                        </a>
                        <span class="price"><?php echo $product->price; ?> GBP</span>
                   <a class="title" href="<?php echo Yii::app()->getBaseUrl(true) . '/kids/details' ; ?>?pro_id=<?= $product->id ?>"><?php echo $product->title; ?></a>
                        <span class="desc"><?php echo substr($product->description, 0,30); ?>...</span>
                        <span class="cart-btn">
                            <a class="add-cart" href="<?php echo Yii::app()->getBaseUrl(true); ?>/kids/details?pro_id=<?php echo $product->id; ?>"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/kids/add-cart.png">Add to cart</a>
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
                'pages' => $pages,
                'cssFile' => Yii::app()->theme->baseUrl . "/css/bootstrap.css",
                'firstPageLabel' => '&lt;&lt;',
                'prevPageLabel' => '&lt;',
                'nextPageLabel' => '&gt;',
                'lastPageLabel' => '&gt;&gt;',
                'header' => '',
                'htmlOptions' => array('class' => 'pagination pull-right', 'style' => 'margin-top:15px;'),
            ))
            ;
            ?>
    </div>    
</div>
</div>
<div class="container">
<div class="wrap">

</div>
</div>
</div>
</div>
