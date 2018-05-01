<?php
$this->breadcrumbs=array(
	'Page Cats'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PageCat','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create PageCat';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>