<?php
$this->breadcrumbs=array(
	'Countries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Country','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Country';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>