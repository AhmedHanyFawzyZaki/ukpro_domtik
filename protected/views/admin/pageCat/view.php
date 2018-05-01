<?php
$this->breadcrumbs=array(
	'Page Cats'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List PageCat','url'=>array('index')),
	array('label'=>'Create PageCat','url'=>array('create')),
	array('label'=>'Update PageCat','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete PageCat','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View'. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		//'sort',
	),
)); ?>
