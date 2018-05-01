<?php
$this->breadcrumbs=array(
	'Favourites'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Favourite','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Favourite';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>