<?php
$this->breadcrumbs=array(
	'Rooms'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Room','url'=>array('index')),
	array('label'=>'Create Room','url'=>array('create')),
	array('label'=>'View Room','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update Room #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>