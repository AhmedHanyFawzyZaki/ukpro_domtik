<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';

?>
  <!-- alerts -->





    <!-- alerts -->

<div class="content">

<div class="emak-academy">

<?php // echo Yii::app()->user->getFlash('ErrorMsg'); ?>
<?php


if(Yii::app()->user->hasFlash('ErrorMsg') )
{
	?>

	  <div class="alert alert-error">
     <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('ErrorMsg'); ?>.
    </div>

	<?

}

?>
<div class="log-in-section">
<h2>Forgot Password</h2>




<div class="form logform">
<p>Enter your email address and we'll send you a link to reset your password. </p>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'id'=>'user-form',
'enableClientValidation'=>true,
'clientOptions'=>array(
	'validateOnSubmit'=>true,
),
)); ?>



<?php echo $form->textFieldRow($model, 'email', array('class'=>'span6')); ?>


	

	<div class="buttons">
		<?php echo CHtml::submitButton('Submit' ,array('class'=>'btn btn-large btn-danger')); ?>
	</div>
<span class="required">&nbsp;</span>


<?php $this->endWidget(); ?>

<div class="clear"></div>
</div><!-- form -->
</div>
</div>
</div>
