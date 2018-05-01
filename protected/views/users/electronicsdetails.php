
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/gallery_model.css" /> 
<?php $user=User::model()->findByAttributes(array('id'=>Yii::app()->user->id));?>

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

    
<div class="control-group ">
    <label class="col-md-3 col-sm-4 col-xs-12 control-label " for="Product_title">
        Mian Category
    </label>
    <div class="col-md-6 col-sm-8 col-xs-12">
        <input id="Product_title" class="form-control" type="text" 
               readonly="readonly" value="<?php echo $model->category->title ?>" maxlength="255">
    </div>
</div>
<br/><br/>





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
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">price:</label>
                <div class="col-md-6 col-sm-7 col-xs-12">
                   <?php echo $form->textField($model, 'price', array('class' => 'form-control', 'required' => 'required','append' => 'GBP')); ?>
                   <?php echo $form->error($model, 'price'); ?>
                </div>
            </div>
            
            
             <div class="form-group">
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Quantity:</label>
                <div class="col-md-6 col-sm-7 col-xs-12">
                   <?php echo $form->textField($model, 'quantity', array('class' => 'form-control', 'required' => 'required')); ?>
                   <?php echo $form->error($model, 'quantity'); ?>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">Description:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                  <?php echo $form->textArea($model, 'description', array('class' => 'form-control', 'required' => 'required')); ?>
                  <?php echo $form->error($model, 'description'); ?>
                </div>
            </div>
            
            
          
            
            
            
            <p style="color:red">please upload Main Image  with 150 width , 160 height </p>
<div class='form-group'>
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">Upload Image:</label>

    <div class='col-md-6 col-sm-8 col-xs-12'>
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
                    }elseif($model->flag){
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

 
                          
<div class="form-group ">
            <label class="col-md-3 col-sm-4 col-xs-12 control-label">Product Colors </label>
            <div class="col-md-6 col-sm-8 col-xs-12">
                <?php
                $this->widget('Select2', array(
                    'model' => $model_col,
                    'attribute' => 'colors_id',
                    'data' => Helper::getColors(),
                    'htmlOptions' => array('class' => "col-md-12", 'multiple' => 'multiple'),
                ));
                ?>
            </div>
        </div>
    
      
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
              
               <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="on_sale">Brand:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                   
<p><?php echo $form->dropDownList($productdetails, 'brand_id', CHtml::listData(Brand::model()->findAll("category_id=$model->category_id"), 'id', 'title'), array('prompt' => 'select brand', 'class' => 'form-control','required'=>'required')); ?></p>

                    <?php echo $form->error($model, 'brand_id'); ?>
                </div>
            </div>

        </div>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
      <?php echo CHtml::submitButton('Add Item', array('class' => 'btn btn-default register-bt')); ?>

        </div>
      </div>
 
 <?php $this->endWidget(); ?>

    

    
    
</div><!--end info-->
</div>

</div>



<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->



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
