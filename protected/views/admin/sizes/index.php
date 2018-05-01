<?php
$this->breadcrumbs=array(
	'Sizes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Sizes','url'=>array('index')),
	array('label'=>'Create Sizes','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('sizes-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Sizes';?>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'sizes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
            
 'category_id' => array(
                'name' => 'category_id',
                'value' => '$data->cat->title',
                'filter' => Category::model()->getCategory(),
            ),

		'title',
		//'sort',
		'description',
		//'temp2',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
