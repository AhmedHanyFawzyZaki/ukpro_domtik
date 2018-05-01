<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'ads-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="control-group">
    <label for="shipping_country" class="control-label"> Web Site  Category </label>
    <div class="controls">

        <?php
        echo $form->dropDownList($model, 'category_id', CHtml::listData(Category::model()->findAll(), 'id', 'title'), array(
            'prompt' => 'Web Site  Category',
            'ajax' => array(
                'type' => 'POST',
                'url' => Yii::app()->getbaseurl() . '/admin/Ads/getproduct',
                'data' => array('category_id' => 'js:this.value'),
                //'data' => array('department' => 'js:this.value', 'team' => $model->team),
                'success' => 'function( data )
                    {
	document.getElementById("cat").innerHTML=data;
                    }'
            ))
        );
        ?>
    </div> </div>



<?php //echo $form->textFieldRow($model,'category_id',array('class'=>'span5'));  ?>
<p><?php //echo $form->dropDownListRow($model, 'category_id',CHtml::listData(Category::model()->findAll(), 'id', 'title'),array('prompt'=>'select website category')); ?></p>


    <?php //echo $form->textFieldRow($model,'image',array('class'=>'span5','maxlength'=>255)); ?>
<div class='control-group'>
        <?php echo $form->fileFieldRow($model, 'image', array('class' => 'span5', 'maxlength' => 255)); ?>
    <div class='controls'>
        <?php
        if ($model->isNewRecord != '1' and $model->image != '') {
            ?>

            <div class="control-group ">

                <div class="">
                    <?php
                    echo "<p id='image-cont'>" . Chtml::image(Yii::app()->baseUrl . '/media/ads/' . $model->image, '', array('width' => 200)) . "</p>";
                    echo CHtml::ajaxLink(
                            'Delete Image', array('/admin/Ads/deleteimage/id/' . $model->id), array(
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

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php //echo $form->textFieldRow($model, 'description', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php //echo $form->textFieldRow($model,'product_id',array('class'=>'span5'));  ?>
<p><?php //echo $form->dropDownListRow($model, 'product_id',CHtml::listData(Product::model()->findAll(), 'id', 'title'),array('prompt'=>'select product')); ?></p>
<p style="color:red">you can write link or select product. </p>
<?php echo $form->textFieldRow($model, 'link', array('class' => 'span5', 'maxlength' => 255)); ?>
<div style="display:block" id="dpt">
    <div class="control-group">
        <label class="control-label" >Product</label>
        <div class="controls"  id="cat">
            <?php
            if (empty($model->category_id))
                echo 'Select Web Site Category First';
            else {
                echo $form->dropDownList($model, 'product_id', CHtml::listData(Product::model()->findAll(array('condition' => "category_id=$model->category_id")), 'id', 'title'), array('prompt' => 'Select Product'));
            }
            ?>
        </div>
    </div>
</div>

<?php
echo $form->checkBoxRow($model, 'main_ad', array('class' => 'main_ad', 'maxlength' => 255));
?>

<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5','maxlength'=>255)); ?>

    <?php //echo $form->textFieldRow($model,'temp2',array('class'=>'span5','maxlength'=>255));  ?>

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

  <style>
        .checkbox{
            display: none;
        }
        </style>

<script>
    $(function(){
        
         var cat_id = $("#Ads_category_id").val(); 
          if(cat_id==1 || cat_id==3 || cat_id==4 ){
              $(".checkbox").fadeIn(350);
          }else{
              $(".checkbox").fadeOut(350);
          }
        
        
       $("#Ads_category_id").change(function(){
         
          var cat_id = $(this).val(); 
          if(cat_id==1 || cat_id==3 || cat_id==4 ){
              $(".checkbox").fadeIn(350);
          }else{
              $(".checkbox").fadeOut(350);
          }
       });
    });
    </script>
    
  