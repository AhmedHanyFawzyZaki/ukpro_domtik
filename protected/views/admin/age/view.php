<?php
$this->breadcrumbs=array(
	'Ages'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Age','url'=>array('index')),
	array('label'=>'Create Age','url'=>array('create')),
	array('label'=>'Update Age','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Age','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
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
