<?php
$this->breadcrumbs=array(
	'Colors'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Color','url'=>array('index')),
	array('label'=>'Create Color','url'=>array('create')),
	array('label'=>'Update Color','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Color','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
            
            
 array(
                'name' => 'product_id',
                'value' => $model->product->title,
                'type' => 'raw',
            ),

            
		//'sort',
//		'temp1',
//		'temp2',
	),
)); ?>
