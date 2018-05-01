<?php
$this->breadcrumbs=array(
	'Sub Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SubCategory','url'=>array('index')),
	array('label'=>'Create SubCategory','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('sub-category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Sub Categories';?>

<br/>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'sub-category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
            
            
 'product_category_id' => array(
                'name' => 'product_category_id',
                'value' => '$data->productCategory->title',
                'filter' => ProductCategory::model()->getProductCategory(),
            ),


		'title',
		//'sort',
//		'temp1',
//		'temp2',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
