<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Orders','url'=>array('index')),
	//array('label'=>'Create Orders','url'=>array('create')),
	array('label'=>'Update Orders','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Orders','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Orders #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
            
            
 array(
                'name' => 'user_id',
                'value' => $model->userorders->username,
                'type' => 'raw',
            ),

		'total_price',
		'price',
		'total_shipping',
		//'payer_id',
		//'token',
            
 array(
                'name' => 'shipping_country',
                'value' => $model->shippingcountry->title,
                'type' => 'raw',
            ),
         
 array(
                'name' => 'shipping_city',
                'value' => $model->shippingcity->title,
                'type' => 'raw',
            ),


		'shipping_post_code',
		'shipping_address',
                  
 array(
                'name' => 'billing_country',
                'value' => $model->billingcountry->title,
                'type' => 'raw',
            ), 
                       
 array(
                'name' => 'billing_city',
                'value' => $model->billingcity->title,
                'type' => 'raw',
            ), 
           
		'billing_post_code',
		'billing_address',
            
 array(
                'name' => 'status',
                'value' => $model->orderstatus->title,
                'type' => 'raw',
            ),
		'date',
		//'sort',
	),
)); ?>
