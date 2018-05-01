<?php
$this->breadcrumbs=array(
	'Product Colors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductColor','url'=>array('index')),
	array('label'=>'Create ProductColor','url'=>array('create')),
	array('label'=>'View ProductColor','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update ProductColor #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>