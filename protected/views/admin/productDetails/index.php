<?php
$this->breadcrumbs=array(
	'Product Details'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductDetails','url'=>array('index')),
	array('label'=>'Create ProductDetails','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-details-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Product Details';?>

<br/>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'product-details-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
		'address',
		'brand_id',
		'city_id',
		'conditions',
		'county_id',
		'decor_style_id',
		/*
		'decor_type_id',
		'destination_city',
		'destination_country',
		'dimensions',
		'flight_date',
		'gender',
		'kids_for',
		'kids_type',
		'latitude',
		'longitude',
		'make_id',
		'motor_model_id',
		'product_id',
		'real_estate_facilities',
		'real_estate_type',
		'sort',
		'source_city',
		'source_country',
		'sub_category_id',
		'temp1',
		'temp2',
		'temp3',
		'temp4',
		'temp5',
		'temp6',
		'travel_type',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
