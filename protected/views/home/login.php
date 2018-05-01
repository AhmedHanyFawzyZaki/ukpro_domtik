<?php
$this->pageTitle=Yii::app()->name . ' - Login';
?>




<?php
if(Yii::app()->user->hasFlash('ErrorMsg') )
{
	?>

	  <div class="alert alert-error">
     <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Error !</strong> <?php echo Yii::app()->user->getFlash('ErrorMsg'); ?>.
    </div>

	<?

}

?>


<p>Please fill out the following form with your login credentials:</p>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'id'=>'login-form',
'enableClientValidation'=>true,
'clientOptions'=>array(
	'validateOnSubmit'=>true,
),
)); ?>

	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->textFieldRow($model,'username' ,array('class'=>'span5')  ); ?>


	<?php echo $form->passwordFieldRow($model,'password' ,array('class'=>'span5')  ); ?>
<div class="left-log">
	<?php echo $form->checkBoxRow($model,'rememberMe' ,array('class'=>'span1')  ); ?>

    	<a href="<?= Yii::app()->baseurl?>/home/forgotpass" class="forgt">Forgot your password?</a>
</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Login' ,array('class'=>'btn btn-large btn-danger')); ?>
	</div>
<span class="required">&nbsp;</span>


<?php $this->endWidget(); ?>

