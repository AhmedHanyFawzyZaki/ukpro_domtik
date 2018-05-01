<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'errormessage-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
    'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
 


<?php   // echo $form->textAreaRow($model,'error_heading',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>


<div class="control-group ">
		<label class="control-label" for="error_heading">error_heading</label>
		<div class="controls">	
   <?php
    
$this->widget('application.extensions.floara.Floara', array(
    'model' => $model,
    'attribute' => 'error_heading',
      ));

   ?> 
    
   
		</div>
	</div>






<div class="control-group ">
		<label class="control-label" for="error_subhead">Sub Heading :</label>
		<div class="controls">	
   <?php
    
$this->widget('application.extensions.floara.Floara', array(
    'model' => $model,
    'attribute' => 'error_subhead',
      ));

   ?> 
    
   
		</div>
	</div>





<div class="control-group ">
		<label class="control-label" for="error_message">Error message :</label>
		<div class="controls">	
   <?php
    
$this->widget('application.extensions.floara.Floara', array(
    'model' => $model,
    'attribute' => 'error_message',
      ));

   ?> 
    
   
		</div>
	</div>







<div class="control-group ">
		<label class="control-label" for="error_body">Error body :</label>
		<div class="controls">	
   <?php
    
$this->widget('application.extensions.floara.Floara', array(
    'model' => $model,
    'attribute' => 'error_body',
      ));

   ?> 
    
   
		</div>
	</div>




        
        
        
        




<?php  echo $form->textFieldRow($model, 'error_home', array('class' => 'span5', 'maxlength' => 100)); ?>

<?php echo $form->checkBoxRow($model, 'error_homeactive'); ?>



<?php  echo $form->textFieldRow($model, 'error_prev', array('class' => 'span5', 'maxlength' => 100)); ?>

<?php echo $form->checkBoxRow($model, 'error_prevactive'); ?>



<?php
echo $form->fileFieldRow($model, 'error_image');

if ($model->isNewRecord != '1') {
    echo " <div class=\"control-group \"> <div class=\"controls\">";
    echo CHtml::image(Yii::app()->request->baseUrl . '/media/' . $model->error_image, 'image', array('width' => 300));
    echo "</div></div>";
}
?>




        
        
        
        
        
        
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
