<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
    	array('label'=>'Update Product','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Product','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View '. $model->title  ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
            array(
                'name' => 'user_id',
                'value' => $model->user->username,
                'type' => 'raw',
            ),
 
 array(
                'name' => 'productCategory',
                'value' => $model->productCategory->title,
                'type' => 'raw',
            ),
            
   
		'title',
		'description',
                'price',
     		'quantity',
                     
array(
                        'name' => 'main_image',
                        'type' => 'raw',
                       'value' => ($model->flag !=1) ? CHtml::image(Yii::app()->request->baseUrl.'/media/product/'.$model->main_image):
    CHtml::image($model->main_image ,array('width'=>100,'height'=>100)),
                    ),


		'gallery_id',
             array(
            'name' => 'on_sale',
            'value'=>($model->on_sale==0)?  "Not On Sale":"On Sale",
                ),
array(
            'name' => 'featured_in_home_page',
            'value'=>($model->featured_in_home_page==1)?  "appear in landing page":"Not appear in landing page",
                ),
array(
            'name' => 'show_in_website_category',
            'value'=>($model->show_in_website_category==1)?  "show in category home page":"Don't show in category home page",
                ),
           
		//'sort',
		
	),
)); ?>
