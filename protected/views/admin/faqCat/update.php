<?php
$this->breadcrumbs=array(
	'Faq Categories'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Faq Category','url'=>array('index')),
	array('label'=>'Create Faq Category','url'=>array('create')),
	array('label'=>'View Faq Category','url'=>array('view','id'=>$model->id)),
);
?>
<?php $this->pageTitlecrumbs = 'Update Faq Category "'. $model->title.' "'; ?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>