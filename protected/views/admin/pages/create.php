<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pages','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Pages';?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>