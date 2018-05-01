<?php
$this->breadcrumbs=array(
	'Faq Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Faq Category','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Faq Category'; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>