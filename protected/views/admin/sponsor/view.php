<?php
$this->breadcrumbs=array(
	'Sponsors'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Sponsor','url'=>array('index')),
	array('label'=>'Create Sponsor','url'=>array('create')),
	array('label'=>'Update Sponsor','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Sponsor','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View title'. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
            array(
                        'name' => 'image',
                        'type' => 'raw',
                       'value' => CHtml::image(Yii::app()->request->baseUrl.'/media/sponsors/'.$model->image),
                    ),

		'url',
		//'sort',
	),
)); ?>
