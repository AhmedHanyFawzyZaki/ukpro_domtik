<?php
$this->breadcrumbs=array(
	'Doors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Door','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Door';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>