<?php
$this->breadcrumbs=array(
	'Sizes'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Sizes','url'=>array('index')),
	array('label'=>'Create Sizes','url'=>array('create')),
	array('label'=>'Update Sizes','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Sizes','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
	
 array(
                'name' => 'category_id',
                'value' => $model->cat->title,
                'type' => 'raw',
            ),	
            'title',
		//'sort',
		'description',
		//'temp2',
	),
)); ?>
