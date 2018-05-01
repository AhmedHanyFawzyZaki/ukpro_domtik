<?php
$this->breadcrumbs=array(
	'Colors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Colors','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Colors';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>