<?php
$this->pageTitle = Yii::app()->name . ' - Register';
?>
<div class="row">

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?= Yii::app()->request->baseUrl ?>">Home</a></li>
            <li class="active">Register</li>
        </ol>

    </div>

    <div class="col-md-6 col-xs-12 col-xs-offset-0 col-md-offset-3">
        <div class="col-md-12 col-xs-12 register-welcom">
            <i class="col-md-3 col-xs-3 register-icon"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/register-icon.png" alt="" /></i>
            <p class="col-md-9 col-xs-9 normal-user">Seller</p>
            <span class="col-md-9 col-xs-9 normal">Register as seller and create your own shop<i class="fa fa-angle-double-right"></i></span>


        </div><!--end register-welocme-->
    </div>

    <div class="col-md-12 col-xs-12">
        <div class="col-md-12 col-xs-12 register-box">
            <p class="msg">Please fill below form to create new account.</p>
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'user-register-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
            ));
            ?>
            <form role = "form" class = "form-horizontal" action = "confirm.html">
                <div class = "form-group">
                    <?php echo $form->labelEx($model, 'fname', array('class' => 'col-sm-3 control-label')); ?>
                    <div class = "col-sm-5">
                        <?php echo $form->textField($model, 'fname', array('class' => 'form-control', 'id' => 'first-name', 'title' => 'Please fill out this field with your first name.', 'required' => 'required')); ?>
                        <?php echo $form->error($model, 'fname'); ?>
                    </div>
                </div>

                <div class = "form-group">
                    <?php echo $form->labelEx($model, 'lname', array('class' => 'col-sm-3 control-label')); ?>
                    <div class = "col-sm-5">
                        <?php echo $form->textField($model, 'lname', array('class' => 'form-control', 'id' => 'last-name', 'title' => 'Please fill out this field with your last name.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($model, 'lname'); ?>
                </div>

                <div class = "form-group">
                    <?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-3 control-label')); ?>
                    <div class = "col-sm-5">
                        <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'id' => 'last-name', 'title' => 'Please fill out this field with your user name.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($model, 'username'); ?>
                </div>

                <div class = "form-group">
                    <?php echo $form->labelEx($model, 'email', array('class' => 'col-sm-3 control-label')); ?>
                    <div class = "col-sm-5">
                        <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'id' => 'email', 'title' => 'Please fill out this field with your email.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($model, 'email'); ?>
                </div>


                <div class = "form-group">
                    <?php echo $form->labelEx($model, 'password', array('class' => 'col-sm-3 control-label')); ?>
                    <div class = "col-sm-5">
                        <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'id' => 'password', 'title' => 'Please fill out this field with your password.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($model, 'password'); ?>
                </div>

                <div class = "form-group">
                    <?php echo $form->labelEx($model, 'password_repeat', array('class' => 'col-sm-3 control-label')); ?>
                    <div class = "col-sm-5">
                        <?php echo $form->passwordField($model, 'password_repeat', array('class' => 'form-control', 'id' => 'password_repeat', 'title' => 'Please repeat password.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($model, 'password_repeat'); ?>
                </div>


                <!--                <div class="form-group">
                                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">Country <span class="required">*</span></label>
                                    <div class="col-sm-5">
                <?php
                echo $form->dropDownList($user_details, 'country_id', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
                    'prompt' => 'Select your country', 'class' => 'form-control', 'required' => 'required'));
                ?>	
                <?php echo $form->error($user_details, 'country_id'); ?>
                                    </div>
                                </div>-->

                <div class="form-group">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">Country <span class="required">*</span></label>
                    <div class="col-sm-5">
                        <?php
                        echo $form->dropDownList($user_details, 'country_id', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
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
                        <?php echo $form->error($user_details, 'country_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">City <span class="required">*</span></label>
                    <div class="col-sm-5"  id="model">
                        <?php
                        echo $form->dropDownList($user_details, 'city_id', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$user_details->country_id")), 'id', 'title'), array('prompt' => 'Select your city', 'class' => 'form-control', 'required' => 'required'));
                        ?>
                        <?php echo $form->error($user_details, 'city_id'); ?>
                    </div>
                </div>


                <div class = "form-group">
                    <?php echo $form->labelEx($user_details, 'zipcode', array('class' => 'col-sm-3 control-label')); ?>
                    <div class = "col-sm-5">
                        <?php echo $form->textField($user_details, 'zipcode', array('class' => 'form-control', 'id' => 'zipcode', 'title' => 'Please fill out this field with Post Code.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($user_details, 'zipcode'); ?>
                </div>

                <div class = "form-group">
                    <?php echo $form->labelEx($user_details, 'address', array('class' => 'col-sm-3 control-label')); ?>
                    <div class = "col-sm-5">
                        <?php echo $form->textField($user_details, 'address', array('class' => 'form-control', 'id' => 'address', 'title' => 'Please fill out this field with address.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($user_details, 'address'); ?>
                </div>

                <div class = "form-group">
                    <?php echo $form->labelEx($user_details, 'shop_name', array('class' => 'col-sm-3 control-label')); ?>
                    <div class = "col-sm-5">
                        <?php echo $form->textField($user_details, 'shop_name', array('class' => 'form-control', 'id' => 'shop_name', 'title' => 'Please fill out this field with shop name.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($user_details, 'shop_name'); ?>
                </div>

                <div class = "form-group">
                    <?php echo $form->labelEx($user_details, 'shop_address', array('class' => 'col-sm-3 control-label')); ?>
                    <div class = "col-sm-5">
                        <?php echo $form->textField($user_details, 'shop_address', array('class' => 'form-control', 'id' => 'shop_address', 'title' => 'Please fill out this field with shop address.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($user_details, 'shop_address'); ?>
                </div>

                <div class = "form-group">
                    <?php echo $form->labelEx($user_details, 'paypal_account', array('class' => 'col-sm-3 control-label')); ?>
                    <div class = "col-sm-5">
                        <?php echo $form->textField($user_details, 'paypal_account', array('class' => 'form-control', 'id' => 'paypal_account', 'title' => 'Please fill out this field with  paypal account.', 'required' => 'required')); ?>            </div>
                    <?php echo $form->error($user_details, 'paypal_account'); ?>
                </div>

                <!--                <div class = "form-group">
                <?php echo $form->labelEx($user_details, 'shop_image', array('class' => 'col-sm-3 control-label')); ?>
                                    <div class = "col-sm-5">
                <?php echo $form->fileField($user_details, 'shop_image', array('class' => 'btn btn-default upload-bt', 'maxlength' => 255)); ?>
                
                                    </div>
                                </div>-->


                <div class = "form-group">
                    <label class = "col-sm-3 control-label" for = "inputPassword3">shop image:</label>
                    <div class = "col-sm-5">
                        <a href = "javascript:void(0)" class = "btn btn-default upload-bt" onClick = "myFunction()">upload image</a>
                        <input id = "pp_uploader" name="UserDetails[shop_image]" type = "file" accept = "image/*">
                    </div>
                </div>


                <div class = "col-sm-offset-3 col-sm-5">
                    <div class = "checkbox">
                        <label>
                            <input type = "checkbox" required=""> I accept website’s terms and conditions
                        </label>
                    </div>
                </div>



                <div class = "form-group">
                    <div class = "col-sm-offset-3 col-sm-5">
                        <button class = "btn btn-default register-bt" type = "submit">Register</button>
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