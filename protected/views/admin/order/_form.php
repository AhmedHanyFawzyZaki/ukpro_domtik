<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'creation_date',array('class'=>'span5')); ?>

        <fieldset>

         <div class="control-group">
        <label for="blog_date" class="control-label"> Creation Date</label>
        <div class="controls">

            <?php
			$this->widget('zii.widgets.jui.CJuiDatePicker',
			array(
			'name' => 'creation_date',
			'attribute' => 'creation_date',
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

        
        
	<?php echo $form->textFieldRow($model,'total_price',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'net_price',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'shipping_price',array('class'=>'span5','maxlength'=>10)); ?>

	<?php //echo $form->textFieldRow($model,'token',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'status_id',array('class'=>'span5')); ?>
<p><?php  echo $form->dropDownListRow($model, 'status_id',CHtml::listData(OrderStatus::model()->findAll(), 'id', 'title'),array('prompt'=>'select order status','class'=>'listtxt'));?></p>




<p><?php  echo $form->dropDownListRow($model, 'buyer_id',CHtml::listData(User::model()->findAll(), 'id', 'username'),array('prompt'=>'select Buyer','class'=>'listtxt'));?></p>

	<?php echo $form->textFieldRow($model,'total_commission',array('class'=>'span5','maxlength'=>10)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
