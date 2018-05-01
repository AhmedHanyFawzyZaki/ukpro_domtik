<?php
$this->breadcrumbs=array(
'Newsletters'=>array('index'),
'Manage',
);

$this->menu=array(
array('label'=>'List Newsletter','url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('newsletter-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Newsletters'; ?>

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
    'id'=>'newsletter-grid',
    'dataProvider'=>$model->search(),
    //'filter'=>$model,
    'orderField' => 'sort',
    'idField' => 'id',
    'orderUrl' => 'order',
'columns'=>array(
	'email',
	array(
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{delete}{view}'
	),
),
)); ?>
