<?php
$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Message','url'=>array('index')),
	array('label'=>'Create Message','url'=>array('create')),
	array('label'=>'Update Message','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Message','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Message #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'sender_id',
		'reciever_id',
		'title',
		'details',
		'message_date',
		'sort',
		'published',
	),
)); ?>
