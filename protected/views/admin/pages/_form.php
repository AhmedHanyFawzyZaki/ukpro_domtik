<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'pages-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 255)); ?>


<p><?php echo $form->dropDownListRow($model, 'page_cat', CHtml::listData(PageCat::model()->findAll(), 'id', 'title'), array('prompt' => 'select Page Category', 'class' => 'listtxt')); ?></p>


<?php //echo $form->textAreaRow($model,'intro',array('rows'=>6, 'cols'=>50, 'class'=>'span8'));  ?>


<div class="control-group ">
    <label class="control-label" for="Pages_intro">Details</label>
    <div class="controls">
        <?php
        $this->widget('application.extensions.floara.Floara', array(
            'model' => $model,
            'attribute' => 'details',
        ));
        ?> 
    </div>
</div>





<?php
echo $form->fileFieldRow($model, 'image', array('class' => 'span5', 'maxlength' => 255));


if ($model->isNewRecord != '1' and $model->image != '') {
    ?>
    <div class="control-group ">
        <label class="control-label" for="Pages_intro">Image</label>
        <div class="controls">
            <p id='image-cont'> <?php echo Chtml::image(Yii::app()->baseUrl . '/media/' . $model->image, 'image', array('width' => 200)); ?></p>
            <?php
            echo CHtml::ajaxLink(
                    'Delete Image', array('/admin/pages/deleteimage/id/' . $model->id), array(
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
<?php echo $form->fileFieldRow($model, 'video', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php
if ($model->isNewRecord != '1' and $model->video != '') {
    $path = Yii::app()->getBaseUrl(true) . '/media/videos/' . $model->video;
    // echo $path;die;
    $this->widget('ext.Yiippod.Yiippod', array(
        'video' => $path,
        'id' => 'yiippodplayer',
        'width' => 501,
        'height' => 400,
        'bgcolor' => '#000'
    ));
}
?>





<?php // echo $form->textFieldRow($model,'meta_author',array('class'=>'span5'));  ?>

<?php //echo $form->textAreaRow($model,'meta_keywords',array('rows'=>6, 'cols'=>50, 'class'=>'span8'));  ?>

<?php //echo $form->textAreaRow($model,'meta_desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>


<?php echo $form->checkboxRow($model, 'publish'); ?>

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
