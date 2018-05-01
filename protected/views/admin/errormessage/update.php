<?php
$this->breadcrumbs=array(
	'Errormessages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Errormessage','url'=>array('index')),
	array('label'=>'Create Errormessage','url'=>array('create')),
	array('label'=>'View Errormessage','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update Errormessage <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
