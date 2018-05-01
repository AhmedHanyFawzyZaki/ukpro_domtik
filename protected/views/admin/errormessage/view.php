<?php
$this->breadcrumbs=array(
	'Errormessages'=>array('index'),
	$model->id,
);

$this->menu=array(
	
	array('label'=>'Update Errormessage','url'=>array('index')),
	
);
?>

<h1>View Error Message  </h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'error_home',
            
             array(
            'name' => 'error_homeactive',
            'type' => 'raw',
            'value' => Helper::getStatus($model->error_homeactive, "Active", "Not Active"),
        ),
            
		//'error_homeactive',
		//'error_image',
		'error_prev',
            
            
        array(
            'name' => 'error_prevactive',
            'type' => 'raw',
            'value' => Helper::getStatus($model->error_prevactive, "Active", "Not Active"),
        ),
            
		//'error_prevactive',
		//'error_subhead',
            
              array(
            'name' => 'error_subhead',
            'type' => 'raw',
           
                ),
            
            
            
		//'error_heading',
              array(
            'name' => 'error_heading',
            'type' => 'raw',
           
                ),
            
            
		//'error_message',
             array(
            'name' => 'error_message',
            'type' => 'raw',
           
                ),
		//'error_body',
              array(
            'name' => 'error_body',
            'type' => 'raw',
           
                ),
            
            
        
        
        
        
        array(
            'name' => 'error_image',
            'type' => 'raw',
            'value' => CHtml::image(Yii::app()->request->baseUrl . '/media/' . $model->error_image, $model->error_image, array('width' => 200)),
            ),
            
            
            
            
	),
)); ?>
