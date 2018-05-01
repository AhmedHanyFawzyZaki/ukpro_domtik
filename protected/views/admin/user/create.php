<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create User';?>

<?php echo $this->renderPartial('_form', array('model'=>$model ,'user_details'=>$user_details)); ?>