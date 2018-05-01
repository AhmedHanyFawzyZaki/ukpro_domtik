<?php
$this->breadcrumbs=array(
	'Rooms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Room','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Room';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>