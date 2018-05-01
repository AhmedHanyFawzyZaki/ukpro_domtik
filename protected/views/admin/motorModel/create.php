<?php
$this->breadcrumbs=array(
	'Motor Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MotorModel','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create MotorModel';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>