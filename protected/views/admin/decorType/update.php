<?php
$this->breadcrumbs=array(
	'Decor Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DecorType','url'=>array('index')),
	array('label'=>'Create DecorType','url'=>array('create')),
	array('label'=>'View DecorType','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>