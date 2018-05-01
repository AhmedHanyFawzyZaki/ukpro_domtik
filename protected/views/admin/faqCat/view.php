<?php
$this->breadcrumbs=array(
	'Faq Categories'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Faq Category','url'=>array('index')),
	array('label'=>'Create Faq Category','url'=>array('create')),
	array('label'=>'Update Faq Category','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Faq Category','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Faq Category "'. $model->title.' "'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
           
	),
)); ?>

<?php 
echo CHtml::button('Faq',
array('submit' => array('admin/faq/index','id'=>$model->id),
'name'=>'onclick',
'class'=>'btn btn-primary',
'style'=>'width:80px;'
)); 
?>