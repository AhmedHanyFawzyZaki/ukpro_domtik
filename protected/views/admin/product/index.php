<?php
$this->breadcrumbs = array(
    'Products' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Product', 'url' => array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h3>Manage </h3>-->

<?php $this->pageTitlecrumbs = 'Manage Products'; ?>

<br/>

 <?php 
           if (Yii::app()->user->hasFlash('xml_success')) {
                            ?>
                            <div class="alert alert-success">
                                <?php  echo Yii::app()->user->getFlash('xml_success'); ?>
                            </div>
           <?php }elseif (Yii::app()->user->hasFlash('xml_fail')) {
                            ?>
             <div class="alert alert-danger">
                                <?php  echo Yii::app()->user->getFlash('xml_fail'); ?>
                            </div>
           <?php } ?>

<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('ext.yiisortablemodel.widgets.SortableCGridView', array(
    'id' => 'product-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'orderField' => 'sort',
    'idField' => 'id',
    'orderUrl' => 'order',
    //'type'=>'striped  condensed',
    'columns' => array(
        'title',
        'user_id' => array(
            'name' => 'user_id',
            'value' => '$data->user->username',
            'filter' => User::model()->getUser(),
        ),
// 'category_id' => array(
//                'name' => 'category_id',
//                'value' => '$data->category->title',
//                'filter' => Category::model()->getCategory(),
//            ),
        //'description',
        //'featured_in_home_page',
        //'gallery_id',
        //'has_stock',
        'price',
        array(
					 'name'=> 'main_image',
					 'type'=> 'raw',
					 'value'=> '($data->flag != 1) ? CHtml::Image(Yii::app()->baseUrl."/media/product/".$data->main_image,"", array("width" => 130)) :'
            . 'CHtml::Image($data->main_image, array("width" => 130))'
				),


        /* 'old_price',
          'on_sale',
          'product_category_id',
          'product_status_id',
          'quantity',
          'show_in_home_page',
          'sort',
          'temp1',
          'temp2',
          'temp3',
          'temp4',
          'type',
          'url', */
        //'user_id',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
