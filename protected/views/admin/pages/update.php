<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pages','url'=>array('index')),
	
	array('label'=>'View Pages','url'=>array('view','id'=>$model->id)),
);
?>
<?php $this->pageTitlecrumbs = 'Update Pages "'. $model->title.' "'; ?>


<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>