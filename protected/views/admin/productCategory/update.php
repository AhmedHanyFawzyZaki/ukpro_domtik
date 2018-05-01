<?php
$this->breadcrumbs=array(
	'Product Categories'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductCategory','url'=>array('index')),
	array('label'=>'Create ProductCategory','url'=>array('create')),
	array('label'=>'View ProductCategory','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>