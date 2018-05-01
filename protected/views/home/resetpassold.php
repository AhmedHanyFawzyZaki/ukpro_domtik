<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->pageTitle=Yii::app()->name . ' - Login';
?>
<div class="content">
    <div class="emak-academy">
        <?php
        if(Yii::app()->user->hasFlash('ErrorMsg') )
        {
        ?>
        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('ErrorMsg'); ?>.
        </div>
        <?php
        }
        ?>
        <div class="log-in-section" style="min-height:350px">
            <?php if($flag==1){?>
                <h2>Reset Password</h2>
                <div class="form logform">
                    
                    <p>Enter your  new password. </p>
                    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id'=>'user-form',
                        'enableClientValidation'=>true,
                         'type' => 'horizontal',
                        'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                        ),
                    )); ?>
                        <?php echo $form->passwordFieldRow($model, 'newpassword', array('class'=>'span6')); ?>

                        <?php echo $form->passwordFieldRow($model, 'newpassword_repeat', array('class'=>'span6')); ?>
                        <div class="buttons">
                            <?php echo CHtml::submitButton('Reset' ,array('class'=>'btn btn-large btn-danger')); ?>
                        </div>
                        <span class="required">&nbsp;</span>
                    <?php $this->endWidget(); ?>

                    <div class="clear"></div>
                </div><!-- form -->
            <?php
            }
            ?>
        </div>
    </div>
</div>
</div>
</div>