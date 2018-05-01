<?php
$this->breadcrumbs=array(
	'Sizes'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sizes','url'=>array('index')),
	array('label'=>'Create Sizes','url'=>array('create')),
	array('label'=>'View Sizes','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>