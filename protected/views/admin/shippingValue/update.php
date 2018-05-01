<?php
$this->breadcrumbs=array(
	'Shipping Values'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ShippingValue','url'=>array('index')),
	array('label'=>'Create ShippingValue','url'=>array('create')),
	array('label'=>'View ShippingValue','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>