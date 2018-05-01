
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/gallery_model.css" /> 

<?php $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id)); ?>
<?php
//echo $productdetails->id;die;
//if( $productdetails->isNewRecord !='1')
//{
//    echo "is";
//}else{
//
//    echo "no";
//};die;
?>
<div class="row profile">

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/dashboard">Dashboard</a></li>
            <li class="active">Add Prodcut</li>
        </ol>

    </div>


    <div class="col-md-12 col-xs-12 profile-title">
        <p class="profile-name"><?php echo $user->username; ?></p>
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


<?php if (Yii::app()->user->hasFlash('success')) {
    ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::app()->user->getFlash('success'); ?>.
            </div>
            <?php
        }
        ?>
<?php if (Yii::app()->user->hasFlash('add-error')) {
    ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('add-error'); ?>.
            </div>
            <?php } ?>
        <div class="info seller-profile">
            <?php if ($productdetails->isNewRecord != '1') { ?>
                <p class="profile-name">Edit <?php echo $model->title ?> <span><a href="#"><img src="img/upload-icon.png" alt="" />
                            Upload with API, XML, datafeed etc.</a></span></p>
<?php } else { ?>

                <p class="profile-name">add detais for <?php echo $model->title ?><span><a href="#"><img src="img/upload-icon.png" alt="" />
                            Upload with API, XML, datafeed etc.</a></span></p>

<?php } ?>
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
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Product name:</label>
                    <div class="col-md-6 col-sm-7 col-xs-12">
    <?php echo $form->textField($model, 'title', array('class' => 'form-control', 'placeholder' => 'Product Name')); ?>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">price:</label>
                    <div class="col-md-6 col-sm-7 col-xs-12">
    <?php echo $form->textField($model, 'price', array('class' => 'form-control', 'placeholder' => 'Product Price','append' => 'GBP')); ?>

                    </div>
                </div>

                <div class="form-group" id="quant" style="display:none">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">quantity:</label>
                    <div class="col-md-6 col-sm-7 col-xs-12">
    <?php echo $form->textField($model, 'quantity', array('class' => 'form-control', 'placeholder' => 'Quantity')); ?>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputPassword3">description:</label>
                    <div class="col-md-6 col-sm-7 col-xs-12">
    <?php echo $form->textArea($model, 'description', array('class' => 'form-control', 'placeholder' => 'Description')); ?>

                    </div>
                </div>
            
            
            
<?php if($type==1){ ?>

             

           

    <div class="form-group">

<div class="control-group">
            <label for="shipping_country" class="col-md-3 col-sm-4 col-xs-12 control-label"> Manufacure</label>
            <div class="col-md-6 col-sm-8 col-xs-12">

                <?php
                echo $form->dropDownList($productdetails, 'make_id', CHtml::listData(Make::model()->findAll(), 'id', 'title'), array(
                    'prompt' => 'Select Manufacture',
                    'class'=>'form-control',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => Yii::app()->getbaseurl() . '/admin/ProductDetails/getMotorModels',
                        'data' => array('make_id' => 'js:this.value'),
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
            <label class="col-md-3 col-sm-4 col-xs-12 control-label" style="color:red">   Models</label>
            <div class="col-md-6 col-sm-8 col-xs-12"  id="shipping333">
                <?php
                  if (empty($productdetails->make_id))
                    echo  'select Manufacure first';
                else {
                    echo $form->dropDownList($productdetails, 'motor_model_id', CHtml::listData(MotorModel::model()->findAll(array('condition' => "make_id=$productdetails->make_id")), 'id', 'title'), array('prompt' => 'Select  Motors Models','class'=>'form-control'));
                }
                ?>
            </div>
         </div>
    </div>
    






                <div class="form-group">
                    <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputEmail3">motor condition :</label>
                    <div class="col-md-6 col-sm-8 col-xs-12">
    <?php echo $form->textField($productdetails, 'conditions', array('class' => 'form-control')); ?>

                    </div>
                </div>


<?php } ?>
            <div class="form-group">
                                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Gas:</label>

<div class="col-md-6 col-sm-7 col-xs-12">
<p><?php  echo $form->dropDownList($productdetails, 'gas_id',CHtml::listData(Gas::model()->findAll(), 'id', 'title'),array('prompt'=>'select Gas','class'=>'form-control'));?></p>
</div>
 </div>
             <div class="form-group">
                                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Door:</label>

<div class="col-md-6 col-sm-7 col-xs-12">
<p><?php  echo $form->dropDownList($productdetails, 'door_id',CHtml::listData(Door::model()->findAll(), 'id', 'title'),array('prompt'=>'select Door','class'=>'form-control'));?></p>
</div>
             </div>
 <div class="form-group">
                                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Kmage:</label>

<div class="col-md-6 col-sm-7 col-xs-12">
<p><?php  echo $form->dropDownList($productdetails, 'kmage_id',CHtml::listData(Kmage::model()->findAll(), 'id', 'title'),array('prompt'=>'select Kmage','class'=>'form-control'));?></p>
</div>
 </div>
 <div class="form-group">
                                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Age:</label>

<div class="col-md-6 col-sm-7 col-xs-12">
<p><?php  echo $form->dropDownList($productdetails, 'age_id',CHtml::listData(Age::model()->findAll(), 'id', 'title'),array('prompt'=>'select Age','class'=>'form-control'));?></p>
</div>
 </div>
 <div class="form-group">
                                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Emission:</label>

<div class="col-md-6 col-sm-7 col-xs-12">
<p><?php  echo $form->dropDownList($productdetails, 'emission_id',CHtml::listData(Emission::model()->findAll(), 'id', 'title'),array('prompt'=>'select Emission','class'=>'form-control'));?></p>
</div>
 </div>
 <div class="form-group">
                                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Engine:</label>

<div class="col-md-6 col-sm-7 col-xs-12">
<p><?php  echo $form->dropDownList($productdetails, 'engine_id',CHtml::listData(Engine::model()->findAll(), 'id', 'title'),array('prompt'=>'select Engine','class'=>'form-control'));?></p>
</div>
 </div> 
            
      <div class="form-group">
                                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Power engine:</label>

<div class="col-md-6 col-sm-7 col-xs-12">
    <?php echo $form->dropDownList($productdetails,'power_engine',array("1"=>"100cv","2"=>"200cv"),array('class'=>'form-control','prompt'=>'select Motor Status')); ?>
</div>
    </div>       
    <div class="form-group">
                                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Motor Status:</label>

<div class="col-md-6 col-sm-7 col-xs-12">
    <?php echo $form->dropDownList($productdetails,'motor_status',array("1"=>"Used","2"=>"Newly Used","3"=>"New"),array('class'=>'form-control','prompt'=>'select Motor Status')); ?>
</div>
    </div>
            
      <div class="form-group">
                                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Conditions:</label>

<div class="col-md-6 col-sm-7 col-xs-12">      
<?php echo $form->textArea($productdetails, 'conditions', array('class' => 'span5', 'maxlength' => 255)); ?>
</div>
      </div>

            <div class="form-group">
                                    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">On Sale:</label>

<div class="col-md-6 col-sm-7 col-xs-12">      
<p><?php echo $form->dropDownList($model, 'on_sale', array("0" => "Not on sale ","1" => "On sale"), array('id' => 'sale','class'=>'form-control')); ?></p>
</div>
            </div>
    

                <p style="color:red">please upload Main Image  with 290 width , 360 height </p>

                <div class='form-group'>
    <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Upload Image:</label>

                    <div class='controls'>
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
                        <input   id="" class="span5" name="" value="Please save product before Uploading images" readonly>
                    </div>
                </div>

                <?php
            }
            ?>



            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="on_sale">On Sale:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <p><?php echo $form->dropDownListRow($model, 'on_sale', array("0" => " not on sale", "1" => "on sale"), array('id' => 'sale', 'class' => 'form-control')); ?></p>

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

                     
<div class="form-group ">
            <label class="col-md-3 col-sm-4 col-xs-12 control-label">Product Colors</label>
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
        
           



                <br/><br/>








            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
<?php echo CHtml::submitButton('Add/Edit Item', array('class' => 'btn btn-default register-bt')); ?>
                </div>
            </div>




            <!--appear-->
            <?php $this->renderpartial('../home/sponsor'); ?>
            <!--end appear-->

<?php $this->endWidget(); ?>




        </div><!--end info-->
    </div>

</div>

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

