<?php
$this->breadcrumbs = array(
    'Categories' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Category', 'url' => array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Website Categories'; ?>

<br/>

<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('ext.yiisortablemodel.widgets.SortableCGridView', array(
    'id' => 'category-grid',
    'dataProvider' => $model->search(),
    //'filter'=>$model,
    'orderField' => 'sort',
    'idField' => 'id',
    'orderUrl' => 'order',
    //'type'=>'striped  condensed',
    'columns' => array(
        'title',
        array(
            'name' => 'image',
            'type' => 'raw',
            'value' => 'CHtml::Image(Yii::app()->baseUrl."/media/category/".$data->image,"", array("width" => 130))'
        ),
        'featured_home_page' => array(
            'name' => 'featured_home_page',
            'value' => '($data->featured_home_page==1)?"Featured":"Not Featured"',
        ),
        'default_commission',
        array(
            'class' => 'CButtonColumn',
            // Template to set order of buttons
            'template' => '{Add Product }',
            // Buttons config
            'buttons' => array(
                'Add Product ' => array(
                    // 'label' => 'Customers & employees',     // text label of the button
                    'url' => 'Yii::app()->controller->createUrl("admin/Product/create", array("id"=>$data[id]))', // the PHP expression for generating the URL of the button
                    'imageUrl' => 'Yii::app()->basePath./../media/users.png',
// image URL of the button. If not set or false, a text link is used
                ),
            ),
        ),
        array(
            'class' => 'CButtonColumn',
            // Template to set order of buttons
            'template' => '{List Product }',
            // Buttons config
            'buttons' => array(
                'List Product ' => array(
                    // 'label' => 'Customers & employees',     // text label of the button
                    'url' => 'Yii::app()->controller->createUrl("admin/Product/index", array("id"=>$data[id]))', // the PHP expression for generating the URL of the button
                    'imageUrl' => 'Yii::app()->basePath./../media/users.png',
// image URL of the button. If not set or false, a text link is used
                ),
            ),
        ),
        array(
            'class' => 'CButtonColumn',
            // Template to set order of buttons
            'template' => '{Add Slider}',
            // Buttons config
            'buttons' => array(
                'Add Slider' => array(
                    // 'label' => 'Customers & employees',     // text label of the button
                    'url' => 'Yii::app()->controller->createUrl("admin/categorySlider/create", array("id"=>$data[id]))', // the PHP expression for generating the URL of the button
                    'imageUrl' => 'Yii::app()->basePath./../media/users.png',
// image URL of the button. If not set or false, a text link is used
                ),
            ),
        ),
        array(
            'class' => 'CButtonColumn',
            // Template to set order of buttons
            'template' => '{List Sliders}',
            // Buttons config
            'buttons' => array(
                'List Sliders' => array(
                    // 'label' => 'Customers & employees',     // text label of the button
                    'url' => 'Yii::app()->controller->createUrl("admin/categorySlider/index", array("id"=>$data[id]))', // the PHP expression for generating the URL of the button
                    'imageUrl' => 'Yii::app()->basePath./../media/users.png',
// image URL of the button. If not set or false, a text link is used
                ),
            ),
        ),
        //'sort',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}',
        ),
    ),
));
?>
