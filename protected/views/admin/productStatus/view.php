<?php
$this->breadcrumbs=array(
	'Product Statuses'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ProductStatus','url'=>array('index')),
	array('label'=>'Create ProductStatus','url'=>array('create')),
	array('label'=>'Update ProductStatus','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ProductStatus','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		//'sort',
	),
)); ?>
