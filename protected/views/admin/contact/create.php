<?php
$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Contact','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Contact';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>