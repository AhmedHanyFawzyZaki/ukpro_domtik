<?php
$this->breadcrumbs=array(
	'Cities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List City','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create City';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>