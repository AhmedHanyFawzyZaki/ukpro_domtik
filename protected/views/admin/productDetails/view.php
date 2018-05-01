<?php
$this->breadcrumbs=array(
	'Product Details'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductDetails','url'=>array('index')),
	array('label'=>'Create ProductDetails','url'=>array('create')),
	array('label'=>'Update ProductDetails','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ProductDetails','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View ProductDetails #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'address',
		'brand_id',
		'city_id',
		'conditions',
		'county_id',
		'decor_style_id',
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
//		'temp1',
//		'temp2',
//		'temp3',
//		'temp4',
//		'temp5',
//		'temp6',
		'travel_type',
	),
)); ?>
