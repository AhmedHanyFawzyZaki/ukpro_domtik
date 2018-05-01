<?php
$this->breadcrumbs=array(
	'Events'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Event','url'=>array('index')),
        array('label'=>'Calendar','url'=>array('calendar')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Event';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>