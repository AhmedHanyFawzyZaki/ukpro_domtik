<?php
$this->breadcrumbs=array(
	'Product Sizes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductSizes','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create ProductSizes';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>