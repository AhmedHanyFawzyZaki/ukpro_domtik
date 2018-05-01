<?php
$this->breadcrumbs=array(
	'Kmages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Kmage','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Kmage';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>