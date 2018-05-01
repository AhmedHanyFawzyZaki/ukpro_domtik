<?php
$this->breadcrumbs=array(
	'Sub Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SubCategory','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create SubCategory';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>