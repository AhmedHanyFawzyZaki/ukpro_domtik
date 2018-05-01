<?php
$this->breadcrumbs=array(
	'Product Colors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductColor','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create ProductColor';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>