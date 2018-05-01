<?php
$this->breadcrumbs=array(
	'Sponsors'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sponsor','url'=>array('index')),
	array('label'=>'Create Sponsor','url'=>array('create')),
	array('label'=>'View Sponsor','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update'. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>