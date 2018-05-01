<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'colors-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>


        
        
        <?php //echo $form->textFieldRow($model,'color',array('class'=>'span5','maxlength'=>255));
	echo'<br>';
	echo CHtml::activeLabel($model,'Color');
		$this->widget('application.extensions.SMiniColors.SActiveColorPicker', array(
    'model' => $model,
    'attribute' => 'color',
   // 'class'=>'span5',
    'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
    'options' => array(), // jQuery plugin options
    'htmlOptions' => array('class'=>'span5'), // html attributes
));
	?>
	<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'temp1',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
