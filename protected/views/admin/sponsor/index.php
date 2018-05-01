<?php
$this->breadcrumbs=array(
	'Sponsors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Sponsor','url'=>array('index')),
	array('label'=>'Create Sponsor','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('sponsor-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Sponsors';?>

<br/>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'sponsor-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
		'title',
            
            array(
				'name'=> 'image',
				'type'=> 'raw',
			        'value'=> 'CHtml::Image(Yii::app()->baseUrl."/media/sponsors/".$data->image,"", array("width" => 130))'
				),


		'url',
		//'sort',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
