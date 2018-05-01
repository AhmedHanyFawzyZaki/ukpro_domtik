<?php
$this->breadcrumbs=array(
	'Doors'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Door','url'=>array('index')),
	array('label'=>'Create Door','url'=>array('create')),
	array('label'=>'View Door','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>