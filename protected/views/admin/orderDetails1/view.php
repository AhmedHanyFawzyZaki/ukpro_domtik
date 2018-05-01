<?php
$this->breadcrumbs=array(
	'Order Details'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OrderDetails','url'=>array('index')),
	array('label'=>'Create OrderDetails','url'=>array('create')),
	array('label'=>'Update OrderDetails','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete OrderDetails','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View OrderDetails #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'order_id',
		'product_id',
		'shipping_address',
		'shipping_city',
		'shipping_country',
		'shipping_postcode',
		'shipping_price',
		'total_price',
		'net_price',
		'quantity',
		'color',
		'size',
		'commission_price',
	),
)); ?>
