<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'event-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>
<div class="control-group ">
<label class="control-label" for="Event_title">Start Day<span class="required">*</span></label>

<div class="controls">
	<?php 
$form->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model' => $model,
    'attribute' => 'start',
    'htmlOptions' => array(
        'size' => '10', // textField size
        'maxlength' => '10', // textField maxlength
        'class' => 'small2 calender',
        'placeholder' => 'Start Day',
    ),
    'options' => array(
        'numberOfMonths' => 1,
        'showButtonPanel' => true,
    ),
));
        
        ?></div></div>
<div class="control-group ">
<label class="control-label" for="Event_title">End Day <span class="required">*</span></label>
<div class="controls">
	<?php 
$form->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model' => $model,
    'attribute' => 'end',
    'htmlOptions' => array(
        'size' => '10', // textField size
        'maxlength' => '10', // textField maxlength
        'class' => 'small2 calender',
        'placeholder' => 'End Day',
    ),
    'options' => array(
        'numberOfMonths' => 1,
        'showButtonPanel' => true,
    ),
));        
 ?></div></div>

	<?php echo $form->textFieldRow($model,'allDay',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'color',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
