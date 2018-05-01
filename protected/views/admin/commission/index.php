<?php
$this->breadcrumbs=array(
	'Commissions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Commission','url'=>array('index')),
	array('label'=>'Create Commission','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('commission-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Commissions';?>

<br/>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'commission-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
            
 'user_id' => array(
                'name' => 'user_id',
                'value' => '$data->usercommissions->username',
                'filter' => User::model()->getUser(),
            ),
            
       
 'category_id' => array(
                'name' => 'category_id',
                'value' => '$data->categorycommissions->title',
                'filter' => Category::model()->getCategory(),
            ),
          
            'type'=>array(
            'name' => 'type',
            'value'=>'($data->type==0)?"Product":"Service"',
                ),

		'title',
		//'sort',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
