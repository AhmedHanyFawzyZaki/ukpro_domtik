<?php
$this->breadcrumbs=array(
	'Product Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductCategory','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create ProductCategory';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>