<div class="row heading">
    <div class="col-md-12 col-xs-12"><span>search results</span>
        <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/heading-border.png" alt="" width="100%">
    </div>
</div><!--end heading-->

<div class="row items">

    <?php
    if ($products) {
        foreach ($products as $product) {
            $link = Yii::app()->request->baseUrl . '/' . $product->category->url . '/item?id=' . $product->id;

            if ($product->category->id == 8 || $product->category->id == 7) {
                $link = Yii::app()->request->baseUrl . '/' . $product->category->url . '/details?pro_id=' . $product->id;
            } elseif ($product->category->id == 6) {
                $link = Yii::app()->request->baseUrl . '/' . $product->category->url . '/details/id/' . $product->id;
            } elseif ($product->category->id == 10) {
                $link = Yii::app()->request->baseUrl . '/' . $product->category->url . '/item/id/' . $product->id;
            }
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12 wp4 delay-1s">
                <div class="col-md-12 col-sm-12 col-xs-12 item-box">

                    <div class="col-md-12 col-sm-12 col-xs-12 item-img">
                        <a href="<?= $link ?>" class="prod-img"><img src="<?php
                            if ($product->main_image == 0) {
                                echo Yii::app()->getBaseUrl(true) . '/media/item2.png';
                            } else {
                                echo Yii::app()->getBaseUrl(true) . '/media/product/' . $product->main_image;
                            }
                            ?>" alt="<?php echo $product->title; ?>"/></a>

                        <div class="item-cart"><a class="add" href="<?= $link ?>">
                                <i><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/item-cart.png"></i>ADD TO CART</a>

                        </div><!--end item-cart-->
                        <?php
                        if (!empty(Yii::app()->user->id)) {
                            $check = Helper::checkFav($product->id);
                            if ($check == 1) {
                                ?>
                                <a class="fav_icon add_fav_solid"></a>
                            <?php } else { ?>
                                <a class="add_fav fav_icon" href="<?php echo Yii::app()->getBaseUrl(true) . '/home/addFav/' . $product->id; ?>"></a>
                                <?php
                            }
                        } else {
                            ?>
                        <!--<a class="add_fav fav_icon" href="<?php echo Yii::app()->getBaseUrl(true) . '/home/confirm/flag/3'; ?>"></a>-->
                            <a data-target="#login-modal" data-toggle="modal" data-dismiss="modal" class="add_fav fav_icon"></a>
                        <?php } ?>

                    </div>

                    <div class="item-info">
                        <span class="item-name"><a href="<?= $link ?>"><?php echo $product->title; ?></a></span>
                        <span class="item-categ"><a href="<?= Yii::app()->request->baseUrl ?>/<?= $product->category->url ?>"><?php echo $product->category->title; ?></a></span>
                        <span class="item-price"><?php echo $product->price; ?> GBP</span>
                    </div><!--end item-info-->

                </div><!--end item-box-->
            </div>


        <?php
        }

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
    } else {
        ?>

        <div class="alert alert-danger">No Products Found!</div>
        <?php
    }
    ?>

</div><!--end items-->
</div>
</div>
