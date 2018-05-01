<?php
$this->breadcrumbs=array(
	'Ages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Age','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Age';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>