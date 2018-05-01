<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'shipping-value-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        
        
<p><?php  echo $form->dropDownListRow($model, 'user_id',CHtml::listData(User::model()->findAll(), 'id', 'username'),array('prompt'=>'Select User','class'=>'listtxt'));?></p>
<p><?php  echo $form->dropDownListRow($model, 'country_id',CHtml::listData(Country::model()->findAll(), 'id', 'title'),array('prompt'=>'Select Country','class'=>'listtxt'));?></p>

<!--        <div class="control-group">
            <label for="country_id" class="control-label">Country</label>
            <div class="controls">

                <?php
//                echo $form->dropDownList($model, 'country_id', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
//                    'prompt' => 'Select Country',
//                    'ajax' => array(
//                        'type' => 'POST',
//                        'url' => Yii::app()->getbaseurl() . '/admin/ShippingValue/getCity',
//                        'data' => array('country_id' => 'js:this.value'),
//                        //'data' => array('department' => 'js:this.value', 'team' => $model->team),
//                        'success' => 'function( data )
//                    {
//	document.getElementById("model").innerHTML=data;
//                    }'
//                    ))
//                );
                ?>
            </div> </div>-->



<!--        <div class="control-group">
            <label class="control-label" style="color:red"> City</label>
            <div class="controls"  id="model">
                <?php
//                if ($model->isNewRecord)
//                    echo 
//                    'Select Country First';
//                else {
//                    echo $form->dropDownList($model, 'city_id', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$model->country_id")), 'id', 'title'), array('prompt' => 'Select City'));
//                }
                ?>
            </div>
        </div>-->



	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255,'append'=>'GBP')); ?>

	<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
