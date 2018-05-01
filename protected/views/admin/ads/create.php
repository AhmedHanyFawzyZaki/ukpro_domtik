<?php
$this->breadcrumbs=array(
	'Ads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ads','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Ads';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>