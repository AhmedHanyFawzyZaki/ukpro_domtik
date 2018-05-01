
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/gallery_model.css" /> 

<?php $user=User::model()->findByAttributes(array('id'=>Yii::app()->user->id));?>

<?php //echo $type;die;?>

<div class="row profile">

<div class="col-md-12">
<ol class="breadcrumb">
      <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/dashboard">Dashboard</a></li>
      <li class="active">Add Prodcut</li>
    </ol>
    
    </div>


<div class="col-md-12 col-xs-12 profile-title">
<p class="profile-name"><?php echo $user->username;?></p>
</div>

<?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'editprofile-form',
                'enableAjaxValidation' => false,
                'type' => 'vertical',
                'htmlOptions' => array('class' => 'form-horizontal','enctype' => 'multipart/form-data'
                ),
            ));
            ?>

<!--appear-->
<?php $this->renderpartial('../home/menu',array('user'=>$user)); ?>
<!--end appear-->


<div class="col-md-9 col-sm-8 col-xs-12">
    
    <?php  if (Yii::app()->user->hasFlash('success')) {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo Yii::app()->user->getFlash('success'); ?>.
            </div>
<?php 
        }
        ?>
     <?php   if (Yii::app()->user->hasFlash('add-error')) {
            ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('add-error'); ?>.
            </div>
        <?php } ?>
<div class="info seller-profile">

    
   
<div class="form-group ">
    <label class="col-md-3 col-sm-4 col-xs-12 control-label " for="Product_title">
        Mian Category
    </label>
    <div class="col-md-6 col-sm-8 col-xs-12">
        <input id="Product_title" class="form-control" type="text" 
               readonly="readonly" value="<?php echo $model->category->title ?>" maxlength="255">
    </div>
</div>

    
    


                <div class="form-group">
                    <label for="country_id" class="col-md-3 col-sm-4 col-xs-12 control-label">Product Category:</label>
                    <div class="col-md-6 col-sm-8 col-xs-12">

                        <?php
                        echo $form->dropDownList($model, 'product_category_id', CHtml::listData(ProductCategory::model()->findAll(array('condition' => "category_id=$model->category_id")), 'id', 'title'), array(
                            'prompt' => 'Select Product Category',
                            'class' => 'form-control',
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => Yii::app()->getbaseurl() . '/admin/Product/getHomesubcats',
                                'data' => array('product_category_id' => 'js:this.value'),
                                //'data' => array('department' => 'js:this.value', 'team' => $model->team),
                                'success' => 'function( data )
                    {
	document.getElementById("model").innerHTML=data;
                    }'
                            ))
                        );
                        ?>
    <?php //echo $form->error($model, 'product_category_id'); ?>
                    </div> 
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-4 col-xs-12 control-label">Sub Category:</label>
                    <div class="col-md-6 col-sm-8 col-xs-12"  id="model">
                        <?php
                        if (empty($model->product_category_id))
                            echo 'Select Sub Category first';
                        else {
                            echo $form->dropDownList($productdetails, 'sub_category_id', CHtml::listData(SubCategory::model()->findAll(array('condition' => "product_category_id=$model->product_category_id")), 'id', 'title'), array('prompt' => 'Select Sub Category', 'class' => 'form-control'));
                        }
                        ?>
    <?php //echo $form->error($productdetails, 'sub_category_id');  ?>
                    </div>
                </div>





          
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="on_sale">Product Name:</label>
                <div  class="col-md-6 col-sm-8 col-xs-12">
                    <?php echo $form->textField($model, 'title', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'title'); ?>
                </div>
            </div>
            
           
    
    
            
            <div class="form-group">
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">Description:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                  <?php echo $form->textArea($model, 'description', array('class' => 'form-control', 'required' => 'required')); ?>
                  <?php echo $form->error($model, 'description'); ?>
                </div>
            </div>
           
            
            <div class="form-group">
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">price:</label>
                <div class="col-md-6 col-sm-7 col-xs-12">
                   <?php echo $form->textField($model, 'price', array('class' => 'form-control', 'required' => 'required','append' => 'GBP')); ?>
                   <?php echo $form->error($model, 'price'); ?>
                </div>
            </div>
    
    
   
    
    
    <div class="form-group">
        <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="on_sale">Type:</label>
        <div class="col-md-6 col-sm-8 col-xs-12">
         <p><?php  echo $form->dropDownList($model, 'type',array("0"=>"product","1"=>"service"),array('id' => 'protype','class'=>'form-control'));?></p>

        </div>
      </div>
    
    
    


<?php 
if ($model->type ==0) // product
{
     $display1='block';
     $display2='none';
}

 else { // service
     $display1='none';
     $display2='block';

 }
    ?>


       <?php if($type==0){?>


    <div class="form-group">

<div class="control-group">
            <label for="shipping_country" class="col-md-3 col-sm-4 col-xs-12 control-label"> Country</label>
            <div class="col-md-6 col-sm-8 col-xs-12">

                <?php
                echo $form->dropDownList($productdetails, 'country_id', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
                    'prompt' => 'Select  Country',
                    'class'=>'form-control',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => Yii::app()->getbaseurl() . '/admin/ProductDetails/getlifecity',
                        'data' => array('country_id' => 'js:this.value'),
                        //'data' => array('department' => 'js:this.value', 'team' => $model->team),
                        'success' => 'function( data )
                    {
	document.getElementById("shipping333").innerHTML=data;
                    }'
                    ))
                );
                ?>
            </div> </div>

    </div>
    <div class="form-group">

        <div class="control-group">
            <label class="col-md-3 col-sm-4 col-xs-12 control-label" style="color:red">   City</label>
            <div class="col-md-6 col-sm-8 col-xs-12"  id="shipping333">
                <?php
                  if (empty($productdetails->country_id))
                    echo  'Select  Country First';
                else {
                    echo $form->dropDownList($productdetails, 'city_id', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$productdetails->country_id")), 'id', 'title'), array('prompt' => 'Select City','class' => 'form-control'));
                }
                ?>
            </div>
         </div>
    </div>
    
    
  <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="on_sale">Post Code:</label>
                <div  class="col-md-6 col-sm-8 col-xs-12">

                    <?php echo $form->textField($productdetails, 'post_code', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                    <?php echo $form->error($productdetails, 'post_code'); ?>
                </div>
            </div>
    
       <?php } ?>

<?php //echo $form->dropDownListRow($model, 'has_stock', array('1' => 'No', '2' => 'Has Stock'), array('class' => 'span5', 'maxlength' => 10, 'id' => 'stock')); ?>


<!--<div style="display:<?= $display1?>" id="has_stock">
    
    <p><?php    // echo $form->dropDownListRow($model, 'has_stock',array("1"=>"has stock","0"=>" no stock "),array('id' => 'stock'));?></p>

</div>-->


<?php 
if ($model->has_stock==1) 
     $display='block';
 else $display='none';
    ?>


    
    
        <div class="form-group"  style="display:<?= $display1?>" id="quantity">
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Quantity:</label>
                <div class="col-md-6 col-sm-7 col-xs-12">
                   <?php echo $form->textField($model, 'quantity', array('class' => 'form-control')); ?>
                   <?php echo $form->error($model, 'quantity'); ?>
                </div>
            </div>


<div style="display:<?= $display2?>" id="address">
            <div class="form-group">

                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Adress:</label>

    <div class="col-md-6 col-sm-7 col-xs-12">
    <?php echo $form->textField($productdetails, 'address', array('rows' => 6, 'cols' => 50, 'class' => 'form-control','id'=>'Address')); ?>
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

</div>


    
    
            
            
         
            
            
            
          
            
            
            
            <p style="color:red">please upload Main Image  with 350 width , 250 height </p>
<div class='form-group'>
                        <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Upload Image:</label>
                        
    <div class='col-md-6 col-sm-7 col-xs-12'>
            <?php echo $form->fileField($model, 'main_image', array('class' => 'span5', 'maxlength' => 255)); ?>

        <?php
        if ($model->isNewRecord != '1' and $model->main_image != '') {
            ?>

            <div class="control-group ">
            <div class="control-group sub-det">

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
            </div>
            <?php
        }
        ?>
    </div>
</div>
            
            
<?php
if ($model->isNewRecord != '1') {
    ?>

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


    
    <div class="form-group">
        <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="on_sale">On Sale:</label>
        <div class="col-md-6 col-sm-8 col-xs-12">
         <p><?php  echo $form->dropDownListRow($model, 'on_sale',array("0"=>" not on sale","1"=>"on sale"),array('id' => 'sale','class'=>'form-control'));?></p>

        </div>
      </div>
    
     <div class="form-group" style="display:none" id="sales">

              <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="on_sale">Old Price :</label>
    <div  class="col-md-6 col-sm-8 col-xs-12">
    <?php echo $form->textFieldRow($model, 'old_price', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>

</div>

        </div>
            
            
             <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="on_sale">Brand:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                   
<p><?php echo $form->dropDownList($productdetails, 'brand_id', CHtml::listData(Brand::model()->findAll("category_id=$model->category_id"), 'id', 'title'), array('prompt' => 'select brand', 'class' => 'form-control','required'=>'required')); ?></p>

                    <?php echo $form->error($model, 'brand_id'); ?>
                </div>
            </div>
            
            
            
  
      
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
               <?php echo CHtml::submitButton('Add /Edit Item', array('class' => 'btn btn-default register-bt')); ?>

        </div>
      </div>
 
    
    
</div><!--end info-->
</div>

</div>


<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->

<?php $this->endWidget(); ?>
    </div>
</div>


</div>

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


<script>
    $("#protype").change(function() {
       //alert($(this).val());
        if ($(this).val() == 0)
        {
            $("#address").css('display', 'none');
            $("#countrycity").css('display', 'none');
            $("#has_stock").css('display', 'block');
            $("#quantity").css('display', 'block');

        }
        if($(this).val() == 1)
        {
            //alert($(this).val());
            $("#address").css('display', 'block');
            $("#countrycity").css('display', 'block');
            $("#has_stock").css('display', 'none');
            $("#quantity").css('display', 'none');


        }

    });
</script>
