<?php
$this->breadcrumbs=array(
	'Gases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Gas','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Gas';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>