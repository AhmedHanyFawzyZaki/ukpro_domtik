<?php
$this->breadcrumbs=array(
	'Product Sizes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductSizes','url'=>array('index')),
	array('label'=>'Create ProductSizes','url'=>array('create')),
	array('label'=>'Update ProductSizes','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ProductSizes','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View ProductSizes #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'product_id',
		'sizes_id',
		'sort',
		'temp1',
		'temp2',
	),
)); ?>
