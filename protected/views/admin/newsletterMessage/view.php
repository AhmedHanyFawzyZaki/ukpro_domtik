<?php
$this->breadcrumbs=array(
	'Newsletter Messages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NewsletterMessage','url'=>array('index')),
	array('label'=>'Create NewsletterMessage','url'=>array('create')),
	array('label'=>'Delete NewsletterMessage','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Newsletter Message "'. $model->title.' "'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'subject',
		'userList',
		array(
			'name'=>'message',
			'type'=>'raw',
                ),

		'date_sent',
		//'start_flag',
		//'end_flag',
	),
)); ?>
