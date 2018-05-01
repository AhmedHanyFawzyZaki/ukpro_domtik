<?php
$this->breadcrumbs=array(
	'Galleries'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Gallery','url'=>array('index')),
	array('label'=>'Create Gallery','url'=>array('create')),
	array('label'=>'View Gallery','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update Gallery #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>