<?php
$this->breadcrumbs=array(
	'Favourites'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Favourite','url'=>array('index')),
	array('label'=>'Create Favourite','url'=>array('create')),
	array('label'=>'Update Favourite','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Favourite','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Favourite #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(

            
            
 array(
                'name' => 'product_id',
                'value' => $model->product->title,
                'type' => 'raw',
            ),

	
            
 array(
                'name' => 'user_id',
                'value' => $model->user->username,
                'type' => 'raw',
            ),

//		'temp1',
//		'temp2',
//		'sort',
	),
)); ?>
