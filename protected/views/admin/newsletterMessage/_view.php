<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('users_id')); ?>:</b>
	<?php echo CHtml::encode($data->users_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_sent')); ?>:</b>
	<?php echo CHtml::encode($data->date_sent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_flag')); ?>:</b>
	<?php echo CHtml::encode($data->start_flag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_flag')); ?>:</b>
	<?php echo CHtml::encode($data->end_flag); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('temp1')); ?>:</b>
	<?php echo CHtml::encode($data->temp1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temp2')); ?>:</b>
	<?php echo CHtml::encode($data->temp2); ?>
	<br />

	*/ ?>

</div>