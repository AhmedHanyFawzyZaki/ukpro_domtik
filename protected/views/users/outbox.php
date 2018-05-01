<?php $user=User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
?>
<div class="row profile">

<div class="col-md-12">
<ol class="breadcrumb">
      <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/dashboard">Dashboard</a></li>

      <li class="active">Messages</li>
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


<div class="col-md-9 col-sm-8 col-xs-12 message-table">
<div class="table-responsive">
<table class="table">

<colgroup>
        <col class="col-xs-7">
        <col class="col-xs-2">
        <col class="col-xs-2">
        <col class="col-xs-1">
      
    
      </colgroup>

      <thead>
        <tr>
          <th class="subject">subject</th>
          <th>To</th>
          <th>date</th>
          <th class="last">delete</th>
          
        </tr>
      </thead>
      <tbody>
       

        <?php foreach( $messages as $message){
            
 $to=User::model()->findByAttributes(array('id'=> $message->reciever_id));

            
            ?>
        <tr>
          <td class="subject"><a href="<?php  echo Yii::app()->request->baseUrl;?>/users/messageDetails/id/<?php echo $message->id; ?>"><?php  echo $message->details;?> </a></td>
          <td><?php echo $to->username; ?></td>
          <td><?php  echo $message->message_date;?></td>
          <td class="last"><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/deletemessage" onclick="return confirm('Do you want delete this message : <?=$message->id?>?')"><i class="fa fa-trash-o"></i></a></td>
          
          
          
        </tr>
        <?php } ?>
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

