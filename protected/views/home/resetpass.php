<?php
$this->pageTitle = Yii::app()->name . ' - Reset Password';
$this->breadcrumbs = array(
    'Reset Password',
);
?>
<div class="row">

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a></li>
            <li class="active">Reset Password</li>
        </ol>

    </div>



    <div class="col-md-12 col-xs-12">
        <div class="col-md-12 col-xs-12 contact">
            <?php  
            if (Yii::app()->user->hasFlash('ErrorMsg')) {
                            ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo Yii::app()->user->getFlash('ErrorMsg'); ?>
                            </div>
                            <?php
                        }
            ?>
            <?php if($flag==1){?>
            <p class="title">Reset Password</p>

            <div class="col-md-7 col-xs-12">
                <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'user-form',
                        'enableAjaxValidation' => true,
                        'htmlOptions' => array('enctype' => 'multipart/form-data',
                        'class' => 'form-horizontal',
                        ),
                    ));
                        ?>
               
                <div class="form-group">
                            <?php echo $form->textField($model, 'newpassword', array('class' => 'form-control', 'id' => 'password','type'=>'password','Placeholder' => 'New Password','title' => 'Please fill out this field with your new password.', 'required' => 'required')); ?>
                            <?php echo $form->error($model, 'newpassword'); ?>
                    </div>
                
                 <div class="form-group">
                            <?php echo $form->textField($model, 'newpassword_repeat', array('class' => 'form-control', 'id' => 'password','type'=>'password','Placeholder' => 'Repeat New Password','title' => 'Please repeat your new password exactly.', 'required' => 'required')); ?>
                            <?php echo $form->error($model, 'newpassword_repeat'); ?>
                    </div>

                    <?php echo CHtml::submitButton('Reset', array('class' => 'btn btn-default register-bt')); ?>
                <?php $this->endWidget(); ?>

            </div>

            <div class="col-md-5 col-xs-12 cont-msg">

                <p>please enter your new password and repeat it exactly to reset your password.</p>

            </div>
            <?php }?>

        </div><!--end contact-->

    </div>

</div>



<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->



</div>
</div>
