<?php
$this->breadcrumbs=array(
	'Errormessages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Errormessage','url'=>array('index')),
);
?>

<h1>Create Errormessage</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
