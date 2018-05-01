<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Order','url'=>array('index')),
	array('label'=>'Create Order','url'=>array('create')),
	array('label'=>'Update Order','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Order','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Order #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'creation_date',
		'total_price',
		'net_price',
		'shipping_price',
		//'token',
            
            
 array(
                'name' => 'status_id',
                'value' => $model->orderstatus->title,
                'type' => 'raw',
            ),
            
             array(
                'name' => 'buyer_id',
                'value' => $model->userorders->username,
                'type' => 'raw',
            ),
		//'buyer_id',
		'total_commission',
	),
)); ?>
<br/><br/>

            <p style="color:red">Order Details </p>

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'order-details-grid',
	'dataProvider'=>$orderdetails->search(),
	//'filter'=>$orderdetails,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
		//'order_id',
            
            
 'product_id' => array(
                'name' => 'product_id',
                'value' => '$data->product->title',
                'filter' => Product::model()->getProduct(),
            ),


		'shipping_address',
		'shipping_city',
		'shipping_country',
		
		'shipping_postcode',
		'shipping_price',
		'total_price',
		'net_price',
		'quantity',
		'color',
		'size',
		'commission_price',
		
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
	),
)); ?>
