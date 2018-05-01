<?php
$this->breadcrumbs=array(
	'Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Message','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Message';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>