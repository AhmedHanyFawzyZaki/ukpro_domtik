<?php
$this->breadcrumbs=array(
	'Reviews'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Review','url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('review-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Reviews';?>

<br/>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'review-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
            
            
 'user_id' => array(
                'name' => 'user_id',
                'value' => '$data->user->username',
                'filter' => User::model()->getUser(),
            ),


            
             'product_id' => array(
                'name' => 'product_id',
                'value' => '$data->product->title',
                'filter' => Product::model()->getProduct(),
            ),
            
            'published'=>array(
            'name' => 'published',
            'value'=>'($data->published==1)?"published":"Not Published"',
                ),
            'rate',

	    'comment',
            
		//'comment_date',
		/*
		'temp1',
		'temp2',
		'sort',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
