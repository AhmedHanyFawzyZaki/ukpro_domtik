<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
     'htmlOptions' => array(	'enctype' => 'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

    
        <?php echo $form->textFieldRow($model,'default_commission',array('class'=>'span5','maxlength'=>255, 'append' => '%')); ?>
 
        
        
<div class='control-group'>
    <?php echo $form->fileFieldRow($model, 'image', array('class' => 'span5', 'maxlength' => 255)); ?>
    <div class='controls'>
        <?php
        if ($model->isNewRecord != '1' and $model->image != '') {
            ?>

            <div class="control-group ">

                <div class="controls">
                    <?php
                    echo "<p id='image-cont'>" . Chtml::image(Yii::app()->baseUrl . '/media/category/' . $model->image, '', array('width' => 200)) . "</p>";
                    echo CHtml::ajaxLink(
                            'Delete Image', array('/admin/Category/deleteimage/id/' . $model->id), array(
                        'success' => 'function(data){
                                                     //var obj = jQuery.parseJSON(data);
                                                     if(data =="done"){
                                                        document.getElementById("image-cont").innerHTML=" Image Deleted";
                                                    }
                                            }'
                            ), array('class' => 'left0px')
                    );
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>





	
        
        <?php echo $form->checkboxRow($model,'featured_home_page'); ?>

	<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
