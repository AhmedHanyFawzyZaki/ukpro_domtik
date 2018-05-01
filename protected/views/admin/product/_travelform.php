<!--<div class="control-group">

    <p class="profile-name" data-toggle="modal" data-target="#xml-popup">add new item<span>
                        Upload with <a href="#" id="upload"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>xml.</span></p>


                        <p class="profile-name" data-toggle="modal" data-target="#csv-popup">add new item<span>
                        Upload With<a href="#" id="upload"><img src="<?=Yii::app()->request->baseUrl; ?>/img/edit-icon.png" alt="" /> </a>Csv or Excel</span></p>

                        
</div>-->

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


<p><?php // echo $form->dropDownListRow($model, 'category_id',CHtml::listData(Category::model()->findAll(), 'id', 'title'),array('prompt'=>'select Web Site Category'));   ?></p>



<div class="control-group">
            <label for="shipping_country" class="control-label">  Product Category </label>
            <div class="controls">

                <?php
                echo $form->dropDownList($model, 'product_category_id', CHtml::listData(ProductCategory::model()->findAll(array('condition'=>'category_id=2')), 'id', 'title'), array(
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
                if ($model->isNewRecord)
                    echo 
                    'Select Sub Category First';
                else {
                    echo $form->dropDownList($productdetails, 'sub_category_id', CHtml::listData(SubCategory::model()->findAll(array('condition' => "product_category_id=$model->product_category_id")), 'id', 'title'), array('prompt' => 'Select Sub Category'));
                }
                ?>
            </div>
        </div>
         </div>


<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textAreaRow($model, 'description', array('class' => 'span5')); ?>

<?php //echo $form->dropDownListRow($model, 'has_stock', array('1' => 'No', '2' => 'Has Stock'), array('class' => 'span5', 'maxlength' => 10, 'id' => 'stock')); ?>



<?php //echo $form->textFieldRow($model,'type',array('class'=>'span5'));  ?>



<p style="color:red">please upload Main Image  with 230 height , 200 width</p>
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
                     echo "<p id='image-cont'>" . Chtml::image($model->main_image, '', array('width' => 200)) . "</p>";
                       
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


<p><?php echo $form->dropDownListRow($productdetails, 'travel_type', array("1" => "hotels", "2" => "flight"), array('id' => 'protype')); ?></p>



<?php
if ($productdetails->travel_type == 1) {
    $display1 = 'block';
    $display2 = 'none';
} elseif ($productdetails->travel_type == 2) {
    $display1 = 'none';
    $display2 = 'block';
} else {
    $display1 = 'block';
    $display2 = 'none';
}
?>
<div style="display:<?= $display1 ?>" id="gallery">

<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5'));   ?>

    <div class="control-group ">
<?php echo $form->labelEx($model, 'Book Room:  ', array('class' => 'control-label')); ?>

        <div class="controls">
    <?php
    if ($model->isNewRecord != '1' and ! empty($rooms)) {
        //  print_r($rooms);die;
        foreach ($rooms as $room) {
            ?>
                    <div  class="clone">

                        <input type="text" name="room[roomoptions][]" placeholder="Room options" value="<?php echo $room->room_options; ?>" class='span2'/><br/>
                        <input type="text" name="room[bedoptions][]" placeholder="Bed options"   value="<?php echo $room->bed_options; ?>" class='span2'/><br/>
                        <input type="text" name="room[adultprice][]" placeholder="Adult price" value="<?php echo $room->adult_price; ?>" class='span2'/><br/>
                        <input type="text" name="room[childrenprice][]"placeholder="Children price"  value="<?php echo $room->children_price; ?>" class='span2'/><br/>
                        <input type="text" name="room[infantprice][]" placeholder="Infant price" value="<?php echo $room->infant_price; ?>" class='span2'/><br/>

                    </div>

        <?php
    }
}
?>

            <div class="clone">


                <input type="text" name="room[roomoptions][]"placeholder="Room options" value="" class='span2'/>
                <input type="text" name="room[bedoptions][]"placeholder="Bed options" value="" class='span2'/>
                <input type="text" name="room[adultprice][]"placeholder="Adult price" value="" class='span2'/>
                <input type="text" name="room[childrenprice][]"placeholder="Children price" value="" class='span2'/>
                <input type="text" name="room[infantprice][]"placeholder="Infant price" value="" class='span2'/>


            </div>
<?php
$this->widget('ext.reCopy.ReCopyWidget', array(
    'targetClass' => 'clone',
    'addButtonLabel' => 'Add New Room',
    'removeButtonLabel' => 'Remove This Room',
    'removeButtonCssClass' => 'remove-clone',
));
?>	

        </div>
    </div>
</div>

<div style="display:<?= $display2 ?>" id="price">
       <?php echo $form->textFieldRow($model, 'price', array('class' => 'span5', 'append' => 'GBP')); ?>
<?php if($productdetails->travel_type==2 and $model->isNewRecord !='1'){  ?>
    
<div class="control-group">
            <label for="shipping_country" class="control-label"> Source Country</label>
            <div class="controls">

                <?php
                echo $form->dropDownList($productdetails, 'source_country', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
                    'prompt' => 'Select Source Country',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => Yii::app()->getbaseurl() . '/admin/ProductDetails/getSourcecity',
                        'data' => array('source_country' => 'js:this.value'),
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
            <label class="control-label" style="color:red">  Source City</label>
            <div class="controls"  id="shipping">
                <?php
                if ($model->isNewRecord)
                    echo 
                    'Select  Country First';
                else {
                    echo $form->dropDownList($productdetails, 'source_city', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$productdetails->source_country")), 'id', 'title'), array('prompt' => 'Select City'));
                }
                ?>
            </div>
        </div>
         </div>

<div class="control-group">
            <label for="shipping_country" class="control-label">  Destination Country</label>
            <div class="controls">

                <?php
                echo $form->dropDownList($productdetails, 'destination_country', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
                    'prompt' => 'Select Destination Country',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => Yii::app()->getbaseurl() . '/admin/ProductDetails/getDestinationcity',
                        'data' => array('destination_country' => 'js:this.value'),
                        //'data' => array('department' => 'js:this.value', 'team' => $model->team),
                        'success' => 'function( data )
                    {
	document.getElementById("destination").innerHTML=data;
                    }'
                    ))
                );
                ?>
            </div> </div>



<div style="display:block" id="dpt">
        <div class="control-group">
            <label class="control-label" style="color:red"> Destination  City</label>
            <div class="controls"  id="destination">
                <?php
                if ($model->isNewRecord)
                    echo 
                    'Select Destination Country First';
                else {
                    echo $form->dropDownList($productdetails, 'destination_city', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$productdetails->destination_country")), 'id', 'title'), array('prompt' => 'Select City'));
                }
                ?>
            </div>
        </div>
         </div>
    
<?php } ?>




<?php if ($model->isNewRecord =='1'){?>
    
    
<div class="control-group">
            <label for="shipping_country" class="control-label"> Source Country</label>
            <div class="controls">

                <?php
                echo $form->dropDownList($productdetails, 'source_country', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
                    'prompt' => 'Select Source Country',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => Yii::app()->getbaseurl() . '/admin/ProductDetails/getSourcecity',
                        'data' => array('source_country' => 'js:this.value'),
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
            <label class="control-label" style="color:red">  Source City</label>
            <div class="controls"  id="shipping">
                <?php
                if ($model->isNewRecord)
                    echo 
                    'Select  Country First';
                else {
                    echo $form->dropDownList($productdetails, 'source_city', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$productdetails->source_country")), 'id', 'title'), array('prompt' => 'Select City'));
                }
                ?>
            </div>
        </div>
         </div>

<div class="control-group">
            <label for="shipping_country" class="control-label">  Destination Country</label>
            <div class="controls">

                <?php
                echo $form->dropDownList($productdetails, 'destination_country', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
                    'prompt' => 'Select Destination Country',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => Yii::app()->getbaseurl() . '/admin/ProductDetails/getDestinationcity',
                        'data' => array('destination_country' => 'js:this.value'),
                        //'data' => array('department' => 'js:this.value', 'team' => $model->team),
                        'success' => 'function( data )
                    {
	document.getElementById("destination").innerHTML=data;
                    }'
                    ))
                );
                ?>
            </div> </div>



<div style="display:block" id="dpt">
        <div class="control-group">
            <label class="control-label" style="color:red"> Destination  City</label>
            <div class="controls"  id="destination">
                <?php
                if ($model->isNewRecord)
                    echo 
                    'Select Destination Country First';
                else {
                    echo $form->dropDownList($productdetails, 'destination_city', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$productdetails->destination_country")), 'id', 'title'), array('prompt' => 'Select City'));
                }
                ?>
            </div>
        </div>
         </div>
    
    
<?php } ?>







    <fieldset>

        <div class="control-group" >
            <label for="blog_date" class="control-label">Flight Date</label>
            <div class="controls">

<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name' => 'flight_date',
    'attribute' => 'flight_date',
    'model' => $productdetails,
    'options' => array(
        'dateFormat' => 'd-mm-yy',
        'altFormat' => 'd-mm-yy',
        'changeMonth' => true,
        'changeYear' => true,
    //'appendText' => 'yyyy-mm-dd',
    ),
));
?>

            </div></div>



    </fieldset>


</div>





<p><?php echo $form->dropDownListRow($model, 'on_sale', array("0" => " Not on Sale ","1" => "On sale"), array('id' => 'sale')); ?></p>

<?php
if ($model->on_sale == 1)
    $display = 'block';
else
    $display = 'none';
?>

<div style="display:<?= $display ?>" id="sales">
<?php echo $form->textFieldRow($model, 'old_price', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

</div>
<?php echo $form->checkboxRow($model, 'featured_in_home_page'); ?>
<?php echo $form->checkboxRow($model, 'category_featured'); ?>
<?php echo $form->checkboxRow($model, 'show_in_website_category'); ?>
<?php echo $form->checkboxRow($model, 'show_in_home_page'); ?>
<p><?php echo $form->dropDownListRow($model, 'product_status_id', CHtml::listData(ProductStatus::model()->findAll(), 'id', 'title'), array('prompt' => 'select Product Status ', 'class' => 'listtxt')); ?></p>





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
    $("#sale").change(function() {
        // alert($(this).val());
        if ($(this).val() == 1)
        {
            $("#sales").css('display', 'block');
        }
        if ($(this).val() == 0)
        {
            // alert($(this).val());
            $("#sales").css('display', 'none');
        }

    });
</script>


<script>
    $("#protype").change(function() {
        // alert($(this).val());
        if ($(this).val() == 1)
        {
            $("#gallery").css('display', 'block');
            $("#room").css('display', 'block');
            $("#price").css('display', 'none');
            $("#source_city").css('display', 'none');
            $("#destination_city").css('display', 'none');
            $("#source_country").css('display', 'none');
            $("#destination_country").css('display', 'none');
            $("#flight_date").css('display', 'none');

        }
        if ($(this).val() == 2)
        {
            // alert($(this).val());
            $("#gallery").css('display', 'none');
            $("#room").css('display', 'none');
            $("#price").css('display', 'block');
            $("#source_city").css('display', 'block');
            $("#destination_city").css('display', 'block');
            $("#source_country").css('display', 'block');
            $("#destination_country").css('display', 'block');
            $("#flight_date").css('display', 'block');

        }

    });
</script>

