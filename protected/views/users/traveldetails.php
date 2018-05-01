
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

<div class="control-group ">
    <label class="col-md-3 col-sm-4 col-xs-12 control-label " for="Product_title">
        Product Name
    </label>
    <div class="col-md-6 col-sm-8 col-xs-12">
        <input id="Product_title" class="form-control" type="text" 
               readonly="readonly" value="<?php echo $model->title ?>" maxlength="255">
    </div>
</div>

 <div class="form-group">
        <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Product category:</label>
        <div class="col-md-6 col-sm-8 col-xs-12">
          <p><?php echo $form->dropDownListRow($model, 'product_category_id', CHtml::listData(ProductCategory::model()->findAll(), 'id', 'title'), array('prompt' => 'select Product Category', 'class' => 'form-control')); ?></p>

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

        </div>
    
     <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="on_sale">Brand:</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                   
<p><?php echo $form->dropDownList($productdetails, 'brand_id', CHtml::listData(Brand::model()->findAll("category_id=$model->category_id"), 'id', 'title'), array('prompt' => 'select brand', 'class' => 'form-control','required'=>'required')); ?></p>

                    <?php echo $form->error($model, 'brand_id'); ?>
                </div>
            </div>
    
 <div class="form-group">
        <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="on_sale">Travel Type:</label>
        <div class="col-md-6 col-sm-8 col-xs-12">
    <p><?php echo $form->dropDownListRow($productdetails, 'travel_type', array("1" => "hotels", "2" => "flight"), array('id' => 'travel','class'=>'form-control')); ?></p>

        </div>
      </div>
 
    <div class="form-group" style="display:block "id="hotels">
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
<?php echo $form->labelEx($model, 'Book Room:  ', array('class' => 'col-md-3 col-sm-4 col-xs-12 control-label')); ?>

        <div class="col-md-6 col-sm-8 col-xs-12">
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
        <div class="form-group" style="display:none" id="flight">

    
    <div class="form-group">
        <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Source Country:</label>
        <div class="col-md-6 col-sm-8 col-xs-12">
    <p><?php echo $form->dropDownListRow($productdetails, 'source_country', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array('prompt' => 'select Source Country ', 'class' => 'form-control')); ?></p>

        </div>
      </div>
    
    
    <div class="form-group">
        <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Source City :</label>
        <div class="col-md-6 col-sm-8 col-xs-12">
    <p><?php echo $form->dropDownListRow($productdetails, 'source_city', CHtml::listData(City::model()->findAll(), 'id', 'title'), array('prompt' => 'select Source City ', 'class' => 'form-control')); ?></p>

        </div>
      </div>
    
    <div class="form-group">
        <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3"> Destination Country:</label>
        <div class="col-md-6 col-sm-8 col-xs-12">
    <p><?php echo $form->dropDownListRow($productdetails, 'destination_country', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array('prompt' => 'select  Destination Country ', 'class' => 'form-control')); ?></p>

        </div>
      </div>
    
    
    <div class="form-group">
        <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="inputPassword3">Destination City:</label>
        <div class="col-md-6 col-sm-8 col-xs-12">
    <p><?php echo $form->dropDownListRow($productdetails, 'destination_city', CHtml::listData(City::model()->findAll(), 'id', 'title'), array('prompt' => 'select destination City ', 'class' => 'form-control')); ?></p>

        </div>
      </div>
    
    
    

    <fieldset>

        <div class="control-group" >
            <label for="blog_date" class="col-md-3 col-sm-4 col-xs-12 control-label">Flight Date</label>
            <div class="col-md-6 col-sm-8 col-xs-12">

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
    
    
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
       <?php echo CHtml::submitButton('Add Item', array('class' => 'btn btn-default register-bt')); ?>

        </div>
      </div>
 
    

    
    
</div><!--end info-->
</div>

</div>


<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->

<?php $this->endWidget(); ?>

<script>
    $("#travel").change(function() {
        // alert($(this).val());
        if ($(this).val() == 1)
        {
            $("#hotels").css('display', 'block');
           
            $("#flight").css('display', 'none');
           

        }
        if ($(this).val() == 2)
        {
            // alert($(this).val());
             $("#hotels").css('display', 'none');
           
            $("#flight").css('display', 'block');
           

        }

    });
</script>

