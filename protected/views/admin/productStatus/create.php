<?php
$this->breadcrumbs=array(
	'Product Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductStatus','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create ProductStatus';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>