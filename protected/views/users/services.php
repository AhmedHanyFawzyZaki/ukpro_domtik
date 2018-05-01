<?php $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
?>
<div class="row profile">


    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/dashboard">Dashboard</a></li>
            <li class="active">edit profile</li>
        </ol>

    </div>

    <!--appear-->
    <?php $this->renderpartial('../home/menu', array('user' => $user)); ?>
    <!--end appear-->




    <div class="col-md-9 col-sm-8 col-xs-12">

        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'user-register-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => 'form-horizontal',
            ),
        ));

        if (Yii::app()->user->hasFlash('update-success')) {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo Yii::app()->user->getFlash('update-success'); ?>.
            </div>

            <?php
        } elseif (Yii::app()->user->hasFlash('update-error')) {
            ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('update-error'); ?>.
                <?php echo Yii::app()->user->getFlash('Passchange'); ?>.
            </div>
        <?php } ?>
        <div class="info seller-profile">
            <p class="profile-name"><?php echo $user->username; ?></p>



            <form method="post" action="#" id="user-register-form" class="form-horizontal form-vertical">                                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-4 control-label">Fee Packages</label>

                    <div class="col-sm-8 package">

                        <?php echo $form->radioButtonList($model, 'fee_package_id', FeePackage::model()->packageList($model->fee_package_id), array('class' => '')); ?>
                        <?php echo $form->error($model, 'fee_package_id'); ?>                                                                  
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <?php echo CHtml::submitButton('Upgrade your package', array('class' => 'btn btn-default register-bt')); ?>
                    </div>
                </div>
            </form>



            <?php $this->endWidget(); ?>


        </div>


    </div><!--end info-->
</div>

<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->



</div>
</div>

