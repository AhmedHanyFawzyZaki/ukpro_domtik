<?php
$this->breadcrumbs=array(
	'Tests'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Test','url'=>array('index')),
	array('label'=>'Create Test','url'=>array('create')),
	array('label'=>'View Test','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update Test #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>