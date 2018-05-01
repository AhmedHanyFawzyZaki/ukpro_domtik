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
                echo $form->dropDownList($model, 'product_category_id', CHtml::listData(ProductCategory::model()->findAll(array('condition'=>'category_id=3')), 'id', 'title'), array(
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




<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5','required' => 'required', 'maxlength' => 255)); ?>

<?php //echo $form->dropDownListRow($model, 'has_stock', array('0' => 'No', '1' => 'Has Stock'), array('class' => 'span5', 'maxlength' => 10, 'id' => 'stock')); ?>


<?php echo $form->textAreaRow($model, 'description', array('class' => 'span5','required' => 'required')); ?>

<?php echo $form->textFieldRow($model, 'price', array('class' => 'span5', 'required' => 'required', 'append' => 'GBP')); ?>


<?php //echo $form->textFieldRow($model,'type',array('class'=>'span5'));  ?>



<p style="color:red">please upload Main Image  with 200 width, 200 height</p>
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


<div class="control-group ">
    <?php echo $form->labelEx($model, 'Size: ', array('class' => 'control-label')); ?>

    <div class="controls">
        <?php
                    $criteria = new CDbCriteria;
                    
                     $criteria->condition = 'product_id=:productID';
                    $criteria->params = array(':productID' => $model->id);
                            $sizes = Size::model()->findAll($criteria);

                    if ($model->isNewRecord != '1' and ! empty($sizes)) {
                        foreach ($sizes as $size) {
         $sizees=Sizes::model()->findAllByAttributes(array('category_id'=>3));
         

                            ?>
             <select class="span3" name="product[size][]" placeholder="size">
                           
                            <?php
                            if ($sizees) {
                                foreach ($sizees as $sizee) {
                                    ?>
                 <option value="<?php echo $sizee->id; ?>" <?php if($size->size_id==$sizee->id){echo 'selected= "true"';} ?>><?php echo $sizee->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                <input type="text" name="product[price][]" value="<?php echo $size->price; ?>" class='span3'/>
                <input type="text" name="product[quantity][]" value="<?php echo $size->quantity; ?>" class='span3'/><br/>
                  
                    <?php
            }
        }
        ?>

        <div class="clone1">
             <select class="span3" name="product[size][]" placeholder="size">
                            <option value="">Select sizes...</option>
                            <?php
                            if ($sizees) {
                                foreach ($sizees as $sizee) {
                                    ?>
                                    <option value="<?php echo $sizee->id; ?>"><?php echo $sizee->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <input type="text" name="product[price][]" class='span3' placeholder="price"/>  
                        <input type="text" name="product[quantity][]"  class='span3' placeholder="quantity"/>                   
                   
        </div>
        <?php
        $this->widget('ext.reCopy.ReCopyWidget', array(
            'targetClass' => 'clone1',
            'addButtonLabel' => 'Add New Size',
            'removeButtonLabel' => 'Remove This Size',
            'removeButtonCssClass' => 'remove-clone',
        ));
        ?>	

    </div>
</div>


     
    



<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5'));  ?>




<p><?php echo $form->dropDownListRow($productdetails, 'brand_id', CHtml::listData(Brand::model()->findAll("category_id=$model->category_id"), 'id', 'title'), array('prompt' => 'select brand', 'class' => 'listtxt','required'=>'required')); ?></p>



<div class="control-group">
    <?php //echo $form->labelEx($productdetails,'gender'); ?>
    <label class="control-label" for="Product_price">Gender</label>
    <div class="controls">
        <?php echo $form->radioButtonList($productdetails,'gender',array('0'=>'men','1'=>'women')); ?>
        <?php echo $form->error($productdetails,'gender'); ?>
    </div>
    </div>



<p><?php  echo $form->dropDownListRow($model, 'on_sale',array("0"=>"Not on sale","1"=>"On sale"),array('id' => 'sale'));?></p>


<?php 
if ($model->on_sale==1) 
     $display='block';
 else $display='none';
    ?>

<div style="display:none" id="sales">
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
        if($(this).val() == 0)
        {
           // alert($(this).val());
            $("#sales").css('display', 'none');
        }

    });
</script>
