<!DOCTYPE html>
<html>
    <head>
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
        if ($xml->geoplugin_countryName != 'Egypt') {
            $show = 1;
            ?>
            <meta name="verification" content="defad876bcc1a7c994212a0ddfc8bc26" />
            <!-- TradeDoubler site verification 2452783 -->
        <?php } else $show = 0; ?>
        <link rel="shortcut icon" href="<?php echo Yii::app()->getBaseUrl(true); ?>/img/logo.png"> 
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/electronic/bootstrap.css"> 
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/electronic/font-awesome.css"> 
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/electronic/style.css">       
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/electronic/style2.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/electronic/component.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/electronic/animate.css" />
        <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/electronic/open-sans.css" rel='stylesheet'>
        <script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/electronic/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/electronic/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/electronic/waypoints.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/electronic/java.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/electronic/easing.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/electronic/jquery.ui.totop.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/electronic/modernizr.custom.28468.js"></script>
        <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/electronic/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
        <script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/electronic/star-rating.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                var defaults = {
                    containerID: 'toTop', // fading element id
                    containerHoverID: 'toTopHover', // fading element hover id
                    scrollSpeed: 300,
                    easingType: 'linear'
                };
                $().UItoTop({easingType: 'easeOutQuart'});

                $(".boot-tooltip a,.boot-tooltip i").tooltip({
                    placement: 'top'
                });

                $(".cart a").click(function() {
                    $(".cart-cycle").slideToggle();
                });

            });
        </script>

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

        <!-- header start -->
        <div id="header">
            <div class="container">
                <div class="row"> 

                    <div class="col-md-9 col-sm-6 col-xs-12 header-adv pull-right">

                        <div class="top-btn">
                            <ul>
                                <?php if (isset(Yii::app()->user->id)) {
                                    ?>
                                    <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/users/dashboard">Dashboard Area</a></li>
                                    <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/logout">LOGOUT</a></li>
                                <?php } else { ?>
                                    <li><a data-toggle="modal" href="#join-modal">JOIN</a></li>
                                    <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/register">SELLER SIGN UP</a></li>
                                <?php } ?>
                            </ul>
                        </div>
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
                                            <?php echo $form->textField($this->user_signUp, 'username', array('class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter user name', 'title' => 'Please fill out this field with your user name.', 'required' => 'required')); ?>
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
                                        <h4 class="modal-title" id="myModalLabel"><span class="login-icon"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/<?php echo $cont; ?>/login-icon.png" alt="" /></span>Login</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php
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
                                        </div> <div class="form-group">
                                            <span class="login-link">Forgot Your Password ? <a  class="close login" data-dismiss="modal" data-toggle="modal" data-target="#forgot-modal">Forgot</a></span>
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
                                        parent.location.href = "' . Yii::app()->request->baseUrl . '/home/index";
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

                        <div id="search">
                            <form class="form-inline search hidden-xs" method="post" action="<?= Yii::app()->getBaseUrl(true) ?>/home/search">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                                    <input class="form-control search-input input-sm col-xs-10" type="text" value="<?= Yii::app()->user->getState('search-key') ?>" placeholder="Search" name="keyword">
                                </div>
                            </form>
                        </div>
                        <?php
                        $carts = Yii::app()->user->getState('cart');
                        $count = count($carts);
                        ?>
                        <div class="cart">
                            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/ShoppingCart" class="cart-icon dropdown-toggle " data-toggle="dropdown" id="mycart">
                                <label><?= $count; ?></label>
                            </a>

                            <ul aria-labelledby="mycart" role="menu" class="dropdown-menu cart-list">
                                <li class="view"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/ShoppingCart">View My Cart</a></li>
                                <?php
                                if (!empty($count)) {
                                    foreach ($carts as $key => $products) {
                                        if ($key == 1) {
                                            $cont = "cloths";
                                            $item = "item";
                                        } elseif ($key == 2) {
                                            $cont = "travel";
                                        } elseif ($key == 3) {
                                            $item = "item";
                                            $cont = "cosmetic";
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
                                            $item = "item";
                                            $cont = "lifestyle";
                                        } elseif ($key == 10) {
                                            $item = "item";
                                            $cont = "realstate";
                                        }
                                        foreach ($products as $pro_id => $details) {
                                            $product = Product::model()->findByPk($pro_id);
                                            ?>
                                            <li><a href="javascript:void(0);" role="menuitem" class="col-md-5 cart-img"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $product->main_image; ?>" alt="" /></a>
                                                <div class="col-md-7">
                                                    <a href="javascript:void(0);" class="drop-name"><?php echo $cart[$pro_id]["title"]; ?></a>
                                                    <p class="cart-price"><?php echo $product->category->title; ?></p>
                                                    <p class="cart-price"><?php echo $product->price; ?> GBP</p>
                                                    <span class="cart-qt"><?php echo $product->quantity; ?> </span>
                                                </div>
                                            </li>
        <?php }
    }
} ?>
                            </ul>
                        </div>



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
                        <div class="latest-product">
                            <div class="dropdown">
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
                                        <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/cloths/item/id/$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?><?= $product_title ?></a></li>
                                    <?php } ?>
                                    <?php
                                    if ($product_category == 2) {
                                        ?>
                                        <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/travel/item/id/$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?><?= $product_title ?></a></li>
                                    <?php } ?>
                                    <?php
                                    if ($product_category == 3) {
                                        ?>
                                        <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/cosmetic/item?id=$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?><?= $product_title ?></a></li>
                                    <?php } ?>

                                    <?php if ($product_category == 4) {
                                        ?>
                                        <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/jewelry/item?id=$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?><?= $product_title ?></a></li>
                                    <?php } ?>

                                    <?php if ($product_category == 5) {
                                        ?>
                                        <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/motor/item?id=$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?><?= $product_title ?></a></li>
                                    <?php } ?>

                                    <?php if ($product_category == 6) {
                                        ?>
                                        <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/decor/details/id/$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?><?= $product_title ?></a></li>
                                    <?php } ?>

                                    <?php if ($product_category == 7) {
                                        ?>
                                        <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/electronic/details?pro_id=$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?><?= $product_title ?></a></li>
                                    <?php } ?>

                                    <?php if ($product_category == 8) {
                                        ?>
                                        <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/kids/details?pro_id=$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?><?= $product_title ?></a></li>
                                    <?php } ?>
                                    <?php if ($product_category == 9) {
                                        ?>
                                        <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/lifestyle/item?id=$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?><?= $product_title ?></a></li>
                                    <?php } ?>
<?php if ($product_category == 10) {
    ?>
                                        <li><a href="<?php echo Yii::app()->getBaseUrl(true) . "/realstate/item/id/$last_product_id" ?>" ><img src="<?= Yii::app()->request->baseUrl . "/media/product/$product_image" ?>"><?= $product_title ?><?= $product_title ?></a></li>
<?php } ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="header-logo col-md-3 col-sm-6 col-xs-12 pull-left ">
                        <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/index"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>            
        </div>
        <!-- header end -->

        <div class="clearfix"></div>

        <!-- menu start -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
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
                                    $prodcats = ProductCategory::model()->findAll(array('condition' => 'category_id=' . $cat->id));

                                    if ($prodcats) {
                                        ?>

                                        <li class="dropdown">
                                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/<?php
                                            if ($cat->id == 1) {
                                                echo"cloths";
                                            } elseif ($cat->id == 2) {
                                                echo"travel";
//                                                echo '#';
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
                                                <?php }
                                            }
                                            ?>

                                    </ul>


                                    </div><!-- /.navbar-collapse -->
                                    </nav>
                                    </div>
                                    </div>
                                    </div>
<?php
$cats = ProductCategory::model()->findAll(array('condition' => 'category_id = 7','limit'=>10));
if ($cats) {
    ?>
                                        <div id="menu">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-xs-12">	
                                                        <div class="menu-content animated fadeInDown delay-05s hidden-xs">
                                                            <nav id="navigation" class="">
                                                                <ul id="main-menu">
                                                                    <li class="wp6"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/index"><i class="fa fa-home"></i></a></li>
    <?php
    foreach ($cats as $cat) {
        $subcats = SubCategory::model()->findAll(array('condition' => 'product_category_id=' . $cat->id ,'limit'=>10));
        if ($subcats) {
            echo '
                                                <li class="dropdown">
                                                    <a href="' . Yii::app()->request->baseUrl . '/electronic/category?cat_id=' . $cat->id . '" class="dropdown-toggle">' . $cat->title . '</a>
                                                    <ul class="dropdown-menu" role="menu">';
            foreach ($subcats as $sub) {
                echo '<li><a href="' . Yii::app()->request->baseUrl . '/electronic/category?cat_id=' . $cat->id . '">' . $sub->title . '</a></li>';
            }
            echo '
                                                    </ul>
                                                </li>';
        } else {
            echo '<li><a href="' . Yii::app()->request->baseUrl . '/electronic/category?cat_id=' . $cat->id . '">' . $cat->title . '</a></li>';
        }
    }
    ?>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- menu end -->
    <?php
}
?>

                                    <div id="container">
                                        <div class="container">
<?php
echo $content;
?>
                                        </div>
                                    </div>

                                    <!-- footer start -->
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


                                                <div class="col-md-3" style="width:20% !important;">
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
                                                            echo "travel";
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
                                    <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/electronic/jquery.cslider.js"></script>
                                    <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/electronic/jquery.elevatezoom.js"></script>

                                    <script>
            $("#zoom_03").elevateZoom({
                gallery: 'gallery_01',
                cursor: 'pointer',
                galleryActiveClass: 'active',
                imageCrossfade: true,
                loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});

            $("#zoom_03").bind("click", function(e) {
                var ez = $('#zoom_03').data('elevateZoom');
                $.fancybox(ez.getGalleryList());
                return false;
            });
                                    </script>

                                    <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/electronic/classie.js"></script>
                                    <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/electronic/cbpViewModeSwitch.js"></script>

                                    <script type="text/javascript">
            $(function() {

                $('#da-slider').cslider({
                    autoplay: true,
                    bgincrement: 450
                });

            });

            $('.zoom_01').elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750
            });
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



                                    </script>

                                    <script>

                                        $('.dropdown').mouseover(function() {
                                            $(this).addClass('open');
                                        });
                                        $('.dropdown').mouseleave(function() {
                                            $(this).removeClass('open');
                                        });
                                    </script>
                                    </body>
                                    </html>
