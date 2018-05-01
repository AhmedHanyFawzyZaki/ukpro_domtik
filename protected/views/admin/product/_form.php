<div class="control-group">

    <p class="profile-name" data-toggle="modal" data-target="#xml-popup">add new item<span>
                        Upload with <a href="#" id="upload"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>xml.</span></p>


                        <p class="profile-name" data-toggle="modal" data-target="#csv-popup">add new item<span>
                        Upload With<a href="#" id="upload"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Csv or Excel</span></p>

                        
                        <p class="profile-name" data-toggle="modal" data-target="#amazon-popup">add new item<span>
                        Upload With<a href="#" id="upload-amazon"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Amazon</span></p>

                         <p class="profile-name" data-toggle="modal" data-target="#affiliate-popup">add new item<span>
                        Upload With<a href="#" id="upload-Affiliate"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Affiliate Window</span></p>


                        
                         <p class="profile-name" data-toggle="modal" data-target="#comm-popup">add new item<span>
                        Upload With<a href="#" id="upload-comm"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Commission Junction</span></p>


                         <p class="profile-name" data-toggle="modal" data-target="#trade-popup">add new item<span>
                        Upload With<a href="#" id="upload-trade"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Trade Doubler</span></p>

        
                          <p class="profile-name" data-toggle="modal" data-target="#zanox-popup">add new item<span>
                        Upload With<a href="#" id="upload-trade"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Zanox</span></p>


                        
</div>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

       
        
<p><?php  echo $form->dropDownListRow($model, 'category_id',CHtml::listData(Category::model()->findAll(), 'id', 'title'),array('prompt'=>'select Category','class'=>'listtxt'));?></p>



	<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'featured_in_home_page',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'gallery_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'has_stock',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'main_image',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'old_price',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'on_sale',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'product_category_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_status_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'quantity',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'show_in_home_page',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'temp1',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'temp2',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'temp3',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'temp4',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'type',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
