<?php
$this->breadcrumbs=array(
	'Product Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductDetails','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create ProductDetails';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>