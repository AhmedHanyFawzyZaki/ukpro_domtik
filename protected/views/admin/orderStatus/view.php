<?php
$this->breadcrumbs=array(
	'Order Status'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Order Status','url'=>array('index')),
	array('label'=>'Create Order Status','url'=>array('create')),
	array('label'=>'Update Order Status','url'=>array('update','id'=>$model->id)),
	//array('label'=>'Delete Order Status','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View  '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		//'sort',
	),
)); ?>
