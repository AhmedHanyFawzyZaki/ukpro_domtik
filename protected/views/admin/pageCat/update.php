<?php
$this->breadcrumbs=array(
	'Page Cats'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PageCat','url'=>array('index')),
	array('label'=>'Create PageCat','url'=>array('create')),
	array('label'=>'View PageCat','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>