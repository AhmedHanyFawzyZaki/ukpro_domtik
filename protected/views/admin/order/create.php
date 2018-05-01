<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Order','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Order';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>