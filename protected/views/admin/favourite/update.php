<?php
$this->breadcrumbs=array(
	'Favourites'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Favourite','url'=>array('index')),
	array('label'=>'Create Favourite','url'=>array('create')),
	array('label'=>'View Favourite','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update Favourite #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>