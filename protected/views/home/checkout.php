<?php
$this->pageTitle = Yii::app()->name . ' - Checkout';
?>
<div class="row">

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?= Yii::app()->request->baseUrl ?>">Home</a></li>
            <li class="active">Checkout</li>
        </ol>

    </div>

    <div class="col-md-12 col-xs-12">
        <div class="col-md-12 col-xs-12 register-box">
            <p class="msg">Please fill below form to complete your order.</p>
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'user-register-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
            ));
            ?>
            <form role = "form" class = "form-horizontal" >
                <div class="form-group">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">Shipping Country <span class="required">*</span></label>
                    <div class="col-sm-5">
                        <?php
                        echo $form->dropDownList($model, 'shipping_country', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
                            'prompt' => 'Select your country', 'class' => 'form-control', 'required' => 'required',
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => Yii::app()->getbaseurl() . '/home/getCity',
                                'data' => array('country_id' => 'js:this.value'),
                                'success' => 'function( data )
                    {
	document.getElementById("model").innerHTML=data;
                    }'
                            ))
                        );
                        ?>	
                        <?php echo $form->error($model, 'shipping_country'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">Shipping City <span class="required">*</span></label>
                    <div class="col-sm-5"  id="model">
                        <?php
                        echo $form->dropDownList($model, 'shipping_city', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$model->shipping_country")), 'id', 'title'), array('prompt' => 'Select your city', 'class' => 'form-control', 'required' => 'required'));
                        ?>
                        <?php echo $form->error($model, 'shipping_city'); ?>
                    </div>
                </div>

                <div class = "form-group">
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">Shipping Post Code <span class="required">*</span></label>
                    <div class = "col-sm-5">
                        <?php echo $form->textField($model, 'shipping_post_code', array('class' => 'form-control', 'id' => 'shipping_post_code', 'title' => 'Please fill out this field with Post Code.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($model, 'shipping_post_code'); ?>
                </div>

                <div class = "form-group">
                    <?php echo $form->labelEx($model, 'shipping_address', array('class' => 'col-sm-3 control-label')); ?>
                    <div class = "col-sm-5">
                        <?php echo $form->textField($model, 'shipping_address', array('class' => 'form-control', 'id' => 'address', 'title' => 'Please fill out this field with address.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($model, 'shipping_address'); ?>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">Billing Country <span class="required">*</span></label>
                    <div class="col-sm-5">
                        <?php
                        echo $form->dropDownList($model, 'billing_country', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
                            'prompt' => 'Select your country', 'class' => 'form-control',
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => Yii::app()->getbaseurl() . '/home/getCity',
                                'data' => array('country_id' => 'js:this.value'),
                                'success' => 'function( data )
                    {
	document.getElementById("model1").innerHTML=data;
                    }'
                            ))
                        );
                        ?>	
                        <?php echo $form->error($model, 'billing_country'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">Billing City <span class="required">*</span></label>
                    <div class="col-sm-5"  id="model1">
                        <?php
                        echo $form->dropDownList($model, 'billing_city', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$model->billing_country")), 'id', 'title'), array('prompt' => 'Select your city', 'class' => 'form-control', 'required' => 'required'));
                        ?>
                        <?php echo $form->error($model, 'billing_city'); ?>
                    </div>
                </div>


                <div class = "form-group">
                 <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">Billing Post Code <span class="required">*</span></label>
                    <div class = "col-sm-5">
                        <?php echo $form->textField($model, 'billing_post_code', array('class' => 'form-control', 'id' => 'billing_post_code', 'title' => 'Please fill out this field with Post Code.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($model, 'billing_post_code'); ?>
                </div>

                <div class = "form-group">
                    <?php echo $form->labelEx($model, 'billing_address', array('class' => 'col-sm-3 control-label')); ?>
                    <div class = "col-sm-5">
                        <?php echo $form->textField($model, 'billing_address', array('class' => 'form-control', 'id' => 'address', 'title' => 'Please fill out this field with address.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($model, 'billing_address'); ?>
                </div>





                <div class = "form-group">
                    <div class = "col-sm-offset-3 col-sm-5">
                        <button class = "btn btn-default register-bt" type = "submit">Checkout</button>
                    </div>
                </div>
            </form>
            <?php $this->endWidget(); ?>


        </div><!--end register-box-->

    </div>

</div>



<!--appear-->
<?php $this->renderpartial('../home/sponsor');
?>
<!--end appear-->



</div>
</div>