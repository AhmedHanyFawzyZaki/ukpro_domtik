<?php
$this->breadcrumbs=array(
	'Shipping Values'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ShippingValue','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create ShippingValue';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>