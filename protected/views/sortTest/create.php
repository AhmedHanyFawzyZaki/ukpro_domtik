<?php
$this->breadcrumbs=array(
	'Sort Tests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SortTest','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create SortTest';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>