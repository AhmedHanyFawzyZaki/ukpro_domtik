<?php
$this->breadcrumbs=array(
	'Kmages'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Kmage','url'=>array('index')),
	array('label'=>'Create Kmage','url'=>array('create')),
	array('label'=>'View Kmage','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>