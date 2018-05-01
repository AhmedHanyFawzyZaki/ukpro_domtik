<?php
$this->breadcrumbs=array(
	'Faqs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Faq','url'=>array('index')),
	array('label'=>'Create Faq','url'=>array('create')),
	array('label'=>'Update Faq','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Faq','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Faq "'. $model->quest.' "'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'cat_id',
			'type'=>'raw',
			 'value'=>$model->cat->title,
				),
		'quest',
		'answer',
            array(
                'name' => 'category_id',
                'value' => $model->faqcat->title,
                'type' => 'raw',
            ),

		array(
			'name'=>'active',
			'type'=>'raw',
			 'value'=>($model->active==1)?'Active': 'Not active',
				),
	),
)); ?>
