<?php
$this->breadcrumbs=array(
	'Reviews'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Review','url'=>array('index')),
	array('label'=>'Delete Review','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Review #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
            
 array(
                'name' => 'user_id',
                'value' => $model->user->username,
                'type' => 'raw',
            ),

                        
 array(
                'name' => 'product_id',
                'value' => $model->product->title,
                'type' => 'raw',
            ),
 array(
            'name' => 'published',
            'value'=>($model->published==1)?  "published":"Not Published",
                ),
            'comment_date',
            	'rate',

		'comment',
            
           
		//'comment_date',
//		'temp1',
//		'temp2',
//		'sort',
	),
)); ?>
