<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Orders','url'=>array('index')),
	//array('label'=>'Create Orders','url'=>array('create')),
	array('label'=>'View Orders','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update Orders #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>