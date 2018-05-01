<?php
$this->breadcrumbs=array(
	'Decor Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DecorType','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create DecorType';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>