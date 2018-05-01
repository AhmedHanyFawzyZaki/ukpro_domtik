<?php
$this->breadcrumbs=array(
	'Replies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Reply','url'=>array('index')),
	array('label'=>'View Reply','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update Reply #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>