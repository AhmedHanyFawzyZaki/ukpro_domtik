<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = array(
    'Error',
);
?>


<!--<h1> Sorry You have Followed a wrong link </h1>-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?> </title>
        <meta name="description" content="">
        <meta name="author" content="">
        <?php Yii::app()->bootstrap->register(); ?>
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/style.css">
    </head>
    <body>
        <div class="header">

            <div class="error_logo">
                <a href="<?= Yii::app()->baseUrl ?>/home/index"><img src="<?= Yii::app()->baseUrl ?>/img/logo.png" alt=""></a>
            </div>


        </div>
        <div class="content">

            <div class="content2">


                <img class="pull-right error_img" src="<?= Yii::app()->baseUrl ?>/media/<?php echo Yii::app()->params['error_image']; ?>" width="600px">

                <div class="error_left_part">
                    <h2 class="error_title"><?php echo Yii::app()->params['error_heading']; ?></h2>



                    <h4 class="error_text">
                        <span> <?php echo Yii::app()->params['error_subhead']; ?> </span>
                    </h4>

                    <div class="error_btns text-center">


                        <?php
                        if (Yii::app()->params['error_homeactive'] == 1) {
                            ?>

                            <a href="<?= Yii::app()->baseUrl ?>/home/index" class="btn error_page_btn">
                                <?php echo Yii::app()->params['error_home']; ?>
                            </a>

                            <?php
                        }
                        ?>


                        <?php
                        if (Yii::app()->params['error_prevactive'] == 1) {
                            ?>

                            <a href="<?= $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : Yii::app()->baseUrl . '/home/index' ?>" class="btn error_page_btn">
                                <?php echo Yii::app()->params['error_prev']; ?>
                            </a>

                            <?php
                        }
                        ?>



                    </div>

                    <?php if (!$report): ?>
                        <h4 class="error_text2">We Can Help!</h4>
                        <h5 class="sub_error_text2">You can also inform us of the problem if it repeats itself.</h5>

                        <form class="form-horizontal report_form" method="post" >

                            <div class="control-group">
                                <label class="control-label">Your E-mail</label>
                                <div class="controls">
                                    <input type="text" name="Report[email]">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Your Message</label>
                                <div class="controls">
                                    <textarea name="Report[message]"></textarea>
                                </div>
                            </div>

                            <div class="control-group">
                                <button class="btn error_submit_btn error_page_btn" type="submit">Submit</button>
                            </div>


                        </form>
                    <?php else: ?>
                        <h5 class="sub_error_text2">Thank you for your feedback, we will do our best to solve the problem as soon as possible.</h5>

                    <?php endif; ?>
                </div>
            </div>


        </div><!--end content-->


    </body>
</html>