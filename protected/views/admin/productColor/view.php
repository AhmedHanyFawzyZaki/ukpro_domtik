<?php
$this->breadcrumbs=array(
	'Product Colors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductColor','url'=>array('index')),
	array('label'=>'Create ProductColor','url'=>array('create')),
	array('label'=>'Update ProductColor','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ProductColor','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View ProductColor #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'product_id',
		'colors_id',
		//'sort',
	),
)); ?>
