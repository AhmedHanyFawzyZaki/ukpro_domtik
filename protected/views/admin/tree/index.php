<?php
$this->breadcrumbs=array(
	'Trees',
);

$this->menu=array(
	array('label'=>'Create Tree','url'=>array('create')),
	array('label'=>'Manage Tree','url'=>array('admin')),
);
?>

<h1>Trees</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
