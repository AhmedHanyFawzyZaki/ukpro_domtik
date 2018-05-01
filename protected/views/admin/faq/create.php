<?php
$this->breadcrumbs=array(
	'Faqs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Faq','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Faq'; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>