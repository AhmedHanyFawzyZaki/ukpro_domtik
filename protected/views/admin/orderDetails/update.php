<?php
$this->breadcrumbs=array(
	'Order Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderDetails','url'=>array('index')),
	array('label'=>'Create OrderDetails','url'=>array('create')),
	array('label'=>'View OrderDetails','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update OrderDetails #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>