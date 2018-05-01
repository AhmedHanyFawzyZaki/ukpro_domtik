<?php
$this->breadcrumbs=array(
	'Decor Styles'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DecorStyle','url'=>array('index')),
	array('label'=>'Create DecorStyle','url'=>array('create')),
	array('label'=>'View DecorStyle','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>