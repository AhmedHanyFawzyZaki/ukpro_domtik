<?php
$this->breadcrumbs=array(
	'Countries'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Country','url'=>array('index')),
	array('label'=>'Create Country','url'=>array('create')),
	array('label'=>'Update Country','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Country','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'country_code',
		'title',
		//'cost_country',
		//'sort',
	),
)); ?>
