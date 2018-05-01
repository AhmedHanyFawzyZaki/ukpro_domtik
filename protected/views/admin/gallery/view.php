<?php
$this->breadcrumbs=array(
	'Galleries'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Gallery','url'=>array('index')),
	array('label'=>'Create Gallery','url'=>array('create')),
	array('label'=>'Update Gallery','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Gallery','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Gallery #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'versions_data',
		'name',
		'description',
	),
)); ?>
