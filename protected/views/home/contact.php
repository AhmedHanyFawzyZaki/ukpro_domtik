<?php
$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>
<div class="row">

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a></li>
            <li class="active">Contact us</li>
        </ol>

    </div>



    <div class="col-md-12 col-xs-12">
        <div class="col-md-12 col-xs-12 contact">
            <p class="title">contact us</p>

            <div class="col-md-7 col-xs-12">
                <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'contact-form',
                        'enableAjaxValidation' => true,
                        'htmlOptions' => array('enctype' => 'multipart/form-data',
                        'class' => 'form-horizontal',
                        ),
                    ));

                    if (Yii::app()->user->hasFlash('contact')) {
                        ?>
                        <div class="alert alert-success w">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo Yii::app()->user->getFlash('contact'); ?>.
                        </div>
                        <?php
                    }
                    
                    if (Yii::app()->user->hasFlash('success')) {
                            ?>
                            <div class="alert alert-success">
                                <?php echo Yii::app()->user->getFlash('success'); ?>
                            </div>
                            <?php
                        }
                        
                        if (Yii::app()->user->hasFlash('error')) {
                            ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo Yii::app()->user->getFlash('error'); ?>
                            </div>
                            <?php
                        }
                        ?>
                
                <div class="form-group">
                            <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'id' => 'exampleInputEmail1','placeholder'=>'Full Name')); ?>
                            <?php echo $form->error($model, 'name'); ?>
                    </div>
                
                 <div class="form-group">
                            <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'id' => 'exampleInputEmail1','placeholder'=>'E-mail')); ?>
                            <?php echo $form->error($model, 'email'); ?>
                    </div>
                
                <div class="form-group">
                            <?php echo $form->textArea($model, 'message', array('class' => 'form-control', 'rows' => '3','placeholder'=>'Message')); ?>
                            <?php echo $form->error($model, 'message'); ?>
                    </div>


                    <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-default register-bt')); ?>
                <?php $this->endWidget(); ?>

            </div>

            <div class="col-md-5 col-xs-12 cont-msg">

                <p>please fill the below forms and submit i, one of our team will respond to you as soon as possible.</p>

            </div>


        </div><!--end contact-->

    </div>

</div>



<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->



</div>
</div>