<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-details-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textAreaRow($model,'address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'brand_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'city_id',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'conditions',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'county_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'decor_style_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'decor_type_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'destination_city',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'destination_country',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'dimensions',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'flight_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'gender',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'kids_for',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'kids_type',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'latitude',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'longitude',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'make_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'motor_model_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_id',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'real_estate_facilities',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'real_estate_type',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'source_city',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'source_country',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'sub_category_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'temp1',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'temp2',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'temp3',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'temp4',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'temp5',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'temp6',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'travel_type',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
