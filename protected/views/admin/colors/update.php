<?php
$this->breadcrumbs=array(
	'Colors'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Colors','url'=>array('index')),
	array('label'=>'Create Colors','url'=>array('create')),
	array('label'=>'View Colors','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>