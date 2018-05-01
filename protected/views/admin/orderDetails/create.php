<?php
$this->breadcrumbs=array(
	'Order Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrderDetails','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create OrderDetails';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>