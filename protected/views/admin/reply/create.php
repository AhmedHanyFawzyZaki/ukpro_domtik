<?php
$this->breadcrumbs=array(
	'Replies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Reply','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Reply';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>