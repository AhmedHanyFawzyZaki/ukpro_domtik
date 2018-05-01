<?php
$this->breadcrumbs=array(
	'Fee Packages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FeePackage','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create FeePackage';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>