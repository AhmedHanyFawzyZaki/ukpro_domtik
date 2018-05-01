<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'error_home',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'error_homeactive',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'error_image',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'error_prev',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'error_prevactive',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'error_subhead',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'error_heading',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'error_message',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'error_body',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
