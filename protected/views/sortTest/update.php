<?php
$this->breadcrumbs=array(
	'Sort Tests'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SortTest','url'=>array('index')),
	array('label'=>'Create SortTest','url'=>array('create')),
	array('label'=>'View SortTest','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update SortTest #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>