<?php
$this->breadcrumbs=array(
	'Sizes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Size','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Size';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>