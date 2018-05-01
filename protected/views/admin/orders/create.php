<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Orders','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Orders';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>