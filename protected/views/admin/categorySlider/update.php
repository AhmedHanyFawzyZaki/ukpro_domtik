<?php
$this->breadcrumbs=array(
	'Category Sliders'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategorySlider','url'=>array('index')),
	//array('label'=>'Create CategorySlider','url'=>array('create')),
	array('label'=>'View CategorySlider','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update CategorySlider #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model,'id'=>$cat_id)); ?>