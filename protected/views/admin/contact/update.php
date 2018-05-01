<?php
$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contact','url'=>array('index')),
	array('label'=>'Create Contact','url'=>array('create')),
	array('label'=>'View Contact','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->name; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>