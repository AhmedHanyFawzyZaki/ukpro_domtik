<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
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
               <img src="<?=Yii::app()->request->baseUrl?>/img/adminlogo.png" alt="Ukprosolutions" />
            </div>

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
                    Enter your new password
                </p>
             
             <?php echo $form->passwordFieldRow($model, 'newpassword', array('class'=>'input-block-level' , 'placeholder'=>'password') ); ?>
        
                <button class="btn btn-large btn-primary btn-block" type="submit">Reset Password</button>
                <?php $this->endWidget(); ?>
                    
                </div>
                </div>
              
            </div>
          
            
        </div> <!-- /container -->
       
    </body>
</html>
