<?php
$this->breadcrumbs=array(
	'Colors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Color','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Color';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>