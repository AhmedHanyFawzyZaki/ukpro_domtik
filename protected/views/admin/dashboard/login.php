<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="shortcut icon" href="<?php echo Yii::app()->getBaseUrl(true); ?>/img/logo.png"> 
        
        <!--<link rel="stylesheet" href="assets/css/bootstrap.min.css">
       ">
        <link rel="stylesheet" href="assets/magic/magic.css"> -->
        
        
       <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />

		
         <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/main.js"></script>

        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/login.css">

        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/Font-awesome/css/font-awesome.min.css"/>
   
    </head>
    <body>
    
        <div class="container">
            <div class="text-center">
               <img src="<?=Yii::app()->request->baseUrl?>/img/logo.png" alt="<?= Yii::app()->name; ?>" />
            </div>
            <?php
            if(Yii::app()->user->hasFlash('ErrorMsg') )
            {
            ?>
                <div class="alert alert-error">
                <!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
                <span class="close" data-dismiss="alert">&times;</span>
                <strong></strong> <?php echo Yii::app()->user->getFlash('ErrorMsg'); ?>.
                </div>
            <?php
            }
            ?>
            <?php
            if(Yii::app()->user->hasFlash('Reset-success') )
            {
            ?>
                <div class="alert alert-error">
                <!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
                <span class="close" data-dismiss="alert">&times;</span>
                <strong></strong> <?php echo Yii::app()->user->getFlash('Reset-success'); ?>.
                </div>
            <?php
            }
            ?>
            <?php
            if(Yii::app()->user->hasFlash('error') )
            {
            ?>
                <div class="alert alert-error">
                <!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
                <span class="close" data-dismiss="alert">&times;</span>
                <strong></strong> <?php echo Yii::app()->user->getFlash('error'); ?>.
                </div>
            <?php
            }
            ?>
            <div class="tab-content">
                <div id="login" class="tab-pane active">
                      <div class="form-signin">
            <?php /** @var BootActiveForm $form */
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'login',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
                
                ));
             ?>
                      
                <p class="muted text-center">
                    Enter your username and password
                </p>
             <?php echo $form->textFieldRow($model, 'username' , array('class'=>'input-block-level', 'placeholder'=>'Username')); ?>
             <?php echo $form->passwordFieldRow($model, 'password', array('class'=>'input-block-level' , 'placeholder'=>'Password') ); ?>
        
                <button class="btn btn-large signin_btn btn-block" type="submit">Sign In</button>
           <?php $this->endWidget(); ?>
                    
                </div>
                </div>
                <div id="forgot" class="tab-pane">
                    <form action="<?php echo Yii::app()->request->baseUrl; ?>/admin/dashboard/forgotpass" class="form-signin" method="post">
                        <p class="muted text-center">
                            Enter your valid e-mail
                        </p>
                        <input type="email" placeholder="mail@domain.com" required class="input-block-level" name="User[email]">
                        <br>
                        <br>
                        <button class="btn btn-large btn-danger btn-block" type="submit">Recover Password</button>
                    </form>
                </div>
            </div>
            <div class="text-center">
                <ul class="inline">
                    <!--<li><a class="muted" href="#login" data-toggle="tab">Login</a></li>-->
                   <li><a class="muted" href="javascript: <!--void(0);" onclick="showforget();">Forgot Password</a></li>
                    <!--<li><a class="muted" href="#signup" data-toggle="tab">Signup</a></li>-->
                </ul>
            </div>
            
        </div> <!-- /container -->
       <script>
    function showforget(){
        var login = document.getElementById('login');
        var forget = document.getElementById('forgot');
        login.style.display = 'none';
        forget.style.display = 'block';
    }
</script>
    </body>
</html>
