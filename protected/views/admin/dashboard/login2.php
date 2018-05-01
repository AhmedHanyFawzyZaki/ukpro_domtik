<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yii.css" />
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.js"></script>
<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>-->
<body class="loginpage" style="">

<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
    <a class="brand" href="http://ukprosolutions.com/index.php" target="_blank">Uk Pro solutions</a>
    </div>
  </div>
</div>


<div class="loginpanel">
 <div class="logo" style=""><img src="<?=Yii::app()->request->baseUrl?>/images/adminlogo.jpg" alt="" /></div>
  <div class="loginpanelinner">

    <?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'id'=>'login',
'enableClientValidation'=>true,
'clientOptions'=>array(
	'validateOnSubmit'=>true,
),

)); ?>
	<div class="login-head">
    	<span>Login</span>
    </div>
	<div class="login-box">

    <div class="input-prepend">
  	<span class="add-on"><i class="fa fa-user"></i></span>
  	<?php echo $form->textFieldRow($model, 'username' , array('class'=>'txtfield', 'placeholder'=>'user name')); ?>
	</div>
      <div class="input-prepend">
  	<span class="add-on"><i class="fa fa-unlock-alt"></i></span>
	<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'txtfield' , 'placeholder'=>'password') ); ?>
    </div>


	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Login','type'=>'primary')); ?>
    <?php $this->endWidget(); ?>
    </div>
  </div>
  <!--loginpanelinner-->
</div>
<!--loginpanel -->
</body>
