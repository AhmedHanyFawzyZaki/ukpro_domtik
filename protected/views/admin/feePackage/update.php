<?php
$this->breadcrumbs=array(
	'Fee Packages'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FeePackage','url'=>array('index')),
	array('label'=>'Create FeePackage','url'=>array('create')),
	array('label'=>'View FeePackage','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>