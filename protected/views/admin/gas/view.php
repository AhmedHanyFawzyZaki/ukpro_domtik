<?php
$this->breadcrumbs=array(
	'Gases'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Gas','url'=>array('index')),
	array('label'=>'Create Gas','url'=>array('create')),
	array('label'=>'Update Gas','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Gas','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
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
