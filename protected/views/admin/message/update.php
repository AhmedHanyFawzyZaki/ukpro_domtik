<?php
$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Message','url'=>array('index')),
	array('label'=>'Create Message','url'=>array('create')),
	array('label'=>'View Message','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update Message #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>