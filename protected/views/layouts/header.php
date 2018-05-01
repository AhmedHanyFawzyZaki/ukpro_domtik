<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if ($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if ($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
//$IPDetail = Helper::getvisitorinfo($ipaddress);
        $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ipaddress);
      //  $xml->geoplugin_countryName = '';
        if ($xml->geoplugin_countryName != 'Egypt') {
            $show = 1;
            ?>
            <meta name="verification" content="defad876bcc1a7c994212a0ddfc8bc26" />
            <!-- TradeDoubler site verification 2452783 -->
        <?php } else $show = 0; ?>
        <!-- Favicons -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->getBaseUrl(true); ?>/img/logo.png"> 


        <?php
        $cont_arr = array("cosmetic", "cloths", "jewelry", "motor", "travel", "kids", "decor", "lifestyle", "realstate");
        if (in_array(Yii::app()->controller->id, $cont_arr)) {
            $cont = Yii::app()->controller->id;
            ?>
            <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/<?= $cont ?>/bootstrap.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/<?= $cont ?>/font-awesome.css" rel="stylesheet">
            <!-- Documentation extras -->
            <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/<?= $cont ?>/style.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/<?= $cont ?>/animate.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/<?= $cont ?>/open-sans.css" rel='stylesheet'>
            <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/<?= $cont ?>/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
            <?php
        } else {
            ?>
            <!-- Bootstrap core CSS -->
            <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/general/bootstrap.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/general/font-awesome.css" rel="stylesheet">
            <!-- Documentation extras -->
            <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/general/style.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/general/animate.css" rel="stylesheet">
            <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/general/open-sans.css" rel='stylesheet'>
        <?php } ?>










<!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <?php if ($show == 1) { ?>
               <script>
                    (function(i, s, o, g, r, a, m) {
                        i['GoogleAnalyticsObject'] = r;
                        i[r] = i[r] || function() {
                            (i[r].q = i[r].q || []).push(arguments)
                        }, i[r].l = 1 * new Date();
                        a = s.createElement(o),
                                m = s.getElementsByTagName(o)[0];
                        a.async = 1;
                        a.src = g;
                        m.parentNode.insertBefore(a, m)
                    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

                    ga('create', 'UA-55669146-1', 'auto');
                    ga('send', 'pageview');

                </script>
        <?php } ?>
        <div class="container">
            <div class="wrap">
                <header class="header">
                    <div class="col-md-4 logo col-sm-7 col-xs-12">
                        <a href="<?php echo Yii::app()->getBaseUrl(true); ?>" class=""><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/logo.png" alt="Exclusive luxe"></a>
                    </div>
                    <div class="col-md-5 col-md-offset-3 col-sm-5 col-xs-12">
                        <?php if (isset(Yii::app()->user->id)) {
                            ?>
                            <div class="row login-div">
                                <a class="register animated fadeInDown delay-05s" href="<?php echo Yii::app()->getBaseUrl(true); ?>/users/dashboard">Dashboard Area</a>
                                <a class="join animated fadeInDown delay-07s"   href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/logout">Logout</a>
                            </div>
                        <?php } else { ?>
                            <div class="row login-div">
                                <a class="register animated fadeInDown delay-05s" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/register">SELLER SIGN UP</a>
                                <a class="join animated fadeInDown delay-07s" data-toggle="modal" data-target="#join-modal" href="#join-modal">JOIN</a>
                            </div>
                        <?php } ?>
                        <div class="row search-part">
                            <?php //if (isset(Yii::app()->user->id)) {  ?>
                            <div class="cart">
                                <?php
                                $carts = Yii::app()->user->getState('cart');
                                $count = count($carts);
                                ?>         
                                <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/ShoppingCart" class="cart-icon dropdown-toggle animated fadeInUp" data-toggle="dropdown" id="mycart">
                                    <span><?php echo $count; ?></span>
                                </a>      

                                <ul aria-labelledby="mycart" role="menu" class="dropdown-menu cart-list">
                                    <li class="view"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/ShoppingCart">View My Cart</a></li>
                                    <?php
                                    if (!empty($count)) {

                                        foreach ($carts as $key => $cart) {
                                            if ($key == 1) {
                                                $cont = "cloths";
                                                $item = "item";
                                            } elseif ($key == 2) {
                                                $cont = "travel";
                                            } elseif ($key == 3) {
                                                $cont = "cosmetic";
                                                $item = "item";
                                            } elseif ($key == 4) {
                                                $item = "item";
                                                $cont = "jewelry";
                                            } elseif ($key == 5) {
                                                $item = "item";
                                                $cont = "motor";
                                            } elseif ($key == 6) {
                                                $item = "details";
                                                $cont = "decor";
                                            } elseif ($key == 7) {
                                                $item = "details";
                                                $cont = "electronic";
                                            } elseif ($key == 8) {
                                                $item = "details";
                                                $cont = "kids";
                                            } elseif ($key == 9) {
                                                $cont = "lifestyle";
                                                $item = "item";
                                            } elseif ($key == 10) {
                                                $item = "item";
                                                $cont = "realstate";
                                            }
                                            foreach ($cart as $pro_id => $crt) {
                                                $product = Product::model()->findByPk($pro_id);
                                                $controller = Yii::app()->controller->id;
                                                ?>
                                                <li><a href="javascript:void(0);" role="menuitem" class="col-md-5 cart-img"><img src="<?= Yii::app()->request->baseUrl ?>/media/product/<?php echo $product->main_image; ?>" alt="" /></a>
                                                    <div class="col-md-7">
                                                        <a href="javascript:void(0);" class="drop-name"><?php echo $product->title; ?></a>
                                                        <p class="cart-price"><?php echo $product->category->title; ?></p>
                                                        <p class="cart-price"><?php echo $product->price; ?> GBP</p>
                                                        <span class="cart-qt"><?php echo $product->quantity; ?> </span>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <form class="form-inline animated fadeInUp" method="post" action="<?= Yii::app()->getBaseUrl(true) ?>/home/search">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                                        <input class="form-control" type="text" placeholder="Search" name="keyword" value="<?= Yii::app()->user->getState('search-key'); ?>">
                                    </div>
                                </div>
                            </form>
                            <div class="latest-product">
                                <div class="dropdown">

                                    <?php
                                    if ($_GET['id'] or Yii::app()->session['last_product_visit']) {
                                        if (Yii::app()->session['last_product_visit'] != '') {
                                            $arr = Yii::app()->session['last_product_visit'];
                                            if (isset($_GET['id']) and $arr[sizeof($arr) - 1] != $_GET['id']) {
                                                $arr [] = $_GET['id'];
                                            }
                                            Yii::app()->session['last_product_visit'] = $arr;
                                            $last_products = Yii::app()->session['last_product_visit'];
                                            $last_product_id = $last_products[sizeof($last_products) - 2];
                                        } else {
                                            $arr = array();
                                            if (isset($_GET['id']))
                                                $arr [] = $_GET['id'];
                                            Yii::app()->session['last_product_visit'] = $arr;
                                            $last_product_id = $_GET['id'];
                                        }

                                        // print_r($arr);
                                    }
                                    ?>

                                    <a data-toggle="dropdown" href="#">Latest visit</a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                        <?php
                                        $product_category = Product::model()->findByPk($last_product_id)->category_id;
                                        $product_title = Product::model()->findByPk($last_product_id)->title;
                                        $product_image = Product::model()->findByPk($last_product_id)->main_image;
                                        ?>
                                        <?php
                                        if ($product_category == 1) {
                                            ?>
                                            <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/cloths/item/id/$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?></a></li>
                                        <?php } ?>
                                        <?php
                                        if ($product_category == 2) {
                                            ?>
                                            <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/travel/item/id/$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?></a></li>
                                        <?php } ?>
                                        <?php
                                        if ($product_category == 3) {
                                            ?>
                                            <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/cosmetic/item?id=$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?></a></li>
                                        <?php } ?>

                                        <?php if ($product_category == 4) {
                                            ?>
                                            <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/jewelry/item?id=$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?></a></li>
                                        <?php } ?>

                                        <?php if ($product_category == 5) {
                                            ?>
                                            <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/motor/item?id=$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?></a></li>
                                        <?php } ?>

                                        <?php if ($product_category == 6) {
                                            ?>
                                            <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/decor/details/id/$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?></a></li>
                                        <?php } ?>

                                        <?php if ($product_category == 7) {
                                            ?>
                                            <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/electronic/details?pro_id=$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?></a></li>
                                        <?php } ?>

                                        <?php if ($product_category == 8) {
                                            ?>
                                            <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/kids/details?pro_id=$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?></a></li>
                                        <?php } ?>
                                        <?php if ($product_category == 9) {
                                            ?>
                                            <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/lifestyle/item?id=$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?></a></li>
                                        <?php } ?>
                                        <?php if ($product_category == 10) {
                                            ?>
                                            <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/realstate/item/id/$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Join Modal -->
                <div class="modal fade" id="join-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Join</h4>
                            </div>

                            <div class="modal-body">
                                <?php
                                $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'user-register-form',
                                    'action' => Yii::app()->createUrl('/home/join'),
                                    'enableClientValidation' => true,
                                    'clientOptions' => array(
                                        'validateOnSubmit' => true,
                                    ),
                                    'htmlOptions' => array(
                                        'class' => 'bs-docs-example form-horizontal',
                                    ),
                                ));
                                ?>
                                <div id="reg-error-div" class="alert btn-danger" style="display: none;color:#FFF"></div>
                                <div class="form-group">
                                    <?php echo $form->textField($this->user_signUp, 'email', array('class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter email', 'title' => 'Please fill out this field with your email.', 'required' => 'required')); ?>
                                    <?php echo $form->error($this->user_signUp, 'email'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->textField($this->user_signUp, 'username', array('class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter Username', 'title' => 'Please fill out this field with your username.', 'required' => 'required')); ?>
                                    <?php echo $form->error($this->user_signUp, 'username'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->passwordField($this->user_signUp, 'password', array('class' => 'form-control', 'placeholder' => 'Enter Password', 'title' => 'Please fill out this field with password.', 'required' => 'required')); ?>
                                    <?php echo $form->error($this->user_signUp, 'password'); ?>
                                </div>
                                <div class="form-group">
                                    <span class="login-link">Already a member: <a  class="close login" data-dismiss="modal" data-toggle="modal" data-target="#login-modal">Login</a></span>
                                </div>

                                <?php
                                echo CHtml::ajaxSubmitButton(
                                        'Join', array('/home/join'), array(
                                    'beforeSend' => 'function(){
                                             $("#reg").attr("disabled",true);
            }',
                                    'complete' => 'function(){
                                             //$("#user-register-form").each(function(){ this.reset();});
                                             $("#reg").attr("disabled",false);
                                        }',
                                    'success' => 'function(data){
				   				var x=data.split("*-*");
                                             if(x[0] == "wrong"){
												 $("#reg-error-div").show();
                                                $("#reg-error-div").html("<h5>Register failed!</h5>");$("#reg-error-div").append(x[1]);

                                      }
          else{
			   	$("#user-register-form").html("<h4 style=\"color:red;text-align:center;\">Congratulation, your account has been created, you can login now.</h4>");
                //parent.location.href = "' . Yii::app()->request->baseUrl . '/home/index";

                                             }

                                        }'
                                        ), array("id" => "reg", "class" => "btn btn-default log-btn")
                                );
                                ?>
                                <?php $this->endWidget(); ?>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->


                <!--Login Modal-->
                <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel"><span class="login-icon"></span>Login</h4>
                            </div>
                            <div class="modal-body">
                                <?php
//echo 'dddd';
                                $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'login-form',
                                    'action' => Yii::app()->createUrl('/home/Login'),
                                    'enableClientValidation' => true,
                                    'clientOptions' => array(
                                        'validateOnSubmit' => true,
                                        'validateOnChange' => true,
                                        'validateOnType' => false,
                                    ),
                                    'htmlOptions' => array(
                                        'class' => 'bs-docs-example form-horizontal',
                                    ),
                                ));
                                ?>
                                <div id="login-error-div" class="errorMessage" style="display: none;"></div>
                                <div class="form-group">
                                    <?php echo $form->textField($this->user_login, 'username', array('class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter username', 'title' => 'Please fill out this field with your username.', 'required' => 'required')); ?>
                                    <?php echo $form->error($this->user_login, 'username'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->passwordField($this->user_login, 'password', array('class' => 'form-control', 'placeholder' => 'Enter Password', 'title' => 'Please fill out this field with password.', 'required' => 'required')); ?>
                                    <?php echo $form->error($this->user_login, 'password'); ?>
                                </div>
                                <div class="form-group">
                                    <span class="login-link">Don't have an account ? <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/register">Register</a></span>
                                </div>
                                <div class="form-group">
                                    <span class="login-link"><a  class="close login" data-dismiss="modal" data-toggle="modal" data-target="#forgot-modal">Forgot Your Password ?</a></span>
                                </div>
                                <?php
                                echo CHtml::ajaxSubmitButton(
                                        'Log In', array('/home/login'), array(
                                    'beforeSend' => 'function(){
                                             $("#login").attr("disabled",true);
            }',
                                    'complete' => 'function(){
                                             $("#login-form").each(function(){ this.reset();});
                                             $("#login").attr("disabled",false);
                                        }',
                                    'success' => 'function(data){
                                             //var obj = jQuery.parseJSON(data);
                                             if(data == "wrong"){
												 $("#login-error-div").show();
                                                $("#login-error-div").html("<h4>Login failed! Please try again.</h4>");$("#login-error-div").append("");

                                      }
          else{

			   $("#login-form").html("<h4>Login Successful! Please Wait...</h4>");
                                         parent.location.href = "' . Yii::app()->request->baseUrl . '/users/dashboard";

                                             }

                                        }'
                                        ), array("id" => "login", "class" => "btn btn-default log-btn")
                                );
                                ?>

                                <?php $this->endWidget(); ?>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end Login Modal-->

                <!--forget Modal-->
                <div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel"><span class="login-icon"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/<?php echo $cont; ?>/login-icon.png" alt="" /></span>Forgot Password!</h4>
                            </div>
                            <div class="modal-body">
                                <?php
                                $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'forget-form',
                                    'action' => Yii::app()->createUrl('/home/forgotpass'),
                                    'enableClientValidation' => true,
                                    'clientOptions' => array(
                                        'validateOnSubmit' => true,
                                        'validateOnChange' => true,
                                        'validateOnType' => false,
                                    ),
                                    'htmlOptions' => array(
                                        'class' => 'bs-docs-example form-horizontal',
                                    ),
                                ));
                                ?>
                                <div id="forget-error-div" class="errorMessage" style="display: none;"></div>
                                <div class="form-group">
                                    <?php echo $form->textField($this->forget_password, 'email', array('class' => 'form-control span5', 'id' => 'email', 'placeholder' => 'Enter Email', 'title' => 'Please fill out this field with your username.', 'required' => 'required')); ?>
                                    <?php echo $form->error($this->forget_password, 'email'); ?>
                                </div>
                                <?php
                                echo CHtml::ajaxSubmitButton(
                                        'Send', array('/home/forgotpass'), array(
                                    'beforeSend' => 'function(){
                                    $("#forget").attr("disabled",true);
                                }',
                                    'complete' => 'function(){
                                    $("#forget-form").each(function(){ this.reset();});
                                    $("#forget").attr("disabled",false);
                               }',
                                    'success' => 'function(data){
                                    if(data == "wrong"){
                                       $("#forget-error-div").show();
                                       $("#forget-error-div").html("<h4>Sorry, there\'s no account associated with that email address</h4>");$("#login-error-div").append("");
                                    }if(data == "not-send"){
                                        $("#forget-error-div").show();
                                       $("#forget-error-div").html("<h4>Sorry, Error while sending email, Please try again later!</h4>");$("#login-error-div").append("");
                                    }
                                    else{
                                        $("#forget-form").html("<h4>Check your email. It will have a link to reset your password..</h4>");
                                        parent.location.href = "' . Yii::app()->request->baseUrl . '/home/confirm/flag/9";
                                    }
                                }'
                                        ), array("id" => "forget", "class" => "btn btn-default log-btn")
                                );
                                ?>
                                <?php $this->endWidget(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end forget Modal-->



                <nav class="navbar navbar-default" role="navigation">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <?php
                            $websitecats = Category::model()->findAll();
                            foreach ($websitecats as $cat) {
                                ?>
                                <?php
                                $prodcats = ProductCategory::model()->findAll(array('condition' => 'category_id=' . $cat->id,'limit'=>10));

                                if ($prodcats) {
                                    ?>

                                    <li class="dropdown">
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/<?php
                                        if ($cat->id == 1) {
                                            echo"cloths";
                                        } elseif ($cat->id == 2) {
                                            echo"travel";
                                        } elseif ($cat->id == 3) {
                                            echo"cosmetic";
                                        } elseif ($cat->id == 4) {
                                            echo"jewelry";
                                        } elseif ($cat->id == 5) {
                                            echo"motor";
                                        } elseif ($cat->id == 6) {
                                            echo"decor";
                                        } elseif ($cat->id == 7) {
                                            echo"electronic";
                                        } elseif ($cat->id == 8) {
                                            echo"kids";
                                        } elseif ($cat->id == 9) {
                                            echo"lifestyle";
                                        } elseif ($cat->id == 10) {
                                            echo"realstate";
                                        }
                                        ?>"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/nav/m<?php echo $cat->id; ?>.png" class="animated fadeIn delay-02s"><?php echo $cat->title; ?></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <?php
                                            foreach ($prodcats as $prodcat) {
                                                if ($cat->id == 8) {
                                                    $productcategory = "category";
                                                    $controll = "kids";
                                                } elseif ($cat->id == 10) {

                                                    $productcategory = "Category";
                                                    $controll = "realstate";
                                                } elseif ($cat->id == 3) {
                                                    $productcategory = "subCategory";
                                                    $controll = "cosmetic";
                                                } elseif ($cat->id == 4) {
                                                    $productcategory = "subCategory";
                                                    $controll = "jewelry";
                                                } elseif ($cat->id == 9) {
                                                    $productcategory = "subCategory";
                                                    $controll = "lifestyle";
                                                } elseif ($cat->id == 7) {
                                                    $productcategory = "category";
                                                    $controll = "electronic";
                                                } elseif ($cat->id == 1) {
                                                    $productcategory = "subCategory";
                                                    $controll = "cloths";
                                                } elseif ($cat->id == 6) {
                                                    $productcategory = "Sub";
                                                    $controll = "decor";
                                                } elseif ($cat->id == 5) {
                                                    $productcategory = "search";
                                                    $controll = "motor";
                                                }
                                                echo '<li><a href="' . Yii::app()->request->baseUrl . '/' . $controll . '/' . $productcategory . '?cat_id=' . $prodcat->id . '">' . $prodcat->title . '</a></li>';
                                            }
                                            echo '
                                        </ul>
                                    </li>';
                                        } else {
                                            ?>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/<?php
                                                if ($cat->id == 1) {
                                                    echo"cloths";
                                                } elseif ($cat->id == 2) {
                                                    echo"travel";
                                                   // echo '#';
                                                } elseif ($cat->id == 3) {
                                                    echo"cosmetic";
                                                } elseif ($cat->id == 4) {
                                                    echo"jewelry";
                                                } elseif ($cat->id == 5) {
                                                    echo"motor";
                                                } elseif ($cat->id == 6) {
                                                    echo"decor";
                                                } elseif ($cat->id == 7) {
                                                    echo"electronic";
                                                } elseif ($cat->id == 8) {
                                                    echo"kids";
                                                } elseif ($cat->id == 9) {
                                                    echo"lifestyle";
                                                } elseif ($cat->id == 10) {
                                                    echo"realstate";
                                                }
                                                ?>"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/nav/m<?php echo $cat->id; ?>.png" class="animated fadeIn delay-02s"><?php echo $cat->title; ?></a></li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                </ul>
                                </div><!-- /.navbar-collapse -->
                                </nav>


