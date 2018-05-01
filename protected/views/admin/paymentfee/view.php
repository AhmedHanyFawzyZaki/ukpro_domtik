<?php
$this->breadcrumbs=array(
	'Paymentfees'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Paymentfee','url'=>array('index')),
	array('label'=>'Create Paymentfee','url'=>array('create')),
	array('label'=>'Update Paymentfee','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Paymentfee','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Paymentfee #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'fee_package_id',
		'token',
		'price',
		'date',
		'payment_status',
		'buyer_id',
	),
)); ?>
