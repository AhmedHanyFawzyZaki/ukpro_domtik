<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'View Settings','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update Site Settings </h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>