<?php
$this->breadcrumbs=array(
	'Faqs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Faq','url'=>array('index')),
	array('label'=>'Create Faq','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('faq-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Faqs'; ?>


<?php $this->widget('ext.yiisortablemodel.widgets.SortableCGridView',array(
	'id'=>'faq-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'orderField' => 'sort',
    	'idField' => 'id',
    	'orderUrl' => 'order',
	'columns'=>array(
            'category_id' => array(
                'name' => 'category_id',
                'value' => '$data->faqcat->title',
                'filter' => Category::model()->getCategory(),
            ),
		array(
			'name'=>'cat_id',
			 'value'=>'$data->cat->title',
			 'filter'=> FaqCat::model()->getCategory(),
				),
		'quest',
		'answer',
            

		array(
			'name'=>'active',
			 'value'=>'($data->active)?"Active":"Not active"',
			 'filter'=> '',
				),

		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
