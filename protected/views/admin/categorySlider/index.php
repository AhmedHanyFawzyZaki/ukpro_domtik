<?php
$this->breadcrumbs=array(
	'Category Sliders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CategorySlider','url'=>array('index')),
	//array('label'=>'Create CategorySlider','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('category-slider-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

</div><!-- search-form -->

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'category-slider-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
	//	'category_id',
            'category_id' => array(
                'name' => 'category_id',
                'value' => '$data->category->title',
                //'filter' => Category::model()->getCategory(),
            ),
		//'image',
		'title',
		//'description',
		//'product_id',
		/*
		'link',
		'sort',
		'temp2',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
