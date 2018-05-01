<?php
$this->breadcrumbs=array(
	'Sub Categories'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SubCategory','url'=>array('index')),
	array('label'=>'Create SubCategory','url'=>array('create')),
	array('label'=>'View SubCategory','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>