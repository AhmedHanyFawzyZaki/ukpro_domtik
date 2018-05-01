<?php $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id)); ?>
<div class="row profile">

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/dashboard">Dashboard</a></li>
            <li class="active">All Shipping</li>
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

    <div class="col-md-9 col-sm-8 col-xs-12 order-table">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Shipping no.</th>
                        <th>Country</th>
<!--                        <th>City</th>-->
                        <th>Value</th>
                        <th>edit</th>
                        <th>delete</th>
                    </tr>
                </thead>
                <tbody>


                    <?php 
                    $i=1;
                    foreach ($models as $model) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $model->shippingcountry->title; ?></td>
<!--                            <td><?php echo $model->shippingcity->title; ?></td>         -->
                            <td><?php echo $model->title; ?> GBP</td>
                            <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/editShippingvalue/id/<?php echo $model->id; ?>"><i class="fa fa-pencil"></i></a></td>
                            <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/deleteshipping/id/<?php echo $model->id; ?>" onclick="return confirm('Do you want delete this Shipping : <?= $model->id ?>?')"><i class="fa fa-trash-o"></i></a></td>



                        </tr>

                    <?php $i++;} ?>
                </tbody>
            </table>
        </div>
    </div>

</div>



<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->


<?php $this->endWidget(); ?>




</div>
</div>

