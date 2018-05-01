<?php
$this->breadcrumbs=array(
	'Sizes'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Size','url'=>array('index')),
	array('label'=>'Create Size','url'=>array('create')),
	array('label'=>'View Size','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update Size #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>