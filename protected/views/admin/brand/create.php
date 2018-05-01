<?php
$this->breadcrumbs=array(
	'Brands'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Brand','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Brand';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>