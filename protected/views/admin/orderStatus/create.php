<?php
$this->breadcrumbs=array(
	'Order Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrderStatus','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create OrderStatus';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>