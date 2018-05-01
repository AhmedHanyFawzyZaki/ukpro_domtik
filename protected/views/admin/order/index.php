<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Order','url'=>array('index')),

);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('order-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Orders';?>



</div><!-- search-form -->

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
		'creation_date',
		'total_price',
		'net_price',
		'shipping_price',
		//'token',
		
            
 'status_id' => array(
                'name' => 'status_id',
                'value' => '$data->orderstatus->title',
                'filter' => OrderStatus::model()->getStatus(),
            ),
'buyer_id' => array(
                'name' => 'buyer_id',
                'value' => '$data->userorders->username',
                'filter' => User::model()->getUser(),
            ),
            /*
		'buyer_id',
		'total_commission',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
