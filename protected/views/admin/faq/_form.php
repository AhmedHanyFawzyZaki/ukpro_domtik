<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'faq-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        
        <p><?php  echo $form->dropDownListRow($model, 'category_id',CHtml::listData(Category::model()->findAll(), 'id', 'title'),array('prompt'=>'select Web Site Category'));?></p>

        <p><?php  echo $form->dropDownListRow($model, 'cat_id',CHtml::listData(FaqCat::model()->findAll(), 'id', 'title'),array('prompt'=>'Select faq category'));?></p>

	<?php echo $form->textFieldRow($model,'quest',array('class'=>'span5','maxlength'=>255)); ?>


	<?php echo $form->textAreaRow($model,'answer',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->checkBoxRow($model,'active'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
