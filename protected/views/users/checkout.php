<?php $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
if(empty($user))$this->redirect(array('home/confirm/flag/3'));
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

        <div class="info seller-profile">
            <p class="profile-name"><?php echo $user->username; ?></p>
            <br/>
            <?php if (Yii::app()->user->hasFlash('upgrade-success')) {
                ?>
                <div class="alert alert-success">
                    <?php echo Yii::app()->user->getFlash('upgrade-success'); ?>
                </div>
                <?php
            }
            ?>
            <?php
            if ($user->fee_package_id == 1) {
                $notification = 'To enjoy the services of the silver package you should complete the payment process';
            } elseif ($user->fee_package_id == 2) {
                $notification = 'To enjoy the services of the golden package you should complete the payment process';
            } elseif ($user->fee_package_id == 5) {
                $notification = 'To enjoy the services of the platinum package you should complete the payment process';
            }
            ?>
            <div class="alert alert-danger">
                <strong>Notification !</strong>
                <?php echo $notification; ?>
            </div>

            <div class="">
                <b>  The package that will buy it :</b> <?= $user->feepackage->title ?>
                <br/>
                <?php $total = $user->feepackage->monthly_fee; ?>
                <b> The Total price :</b> <?= $total ?>  GBP


                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/users/buy" class="btn btn-default register-bt">Go to paypal to complete the payment process</a>
                    </div>
                </div>
            </div> 

        </div> 
    </div><!--end info-->
</div>

<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->



</div>
</div>

