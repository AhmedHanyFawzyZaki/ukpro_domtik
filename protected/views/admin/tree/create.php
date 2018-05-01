<?php
$this->breadcrumbs=array(
	'Trees'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tree','url'=>array('index')),
	array('label'=>'Manage Tree','url'=>array('admin')),
);
?>

<h1>Create Tree</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>