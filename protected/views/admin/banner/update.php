<?php
$this->breadcrumbs=array(
	'Banners'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Banner','url'=>array('index')),
	array('label'=>'Create Banner','url'=>array('create')),
	array('label'=>'View Banner','url'=>array('view','id'=>$model->id)),
);
?>


<?php $this->pageTitlecrumbs = 'Update Banner "'. $model->title.' "'; ?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>