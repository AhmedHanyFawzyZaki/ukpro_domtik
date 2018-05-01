<?php
$this->breadcrumbs=array(
	'Shipping Values'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ShippingValue','url'=>array('index')),
	array('label'=>'Create ShippingValue','url'=>array('create')),
	array('label'=>'Update ShippingValue','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ShippingValue','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
            
        
 array(
                'name' => 'user_id',
                'value' => $model->shippinguser->username,
                'type' => 'raw',
            ),
            
 array(
                'name' => 'country_id',
                'value' => $model->shippingcountry->title,
                'type' => 'raw',
            ),
            
//        array(
//                'name' => 'city_id',
//                'value' => $model->shippingcity->title,
//                'type' => 'raw',
//            ),
     
    
            
            
		'title',
		//'sort',
	),
)); ?>
