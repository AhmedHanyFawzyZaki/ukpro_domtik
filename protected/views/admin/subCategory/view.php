<?php
$this->breadcrumbs=array(
	'Sub Categories'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SubCategory','url'=>array('index')),
	array('label'=>'Create SubCategory','url'=>array('create')),
	array('label'=>'Update SubCategory','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete SubCategory','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
            


 array(
                'name' => 'product_category_id',
                'value' => $model->productCategory->title,
                'type' => 'raw',
            ),

		'title',
		//'sort',
//		'temp1',
//		'temp2',
	),
)); ?>
