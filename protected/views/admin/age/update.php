<?php
$this->breadcrumbs=array(
	'Ages'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Age','url'=>array('index')),
	array('label'=>'Create Age','url'=>array('create')),
	array('label'=>'View Age','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
