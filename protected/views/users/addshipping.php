<?php $user=User::model()->findByAttributes(array('id'=>Yii::app()->user->id));

?>
<div class="row profile">

<div class="col-md-12">
<ol class="breadcrumb">
      <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/dashboard">Dashboard</a></li>
      <li class="active">Add Shipping</li>
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
<p class="profile-name">Add shipping value</p>




        <div class="form-group" >
        <div class="control-group">
            <label for="country_id" class="col-md-3 col-sm-5 col-xs-12 control-label">Country</label>
            <div class="col-md-6 col-sm-7 col-xs-12">

                <?php
                echo $form->dropDownList($model, 'country_id', CHtml::listData(Country::model()->findAll(), 'id', 'title'), array(
                    'prompt' => 'Select Country',
                    'class'=>'form-control',
                    )
                );
                ?>
                 <?php echo $form->error($model, 'country_id'); ?>
            </div> 
        </div>
        </div>



<!--        <div class="form-group" >
        <div class="control-group">
            <label class="col-md-3 col-sm-5 col-xs-12 control-label"> City</label>
            <div class="col-md-6 col-sm-7 col-xs-12"  id="model">
                <?php
//                if ($model->isNewRecord)
//                    echo 
//                    'Select Country First';
//                else {
//                    echo $form->dropDownList($model, 'city_id', CHtml::listData(City::model()->findAll(array('condition' => "country_id=$model->country_id")), 'id', 'title'), array('prompt' => 'Select City','class'=>'form-control'));
//                }
//                ?>
                //<?php echo $form->error($model, 'city_id'); ?>
            </div>
        </div>
        </div>-->
      
      <div class="form-group">
        <label class="col-md-3 col-sm-5 col-xs-12 control-label" for="inputEmail3">Shipping Value (GBP):</label>
        <div class="col-md-6 col-sm-7 col-xs-12">
         <?php echo $form->textField($model, 'title', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
         <?php echo $form->error($model, 'title'); ?>
        </div>
      </div>
      
    
      <div class="form-group">
        <div class="col-md-offset-3 col-md-6 col-sm-9 col-sm-offset-3 col-xs-12 col-xs-offset-0">
                  <?php echo CHtml::submitButton('submit', array('class' => 'btn btn-default register-bt')); ?>

        </div>
      </div>
 
    

    
    
</div><!--end info-->
</div>

</div>



<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->

<?php $this->endWidget(); ?>

</div>
</div>

