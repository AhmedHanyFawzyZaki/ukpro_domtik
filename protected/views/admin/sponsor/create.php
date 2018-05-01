<?php
$this->breadcrumbs=array(
	'Sponsors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Sponsor','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Sponsor';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>