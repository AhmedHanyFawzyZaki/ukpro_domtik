<?php $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id)); ?>

<div class="row profile">

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="dashboard.html">Dashboard</a></li>
            <li class="active">Messages</li>
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


    <div class="col-md-9 col-sm-8 col-xs-12">
        <div class="col-md-12 col-xs-12 message-details">





            <div class="col-md-12 col-xs-12 msg-header">
                <p class="date"><?php echo $message->message_date; ?></p>
                <div class="col-md-2 col-sm-2 col-xs-2 msg-img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/<?php echo $user->image; ?>" alt="" /></div>

                <div class="msg-info col-md-10 col-sm-9 col-xs-8">
                    <dl class="dl-horizontal">
                        <?php
                        $from = User::model()->findByAttributes(array('id' => $message->sender_id));
                        ?>
                        <dt>from:</dt>
                        <dd><?php echo $from->username; ?></dd>
                        <?php
                        $to = User::model()->findByAttributes(array('id' => $message->reciever_id));
                        ?>
                        <dt>to:</dt>
                        <dd><?php echo $to->username; ?></dd>

                        <dt>date:</dt>
                        <dd><?php echo $message->message_date; ?></dd>
                    </dl>
                </div><!--end msg-info-->
            </div><!--end msg-header-->

            <div class="col-md-12 col-xs-12 msg-content">

                <p><?php echo $message->details; ?></p>
                
                  
                        

             <?php
             if($message_replys){
                 
                 echo '<p class="date">replays:</p>'  ;
             
                foreach ($message_replys as $message_reply) {
                    ?>
                    <p><?php echo $message_reply->details; ?></p>
                    <?php
                }
                }
                ?>


                <div class="col-md-12 col-xs-12">
                    <a class="btn btn-default register-bt reply-bt collapsed" href="#reply" data-toggle="collapse"
                       data-parent="#accordion" >reply</a>
                </div>

                <div style="height: 0px;" id="reply" class="panel-collapse collapse">

                    <div class="col-md-12 col-xs-12 new-input">

                        <?php echo $form->textAreaRow($reply, 'details', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                        <?php echo CHtml::submitButton('Send ', array('class' => 'btn btn-default register-bt reply-bt')); ?>


                    </div>   
                </div>


            </div><!--end msg-content-->
        </div><!--end message-details-->
    </div>

</div>



<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->

<?php $this->endWidget(); ?>


</div>
</div>

