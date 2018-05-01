<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => true,
    'type' => 'horizontal',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>
<script>

    $(document).ready(function() {
        $('.row .btn').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $collapse = $this.closest('.collapse-group').find('.collapse');
            $collapse.collapse('toggle');
        });

    });
</script>


<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php
echo $form->errorSummary($model);

if (Yii::app()->user->hasFlash('Passchange')) {

    echo Yii::app()->user->getFlash('Passchange');
}
?>

<?php
echo " <div class=\"control-group \">
               <label for=\"UserDetails_city\" class=\"control-label\">User Group</label>
                                <div class=\"controls\">";
echo $form->dropDownList($model, 'groups_id', Groups::model()->getGroups(), array('id' => 'group'));
echo "</div> </div>";
?>

<?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php
if ($model->id > 0) {
    ?>

    <div class="row control-group">
        <div class="collapse-group controls">
            <p><a class="btn control-label" href="#">Change password</a></p>
            <p class="collapse">
                <label class="control-label">Old Password :</lable>

                    <span class="controls"> 
                        <?php echo CHtml::passwordField('User[oldpassword]'); ?>
                    </span>

                    <label class="control-label"> New Password:</label>
                    <span class="controls">
                        <?php echo CHtml::passwordField('User[newpassword]'); ?>
                    </span>


                    <label class="control-label">New Password repeat: </label>
                    <span class="controls">
                        <?php echo CHtml::passwordField('User[newpassword_repeat]'); ?>
                    </span>


            </p>

        </div>
    </div>

    <?php
} else {
    echo $form->passwordFieldRow($model, 'password', array('class' => 'span5', 'maxlength' => 90));
    echo $form->passwordFieldRow($model, 'password_repeat', array('class' => 'span5', 'maxlength' => 90));
}
?>

<?php echo $form->textFieldRow($model, 'fname', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'lname', array('class' => 'span5', 'maxlength' => 255)); ?>


<div class='control-group'>
    <?php echo $form->fileFieldRow($model, 'image', array('class' => 'span5', 'maxlength' => 255)); ?>
    <div class='controls'>
        <?php
        if ($model->isNewRecord != '1' and $model->image != '') {
            ?>

            <div class="control-group ">

                <div class="controls">
                    <?php
                    echo "<p id='image-cont'>" . Chtml::image(Yii::app()->baseUrl . '/media/members/' . $model->image, '', array('width' => 200)) . "</p>";
                    echo CHtml::ajaxLink(
                            'Delete Image', array('/admin/user/deleteimage/id/' . $model->id), array(
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


<div class="control-group">
    <label for="country_id" class="control-label">Country</label>
    <div class="controls">

        <?php
        echo $form->dropDownList($user_details, 'country_id', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
            'prompt' => 'Select Country',
            'ajax' => array(
                'type' => 'POST',
                'url' => Yii::app()->getbaseurl() . '/admin/User/getCity',
                'data' => array('country_id' => 'js:this.value'),
                //'data' => array('department' => 'js:this.value', 'team' => $model->team),
                'success' => 'function( data )
                    {
  document.getElementById("model").innerHTML=data;
                    }'
            ))
        );
        ?>
    </div> </div>



<div style="display:block" id="dpt">
    <div class="control-group">
        <label class="control-label" style="color:red"> City</label>
        <div class="controls"  id="model">
            <?php
            if ($model->isNewRecord)
                echo
                'select country first';
            else {
                echo $form->dropDownList($user_details, 'city_id', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$user_details->country_id")), 'id', 'title'), array('prompt' => 'Select city'));
            }
            ?>
        </div>
    </div>
</div>
<?php echo $form->textFieldRow($user_details, 'zipcode', array('class' => 'span5', 'maxlength' => 255)); ?>
<?php echo $form->textFieldRow($user_details, 'address', array('class' => 'span5', 'maxlength' => 255)); ?>
<?php echo $form->textAreaRow($model, 'details', array('rows' => 6, 'cols' => 50, 'class' => 'span5')); ?>
<?php echo $form->textFieldRow($user_details, 'facebook', array('rows' => 6, 'cols' => 50, 'class' => 'span5')); ?>
<?php echo $form->textFieldRow($user_details, 'twitter', array('rows' => 6, 'cols' => 50, 'class' => 'span5')); ?>
<?php echo $form->textFieldRow($user_details, 'instagram', array('rows' => 6, 'cols' => 50, 'class' => 'span5')); ?>
<?php echo $form->textFieldRow($user_details, 'google', array('rows' => 6, 'cols' => 50, 'class' => 'span5')); ?>
<?php echo $form->textFieldRow($user_details, 'website', array('rows' => 6, 'cols' => 50, 'class' => 'span5')); ?>




<p><?php echo $form->dropDownListRow($model, 'fee_package_id', CHtml::listData(FeePackage::model()->findAll(), 'id', 'title'), array('prompt' => 'select Fee Package', 'class' => 'listtxt')); ?></p>
<div class="control-group">
    <div class="controls">

        <p><?php echo $form->dropDownList($model, 'payment_status', array("0" => "Pending", "1" => "Complete", "2" => "Canceled"), array('prompt' => 'select Payment Status', 'class' => 'listtxt')); ?></p>
    </div>
</div>
<fieldset>

    <div class="control-group">
        <label for="blog_date" class="control-label">End Subscribe Date</label>
        <div class="controls">

            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'end_subscrib_date',
                'attribute' => 'end_subscrib_date',
                'model' => $model,
                'options' => array(
                    'dateFormat' => 'yy-mm-d',
                    'altFormat' => 'yy-mm-d',
                    'changeMonth' => true,
                    'changeYear' => true,
                //'appendText' => 'yyyy-mm-dd',
                ),
            ));
            ?>

        </div></div>


</fieldset>

<?php echo $form->textFieldRow($model, 'ads_number', array('class' => 'span5', 'maxlength' => 255)); ?>


<div style="display:block" id="seller">

    <?php echo $form->textfieldRow($user_details, 'shop_name', array('rows' => 6, 'cols' => 50, 'class' => 'span5')); ?>
    <?php echo $form->textfieldRow($user_details, 'shop_address', array('rows' => 6, 'cols' => 50, 'class' => 'span5', 'id' => 'Adress')); ?>

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

    $gMap->addAutocomplete('Adress');

    $gMap->renderMap(array(), Yii::app()->language);
    ?>

    <div class='control-group'>
        <?php echo $form->fileFieldRow($user_details, 'shop_image', array('class' => 'span5', 'maxlength' => 255)); ?>
        <div class='controls'>
            <?php
            if ($model->isNewRecord != '1' and $user_details->shop_image != '') {
                ?>

                <div class="control-group ">

                    <div class="controls">
                        <?php
                        echo "<p id='image-cont'>" . Chtml::image(Yii::app()->baseUrl . '/media/members/' . $user_details->shop_image, '', array('width' => 200)) . "</p>";
                        echo CHtml::ajaxLink(
                                'Delete Image', array('/admin/user/Deleteimage1/id/' . $model->id), array(
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
    <?php echo $form->textfieldRow($user_details, 'paypal_account', array('rows' => 6, 'cols' => 50, 'class' => 'span5')); ?>
    <?php echo $form->textAreaRow($user_details, 'shop_description', array('rows' => 6, 'cols' => 50, 'class' => 'span5')); ?>



</div>



<?php //echo $form->hiddenField($model,'image', array('value' =>)); ?>



<?php //echo $form->checkboxRow($model,'active');  ?>
<?php echo $form->checkboxRow($model, 'instgram_access'); ?>


<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>


<script>
    $("#group").change(function() {
        // alert($(this).val());
        if ($(this).val() != 3)
        {
            $("#seller").css('display', 'block');
        }
        else
        {
            // alert($(this).val());
            $("#seller").css('display', 'none');
        }

    });
</script>

