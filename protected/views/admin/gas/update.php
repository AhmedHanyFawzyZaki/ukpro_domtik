<?php
$this->breadcrumbs=array(
	'Gases'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Gas','url'=>array('index')),
	array('label'=>'Create Gas','url'=>array('create')),
	array('label'=>'View Gas','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
