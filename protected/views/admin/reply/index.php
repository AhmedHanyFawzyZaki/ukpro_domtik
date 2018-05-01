<?php
$this->breadcrumbs=array(
	'Replies'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Reply','url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('reply-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Replies';?>

<br/>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'reply-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
    	//'type'=>'striped  condensed',
	'columns'=>array(
            'message_id' => array(
                'name' => 'message_id',
                'value' => '$data->replymessage->title',
                'filter' => Message::model()->getMessage(),
            ),

            
 'user_id' => array(
                'name' => 'user_id',
                'value' => '$data->replyuser->username',
                'filter' => User::model()->getUser(),
            ),
  'published'=>array(
            'name' => 'published',
            'value'=>'($data->published==1)?"published":"Not Published"',
                ),

		'details',
		//'reply_date',
		//'sort',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
