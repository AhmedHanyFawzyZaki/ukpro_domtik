<?php
$this->breadcrumbs=array(
	'Newsletters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Newsletter','url'=>array('index')),
	array('label'=>'Manage Newsletter','url'=>array('admin')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Newsletter'; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>