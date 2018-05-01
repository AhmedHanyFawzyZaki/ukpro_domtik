<?php
$this->breadcrumbs=array(
	'Sizes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Sizes','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Sizes';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>