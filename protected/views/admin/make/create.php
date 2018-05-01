<?php
$this->breadcrumbs=array(
	'Makes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Make','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Make';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>