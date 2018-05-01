<?php
$this->breadcrumbs=array(
	'Engines'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Engine','url'=>array('index')),
	array('label'=>'Create Engine','url'=>array('create')),
	array('label'=>'View Engine','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>