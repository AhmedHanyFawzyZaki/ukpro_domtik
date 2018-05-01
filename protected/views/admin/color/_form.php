<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'color-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textAreaRow($model,'title',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

        
        
<p><?php  echo $form->dropDownListRow($model, 'product_id',CHtml::listData(Product::model()->findAll(), 'id', 'title'),array('prompt'=>'select Product','class'=>'listtxt'));?></p>


	<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'temp1',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'temp2',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
