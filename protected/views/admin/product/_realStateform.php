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

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'product-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="control-group ">
    <label class="control-label required" for="Product_title">
        Mian Category
    </label>
    <div class="controls">
        <input id="Product_title" class="span5" type="text" 
               readonly="readonly" value="<?php echo $model->category->title ?>" maxlength="255">
    </div>
</div>



<div class="control-group ">
    <label class="control-label required" for="Product_title">
       Product owner
    </label>
    <div class="controls">
        <input id="Product_title" class="span5" type="text" 
               readonly="readonly" value="<?php echo $model->user->username ?>" maxlength="255">
    </div>
</div>



<p><?php // echo $form->dropDownListRow($model, 'category_id',CHtml::listData(Category::model()->findAll(), 'id', 'title'),array('prompt'=>'select Web Site Category'));  ?></p>


<div class="control-group">
            <label for="shipping_country" class="control-label">  Product Category </label>
            <div class="controls">

                <?php
                echo $form->dropDownList($model, 'product_category_id', CHtml::listData(ProductCategory::model()->findAll(array('condition'=>'category_id=10')), 'id', 'title'), array(
                    'prompt' => 'Select Product Category',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => Yii::app()->getbaseurl() . '/admin/Product/getSubCats',
                        'data' => array('product_category_id' => 'js:this.value'),
                        //'data' => array('department' => 'js:this.value', 'team' => $model->team),
                        'success' => 'function( data )
                    {
	document.getElementById("cat").innerHTML=data;
                    }'
                    ))
                );
                ?>
            </div> </div>



<div style="display:block" id="dpt">
        <div class="control-group">
            <label class="control-label" style="color:red"> Sub Category</label>
            <div class="controls"  id="cat">
                <?php
                        if (empty($model->product_category_id))
                    echo 
                    'Select Sub Category First';
                else {
                    echo $form->dropDownList($productdetails, 'sub_category_id', CHtml::listData(SubCategory::model()->findAll(array('condition' => "product_category_id=$model->product_category_id")), 'id', 'title'), array('prompt' => 'Select Sub Category'));
                }
                ?>
            </div>
        </div>
         </div>



<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'required' => 'required', 'maxlength' => 255)); ?>


<?php echo $form->textAreaRow($model, 'description', array('class' => 'span5', 'required' => 'required')); ?>

<?php echo $form->textFieldRow($model, 'price', array('class' => 'span5','required'=>'required')); ?>



<div class="control-group">
            <label for="shipping_country" class="control-label"> Country</label>
            <div class="controls">

                <?php
                echo $form->dropDownList($productdetails, 'country_id', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
                    'prompt' => 'Select  Country',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => Yii::app()->getbaseurl() . '/admin/ProductDetails/getrealcity',
                        'data' => array('country_id' => 'js:this.value'),
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
            <label class="control-label" style="color:red">   City</label>
            <div class="controls"  id="shipping">
                <?php
                if (empty($productdetails->country_id))
                    echo 
                    'Select  Country First';
                else {
                    echo $form->dropDownList($productdetails, 'city_id', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$productdetails->country_id")), 'id', 'title'), array('prompt' => 'Select City'));
                }
                ?>
            </div>
        </div>
         </div>


<?php echo $form->textFieldRow($productdetails,'post_code',array('class'=>'span5'));  ?>


<?php //echo $form->dropDownListRow($model, 'has_stock', array('1' => 'No', '2' => 'Has Stock'), array('class' => 'span5', 'maxlength' => 10, 'id' => 'stock')); ?>


<?php //echo $form->textFieldRow($model,'type',array('class'=>'span5'));  ?>



<p style="color:red">please upload Main Image  with  330 width, 300 height</p>
<div class='control-group'>
    <?php echo $form->fileFieldRow($model, 'main_image', array('class' => 'span5', 'maxlength' => 255)); ?>
    <div class='controls'>
        <?php
        if ($model->isNewRecord != '1' and $model->main_image != '') {
            ?>

            <div class="control-group ">

                <div class="">
                    <?php
                    if($model->flag != 1){
                    echo "<p id='image-cont'>" . Chtml::image(Yii::app()->baseUrl . '/media/product/' . $model->main_image, '', array('width' => 200)) . "</p>";
                    }else{
                         echo "<p id='image-cont'>" . Chtml::image( $model->main_image, '', array('width' => 200)) . "</p>";
                  
                    }
                    
                    echo CHtml::ajaxLink(
                            'Delete Image', array('/admin/product/deleteimage/id/' . $model->id), array(
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
<?php
if ($model->isNewRecord != '1') {
    ?>
<p style="color:red">Gallery Images 1280 height , 854 width</p>
    <div class="control-group">
        <label for=\"UserDetails_city\" class="control-label">Gallery</label>
        <div class="controls">
            <div class="span<?php echo(isset($_GET['w']) ? $_GET['w'] : '12') ?>" style="width:900px;">
                <?php
                $this->widget('GalleryManager', array(
                    'gallery' => $gallery,
                ));
                ?>

            </div>
        </div>
    </div>

    <?php
} else {
    ?>
    <div class="control-group ">
        <label class="control-label" for="Motor_address">Gallery</label>
        <div class="controls">
            <input id="" class="span5" type="text" name="" value="Please save product before Uploading images" readonly>
        </div>
    </div>

    <?php
}
?>


<p><?php echo $form->dropDownListRow($productdetails, 'brand_id', CHtml::listData(Brand::model()->findAll("category_id=$model->category_id"), 'id', 'title'), array('prompt' => 'select brand', 'class' => 'listtxt','required'=>'required')); ?></p>


<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5'));  ?>


<div class="controls">
        <?php echo $form->labelEx($productdetails,'real_estate_type'); ?>
        <?php echo $form->radioButtonList($productdetails,'real_estate_type',array('0'=>'Rent','1'=>'Sale')); ?>
        <?php echo $form->error($productdetails,'real_estate_type'); ?>
    </div>




<?php echo $form->textAreaRow($productdetails, 'real_estate_facilities', array('class' => 'span5', 'maxlength' => 255)); ?>






<p><?php  echo $form->dropDownListRow($model, 'on_sale',array("0"=>"Not on sale ","1"=>"On sale"),array('id' => 'sale'));?></p>

<?php 
if ($model->on_sale==1) 
     $display='block';
 else $display='none';
    ?>

<div style="display:<?= $display?>" id="sales">
    <?php echo $form->textFieldRow($model, 'old_price', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

</div>

<?php echo $form->checkboxRow($model, 'featured_in_home_page'); ?>
<?php echo $form->checkboxRow($model, 'category_featured'); ?>
<?php echo $form->checkboxRow($model, 'show_in_website_category'); ?>
<?php echo $form->checkboxRow($model, 'show_in_home_page'); ?>

<p><?php echo $form->dropDownListRow($model, 'product_status_id', CHtml::listData(ProductStatus::model()->findAll(), 'id', 'title'), array('prompt' => 'select Product Status ', 'class' => 'listtxt')); ?></p>
    <?php echo $form->textFieldRow($productdetails, 'address', array('rows' => 6, 'cols' => 50, 'class' => 'span8','id'=>'Address')); ?>

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
    $("#stock").change(function() {
       //  alert($(this).val());
        if ($(this).val() == 1)
        {
            $("#quantity").css('display', 'block');
        }
        if($(this).val() == 0)
        {
           // alert($(this).val());
            $("#quantity").css('display', 'none');
        }

    });
</script>

<script>
    $("#sale").change(function() {
        // alert($(this).val());
        if ($(this).val() == 1)
        {
            $("#sales").css('display', 'block');
        }
        if($(this).val() == 0)
        {
           // alert($(this).val());
            $("#sales").css('display', 'none');
        }

    });
</script>
