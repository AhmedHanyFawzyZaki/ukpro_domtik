<?php
$this->breadcrumbs=array(
	'Galleries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Gallery','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Gallery';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>