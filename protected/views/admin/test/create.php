<?php
$this->breadcrumbs=array(
	'Tests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Test','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Test';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>