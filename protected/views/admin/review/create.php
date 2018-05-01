<?php
$this->breadcrumbs=array(
	'Reviews'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Review','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Review';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>