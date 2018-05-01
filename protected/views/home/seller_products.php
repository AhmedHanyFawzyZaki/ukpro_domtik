<div class="row profile">

    <div class="col-md-12">
        <ol class="breadcrumb">

            <li><a href="#">profile owner</a></li>
            <li class="active">view products</li>
        </ol>

    </div>



    <div class="col-md-3">
        <div class="profile-img">
            <?php if (!empty($user->image)) { ?>
                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/members/<?php echo $user->image ?>" alt="<?php echo $user->fname . ' ' . $user->lname; ?>" />
            <?php } else { ?>
                <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/profile-img.png" alt="<?php echo $user->fname . ' ' . $user->lname; ?>" />
            <?php } ?>
        </div><!--end profile-img-->


        <ul style="max-width: 300px;" class="nav nav-pills nav-stacked profile-menu">
            <li class="active"><a href="<?= Yii::app()->request->baseUrl ?>/home/owner/<?php echo $user->id?>"><i class="fa fa-eye"></i>Profile details</a></li>
            <?php if (!empty(Yii::app()->user->id)) { ?>
                <li><a href="#message-modal" data-toggle="modal" data-target="#message-modal"><i class="fa fa-envelope-o"></i>send message</a></li>
            <?php } ?>
        </ul>

        <!--send message Modal-->
        <div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">send message</h4>
                    </div>

                    <div class="modal-body">
                        <?php
                        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'add-review',
                            'enableAjaxValidation' => false,
                            'type' => 'vertical',
                            'htmlOptions' => array('role' => 'role', 'enctype' => 'multipart/form-data'
                            ),
                        ));
                        ?>
                        <div class="form-group">   
                            <?php echo $form->textField($message, 'title', array('class' => 'form-control', 'placeholder' => 'Title')); ?>
                        </div>
                        <div class="form-group">   
                            <?php echo $form->textArea($message, 'details', array('class' => 'form-control', 'rows' => '3', 'placeholder' => 'Message')); ?>
                        </div>
                        <?php echo CHtml::submitButton('send', array('class' => 'btn btn-default log-btn')); ?>
                        <?php $this->endWidget(); ?>
                    </div>

                </div>
            </div>
        </div>

        <!--end send message modal-->

    </div>

    <div class="col-md-9">
        <div class="row items">
            <?php
            if (Yii::app()->user->hasFlash('add-success')) {
                ?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo Yii::app()->user->getFlash('add-success'); ?>.
                </div>

                <?php
            } elseif (Yii::app()->user->hasFlash('add-error')) {
                ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('add-error'); ?>.
                </div>
            <?php } ?>

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

                    <div class="col-md-4 col-sm-6 col-xs-12 wp4 prod-box">
                        <div class="col-md-12 col-sm-12 col-xs-12 item-box">
                            <div href="#" class="col-md-12 col-sm-12 col-xs-12 item-img">
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



<!--appear-->
<?php $this->renderpartial('../home/sponsor', array('sponsers' => $sponsers)); ?>
<!--end appear-->


</div>
</div>