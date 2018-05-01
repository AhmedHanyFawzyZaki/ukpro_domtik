<?php
$this->breadcrumbs=array(
	'Product Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductCategory','url'=>array('index')),
	array('label'=>'Create ProductCategory','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Product Categories';?>

<br/>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'product-category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	//'orderField' => 'sort',
    	//'idField' => 'id',
    	//'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
            'category_id' => array(
                'name' => 'category_id',
                'value' => '$data->category->title',
                'filter' => Category::model()->getCategory(),
            ),

		'title',
		'description',
		//'sort',
		//'temp1',
		/*
		'temp2',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
