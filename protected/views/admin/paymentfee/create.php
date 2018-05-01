<?php
$this->breadcrumbs=array(
	'Paymentfees'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Paymentfee','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Paymentfee';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>