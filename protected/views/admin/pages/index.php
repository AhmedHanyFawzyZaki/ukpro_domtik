<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Pages','url'=>array('index')),
    	array('label'=>'Create Pages','url'=>array('create')),

);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pages-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Pages';?> 

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'pages-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
	'columns'=>array(
		'title',
		array(
                    'name'=>'image',
                    'type'=>'html',
                    'value'=>'(!empty($data->image))?CHtml::image(Yii::app()->request->baseUrl."/media/".$data->image,"",array("style"=>"width:100px;height:75px;")):"no image"',
		) ,
            'page_cat' => array(
                'name' => 'page_cat',
                'value' => '$data->pagecat->title',
                'filter' => PageCat::model()->getPageCat(),
            ),

		/*
		'publish',
		*/
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template' => '{view}{update}{delete}',
		),
            
	),
)); ?>
