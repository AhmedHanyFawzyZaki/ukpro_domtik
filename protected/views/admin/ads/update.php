<?php
$this->breadcrumbs=array(
	'Ads'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ads','url'=>array('index')),
	array('label'=>'Create Ads','url'=>array('create')),
	array('label'=>'View Ads','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update Ads #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>