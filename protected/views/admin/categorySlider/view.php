<?php
$this->breadcrumbs=array(
	'Category Sliders'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List CategorySlider','url'=>array('index')),
	//array('label'=>'Create CategorySlider','url'=>array('create')),
	array('label'=>'Update CategorySlider','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CategorySlider','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View CategorySlider #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'category_id',
		'image',
		'title',
		//'description',
		'product_id',
		'link',
		//'sort',
		//'temp2',
	),
)); ?>
