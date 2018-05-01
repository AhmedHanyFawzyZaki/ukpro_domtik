<?php
$this->breadcrumbs=array(
	'Engines'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Engine','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Engine';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>