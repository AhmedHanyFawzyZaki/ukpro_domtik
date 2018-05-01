<?php
$this->breadcrumbs=array(
	'Favourites'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Favourite','url'=>array('index')),
	array('label'=>'Create Favourite','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('favourite-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Favourites';?>

<br/>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'favourite-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
            
 'product_id' => array(
                'name' => 'product_id',
                'value' => '$data->product->title',
                'filter' => Product::model()->getProduct(),
            ),

     'user_id' => array(
                'name' => 'user_id',
                'value' => '$data->user->username',
                'filter' => User::model()->getUser(),
            ),

//		'temp1',
//		'temp2',
//		'sort',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
