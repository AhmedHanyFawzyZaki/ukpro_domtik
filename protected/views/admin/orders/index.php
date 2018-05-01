<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Orders','url'=>array('index')),
	//array('label'=>'Create Orders','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('orders-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Orders';?>

<br/>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'orders-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
            
 'user_id' => array(
                'name' => 'user_id',
                'value' => '$data->userorders->username',
                'filter' => User::model()->getUser(),
            ),


		'total_price',
		//'price',
		//'total_shipping',
		//'payer_id',
            
 'status' => array(
                'name' => 'status',
                'value' => '$data->orderstatus->title',
                'filter' => OrderStatus::model()->getStatus(),
            ),
            
            
// 'shipping_country' => array(
//                'name' => 'shipping_country',
//                'value' => '$data->shippingcountry->title',
//                'filter' => Country::model()->getCountry(),
//            ),
        
// 'shipping_country' => array(
//                'name' => 'shipping_country',
//                'value' => '$data->shippingcountry->title',
//                'filter' => Country::model()->getCountry(),
//            ),
      
            
            
            
// 'shipping_city' => array(
//                'name' => 'shipping_city',
//                'value' => '$data->shippingcity->title',
//                'filter' => City::model()->getCity(),
//            ),
                         
      
// 'billing_country' => array(
//                'name' => 'billing_country',
//                'value' => '$data->billingcountry->title',
//                'filter' => Country::model()->getCountry(),
//            ),
                         
  
// 'billing_city' => array(
//                'name' => 'billing_city',
//                'value' => '$data->billingcity->title',
//                'filter' => City::model()->getCity(),
//            ),
//          
        /*
		'token',
		
		'shipping_post_code',
		'shipping_address',
		
		'billing_post_code',
		'billing_address',
		'status',
		'date',
		'sort',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
