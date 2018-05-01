<?php
$this->breadcrumbs=array(
	'Order Statuses'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Order Status','url'=>array('index')),
	array('label'=>'Create Order Status','url'=>array('create')),
	array('label'=>'View Order Status','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update  '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>