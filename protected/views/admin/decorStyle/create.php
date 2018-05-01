<?php
$this->breadcrumbs=array(
	'Decor Styles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DecorStyle','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create DecorStyle';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>