<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'commission-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        
        
<p><?php  echo $form->dropDownListRow($model, 'user_id',CHtml::listData(User::model()->findAll(), 'id', 'username'),array('prompt'=>'select username','class'=>'listtxt'));?></p>



<p><?php  echo $form->dropDownListRow($model, 'category_id',CHtml::listData(Category::model()->findAll(), 'id', 'title'),array('prompt'=>'select category','class'=>'listtxt'));?></p>



<p><?php  echo $form->dropDownListRow($model, 'type',array("0"=>"Product","1"=>"Service"),array('prompt'=>'select Type '));?></p>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255,'append' => '%')); ?>

	<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
