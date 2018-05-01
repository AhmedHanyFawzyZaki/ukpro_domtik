<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Pages','url'=>array('index')),
	array('label'=>'Update Pages','url'=>array('update','id'=>$model->id)),
);
?>

 <?php
$this->breadcrumbs=array(
    'Pages'=>array('index'),
    $model->title,
);

$this->menu=array(
    array('label'=>'List Pages','url'=>array('index')),
    array('label'=>'Create Pages','url'=>array('create')),
    array('label'=>'Update Pages','url'=>array('update','id'=>$model->id)),
    array('label'=>'Delete Pages','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Pages "'. $model->title.' "'; ?>



<?php
/* $this->widget('ext.Yiippod.Yiippod', array(
    'video'=>Yii::app()->request->baseUrl."/media/test.flv", //if you don't use playlist
    
    'id' => 'yiippodplayer',
    'autoplay'=>true,
    'width'=>400,
    'view'=>6, 
    'height'=>380,
    'bgcolor'=>'#000'
    ));
 */
 
 
 $this->widget('ext.Yiinior.Yiinior', array(
    'video'=>Yii::app()->request->baseUrl."/media/test.flv", //if you don't use playlist
'id' => 'yiinior',
'width'=>640,
'height'=>480,
'autoplay'=>'false',
'autohide'=>'true',
'bgcolor'=>'#000'
));
 
 
 

?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(

		'title',
//		'intro',
		array(
                      'name'=>'details',
                      'type'=>'raw',
                ),
		array(
		'name'=>'image',
		'type'=>'raw',
		'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/'.$model->image,$model->title,array('width'=>150)),
		),

//		'meta_author',
//		'meta_keywords',
//		'meta_desc',

		//array(
//			'name'=>'video',
//		
	 'type'=>'raw',
//			  'value'=>Helper::PlayVideo($model)
//
//			),




		array(
			'name'=>'publish',
			'type'=>'raw',
			'value'=>$model->getStatus($model->publish),
		),
            
            array(
                'name' => 'page_cat',
                'value' => $model->pagecat->title,
                'type' => 'raw',
            ),

	),
)); ?>



