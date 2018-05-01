<?php
$this->breadcrumbs=array(
	'Commissions'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Commission','url'=>array('index')),
	array('label'=>'Create Commission','url'=>array('create')),
	array('label'=>'Update Commission','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Commission','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View  '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
            
            
            
 array(
                'name' => 'user_id',
                'value' => $model->usercommissions->username,
                'type' => 'raw',
            ),
            
            
            
 array(
                'name' => 'category_id',
                'value' => $model->categorycommissions->title,
                'type' => 'raw',
            ),
            
   array(
            'name' => 'type',
            'value'=>($model->type==0)?  "Product":"Service",
                ),


		'title',
		//'sort',
	),
)); ?>
