<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'category-slider-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
    'htmlOptions' => array(	'enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php //echo $form->textFieldRow($model,'category_id',array('class'=>'span5'));  ?>
<div class="control-group ">
    <label class="control-label required" for="Product_title">
        Web site Category
    </label>
    <div class="controls">
        <input id="Product_title" class="span5" type="text" 
               readonly="readonly" value="<?php echo $model->category->title ?>" maxlength="255">
    </div>
</div>

<?php //echo $form->textFieldRow($model, 'image', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php //echo $form->textFieldRow($model, 'description', array('class' => 'span5', 'maxlength' => 255)); ?>

<!--<p style="color:red">please upload Main Image  with 230 height , 200 width</p>-->
<div class='control-group'>
    <?php echo $form->fileFieldRow($model, 'image', array('class' => 'span5', 'maxlength' => 255)); ?>
    <div class='controls'>
        <?php
        if ($model->isNewRecord != '1' and $model->image != '') {
            ?>

            <div class="control-group ">

                <div class="">
                    <?php
                    echo "<p id='image-cont'>" . Chtml::image(Yii::app()->baseUrl . '/media/categoryslider/' . $model->image, '', array('width' => 200)) . "</p>";
                    echo CHtml::ajaxLink(
                            'Delete Image', array('/admin/CategorySlider/deleteimage/id/' . $model->id), array(
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
<p style="color:red">you can write link or select product. </p>

<?php echo $form->textFieldRow($model, 'link', array('class' => 'span5', 'maxlength' => 255)); ?>

<p><?php  echo $form->dropDownListRow($model, 'product_id',CHtml::listData(Product::model()->findAll(array('condition'=>'category_id='.$model->category_id)), 'id', 'title'),array('prompt'=>'select product'));?></p>

<?php //echo $form->textFieldRow($model, 'product_id', array('class' => 'span5')); ?>


<?php //echo $form->textFieldRow($model, 'sort', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php //echo $form->textFieldRow($model, 'temp2', array('class' => 'span5', 'maxlength' => 255)); ?>

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
