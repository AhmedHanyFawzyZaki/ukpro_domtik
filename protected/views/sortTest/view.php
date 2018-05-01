<?php
$this->breadcrumbs=array(
	'Sort Tests'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SortTest','url'=>array('index')),
	array('label'=>'Create SortTest','url'=>array('create')),
	array('label'=>'Update SortTest','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete SortTest','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View SortTest #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'sort',
		'title',
		'desc',
	),
)); ?>
