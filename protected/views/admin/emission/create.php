<?php
$this->breadcrumbs=array(
	'Emissions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Emission','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Emission';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>