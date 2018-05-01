<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'reply-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <p><?php  echo $form->dropDownListRow($model, 'message_id',CHtml::listData(Message::model()->findAll(), 'id', 'title'),array('prompt'=>'select Message','class'=>'listtxt'));?></p>



        
<p><?php  echo $form->dropDownListRow($model, 'user_id',CHtml::listData(User::model()->findAll(), 'id', 'username'),array('prompt'=>'select username','class'=>'listtxt'));?></p>

<fieldset>

          

     <div class="control-group">
        <label for="post_date" class="control-label">Reply Date</label>
        <div class="controls">

            <?php
			$this->widget('zii.widgets.jui.CJuiDatePicker',
			array(
			'name' => 'reply_date',
			'attribute' => 'reply_date',
			'model'=>$model,
			'options'=> array(
			'dateFormat' =>'d-mm-yy',
			'altFormat' =>'d-mm-yy',
			'changeMonth' => true,
			'changeYear' => true,
			//'appendText' => 'yyyy-mm-dd',
			),
			));

			?>

            </div></div>
        </fieldset>
	<?php  echo $form->checkboxRow($model,'published'); ?>

	<?php echo $form->textAreaRow($model,'details',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
