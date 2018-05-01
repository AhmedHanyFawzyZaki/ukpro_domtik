<?php
$this->breadcrumbs=array(
	'Motor Models'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MotorModel','url'=>array('index')),
	array('label'=>'Create MotorModel','url'=>array('create')),
	array('label'=>'View MotorModel','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>