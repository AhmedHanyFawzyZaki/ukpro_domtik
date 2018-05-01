<?php
$this->breadcrumbs=array(
	'Commissions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Commission','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Commission';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>