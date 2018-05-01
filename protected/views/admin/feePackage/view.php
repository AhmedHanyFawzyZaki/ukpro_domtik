<?php
$this->breadcrumbs=array(
	'Fee Packages'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List FeePackage','url'=>array('index')),
	array('label'=>'Create FeePackage','url'=>array('create')),
	array('label'=>'Update FeePackage','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete FeePackage','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'monthly_fee',
                 'ads_number',
                'period',
		//'sort',
	),
)); ?>
