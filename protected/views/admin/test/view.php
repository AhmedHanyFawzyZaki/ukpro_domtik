<?php
$this->breadcrumbs=array(
	'Tests'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Test','url'=>array('index')),
	array('label'=>'Create Test','url'=>array('create')),
	array('label'=>'Update Test','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Test','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Test #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'drang',
		'dtime',
	),
)); ?>
