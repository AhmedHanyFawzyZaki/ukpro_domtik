<?php
$this->breadcrumbs=array(
	'Product Statuses'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductStatus','url'=>array('index')),
	array('label'=>'Create ProductStatus','url'=>array('create')),
	array('label'=>'View ProductStatus','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>