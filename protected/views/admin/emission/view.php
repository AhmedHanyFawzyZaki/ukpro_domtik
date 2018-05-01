<?php
$this->breadcrumbs=array(
	'Emissions'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Emission','url'=>array('index')),
	array('label'=>'Create Emission','url'=>array('create')),
	array('label'=>'Update Emission','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Emission','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View title'. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
//		'sort',
//		'temp1',
//		'temp2',
	),
)); ?>
