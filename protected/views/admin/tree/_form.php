<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'tree-form',
    'type'=>'horizontal',
    'action' => Yii::app()->request->requestUri,
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>

<blockquote class="margin-top-20">
    <p class="help-block">Fields with <span class="required">*</span> are required.</p>
</blockquote>

<?php echo $form->errorSummary($model); ?>

<?php //echo $form->textFieldRow($model,'type',array('class'=>'span5','maxlength'=>8)); ?>

<?php echo $form->textFieldRow($model, 'name', array('class' => 'form-control', 'maxlength' => 255)); ?>


<?php //echo $form->textFieldRow($model,'slug',array('class'=>'span5','maxlength'=>255)); ?>


<?php echo $form->textAreaRow($model, 'description', array('rows' => 2, 'cols' => 50, 'class' => 'form-control')); ?>


<?php echo $form->textFieldRow($model, 'link', array('class' => 'form-control', 'maxlength' => 255)); ?>

<?php //echo $form->textFieldRow($model,'icon',array('class'=>'span5','maxlength'=>255)); ?>

<?php //echo $form->textFieldRow($model,'level',array('class'=>'span5','maxlength'=>10)); ?>

<?php //echo $form->textFieldRow($model,'position',array('class'=>'span5','maxlength'=>10)); ?>

<?php //echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

<?php //echo $form->textFieldRow($model,'updated',array('class'=>'span5')); ?>

<?php //echo $form->textFieldRow($model,'parent_id',array('class'=>'span5','maxlength'=>10));  ?>

<!--<div class="form-actions">
    <?php
//    $this->widget('bootstrap.widgets.TbButton', array(
//        'buttonType' => 'submit',
//        'type' => 'primary',
//        'label' => $model->isNewRecord ? 'Create' : 'Save',
//    ));
    ?>
</div>-->

<div class="form-actions">
    <?php
    if (Yii::app()->request->isAjaxRequest) {
        echo CHtml::button(
                'Save', 
                array(
                    'onclick' => 'return window.oMain.ajaxSubmitForm($("#tree-form"));',
                    'class'=>'btn btn-primary',
                )
            );
    } else {
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        ));
    }
    ?>
</div>


<?php $this->endWidget(); ?>
