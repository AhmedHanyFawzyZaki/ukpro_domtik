<?php
$this->breadcrumbs=array(
	'Category Sliders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategorySlider','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create CategorySlider';?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'id'=>$id)); ?>