<?php
$this->breadcrumbs=array(
	'Errormessages'=>array('index'),
	'View'=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'View Errormessage','url'=>array('view','id'=>$model->id)),
);

?>

<?php // echo $model->id ;  ?> 
<h1>Update  Error message : </h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
