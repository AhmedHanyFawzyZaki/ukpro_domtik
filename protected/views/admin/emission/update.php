<?php
$this->breadcrumbs=array(
	'Emissions'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Emission','url'=>array('index')),
	array('label'=>'Create Emission','url'=>array('create')),
	array('label'=>'View Emission','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>