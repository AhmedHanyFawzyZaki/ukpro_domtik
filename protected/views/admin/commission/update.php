<?php
$this->breadcrumbs=array(
	'Commissions'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Commission','url'=>array('index')),
	array('label'=>'Create Commission','url'=>array('create')),
	array('label'=>'View Commission','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update  '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>