<?php

$this->breadcrumbs = array(
    'Faq Categories' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Faq Category', 'url' => array('index')),
    array('label' => 'Create Faq Category', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('faq-cat-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Faq Categories'; ?>


<?php

$this->widget('ext.yiisortablemodel.widgets.SortableCGridView', array(
    'id' => 'faq-cat-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'orderField' => 'sort',
    'idField' => 'id',
    'orderUrl' => 'order',
    'columns' => array(
        'title',
        array(
            'class' => 'CButtonColumn',
            // Template to set order of buttons
            'template' => '{faq}',
            // Buttons config
            'buttons' => array(
                'faq' => array(
                    'url' => 'Yii::app()->controller->createUrl("admin/faq/index", array("id"=>$data[id]))', // the PHP expression for generating the URL of the button
                    'imageUrl' => 'Yii::app()->basePath./../media/users.png', // image URL of the button. If not set or false, a text link is used
                ),
            ),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
