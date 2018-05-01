<?php $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id)); ?>

<div class="row profile">

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/dashboard">Dashboard</a></li>
            <li class="active">all products</li>
        </ol>

    </div>


    <div class="col-md-12 col-xs-12 profile-title">
        <p class="profile-name"><?php echo $user->username; ?></p>
    </div>


    <!--appear-->
    <?php $this->renderpartial('../home/menu', array('user' => $user)); ?>
    <!--end appear-->

    <div class="col-md-9 col-sm-8 col-xs-12">
        <?php  if (Yii::app()->user->hasFlash('success2')) {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo Yii::app()->user->getFlash('success2'); ?>.
            </div>
<?php 
        }
        ?>
      <?php  if (Yii::app()->user->hasFlash('updated-success')) {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo Yii::app()->user->getFlash('updated-success'); ?>.
            </div>
        <?php } ?>
        <div class="row items">
            <?php
            if(!empty($products)){
            foreach ($products as $product) {
//                $criteria = new CDbCriteria;
//                $criteria->condition = 'id=:ID';
//                $criteria->params = array(':ID' => $product->product_category_id);
//                $productcat = ProductCategory::model()->find($criteria);
                ?>
                <div class="col-md-4 col-sm-6 col-xs-12 wp4 prod-box">

                    <div class="col-md-12 col-sm-12 col-xs-12 item-box">
                        <div  class="col-md-12 col-sm-12 col-xs-12 item-img">
                            <div class="manage-item">
                                <a href="<?php echo Yii::app()->request->baseUrl ?>/users/Editproduct/id/<?php echo $product->id; ?>" class="edit-item"><img src="<?php echo Yii::app()->request->baseUrl ?>/img/edit-icon.png" alt="edit" /></a>
                                <a href="<?php echo Yii::app()->request->baseUrl ?>/users/Deleteproudct/<?php echo $product->id; ?>" onclick="return confirm('Do you want delete this product : <?= $product->title ?>?')" class="delete-item"><img src="<?php echo Yii::app()->request->baseUrl ?>/img/delete-icon.png" alt="delete" /></a>
                            </div><!--end manage-item-->
                            <?php if($product->flag !=1){ ?>
                           <a href="<?php echo Yii::app()->request->baseUrl ?>/users/Editproduct/id/<?php echo $product->id; ?>" class="prod-img"><img src="<?php echo Yii::app()->request->baseUrl ?>/media/product/<?php echo $product->main_image; ?>" alt="<?php echo $product->title; ?>" class="prod-img"/></a>
                            <?php }elseif($product->flag==1){ ?>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/users/Editproduct/id/<?php echo $product->id; ?>" class="prod-img"><img src="<?php echo $product->main_image; ?>" alt="<?php echo $product->title; ?>" class="prod-img"/></a>    
                        <?php } ?>
                        </div>
                        <div class="item-info">
                            <span class="item-name"><?php echo $product->title; ?></span>
                            <span class="item-categ"><?php echo $product->category->title; ?></span>
                            <span class="item-price"><?php echo $produc->price; ?> GBP</span>
                        </div><!--end item-info-->
                    </div><!--end item-box-->
                </div>
            <?php }
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
            }else{echo '<div class="alert alert-danger">No Products Found!</div>';} ?>
        </div><!--end items-->
    </div>

</div>



<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->



</div>
</div>
