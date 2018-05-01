<?php
$this->breadcrumbs=array(
	'Colors'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Colors','url'=>array('index')),
	array('label'=>'Create Colors','url'=>array('create')),
	array('label'=>'Update Colors','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Colors','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		//'color',
            array(
			'name'=>'color',
			 'type'=>'raw',
			  'value'=>Helper::displayColor($model->color),

			),
//		'sort',
//		'temp1',
	),
)); ?>
