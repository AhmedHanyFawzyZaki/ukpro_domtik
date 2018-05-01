<?php
$this->breadcrumbs=array(
	'Page Cats'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PageCat','url'=>array('index')),
	array('label'=>'Create PageCat','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('page-cat-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Page Cats';?>

<br/>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'page-cat-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
		'title',
		//'sort',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
