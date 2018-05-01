<?php
$this->breadcrumbs=array(
	'Shipping Values'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ShippingValue','url'=>array('index')),
	array('label'=>'Create ShippingValue','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('shipping-value-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Shipping Values';?>

<br/>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'shipping-value-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
            
            
 'user_id' => array(
                'name' => 'user_id',
                'value' => '$data->shippinguser->username',
                'filter' => User::model()->getUser(),
            ),

          
 'country_id' => array(
                'name' => 'country_id',
                'value' => '$data->shippingcountry->title',
                'filter' => Country::model()->getCountry(),
            ),

                     
// 'city_id' => array(
//                'name' => 'city_id',
//                'value' => '$data->shippingcity->title',
//                'filter' => City::model()->getCity(),
//            ),

	
		'title',
		//'sort',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
