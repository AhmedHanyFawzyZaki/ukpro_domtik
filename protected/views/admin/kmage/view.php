<?php
$this->breadcrumbs=array(
	'Kmages'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Kmage','url'=>array('index')),
	array('label'=>'Create Kmage','url'=>array('create')),
	array('label'=>'Update Kmage','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Kmage','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
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
