<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="<?php echo Yii::app()->basePath ?>/img/logo.png">
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
            
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/travel/bootstrap.css" /> 
         <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/travel/star-rating.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css//travel/font-awesome.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/travel/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/travel/open-sans.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/travel/jquery-ui.css" />
           <link href="<?php echo Yii::app()->baseUrl; ?>/css/travel/animate.css" rel="stylesheet" type="text/css" />
         

         
      
        
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
      
     <header class="header">
     <div class="container">
     <div class="wrap">
     <div class="col-md-2 col-sm-7 col-xs-12 logo">
    <a class="" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home"><img alt="Exclusive luxe" src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/logo.png"></a>
     </div><!--end logo-->
     
     <ul class="col-md-5 col-sm-5 col-xs-12 nav nav-pills">
         <li class="active" role="presentation"><a href="<?php echo Yii::app()->getBaseUrl(TRUE)."/travel" ?>">Travel</a></li>
      <li class="active" role="presentation"><a href="<?php echo Yii::app()->getBaseUrl(TRUE)."/travel/flight" ?>">flight</a></li>
      <li role="presentation"><a href="<?php echo Yii::app()->getBaseUrl(true) ?>/travel/search_hotels?search_keyword=London%2C+United+Kingdom+-+2882+hotels&location_id=4254&name=&check_in=21%2F12%2F2014&check_out=22%2F12%2F2014&rooms=1&guests=1&currency=GBP">hotels</a></li>
      <!--<li role="presentation"><a href="#">news</a></li>-->
    </ul>
    
    <div class="col-md-5 col-xs-5 sign pull-right">
        
         <?php if (isset(Yii::app()->user->id)) {
                            ?>
                            <div class="row login-div">
                                <a class="btn btn-default login-bt" href="<?php echo Yii::app()->getBaseUrl(true); ?>/users/dashboard">Dashboard Area</a>
                                <a class="btn btn-default gbp-bt"   href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/logout">Logout</a>
                            </div>
                        <?php } else { ?>
    <a href="#" class="btn btn-default login-bt" data-target="#join-modal" data-toggle="modal">Join</a>
    <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/register" class="btn btn-default gbp-bt">SELLER SIGN UP</a>
   
                        <?php } ?>
    </div><!--end sign-->
    
    
    <!-- Join Modal -->
<div class="modal fade" id="join-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Join</h4>
      </div>
      
      <div class="modal-body">
<!--        <form role="form">
          <div class="form-group">    
            <input class="form-control" placeholder="Enter email" type="email" name="email" id="email" value="" title="Please fill out this field with your email address." required / >
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" title="Minmimum 5 letters or numbers." required />
          </div>
          <div class="form-group">
           <span class="login-link">Already a member: <a href="login.html" class="close login" data-dismiss="modal" data-toggle="modal" data-target="#login-modal">Login</a></span>
          </div>
          <button type="submit" class="btn btn-default log-btn">Join</button>
        </form>-->




 <?php
                                $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'user-register-form',
                                    /*
                                      'action' => Yii::app()->createUrl('/home/join'),

                                      'enableClientValidation' => true,
                                      'clientOptions' => array(
                                      'validateOnSubmit' => true,
                                      ),
                                     */
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
               // parent.location.href = "' . Yii::app()->request->baseUrl . '/home/index";

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
<!-- Join Modal -->
    
    
    <!--Login Modal-->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="login-icon"><img src="../img/login-icon.png" alt="" /></span>Login</h4>
      </div>
      <div class="modal-body">
      
      
<!--        <form role="form" action="../dashboard.html">
          <div class="form-group">    
            <input class="form-control" placeholder="Enter email" type="email" name="email" id="email" value="" title="Please fill out this field with your email address." required >
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" title="Minmimum 5 letters or numbers." required>
          </div>
          <div class="form-group">
           <span class="login-link">Don't have an account ? <a href="../register.html">Register</a></span>
          </div>
          
          <div class="form-group">
                                    <span class="login-link"><a data-target="#forgot-modal" data-toggle="modal" data-dismiss="modal" class="close login">Forgot Your Password ?</a></span>
                                </div>
          <button type="submit" class="btn btn-default log-btn">login</button>
        </form>-->
<?php
   $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'login-form',
                                    /*
                                      'action' => Yii::app()->createUrl('/home/Login'),

                                      'enableClientValidation' => true,
                                      'clientOptions' => array(
                                      'validateOnSubmit' => true,
                                      'validateOnChange' => true,
                                      'validateOnType' => false,
                                      ),
                                     */
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
                                    <span class="login-link"><a  class="close login" data-dismiss="modal" data-toggle="modal" data-target="#forgot-modal">Forgot Your Password ? </a></span>
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

<!--forget-modal-->

<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="login-icon"><img src="../img/login-icon.png" alt="" /></span>Forgot Password!</h4>
      </div>
      <div class="modal-body">
      
      
<!--        <form role="form" action="../dashboard.html">
       
          <div class="form-group">    
            <input class="form-control" placeholder="Enter email" type="email" name="email" id="email" value="" title="Please fill out this field with your email address." required >
          </div>
          
          
          
          
          <button type="submit" class="btn btn-default log-btn">send</button>
        </form>-->

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

<!--end forget-modal-->
     </div>
     </div>
     </header>
        
        <?php echo $content ?>

        
        

<footer class="footer">
<div class="container">
<div class="wrap">

<div class="col-md-2">

<ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
<li><span class="ul-title">company</span></li>
<li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/faq">faq</a></li>
<li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/contact us">contact us</a></li>
<li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/about-site">about site</a></li>
<li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/about-us">about us</a></li>

<li><span class="ul-title">hello</span></li>
<li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/hola">hola</a></li>

<li><span class="ul-title">policy</span></li>
<li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/privacy-policy">privacy policy</a></li>
<li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/terms-of-condition">terms of condition</a></li>

</ul>
</div>

<div class="col-md-3" style="width:18% !important;">
<ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
<li><span class="ul-title">category:</span></li>
<li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/clothes">clothes</a></li>
<li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/clothes">travel</a></li>
<li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/clothes">cosmetics</a></li>
<li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/clothes">jewelery</a></li>
<li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/clothes">motor</a></li>
<li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/clothes">home decore</a></li>
</ul>
</div>

<div class="col-md-2">
 <ul style="max-width: 300px; margin-top:30px;" class="nav nav-pills nav-stacked">
 <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/clothes">electronics</a></li>
 <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/clothes">kids</a></li>
 <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/clothes">lifestyle</a></li>
 <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/home/clothes">real state</a></li>
 </ul>
</div>

<div class="col-md-3 col-sm-12 pull-right">
<div class="logo" style="text-align: right;">
<a class="" href="<?php echo Yii::app()->getBaseUrl(true); ?>/home"><img alt="Exclusive luxe" src="<?php echo Yii::app()->getBaseUrl(true); ?>/image/travel/footer-logo.png"></a>
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
                <p class="download pull-right">copyright © 2014 . All Rights Reserved .</p>
            </div>

</div>

</div>

</footer>
 
 <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/travel/jquery.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/travel/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/travel/waypoints.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/travel/star-rating.js"></script>
        <!--<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/travel/jquery-ui.js"></script>-->
        
         <script>
  $(function() {
    $( ".slider-price" ).slider({
      range: true,
      min: 0,
      max: 1000000,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( ".price" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( ".price" ).val( "$" + $( ".slider-price" ).slider( "values", 0 ) +
      " - $" + $( ".slider-price" ).slider( "values", 1 ) );
  });
  
  $(function() {
    $( "#slider-age" ).slider({
      range: true,
      min: 0,
      max: 80,
      values: [ 0, 80 ],
      slide: function( event, ui ) {
        $( "#age" ).val(  ui.values[ 0 ]+ " - " + ui.values[ 1 ]+ "Years" );
      }
    });
    $( "#age" ).val(  $( "#slider-age" ).slider( "values", 0 ) + " - " + $( "#slider-age" ).slider( "values", 1 )+
      "Years"  );
  });
  </script>
        

   <script>
   
     $('.oneway').click(function() {
		 $('.return-visible').hide();
        $('.return-invisible').show();
        
        $(this).attr('class','oneway active');
        $('.round-trip').attr('class','round-trip');
       
    });
	
	
	 $('.round-trip').click(function() {
		 $('.return-invisible').hide();
        $('.return-visible').show();
        
        $(this).attr('class','round-trip active');
        $('.oneway').attr('class','oneway');
       
    });
   </script>
   
 
     
         
    
        
        
        

        
     
     
     
     
      
      