<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'orders-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        
        
        
<p><?php  echo $form->dropDownListRow($model, 'user_id',CHtml::listData(User::model()->findAll(), 'id', 'username'),array('prompt'=>'select username','class'=>'listtxt'));?></p>


	<?php echo $form->textFieldRow($model,'total_price',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span5','maxlength'=>10,'append'=>'GBP')); ?>

	<?php echo $form->textFieldRow($model,'total_shipping',array('class'=>'span5','maxlength'=>255,'append'=>'GBP')); ?>

	<?php ////echo $form->textFieldRow($model,'payer_id',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'token',array('class'=>'span5','maxlength'=>255)); ?>

<div class="control-group">
            <label for="shipping_country" class="control-label">Country</label>
            <div class="controls">

                <?php
                echo $form->dropDownList($model, 'shipping_country', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
                    'prompt' => 'Select Shipping Country',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => Yii::app()->getbaseurl() . '/admin/Orders/getShippingCity',
                        'data' => array('shipping_country' => 'js:this.value'),
                        //'data' => array('department' => 'js:this.value', 'team' => $model->team),
                        'success' => 'function( data )
                    {
	document.getElementById("shipping").innerHTML=data;
                    }'
                    ))
                );
                ?>
            </div> </div>



<div style="display:block" id="dpt">
        <div class="control-group">
            <label class="control-label" style="color:red">  Shipping City</label>
            <div class="controls"  id="shipping">
                <?php
                if ($model->isNewRecord)
                    echo 
                    'Select Shipping Country First';
                else {
                    echo $form->dropDownList($model, 'shipping_city', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$model->shipping_country")), 'id', 'title'), array('prompt' => 'Select City'));
                }
                ?>
            </div>
        </div>
         </div>







	<?php echo $form->textFieldRow($model,'shipping_post_code',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textAreaRow($model,'shipping_address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>


<div class="control-group">
            <label for="billing_country" class="control-label"> Billing Country</label>
            <div class="controls">

                <?php
                echo $form->dropDownList($model, 'billing_country', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
                    'prompt' => 'Select Billing  Country',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => Yii::app()->getbaseurl() . '/admin/Orders/getBillingCity',
                        'data' => array('billing_country' => 'js:this.value'),
                        //'data' => array('department' => 'js:this.value', 'team' => $model->team),
                        'success' => 'function( data )
                    {
	document.getElementById("billing").innerHTML=data;
                    }'
                    ))
                );
                ?>
            </div> </div>



<div style="display:block" id="dpt">
        <div class="control-group">
            <label class="control-label" style="color:red">  Billing City</label>
            <div class="controls"  id="billing">
                <?php
                if ($model->isNewRecord)
                    echo 
                    'Select Billing Country First';
                else {
                    echo $form->dropDownList($model, 'billing_city', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$model->billing_country")), 'id', 'title'), array('prompt' => 'Select Billing City'));
                }
                ?>
            </div>
        </div>
         </div>









	<?php echo $form->textFieldRow($model,'billing_post_code',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textAreaRow($model,'billing_address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>



<p><?php  echo $form->dropDownListRow($model, 'status',CHtml::listData(OrderStatus::model()->findAll(), 'id', 'title'),array('prompt'=>'select Order status','class'=>'listtxt'));?></p>



<fieldset>

         <div class="control-group">
        <label for="blog_date" class="control-label">Order Date</label>
        <div class="controls">

            <?php
			$this->widget('zii.widgets.jui.CJuiDatePicker',
			array(
			'name' => 'date',
			'attribute' => 'date',
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
	<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
