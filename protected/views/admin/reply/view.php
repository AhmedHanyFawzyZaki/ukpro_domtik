<?php
$this->breadcrumbs=array(
	'Replies'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Reply','url'=>array('index')),
	array('label'=>'Update Reply','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Reply','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Reply #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
            
            array(
                'name' => 'message_id',
                'value' => $model->replymessage->title,
                'type' => 'raw',
            ),
 
            array(
                'name' => 'user_id',
                'value' => $model->replyuser->username,
                'type' => 'raw',
            ),

            
 
		'reply_date',
array(
            'name' => 'published',
            'value'=>($model->published==1)?  "published":"Not Published",
                ),
		'details',
		//'sort',
	),
)); ?>
