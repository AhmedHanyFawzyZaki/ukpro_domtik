<?php
$this->breadcrumbs=array(
	'Newsletter Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NewsletterMessage','url'=>array('index')),
	array('label'=>'Manage NewsletterMessage','url'=>array('admin')),
);
?>


<?php $this->pageTitlecrumbs = 'Create Newsletter Message'; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>