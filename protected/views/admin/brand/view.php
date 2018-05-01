<?php
$this->breadcrumbs=array(
	'Brands'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Brand','url'=>array('index')),
	array('label'=>'Create Brand','url'=>array('create')),
	array('label'=>'Update Brand','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Brand','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
            
array(
                        'name' => 'image',
                        'type' => 'raw',
                       'value' => CHtml::image(Yii::app()->request->baseUrl.'/media/brand/'.$model->image),
                    ),



		'description',
            array(
                "name"=>"category_id",
                "value"=>$model->category->title
            )
//		'sort',
//		'temp1',
//		'temp2',
	),
)); ?>
