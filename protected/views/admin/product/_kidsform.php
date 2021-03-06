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
                echo $form->dropDownList($model, 'product_category_id', CHtml::listData(ProductCategory::model()->findAll(array('condition'=>'category_id=8')), 'id', 'title'), array(
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


<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5','required'=>'required', 'maxlength' => 255)); ?>

<?php echo $form->textAreaRow($model, 'description', array('class' => 'span5','required'=>'required')); ?>

<p><?php  //echo $form->dropDownListRow($model, 'has_stock',array("1"=>"has stock","0"=>" no stock "),array('id' => 'stock'));?></p>
<?php echo $form->textFieldRow($model, 'price', array('class' => 'span5','required'=>'required','append'=>'GBP')); ?>

<?php 
if ($model->has_stock==1) 
     $display='block';
 else $display='none';
    ?>


<!--<div style="display:<?= $display?>" id="quantity">
    <?php echo $form->textFieldRow($model, 'quantity', array('class' => 'span5')); ?>
</div>-->
 <?php echo $form->textFieldRow($model, 'quantity', array('class' => 'span5','required'=>'required')); ?>


<p><?php  echo $form->dropDownListRow($productdetails, 'kids_type',array("0"=>"Baby","1"=>"kids","2"=>"moms and maternity"),array('prompt'=>'select Kids Age '));?></p>


<p><?php  echo $form->dropDownListRow($productdetails, 'kids_for',array("0"=>"Fashion ","1"=>"Entertainment ","2"=>"Nursery and Gear"),array('prompt'=>'select Kids For '));?></p>

<?php //echo $form->dropDownListRow($model, 'has_stock', array('1' => 'No', '2' => 'Has Stock'), array('class' => 'span5', 'maxlength' => 10, 'id' => 'stock')); ?>

<div class="control-group ">
            <label class="control-label">Product Colors</label>
            <div class="controls">
                <?php
                $this->widget('Select2', array(
                    'model' => $model_col,
                    'attribute' => 'colors_id',
                    'data' => Helper::getColors(),
                    'htmlOptions' => array('class' => "span5", 'multiple' => 'multiple'),
                ));
                ?>
            </div>
        </div>

   
<div class="control-group ">
            <label class="control-label">Product Sizes </label>
            <div class="controls">
                <?php
                $this->widget('Select2', array(
                    'model' => $model_siz,
                    'attribute' => 'sizes_id',
                    'data' => Helper::getSizes($model->category_id),
                    'htmlOptions' => array('class' => "span5", 'multiple' => 'multiple'),
                ));
                ?>
            </div>
        </div>



<p><?php echo $form->dropDownListRow($productdetails, 'brand_id', CHtml::listData(Brand::model()->findAll("category_id=$model->category_id"), 'id', 'title'), array('prompt' => 'select brand', 'class' => 'listtxt','required'=>'required')); ?></p>


<?php //echo $form->textFieldRow($model,'type',array('class'=>'span5'));  ?>



<p style="color:red">please upload Main Image  with 150 width, 110 height</p>
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

<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5'));  ?>








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
