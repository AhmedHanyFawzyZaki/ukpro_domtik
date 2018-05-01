<?php
$this->breadcrumbs=array(
	'Paymentfees'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Paymentfee','url'=>array('index')),
	array('label'=>'Create Paymentfee','url'=>array('create')),
	array('label'=>'View Paymentfee','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update Paymentfee #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>