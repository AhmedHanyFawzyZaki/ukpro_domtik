<?php
$this->breadcrumbs=array(
	'Makes'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Make','url'=>array('index')),
	array('label'=>'Create Make','url'=>array('create')),
	array('label'=>'View Make','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update title'. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>