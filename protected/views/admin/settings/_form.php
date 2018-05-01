<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'facebook',array('class'=>'span5','maxlength'=>255)); ?>
        
        <?php echo $form->textFieldRow($model,'twitter',array('class'=>'span5','maxlength'=>255)); ?>



        
        <?php echo $form->textFieldRow($model,'press_email',array('class'=>'span5','maxlength'=>255)); ?>


	<?php echo $form->textFieldRow($model,'pinterest',array('class'=>'span5','maxlength'=>255)); ?>
        <?php echo $form->textFieldRow($model,'google',array('class'=>'span5','maxlength'=>255)); ?>


	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>


	<?php //echo $form->textFieldRow($model,'press_email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'support_email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'blog_email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'temp4',array('class'=>'span5')); ?>
        
        <?php echo $form->textFieldRow($model,'paypal_email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'api_username',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'api_password',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'signature',array('class'=>'span5','maxlength'=>255)); ?>
        
        <?php echo $form->textFieldRow($model,'appid',array('class'=>'span5')); ?>
        
	<?php echo $form->checkBoxRow($model,'paypal_live'); ?>


	<?php //echo $form->textFieldRow($model,'paypal_fee',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'paypalextra_fee',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'site_commession',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'mobile',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'fax',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>
        
        <?php echo $form->textFieldRow($model,'exclusive_app',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'instgram_app',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'api_key',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'ts_code',array('class'=>'span5')); ?>
        
         <?php echo $form->textFieldRow($model,'aws_api_key',array('class'=>'span5')); ?>
         <?php echo $form->textFieldRow($model,'aws_api_secret_key',array('class'=>'span5')); ?>
         <?php echo $form->textFieldRow($model,'aws_associate_tag',array('class'=>'span5')); ?>

       <?php echo $form->textFieldRow($model,'affiliate_window_key',array('class'=>'span5')); ?>

       <?php echo $form->textFieldRow($model,'junction_key',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'junction_website_id',array('class'=>'span5')); ?>

       <?php echo $form->textFieldRow($model,'trade_doubler_key',array('class'=>'span5')); ?>

          <?php echo $form->textFieldRow($model,'zanox_connect_id',array('class'=>'span5')); ?>

          <?php echo $form->textFieldRow($model,'zanox_secret_key',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
