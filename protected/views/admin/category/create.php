<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Category','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Category';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>