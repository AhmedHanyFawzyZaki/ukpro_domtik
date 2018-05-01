<?php

$this->breadcrumbs = array(
    'Banners' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Banner', 'url' => array('index')),
    array('label' => 'Create Banner', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('banner-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Banner'; ?>



<?php

$this->widget('ext.yiisortablemodel.widgets.SortableCGridView', array(
    'id' => 'banner-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'orderField' => 'sort',
    'idField' => 'id',
    'orderUrl' => 'order',
    'columns' => array(
        'title',
        array(
            'name' => 'image',
            'type' => 'html',
            'value' => '(!empty($data->image))?CHtml::image(Yii::app()->request->baseUrl."/media/banner/".$data->image,"",array("style"=>"width:50px;height:50px;")):"no image"',
        ),
        'link',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
