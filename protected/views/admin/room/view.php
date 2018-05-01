<?php
$this->breadcrumbs=array(
	'Rooms'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Room','url'=>array('index')),
	array('label'=>'Create Room','url'=>array('create')),
	array('label'=>'Update Room','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Room','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Room #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
            
 array(
                'name' => 'product_id',
                'value' => $model->product->title,
                'type' => 'raw',
            ),

		'room_options',
		'bed_options',
		'adult_price',
		'children_price',
		'infant_price',
//		'temp1',
//		'temp2',
//		'sort',
	),
)); ?>
