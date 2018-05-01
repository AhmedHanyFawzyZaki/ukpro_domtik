<?php
$this->breadcrumbs=array(
	'Product Categories'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ProductCategory','url'=>array('index')),
	array('label'=>'Create ProductCategory','url'=>array('create')),
	array('label'=>'Update ProductCategory','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ProductCategory','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
            
 array(
                'name' => 'category_id',
                'value' => $model->category->title,
                'type' => 'raw',
            ),

		'title',
		'description',
		//'sort',
//		'temp1',
//		'temp2',
	),
)); ?>
