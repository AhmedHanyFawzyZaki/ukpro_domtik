<?php
$this->breadcrumbs=array(
	'Makes'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Make','url'=>array('index')),
	array('label'=>'Create Make','url'=>array('create')),
	array('label'=>'Update Make','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Make','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		//'sort',
//		'temp1',
//		'temp2',
	),
)); ?>
