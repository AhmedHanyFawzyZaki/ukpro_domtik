<?php
$this->breadcrumbs=array(
	'Doors'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Door','url'=>array('index')),
	array('label'=>'Create Door','url'=>array('create')),
	array('label'=>'Update Door','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Door','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
//		'sort',
//		'temp1',
//		'temp2',
	),
)); ?>
