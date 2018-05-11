<?php $aboutpage = $this->setaboutpage(); ?>
<?php $privacypage = $this->setprivacypage(); ?>
<?php $pages = $this->getPages(); ?>
<?php $pageCats = $this->getcatPages(); ?>


<footer class="footer">
    <div class="container">
        <div class="wrap">
            <div class="col-md-2">

                <ul style="max-width: 300px;" class="nav nav-pills nav-stacked">


                    <?php foreach ($pageCats as $pageCat) { ?>

                        <li><span class="ul-title"><?php echo $pageCat->title; ?></span></li>
                        <?php if ($pageCat->id == 3) { ?>
                            <li><a href="<?php echo Yii::app()->request->baseUrl . '/home/faq' ?>">faqs</a></li>
                            <li><a href="<?php echo Yii::app()->request->baseUrl . '/home/contact' ?>">contact us</a></li>
                        <?php } ?>
                        <?php
                        $criteria = new CDbCriteria;
                        $criteria->condition = 'page_cat=' . $pageCat->id;
                        $pages = Pages::model()->findAll($criteria);


                        foreach ($pages as $page) {
                            ?>

                            <li><a href="<?php echo Yii::app()->request->baseUrl . '/' . $page->url ?>"><?php echo $page->title; ?></a></li>
                            <?php
                        }
                    }
                    ?>


                </ul>
            </div>



            <div class="col-md-3" style="width:18% !important;">
                <ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
                    <li><span class="ul-title">category:</span></li>
                    <?php
                    $cats = Category::model()->findAll(array('condition' => 'id <= 6'));

                    foreach ($cats as $cat) {
                        ?>


                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/<?php
                            if ($cat->id == 1) {
                                echo "cloths";
                            } elseif ($cat->id == 2) {
                                //echo "travel";
                                echo '#';
                            } elseif ($cat->id == 3) {
                                echo "cosmetic";
                            } elseif ($cat->id == 4) {
                                echo "jewelry";
                            } elseif ($cat->id == 5) {
                                echo "motor";
                            } elseif ($cat->id == 6) {
                                echo "decor";
                            }
                            ?>"><?php echo $cat->title; ?></a></li>

                    <?php } ?>
                </ul>
            </div>

            <div class="col-md-2">
                <ul style="max-width: 300px; margin-top:30px;" class="nav nav-pills nav-stacked">
                    <?php
                    $cats = Category::model()->findAll(array('condition' => 'id > 6'));

                    foreach ($cats as $cat) {
                        ?>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/<?php
                            if ($cat->id == 7) {
                                echo "electronic";
                            } elseif ($cat->id == 8) {
                                echo "kids";
                            } elseif ($cat->id == 9) {
                                echo "lifestyle";
                            } elseif ($cat->id == 10) {
                                echo "realstate";
                            }
                            ?>"><?php echo $cat->title; ?></a></li>
                        <?php } ?>

                </ul>
            </div>

            <div class="col-md-3 col-sm-12 pull-right">
                <div class="logo" style="text-align: right;">
                    <a class="" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home"><img alt="Exclusive luxe" src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/footer-logo.png"></a>
                </div><!--end logo-->

                <ul class="isocial boot-tooltip pull-right" id="social">
                    <li><a class="face" data-original-title="facebok" data-toggle="tooltip" href="<?php echo Helper::yiiparam('facebook') ?>" target="blank"></a></li>
                    <li><a class="twitter" data-original-title="twitter" data-toggle="tooltip" href="<?php echo Helper::yiiparam('twitter') ?>" target="blank"></a></li>
                    <li><a class="linkdin" data-original-title="mail" data-toggle="tooltip" href="<?php echo Helper::yiiparam('press_email') ?>" target="blank"></a></li>
                    <li><a class="instagram" data-original-title="instgram" data-toggle="tooltip" href="<?php echo Helper::yiiparam('pinterest') ?>" target="blank"></a></li>
                    <li><a class="google" data-original-title="youtube" data-toggle="tooltip" href="<?php echo Helper::yiiparam('google') ?>" target="blank"></a></li>

                </ul>
            </div>
            <div class="col-md-12">
                <p class="download pull-right">Download Our Application: <a href="<?php echo Helper::yiiparam('exclusive_app') ?>">Exclusive App</a> | <a href="<?php echo Helper::yiiparam('instgram_app') ?>">Instgram App</a></p>
                <p class="download pull-right">copyright © 2014 . All Rights Reserved . </p>
            </div>

        </div>
    </div>
</footer>
<!-- JS and analytics only. -->
<!-- Bootstrap core JavaScript
================================================== -->
<script src="<?= Yii::app()->request->baseUrl ?>/js/waypoints.min.js"></script>
<script src="<?= Yii::app()->request->baseUrl ?>/js/bootstrap.js"></script>


<script src="<?= Yii::app()->request->baseUrl ?>/js/star-rating.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        $('.wp2').waypoint(function() {
            $('.wp2').addClass('animated fadeInUp');
        }, {
            offset: '75%'
        });

        $('.wp4').waypoint(function() {
            $('.wp4').addClass('animated fadeInRight');
        }, {
            offset: '75%'
        });


        $('.wp3').waypoint(function() {
            $('.wp3').addClass('animated fadeInRight');
        }, {
            offset: '75%'
        });

        $('.wp9').waypoint(function() {
            $('.wp3').addClass('animated fadeInLeft');
        }, {
            offset: '75%'
        });

    });
</script>

<script>
    function myFunction() {
        $('#pp_uploader').click();
    }
</script>

<script>

    $('.cart').mouseover(function() {
        $(this).addClass('open');

        $('.cart-list').mouseover(function() {
            $(this).parent().addClass('open');

        });
    });


    $('.cart').mouseleave(function() {
        $(this).removeClass('open');
    });

    $('.dropdown').mouseover(function() {
        $(this).addClass('open');
    });
    $('.dropdown').mouseleave(function() {
        $(this).removeClass('open');
    });



    $('.shop').mouseover(function() {
        $(this).children(".browse-shop").addClass('appear wp4 ');
        $(this).children(".shop-name").addClass('appear wp9 ');
    });
    $('.shop').mouseleave(function() {
        $(this).children(".browse-shop").removeClass('appear wp4 ');
        $(this).children(".shop-name").removeClass('appear wp9 ');
    });

    $('.shops').mouseover(function() {
        $(this).children(".title").addClass('appear wp4 ');
        $(this).children("hr").addClass('appear wp4 ');
        $(this).children(".xtitle").addClass('appear wp9 ');
    });
    $('.shops').mouseleave(function() {
        $(this).children(".title").removeClass('appear wp4 ');
        $(this).children("hr").removeClass('appear wp4 ');
        $(this).children(".xtitle").removeClass('appear wp9 ');
    });

</script>


<script>
//    $('.fav_icon').click(function() {
//        $(this).toggleClass('add_fav');
//        $(this).toggleClass('add_fav_solid');
//    });

</script>
<script>
//    $('.fav_star').click(function() {
//        $(this).toggleClass('rate');
//        $(this).toggleClass('rate_solid');
//    });

</script>
<script>
    $('.coll_title').click(function()
    {
        $(this).toggleClass('coll_title_in');
    });
</script>


<script src="<?= Yii::app()->request->baseUrl ?>/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?= Yii::app()->request->baseUrl ?>/css/cosmetic/jquery-ui.css">
<script src='<?= Yii::app()->request->baseUrl ?>/js/jquery.elevatezoom.js'></script>
<script>
//initiate the plugin and pass the id of the div containing gallery img 
    $("#zoom_03").elevateZoom({
        gallery: 'gallery_01',
        cursor: 'pointer',
        galleryActiveClass: 'active',
        imageCrossfade: true,
        zoomType: "inner",
        loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});
    //pass the img to Fancybox 
    $("#zoom_03").bind("click", function(e) {
        var ez = $('#zoom_03').data('elevateZoom');
        $.fancybox(ez.getGalleryList());
        return false;
    });

</script>


<script>

    $('.toggle-big1').click(function() {
        $('.toggle-div1').addClass('open');
        $('.toggle-div2').removeClass('open');
        $('.toggle-div3').removeClass('open');
        $('.toggle-big1').addClass('active');
        $('.toggle-big2').removeClass('active');
        $('.toggle-big3').removeClass('active');
    });

    $('.toggle-big2').click(function() {
        $('.toggle-div2').addClass('open');

        $('.toggle-div1').removeClass('open');
        $('.toggle-div3').removeClass('open');
        $('.toggle-big2').addClass('active');
        $('.toggle-big1').removeClass('active');
        $('.toggle-big3').removeClass('active');
    });


    $('.toggle-big3').click(function() {
        $('.toggle-div3').addClass('open');

        $('.toggle-div2').removeClass('open');
        $('.toggle-div1').removeClass('open');
        $('.toggle-big3').addClass('active');
        $('.toggle-big1').removeClass('active');
        $('.toggle-big2').removeClass('active');
    });
</script>

</body>
</html>
