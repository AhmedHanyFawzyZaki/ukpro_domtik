<?php
$this->breadcrumbs=array(
	'Product Sizes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductSizes','url'=>array('index')),
	array('label'=>'Create ProductSizes','url'=>array('create')),
	array('label'=>'View ProductSizes','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update ProductSizes #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>