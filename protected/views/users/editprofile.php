<?php $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
?>
<div class="row profile">


    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/dashboard">Dashboard</a></li>
            <li class="active">edit profile</li>
        </ol>

    </div>
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'editprofile-form',
        'enableAjaxValidation' => false,
        'type' => 'vertical',
        'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'
        ),
    ));
    ?>

    <!--appear-->
    <?php $this->renderpartial('../home/menu', array('user' => $user)); ?>
    <!--end appear-->




    <div class="col-md-9 col-sm-8 col-xs-12">

        <?php
        if (Yii::app()->user->hasFlash('update-success')) {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo Yii::app()->user->getFlash('update-success'); ?>.
            </div>

            <?php
        } elseif (Yii::app()->user->hasFlash('update-error')) {
            ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('update-error'); ?>.
                <?php echo Yii::app()->user->getFlash('update-error'); ?>.
            </div>
        <?php } ?>
        <div class="info seller-profile">
            <p class="profile-name"><?php echo $model->username; ?></p>



            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputEmail3">first name:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->textField($model, 'fname', array('class' => 'form-control', 'required' => "required")); ?>
                    <?php echo $form->error($model, 'fname'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputEmail3">last name:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->textField($model, 'lname', array('class' => 'form-control', 'required' => "required")); ?>
                    <?php echo $form->error($model, 'lname'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Username:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'required' => "required")); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputEmail3">phone:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->textField($user_details, 'phone_no', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'phone_no'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">E-mail:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">website:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->textField($user_details, 'website', array('class' => 'form-control')); ?>
                    <?php echo $form->error($user_details, 'website'); ?>
                </div>
            </div>




            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Facebook :</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->textField($user_details, 'facebook', array('class' => 'form-control')); ?>
                    <?php echo $form->error($user_details, 'facebook'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Twitter :</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->textField($user_details, 'twitter', array('class' => 'form-control')); ?>
                    <?php echo $form->error($user_details, 'twitter'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Google :</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->textField($user_details, 'google', array('class' => 'form-control')); ?>
                    <?php echo $form->error($user_details, 'google'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Instgram :</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->textField($user_details, 'instagram', array('class' => 'form-control')); ?>
                    <?php echo $form->error($user_details, 'instagram'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Linked In :</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->textField($user_details, 'linkedin', array('class' => 'form-control')); ?>
                    <?php echo $form->error($user_details, 'linkedin'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Description:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->textField($model, 'details', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'details'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Upload Image:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->fileField($model, 'image', array('class' => 'form-control , upload-input')); ?>
                    <?php echo $form->error($model, 'image'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-6 col-sm-6 col-sm-offset-6 col-xs-12 col-xs-offset-0">
                    <a href="#" class="btn btn-default register-bt" data-toggle="modal" data-target="#password-modal">change password</a>
                </div>
            </div>

            <?php if ($model->groups_id != 3): ?>
                <p class="profile-name">Address Information</p>



                <div class="form-group">
                    <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputEmail3">Country:</label>
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <?php
                        echo $form->dropDownList($user_details, 'country_id', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
                            'prompt' => 'Select Country', 'class' => 'form-control'));
                        ?>
                        <?php echo $form->error($user_details, 'country_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">City:</label>
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <?php
                        echo $form->dropDownList($user_details, 'city_id', CHtml::listData(City::model()->findAll(), 'id', 'title'), array(
                            'prompt' => 'Select City', 'class' => 'form-control'));
                        ?>
                        <?php echo $form->error($user_details, 'city_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputEmail3">Street,building:</label>
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <?php echo $form->textField($user_details, 'address', array('class' => 'form-control')); ?>
                        <?php echo $form->error($user_details, 'address'); ?>
                    </div>
                </div>


                <div class="form-group">

                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Adress:</label>

                    <div class="col-md-6 col-sm-7 col-xs-12">
                        <?php echo $form->textField($user_details, 'shop_address', array('rows' => 6, 'cols' => 50, 'class' => 'form-control', 'id' => 'Address')); ?>
                    </div>
                </div>

                <?php
                Yii::import('ext.gmap.*');
                $gMap = new EGMap();
                $gMap->setWidth(700);
                $gMap->setHeight(300);
                $gMap->zoom = 2;
                $mapTypeControlOptions = array(
                    'position' => EGMapControlPosition::RIGHT_TOP,
                    'style' => EGMap::MAPTYPECONTROL_STYLE_HORIZONTAL_BAR
                );

                $gMap->mapTypeId = EGMap::TYPE_ROADMAP;
                $gMap->mapTypeControlOptions = $mapTypeControlOptions;
                $gMap->zoomControl = EGMap::ZOOMCONTROL_STYLE_SMALL;
                $gMap->streetViewControl = false;
                $gMap->minZoom = 2;

                $gMap->htmlOptions = array(
                    'class' => 'map'
                );

                // Preparing InfoWindow with information about our marker.
                $info_window_a = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>Hi! I'm your marker!</div>");


                // Saving coordinates after user dragged our marker.
                $dragevent = new EGMapEvent('dragend', "function (event) {
	$('#h_lng').val(event.latLng.lng());
	$('#h_lat').val(event.latLng.lat());
	}", false, EGMapEvent::TYPE_EVENT_DEFAULT);

                // If we have already created marker - show it
                // $lng = $location->longtitude;
                // $lat = $location->latitude;
                $zoom = 8;
                // if ($location->isNewRecord) {
                $lng = -0.477551;
                $lat = 38.348850;
                $zoom = 2;
                // }
                $marker = new EGMapMarker($lat, $lng, array('title' => 'mark your place', 'draggable' => true), $gMap->getJsName() . '_marker', array('dragevent' => $dragevent));
                $marker->addHtmlInfoWindow($info_window_a);
                $gMap->addMarker($marker);
                $gMap->setCenter($lat, $lng);
                $gMap->zoom = $zoom;

                $gMap->addAutocomplete('Address');

                $gMap->renderMap(array(), Yii::app()->language);
                ?>


                <div class="form-group" style="margin-top:20px;">
                    <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Post Code:</label>
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <?php echo $form->textField($user_details, 'zipcode', array('class' => 'form-control')); ?>
                        <?php echo $form->error($user_details, 'zipcode'); ?>
                    </div>
                </div>
            <?php endif; ?>



            <?php if ($model->groups_id == 1 or $model->groups_id == 4) { ?>

                <p class="profile-name">Seller Information</p>


                <div class="form-group">
                    <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Shop Name:</label>
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <?php echo $form->textField($user_details, 'shop_name', array('class' => 'form-control')); ?>
                        <?php echo $form->error($user_details, 'shop_name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Paypal Account:</label>
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <?php echo $form->textField($user_details, 'paypal_account', array('class' => 'form-control')); ?>
                        <?php echo $form->error($user_details, 'paypal_account'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputEmail3">Shop Description :</label>
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <?php echo $form->textField($user_details, 'shop_description', array('class' => 'form-control')); ?>
                        <?php echo $form->error($user_details, 'shop_description'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Shop Image:</label>
                    <div class="col-md-6 col-sm-8 col-xs-12">

                        <div class='control-group'>
                            <?php
                            if ($user_details->shop_image != '')
                                echo "<p id='image-cont'>" . Chtml::image(Yii::app()->baseUrl . '/media/shop/' . $user_details->shop_image, '', array('width' => 200)) . "</p>";
                            else
                                echo "There is no shop image";
                            ?>
                            <?php echo $form->fileField($user_details, 'shop_image', array('class' => 'form-control, upload-input', 'maxlength' => 255)); ?>
    <?php //echo $form->error($model, 'lname');  ?>
                        </div>


                    </div>




                </div>

<?php } ?>

            <div class="modal fade" id="password-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">change password</h4>
                        </div>

                        <div class="modal-body">

                            <div class="pass-form">
                                <div class="form-group"> 
                                    <div class="input-group">

                                        <input class="form-control" placeholder="Old Password" type="password" name="User[oldpassword]" id="User[oldpassword]">
                                        <div class="input-group-addon"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/pass-icon.png"/></div>
                                    </div>   

                                </div>

                                <div class="form-group"> 
                                    <div class="input-group">

                                        <input class="form-control" placeholder="New Password" type="password" name="User[newpassword]" id="User[newpassword]">
                                        <div class="input-group-addon"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/pass-icon.png" /></div>
                                    </div>   

                                </div>
                                <div class="form-group"> 
                                    <div class="input-group">

                                        <input class="form-control" placeholder="Confirm Password" type="password" name="User[newpassword_repeat]" id="User[newpassword_repeat]" >
                                        <div class="input-group-addon"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/general/pass-icon.png" alt="" /></div>
                                    </div>   

                                </div>
                                <!--                                <label class="control-label">Old Password :</lable>
                                
                                                                    <span class="input-group"> 
<?php //echo CHtml::passwordField('User[oldpassword]');  ?>
                                                                    </span>
                                
                                                                    <label class="input-group"> New Password:</label>
                                                                    <span class="controls">
<?php //echo CHtml::passwordField('User[newpassword]');  ?>
                                                                    </span>
                                
                                
                                                                    <label class="input-group">New Password repeat: </label>
                                                                    <span class="controls">
<?php //echo CHtml::passwordField('User[newpassword_repeat]');  ?>
                                                                    </span>-->
                            </div>

<?php echo CHtml::submitButton('save changes', array('class' => 'btn btn-default log-btn', 'data-dismiss' => 'modal')); ?>


                        </div>

                    </div>

                </div>

            </div>




            <div class="form-group">
                <div class="col-md-offset-3 col-md-6 col-sm-6 col-sm-offset-6 col-xs-12 col-xs-offset-0 control-label">
<?php echo CHtml::submitButton('save changes', array('class' => 'btn btn-default register-bt')); ?>
                </div>
            </div>
<?php $this->endWidget(); ?>

            <!-- password Modal -->

        </div>
        <!-- password Modal -->


    </div><!--end info-->
</div>

<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->



</div>
</div>

