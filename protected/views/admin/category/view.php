<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Category','url'=>array('index')),
	array('label'=>'Update Category','url'=>array('update','id'=>$model->id)),
	//array('label'=>'Delete Category','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
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
                       'value' => CHtml::image(Yii::app()->request->baseUrl.'/media/category/'.$model->image),
                    ),
            
            array(
            'name' => 'featured_home_page',
            'value'=>($model->featured_home_page==1)?  "Featured":"Not Featured",
                ),


'default_commission',

		//'sort',
	),
)); ?>
