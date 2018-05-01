<?php
$this->breadcrumbs=array(
	'Newsletters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Newsletter','url'=>array('index')),
	array('label'=>'Create Newsletter','url'=>array('create')),
	array('label'=>'View Newsletter','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Newsletter','url'=>array('admin')),
);
?>

<?php $this->pageTitlecrumbs = 'Update Newsletter "'. $model->id.' "'; ?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>