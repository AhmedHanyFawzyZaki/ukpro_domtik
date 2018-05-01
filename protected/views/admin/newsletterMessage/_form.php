<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'newsletter-message-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'users_id',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="control-group">
        <label class="control-label"> Subscribers </label>
        <div class="controls" id="user_selection">
        <?php
        echo $form->checkBoxList($model, 'user_selection',Newsletter::model()->getsubscribers() , array('multiple'=>true));
        ?>
        </div>
    </div>

	<?php echo $form->textFieldRow($model,'subject',array('class'=>'span5','maxlength'=>255)); ?>

        <?php //echo $form->textAreaRow($model,'message',array('class'=>'span5','maxlength'=>255)); ?>

        <label class="control-label"> Message </label>


        <?php
        $this->widget('application.extensions.floara.Floara', array(
            'model' => $model,
            'attribute' => 'message',
        ));
        ?> 


        

	<?php //echo $form->textFieldRow($model,'date_sent',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'start_flag',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'end_flag',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'temp1',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'temp2',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
