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
        $cont_arr = array("cosmetic", "cloths", "jewelry", "motor", "travel", "kids","decor","lifestyle","realstate");
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

        <!-- Favicons -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->getBaseUrl(true); ?>/img/logo.png"> 
    </head>

    <body>
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
                        <?php //if (isset(Yii::app()->user->id)) { ?>
            <div class="cart">
                                    </a>
            <?php $carts = Yii::app()->user->getState('cart');
            $count=count($carts);
            ?>         
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/ShoppingCart" class="cart-icon dropdown-toggle animated fadeInUp" data-toggle="dropdown" id="mycart">
            	<span><?php echo $count; ?></span>
            </a>      
                                       
                                 <ul aria-labelledby="mycart" role="menu" class="dropdown-menu cart-list">
                                        <li class="view"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/ShoppingCart">View My Cart</a></li>
                                    <?php if(!empty($count)){ 
                                           foreach ($carts as $cart){     
                                        ?>
                                        <li><a href="#" role="menuitem" class="col-md-5 cart-img"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/media/product/<?php echo $cart->main_image; ?>" alt="" /></a>
                                            <div class="col-md-7">
                                                <a href="#" class="drop-name"><?php echo   $cart->title;?></a>
                                                <p class="cart-price"><?php echo $cart->category->title; ?></p>
                                                <p class="cart-price"><?php  echo $cart->price;?> GBP</p>
                                                <span class="cart-qt"><?php echo $cart->quantity;  ?> </span>
                                            </div>
                                        </li>
                                         <?php } } ?>
                                        </li>
                                    </ul>
            </div>
                            <form class="form-inline animated fadeInUp">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                                        <input class="form-control" type="email" placeholder="Search">
                                    </div>
                                </div>
                            </form>
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
                                
                                <div class="form-group">
                                    <span class="login-link">Forget Your Password: <a  class="close login" data-dismiss="modal" data-toggle="modal" data-target="#forget-modal">Forgot Password</a></span>
                                </div>
                                <!--                                    <button type="submit" class="btn btn-default log-btn">Join</button>-->
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
                //parent.location.href = "' . Yii::app()->request->baseUrl . '/users/editprofile";

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
                                         parent.location.href = "' . Yii::app()->request->baseUrl . '/home/index";

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
                
                <!--forget modal-->
   <div class="modal fade" id="forget-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel"><span class="login-icon"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/<?php echo $cont; ?>/login-icon.png" alt="" /></span>Forget Password</h4>
                            </div>
                            <div class="modal-body">
<?php
//echo 'dddd';
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'forget-form',
    'action' => Yii::app()->createUrl('/home/Forgotpass'),
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
<?php echo $form->textField($this->forget_password, 'email', array('class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter your Email', 'title' => 'Please fill out this field with your email.', 'required' => 'required')); ?>
                                    <?php echo $form->error($this->user_login, 'email'); ?>
                                </div>
                               
<!--                                <div class="form-group">
                                    <span class="login-link">Don't have an account ? <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/register">Register</a></span>
                                </div>-->
<?php
echo CHtml::ajaxSubmitButton(
        'Submit', array('/home/Forgotpass'), array(
    'beforeSend' => 'function(){
                                             $("#login").attr("disabled",true);
            }',
    'complete' => 'function(){
                                             $("#forget-form").each(function(){ this.reset();});
                                             $("#login").attr("disabled",false);
                                        }',
    'success' => 'function(data){
                                             //var obj = jQuery.parseJSON(data);
                                             if(data == "wrong"){
												 $("#forget-error-div").show();
                                                $("#forget-error-div").html("<h4><Plesae write your e-mail correctly.</h4>");$("#login-error-div").append("");

                                      }
          else{

			   $("#forget-error-div").html("<h4>Please check your e-mail to reset your password!</h4>");
                                         parent.location.href = "' . Yii::app()->request->baseUrl . '/home/index";

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
                                ?>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
                
                
