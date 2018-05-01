<?php
$this->breadcrumbs=array(
	'Motor Models'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List MotorModel','url'=>array('index')),
	array('label'=>'Create MotorModel','url'=>array('create')),
	array('label'=>'Update MotorModel','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete MotorModel','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
            
            
 array(
                'name' => 'make_id',
                'value' => $model->make->title,
                'type' => 'raw',
            ),

		'title',
//		'temp1',
//		'temp2',
		//'sort',
	),
)); ?>
